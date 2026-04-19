<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequests extends Model
{
    use HasFactory;
    protected $table ="payment_requests";
    protected $fillable = [
        'user_id',  
        'amount',
        'status',   
        'recipient_phone',
        'custom_identifier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
