@extends('user.layout')
@section('content')

@php
    $credit       = DB::table('credit')->where('user_id', auth()->user()->id)->first();
    $userPoints   = $credit->credit ?? 0;
    $hasEnough    = $userPoints >= 100;
    $pct          = min(100, ($userPoints / 100) * 100);
@endphp

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
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">M-Pesa</h1>
            <p class="text-sm text-gray-400 dark:text-gray-500">Withdraw your earnings to your M-Pesa wallet</p>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-brand-50 dark:bg-brand-900/30 border border-brand-200 dark:border-brand-800 text-brand-800 dark:text-brand-200 px-4 py-3 rounded-2xl text-sm animate-slide-up">
            <i class="fas fa-check-circle text-brand-500 flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-2xl text-sm animate-slide-up">
            <i class="fas fa-exclamation-circle text-red-500 flex-shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-2xl text-sm animate-slide-up">
            <div class="flex items-center gap-2 mb-2">
                <i class="fas fa-exclamation-triangle text-red-500 flex-shrink-0"></i>
                <span class="font-semibold">Please fix the following:</span>
            </div>
            <ul class="space-y-1 pl-6 list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ═══════════════════════════════════
         BALANCE CARD
    ═══════════════════════════════════ --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-green-700 via-green-600 to-emerald-400 rounded-3xl p-6 text-white shadow-xl shadow-green-600/20 animate-slide-up delay-1">
        {{-- decorative circles --}}
        <div class="absolute -top-8 -right-8 w-36 h-36 bg-white/10 rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-6 w-28 h-28 bg-white/10 rounded-full pointer-events-none"></div>

        {{-- M-Pesa logo mark --}}
        <div class="absolute top-5 right-5 opacity-10 pointer-events-none">
            <span class="text-6xl font-black tracking-tighter">M</span>
        </div>

        <div class="relative z-10">
            <div class="flex items-start justify-between mb-5">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Available Earnings</p>
                    <p class="text-4xl font-extrabold tracking-tight font-mono">
                        KSH {{ number_format((float) $userPoints, 2) }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-white/15 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-black text-sm leading-none">M<br><span class="text-[9px] font-bold tracking-widest">PESA</span></span>
                </div>
            </div>

            {{-- Progress to minimum --}}
            <div class="space-y-1.5">
                <div class="flex items-center justify-between text-xs text-green-100">
                    <span>Minimum cashout: <strong class="text-white">KSH 100</strong></span>
                    @if($hasEnough)
                        <span class="flex items-center gap-1 font-semibold text-white">
                            <i class="fas fa-check-circle text-xs"></i> Ready to withdraw
                        </span>
                    @else
                        <span class="text-green-200">Need {{ number_format(max(0, 100 - (float)$userPoints), 2) }} more</span>
                    @endif
                </div>
                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                    <div class="h-full bg-white rounded-full transition-all duration-700"
                         style="width: {{ $pct }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════
         WITHDRAWAL FORM
    ═══════════════════════════════════ --}}
    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-6 sm:p-8 animate-slide-up delay-2">

        <div class="flex items-center gap-3 mb-7">
            <div class="w-10 h-10 rounded-2xl bg-green-50 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-mobile-alt text-green-600 dark:text-green-400 text-sm"></i>
            </div>
            <div>
                <h2 class="font-bold text-gray-900 dark:text-white">Withdrawal Details</h2>
                <p class="text-xs text-gray-400 dark:text-gray-500">Enter your M-Pesa registered information</p>
            </div>
        </div>

        <form action="{{ route('mpesa.store') }}" method="POST" class="space-y-6" id="mpesaForm">
            @csrf

            {{-- ── Provider Badge ── --}}
            <div class="flex items-center gap-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/50 rounded-2xl">
                <div class="w-12 h-12 rounded-xl bg-green-600 flex items-center justify-center shadow-sm flex-shrink-0">
                    <span class="text-white font-black text-[11px] text-center leading-tight">M<br>PESA</span>
                </div>
                <div>
                    <p class="font-bold text-gray-900 dark:text-white text-sm">Safaricom M-Pesa</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Kenya's leading mobile money platform</p>
                </div>
                <div class="ml-auto w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check text-white text-[9px]"></i>
                </div>
            </div>

            {{-- ── Phone Number ── --}}
            <div class="space-y-1.5">
                <label for="phone" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    M-Pesa Phone Number <span class="text-red-400">*</span>
                </label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 flex items-center gap-2 pointer-events-none">
                        <span class="text-sm font-bold text-gray-500 dark:text-gray-400">+254</span>
                        <div class="w-px h-5 bg-gray-200 dark:bg-gray-700"></div>
                    </div>
                    <input type="tel"
                           id="phone"
                           name="phone"
                           placeholder="7XX XXX XXX"
                           value="{{ old('phone') }}"
                           class="w-full pl-[76px] pr-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-green-400 dark:focus:border-green-500 transition font-mono"
                           required>
                    <div id="phone-check" class="absolute right-4 hidden">
                        <i class="fas fa-check-circle text-green-500 text-sm"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-600 pl-1">Without country code — e.g. 712 345 678</p>
            </div>

            {{-- ── Full Name ── --}}
            <div class="space-y-1.5">
                <label for="name" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Full Name <span class="text-red-400">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       placeholder="Name as registered with M-Pesa"
                       value="{{ old('name', auth()->user()->name) }}"
                       class="w-full px-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-green-400 dark:focus:border-green-500 transition"
                       required>
                <p class="text-xs text-gray-400 dark:text-gray-600 pl-1">Must match the name on your M-Pesa account</p>
            </div>

            {{-- ── Amount ── --}}
            <div class="space-y-1.5">
                <label for="amount" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Withdrawal Amount <span class="text-red-400">*</span>
                </label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 flex items-center gap-2 pointer-events-none">
                        <span class="text-sm font-bold text-gray-500 dark:text-gray-400">KSH</span>
                        <div class="w-px h-5 bg-gray-200 dark:bg-gray-700"></div>
                    </div>
                    <input type="number"
                           id="amount"
                           name="amount"
                           placeholder="0.00"
                           value="{{ old('amount') }}"
                           min="100"
                           max="{{ number_format((float) $userPoints, 2, '.', '') }}"
                           step="0.01"
                           class="w-full pl-[76px] pr-20 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-green-400 dark:focus:border-green-500 transition font-mono"
                           {{ !$hasEnough ? 'disabled' : 'required' }}>
                    @if($hasEnough)
                        <button type="button"
                                id="maxBtn"
                                class="absolute right-3 text-[10px] font-bold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 px-2 py-1 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition">
                            MAX
                        </button>
                    @endif
                </div>
                <div class="flex items-center justify-between pl-1">
                    <p class="text-xs text-gray-400 dark:text-gray-600">
                        Min: <strong>KSH 100</strong> &nbsp;·&nbsp; Max: <strong>KSH {{ number_format((float) $userPoints, 2) }}</strong>
                    </p>
                    <p id="amount-error" class="text-xs text-red-500 hidden font-medium">
                        <i class="fas fa-exclamation-circle mr-1"></i>Exceeds your balance
                    </p>
                </div>
            </div>

            {{-- ── Insufficient balance warning ── --}}
            @if(!$hasEnough)
                <div class="flex items-start gap-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 rounded-2xl px-4 py-3.5">
                    <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 flex-shrink-0 text-sm"></i>
                    <div>
                        <p class="text-sm font-semibold text-red-700 dark:text-red-300">Insufficient balance</p>
                        <p class="text-xs text-red-600 dark:text-red-400 mt-0.5">
                            You need at least KSH 100 to withdraw. Your current balance is
                            <strong>KSH {{ number_format((float) $userPoints, 2) }}</strong>.
                            Keep reading articles to earn more!
                        </p>
                    </div>
                </div>
            @endif

            {{-- ── Terms ── --}}
            <div class="flex items-start gap-3 p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700">
                <input type="checkbox"
                       id="terms"
                       name="terms"
                       class="mt-0.5 w-4 h-4 rounded accent-green-500 flex-shrink-0 cursor-pointer"
                       required>
                <label for="terms" class="text-xs text-gray-500 dark:text-gray-400 cursor-pointer leading-relaxed">
                    I confirm that the M-Pesa details provided are correct. I understand withdrawals are
                    processed within <strong class="text-gray-700 dark:text-gray-300">24–48 hours</strong>
                    and are final — they cannot be reversed once submitted.
                </label>
            </div>

            {{-- ── Submit button ── --}}
            @if($hasEnough)
                <button type="submit"
                        id="submitBtn"
                        class="w-full flex items-center justify-center gap-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold py-4 rounded-2xl transition-all duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-green-600/30 text-base">
                    <i class="fas fa-paper-plane text-sm"></i>
                    Withdraw via M-Pesa
                </button>
            @else
                <button type="button"
                        class="w-full flex items-center justify-center gap-3 bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 font-bold py-4 rounded-2xl cursor-not-allowed text-base border border-gray-200 dark:border-gray-700"
                        disabled>
                    <i class="fas fa-lock text-sm"></i>
                    Insufficient Balance (Need KSH 100+)
                </button>
            @endif

            {{-- ── Trust badges ── --}}
            <div class="grid grid-cols-3 gap-3 pt-2">
                <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                    <i class="fas fa-clock text-green-500 text-base"></i>
                    <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 leading-tight">24–48 hr processing</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                    <i class="fas fa-shield-alt text-green-500 text-base"></i>
                    <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 leading-tight">Secure transaction</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                    <i class="fas fa-headset text-green-500 text-base"></i>
                    <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 leading-tight">24/7 support</span>
                </div>
            </div>

        </form>
    </div>

    <div class="h-2"></div>
</main>

<script>
    const MAX_BALANCE = {{ (float) $userPoints }};

    // Phone number auto-formatting (Kenyan: 9 digits starting with 7 or 1)
    document.getElementById('phone')?.addEventListener('input', function(e) {
        let val = e.target.value.replace(/\D/g, '').substring(0, 9);
        if      (val.length <= 3) e.target.value = val;
        else if (val.length <= 6) e.target.value = val.slice(0,3) + ' ' + val.slice(3);
        else                      e.target.value = val.slice(0,3) + ' ' + val.slice(3,6) + ' ' + val.slice(6);

        const check = document.getElementById('phone-check');
        if (val.length === 9) check?.classList.remove('hidden');
        else                  check?.classList.add('hidden');
    });

    // Amount validation
    const amountInput = document.getElementById('amount');
    const amountError = document.getElementById('amount-error');

    amountInput?.addEventListener('input', function() {
        const val = parseFloat(this.value);
        const isOverBalance = val > MAX_BALANCE;
        const isUnderMin    = val < 100 && this.value !== '';

        if (isOverBalance) {
            amountError.textContent = 'Exceeds your balance';
            amountError.classList.remove('hidden');
            this.classList.add('border-red-400', 'dark:border-red-500');
            this.classList.remove('border-gray-100', 'dark:border-gray-700');
        } else if (isUnderMin) {
            amountError.textContent = 'Minimum withdrawal is KSH 100';
            amountError.classList.remove('hidden');
            this.classList.add('border-red-400', 'dark:border-red-500');
            this.classList.remove('border-gray-100', 'dark:border-gray-700');
        } else {
            amountError.classList.add('hidden');
            this.classList.remove('border-red-400', 'dark:border-red-500');
            this.classList.add('border-gray-100', 'dark:border-gray-700');
        }
    });

    // MAX button
    document.getElementById('maxBtn')?.addEventListener('click', function() {
        if (amountInput) {
            amountInput.value = MAX_BALANCE.toFixed(2);
            amountInput.dispatchEvent(new Event('input'));
        }
    });

    // Submit guard
    document.getElementById('mpesaForm')?.addEventListener('submit', function(e) {
        const val = parseFloat(amountInput?.value || 0);

        if (val > MAX_BALANCE || val < 100) {
            e.preventDefault();
            amountInput.focus();
            return;
        }

        const btn = document.getElementById('submitBtn');
        if (!btn) return;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin text-sm"></i> Processing…';
        btn.classList.add('opacity-80');
    });
</script>

@endsection