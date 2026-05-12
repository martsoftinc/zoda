<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NigeriaBankWithdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'bank_name',
        'account_number',
        'account_name',
        'amount',
        'status',
        'notes',
        'processed_at',
    ];

    protected $casts = [
        'amount'       => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    // ── Relationships ────────────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ── Scopes ───────────────────────────────────────────────────
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // ── Helpers ──────────────────────────────────────────────────
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function bankLabel(): string
    {
        $banks = [
            'access_bank'        => 'Access Bank',
            'citibank'           => 'Citibank Nigeria',
            'ecobank'            => 'Ecobank Nigeria',
            'fidelity_bank'      => 'Fidelity Bank',
            'first_bank'         => 'First Bank of Nigeria',
            'fcmb'               => 'First City Monument Bank (FCMB)',
            'gtbank'             => 'Guaranty Trust Bank (GTBank)',
            'heritage_bank'      => 'Heritage Bank',
            'keystone_bank'      => 'Keystone Bank',
            'kuda_bank'          => 'Kuda Bank',
            'moniepoint'         => 'Moniepoint MFB',
            'opay'               => 'OPay Digital Services',
            'palmpay'            => 'PalmPay',
            'polaris_bank'       => 'Polaris Bank',
            'providus_bank'      => 'Providus Bank',
            'stanbic_ibtc'       => 'Stanbic IBTC Bank',
            'standard_chartered' => 'Standard Chartered Bank',
            'sterling_bank'      => 'Sterling Bank',
            'uba'                => 'United Bank for Africa (UBA)',
            'union_bank'         => 'Union Bank of Nigeria',
            'unity_bank'         => 'Unity Bank',
            'wema_bank'          => 'Wema Bank',
            'zenith_bank'        => 'Zenith Bank',
        ];

        return $banks[$this->bank_name] ?? ucwords(str_replace('_', ' ', $this->bank_name));
    }
}