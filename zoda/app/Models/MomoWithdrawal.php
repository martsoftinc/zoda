<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MomoWithdrawal extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'momo_withdrawal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'network',
        'phone',
        'name',
        'amount',
        'status',
        'notes',
        'processed_at',
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
     * Get the admin that processed the withdrawal.
     */
    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
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

    /**
     * Scope a query to only include failed withdrawals.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope a query to only include processing withdrawals.
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    /**
     * Get the status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">Pending</span>',
            'processing' => '<span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 border border-blue-200">Processing</span>',
            'completed' => '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 border border-green-200">Completed</span>',
            'failed' => '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 border border-red-200">Failed</span>',
            'cancelled' => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 border border-gray-200">Cancelled</span>',
            default => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 border border-gray-200">' . ucfirst($this->status) . '</span>',
        };
    }

    /**
     * Get the network display name
     */
    public function getNetworkDisplayAttribute()
    {
        return match($this->network) {
            'mtn' => 'MTN Mobile Money',
            'tigo' => 'Tigo Cash (AirtelTigo)',
            'telecel' => 'Telecel Cash',
            default => ucfirst($this->network),
        };
    }

    /**
     * Get formatted phone number
     */
    public function getFormattedPhoneAttribute()
    {
        return '+233 ' . $this->phone_number;
    }

    /**
     * Generate a reference ID for internal tracking (optional)
     */
    public static function generateReferenceId()
    {
        $prefix = 'REF';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        
        return $prefix . $date . $random;
    }
}