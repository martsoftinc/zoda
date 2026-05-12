<?php

namespace App\Http\Controllers;

use App\Models\NigeriaBankWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NigeriaBankController extends Controller
{
    protected const MIN_WITHDRAWAL = 1000;

    protected const VALID_BANKS = [
        'access_bank', 'citibank', 'ecobank', 'fidelity_bank', 'first_bank',
        'fcmb', 'gtbank', 'heritage_bank', 'keystone_bank', 'kuda_bank',
        'moniepoint', 'opay', 'palmpay', 'polaris_bank', 'providus_bank',
        'stanbic_ibtc', 'standard_chartered', 'sterling_bank', 'uba',
        'union_bank', 'unity_bank', 'wema_bank', 'zenith_bank',
    ];

    /**
     * Show the Nigeria bank transfer withdrawal form.
     */
    public function index()
    {
    $users = Auth::user();       
    $credit = DB::table('credit')
             ->where('user_id', $users->id)
             ->first();
    
    // Check if user is from Ghana (GH)
    if ($users->country !== 'NG') {
        return redirect()->to('/choose')->with('error', 'This page is only available for users in Nigeria');
    }
    
    return view("user.redeemcash.Nigeria", compact('credit'));
    }

    /**
     * Validate, deduct credit, and store the withdrawal request —
     * all inside a single database transaction.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        // ── 1. Fetch current balance (lock to prevent race conditions) ────
        $credit  = DB::table('credit')
            ->where('user_id', $user->id)
            ->lockForUpdate()
            ->first();

        $balance = (float) ($credit->credit ?? 0);

        // ── 2. Validate ───────────────────────────────────────────────────
        $validated = $request->validate([
            'bank_name'      => ['required', 'in:' . implode(',', self::VALID_BANKS)],
            'account_number' => ['required', 'digits:10'],
            'account_name'   => ['required', 'string', 'max:255'],
            'amount'         => [
                'required',
                'numeric',
                'min:' . self::MIN_WITHDRAWAL,
                function ($attribute, $value, $fail) use ($balance) {
                    if ((float) $value > $balance) {
                        $fail('The withdrawal amount exceeds your available balance of ₦' . number_format($balance, 2) . '.');
                    }
                },
            ],
            'terms' => ['accepted'],
        ], [
            'bank_name.required'      => 'Please select your bank.',
            'bank_name.in'            => 'The selected bank is not supported.',
            'account_number.required' => 'Please enter your account number.',
            'account_number.digits'   => 'Account number must be exactly 10 digits.',
            'account_name.required'   => 'Please enter your account name.',
            'amount.required'         => 'Please enter a withdrawal amount.',
            'amount.numeric'          => 'Amount must be a valid number.',
            'amount.min'              => 'Minimum withdrawal amount is ₦1,000.',
            'terms.accepted'          => 'You must accept the terms before withdrawing.',
        ]);

        $amount = (float) $validated['amount'];

        // ── 3. Deduct credit and store withdrawal atomically ──────────────
        DB::transaction(function () use ($user, $validated, $amount) {

            // 3a. Deduct from credit table
            DB::table('credit')
                ->where('user_id', $user->id)
                ->decrement('credit', $amount);

            // 3b. Store the withdrawal record
            NigeriaBankWithdrawal::create([
                'user_id'        => $user->id,
                'bank_name'      => $validated['bank_name'],
                'account_number' => $validated['account_number'],
                'account_name'   => $validated['account_name'],
                'amount'         => $amount,
                'status'         => 'pending',
            ]);
        });

        return redirect()->route('bank.nigeria.index')
            ->with('success', 'Withdrawal request of ₦' . number_format($amount, 2) . ' submitted successfully! It will be processed within 24–48 hours.');
    }
}