<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\campaignModel;
use App\Models\User;

class ClicksModel extends Model
{
    use HasFactory;
    protected $table = 'clicks'; 
    protected $fillable = [
        'campaign_id', 
        'user_id',     
        'cost', 
        'ip_address',
        'completed_at'   
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function campaign()
    {
        return $this->belongsTo(campaignModel::class,'campaign_id', 'id');
    }
}
