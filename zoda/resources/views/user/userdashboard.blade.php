@extends('user.layout')
@section('content')



<main class="px-4 lg:px-6 py-6 space-y-6 max-w-4xl mx-auto">

<div class="relative overflow-hidden bg-slate-900 px-4 py-3 text-white shadow-xl sm:px-6 sm:py-4">
  <!-- Subtle animated background glow -->
  <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-emerald-500/10 to-brand-500/10 animate-pulse"></div>

  <div class="relative flex flex-col items-center justify-between gap-3 text-center md:flex-row md:text-left max-w-7xl mx-auto">
    
    <!-- Text Content Area -->
    <div class="flex flex-col sm:flex-row items-center gap-2 md:gap-3">
      <!-- Animated Badge -->
      <span class="inline-flex items-center gap-1 rounded-full bg-amber-500/10 px-2.5 py-1 text-xs font-semibold text-amber-400 border border-amber-500/20 animate-bounce sm:animate-none">
        <span class="h-1.5 w-1.5 rounded-full bg-amber-400 animate-ping"></span>
        ATTENTION
      </span>
      
      <!-- Main Hook -->
      <p class="text-sm font-medium tracking-wide text-slate-200">
        <span class="font-bold text-white">Get Real Human Traffic to Your Website.</span> 
      </p>
    </div>

    <!-- Call to Action Button -->
    <a href="https://ads.koda.africa" target="_blank" class="group relative inline-flex items-center justify-center gap-1.5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-5 py-2 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition-all duration-200 hover:from-emerald-600 hover:to-teal-600 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-emerald-500/30 w-full sm:w-auto flex-shrink-0">
      <span>Click Here to Start</span>
      <!-- Animated arrow that nudges on hover -->
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
      </svg>
    </a>

        <!-- 🔴 LIVE USERS ONLINE COUNTER -->
        <div class="flex items-center gap-2 rounded-full bg-emerald-500/10 border border-emerald-500/30 px-3 py-1.5">
        <span class="relative flex h-2.5 w-2.5">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
        </span>
        <span class="text-xs font-semibold text-emerald-400">
            <span id="liveUsersCount" 
                data-seed="{{ $liveUsers }}"
                class="font-mono tabular-nums">{{ number_format($liveUsers) }}</span> users online now
        </span>
        </div>

    
  </div>
</div>

    {{-- ═══════════════════════════════════════
         WELCOME BANNER
    ═══════════════════════════════════════ --}}
    <section class="animate-slide-up">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Good {{ date('H') < 12 ? 'morning' : (date('H') < 17 ? 'afternoon' : 'evening') }},</p>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">{{ explode(' ', auth()->user()->name)[0] }}! 👋</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Read articles and earn real cash rewards</p>
            </div>
            <a href="/choose"
               class="hidden sm:flex items-center gap-2 bg-gradient-to-r from-danger to-red-400 text-white font-bold text-sm px-5 py-3 rounded-2xl shadow-lg shadow-red-500/25 hover:shadow-red-500/40 hover:-translate-y-0.5 transition-all duration-200">
                <i class="fas fa-money-bill-wave"></i>
                Redeem Now
            </a>
        </div>
    </section>



    {{-- ═══════════════════════════════════════
     PAYMENT FLASH — social proof
═══════════════════════════════════════ --}}
{{-- ═══════════════════════════════════════
     PAYMENT FLASH — top-right sliding toast
═══════════════════════════════════════ --}}
@if(!empty($paymentFlashes) && count($paymentFlashes) > 0)
<div id="paymentToastStack"
     class="fixed top-4 right-4 z-[9999] w-[calc(100vw-2rem)] sm:w-80 pointer-events-none">
    
    <div id="paymentToast"
         class="pointer-events-auto translate-x-[120%] opacity-0 transition-all duration-500 ease-out">
        <div class="flex items-center gap-3 bg-white dark:bg-gray-900 border border-emerald-100 dark:border-emerald-900/40 rounded-2xl px-4 py-3 shadow-xl shadow-emerald-500/10">

            {{-- Avatar --}}
            <div id="pfAvatar"
                 class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center flex-shrink-0 text-white font-bold text-sm">
                A
            </div>

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                <p id="pfMessage"
                   class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                    Loading…
                </p>
                <p class="text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1 mt-0.5">
                    <i class="fas fa-check-circle text-emerald-500 text-[10px]"></i>
                    Verified payout · just now
                </p>
            </div>

            {{-- Pulsing dot --}}
            <span class="relative flex h-2.5 w-2.5 flex-shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>

        </div>
    </div>

</div>

<script>
    (function () {
        const messages = @json($paymentFlashes);
        if (!messages || messages.length === 0) return;

        const toast   = document.getElementById('paymentToast');
        const msgEl   = document.getElementById('pfMessage');
        const avatar  = document.getElementById('pfAvatar');

        if (!toast || !msgEl || !avatar) return;

        let index = 0;

        // Slide IN
        function show() {
            const item = messages[index];

            msgEl.textContent   = item.message;
            avatar.textContent  = item.name.charAt(0).toUpperCase();

            toast.classList.remove('translate-x-[120%]', 'opacity-0');
            toast.classList.add('translate-x-0', 'opacity-100');
        }

        // Slide OUT
        function hide() {
            toast.classList.remove('translate-x-0', 'opacity-100');
            toast.classList.add('translate-x-[120%]', 'opacity-0');
        }

        // Cycle: show → wait → hide → wait → next
        function cycle() {
            index = (index + 1) % messages.length;
            show();

            const visibleFor = 4000 + Math.random() * 2000;   // 4-6s visible
            setTimeout(() => {
                hide();
                const hiddenFor = 2500 + Math.random() * 2500; // 2.5-5s hidden
                setTimeout(cycle, hiddenFor + 600);            // +600 for slide-out to finish
            }, visibleFor);
        }

        // First appearance after a short delay
        setTimeout(() => {
            show();
            const visibleFor = 4500 + Math.random() * 2000;
            setTimeout(() => {
                hide();
                const hiddenFor = 2500 + Math.random() * 2500;
                setTimeout(cycle, hiddenFor + 600);
            }, visibleFor);
        }, 2000);
    })();
</script>
@endif


    {{-- ═══════════════════════════════════════
         STATS GRID
    ═══════════════════════════════════════ --}}
    <section class="grid grid-cols-2 gap-4 animate-slide-up delay-1">

        {{-- Earnings --}}
        <div class="stat-glow-green bg-white dark:bg-gray-900 rounded-3xl p-5 relative overflow-hidden border border-gray-100 dark:border-gray-800">
            <div class="absolute -top-5 -right-5 w-24 h-24 bg-brand-400/10 rounded-full"></div>
            <div class="absolute -bottom-8 -left-4 w-20 h-20 bg-brand-400/5 rounded-full"></div>
            <div class="relative z-10">
                <div class="w-10 h-10 rounded-2xl bg-brand-100 dark:bg-brand-900/40 flex items-center justify-center mb-4">
                    <i class="fas fa-coins text-brand-600 dark:text-brand-400"></i>
                </div>
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Earnings</p>
                <p class="text-3xl font-bold text-brand-600 dark:text-brand-400 font-mono leading-none">
                    @if($credit ?? false)
                        @php
                            $currency = match(auth()->user()->country ?? '') {
                                'GH' => 'GH&#8373;', 'NG' => '&#8358;', 'KE' => 'Ksh', 'ZA' => 'R', default => '$'
                            };
                        @endphp
                        {!! $currency !!}{{ number_format($credit->credit ?? 0, 2) }}
                        @else
                        $0
                    @endif
                </p>
                <!--@php $pts = $credit->credit ?? 0; $pct = min(100, ($pts / 500) * 100); @endphp
                 <div class="mt-3 progress-bar">
                    <div class="progress-fill" style="width: {{ $pct }}%"></div>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-600 mt-1.5">{{ $pts }} / 500 pts to next milestone</p>-->
            </div>
        </div>

        {{-- total paid --}}
        <div class="stat-glow-gold bg-white dark:bg-gray-900 rounded-3xl p-5 relative overflow-hidden border border-gray-100 dark:border-gray-800">
            <div class="absolute -top-5 -right-5 w-24 h-24 bg-amber-400/10 rounded-full"></div>
            <div class="absolute -bottom-8 -left-4 w-20 h-20 bg-amber-400/5 rounded-full"></div>
            <div class="relative z-10">
                <div class="w-10 h-10 rounded-2xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center mb-4">
                    <i class="fas fa-star text-amber-500"></i>
                </div>
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Total Withdrawn</p>

                <p class="text-3xl font-bold text-amber-500 dark:text-amber-400 font-mono leading-none">

                @if($credit ?? false)
                        @php
                            $currency = match(auth()->user()->country ?? '') {
                                'GH' => 'GH&#8373;', 'NG' => '&#8358;', 'KE' => 'Ksh', 'ZA' => 'R', default => '$'
                            };
                        @endphp
                        {!! $currency !!}{{ number_format($paid ?? 0, 2) }}
                        @else
                        $0
                    @endif

                    </p>

               <!-- <a href="/referrals" class="inline-flex items-center gap-1 mt-3 text-xs font-semibold text-amber-600 dark:text-amber-400 hover:underline">
                    View referrals <i class="fas fa-arrow-right text-[10px]"></i>
                </a> -->
            </div>
        </div>

    </section>

    {{-- ═══════════════════════════════════════
         ARTICLES SECTION
    ═══════════════════════════════════════ --}}
    <section class="animate-slide-up delay-2">
        <div class="flex items-center justify-between mb-4">
            <div> 
                <p class="mt-1 text-s text-gray-500 dark:text-gray-400">
                    Attention!! For the best experience, please use 
                    <span class="font-medium text-gray-700 dark:text-gray-300">Google Chrome browser</span> 
                    or 
                    <span class="font-medium text-gray-700 dark:text-gray-300">Apple Safari</span>.
                    <span class="text-amber-600 dark:text-amber-400">Opera Mini is not fully supported.</span>
                </p><br>
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Sponsored Articles</h2>  
                
                
            </div> 
            @if(session()->has('open_task'))
                <a href="{{ route('refreshTaskList') }}"
                   class="flex items-center gap-1.5 text-sm font-semibold text-brand-600 dark:text-brand-400 bg-brand-50 dark:bg-brand-900/30 px-4 py-2 rounded-xl hover:bg-brand-100 dark:hover:bg-brand-900/50 transition-colors">
                    <i class="fas fa-sync-alt text-xs"></i> Refresh
                </a>
            @endif
        </div>

        @if(session()->has('open_task'))
            <div class="flex items-start gap-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 text-amber-800 dark:text-amber-200 px-4 py-3.5 rounded-2xl mb-4 text-sm">
                <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5 flex-shrink-0"></i>
                <p>You have an open task. Complete it first, or click <strong>Refresh</strong> to unlock new articles.</p>
            </div>
        @endif

        @if(count($tasks) > 0)
            <div class="space-y-3">
                @foreach($tasks as $task)
                    <div class="task-card bg-white dark:bg-gray-900 rounded-2xl p-4 flex items-center gap-4 border border-gray-100 dark:border-gray-800">
                        <div class="w-12 h-12 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-file-alt text-brand-500 dark:text-brand-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900 dark:text-white text-sm leading-snug">{{ $task->campaign_name }}</h3>
                            
                        </div>
                        @if(session()->has('open_task') && session('open_task') != $task->id)
                            <span class="flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-600 font-medium px-3 py-2 bg-gray-50 dark:bg-gray-800 rounded-xl flex-shrink-0">
                                <i class="fas fa-lock text-[10px]"></i> Locked
                            </span>
                        @else
                            <a href="{{ route('show', ['id' => $task->id, 'token' => $task->token]) }}"
                               class="flex-shrink-0 bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-brand-500/25">
                                Start
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-14 px-6 bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800">
                <div class="w-16 h-16 bg-amber-50 dark:bg-amber-900/20 rounded-3xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-newspaper text-2xl text-amber-400"></i>
                </div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">No articles right now</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 max-w-xs mx-auto">We're adding new articles daily. Check back soon — new articles are usually available every morning!</p>
            </div>
        @endif
    </section>

    {{-- ═══════════════════════════════════════
         TUTORIAL CARD
    ═══════════════════════════════════════ --}}
    <section class="animate-slide-up delay-3">
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="px-5 pt-5 pb-4 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-brand-100 dark:bg-brand-900/30 flex items-center justify-center">
                    <i class="fas fa-play text-brand-600 dark:text-brand-400 text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white text-sm">How It Works</h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500">Watch the tutorial to get started fast</p>
                </div>
            </div>
            <div class="px-5 pb-5">
                <div class="rounded-2xl overflow-hidden bg-gray-100 dark:bg-gray-800">
                    <iframe class="w-full h-48 block"
                            src="https://www.youtube.com/embed/4gqi4anuWGA?rel=0&modestbranding=1"
                            title="Koda Tutorial"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         REFERRAL SECTION
    ═══════════════════════════════════════ --}}
    
    <section class="animate-slide-up delay-4 space-y-4">

        <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-brand-600 via-brand-500 to-brand-400 p-6 text-white">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-10 -left-6 w-28 h-28 bg-white/10 rounded-full"></div>
            <div class="relative z-10 flex items-start justify-between gap-4">
                <div>
                    <div class="w-10 h-10 bg-white/20 rounded-2xl flex items-center justify-center mb-3">
                        <i class="fas fa-gift text-lg"></i>
                    </div>
                        @php
                            $currencyMap = [
                                'NG' => ['amount' => '150 Naira', 'currency' => 'Naira'],
                                'GH' => ['amount' => '3 Cedi', 'currency' => 'Cedi'],
                                'KE' => ['amount' => '30 KSh', 'currency' => 'KSh'],
                                'ZA' => ['amount' => '5 Rands', 'currency' => 'Rands'],
                            ];

                            $country = auth()->user()->country ?? 'NG';
                            $referralReward = $currencyMap[$country] ?? $currencyMap['NG'];
                        @endphp

                        <h3 class="text-lg font-bold leading-tight mb-1">Earn {{ $referralReward['amount'] }} per Referral!</h3>
                        <p class="text-brand-100 text-sm leading-relaxed max-w-xs">Refer someone and everytime the person withdraws, you earn {{ $referralReward['amount'] }}.</p>
                </div>
                <a href="/referrals"
                   class="flex-shrink-0 bg-white text-brand-700 font-bold text-sm px-5 py-3 rounded-2xl hover:bg-brand-50 transition-colors whitespace-nowrap">
                    View Referrals
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 p-5">
            <h3 class="font-bold text-gray-900 dark:text-white mb-1">Your Referral Link</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4"></p>

            <div class="flex gap-2 mb-3">
                <input type="text" id="refLink"
                       value="https://Koda.africa/signup-publisher?referral={{ Auth::user()->account_id }}"
                       readonly
                       class="flex-1 min-w-0 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100 text-xs px-4 py-3 rounded-2xl font-mono focus:outline-none focus:border-brand-400 transition-colors">
                <button onclick="copyReferralLink()"
                        class="flex-shrink-0 flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-semibold text-sm px-5 py-3 rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-brand-500/25">
                    <i class="fas fa-copy"></i>
                    <span class="hidden sm:inline">Copy</span>
                </button>
            </div>

            <div id="copySuccess" class="hidden mb-4 flex items-center gap-2 bg-brand-50 dark:bg-brand-900/30 border border-brand-200 dark:border-brand-800 text-brand-700 dark:text-brand-300 px-4 py-2.5 rounded-xl text-sm">
                <i class="fas fa-check-circle text-brand-500"></i> Link copied to clipboard!
            </div>

            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Share on</p>
            @php
                $ref = 'https://Koda.africa/signup-publisher?referral=' . Auth::user()->account_id;
                $msg = urlencode('Earn free cash just by reading articles! Join Koda.africa and start earning today. ');
            @endphp
            <div class="grid grid-cols-4 gap-3">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($ref) }}" target="_blank"
                   class="flex flex-col items-center justify-center gap-1.5 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/30">
                    <i class="fab fa-facebook-f text-base"></i>
                    <span class="text-[10px] font-semibold">Facebook</span>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ $msg }}{{ urlencode($ref) }}" target="_blank"
                   class="flex flex-col items-center justify-center gap-1.5 py-3.5 bg-green-500 hover:bg-green-600 text-white rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-green-500/30">
                    <i class="fab fa-whatsapp text-base"></i>
                    <span class="text-[10px] font-semibold">WhatsApp</span>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode($ref) }}&text={{ $msg }}" target="_blank"
                   class="flex flex-col items-center justify-center gap-1.5 py-3.5 bg-sky-500 hover:bg-sky-600 text-white rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-sky-500/30">
                    <i class="fab fa-twitter text-base"></i>
                    <span class="text-[10px] font-semibold">Twitter</span>
                </a>
                <a href="https://t.me/share/url?url={{ urlencode($ref) }}&text={{ $msg }}" target="_blank"
                   class="flex flex-col items-center justify-center gap-1.5 py-3.5 bg-blue-500 hover:bg-blue-600 text-white rounded-2xl transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/30">
                    <i class="fab fa-telegram text-base"></i>
                    <span class="text-[10px] font-semibold">Telegram</span>
                </a>
            </div>

            @if(isset($referralCount) && $referralCount > 0)
                <div class="mt-5 pt-5 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mb-0.5">Total Referrals</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $referralCount }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 dark:text-gray-500 font-medium mb-0.5">Total Bonus</p>
                        <p class="text-2xl font-bold text-amber-500">${{ $bonus ?? 0 }}</p>
                    </div>
                    <a href="/referrals"
                       class="flex items-center gap-1.5 text-sm font-semibold text-brand-600 dark:text-brand-400 bg-brand-50 dark:bg-brand-900/30 px-4 py-2.5 rounded-xl hover:bg-brand-100 transition-colors">
                        View all <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            @endif
        </div>

    </section> 

    <div class="h-4"></div>
</main>

<script>
    function copyReferralLink() {
        const input = document.getElementById('refLink');
        const success = document.getElementById('copySuccess');
        if (!input) return;

        const copy = (text) => {
            if (navigator.clipboard && window.isSecureContext) {
                return navigator.clipboard.writeText(text);
            }
            input.select();
            document.execCommand('copy');
            return Promise.resolve();
        };

        copy(input.value).then(() => {
            if (success) {
                success.classList.remove('hidden');
                setTimeout(() => success.classList.add('hidden'), 3000);
            }
            if (window.showToast) showToast('Referral link copied!');
        }).catch(() => {
            if (window.showToast) showToast('Please copy the link manually.', 'error');
        });
    }


        (function liveUsersCounter() {
        const el = document.getElementById('liveUsersCount');
        if (!el) return;

        let current = parseInt(el.dataset.seed, 10) || 0;
        const format = (n) => n.toLocaleString('en-US');
        el.textContent = format(current);

        async function poll() {
            try {
                const res = await fetch('/live-users', { 
                    headers: { 'X-Requested-With': 'XMLHttpRequest' } 
                });
                if (res.ok) {
                    const data = await res.json();
                    if (typeof data.count === 'number') {
                        current = data.count;
                        el.textContent = format(current);
                    }
                }
            } catch (_) { /* ignore */ }

            setTimeout(poll, 6000 + Math.random() * 4000);
        }
        setTimeout(poll, 5000);
    })();
</script>

@endsection