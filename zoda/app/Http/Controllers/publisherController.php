<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\CodeMail;
use Illuminate\Support\Facades\Hash;
use App\Models\campaignModel;
use App\Models\ClicksModel;
use App\Models\CreditModel;
use App\Models\Referral;
use App\Models\Country;
use App\Models\PaymentRequests;
use Intervention\Image\Facades\Image;
use App\Models\PaymentSettingsModal;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Log;

class publisherController extends Controller
{
    //
    public function publisherDashboard()
    {
       
          $userId = auth()->id();

        //Campaign Serving Logic
$countryCode = request()->header('CF-IPCountry');
$gender = Auth::user()->gender;
$age_group = Auth::user()->age_group;



 $completedCampaignIds = DB::table('clicks')
    ->where('user_id', Auth::id())
    ->whereNotNull('completed_at')
    ->where('completed_at', '>', now()->subHours(24))
    ->pluck('campaign_id')                    // ← 10-digit numbers
    ->toArray();

$today = now()->format('Y-m-d');

$tasks = campaignModel::query()
    ->select('campaigns.*', 'balance.balance')
    ->whereNotIn('campaigns.campaign_id', $completedCampaignIds)   // ← important!
    ->whereHas('countries', function($q) use ($countryCode) {
        $q->where('code', $countryCode);
    })
    ->where(function($q) use ($gender) {
        $q->where('gender', $gender)->orWhere('gender', 'all');
    })
    ->where(function($q) use ($age_group) {
        $q->where('age_group', $age_group)->orWhere('age_group', 'all');
    })
    ->join('balance', 'campaigns.user_id', '=', 'balance.user_id')
    ->where('balance.balance', '>', 1)
    ->where(function($q) {
        $q->where('end_date', '>', now())->orWhereNull('end_date');
    })
    ->whereRaw('COALESCE((
        SELECT SUM(cost) 
        FROM clicks 
        WHERE clicks.campaign_id = campaigns.campaign_id 
          AND DATE(clicks.created_at) = ?
    ), 0) < daily_budget', [$today])
    ->where('status', 'Active')
    ->orderByDesc('cpc')
    ->inRandomOrder()
    ->limit(5)
    ->get();

  


foreach ($tasks as $task) {
    // Generate a random token
    $token = Str::random(32);
    
    // Set token expiration (e.g., 1 hour)
    $expiresAt = Carbon::now()->addHour();
    
    // Check if $task is an object
    if (is_object($task)) {
        // If it's an object, use appropriate property
        $campaignIdentifier = $task->campaign_id ?? $task->id;
    } else {
        // If it's not an object, use it directly
        $campaignIdentifier = $task;
    }
    
    // Fetch the correct campaign 
    $campaign = DB::table('campaigns')
                  ->where('campaign_id', $campaignIdentifier)
                  ->first();
   

    if ($campaign) {
        // Store the token in the database
        DB::table('links_tokens')->insert([
            'user_id' => $userId,
            'task_id' => $campaign->id, // The primary key from campaigns table
            'token' => $token,
            'expires_at' => $expiresAt,
            'used' => false,
        ]);
        
        // Attach the token to the task object for use in the Blade view
        if (is_object($task)) {
            $task->token = $token;
        }
    }
}

        // Fetch users credit
        $users = Auth::user();               
        $credit = DB::table('credit')
                 ->where('user_id',$users->id)
                 ->first(); 

        $withdrawalTable = match ($users->country) {
            'KE'    => 'mpesa_withdrawals',
            'NG'    => 'nigeria_bank_withdrawals',
            'ZA'    => 'south_africa_bank_withdrawals',
            default => 'momo_withdrawal', // GH and fallback
        };
 
            $paid = DB::table($withdrawalTable)
                    ->where('user_id', $users->id)
                    ->where('status', 'completed')
                    ->sum('amount');       
        
        $bonus = Referral::with('referredUser')
                        ->where('referrer_id', $users->id)                      
                        ->sum('referral_earnings');


        
        return view('user.userdashboard',compact('tasks','credit','paid','bonus'));
    }



    // open links
    public function show( Request $request, $id)
    {


         if (session()->has('open_task') && session('open_task') != $id) {
        // Redirect back with error message
        return redirect()->back()
                ->with('error', 'Please complete or close your current task before opening a new one.');
    }

     
       


  
  

         $token = $request->query('token');
         $userId = auth()->id(); // Get the authenticated user's ID

         $tokenRecord = DB::table('links_tokens')
        ->where('user_id', $userId)
        ->where('task_id', $id)
        ->where('token', $token)
        ->where('expires_at', '>', Carbon::now())  
        ->where('used', false)                    
        ->first();

    if (!$tokenRecord) {
        // Token is invalid, expired, or already used
        return redirect()->route('publisher')->with('error', 'Invalid verification code or link expired');
    }

    // Mark the token as used

    try {
        DB::table('links_tokens')
            ->where('id', $tokenRecord->id)
            ->update(['used' => true]);
    } catch (\Exception $e) {
        \Log::error('Failed to mark token as used: ' . $e->getMessage());
        return redirect()->route('publisher')->with('error', 'System error. Please try again.');
    }


        
    // Fetch the job details from the database using the ID
    $task = campaignModel::where('id', $id)->firstOrFail();
   

    // Mark this task as open in the session
    session(['open_task' => $id]);
    return view('user.job',compact('task'));
   
    }
    
    
       public function refreshTaskList(Request $request)
{
    // Clear the open_task session variable
    $request->session()->forget('open_task');

    // Redirect back to the task list with a success message
    return redirect()->route('publisher')->with('success', 'Task list refreshed. You can now open a new task.');
}


    // Verify code and earn rewards
        public function verifyCode(Request $request){
                $request->validate([
                'verificationCode' => 'required|string',
                'cf-turnstile-response' => 'required'
                ]);

            
                
                $response = Http::asForm()->post(
    'https://challenges.cloudflare.com/turnstile/v0/siteverify',
    [
        'secret' => env('TURNSTILE_SECRET_KEY'),
        'response' => $request->input('cf-turnstile-response'),
        'remoteip' => $request->ip(),
    ]
);

$result = $response->json();

if (!($result['success'] ?? false)) {
    return redirect()
        ->route('publisher')
        ->with('error', 'Cloudflare verification failed. Please try again.');
}
            
            $user = Auth::user();

            // Retrieve the user's IP address
            $userIp = $request->ip();

            $jobId = $request->input('id');
            //Log::info('Job ID: ' . $jobId);

            // Retrieve the job entry from the database
            $job = campaignModel::find($jobId);
            //Log::info('Job found: ' . ($job ? 'Yes' : 'No'));



            $clientIp = $request->ip();
            $today = Carbon::now()->toDateString();

            // If the job exists
            if($job) {
                $finalUrl = $job->final_url;
                Log::info('Final URL: ' . $finalUrl);
                
                // Generate the SHA-256 hash
                $combinedString = $job->final_url . $today . $clientIp;
                $generatedHash = hash('sha256', $combinedString);
                
                // Log both values for comparison

                /*
                Log::info('Generated hash: ' . $generatedHash);
                Log::info('Received code: ' . $request->verificationCode);
                Log::info('ip: ' . $clientIp);
                Log::info('date: ' . $today);
                */

                // Compare the generated hash with the provided verification code
                if (hash_equals($generatedHash, $request->verificationCode)) {
                    Log::info('Hash verification successful');
                    
                    // NEW: Check for duplicate completion (prevents resubmission exploit)
            $campaignId = DB::table('campaigns')->where('id', $jobId)->value('campaign_id');
            $existingClick = ClicksModel::where('campaign_id', $campaignId)
                ->where('user_id', $user->id)
                ->whereDate('completed_at', $today)
                ->first();

            if ($existingClick) {
                Log::info('Duplicate submission detected for user ' . $user->id . ' and campaign ' . $campaignId);
                return redirect()->route('publisher')->with('error', 'You have already completed this task today.');
            }
                    
                    DB::beginTransaction(); // Start transaction
                    try {
                        $cpc = DB::table('campaigns')->where('id', $jobId)->value('cpc');
                        Log::info('CPC value: ' . $cpc);

                        #$userearnings = 10;
                        #$adminearnings = $cpc * 0/100;
                        #$advertiserDeduction = 0.00;
                        
                            if ($user->country === 'GH') { // Ghana
                                $userearnings = 0.05;
                            } elseif ($user->country === 'ZA') { // South Africa
                                $userearnings = 0.20;
                            } elseif ($user->country === 'NG') { // Nigeria
                                $userearnings = 10;
                            } elseif ($user->country === 'KE') { // Kenya
                                $userearnings = 1;
                            } 

                           
                           switch ($user->country) {
                                case 'GH': // Ghana
                                    $advertiserDeduction = 0.02;
                                    break;
                                case 'ZA': // South Africa
                                    $advertiserDeduction = 0.04;
                                    break;
                                case 'NG': // Nigeria
                                    $advertiserDeduction = 0.03;
                                    break;
                                case 'KE': // Kenya
                                    $advertiserDeduction = 0.03;
                                    break;
                                    default:
                                    // All other countries
                                    $advertiserDeduction = 0.05;
                                    break;
                            }


                            // Add credit to admin

                            if ($user->country === 'GH') { // Ghana
                                $adminearnings = 0.02;
                            } elseif ($user->country === 'ZA') { // South Africa
                                $adminearnings = 0.04;
                            } elseif ($user->country === 'NG') { // Nigeria
                                $adminearnings = 0.03;
                            } elseif ($user->country === 'KE') { // Kenya
                                $adminearnings = 0.03;
                            }

                        // Add credit to admin
                        DB::table('admincredit')->insert([
                            'credit' => $adminearnings,
                           
                        ]);
                        /*
                        DB::table('admincredit')
                            ->where('id', 1)
                            ->increment('credit', $adminearnings);
                        */
                        // Deduct advertiser account
                        $advertiserId = DB::table('campaigns')->where('id', $jobId)->value('user_id');
                        DB::table('balance')
                            ->where('user_id', $advertiserId)
                            ->decrement('balance', $advertiserDeduction);
                        
                        // Add credit to user
                        DB::table('credit')
                            ->where('user_id', $user->id)
                            ->increment('credit', $userearnings);
                        
                        // Record clicks after successful verification
                        $ipAddress = $request->ip();


                       
                        $campaignId = DB::table('campaigns')->where('id', $jobId)->value('campaign_id');
                       

                        //Log::info('Job ID: ' . $job);
                        //Log::info('Job ID: ' . $campaignId);
                        
                        ClicksModel::create([
                            'campaign_id' => $campaignId,
                            'user_id' => Auth::id(), 
                            'cost' => $advertiserDeduction,
                            'ip_address' => $ipAddress,
                            'completed_at' => now(), 
                        ]);
                        /*
                        $ipAddress = request()->ip();
                        $position = Location::get($ipAddress);
                        

                            if ($position) {
                                $countryCode = $position->countryCode;
                                $country = DB::table('countries')->where('code', $countryCode)->first();
                                
                                ClicksModel::create([
                                    'campaign_id' => $campaignId,
                                    'user_id' => Auth::id(), 
                                    'cost' => $userearnings,
                                    //'ip_address' => $ipAddress,
                                    'completed_at' => now(), 
                                    #'ip_address' => $country ? $country->name : $position->countryName,
                                ]);
                            }
                        */
                        DB::commit();
                        Log::info('Transaction committed successfully');
                        

                        session()->forget('open_task');
                        
                        return redirect()->route('publisher')->with('success', 'Verification successful!, you have earned ' . $userearnings );
                    } catch (\Exception $e) {
                        // If something goes wrong, rollback the transaction
                        //DB::rollBack(); 
                        Log::error('Transaction failed: ' . $e->getMessage());
                        
                        return redirect()->route('publisher')->with('error', 'Transaction failed: ' . $e->getMessage());
                    }
                } else {
                    //Log::warning('Hash verification failed');
                    // Return error if verification code doesn't match
                    return redirect()->route('publisher')->with('error', 'Wrong verification code');
                }
}

// Return to the publisher route if the job does not exist
return redirect()->route('publisher')->with('error', 'Job not found.');
    }


    


 // Update user payment method settings    
public function Payments(){
    $user = Auth::user();
 
    $paymentSettings = PaymentSettingsModal::where('user_id', $user->id)->first();
 
    $user_balance = DB::table('credit')
                    ->where('user_id', $user->id)
                    ->first();
 
    $payment_method = DB::table('payment_method')
                    ->where('user_id', $user->id)
                    ->first();
 
    $payment_requests = DB::table('payment_requests')
                    ->where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);
 
    // ── Withdrawal transactions by country ──────────────────────
 
    $cash_transactions      = collect();
    $cash_stats_total       = 0;
    $cash_stats_pending     = 0;
    $cash_stats_success     = 0;
 
    switch ($user->country) {
 
        case 'GH':
            $table = 'momo_withdrawal';
            break;
 
        case 'KE':
            $table = 'mpesa_withdrawals';
            break;
 
        case 'NG':
            $table = 'nigeria_bank_withdrawals';
            break;
 
        case 'ZA':
            $table = 'south_africa_bank_withdrawals';
            break;
 
        default:
            $table = 'momo_withdrawals';
            break;
    }
 
    $cash_transactions = DB::table($table)
                    ->where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(20, ['*'], 'cash_page');
 
    $cash_stats_total = DB::table($table)
                    ->where('user_id', $user->id)
                    ->sum('amount');
 
    $cash_stats_pending = DB::table($table)
                    ->where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->sum('amount');
 
    $cash_stats_success = DB::table($table)
                    ->where('user_id', $user->id)
                    ->where('status', 'completed')
                    ->sum('amount');
 
    return view('user.payments', compact(
        'cash_stats_total',
        'cash_stats_pending',
        'cash_stats_success',
        'payment_requests',
        'paymentSettings',
        'user_balance',
        'payment_method',
        'cash_transactions',
    ));
}



public function PaymentMethodSettings(Request $request)
    {
        // Validate the request data
        $request->validate([
            'method' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            
        ]);

        $user = Auth::user();

        // Create or update the payment settings
        PaymentSettingsModal::updateOrCreate(
            ['user_id' => $user->id], // Match the settings by user ID
            [
                'method' => $request->input('method'),
                'details' => $request->input('details'),
                
            ]
        );
       return redirect()->route('payment-settings.get')->with('success', 'Payment settings updated!');
    }

public function Profile(){
    return view('user.profile');
}





public function requestPayment(Request $request)
{
    DB::beginTransaction();
    try {

        $user = auth()->user();

    // Fetch the user's credit record
    $credit = CreditModel::where('user_id', $user->id)->first();

    // Check if the user has enough credit
    if (!$credit || $credit->credit < $request->amount) {
        return back()->withErrors('Insufficient credit');
    }

    $request->validate([
        #'amount' => 'required|numeric|min:50|max:' . auth()->user()->balance,
        'amount' => 'required',
    ]);

    // Check if the user meets the minimum balance for cashout ($50 in this case)
        
            if ($user->referred_by) {
                $referrer = User::where('account_id', $user->referred_by)->first(); // Using account_id
                if ($referrer) {
                    // Deduct $1 from the referred user's credit
                    $credit->credit -= 1;  
                    $credit->save();

                    // Credit $1 to the referrer
                    $referrerCredit = CreditModel::where('user_id', $referrer->id)->first();
                    if ($referrerCredit) {
                        $referrerCredit->credit += 0.5;
                        $referrerCredit->save();
                    }

                    // Update referral earnings in the referrals table
                    $referral = Referral::where('referred_user_id', $user->id)->first();
                    if ($referral) {
                        $referral->referral_earnings += 0.5;
                        $referral->save();
                    }

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

                  
                }
            }
        

    if(!$user->referred_by){

    
    // Save the request to the database
    PaymentRequests::create([
        #'user_id' => $request->user_id,
        'user_id' => $user->id, 
        'amount' => $request->amount,

       
        
    ]);

    // Deduct the requested amount from the user's credit
    $credit->credit -= $request->amount;
    $credit->save();
    }
    

    // Commit the transaction
    DB::commit();

    // Return a success message or redirect
    return back()->with('success', 'Payment request processed successfully');
} catch (\Exception $e) {
    // Rollback the transaction on error
    DB::rollBack();

    // Handle the error and return an appropriate response
    return back()->withErrors('An error occurred: ' . $e->getMessage());
}

}


public function logout(Request $request)
    {
        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }



public function linkexpired(){
    return view('user.linkexpired');
}

public function sendCode(Request $request)
{
    // Generate a random code
    $code = Str::random(6);

    // Store the code in the session for verification
    Session::put('verification_code', $code);
    Session::put('verification_code_email', $request->user()->email);
    // Send the code to the user's email
    Mail::to($request->user()->email)->queue(new CodeMail($code));

    return response()->json(['message' => 'Verification code sent to your email.']);
}

public function verifyPasswordCode(Request $request)
{
        $inputCode = $request->input('code');
        $storedCode = Session::get('verification_code');
        $storedEmail = Session::get('verification_code_email');

        // Check if the code matches and the email matches the logged-in user
        if ($inputCode === $storedCode && $storedEmail === $request->user()->email) {
            // Code is valid, clear the session value after successful verification
            Session::forget('verification_code');
            Session::put('code_verified', true); // Store a flag indicating successful verification

            return response()->json(['message' => 'Code verified successfully.', 'status' => true]);
        } else {
            return response()->json(['message' => 'Invalid code.', 'status' => false]);
        }
    }

 public function updatePassword(Request $request)
    {
        // Check if the code has been verified
        if (!Session::get('code_verified')) {
            return redirect()->back()->with('error', 'You need to verify your code first.');
        }

        // Validate the new password
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Update the password
        $user = $request->user();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Clear the verification flag
        Session::forget('code_verified');

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    

    public function referrals(Request $request)
    {
        $user = auth()->user();
        $referrals = Referral::with('referredUser')
                        ->where('referrer_id', $user->id)
                        
                        ->paginate(50);
        // Check if referrals were found
       //if ($referrals->isEmpty()) {
           //return back()->withErrors('No referrals found for this user.');
           // }  
                       
        $This_Month = Referral::with('referredUser')
        ->where('referrer_id', $user->id)
        ->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),   // From the start of this month
            Carbon::now()->endOfMonth()      // To the end of this month
        ])
        ->count();

        $Last_Month = Referral::with('referredUser')
        ->where('referrer_id', $user->id)
        ->whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(), // From the start of last month
            Carbon::now()->subMonth()->endOfMonth()    // To the end of last month
        ])
        ->count();

        $Total = Referral::with('referredUser')
        ->where('referrer_id', $user->id)
        ->count();


        return view('user.refferals',compact('referrals','This_Month','Last_Month','Total'));
      
    }

    public function redirectToArticle($id)
{
    $task = campaignModel::findOrFail($id);

    // Ensure the landing_page is a complete URL
    $landingPage = $task->landing_page;
    if (!preg_match('/^https?:\/\//', $landingPage)) {
        $landingPage = 'https://' . $landingPage; // add https if missing
    }
    
    // Build the referrer URL, UTM parameters, etc.
    $utmParams = http_build_query([
        'utm_source' => $task->utm_source,
        'utm_medium' => $task->utm_medium,
        'utm_campaign' => $task->utm_campaign,
    ]);

    // Generate referrer URL based on the referrer type
    $referrerUrl = '';
    switch ($task->referrer) {
        case 'google':
            $searchTerms = urlencode($task->search_terms ?? 'example search');
            $referrerUrl = "https://www.google.com/search?q={$searchTerms}&{$utmParams}";
            break;
        case 'facebook':
            $referrerUrl = "https://www.facebook.com/?{$utmParams}";
            break;
        case 'twitter':
            $referrerUrl = "https://twitter.com/?{$utmParams}";
            break;
        case 'pinterest':
            $referrerUrl = "https://www.pinterest.com/?{$utmParams}";
            break;
        case 'reddit':
            $referrerUrl = "https://www.reddit.com/?{$utmParams}";
            break;
        default:
            // Default referrer as Google with generic search if no referrer is provided
            $referrerUrl = "https://www.google.com/search?q=" . urlencode('generic search') . "&{$utmParams}";
            break;
    }

    // Combine landing page with referrer
    //$finalUrl = "{$landingPage}?ref=" . urlencode($referrerUrl);
    $finalUrl = $landingPage;
    // Debug: Log the final URL to make sure it is correct
    \Log::info('Redirecting to URL: ' . $finalUrl);

    // Perform the redirect to the final URL
    return redirect()->away($finalUrl);
}


//Protect link by converting to image

public function clearTaskSession()
{
    session()->forget('open_task');
    
    return response()->json(['success' => true]);
}











}