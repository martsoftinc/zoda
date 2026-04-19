<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{
    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'permalink' => 'required|string|url',
            'browser_date' => 'required|string|regex:/^\d{4}-\d{2}-\d{2}$/'
        ]);

        $p = rtrim($request->input('permalink'), '/');
        $bd = $request->input('browser_date');
        $cip = $this->getClientIp($request);  // ← Pass $request here

        if ($cip === 'unknown') {
            return response()->json([
                'success' => false,
                'message' => 'Error: Unable to determine client IP'
            ]);
        }

        // Obfuscated hash generation
        $tmp1 = strrev($p); $tmp1 = strrev($tmp1);
        $tmp2 = md5($bd); $tmp2 = substr($tmp2, 0, 1);
        $s = $tmp1 . $bd . $cip;
        $h = hash('sha256', $s);

        return response()->json([
            'success' => true,
            'message' => 'Hash generated successfully',
            'hash' => $h
        ]);
    }

    private function getClientIp(Request $request): string
    {
        if ($ip = $request->ip()) {
            return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : 'unknown';
        }

        $headers = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'REMOTE_ADDR'
        ];

        foreach ($headers as $header) {
            if ($request->header($header)) {
                $ip = $request->header($header);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return 'unknown';
    }
}