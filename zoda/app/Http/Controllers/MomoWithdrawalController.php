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
    try {
        // Log all incoming data
        \Log::info('=== MOMO WITHDRAWAL DEBUG ===');
        \Log::info('Request data:', $request->all());
        
        // Validate the request
        $validated = $request->validate([
            'network' => 'required|in:mtn,tigo,telecel',
            'phone' => 'required|string|max:15',
            'name' => 'required|string|max:255',
            
            'amount' => 'required|numeric|min:10',
            'points_required' => 'required|integer|min:2000',
            'terms' => 'required|accepted'
        ]);

        \Log::info('Validation passed', $validated);

        // Get user's current points - with more detailed fetching
        $userId = auth()->id();
        \Log::info('User ID: ' . $userId);
        
        // Try different ways to get the credit
        $credit = CreditModel::where('user_id', $userId)->first();
        
        if (!$credit) {
           // \Log::error('No credit record found for user');
            return back()->with('error', 'No points record found. Please contact support.')->withInput();
        }
        
        
        
        $userPoints = $credit->credit ?? 0;
        $pointsRequired = (int)$validated['points_required'];
        
        

        if ($userPoints < $pointsRequired) {
            return back()->with('error', "Insufficient points. You have " . number_format($userPoints) . " points but need " . number_format($pointsRequired) . " points.")->withInput();
        }

        // Rest of your code...
        DB::beginTransaction();

        try {
            // Create withdrawal record
            $withdrawal = MomoWithdrawal::create([
                'user_id' => $userId,
                'transaction_id' => null,
                'network' => $validated['network'],
                'phone_number' => $validated['phone'],
                'full_name' => $validated['name'],
                'amount' => $validated['amount'],
                'points_required' => $pointsRequired,
                'status' => 'pending'
            ]);

            // \Log::info('Withdrawal created:', ['withdrawal_id' => $withdrawal->id]);

            // Deduct points
            $credit->credit = $credit->credit - $pointsRequired;
            $credit->save();
            
            // \Log::info('Points deducted. New balance:', ['new_balance' => $credit->credit]);

            DB::commit();

            return redirect()->route('momo', ['id' => $withdrawal->id])
                ->with('success', 'Your withdrawal request has been submitted successfully, Check your History page.');

        } catch (\Exception $e) {
            DB::rollBack();
            // \Log::error('Transaction failed: ' . $e->getMessage());
            // \Log::error($e->getTraceAsString());
            
            return back()->with('error', 'Transaction failed: ' . $e->getMessage())->withInput();
        }

    } catch (\Illuminate\Validation\ValidationException $e) {
      //  \Log::error('Validation failed:', $e->errors());
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
       // \Log::error('Unexpected error: ' . $e->getMessage());
       // \Log::error($e->getTraceAsString());
        return back()->with('error', 'An unexpected error occurred. Please try again.')->withInput();
    }
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