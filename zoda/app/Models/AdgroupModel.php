<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdgroupModel extends Model
{
    use HasFactory;
    protected $table ="adgroup";
    protected $fillable = ['adgroup_id', 'adgroup_name', 'user_id'];
    
    
   protected static function boot()
    {
        parent::boot();

        static::creating(function ($adGroup) {
            // Generate the unique 10-digit adgroup_id
            $adGroup->adgroup_id = self::generateUniqueAdGroupId();
        });
    }

    // Generate a 10-digit unique number for adgroup_id
    private static function generateUniqueAdGroupId()
    {
        do {
            // Generate a random 10-digit number
            $adGroupId = random_int(1000000000, 9999999999);
        } while (self::where('adgroup_id', $adGroupId)->exists()); // Ensure it's unique

        return $adGroupId;
    }

    public function campaigns()
    {
        return $this->hasMany(campaignModel::class, 'adgroup_id');
    }
}
