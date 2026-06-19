@extends('user.layout')
@section('content')

@php
    $credit       = DB::table('credit')->where('user_id', auth()->user()->id)->first();
    $userPoints   = $credit->credit ?? 0;
    $hasEnough    = $userPoints >= 30;
    $pct          = min(100, ($userPoints / 30) * 100);

    $banks = [
        'absa'                  => 'ABSA Bank',
        'african_bank'          => 'African Bank',
        'bidvest_bank'          => 'Bidvest Bank',
        'capitec'               => 'Capitec Bank',
        'discovery_bank'        => 'Discovery Bank',
        'fnb'                   => 'First National Bank (FNB)',
        'grindrod_bank'         => 'Grindrod Bank',
        'investec'              => 'Investec Bank',
        'mercantile_bank'       => 'Mercantile Bank',
        'nedbank'               => 'Nedbank',
        'old_mutual_finance'    => 'Old Mutual Finance',
        'sasfin_bank'           => 'Sasfin Bank',
        'standard_bank'         => 'Standard Bank',
        'tyme_bank'             => 'TymeBank',
        'ubank'                 => 'Ubank',
    ];

    $accountTypes = [
        'cheque'  => 'Cheque / Current Account',
        'savings' => 'Savings Account',
        'transmission' => 'Transmission Account',
    ];
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
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">Bank Transfer</h1>
            <p class="text-sm text-gray-400 dark:text-gray-500">Withdraw your earnings to your South African bank account</p>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-2xl text-sm animate-slide-up">
            <i class="fas fa-check-circle text-green-500 flex-shrink-0"></i>
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
    <div class="relative overflow-hidden rounded-3xl p-6 text-white shadow-xl animate-slide-up delay-1"
         style="background: linear-gradient(135deg, #007A4D 0%, #009B60 50%, #FFB612 100%);">
        {{-- SA flag colour accents --}}
        <div class="absolute top-0 left-0 w-1.5 h-full bg-black/20 pointer-events-none"></div>
        <div class="absolute top-0 left-1.5 w-1 h-full bg-[#FFB612]/60 pointer-events-none"></div>
        <div class="absolute -top-8 -right-8 w-36 h-36 bg-white/10 rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-6 w-28 h-28 bg-white/10 rounded-full pointer-events-none"></div>

        <div class="relative z-10">
            <div class="flex items-start justify-between mb-5">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Available Earnings</p>
                    <p class="text-4xl font-extrabold tracking-tight font-mono">
                        R {{ number_format((float) $userPoints, 2) }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-white/15 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-university text-xl"></i>
                </div>
            </div>

            {{-- Progress to minimum --}}
            <div class="space-y-1.5">
                <div class="flex items-center justify-between text-xs text-green-100">
                    <span>Minimum cashout: <strong class="text-white">R 30.00</strong></span>
                    @if($hasEnough)
                        <span class="flex items-center gap-1 font-semibold text-white">
                            <i class="fas fa-check-circle text-xs"></i> Ready to withdraw
                        </span>
                    @else
                        <span class="text-green-200">Need R {{ number_format(max(0, 30 - (float)$userPoints), 2) }} more</span>
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
                <i class="fas fa-building-columns text-green-700 dark:text-green-400 text-sm"></i>
            </div>
            <div>
                <h2 class="font-bold text-gray-900 dark:text-white">Bank Account Details</h2>
                <p class="text-xs text-gray-400 dark:text-gray-500">Enter your South African bank account information</p>
            </div>
        </div>

        <form action="{{ route('bank.southafrica.store') }}" method="POST" class="space-y-6" id="bankForm">
            @csrf

            {{-- ── Bank Selection ── --}}
            <div class="space-y-1.5">
                <label for="bank_name" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Select Bank <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                        <i class="fas fa-landmark text-gray-400 dark:text-gray-500 text-sm"></i>
                    </div>
                    <select id="bank_name"
                            name="bank_name"
                            class="w-full pl-10 pr-10 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white focus:outline-none focus:border-green-500 dark:focus:border-green-500 transition appearance-none cursor-pointer"
                            required>
                        <option value="" disabled {{ old('bank_name') ? '' : 'selected' }}>— Choose your bank —</option>
                        @foreach($banks as $value => $label)
                            <option value="{{ $value }}" {{ old('bank_name') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                    </div>
                </div>
            </div>

            {{-- ── Account Type ── --}}
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Account Type <span class="text-red-400">*</span>
                </label>
                <div class="grid grid-cols-3 gap-3">
                    @foreach($accountTypes as $value => $label)
                        <label class="relative block cursor-pointer group">
                            <input type="radio" name="account_type" value="{{ $value }}"
                                   class="peer sr-only" {{ old('account_type') === $value ? 'checked' : '' }} required>
                            <div class="flex flex-col items-center justify-center gap-1.5 p-3 border-2 border-gray-100 dark:border-gray-700 rounded-2xl transition-all duration-200
                                        peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20
                                        group-hover:border-green-300 dark:group-hover:border-green-700 bg-gray-50 dark:bg-gray-800 text-center">
                                <i class="fas {{ $value === 'cheque' ? 'fa-money-check' : ($value === 'savings' ? 'fa-piggy-bank' : 'fa-exchange-alt') }} text-gray-400 peer-checked:text-green-600 text-base transition-colors"></i>
                                <p class="font-semibold text-gray-700 dark:text-gray-300 text-[11px] leading-tight">
                                    {{ $value === 'cheque' ? 'Cheque' : ($value === 'savings' ? 'Savings' : 'Transmission') }}
                                </p>
                            </div>
                            <div class="absolute top-1.5 right-1.5 w-4 h-4 bg-green-500 rounded-full items-center justify-center hidden peer-checked:flex">
                                <i class="fas fa-check text-white text-[7px]"></i>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- ── Account Number ── --}}
            <div class="space-y-1.5">
                <label for="account_number" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Account Number <span class="text-red-400">*</span>
                </label>
                <div class="relative flex items-center">
                    <input type="text"
                           id="account_number"
                           name="account_number"
                           placeholder="e.g. 1234567890"
                           value="{{ old('account_number') }}"
                           maxlength="11"
                           class="w-full px-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-green-500 dark:focus:border-green-500 transition font-mono tracking-widest"
                           required>
                    <div id="acc-check" class="absolute right-4 hidden">
                        <i class="fas fa-check-circle text-green-500 text-sm"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-600 pl-1">9 to 11 digits depending on your bank</p>
            </div>

            {{-- ── Branch Code ── --}}
            <div class="space-y-1.5">
                <label for="branch_code" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Branch Code <span class="text-red-400">*</span>
                </label>
                <div class="relative flex items-center">
                    <input type="text"
                           id="branch_code"
                           name="branch_code"
                           placeholder="e.g. 632005"
                           value="{{ old('branch_code') }}"
                           maxlength="6"
                           class="w-full px-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-green-500 dark:focus:border-green-500 transition font-mono tracking-widest"
                           required>
                    <div id="branch-check" class="absolute right-4 hidden">
                        <i class="fas fa-check-circle text-green-500 text-sm"></i>
                    </div>
                </div>
                {{-- Common branch codes helper --}}
                <div class="flex flex-wrap gap-2 pt-1">
                    <p class="text-xs text-gray-400 dark:text-gray-600 w-full pl-1">Common universal branch codes:</p>
                    @foreach([
                        'ABSA' => '632005', 'Capitec' => '470010', 'FNB' => '250655',
                        'Nedbank' => '198765', 'Standard Bank' => '051001', 'TymeBank' => '678910',
                    ] as $bankName => $code)
                        <button type="button"
                                onclick="fillBranch('{{ $code }}')"
                                class="text-[10px] font-semibold px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-200 dark:border-gray-700 hover:border-green-400 hover:text-green-600 dark:hover:text-green-400 transition">
                            {{ $bankName }}: {{ $code }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- ── Account Name ── --}}
            <div class="space-y-1.5">
                <label for="account_name" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Account Holder Name <span class="text-red-400">*</span>
                </label>
                <input type="text"
                       id="account_name"
                       name="account_name"
                       placeholder="Name as it appears on your bank account"
                       value="{{ old('account_name', auth()->user()->name) }}"
                       class="w-full px-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-green-500 dark:focus:border-green-500 transition"
                       required>
                <p class="text-xs text-gray-400 dark:text-gray-600 pl-1">Must match your bank account exactly</p>
            </div>

            {{-- ── Amount ── --}}
            <div class="space-y-1.5">
                <label for="amount" class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                    Withdrawal Amount <span class="text-red-400">*</span>
                </label>
                <div class="relative flex items-center">
                    <div class="absolute left-4 flex items-center gap-2 pointer-events-none">
                        <span class="text-sm font-bold text-gray-500 dark:text-gray-400">R</span>
                        <div class="w-px h-5 bg-gray-200 dark:bg-gray-700"></div>
                    </div>
                    <input type="number"
                           id="amount"
                           name="amount"
                           placeholder="0.00"
                           value="{{ old('amount') }}"
                           min="10"
                           max="{{ number_format((float) $userPoints, 2, '.', '') }}"
                           step="0.01"
                           class="w-full pl-12 pr-20 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-sm text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-green-500 dark:focus:border-green-500 transition font-mono"
                           {{ !$hasEnough ? 'disabled' : 'required' }}>
                    @if($hasEnough)
                        <button type="button"
                                id="maxBtn"
                                class="absolute right-3 text-[10px] font-bold text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 px-2 py-1 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/50 transition">
                            MAX
                        </button>
                    @endif
                </div>
                <div class="flex items-center justify-between pl-1">
                    <p class="text-xs text-gray-400 dark:text-gray-600">
                        Min: <strong>R 30.00</strong> &nbsp;·&nbsp; Max: <strong>R {{ number_format((float) $userPoints, 2) }}</strong>
                    </p>
                    <p id="amount-error" class="text-xs text-red-500 hidden font-medium">
                        <i class="fas fa-exclamation-circle mr-1"></i><span id="amount-error-text">Exceeds your balance</span>
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
                            You need at least R 30.00 to withdraw. Your current balance is
                            <strong>R {{ number_format((float) $userPoints, 2) }}</strong>.
                            Keep reading articles to earn more!
                        </p>
                    </div>
                </div>
            @endif

            {{-- ── EFT info notice ── --}}
            <div class="flex items-start gap-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/40 rounded-2xl px-4 py-3.5">
                <i class="fas fa-info-circle text-blue-500 mt-0.5 flex-shrink-0 text-sm"></i>
                <p class="text-xs text-blue-700 dark:text-blue-300 leading-relaxed">
                    Transfers are processed via <strong>EFT (Electronic Funds Transfer)</strong>. Double-check your
                    account number and branch code — funds sent to incorrect details cannot be recovered.
                </p>
            </div>

            {{-- ── Terms ── --}}
            <div class="flex items-start gap-3 p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700">
                <input type="checkbox"
                       id="terms"
                       name="terms"
                       class="mt-0.5 w-4 h-4 rounded accent-green-600 flex-shrink-0 cursor-pointer"
                       required>
                <label for="terms" class="text-xs text-gray-500 dark:text-gray-400 cursor-pointer leading-relaxed">
                    I confirm that all bank account details provided are accurate. I understand withdrawals are
                    processed within <strong class="text-gray-700 dark:text-gray-300">24–48 hours</strong>
                    and are final — they cannot be reversed once submitted.
                </label>
            </div>

            {{-- ── Submit button ── --}}
            @if($hasEnough)
                <button type="submit"
                        id="submitBtn"
                        class="w-full flex items-center justify-center gap-3 text-white font-bold py-4 rounded-2xl transition-all duration-200 hover:-translate-y-0.5 hover:shadow-xl text-base"
                        style="background: linear-gradient(to right, #007A4D, #009B60);">
                    <i class="fas fa-paper-plane text-sm"></i>
                    Withdraw to Bank Account
                </button>
            @else
                <button type="button"
                        class="w-full flex items-center justify-center gap-3 bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 font-bold py-4 rounded-2xl cursor-not-allowed text-base border border-gray-200 dark:border-gray-700"
                        disabled>
                    <i class="fas fa-lock text-sm"></i>
                    Insufficient Balance (Need R 30+)
                </button>
            @endif

            {{-- ── Trust badges ── --}}
            <div class="grid grid-cols-3 gap-3 pt-2">
                <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                    <i class="fas fa-clock text-green-600 text-base"></i>
                    <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 leading-tight">24–48 hr processing</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                    <i class="fas fa-shield-alt text-green-600 text-base"></i>
                    <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 leading-tight">EFT secured transfer</span>
                </div>
                <div class="flex flex-col items-center gap-1.5 p-3 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                    <i class="fas fa-headset text-green-600 text-base"></i>
                    <span class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 leading-tight">24/7 support</span>
                </div>
            </div>

        </form>
    </div>

    <div class="h-2"></div>
</main>

<script>
    const MAX_BALANCE = {{ (float) $userPoints }};

    // Account number — digits only, checkmark at 9–11 digits
    document.getElementById('account_number')?.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').substring(0, 11);
        const check = document.getElementById('acc-check');
        const len = this.value.length;
        if (len >= 9 && len <= 11) check?.classList.remove('hidden');
        else                        check?.classList.add('hidden');
    });

    // Branch code — digits only, checkmark at 6 digits
    document.getElementById('branch_code')?.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').substring(0, 6);
        const check = document.getElementById('branch-check');
        if (this.value.length === 6) check?.classList.remove('hidden');
        else                          check?.classList.add('hidden');
    });

    // Fill branch code from quick-pick buttons
    function fillBranch(code) {
        const input = document.getElementById('branch_code');
        if (!input) return;
        input.value = code;
        input.dispatchEvent(new Event('input'));
    }

    // Amount validation
    const amountInput    = document.getElementById('amount');
    const amountError    = document.getElementById('amount-error');
    const amountErrorTxt = document.getElementById('amount-error-text');

    amountInput?.addEventListener('input', function() {
        const val        = parseFloat(this.value);
        const isOver     = val > MAX_BALANCE;
        const isUnderMin = val < 30 && this.value !== '';

        if (isOver) {
            amountErrorTxt.textContent = 'Exceeds your balance';
            amountError.classList.remove('hidden');
            this.classList.add('border-red-400');
            this.classList.remove('border-gray-100');
        } else if (isUnderMin) {
            amountErrorTxt.textContent = 'Minimum withdrawal is R 30.00';
            amountError.classList.remove('hidden');
            this.classList.add('border-red-400');
            this.classList.remove('border-gray-100');
        } else {
            amountError.classList.add('hidden');
            this.classList.remove('border-red-400');
            this.classList.add('border-gray-100');
        }
    });

    // MAX button
    document.getElementById('maxBtn')?.addEventListener('click', function() {
        if (amountInput) {
            amountInput.value = MAX_BALANCE.toFixed(2);
            amountInput.dispatchEvent(new Event('input'));
        }
    });

    // Submit guard + loading state
    document.getElementById('bankForm')?.addEventListener('submit', function(e) {
        const val = parseFloat(amountInput?.value || 0);

        if (val > MAX_BALANCE || val < 10) {
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