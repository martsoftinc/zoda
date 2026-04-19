<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ReloadlyService
{
    private $clientId;
    private $clientSecret;
    private $authUrl;
    private $topupUrl;
    private $operatorUrl;

   public function __construct()
{
    $this->clientId = config('services.reloadly.client_id');
    $this->clientSecret = config('services.reloadly.client_secret');
    $this->authUrl = config('services.reloadly.auth_url');  // Now unified
    $this->topupUrl = config('services.reloadly.topup_url', 'https://topups-sandbox.reloadly.com/topups');
    $this->operatorUrl = config('services.reloadly.operator_url', 'https://topups-sandbox.reloadly.com/operators');
}

    /**
     * Get or refresh access token (cached for 50 min).
     */
   private function getAccessToken(): ?string
{
    return Cache::remember('reloadly_token', 50 * 60, function () {
        $payload = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'client_credentials',
            'audience' => config('services.reloadly.audience', 'https://topups-sandbox.reloadly.com'),  // Sandbox by default
        ];

        $response = Http::asForm()->post($this->authUrl, $payload);  // authUrl is now always https://auth.reloadly.com/oauth/token

        if ($response->successful()) {
            return $response->json('access_token');
        }

        Log::error('Reloadly token fetch failed', ['error' => $response->body(), 'payload' => $payload]);
        throw new \Exception('Failed to authenticate with Reloadly');
    });
}

    /**
     * Auto-detect operator for a phone number.
     */
    public function detectOperator(string $phoneNumber, string $countryCode): array
    {
        $token = $this->getAccessToken();
        $response = Http::withHeaders(['Authorization' => "Bearer {$token}"])
            ->get("{$this->operatorUrl}/auto-detect/phone/{$phoneNumber}/countries/{$countryCode}");

        if ($response->successful()) {
            $data = $response->json();
            // Filter for data-enabled operators
            return collect($data['operators'] ?? [])->firstWhere('dataEnabled', true) ?? null;
        }

        Log::error('Operator detection failed', ['error' => $response->body()]);
        return null;
    }

    /**
     * Send data bundle top-up.
     */
    public function sendDataBundle(array $payload): ?array
    {
        $token = $this->getAccessToken();
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}",
            'Content-Type' => 'application/json',
        ])->post($this->topupUrl, $payload);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('Top-up failed', ['payload' => $payload, 'error' => $response->body()]);
        return null;
    }

    /**
     * Check top-up status.
     */
    public function getTopupStatus(string $transactionId): ?array
    {
        $token = $this->getAccessToken();
        $response = Http::withHeaders(['Authorization' => "Bearer {$token}"])
            ->get("{$this->topupUrl}/{$transactionId}");

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('Status check failed', ['transactionId' => $transactionId, 'error' => $response->body()]);
        return null;
    }
}