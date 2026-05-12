<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'google_id',
        'avatar',
        'account_id',
        'password',
        'country',
        'role',
        'phone',
        'age_group',
        'gender',
        'tutorial',
        'status'
        
        
    ];

    protected $table ="users";
// credit relationship
    public function credit()
{
    return $this->hasMany(CreditModel::class);
}

public function payment_requests()
{
    return $this->hasMany(PaymentRequests::class);
}
//payment settings relationship
public function paymentsettings()
{
    return $this->hasMany(PaymentSettingsModal::class);
}

// Balance relationship
public function balance()
{
    return $this->hasMany(BalanceModel::class);
}

 public function clicks()
{
    return $this->hasMany(clicksModel::class);
}

public function referrals()
{
    return $this->hasMany(Referral::class, 'referrer_id');
}

public function referredBy()
{
    return $this->hasOne(Referral::class, 'referred_user_id');
}

public function referredUsers() {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($users) {
            // Generate a 10-digit unique campaign_id
            $users->account_id = self::generateUniqueAccountId();

        
        });
    }

    // Generate a 10-digit unique number
    private static function generateUniqueAccountId()
    {
        do {
            // Generate a random 10-digit number
            $accountId = random_int(1000000000, 9999999999);
        } while (self::where('account_id', $accountId)->exists());

        return $accountId;
    }
}
