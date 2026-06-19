@extends('user.layout')
@section('content')

@php
    $credit       = DB::table('credit')->where('user_id', auth()->user()->id)->first();
    $userPoints   = $credit->credit ?? 0;
    $hasEnough    = $userPoints > 30;
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
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">Mobile Money</h1>
            <p class="text-sm text-gray-400 dark:text-gray-500">Withdraw your earnings to your mobile wallet</p>
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
    <div class="relative overflow-hidden bg-gradient-to-br from-brand-600 via-brand-500 to-emerald-400 rounded-3xl p-6 text-white shadow-xl shadow-brand-500/20 animate-slide-up delay-1">
        {{-- decorative circles --}}
        <div class="absolute -top-8 -right-8 w-36 h-36 bg-white/10 rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-6 w-28 h-28 bg-white/10 rounded-full pointer-events-none"></div>

        <div class="relative z-10">
            <div class="flex items-start justify-between mb-5">
                <div>
                    <p class="text-brand-100 text-sm font-medium mb-1">Available Earnings</p>
                    <p class="text-4xl font-extrabold tracking-tight font-mono">
                        GHS {{ number_format((float) $userPoints, 2) }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-white/15 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-mobile-alt text-xl"></i>
                </div>
            </div>

            {{-- Progress to minimum --}}
            <div class="space-y-1.5">
                <div class="flex items-center justify-between text-xs text-brand-100">
                    <span>Minimum cashout: <strong class="text-white">GHS 30</strong></span>
                    @if($hasEnough)
                        <span class="flex items-center gap-1 font-semibold text-white">
                            <i class="fas fa-check-circle text-xs"></i> Ready to withdraw
                        </span>
                    @else
                        <span class="text-brand-200">Need {{ number_format(max(0, 30 - (float)$userPoints), 2) }} more</span>
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
            <div class="w-10 h-10 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-money-bill-wave text-brand-600 dark:text-brand-400 text-sm"></i>
            </div>
            <div>
                <h2 class="font-bold text-gray-900 dark:text-white">Withdrawal Details</h2>
                <p class="text-xs text-gray-400 dark:text-gray-500">Fill in your mobile money information</p>
            </div>
        </div>

        <form action="{{ route('momo.store') }}" method="POST" class="space-y-6" id="momoForm">
            @csrf

            {{-- ── Network Provider ── --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-3">
                    Network Provider <span class="text-red-400">*</span>
                </label>
                <div class="grid grid-cols-3 gap-3">

                    {{-- MTN --}}
                    <label class="relative block cursor-pointer group">
                        <input type="radio" name="network" value="mtn" class="peer sr-only" required>
                        <div class="flex flex-col items-center justify-center gap-2 p-4 border-2 border-gray-100 dark:border-gray-700 rounded-2xl transition-all duration-200
                                    peer-checked:border-brand-500 peer-checked:bg-brand-50 dark:peer-checked:bg-brand-900/20
                                    group-hover:border-brand-300 dark:group-hover:border-brand-700 bg-gray-50 dark:bg-gray-800">
                            <div class="w-10 h-10 rounded-xl bg-yellow-400 flex items-center justify-center shadow-sm flex-shrink-0">
                                <span class="text-yellow-900 font-black text-xs">MTN</span>
                            </div>
                            <div class="text-center">
                                <p class="font-bold text-gray-900 dark:text-white text-sm peer-checked:text-brand-700 leading-tight">MTN</p>
                                <p class="text-[10px] text-gray-400 leading-tight">Mobile Money</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-2 w-5 h-5 bg-brand-500 rounded-full items-center justify-center hidden peer-checked:flex">
                            <i class="fas fa-check text-white text-[8px]"></i>
                        </div>
                    </label>

                    {{-- Tigo --}}
                    <label class="relative block cursor-pointer group">
                        <input type="radio" name="network" value="tigo" class="peer sr-only" required>
                        <div class="flex flex-col items-center justify-center gap-2 p-4 border-2 border-gray-100 dark:border-gray-700 rounded-2xl transition-all duration-200
                                    peer-checked:border-brand-500 peer-checked:bg-brand-50 dark:peer-checked:bg-brand-900/20
                                    group-hover:border-brand-300 dark:group-hover:border-brand-700 bg-gray-50 dark:bg-gray-800">
                            <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center shadow-sm flex-shrink-0">
                                <span class="text-white font-black text-[9px] text-center leading-tight">Airtel<br>Tigo</span>
                            </div>
                            <div class="text-center">
                                <p class="font-bold text-gray-900 dark:text-white text-sm leading-tight">Tigo Cash</p>
                                <p class="text-[10px] text-gray-400 leading-tight">AirtelTigo</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-2 w-5 h-5 bg-brand-500 rounded-full items-center justify-center hidden peer-checked:flex">
                            <i class="fas fa-check text-white text-[8px]"></i>
                        </div>
                    </label>

                    {{-- Telecel --}}
                    <label class="relative block cursor-pointer group">
                        <input type="radio" name="network" value="telecel" class="peer sr-only" required>
                        <div class="flex flex-col items-center justify-center gap-2 p-4 border-2 border-gray-100 dark:border-gray-700 rounded-2xl transition-all duration-200
                                    peer-checked:border-brand-500 peer-checked:bg-brand-50 dark:peer-checked:bg-brand-900/20
                                    group-hover:border-brand-300 dark:group-hover:border-brand-700 bg-gray-50 dark:bg-gray-800">
                            <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center shadow-sm flex-shrink-0">
                                <span class="text-white font-black text-[9px] text-center leading-tight">Tele<br>cel</span>
                            </div>
                            <div class="text-center">
                                <p class="font-bold text-gray-900 dark:text-white text-sm leading-tight">Telecel</p>
                                <p class="text-[10px] text-gray-400 leading-tight">Formerly Vodafone</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-2 w-5 h-5 bg-brand-500 rounded-full items-center justify-center hidden peer-checked:flex">
                            <i class="fas fa-check text-white text-[8px]"></i>
                        </div>
                    </label>

                </div>
            </div>

            {{-- ── Phone Number ── --}}
            <div class="space-y-1.5">
                <label for="phone" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Phone Number <span class="text-red-400">*</span>
                </label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 flex items-center gap-2 pointer-events-none">
                        <span class="text-sm font-bold text-gray-500 dark:text-gray-400">+233</span>
                        <div class="w-px h-5 bg-gray-200 dark:bg-gray-700"></div>
                    </div>
                    <input type="tel"
                           id="phone"
                           name="phone"
                           placeholder="XX XXX XXXX"
                           value="{{ old('phone') }}"
                           class="w-full pl-[72px] pr-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-brand-400 dark:focus:border-brand-500 transition font-mono"
                           required>
                    <div id="phone-check" class="absolute right-4 hidden">
                        <i class="fas fa-check-circle text-brand-500 text-sm"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-600 pl-1">Without country code — e.g. 24 123 4567</p>
            </div>

            {{-- ── Full Name ── --}}
            <div class="space-y-1.5">
                <label for="name" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Full Name <span class="text-red-400">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       placeholder="Name as registered with mobile money"
                       value="{{ old('name', auth()->user()->name) }}"
                       class="w-full px-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-brand-400 dark:focus:border-brand-500 transition"
                       required>
                <p class="text-xs text-gray-400 dark:text-gray-600 pl-1">Must match the name on your mobile money account</p>
            </div>

            {{-- ── Amount ── --}}
            <div class="space-y-1.5">
                <label for="amount" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Withdrawal Amount <span class="text-red-400">*</span>
                </label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 flex items-center gap-2 pointer-events-none">
                        <span class="text-sm font-bold text-gray-500 dark:text-gray-400">GHS</span>
                        <div class="w-px h-5 bg-gray-200 dark:bg-gray-700"></div>
                    </div>
                    <input type="number"
                           id="amount"
                           name="amount"
                           placeholder="0.00"
                           value="{{ old('amount') }}"
                           min="30"
                           max="{{ number_format((float) $userPoints, 2, '.', '') }}"
                           step="0.01"
                           class="w-full pl-[72px] pr-20 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-brand-400 dark:focus:border-brand-500 transition font-mono"
                           {{ !$hasEnough ? 'disabled' : 'required' }}>
                    @if($hasEnough)
                        <button type="button"
                                id="maxBtn"
                                class="absolute right-3 text-[10px] font-bold text-brand-600 dark:text-brand-400 bg-brand-50 dark:bg-brand-900/30 border border-brand-200 dark:border-brand-700 px-2 py-1 rounded-lg hover:bg-brand-100 dark:hover:bg-brand-900/50 transition">
                            MAX
                        </button>
                    @endif
                </div>
                <div class="flex items-center justify-between pl-1">
                    <p class="text-xs text-gray-400 dark:text-gray-600">
                        Min: <strong>GHS 30</strong> &nbsp;·&nbsp; Max: <strong>GHS {{ number_format((float) $userPoints, 2) }}</strong>
                    </p>
                    <p id="amount-error" class="text-xs text-red-500 hidden font-medium">
                        <i class="fas fa-exclamation-circle mr-1"></i>Exceeds your balance
                    </p>
                </div>
            </div>

            {{-- ── Insufficient points warning ── --}}
            @if(!$hasEnough)
                <div class="flex items-start gap-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/50 rounded-2xl px-4 py-3.5">
                    <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 flex-shrink-0 text-sm"></i>
                    <div>
                        <p class="text-sm font-semibold text-red-700 dark:text-red-300">Insufficient balance</p>
                        <p class="text-xs text-red-600 dark:text-red-400 mt-0.5">
                            You need more than GHS 30 to withdraw. Your current balance is
                            <strong>GHS {{ number_format((float) $userPoints, 2) }}</strong>.
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
                       class="mt-0.5 w-4 h-4 rounded accent-brand-500 flex-shrink-0 cursor-pointer"
                       required>
                <label for="terms" class="text-xs text-gray-500 dark:text-gray-400 cursor-pointer leading-relaxed">
                    I confirm that the mobile money details provided are correct. I understand withdrawals are
                    processed within <strong class="text-gray-700 dark:text-gray-300">24–48 hours</strong>
                    and are final — they cannot be reversed once submitted.
                </label>
            </div>

            {{-- ── Submit button ── --}}
            @if($hasEnough)
                <button type="submit"
                        id="submitBtn"
                        class="w-full flex items-center justify-center gap-3 bg-gradient-to-r from-brand-500 to-brand-600 text-white font-bold py-4 rounded-2xl transition-all duration-200 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-brand-500/30 text-base">
                    <i class="fas fa-paper-plane text-sm"></i>
                    Withdraw Funds
                </button>
            @else
                <button type="button"
                        class="w-full flex items-center justify-center gap-3 bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 font-bold py-4 rounded-2xl cursor-not-allowed text-base border border-gray-200 dark:border-gray-700"
                        disabled>
                    <i class="fas fa-lock text-sm"></i>
                    Insufficient Balance (Need GHS 30+)
                </button>
            @endif

            {{-- ── Trust badges ── --}}
            <div class="grid grid-cols-3 gap-3 pt-2">
                <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                    <i class="fas fa-clock text-brand-500 text-base"></i>
                    <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 leading-tight">24–48 hr processing</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                    <i class="fas fa-shield-alt text-brand-500 text-base"></i>
                    <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 leading-tight">Secure transaction</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                    <i class="fas fa-headset text-brand-500 text-base"></i>
                    <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 leading-tight">24/7 support</span>
                </div>
            </div>

        </form>
    </div>

    <div class="h-2"></div>
</main>

<script>
    const MAX_BALANCE = {{ (float) $userPoints }};

    // Phone number auto-formatting
    document.getElementById('phone')?.addEventListener('input', function(e) {
        let val = e.target.value.replace(/\D/g, '').substring(0, 9);
        if      (val.length <= 2) e.target.value = val;
        else if (val.length <= 5) e.target.value = val.slice(0,2) + ' ' + val.slice(2);
        else                      e.target.value = val.slice(0,2) + ' ' + val.slice(2,5) + ' ' + val.slice(5);

        // show checkmark when 9 digits entered
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
        const isUnderMin    = val < 30 && this.value !== '';

        // Toggle error
        if (isOverBalance) {
            amountError.textContent = 'Exceeds your balance';
            amountError.classList.remove('hidden');
            this.classList.add('border-red-400', 'dark:border-red-500');
            this.classList.remove('border-gray-100', 'dark:border-gray-700');
        } else if (isUnderMin) {
            amountError.textContent = 'Minimum withdrawal is GHS 30';
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

    // Submit loading state — also guard against over-balance submission
    document.getElementById('momoForm')?.addEventListener('submit', function(e) {
        const val = parseFloat(amountInput?.value || 0);

        if (val > MAX_BALANCE) {
            e.preventDefault();
            amountInput.focus();
            return;
        }

        if (val < 30) {
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