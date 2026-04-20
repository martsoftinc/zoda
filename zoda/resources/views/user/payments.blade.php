@extends('user.layout')
@section('content')

<main class="px-4 lg:px-6 py-6 max-w-5xl mx-auto space-y-6">

    {{-- ═══════════════════════════════════
         PAGE HEADER
    ═══════════════════════════════════ --}}
    <div class="flex items-center justify-between gap-4 animate-slide-up">
        <div class="flex items-center gap-4">
            <a href="{{ route('publisher') }}"
               class="w-10 h-10 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 flex items-center justify-center text-gray-500 hover:border-brand-300 hover:text-brand-600 dark:hover:text-brand-400 transition-all shadow-card">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">Payment History</h1>
                <p class="text-sm text-gray-400 dark:text-gray-500">All your transactions in one place</p>
            </div>
        </div>
        <button onclick="location.reload()"
                class="w-10 h-10 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 flex items-center justify-center text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 hover:border-brand-300 transition-all shadow-card"
                title="Refresh">
            <i class="fas fa-sync-alt text-sm"></i>
        </button>
    </div>

    {{-- ═══════════════════════════════════
         SUMMARY STRIP
    ═══════════════════════════════════ --}}
    @php
        $totalTx    = method_exists($payment_requests, 'total') ? $payment_requests->total() : $payment_requests->count();
        $collection = method_exists($payment_requests, 'getCollection') ? $payment_requests->getCollection() : $payment_requests;
        $successCount = $collection->filter(fn($r) => $r->status === 'successful')->count();
        $pendingCount = $collection->filter(fn($r) => $r->status === 'pending')->count();
    @endphp
    <div class="grid grid-cols-3 gap-4 animate-slide-up delay-1">
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card px-5 py-4 text-center">
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $payment_requests->total() ?? $payment_requests->count() }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5 font-medium">Total</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-brand-100 dark:border-brand-900/40 shadow-card px-5 py-4 text-center">
            <p class="text-2xl font-bold text-brand-600 dark:text-brand-400">{{ $successCount }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5 font-medium">Successful</p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-amber-100 dark:border-amber-900/30 shadow-card px-5 py-4 text-center">
            <p class="text-2xl font-bold text-amber-500">{{ $pendingCount }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5 font-medium">Pending</p>
        </div>
    </div>

    

    {{-- ═══════════════════════════════════
         MOBILE MONEY (GH only)
    ═══════════════════════════════════ --}}
    @if(auth()->user()->country === 'GH')
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card overflow-hidden animate-slide-up delay-3">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-50 dark:border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-brand-600 dark:text-brand-400 text-sm"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-900 dark:text-white">Mobile Money</h2>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Cash withdrawal history</p>
                    </div>
                </div>
                <a href="{{ route('momo') }}"
                   class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline flex items-center gap-1">
                    New Withdrawal <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            @if($cash_transactions->count() > 0)

                {{-- Mobile cards --}}
                <div class="sm:hidden divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach($cash_transactions as $t)
                        <div class="px-5 py-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0 text-xs font-bold
                                @if($t->network === 'mtn') bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700
                                @elseif($t->network === 'tigo') bg-red-50 dark:bg-red-900/20 text-red-700
                                @else bg-blue-50 dark:bg-blue-900/20 text-blue-700 @endif">
                                {{ strtoupper(substr($t->network, 0, 3)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-bold text-brand-600 dark:text-brand-400 text-sm">GH₵ {{ number_format((float) $t->amount, 2) }}</span>
                                    @php $s = $t->status; @endphp
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                                        @if($s==='completed') bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300
                                        @elseif($s==='failed') bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300
                                        @elseif($s==='processing') bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300
                                        @else bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 @endif">
                                        {{ ucfirst($s) }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5">{{ date('d M Y · h:i A', strtotime($t->created_at)) }}</p>
                                <p class="text-xs text-gray-400 font-mono mt-0.5">+233 {{ $t->phone_number }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Desktop table --}}
                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/60">
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Date</th>
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Network</th>
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Amount</th>
                                
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Phone</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                            @foreach($cash_transactions as $t)
                                <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-800/40 transition-colors">
                                    <td class="py-4 px-6">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ date('d M Y', strtotime($t->created_at)) }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ date('h:i A', strtotime($t->created_at)) }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="text-xs font-bold px-2.5 py-1.5 rounded-xl
                                            @if($t->network==='mtn') bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-400
                                            @elseif($t->network==='tigo') bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400
                                            @else bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400 @endif">
                                            {{ strtoupper($t->network) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="font-bold text-brand-600 dark:text-brand-400 text-sm">GH₵ {{ number_format((float) $t->amount, 2) }}</span>
                                    </td>

                                    <td class="py-4 px-6">
                                        @php $s = $t->status; @endphp
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full border
                                            @if($s==='completed') bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 border-brand-100 dark:border-brand-800
                                            @elseif($s==='failed') bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 border-red-100 dark:border-red-800
                                            @elseif($s==='processing') bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border-blue-100 dark:border-blue-800
                                            @else bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 border-amber-100 dark:border-amber-800 @endif">
                                            <i class="fas fa-{{ $s==='completed' ? 'check-circle' : ($s==='failed' ? 'times-circle' : ($s==='processing' ? 'spinner fa-spin' : 'clock')) }} text-[10px]"></i>
                                            {{ ucfirst($s) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-mono text-sm text-gray-700 dark:text-gray-300">+233 {{ $t->phone_number }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $t->full_name }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($cash_transactions->hasPages())
                    <div class="px-6 py-4 border-t border-gray-50 dark:border-gray-800">
                        {{ $cash_transactions->withPath(route('payments'))->appends(['data_page' => request('data_page')])->links() }}
                    </div>
                @endif

            @else
                <div class="text-center py-14 px-6">
                    <div class="w-14 h-14 bg-gray-50 dark:bg-gray-800 rounded-3xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-mobile-alt text-gray-300 dark:text-gray-600 text-lg"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">No withdrawals yet</h3>
                    <p class="text-sm text-gray-400 mb-5">Mobile money withdrawals will appear here.</p>
                    <a href="{{ route('momo.index') }}"
                       class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold text-sm px-5 py-3 rounded-2xl transition-all hover:-translate-y-0.5">
                        <i class="fas fa-plus text-xs"></i> Withdraw Cash
                    </a>
                </div>
            @endif
        </div>
    @endif

    {{-- ═══════════════════════════════════
         CRYPTO / BINANCE (non-GH)
    ═══════════════════════════════════ --}}
    @if(auth()->user()->country !== 'GH')
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card overflow-hidden animate-slide-up delay-3">

            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-50 dark:border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-2xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center">
                        <i class="fas fa-coins text-amber-500 text-sm"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-900 dark:text-white">Crypto Withdrawals</h2>
                        <p class="text-xs text-gray-400 dark:text-gray-500">USDT withdrawal history</p>
                    </div>
                </div>
                <a href="{{ route('binance') }}"
                   class="text-xs font-semibold text-amber-600 dark:text-amber-400 hover:underline flex items-center gap-1">
                    New Withdrawal <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            @if(isset($binance_transactions) && $binance_transactions->count() > 0)

                {{-- Mobile cards --}}
                <div class="sm:hidden divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach($binance_transactions as $t)
                        <div class="px-5 py-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-coins text-amber-500 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-bold text-amber-600 dark:text-amber-400 text-sm">${{ number_format((float) $t->amount, 2) }} USDT</span>
                                    @php $s = $t->status; @endphp
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                                        @if($s==='completed') bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300
                                        @elseif($s==='failed') bg-red-50 dark:bg-red-900/20 text-red-700
                                        @elseif($s==='processing') bg-blue-50 dark:bg-blue-900/20 text-blue-700
                                        @else bg-amber-50 dark:bg-amber-900/20 text-amber-700 @endif">
                                        {{ ucfirst($s) }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5">{{ date('d M Y · h:i A', strtotime($t->created_at)) }}</p>
                                <p class="text-xs text-gray-400 font-mono mt-0.5">{{ $t->binance_id }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Desktop table --}}
                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/60">
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Date</th>
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Wallet ID</th>
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Amount</th>
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Points</th>
                                <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                            @foreach($binance_transactions as $t)
                                <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-800/40 transition-colors">
                                    <td class="py-4 px-6">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ date('d M Y', strtotime($t->created_at)) }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ date('h:i A', strtotime($t->created_at)) }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="font-mono text-xs text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 px-2 py-1 rounded-lg">{{ $t->binance_id }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="font-bold text-amber-600 dark:text-amber-400 text-sm">${{ number_format((float) $t->amount, 2) }} USDT</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 text-sm flex items-center gap-1.5">
                                            <i class="fas fa-coins text-amber-400 text-[10px]"></i>{{ number_format((int) $t->points_required) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        @php $s = $t->status; @endphp
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full border
                                            @if($s==='completed') bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 border-brand-100 dark:border-brand-800
                                            @elseif($s==='failed') bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 border-red-100 dark:border-red-800
                                            @elseif($s==='processing') bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border-blue-100 dark:border-blue-800
                                            @else bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 border-amber-100 dark:border-amber-800 @endif">
                                            <i class="fas fa-{{ $s==='completed' ? 'check-circle' : ($s==='failed' ? 'times-circle' : ($s==='processing' ? 'spinner fa-spin' : 'clock')) }} text-[10px]"></i>
                                            {{ ucfirst($s) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($binance_transactions->hasPages())
                    <div class="px-6 py-4 border-t border-gray-50 dark:border-gray-800">
                        {{ $binance_transactions->withPath(route('payments'))->appends(['data_page' => request('data_page'), 'cash_page' => request('cash_page')])->links() }}
                    </div>
                @endif

            @else
                <div class="text-center py-14 px-6">
                    <div class="w-14 h-14 bg-amber-50 dark:bg-amber-900/20 rounded-3xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-coins text-amber-300 dark:text-amber-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">No crypto withdrawals yet</h3>
                    <p class="text-sm text-gray-400 mb-5">Your USDT withdrawals will appear here.</p>
                    <a href="{{ route('binance.index') }}"
                       class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm px-5 py-3 rounded-2xl transition-all hover:-translate-y-0.5">
                        <i class="fas fa-plus text-xs"></i> Withdraw USDT
                    </a>
                </div>
            @endif
        </div>
    @endif

    <div class="h-2"></div>
</main>

@endsection