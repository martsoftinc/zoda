<?php

namespace App\Http\Controllers;
use App\Services\ReloadlyService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DB;
use App\Models\PaymentRequests;
use App\Models\Referral;
use App\Models\CreditModel;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CashController extends Controller
{
public function momo(){
    $users = Auth::user();       
    $credit = DB::table('credit')
             ->where('user_id', $users->id)
             ->first();
    
    // Check if user is from Ghana (GH)
    if ($users->country !== 'GH') {
        return redirect()->to('/choose')->with('error', 'This page is only available for users in Ghana');
    }
    
    return view("user.redeemcash.momo", compact('credit'));
}
 

  
  
}
