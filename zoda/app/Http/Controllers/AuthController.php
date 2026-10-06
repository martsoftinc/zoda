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
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{



private function ipConflict(Request $request, User $user): bool
{
    return DB::table('sessions')
        ->where('ip_address', $request->ip())
        ->where('user_id', '!=', $user->id)
        ->whereNotNull('user_id')
        ->where('last_activity', '>=', now()->subMinutes(30)->timestamp)
        ->exists();
}

public function handleGoogleCallback(Request $request)
{
    try {
        $googleUser = Socialite::driver('google')->user();
        $existingUser = User::where('email', $googleUser->email)->first();

        if ($existingUser) {
            // Block BEFORE logging in or touching sessions
            if ($this->ipConflict($request, $existingUser)) {
                return redirect()->route('login')->with('loginError',
                    'This IP address is already in use by another account, due to security risk only one unique IP address is permitted per user. If you are on shared Wi-Fi, switch to mobile data to change your IP. If you are on mobile, turn off your data and then turn it back on to change your IP.');
            }

            $this->invalidateOtherSessions($existingUser);
            Auth::login($existingUser, true);
            $request->session()->regenerate();
            $existingUser->session_id = session()->getId();
            $existingUser->save();

            return redirect()->route('publisher');
        }


         // ---- New user: check the IP BEFORE creating the account ----
        // No user ID exists yet, so check for ANY active session on this IP
        $ipInUse = DB::table('sessions')
            ->where('ip_address', $request->ip())
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', now()->subMinutes(30)->timestamp)
            ->exists();

        if ($ipInUse) {
            return redirect()->route('login')->with('loginError',
                'This IP address is already in use by another account...');
        }


        
        // Create new user
        $role = 'publisher';
        $status = 'unverified';
        $accountId = $this->generateUniqueAccountId();
        
        $user = User::create([
            'name'       => $googleUser->name ?? $googleUser->email,
            'email'      => $googleUser->email,
            'country'    => $request->input('country', 'Not specified'),
            'phone'      => $request->input('phone', 'Not provided'),
            'age_group'  => $request->input('age_group', 'Not specified'),
            'gender'     => $request->input('gender', 'Not specified'),
            'tutorial'   => 'No',
            'status'     => $status,
            'role'       => $role,
            'google_id'  => $googleUser->id,
            'avatar'     => $googleUser->avatar,
            'account_id' => $accountId,
            'password'   => Hash::make(Str::random(16)),
        ]);
        
        // Handle referral
        if (session()->has('referral_code')) {
            $referralCode = session()->get('referral_code');
            $referrer = User::where('account_id', $referralCode)->first();
            
            if ($referrer) {
                $user->referred_by = $referrer->account_id;
                $user->save();
                
                Referral::create([
                    'referrer_id'      => $referrer->id,
                    'referred_user_id' => $user->id,
                ]);
            }
            
            session()->forget('referral_code');
        }
        
        CreditModel::create(['user_id' => $user->id, 'credit' => 0.00]);
        
        PaymentSettingsModal::create([
            'user_id' => $user->id,
            'method'  => 'Not set yet',
            'details' => 'Complete your payment settings',
        ]);
        
        $this->invalidateOtherSessions($user);
        Auth::login($user, true);
        $request->session()->regenerate();
        $user->session_id = session()->getId(); // you had this commented out
        $user->save();
        
        return redirect()->route('profile.complete')->with('success', 'Welcome! Please complete your profile.');
        
    } catch (\Exception $e) {
        \Log::error('Google login error: ' . $e->getMessage());
        return redirect()->route('login')->with('error', 'Google authentication failed.');
    }
}



    private function invalidateOtherSessions(User $user): void
{
    // Laravel stores the user_id as a payload inside the encrypted session blob,
    // BUT the `sessions` table has a dedicated `user_id` column when you run
    // `php artisan session:table` — we use that column for a direct delete.
    DB::table('sessions')
        ->where('user_id', $user->id)
        #->where('id', '!=', $currentSessionId)
        ->delete();
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

public function showTutorialComplete()
{
    return view('user.watchtutorial');
}


public function tutorialComplete()
{
    $user = auth()->user();
    $user->tutorial = 'Yes';
    $user->save();

    return redirect()->route('publisher')->with('success', 'Thank you for completing the tutorial!');

}
}