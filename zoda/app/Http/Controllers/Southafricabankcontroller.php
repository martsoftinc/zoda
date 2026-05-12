<?php

namespace App\Http\Controllers;

use App\Models\SouthAfricaBankWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SouthAfricaBankController extends Controller
{
    protected const MIN_WITHDRAWAL = 10;

    protected const VALID_BANKS = [
        'absa', 'african_bank', 'bidvest_bank', 'capitec', 'discovery_bank',
        'fnb', 'grindrod_bank', 'investec', 'mercantile_bank', 'nedbank',
        'old_mutual_finance', 'sasfin_bank', 'standard_bank', 'tyme_bank', 'ubank',
    ];

    protected const VALID_ACCOUNT_TYPES = ['cheque', 'savings', 'transmission'];

    /**
     * Show the South Africa bank transfer withdrawal form.
     */
    public function index()
    {
            $users = Auth::user();       
            $credit = DB::table('credit')
             ->where('user_id', $users->id)
             ->first();
    
    // Check if user is from Ghana (GH)
    if ($users->country !== 'ZA') {
        return redirect()->to('/choose')->with('error', 'This page is only available for users in South Africa');
    }
    
    return view("user.redeemcash.southafrica", compact('credit'));
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
            'account_type'   => ['required', 'in:' . implode(',', self::VALID_ACCOUNT_TYPES)],
            'account_number' => ['required', 'digits_between:9,11'],
            'branch_code'    => ['required', 'digits:6'],
            'account_name'   => ['required', 'string', 'max:255'],
            'amount'         => [
                'required',
                'numeric',
                'min:' . self::MIN_WITHDRAWAL,
                function ($attribute, $value, $fail) use ($balance) {
                    if ((float) $value > $balance) {
                        $fail('The withdrawal amount exceeds your available balance of R ' . number_format($balance, 2) . '.');
                    }
                },
            ],
            'terms' => ['accepted'],
        ], [
            'bank_name.required'           => 'Please select your bank.',
            'bank_name.in'                 => 'The selected bank is not supported.',
            'account_type.required'        => 'Please select your account type.',
            'account_type.in'              => 'Invalid account type selected.',
            'account_number.required'      => 'Please enter your account number.',
            'account_number.digits_between'=> 'Account number must be between 9 and 11 digits.',
            'branch_code.required'         => 'Please enter your branch code.',
            'branch_code.digits'           => 'Branch code must be exactly 6 digits.',
            'account_name.required'        => 'Please enter your account holder name.',
            'amount.required'              => 'Please enter a withdrawal amount.',
            'amount.numeric'               => 'Amount must be a valid number.',
            'amount.min'                   => 'Minimum withdrawal amount is R 10.00.',
            'terms.accepted'               => 'You must accept the terms before withdrawing.',
        ]);

        $amount = (float) $validated['amount'];

        // ── 3. Deduct credit and store withdrawal atomically ──────────────
        DB::transaction(function () use ($user, $validated, $amount) {

            // 3a. Deduct from credit table
            DB::table('credit')
                ->where('user_id', $user->id)
                ->decrement('credit', $amount);

            // 3b. Store the withdrawal record
            SouthAfricaBankWithdrawal::create([
                'user_id'        => $user->id,
                'bank_name'      => $validated['bank_name'],
                'account_type'   => $validated['account_type'],
                'account_number' => $validated['account_number'],
                'branch_code'    => $validated['branch_code'],
                'account_name'   => $validated['account_name'],
                'amount'         => $amount,
                'status'         => 'pending',
            ]);
        });

        return redirect()->route('bank.southafrica.index')
            ->with('success', 'Withdrawal request of R ' . number_format($amount, 2) . ' submitted successfully! It will be processed within 24–48 hours.');
    }
}