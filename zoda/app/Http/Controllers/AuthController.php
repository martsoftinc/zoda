<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CreditModel;
use App\Models\PaymentSettingsModal;
use App\Models\Referral;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists by email
            $existingUser = User::where('email', $googleUser->email)->first();
            
            if ($existingUser) {
                // User exists - log them in
                \Auth::login($existingUser, true);
                return redirect()->route('publisher'); // Adjust to your dashboard route
            }
            
            // Create new user using your existing logic structure
            $role = 'publisher';
            $status = 'unverified';
            
            // Generate a unique account_id (if you're using one)
            $accountId = $this->generateUniqueAccountId();
            
            $user = User::create([
                'name' => $googleUser->name ?? $googleUser->email,
                'email' => $googleUser->email,
                'country' => $request->input('country', 'Not specified'), // You might want to ask this later
                'phone' => $request->input('phone', 'Not provided'), // You might want to ask this later
                'age_group' => $request->input('age_group', 'Not specified'),
                'gender' => $request->input('gender', 'Not specified'),
                'status' => $status,
                'role' => $role,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'account_id' => $accountId, // If you use account_id for referrals
                'password' => Hash::make(Str::random(16)), // Random password since Google handles auth
            ]);
            
            // Handle referral if present (you'll need to pass referral code somehow)
            // Option 1: Store referral code in session before redirecting to Google
            if (session()->has('referral_code')) {
                $referralCode = session()->get('referral_code');
                $referrer = User::where('account_id', $referralCode)->first();
                
                if ($referrer) {
                    $user->referred_by = $referrer->account_id;
                    $user->save();
                    
                    Referral::create([
                        'referrer_id' => $referrer->id,
                        'referred_user_id' => $user->id,
                    ]);
                }
                
                // Clear the session
                session()->forget('referral_code');
            }
            
            // Create credits record (matching your existing logic)
            CreditModel::create([
                'user_id' => $user->id,
                'credit' => 0.00,
            ]);
            
            // Create payment settings record (matching your existing logic)
            PaymentSettingsModal::create([
                'user_id' => $user->id,
                'method' => 'Not set yet',
                'details' => 'Complete your payment settings',
            ]);
            
            // Log the user in
            \Auth::login($user, true);
            
            // Redirect to a profile completion page for missing fields
            return redirect()->route('profile.complete')->with('success', 'Welcome! Please complete your profile.');
            
        } catch (\Exception $e) {
        // 1. Log the error to storage/logs/laravel.log
        \Log::error('Google login error: ' . $e->getMessage());

        // 2. TEMPORARY: Show error on screen so you can see why it's failing
        // Remove this line once the error is fixed!
        dd($e->getMessage(), $e->getTraceAsString()); 

        // 3. Redirect the user back with a message
        return redirect()->route('login')->with('error', 'Google authentication failed.');
    }
    }
    
    private function generateUniqueAccountId()
    {
        do {
            $accountId = 'ACC' . strtoupper(Str::random(8));
        } while (User::where('account_id', $accountId)->exists());
        
        return $accountId;
    }


    public function redirectToGoogleWithReferral(Request $request, $referralCode = null)
{
    if ($referralCode) {
        session(['referral_code' => $referralCode]);
    }
    
    return Socialite::driver('google')->redirect();
}

public function showCompleteForm()
{
    return view('registerpub'); 
}

public function completeProfile(Request $request)
{
    $validator = Validator::make($request->all(), [
        'country' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'age_group' => 'required|string',
        'gender' => 'required|string',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    $user = auth()->user();
    $user->update([
        'country' => $request->country,
        'phone' => $request->phone,
        'age_group' => $request->age_group,
        'gender' => $request->gender,
        'status' => 'verified', // Optionally mark as verified now
    ]);
    
    return redirect()->route('publisher')->with('success', 'Profile completed successfully!');
}

}