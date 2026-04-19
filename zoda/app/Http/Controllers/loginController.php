<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\PaymentSettingsModal;
use App\Models\BalanceModel;
use App\Models\CreditModel;
use App\Models\Referral;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;




class loginController extends Controller
{
    //

    public function loginPage(){
        return view('login');
    }

    public function signupAdvertiser(){
        return view('registeradv');
    }
    public function signupPublisher(){
        return view('registerpub');
    }


    
   
    /* Old login code
    public function login(Request $request) 
    {
        
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'cf-turnstile-response' => ['required', 'turnstile'],

        ]);
        $credentials = $request->only('email','password');
       
        if (Auth::attempt($credentials)) 
        {
        $user = Auth::user(); // Get the authenticated user

            // Invalidate any previous sessions for this user
        $this->invalidatePreviousSessions($user->id);

        // Update the session with the new user session
        Session::put('user_id', $user->id); 

        $userRole = Auth::user()->role;
        
        switch ($userRole) {
            case 'publisher':
                return redirect()->route('publisher');
                break;
            case 'advertiser':
                return redirect()->route('advertiser');
                break;
            case 'suspended':
                return redirect()->route('suspended');
                break  ;  
            // Add more cases for other roles as needed
            default:
                return redirect()->route('login');
        }
            
           
        }
       
        return back()->with('loginError', 'Invalid username or password, you can reset your password if forgotten', );
       
    } 
    */

    // New login code
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        #'cf-turnstile-response' => ['required', 'turnstile'],
    ]);

    $credentials = $request->only('email', 'password');
    $ipAddress = $request->ip(); // Get the client's IP address

    if (Auth::attempt($credentials)) {
        $user = Auth::user(); // Get the authenticated user

        // Check if another user is logged in from the same IP
        $existingSession = DB::table('sessions')
            ->where('ip_address', $ipAddress)
            ->where('user_id', '!=', $user->id) // Exclude the current user
            ->where('last_activity', '>=', now()->subMinutes(30)->timestamp) // Check for recent sessions
            ->first();

        if ($existingSession) {
            // Another user is logged in from this IP
            return back()->with('loginError', 'This IP address is already in use by another account, only one unique IP address is permitted per user. If you are on shared Wi-Fi, switch to mobile data to change your IP. If you are on mobile, turn off your data and then turn it back on to change your IP.');
        }

        // Invalidate any previous sessions for this user
        $this->invalidatePreviousSessions($user->id);

        // Update the session with the new user session
        Session::put('user_id', $user->id);

        // Laravel automatically stores the session in the `sessions` table if using the database driver
        // No need to manually insert a session record here

        $userRole = $user->role;

        switch ($userRole) {
            case 'publisher':
                return redirect()->route('publisher');
                break;
            case 'advertiser':
                return redirect()->route('advertiser');
                break;
            case 'suspended':
                return redirect()->route('suspended');
                break;
            default:
                return redirect()->route('login');
        }
    }

    return back()->with('loginError', 'Invalid username or password. You can reset your password if forgotten.');
}


   
    // Create user account
    public function createUser(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'country' => 'required|string|max:255',
        'referral_code' => 'nullable|exists:users,account_id',
        /*
        'interest1' => 'required|string|max:255',
        'interest2' => 'required|string|max:255',
        'interest3' => 'required|string|max:255',
        */
        'phone' => 'required|string|max:255', 
        'password' => 'required|string|min:8|confirmed',
        'cf-turnstile-response' => ['required', 'turnstile'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    $role = 'publisher';
    $status = 'unverified';
    
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'country'=> $request->input('country'),
        'phone'=> $request->input('phone'),
        'age_group'=> $request->input('age_group'),
        'gender'=> $request->input('gender'),
        #'interest1' => $request->input('interest1'),
        #'interest2' => $request->input('interest2'),
        #'interest3' => $request->input('interest3'),
        #'phone' => $request->input('phone'),
        'status'=> $status,
        'role'=> $role,
        'password' => \Hash::make($request->input('password')),
    ]);

    if ($request->has('referral_code')) {
        // Get the referring user based on the referral code (account number)
        $referrer = User::where('account_id', $request->input('referral_code'))->first();

        if ($referrer) {
            // Save the referrer's account number in the referred user record
            $user->referred_by = $referrer->account_id;
            $user->save();

            // Optionally, store the referral in a referrals table (if tracking referrals)
            Referral::create([
                'referrer_id' => $referrer->id,       // ID of the referrer
                'referred_user_id' => $user->id,      // ID of the referred user
            ]);
        }
    }

    CreditModel::create([
        'user_id' => $user->id,
        'credit' => 0.00,
    ]);
    PaymentSettingsModal::create([
        'user_id' => $user->id,
        'method' => 'add your payment method here',
        'details' => 'add details here',
        
    ]);

    return redirect()->route('login')->with('success', 'You have successfully registered, login to start earning!');
}




// Create advertiser account
public function createAdvertiser(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'country' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    $role = 'advertiser';
    $age = '18-24';
    $gender = "male";
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'country' => $request->input('country'),
        'role'=> $role,
        'gender'=> $gender,
        'age_group'=> $age,
        'password' => \Hash::make($request->input('password')),
    ]);
    
    BalanceModel::create([
        'user_id' => $user->id,
        'balance' => 0.00,
    ]);

    return redirect()->route('login')->with('status', 'User registered successfully!');
}

private function invalidatePreviousSessions($userId)
{
    // Get the session ID associated with the current session
    $currentSessionId = session()->getId();

    // Delete all sessions for this user except the current one
    DB::table('sessions')
        ->where('user_id', $userId)
        ->where('id', '!=', $currentSessionId)
        ->delete();
}

// show the password request page
public function showResetForm(Request $request){
        $token = $request->route('token');
        return view('requestnewpassword', ['token' => $token]);
           
        } 

// send password reset token
public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('resetpassword')->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        $token = Str::random(60);
       
         // Insert token into password_reset_tokens table
    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $user->email],
        ['token' => $token, 'created_at' => now()]
    );


        //Mail::send('emails.passwordreset', ['user' => $user, 'token' => $token], function ($message) use ($user) {
            //$message->to($user->email)->subject('Reset Your Password');
        //});

         Mail::to($user->email)->queue(new PasswordResetMail($user, $token));

        return back()->with('success', 'We have emailed your password reset link!');
    }


//Old reset code 
/*

    public function reset(Request $request)
{
    
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'token' => 'required'
    ]);
    \Illuminate\Support\Facades\Log::info('Reset request data:', $request->except('password', 'token'));

    dd($request->all());
    Log::info('This is a test log message.');

      \Log::info('Reset request data:', [
    'email' => $request->input('email'),
    'token' => substr($request->input('token'), 0, 3) . '****'
]);

    // Fetch the token from the password_reset_tokens table
    $passwordReset = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->first();
    
    if (!$passwordReset) {
       
        return back()->withErrors(['email' => 'No password reset request found for this email.']);
    }
    

    // Verify the token and its expiry (assuming expiry time is 60 minutes)
    if (!hash_equals($passwordReset->token, hash('sha256', $request->token)) || Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
        return back()->withErrors(['token' => 'Invalid or expired token.']);
    }

    // Reset password
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return back()->withErrors(['email' => 'We could not find a user with that email address.']);
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // Remove the token entry after successful reset
    DB::table('password_reset_tokens')->where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Your password has been reset!');
}
*/

// New reset code

public function reset(Request $request)
{
    // Validate only the password and token
    $request->validate([
        'password' => 'required',
        'token' => 'required'
    ]);

    // Fetch the token from the password_reset_tokens table using the token itself
    $passwordReset = DB::table('password_reset_tokens')
        ->where('token', $request->token)// Match the hashed token
        ->first();

    if (!$passwordReset) {
        return back()->withErrors(['token' => 'Invalid token.']);
    }

    // Check token expiry (assuming 60 minutes)
    if (Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
        return back()->withErrors(['token' => 'Expired token.']);
    }

    // Get the user by the email stored with the token
    $user = User::where('email', $passwordReset->email)->first();
    if (!$user) {
        return back()->withErrors(['email' => 'We could not find a user with that email address.']);
    }

    // Update the password
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // Delete the token after successful reset
    DB::table('password_reset_tokens')
        ->where('email', $passwordReset->email)
        ->delete();

    return redirect()->route('login')->with('success', 'Your password has been reset!');
}


    public function showResetPage(Request $request){
            $token = $request->route('token');
        
        return view('newpassword', ['token' => $token]);
           
        } 


}