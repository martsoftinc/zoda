<?php

namespace App\Http\Controllers;

use App\Models\MpesaWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MpesaController extends Controller
{
    /**
     * Show the M-Pesa withdrawal form.
     */
    public function index()
    {
    $users = Auth::user();       
    $credit = DB::table('credit')
             ->where('user_id', $users->id)
             ->first();
    
    // Check if user is from Ghana (GH)
    if ($users->country !== 'KE') {
        return redirect()->to('/choose')->with('error', 'This page is only available for users in Kenya');
    }
    
    return view("user.redeemcash.kenya", compact('credit'));
    }

    /**
     * Validate, deduct credit, and store the withdrawal request —
     * all inside a single database transaction.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        // ── 1. Fetch current balance (lock row to prevent race conditions) ──
        $credit  = DB::table('credit')
            ->where('user_id', $user->id)
            ->lockForUpdate()
            ->first();

        $balance = (float) ($credit->credit ?? 0);

        // ── 2. Validate input ─────────────────────────────────────────────
        $validated = $request->validate([
            'phone'  => ['required', 'string', 'regex:/^\d{3}\s?\d{3}\s?\d{3}$/'],
            'name'   => ['required', 'string', 'max:255'],
            'amount' => [
                'required',
                'numeric',
                'min:100',
                function ($attribute, $value, $fail) use ($balance) {
                    if ((float) $value > $balance) {
                        $fail('The withdrawal amount exceeds your available balance of KSH ' . number_format($balance, 2) . '.');
                    }
                },
            ],
            'terms'  => ['accepted'],
        ], [
            'phone.required'  => 'Please enter your M-Pesa phone number.',
            'phone.regex'     => 'Phone number must be 9 digits (e.g. 712 345 678).',
            'name.required'   => 'Please enter your full name.',
            'amount.required' => 'Please enter a withdrawal amount.',
            'amount.numeric'  => 'Amount must be a valid number.',
            'amount.min'      => 'Minimum withdrawal amount is KSH 100.',
            'terms.accepted'  => 'You must accept the terms before withdrawing.',
        ]);

        $amount = (float) $validated['amount'];

        // ── 3. Deduct credit and store withdrawal atomically ──────────────
        DB::transaction(function () use ($user, $validated, $amount) {

            // 3a. Deduct from credit table
            DB::table('credit')
                ->where('user_id', $user->id)
                ->decrement('credit', $amount);

            // 3b. Store the withdrawal record
            MpesaWithdrawal::create([
                'user_id' => $user->id,
                'phone'   => preg_replace('/\s+/', '', $validated['phone']),
                'name'    => $validated['name'],
                'amount'  => $amount,
                'status'  => 'pending',
            ]);
        });

        return redirect()->route('mpesa.index')
            ->with('success', 'Withdrawal request of KSH ' . number_format($amount, 2) . ' submitted successfully! It will be processed within 24–48 hours.');
    }
}