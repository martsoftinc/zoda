@extends('user.layout')
@section('content')

<main class="px-4 lg:px-6 py-6 max-w-5xl mx-auto space-y-6">

    {{-- ═══════════════════════════════════
         PAGE HEADER
    ═══════════════════════════════════ --}}
    <div class="flex items-center justify-between gap-4 animate-slide-up">
        <div class="flex items-center gap-4">
            <a href="/publisher"
               class="w-10 h-10 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 flex items-center justify-center text-gray-500 hover:border-brand-300 hover:text-brand-600 dark:hover:text-brand-400 transition-all shadow-card">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">Referral Program</h1>
                <p class="text-sm text-gray-400 dark:text-gray-500"> </p>
            </div>
        </div>
        <div class="hidden sm:flex items-center gap-2 bg-white dark:bg-gray-900 border border-amber-100 dark:border-amber-900/40 rounded-2xl px-4 py-2.5 shadow-card">
            <i class="fas fa-users text-amber-500 text-sm"></i>
            <div>
                <p class="text-[10px] text-gray-400 font-medium leading-none mb-0.5">Total Referrals</p>
                <p class="text-lg font-bold text-amber-500 leading-none">{{ $Total }}</p>
            </div>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session()->has('success'))
        <div class="flex items-center gap-3 bg-brand-50 dark:bg-brand-900/30 border border-brand-200 dark:border-brand-800 text-brand-800 dark:text-brand-200 px-4 py-3 rounded-2xl text-sm animate-slide-up">
            <i class="fas fa-check-circle text-brand-500 flex-shrink-0"></i>{{ session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="flex items-center gap-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-2xl text-sm animate-slide-up">
            <i class="fas fa-exclamation-circle text-red-500 flex-shrink-0"></i>{{ session('error') }}
        </div>
    @endif

    {{-- ═══════════════════════════════════
         STATS CARDS
    ═══════════════════════════════════ --}}
    <div class="grid grid-cols-3 gap-4 animate-slide-up delay-1">

        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-5 relative overflow-hidden">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-brand-400/10 rounded-full"></div>
            <div class="w-9 h-9 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center mb-3">
                <i class="fas fa-calendar-check text-brand-600 dark:text-brand-400 text-sm"></i>
            </div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $This_Month }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mt-0.5">This Month</p>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-5 relative overflow-hidden">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-blue-400/10 rounded-full"></div>
            <div class="w-9 h-9 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center mb-3">
                <i class="fas fa-calendar-alt text-blue-500 text-sm"></i>
            </div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $Last_Month }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mt-0.5">Last Month</p>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-5 relative overflow-hidden">
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-amber-400/10 rounded-full"></div>
            <div class="w-9 h-9 rounded-2xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center mb-3">
                <i class="fas fa-users text-amber-500 text-sm"></i>
            </div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $Total }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mt-0.5">All Time</p>
        </div>

    </div>

    {{-- ═══════════════════════════════════
         REFERRAL LINK CARD
    ═══════════════════════════════════ --}}
    @php
        $ref = 'https://koda.africa/signup-publisher?referral=' . Auth::user()->account_id;
        $msg = urlencode('Earn real cash just by reading articles! Join koda.africa and start earning today. ');
    @endphp

    <div class="bg-gradient-to-br from-brand-600 to-brand-400 rounded-3xl p-6 md:p-8 text-white relative overflow-hidden shadow-xl shadow-brand-500/20 animate-slide-up delay-2">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-14 -left-8 w-36 h-36 bg-white/10 rounded-full"></div>

        <div class="relative z-10">
            <div class="flex items-start justify-between gap-4 mb-6">
                <div>
                    <div class="w-11 h-11 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-gift text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold leading-tight mb-1">Your Referral Link</h2>
  
                     <div>

                                            @php
                            $currencyMap = [
                                'NG' => ['amount' => '50 Naira', 'currency' => 'Naira'],
                                'GH' => ['amount' => '1 Cedi', 'currency' => 'Cedi'],
                                'KE' => ['amount' => '5 KSh', 'currency' => 'KSh'],
                                'ZA' => ['amount' => '5 Rands', 'currency' => 'Rands'],
                            ];

                            $country = auth()->user()->country ?? 'NG';
                            $referralReward = $currencyMap[$country] ?? $currencyMap['NG'];
                        @endphp

                      
                        <p class="text-brand-100 text-sm leading-relaxed max-w-xs">Refer someone and anytime the person withdraws, you earn {{ $referralReward['amount'] }}.</p>
                </div>





                </div>
                <div id="referralCopySuccess" class="hidden bg-white/20 border border-white/30 text-white text-xs font-semibold px-3 py-2 rounded-2xl flex items-center gap-2 flex-shrink-0">
                    <i class="fas fa-check-circle"></i> Copied!
                </div>
            </div>

            {{-- Link input --}}
            <div class="flex flex-col sm:flex-row gap-3 mb-7">
                <input type="text" id="referralLink" value="{{ $ref }}" readonly
                       class="flex-1 bg-white/10 border border-white/20 text-white text-xs sm:text-sm rounded-2xl px-4 py-3.5 font-mono focus:outline-none focus:ring-2 focus:ring-white/40 placeholder-white/40 truncate">
                <button onclick="copyReferralLink()"
                        class="flex-shrink-0 flex items-center justify-center gap-2 bg-white text-brand-700 font-bold text-sm px-6 py-3.5 rounded-2xl hover:bg-brand-50 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="fas fa-copy text-sm"></i> Copy Link
                </button>
            </div>

            {{-- Share buttons --}}
            <p class="text-brand-100 text-xs font-semibold uppercase tracking-widest mb-3">Share on</p>
            <div class="grid grid-cols-4 gap-3">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($ref) }}" target="_blank"
                   class="flex flex-col items-center gap-1.5 py-3.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-md">
                    <i class="fab fa-facebook-f text-base"></i>
                    <span class="text-[10px] font-semibold">Facebook</span>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ $msg }}{{ urlencode($ref) }}" target="_blank"
                   class="flex flex-col items-center gap-1.5 py-3.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-md">
                    <i class="fab fa-whatsapp text-base"></i>
                    <span class="text-[10px] font-semibold">WhatsApp</span>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode($ref) }}&text={{ $msg }}" target="_blank"
                   class="flex flex-col items-center gap-1.5 py-3.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-md">
                    <i class="fab fa-twitter text-base"></i>
                    <span class="text-[10px] font-semibold">Twitter</span>
                </a>
                <a href="https://t.me/share/url?url={{ urlencode($ref) }}&text={{ $msg }}" target="_blank"
                   class="flex flex-col items-center gap-1.5 py-3.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-md">
                    <i class="fab fa-telegram text-base"></i>
                    <span class="text-[10px] font-semibold">Telegram</span>
                </a>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════
         HOW IT WORKS STRIP
    ═══════════════════════════════════ --}}
    <div class="grid grid-cols-3 gap-4 animate-slide-up delay-3">
        @foreach([
            ['icon'=>'fas fa-user-plus','color'=>'brand','label'=>'Friend signs up','sub'=>'Using your link'],
            ['icon'=>'fas fa-book-open','color'=>'blue','label'=>'They read & earn','sub'=>'Complete articles'],
            ['icon'=>'fas fa-coins','color'=>'amber','label'=>'You get earn cash','sub'=>'On their withdrawal'],
        ] as $step)
            <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-4 text-center">
                <div class="w-10 h-10 rounded-2xl bg-{{ $step['color'] }}-50 dark:bg-{{ $step['color'] }}-900/20 flex items-center justify-center mx-auto mb-3">
                    <i class="{{ $step['icon'] }} text-{{ $step['color'] }}-500 dark:text-{{ $step['color'] }}-400 text-sm"></i>
                </div>
                <p class="text-xs font-bold text-gray-900 dark:text-white leading-tight mb-0.5">{{ $step['label'] }}</p>
                <p class="text-[10px] text-gray-400 dark:text-gray-500">{{ $step['sub'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- ═══════════════════════════════════
         REFERRALS TABLE
    ═══════════════════════════════════ --}}
    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card overflow-hidden animate-slide-up delay-4">

        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-50 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                    <i class="fas fa-users text-brand-600 dark:text-brand-400 text-sm"></i>
                </div>
                <div>
                    <h2 class="font-bold text-gray-900 dark:text-white">Your Referrals</h2>
                    <p class="text-xs text-gray-400 dark:text-gray-500">People who joined using your link</p>
                </div>
            </div>
            <button onclick="copyReferralLink()"
                    class="flex items-center gap-2 text-xs font-semibold text-brand-600 dark:text-brand-400 bg-brand-50 dark:bg-brand-900/30 px-4 py-2.5 rounded-2xl border border-brand-100 dark:border-brand-800 hover:bg-brand-100 dark:hover:bg-brand-900/50 transition-colors">
                <i class="fas fa-share-alt"></i> Share Link
            </button>
        </div>

        @if($referrals->isEmpty())
            <div class="text-center py-16 px-6">
                <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-3xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-gray-300 dark:text-gray-600 text-xl"></i>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-1">No referrals yet</h3>
                <p class="text-sm text-gray-400 dark:text-gray-500 max-w-xs mx-auto mb-5">Share your link to start earning 100 points for every withdrawal your referrals make!</p>
                <button onclick="copyReferralLink()"
                        class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-6 py-3 rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-brand-500/25">
                    <i class="fas fa-copy text-xs"></i> Copy Your Link
                </button>
            </div>
        @else

            {{-- Mobile cards --}}
            <div class="sm:hidden divide-y divide-gray-50 dark:divide-gray-800">
                @foreach($referrals as $referral)
                    <div class="px-5 py-4 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0 shadow-md shadow-brand-500/20">
                            {{ strtoupper(substr($referral->referredUser->name, 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 dark:text-white text-sm truncate">{{ $referral->referredUser->name }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                Joined {{ \Carbon\Carbon::parse($referral->created_at)->format('d M Y') }}
                            </p>
                        </div>
                        <span class="flex-shrink-0 text-xs text-brand-600 dark:text-brand-400 bg-brand-50 dark:bg-brand-900/30 px-2.5 py-1 rounded-full font-semibold border border-brand-100 dark:border-brand-800">
                            +100 pts
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- Desktop table --}}
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800/60">
                            <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Member</th>
                            <th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Joined</th>
                            <!--<th class="text-left py-3 px-6 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Bonus</th>-->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                        @foreach($referrals as $referral)
                            <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-800/40 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-brand-500/20 flex-shrink-0">
                                            {{ strtoupper(substr($referral->referredUser->name, 0, 2)) }}
                                        </div>
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $referral->referredUser->name }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($referral->created_at)->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($referral->created_at)->format('h:i A') }}</p>
                                </td><!--
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 text-xs font-bold px-3 py-1.5 rounded-full border border-brand-100 dark:border-brand-800">
                                        <i class="fas fa-coins text-amber-400 text-[10px]"></i> 100 pts on withdrawal
                                    </span>
                                </td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($referrals->hasPages())
                <div class="px-6 py-4 border-t border-gray-50 dark:border-gray-800 flex items-center justify-between gap-4">
                    <p class="text-xs text-gray-400 dark:text-gray-500">
                        {{ $referrals->firstItem() }}–{{ $referrals->lastItem() }} of {{ $referrals->total() }} referrals
                    </p>
                    <div class="flex gap-2">
                        @if($referrals->onFirstPage())
                            <span class="px-4 py-2 rounded-2xl border border-gray-100 dark:border-gray-800 text-gray-300 dark:text-gray-700 text-sm cursor-not-allowed">← Prev</span>
                        @else
                            <a href="{{ $referrals->previousPageUrl() }}" class="px-4 py-2 rounded-2xl border border-gray-100 dark:border-gray-800 text-gray-600 dark:text-gray-400 text-sm hover:border-brand-300 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">← Prev</a>
                        @endif
                        @if($referrals->hasMorePages())
                            <a href="{{ $referrals->nextPageUrl() }}" class="px-4 py-2 rounded-2xl border border-gray-100 dark:border-gray-800 text-gray-600 dark:text-gray-400 text-sm hover:border-brand-300 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">Next →</a>
                        @else
                            <span class="px-4 py-2 rounded-2xl border border-gray-100 dark:border-gray-800 text-gray-300 dark:text-gray-700 text-sm cursor-not-allowed">Next →</span>
                        @endif
                    </div>
                </div>
            @endif

        @endif
    </div>

    <div class="h-2"></div>
</main>

<script>
    function copyReferralLink() {
        const input = document.getElementById('referralLink');
        const badge = document.getElementById('referralCopySuccess');
        if (!input) return;
        const copy = (text) => navigator.clipboard && window.isSecureContext
            ? navigator.clipboard.writeText(text)
            : (input.select(), document.execCommand('copy'), Promise.resolve());
        copy(input.value).then(() => {
            if (badge) { badge.classList.remove('hidden'); setTimeout(() => badge.classList.add('hidden'), 3000); }
            if (window.showToast) showToast('Referral link copied!', 'success');
        }).catch(() => {
            if (window.showToast) showToast('Copy manually — select the link above.', 'error');
        });
    }
</script>

@endsection