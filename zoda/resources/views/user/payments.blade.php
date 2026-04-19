@extends('user.layout')
@section('content')

<!-- Header -->
<header class="bg-white dark:bg-gray-800 shadow-md p-4 md:p-6 sticky top-0 z-30">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <!-- Back Button -->
            <a href="{{ route('publisher') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white"> History</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">All your data bundle & cash transactions</p>
            </div>
        </div>
        
        <!-- Refresh Button -->
        <button onclick="location.reload()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
            <i class="fas fa-sync-alt text-gray-600 dark:text-gray-300"></i>
        </button>
    </div>
</header>



<!-- Main Content -->
<main class="p-4 md:p-6">
    

    <!-- Data Purchase History Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Data Transactions</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Your recent data bundle purchases</p>
            </div>
            
            <!-- Date Filter (Optional) 
            <div class="mt-4 md:mt-0">
                <select id="dateFilter" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="all">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                </select>
            </div>-->
        </div>

        @if($payment_requests->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Date & Time</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Plan </th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Status</th>
                            <!-- <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Bundle Type</th> -->
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</th>
                            <!-- <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Transaction ID</th> -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($payment_requests as $request)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="py-4 px-4">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ date("d M Y", strtotime($request->created_at)) }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ date("h:i A", strtotime($request->created_at)) }}
                                        </p>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-coins text-yellow-500 mr-2"></i>
                                        <p class="text-lg font-bold text-primary">{{ $request->amount }} pts</p>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    @if($request->status == 'successful')
                                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-check-circle mr-1"></i> Successful
                                        </span>
                                    @elseif($request->status == 'failed')
                                        <span class="px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-times-circle mr-1"></i> Failed
                                        </span>
                                    @elseif($request->status == 'pending')
                                        <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-clock mr-1"></i> Pending
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-full text-sm font-medium">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    @endif
                                </td>
                                
                                <!-- 
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-wifi text-blue-500 mr-2"></i>
                                        <span>Data Bundle</span>
                                    </div>
                                </td> -->
                                
                                <td class="py-4 px-4">
                                    @if($request->recipient_phone)
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-green-500 mr-2"></i>
                                            <span class="font-mono">{{ $request->recipient_phone }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">N/A</span>
                                    @endif
                                </td>
                            <!--
                                <td class="py-4 px-4">
                                    @if($request->custom_identifier)
                                        <div class="flex items-center">
                                            
                                            <span class="font-mono">{{ $request->custom_identifier }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">N/A</span>
                                    @endif
                                </td>
                                -->
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            
            
            <!-- Pagination -->
            @if($payment_requests->hasPages())
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Showing {{ $payment_requests->firstItem() }} to {{ $payment_requests->lastItem() }} of {{ $payment_requests->total() }} transactions
                    </div>
                    <div class="flex space-x-2">
                        @if($payment_requests->onFirstPage())
                            <span class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-400 cursor-not-allowed">
                                <i class="fas fa-chevron-left mr-1"></i> Previous
                            </span>
                        @else
                            <a href="{{ $payment_requests->previousPageUrl() }}" 
                               class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <i class="fas fa-chevron-left mr-1"></i> Previous
                            </a>
                        @endif
                        
                        @if($payment_requests->hasMorePages())
                            <a href="{{ $payment_requests->nextPageUrl() }}" 
                               class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Next <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        @else
                            <span class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-400 cursor-not-allowed">
                                Next <i class="fas fa-chevron-right ml-1"></i>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                    <i class="fas fa-wifi text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Data Purchases Yet</h3>
                <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto mb-6">
                    You haven't purchased any data bundles yet. When you do, they'll appear here.
                </p>
                <a href="{{ route('data.bundle') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                    <i class="fas fa-plus mr-2"></i>
                    Buy Data Bundle
                </a>
            </div>
        @endif
    </div><br>

    @if(auth()->user()->country == 'GH')
             <!-- Mobile Money/Cash Transactions Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                    <i class="fas fa-mobile-alt text-green-500"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Mobile Money Transactions</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Your cash withdrawal history</p>
                </div>
            </div>
            
            <!-- Optional: New Withdrawal Link -->
            <a href="{{ route('momo') }}" class="text-primary hover:text-primary/80 text-sm font-medium">
                New Withdrawal <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        @if($cash_transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Date & Time</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Network</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Amount</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Points Used</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Status</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</th>
                            <!-- <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Transaction ID</th> -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($cash_transactions as $transaction)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="py-4 px-4">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ date("d M Y", strtotime($transaction->created_at)) }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ date("h:i A", strtotime($transaction->created_at)) }}
                                        </p>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        @if($transaction->network == 'mtn')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm font-medium">MTN</span>
                                        @elseif($transaction->network == 'tigo')
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-medium">Tigo</span>
                                        @elseif($transaction->network == 'telecel')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm font-medium">Telecel</span>
                                        @else
                                            <span class="text-gray-500">{{ ucfirst($transaction->network) }}</span>
                                        @endif
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>
                                        <p class="text-lg font-bold text-green-600">GHS {{ number_format($transaction->amount, 2) }}</p>
                                    </div>
                                </td>

                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-coins text-yellow-500 mr-2"></i>
                                        <p class="font-medium">{{ number_format($transaction->points_required) }} pts</p>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    @if($transaction->status == 'completed')
                                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-check-circle mr-1"></i> Completed
                                        </span>
                                    @elseif($transaction->status == 'failed')
                                        <span class="px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-times-circle mr-1"></i> Failed
                                        </span>
                                    @elseif($transaction->status == 'processing')
                                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-spinner fa-spin mr-1"></i> Processing
                                        </span>
                                    @elseif($transaction->status == 'pending')
                                        <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-clock mr-1"></i> Pending
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-full text-sm font-medium">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-phone text-green-500 mr-2"></i>
                                        <span class="font-mono">+233 {{ $transaction->phone_number }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <i class="fas fa-user mr-1"></i> {{ $transaction->full_name }}
                                    </div>
                                </td>
                            <!--
                                <td class="py-4 px-4">
                                    @if($transaction->transaction_id)
                                        <div class="flex items-center">
                                            <span class="font-mono text-sm bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                                {{ substr($transaction->transaction_id, 0, 8) }}...
                                            </span>
                                            <button onclick="copyToClipboard('{{ $transaction->transaction_id }}')" class="ml-2 text-gray-400 hover:text-primary">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">Pending</span>
                                    @endif
                                </td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Cash Transactions Pagination -->
            @if($cash_transactions->hasPages())
                <div class="mt-6">
                    {{ $cash_transactions->withPath(route('payments'))->appends(['data_page' => request('data_page')])->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto mb-3 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                    <i class="fas fa-mobile-alt text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No Cash Withdrawals Yet</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">You haven't made any mobile money withdrawals.</p>
                @if(auth()->user()->country == 'GH')
                    <a href="{{ route('momo.index') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg text-sm hover:bg-primary/90 transition">
                        <i class="fas fa-plus mr-2"></i>
                        Withdraw Cash
                    </a>
                @endif
            </div>
        @endif
    </div>
    @endif


<!-- Binance Transactions Table - Show ONLY to non-Ghanaian users -->
@if(auth()->user()->country != 'GH')
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mt-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center">
                    <i class="fab fa-binance text-yellow-500"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Binance Transactions</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Your USDT withdrawal history</p>
                </div>
            </div>
            
            <!-- New Withdrawal Link -->
            <a href="{{ route('binance') }}" class="text-yellow-500 hover:text-yellow-600 text-sm font-medium">
                New Withdrawal <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        @if(isset($binance_transactions) && $binance_transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Date & Time</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Binance ID</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Amount</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Points Used</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Status</th>
                            <!-- <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Transaction ID</th> -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($binance_transactions as $transaction)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="py-4 px-4">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ date("d M Y", strtotime($transaction->created_at)) }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ date("h:i A", strtotime($transaction->created_at)) }}
                                        </p>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    <span class="font-mono">{{ $transaction->binance_id }}</span>
                                </td>
                                
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <i class="fab fa-binance text-yellow-500 mr-2"></i>
                                        <p class="font-bold text-yellow-500">${{ number_format($transaction->amount, 2) }} USDT</p>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-coins text-yellow-500 mr-2"></i>
                                        <p>{{ number_format($transaction->points_required) }} pts</p>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    @if($transaction->status == 'completed')
                                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-check-circle mr-1"></i> Completed
                                        </span>
                                    @elseif($transaction->status == 'failed')
                                        <span class="px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-times-circle mr-1"></i> Failed
                                        </span>
                                    @elseif($transaction->status == 'processing')
                                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-spinner fa-spin mr-1"></i> Processing
                                        </span>
                                    @elseif($transaction->status == 'pending')
                                        <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-full text-sm font-medium">
                                            <i class="fas fa-clock mr-1"></i> Pending
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-full text-sm font-medium">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    @endif
                                </td>
                                <!--
                                <td class="py-4 px-4">
                                    @if($transaction->transaction_id)
                                        <div class="flex items-center">
                                            <span class="font-mono text-sm bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                                {{ substr($transaction->transaction_id, 0, 8) }}...
                                            </span>
                                            <button onclick="copyToClipboard('{{ $transaction->transaction_id }}')" class="ml-2 text-gray-400 hover:text-yellow-500">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">Pending</span>
                                    @endif
                                </td>-->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Binance Transactions Pagination -->
            @if($binance_transactions->hasPages())
                <div class="mt-6">
                    {{ $binance_transactions->withPath(route('payments'))->appends(['data_page' => request('data_page'), 'cash_page' => request('cash_page')])->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto mb-3 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                    <i class="fab fa-binance text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No Binance Withdrawals Yet</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">You haven't made any Binance withdrawals.</p>
                <a href="{{ route('binance.index') }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg text-sm hover:bg-yellow-600 transition">
                    <i class="fas fa-plus mr-2"></i>
                    Withdraw USDT
                </a>
            </div>
        @endif
    </div>
@endif


</main>

<!-- JavaScript for Date Filter -->
<script>
document.getElementById('dateFilter').addEventListener('change', function(e) {
    const filterValue = e.target.value;
    // You can implement AJAX filtering or page reload with query parameter
    if(filterValue !== 'all') {
        window.location.href = window.location.pathname + '?filter=' + filterValue;
    } else {
        window.location.href = window.location.pathname;
    }
});

// Set the current filter value from URL
const urlParams = new URLSearchParams(window.location.search);
const filterParam = urlParams.get('filter');
if(filterParam) {
    document.getElementById('dateFilter').value = filterParam;
}
</script>

@endsection