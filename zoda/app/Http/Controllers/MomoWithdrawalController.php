<?php

namespace App\Http\Controllers;

use App\Models\MomoWithdrawal;
use App\Models\CreditModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MomoWithdrawalController extends Controller
{
    
   public function store(Request $request)
    {
        $user = Auth::user();
 
        // ── 1. Fetch current balance ─────────────────────────────
        $credit = DB::table('credit')
            ->where('user_id', $user->id)
            ->lockForUpdate()   // prevent race conditions
            ->first();
 
        $balance = (float) ($credit->credit ?? 0);
 
        // ── 2. Validate input ────────────────────────────────────
        $validated = $request->validate([
            'network' => ['required', 'in:mtn,tigo,telecel'],
            'phone'   => ['required', 'string', 'regex:/^\d{2}\s?\d{3}\s?\d{4}$/'],
            'name'    => ['required', 'string', 'max:255'],
            'amount'  => [
                'required',
                'numeric',
                'min:30',
                function ($attribute, $value, $fail) use ($balance) {
                    if ((float) $value > $balance) {
                        $fail('The withdrawal amount exceeds your available balance of GHS ' . number_format($balance, 2) . '.');
                    }
                },
            ],
            'terms'   => ['accepted'],
        ], [
            'network.required' => 'Please select a network provider.',
            'network.in'       => 'Invalid network provider selected.',
            'phone.required'   => 'Please enter your phone number.',
            'phone.regex'      => 'Phone number must be 9 digits (e.g. 24 123 4567).',
            'name.required'    => 'Please enter your full name.',
            'amount.required'  => 'Please enter a withdrawal amount.',
            'amount.numeric'   => 'Amount must be a valid number.',
            'amount.min'       => 'Minimum withdrawal amount is GHS 30.',
            'terms.accepted'   => 'You must accept the terms before withdrawing.',
        ]);
 
        $amount = (float) $validated['amount'];
 
        // ── 3. Wrap everything in a transaction ──────────────────
        DB::transaction(function () use ($user, $validated, $amount, $credit) {
 
            // 3a. Deduct from credit table
            DB::table('credit')
                ->where('user_id', $user->id)
                ->decrement('credit', $amount);
 
            // 3b. Store the withdrawal record
            MomoWithdrawal::create([
                'user_id' => $user->id,
                'network' => $validated['network'],
                'phone'   => preg_replace('/\s+/', '', $validated['phone']), // strip spaces
                'name'    => $validated['name'],
                'amount'  => $amount,
                'status'  => 'pending',
            ]);
        });
 
        return redirect()->route('payments')
            ->with('success', 'Withdrawal request of GHS ' . number_format($amount, 2) . ' submitted successfully! It will be processed within 24–48 hours.');
    }


    /**
     * Show withdrawal success page.
     */
    public function success($id)
    {
        $withdrawal = MomoWithdrawal::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('user.momo-success', compact('withdrawal'));
    }

    /**
     * Show user's withdrawal history.
     */
    public function history()
    {
        $withdrawals = MomoWithdrawal::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.momo-history', compact('withdrawals'));
    }

    /**
     * Check withdrawal status.
     */
    public function status($id)
    {
        $withdrawal = MomoWithdrawal::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return response()->json([
            'status' => $withdrawal->status,
            'transaction_id' => $withdrawal->transaction_id ?? 'Not available yet',
            'amount' => $withdrawal->amount,
            'created_at' => $withdrawal->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $withdrawal->updated_at->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Cancel pending withdrawal (if needed).
     */
    public function cancel($id)
    {
        $withdrawal = MomoWithdrawal::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        DB::beginTransaction();

        try {
            // Update withdrawal status
            $withdrawal->status = 'cancelled';
            $withdrawal->save();

            // Refund points
            $credit = Credit::where('user_id', auth()->id())->first();
            if ($credit) {
                $credit->credit += $withdrawal->points_required;
                $credit->save();
            }

            DB::commit();

            return redirect()->route('momo.history')
                ->with('success', 'Withdrawal request has been cancelled and points refunded.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->with('error', 'Failed to cancel withdrawal. Please try again.');
        }
    }

    /**
     * Track withdrawal by reference (for users to check status)
     */
    public function track(Request $request)
    {
        $request->validate([
            'transaction_id' => 'nullable|string',
            'phone' => 'nullable|string'
        ]);

        $query = MomoWithdrawal::where('user_id', auth()->id());

        if ($request->transaction_id) {
            $query->where('transaction_id', $request->transaction_id);
        } elseif ($request->phone) {
            $query->where('phone_number', $request->phone);
        } else {
            return back()->with('error', 'Please provide transaction ID or phone number.');
        }

        $withdrawal = $query->first();

        if (!$withdrawal) {
            return back()->with('error', 'No withdrawal found with the provided information.');
        }

        return view('user.momo-track', compact('withdrawal'));
    }
}