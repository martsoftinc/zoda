<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SouthAfricaBankWithdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'bank_name',
        'account_type',
        'account_number',
        'branch_code',
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
            'absa'               => 'ABSA Bank',
            'african_bank'       => 'African Bank',
            'bidvest_bank'       => 'Bidvest Bank',
            'capitec'            => 'Capitec Bank',
            'discovery_bank'     => 'Discovery Bank',
            'fnb'                => 'First National Bank (FNB)',
            'grindrod_bank'      => 'Grindrod Bank',
            'investec'           => 'Investec Bank',
            'mercantile_bank'    => 'Mercantile Bank',
            'nedbank'            => 'Nedbank',
            'old_mutual_finance' => 'Old Mutual Finance',
            'sasfin_bank'        => 'Sasfin Bank',
            'standard_bank'      => 'Standard Bank',
            'tyme_bank'          => 'TymeBank',
            'ubank'              => 'Ubank',
        ];

        return $banks[$this->bank_name] ?? ucwords(str_replace('_', ' ', $this->bank_name));
    }

    public function accountTypeLabel(): string
    {
        return match ($this->account_type) {
            'cheque'       => 'Cheque / Current Account',
            'savings'      => 'Savings Account',
            'transmission' => 'Transmission Account',
            default        => ucfirst($this->account_type),
        };
    }
}