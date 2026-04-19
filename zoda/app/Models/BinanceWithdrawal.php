<?php
// app/Models/BinanceWithdrawal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinanceWithdrawal extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'binance_withdrawals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'transaction_id',
        'binance_id',
        'amount',
        'points_required',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'points_required' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the user that owns the withdrawal.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
            'processing' => '<span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Processing</span>',
            'completed' => '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Completed</span>',
            'failed' => '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Failed</span>',
            'cancelled' => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Cancelled</span>',
            default => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">' . ucfirst($this->status) . '</span>',
        };
    }

    /**
     * Generate a reference ID for internal tracking
     */
    public static function generateReferenceId()
    {
        $prefix = 'BIN';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        
        return $prefix . $date . $random;
    }

    /**
     * Scope a query to only include pending withdrawals.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include completed withdrawals.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}