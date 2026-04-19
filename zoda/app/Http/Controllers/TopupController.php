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

class TopupController extends Controller
{
    private $reloadly;

    public function __construct(ReloadlyService $reloadly)
    {
        $this->reloadly = $reloadly;
    }

    /**
     * Send data bundle (e.g., POST /api/topup-data).
     */
    public function sendData(Request $request) // Remove : JsonResponse here
    {

       
        $request->validate([
            'recipient_phone' => 'required|string', // e.g., '233540903921'
            'recipient_country' => 'required|string', // e.g., 'GH'
            'amount' => 'required|numeric', // e.g., 4160 for ~$10 USD
            'operator_id' => 'required',
            'plan_points' => 'required|integer|min:1',
            'plan_data' => 'required|string',
        ]);

         Log::info('Form data received', [
        'recipient_phone'   => $request->recipient_phone,
        'recipient_country' => $request->recipient_country,
        'amount'            => $request->amount,
        'operator_id'       => $request->operator_id,
        'plan_points'       => $request->plan_points,
    ]);

        // Auto-detect operator if not provided
        $operator = null;
        if (!$request->operator_id) {
            $operator = $this->reloadly->detectOperator(
                $request->recipient_phone,
                $request->recipient_country
            );
            if (!$operator) {
                return redirect()->back()->with('error', 'No data-enabled operator found');
            }
        }

        $number = "540273192";
        $countryCode = $request->input('country_code');

        $payload = [
            #'operatorId' => (int) ($request->operator_id ?? $operator['id']),
            'operatorId' => $request->operator_id,
            #'amount' => (float) $request->amount * 100,
            'amount' => $request->amount,
            'useLocalAmount' => false,
            'customIdentifier' => 'readify-' . uniqid(),
            'recipientPhone' => [
                'countryCode' => $countryCode,
                'number' => $request->recipient_phone,
            ],
            'senderPhone' => [
                'countryCode' => 'GH',
                'number' => $number,
            ],
        ];

        $result = $this->reloadly->sendDataBundle($payload);
        $user = auth()->user();
         $credit = CreditModel::where('user_id', $user->id)->first();
        if ($result) {
            // Deduct from user's points balance
            if ($user->referred_by) {
                $referrer = User::where('account_id', $user->referred_by)->first(); // Using account_id
                if ($referrer) {
                    // Deduct points from the referred user's credit
                    $credit->credit -= $planPoints ; // Deduct plan points ;  
                    $credit->save();

                                     // Log the credit deduction
                                        \Log::info('Credit deducted from referrer', [
                                            'user_id'        => $referrer->id,
                                            'deducted_points'=> $planPoints,
                                            'remaining_credit'=> $credit->credit,
                                            'action'         => 'referral_credit_deduction',
                                            'timestamp'      => now(),
                                        ]);

                    // Credit 10 points to the referrer
                    $referrerCredit = CreditModel::where('user_id', $referrer->id)->first();
                    if ($referrerCredit) {
                        $referrerCredit->credit += 30;
                        $referrerCredit->save();
                    }

                    // Update referral earnings in the referrals table
                    $referral = Referral::where('referred_user_id', $user->id)->first();
                    if ($referral) {
                        $referral->referral_earnings += 30;
                        $referral->save();
                    }

			/*
                    PaymentRequests::create([
                     #'user_id' => $request->user_id,
                    'user_id' => $user->id, 
                    'amount' => $request->amount - 1.00,
                    ]);

                    // Deduct the requested amount from the user's credit
                    $credit->credit -= $request->amount;
                    $credit->save();

                    $credit->credit += 1;
                    $credit->save();
			
			*/
                  
                }
            }

            if(!$user->referred_by){

    
    // Save the request to the database
    /*PaymentRequests::create([
        
        'user_id' => $user->id, 
        'amount' => $request->amount,
        
       
        
    ]); */

    $planPoints = $request->plan_points;

    // Deduct the requested amount from the user's credit
                    $credit->credit -= $planPoints; // Deduct plan points + 10 bonus points;  
                    $credit->save();
    }
                // Log the successful top-up in payment_requests table
                PaymentRequests::create([
                    'user_id' => $user->id,
                    'recipient_phone' => $request->recipient_phone,
                    'amount' => $request->plan_data,
                    'custom_identifier' => 'readify-' . uniqid(),
                    'status' => 'success',
                ]);



            return redirect()->back()->with('success', 'Topup successful!');
        }

        return redirect()->back()->with('error', 'Topup failed. Try again later.');
    }

    public function choose()
    {
        $users = Auth::user();       
        $credit = DB::table('credit')
                 ->where('user_id',$users->id)
                 ->first();
        switch($users->country){
            case 'GH':
        }

        return view('user.choose',compact('credit'));
    }


    public function showWithdrawForm()
    {
        $users = Auth::user();       
        $credit = DB::table('credit')
                 ->where('user_id',$users->id)
                 ->first(); 

      

        switch ($users->country) {
                
                case 'GH':
                    return view('user.withdraw.ghana', compact('credit'));

                case 'NG':
                    return view('user.withdraw.nigeria', compact('credit'));

                case 'KE':
                    return view('user.withdraw.kenya', compact('credit'));

                case 'TZ':
                    return view('user.withdraw.tanzania', compact('credit'));

                case 'ET':
                    return view('user.withdraw.ethiopia', compact('credit'));

                case 'UG':
                    return view('user.withdraw.uganda', compact('credit'));

                case 'CI':
                    return view('user.withdraw.ivorycoast', compact('credit'));

                case 'EG':
                    return view('user.withdraw.egypt', compact('credit'));
                
                default:
                    return view('user.withdraw.default', compact('credit'));
            }

    }
}