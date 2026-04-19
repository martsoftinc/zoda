<?php

namespace App\Http\Controllers;

use App\Models\BinanceWithdrawal;
use App\Models\CreditModel; // or Credit if that's your model name
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BinanceWithdrawalController extends Controller
{
    /**
     * Show the Binance withdrawal form.
     */
    public function index()
    {
        // Check if user is NOT from Ghana (Binance for non-Ghana users)
        if (auth()->user()->country == 'GH') {
            return redirect()->route('choose')->with('error', 'Binance is available for non-Ghanaian users.');
        }

        // Get user's credits from credit table
        $credit = CreditModel::where('user_id', auth()->id())->first();
        $userPoints = $credit ? $credit->credit : 0;
        
        return view('user.redeemcash.binance', [
            'userPoints' => $userPoints
        ]);
    }

    /**
     * Process the Binance withdrawal request.
     */
    public function store(Request $request)
    {
        // Check if user is NOT from Ghana
        if (auth()->user()->country == 'GH') {
            return redirect()->route('redeem')->with('error', 'Binance is available for non-Ghanaian users.');
        }

        try {
            // Validate the request
            $validated = $request->validate([
                'binance_id' => 'required|string|max:50',
                'amount' => 'required|numeric|in:10,15,20,25,30,40,50',
                'points_required' => 'required|integer|in:30000,45000,60000,75000,90000,120000,150000',
                'terms' => 'required|accepted'
            ]);

            // Get user's credits
            $userId = auth()->id();
            $credit = CreditModel::where('user_id', $userId)->first();
            
            if (!$credit) {
                return back()->with('error', 'No credit record found. Please contact support.')->withInput();
            }
            
            $userPoints = $credit->credit;
            $pointsRequired = (int)$validated['points_required'];
            
            // Check if user has enough points
            if ($userPoints < $pointsRequired) {
                return back()->with('error', 'Insufficient points. You have ' . number_format($userPoints) . ' points but need ' . number_format($pointsRequired) . ' points.')->withInput();
            }

            // Begin database transaction
            DB::beginTransaction();

            try {
                // Create withdrawal record
                $withdrawal = BinanceWithdrawal::create([
                    'user_id' => $userId,
                    'transaction_id' => null, // Will be filled by admin when payment is sent
                    'binance_id' => $validated['binance_id'],
                    'amount' => $validated['amount'],
                    'points_required' => $pointsRequired,
                    'status' => 'pending'
                ]);

                // Deduct points from user's credit
                $credit->credit = $credit->credit - $pointsRequired;
                $credit->save();

                DB::commit();

                return redirect()->route('binance', ['id' => $withdrawal->id])
                    ->with('success', 'Your Binance withdrawal request has been submitted successfully. USDT will be sent within 24-48 hours.Track payment status in your history.');

            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Binance withdrawal failed: ' . $e->getMessage());
                
                return back()->with('error', 'Transaction failed. Please try again.')->withInput();
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Show withdrawal success page.
     */
    public function success($id)
    {
        $withdrawal = BinanceWithdrawal::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('user.binance-success', compact('withdrawal'));
    }

    /**
     * Show user's withdrawal history.
     */
    public function history()
    {
        $withdrawals = BinanceWithdrawal::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.binance-history', compact('withdrawals'));
    }

    /**
     * Check withdrawal status (AJAX).
     */
    public function status($id)
    {
        $withdrawal = BinanceWithdrawal::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return response()->json([
            'status' => $withdrawal->status,
            'transaction_id' => $withdrawal->transaction_id ?? 'Not available yet',
            'amount' => $withdrawal->amount,
            'binance_id' => $withdrawal->binance_id,
            'created_at' => $withdrawal->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $withdrawal->updated_at->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Cancel pending withdrawal (if needed).
     */
    public function cancel($id)
    {
        $withdrawal = BinanceWithdrawal::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        DB::beginTransaction();

        try {
            // Update withdrawal status
            $withdrawal->status = 'cancelled';
            $withdrawal->save();

            // Refund points
            $credit = CreditModel::where('user_id', auth()->id())->first();
            if ($credit) {
                $credit->credit += $withdrawal->points_required;
                $credit->save();
            }

            DB::commit();

            return redirect()->route('binance.history')
                ->with('success', 'Withdrawal request has been cancelled and points refunded.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->with('error', 'Failed to cancel withdrawal. Please try again.');
        }
    }
}