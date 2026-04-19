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
                 ->where('user_id',$users->id)
                 ->first();
        return view("user.redeemcash.momo");
    }

    public function nigeria(){
        $users = Auth::user();       
        $credit = DB::table('credit')
                 ->where('user_id',$users->id)
                 ->first();
        return view("user.redeemcash.nigeria");
    }

    public function southafrica(){
        $users = Auth::user();       
        $credit = DB::table('credit')
                 ->where('user_id',$users->id)
                 ->first();
        return view("user.redeemcash.southafrica");
    }

    public function mpesa(){
        $users = Auth::user();       
        $credit = DB::table('credit')
                 ->where('user_id',$users->id)
                 ->first();
        return view("user.redeemcash.mpesa");
    }

    
    public function mozambique(){
        $users = Auth::user();       
        $credit = DB::table('credit')
                 ->where('user_id',$users->id)
                 ->first();
        return view("user.redeemcash.mozambique");
    }

    public function ethiopia(){
        $users = Auth::user();       
        $credit = DB::table('credit')
                 ->where('user_id',$users->id)
                 ->first();
        return view("user.redeemcash.ethiopia");
    }

    public function tanzania(){
        $users = Auth::user();       
        $credit = DB::table('credit')
                 ->where('user_id',$users->id)
                 ->first();
        return view("user.redeemcash.tanzania");
    }
}
