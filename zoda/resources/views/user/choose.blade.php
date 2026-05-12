@extends('user.layout')
@section('content')

<main class="px-4 lg:px-6 py-6 max-w-3xl mx-auto space-y-6">

    {{-- ═══════════════════════════════════
         PAGE HEADER
    ═══════════════════════════════════ --}}
    <div class="flex items-center gap-4 animate-slide-up">
        <a href="/publisher"
           class="w-10 h-10 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 flex items-center justify-center text-gray-500 hover:border-brand-300 hover:text-brand-600 dark:hover:text-brand-400 transition-all shadow-card flex-shrink-0">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">Redeem Earnings</h1>
            <p class="text-sm text-gray-400 dark:text-gray-500">Choose how you'd like to cash out</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════
         HOW IT WORKS STRIP
    ═══════════════════════════════════ --}}
    <div class="grid grid-cols-3 gap-3 animate-slide-up delay-1">
        @foreach([
            ['icon'=>'fas fa-coins','color'=>'amber','label'=>'Earn Points','sub'=>'Read articles'],
            ['icon'=>'fas fa-gift','color'=>'brand','label'=>'Redeem','sub'=>'Choose method'],
            ['icon'=>'fas fa-wallet','color'=>'blue','label'=>'Get Paid','sub'=>'To your account'],
        ] as $step)
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-card p-4 text-center">
            <div class="w-9 h-9 rounded-xl bg-{{ $step['color'] }}-50 dark:bg-{{ $step['color'] }}-900/20 flex items-center justify-center mx-auto mb-2">
                <i class="{{ $step['icon'] }} text-{{ $step['color'] }}-500 text-sm"></i>
            </div>
            <p class="text-xs font-bold text-gray-900 dark:text-white leading-tight">{{ $step['label'] }}</p>
            <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-0.5">{{ $step['sub'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- ═══════════════════════════════════
         REDEEM CARD
    ═══════════════════════════════════ --}}
    <div class="animate-slide-up delay-2">
        <button onclick="openCashModal()"
                class="w-full group focus:outline-none text-left">
            <div class="relative overflow-hidden bg-white dark:bg-gray-900 rounded-3xl border-2 border-gray-100 dark:border-gray-800 shadow-card
                        group-hover:border-brand-400 dark:group-hover:border-brand-500
                        group-hover:shadow-card-hover group-focus:border-brand-400
                        transition-all duration-300 p-7 sm:p-8">

                {{-- decorative blob --}}
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand-400/5 dark:bg-brand-400/10 rounded-full pointer-events-none group-hover:bg-brand-400/10 transition-colors"></div>
                <div class="absolute -bottom-12 -left-8 w-32 h-32 bg-amber-400/5 rounded-full pointer-events-none"></div>

                <div class="relative z-10 flex items-center gap-6">
                    {{-- icon --}}
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-3xl bg-gradient-to-br from-brand-500 to-brand-400 flex items-center justify-center flex-shrink-0 shadow-lg shadow-brand-500/25
                                group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-money-bill-wave text-white text-2xl sm:text-3xl"></i>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Redeem as Cash</h3>
                            <span class="hidden sm:inline-flex items-center gap-1 bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 text-[10px] font-bold px-2.5 py-1 rounded-full border border-brand-100 dark:border-brand-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span> Available
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            Withdraw your earnings directly to your mobile money wallet or crypto account.
                        </p>
                        <div class="flex flex-wrap items-center gap-2 mt-3">
                            @auth
                                @php $country = auth()->user()->country; @endphp
                                @if($country === 'GH')
                                    <span class="...bg-yellow-50 text-yellow-700...">MTN MoMo</span>
                                    <span class="...bg-red-50 text-red-600...">AirtelTigo</span>
                                    <span class="...bg-blue-50 text-blue-600...">Telecel Cash</span>
                                @elseif($country === 'KE')
                                    <span class="text-xs font-semibold bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 px-2.5 py-1 rounded-xl border border-green-100 dark:border-green-800">
                                        M-Pesa
                                    </span>
                                @elseif($country === 'NG')
                                    <span class="text-xs font-semibold bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 px-2.5 py-1 rounded-xl border border-emerald-100 dark:border-emerald-800">
                                        Bank Transfer
                                    </span>
                                @elseif($country === 'ZA')
                                    <span class="text-xs font-semibold bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400 px-2.5 py-1 rounded-xl border border-blue-100 dark:border-blue-800">
                                        Bank Transfer
                                    </span>
                                @else
                                    <span class="text-xs font-semibold bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 px-2.5 py-1 rounded-xl border border-amber-100 dark:border-amber-800">
                                        Binance USDT
                                    </span>
                                    <span class="text-xs font-semibold bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 px-2.5 py-1 rounded-xl border border-gray-100 dark:border-gray-700">
                                        Crypto
                                    </span>
                                @endif
                            @endauth
                        </div>
                    </div>

                    {{-- arrow --}}
                    <div class="flex-shrink-0 w-10 h-10 rounded-2xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex items-center justify-center
                                group-hover:bg-brand-50 dark:group-hover:bg-brand-900/30 group-hover:border-brand-200 dark:group-hover:border-brand-800
                                group-hover:translate-x-1 transition-all duration-300">
                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-brand-500 text-sm transition-colors"></i>
                    </div>
                </div>
            </div>
        </button>
    </div>

    {{-- ═══════════════════════════════════
         INFO BANNER
    ═══════════════════════════════════ --}}
    <div class="flex items-start gap-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 rounded-2xl px-4 py-3.5 animate-slide-up delay-3">
        <i class="fas fa-circle-info text-amber-500 mt-0.5 flex-shrink-0 text-sm"></i>
        <p class="text-xs text-amber-700 dark:text-amber-300 leading-relaxed">
            Withdrawals are processed within <strong>24 hours</strong>. Make sure your payment details are correct before submitting — transactions cannot be reversed once processed.
        </p>
    </div>

    <div class="h-2"></div>
</main>


{{-- ═══════════════════════════════════════════════
     MODAL: Choose Payment Method
═══════════════════════════════════════════════ --}}
<div id="cashModal"
     class="fixed inset-0 z-50 hidden items-center justify-center p-4"
     style="background:rgba(0,0,0,0.55);backdrop-filter:blur(6px);"
     onclick="closeCashModal()">

    <div id="modalPanel"
         class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-2xl w-full max-w-md overflow-hidden"
         style="animation: modalIn .3s cubic-bezier(.34,1.2,.64,1) both;"
         onclick="event.stopPropagation()">

        {{-- Modal header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-50 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-brand-600 dark:text-brand-400 text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white text-base">Choose Payment Method</h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500">Select your preferred withdrawal option</p>
                </div>
            </div>
            <button onclick="closeCashModal()"
                    class="w-8 h-8 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        {{-- Options --}}
            <div class="px-6 py-5 space-y-3">
                @auth
                    @php $country = auth()->user()->country; @endphp

                    {{-- Ghana: Mobile Money --}}
                    @if($country === 'GH')
                        <a href="/momo"
                        class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 rounded-2xl
                                hover:border-yellow-400 dark:hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20
                                transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-2xl bg-yellow-400 flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-105 transition-transform">
                                <span class="text-yellow-900 font-black text-xs">MTN</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 dark:text-white text-sm">Mobile Money</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">MTN, AirtelTigo, Telecel — GHS payout</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 group-hover:text-yellow-500 group-hover:translate-x-0.5 transition-all text-sm"></i>
                        </a>

                    {{-- Kenya: M-Pesa --}}
                    @elseif($country === 'KE')
                        <a href="/mpesa"
                        class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 rounded-2xl
                                hover:border-green-400 dark:hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20
                                transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-2xl bg-green-600 flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-105 transition-transform">
                                <span class="text-white font-black text-[10px] leading-tight text-center">M<br>PESA</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 dark:text-white text-sm">M-Pesa</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Safaricom M-Pesa — KES payout</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 group-hover:text-green-500 group-hover:translate-x-0.5 transition-all text-sm"></i>
                        </a>

                    {{-- Nigeria: Bank Transfer --}}
                    @elseif($country === 'NG')
                        <a href="/bank-transfer"
                        class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 rounded-2xl
                                hover:border-emerald-400 dark:hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/20
                                transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-600 flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-105 transition-transform">
                                <i class="fas fa-university text-white text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 dark:text-white text-sm">Bank Transfer</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Direct to your Nigerian bank — NGN payout</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 group-hover:text-emerald-500 group-hover:translate-x-0.5 transition-all text-sm"></i>
                        </a>

                    {{-- South Africa: Bank Transfer --}}
                    @elseif($country === 'ZA')
                        <a href="/bank-transfer"
                        class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 rounded-2xl
                                hover:border-blue-400 dark:hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20
                                transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-105 transition-transform">
                                <i class="fas fa-university text-white text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 dark:text-white text-sm">Bank Transfer</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Direct to your SA bank — ZAR payout</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 group-hover:text-blue-500 group-hover:translate-x-0.5 transition-all text-sm"></i>
                        </a>

                    {{-- All other countries: Crypto / Binance --}}
                    @else
                        <a href="/binance"
                        class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 rounded-2xl
                                hover:border-amber-400 dark:hover:border-amber-500 hover:bg-amber-50 dark:hover:bg-amber-900/20
                                transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-2xl bg-amber-400 flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-105 transition-transform">
                                <i class="fas fa-coins text-amber-900 text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 dark:text-white text-sm">Crypto — Binance</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">USDT payout via Binance ID</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 group-hover:text-amber-500 group-hover:translate-x-0.5 transition-all text-sm"></i>
                        </a>
                    @endif

                @endauth

                {{-- Processing time note --}}
                <div class="flex items-center gap-2.5 px-1 pt-1">
                    <i class="fas fa-clock text-gray-300 dark:text-gray-600 text-xs"></i>
                    <p class="text-xs text-gray-400 dark:text-gray-500">
                        All withdrawals are processed within <strong class="text-gray-600 dark:text-gray-300">24 hours</strong>.
                    </p>
                </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 pb-5">
            <button onclick="closeCashModal()"
                    class="w-full py-3 rounded-2xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 text-sm font-semibold text-gray-500 dark:text-gray-400
                           hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                Cancel
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes modalIn {
        from { opacity:0; transform:translateY(16px) scale(.97); }
        to   { opacity:1; transform:translateY(0)    scale(1);   }
    }
</style>

<script>
    function openCashModal() {
        const m = document.getElementById('cashModal');
        m.classList.remove('hidden');
        m.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeCashModal() {
        const m = document.getElementById('cashModal');
        m.classList.add('hidden');
        m.classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeCashModal();
    });
</script>

@endsection