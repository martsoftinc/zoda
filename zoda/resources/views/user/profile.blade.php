@extends('user.layout')
@section('content')

<main class="px-4 lg:px-6 py-6 max-w-5xl mx-auto space-y-6">

    {{-- ═══════════════════════════════════
         PAGE HEADER
    ═══════════════════════════════════ --}}
    <div class="flex items-center gap-4 animate-slide-up">
        <a href="/publisher"
           class="w-10 h-10 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:border-brand-300 hover:text-brand-600 dark:hover:text-brand-400 transition-all shadow-card">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">Profile Settings</h1>
            <p class="text-sm text-gray-400 dark:text-gray-500">Manage your account information</p>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session()->has('success'))
        <div class="flex items-center gap-3 bg-brand-50 dark:bg-brand-900/30 border border-brand-200 dark:border-brand-800 text-brand-800 dark:text-brand-200 px-4 py-3 rounded-2xl text-sm animate-slide-up">
            <i class="fas fa-check-circle text-brand-500 flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="flex items-center gap-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-2xl text-sm animate-slide-up">
            <i class="fas fa-exclamation-circle text-red-500 flex-shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ══════════════════════════════
             LEFT: Profile Info + Password
        ══════════════════════════════ --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Profile card --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card overflow-hidden animate-slide-up delay-1">

                {{-- Avatar banner --}}
                <div class="h-24 bg-gradient-to-r from-brand-500 via-brand-400 to-emerald-400 relative">
                    <div class="absolute -bottom-8 left-6">
                        <div class="w-16 h-16 rounded-2xl bg-white dark:bg-gray-900 border-4 border-white dark:border-gray-900 shadow-lg flex items-center justify-center">
                            <span class="font-bold text-2xl text-brand-600 dark:text-brand-400">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                </div>

                <div class="pt-12 px-6 pb-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h2>
                            <p class="text-sm text-gray-400 dark:text-gray-500">Member since {{ Auth::user()->created_at->format('M Y') }}</p>
                        </div>
                        <span class="flex items-center gap-1.5 bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 text-xs font-semibold px-3 py-1.5 rounded-full border border-brand-200 dark:border-brand-800">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span> Active
                        </span>
                    </div>

                    {{-- Info grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest flex items-center gap-1.5">
                                <i class="fas fa-user w-3"></i> Full Name
                            </label>
                            <div class="flex items-center gap-3 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-3">
                                <span class="text-sm font-medium text-gray-900 dark:text-white flex-1">{{ Auth::user()->name }}</span>
                                <i class="fas fa-lock text-gray-300 dark:text-gray-600 text-xs"></i>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-600 pl-1">Cannot be changed</p>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest flex items-center gap-1.5">
                                <i class="fas fa-id-badge w-3"></i> Account ID
                            </label>
                            <div class="flex items-center gap-3 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-3">
                                <span class="text-sm font-mono font-medium text-gray-900 dark:text-white flex-1">{{ Auth::user()->account_id }}</span>
                                <i class="fas fa-lock text-gray-300 dark:text-gray-600 text-xs"></i>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-600 pl-1">Unique identifier</p>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest flex items-center gap-1.5">
                                <i class="fas fa-envelope w-3"></i> Email Address
                            </label>
                            <div class="flex items-center gap-3 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-3">
                                <span class="text-sm font-medium text-gray-900 dark:text-white flex-1 truncate">{{ Auth::user()->email }}</span>
                                <i class="fas fa-check-circle text-brand-500 text-xs"></i>
                            </div>
                            <p class="text-xs text-brand-600 dark:text-brand-400 pl-1">Verified</p>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest flex items-center gap-1.5">
                                <i class="fas fa-globe w-3"></i> Country
                            </label>
                            <div class="flex items-center gap-3 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-3">
                                <span class="text-sm font-medium text-gray-900 dark:text-white flex-1">{{ Auth::user()->country ?? '—' }}</span>
                                <i class="fas fa-lock text-gray-300 dark:text-gray-600 text-xs"></i>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-gray-600 pl-1">Account region</p>
                        </div>

                    </div>
                </div>
            </div>

            
        </div>

        {{-- ══════════════════════════════
             RIGHT: Summary + Quick Actions
        ══════════════════════════════ --}}
        <div class="space-y-5">

            {{-- Account summary --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-6 animate-slide-up delay-1">
                <h3 class="font-bold text-gray-900 dark:text-white mb-5">Account Summary</h3>
                <div class="space-y-4">

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Status</span>
                        <span class="flex items-center gap-1.5 bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 text-xs font-semibold px-3 py-1 rounded-full border border-brand-200 dark:border-brand-800">
                            <i class="fas fa-check-circle text-brand-500 text-[10px]"></i> Active
                        </span>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-50 dark:border-gray-800">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Member Since</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-50 dark:border-gray-800">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Last Login</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ now()->format('d M Y') }}</span>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-50 dark:border-gray-800">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Email Verified</span>
                        <i class="fas fa-check-circle text-brand-500"></i>
                    </div>

                </div>
            </div>

            {{-- Quick actions --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-6 animate-slide-up delay-2">
                <h3 class="font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                <div class="space-y-2">

                    <a href="/publisher" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                        <div class="w-9 h-9 rounded-xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-home text-brand-600 dark:text-brand-400 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 flex-1">Dashboard</span>
                        <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs group-hover:text-brand-400 transition-colors"></i>
                    </a>

                    <a href="/payments" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-blue-500 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 flex-1">Payment History</span>
                        <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs group-hover:text-brand-400 transition-colors"></i>
                    </a>

                    <a href="/referrals" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-users text-amber-500 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 flex-1">Referral Program</span>
                        <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs group-hover:text-brand-400 transition-colors"></i>
                    </a>

                    <a href="/choose" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                        <div class="w-9 h-9 rounded-xl bg-red-50 dark:bg-red-900/20 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-money-bill-wave text-red-500 text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 flex-1">Redeem Earnings</span>
                        <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs group-hover:text-brand-400 transition-colors"></i>
                    </a>

                </div>
            </div>

        </div>
    </div>
</main>

{{-- ═══════════════════════════════════
     MODAL 1: Send Code
═══════════════════════════════════ --}}
<div id="sendCodeModal"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4"
     onclick="closeSendCodeModal()">
    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl w-full max-w-md p-6 border border-gray-100 dark:border-gray-800"
         onclick="event.stopPropagation()">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Security Verification</h2>
                <p class="text-xs text-gray-400 mt-0.5">Step 1 of 2</p>
            </div>
            <button onclick="closeSendCodeModal()" class="w-8 h-8 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        <div class="text-center py-2">
            <div class="w-20 h-20 mx-auto mb-5 bg-brand-50 dark:bg-brand-900/30 rounded-3xl flex items-center justify-center">
                <i class="fas fa-envelope text-brand-500 text-3xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Send Verification Code</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5 leading-relaxed">
                A verification code will be sent to<br>
                <span class="font-semibold text-brand-600 dark:text-brand-400">{{ Auth::user()->email }}</span>
            </p>
            <div class="flex items-start gap-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 rounded-2xl p-4 mb-6 text-left">
                <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5 flex-shrink-0 text-sm"></i>
                <p class="text-xs text-amber-700 dark:text-amber-300">Verification is required before changing your password for security reasons.</p>
            </div>
            <button onclick="sendVerificationCode()" id="sendCodeBtn"
                    class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-brand-500 to-brand-600 text-white font-bold py-4 rounded-2xl hover:-translate-y-0.5 hover:shadow-lg hover:shadow-brand-500/30 transition-all text-sm">
                <i class="fas fa-paper-plane"></i> Send Verification Code
            </button>
            <button onclick="closeSendCodeModal()" class="w-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 py-3 mt-2 text-sm transition-colors">Cancel</button>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════
     MODAL 2: Enter Code
═══════════════════════════════════ --}}
<div id="codeModal"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4"
     onclick="closeCodeModal()">
    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl w-full max-w-md p-6 border border-gray-100 dark:border-gray-800"
         onclick="event.stopPropagation()">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Enter Code</h2>
                <p class="text-xs text-gray-400 mt-0.5">Step 2 of 2</p>
            </div>
            <button onclick="closeCodeModal()" class="w-8 h-8 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        <div class="text-center py-2">
            <div class="w-20 h-20 mx-auto mb-5 bg-brand-50 dark:bg-brand-900/30 rounded-3xl flex items-center justify-center">
                <i class="fas fa-shield-alt text-brand-500 text-3xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Check Your Email</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 leading-relaxed">
                Enter the 6-digit code sent to<br>
                <span class="font-semibold text-brand-600 dark:text-brand-400">{{ Auth::user()->email }}</span>
            </p>

            {{-- 6-digit input --}}
            <input type="text" id="verificationCode" maxlength="6"
                   oninput="this.value=this.value.replace(/\D/g,'').substring(0,6)"
                   class="w-full text-center text-3xl font-bold font-mono tracking-[0.5em] bg-gray-50 dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-4 text-gray-900 dark:text-white focus:outline-none focus:border-brand-400 transition mb-2"
                   placeholder="000000">
            <p class="text-xs text-gray-400 mb-5">Enter the 6-digit verification code</p>

            {{-- Timer --}}
            <div id="timerSection" class="mb-5 flex items-center justify-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-clock text-brand-500"></i>
                Code expires in <span id="timer" class="font-bold text-brand-600 dark:text-brand-400 font-mono">05:00</span>
            </div>
            <div id="resendSection" class="hidden mb-5 text-center">
                <p class="text-sm text-gray-400 mb-2">Didn't receive the code?</p>
                <button onclick="resendVerificationCode()" id="resendCodeBtn"
                        class="text-brand-600 dark:text-brand-400 font-semibold text-sm hover:underline">
                    <i class="fas fa-redo mr-1 text-xs"></i> Resend Code
                </button>
            </div>

            <button onclick="verifyCode()" id="verifyCodeBtn"
                    class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-brand-500 to-brand-600 text-white font-bold py-4 rounded-2xl hover:-translate-y-0.5 hover:shadow-lg hover:shadow-brand-500/30 transition-all text-sm">
                <i class="fas fa-check-circle"></i> Verify & Update Password
            </button>
            <button onclick="closeCodeModal()" class="w-full text-gray-400 hover:text-gray-600 py-3 mt-2 text-sm transition-colors">Cancel</button>
        </div>
    </div>
</div>

<script>
    function validatePassword() {
        const password = document.getElementById('password').value;
        const strength = document.getElementById('passwordStrength');
        const bar = document.getElementById('passwordStrengthBar');
        const text = document.getElementById('passwordStrengthText');
        const btn = document.getElementById('updateProfileBtn');
        const confirmSection = document.getElementById('confirmPasswordSection');
        if (!password.length) { strength.classList.add('hidden'); btn.disabled = true; return; }
        strength.classList.remove('hidden');
        confirmSection.classList.remove('hidden');
        const checks = { reqLength: password.length >= 8, reqUppercase: /[A-Z]/.test(password), reqLowercase: /[a-z]/.test(password), reqNumber: /[0-9]/.test(password) };
        for (const [id, ok] of Object.entries(checks)) {
            const el = document.getElementById(id);
            const icon = el.querySelector('i');
            icon.className = ok ? 'fas fa-check text-brand-500 w-3' : 'fas fa-times text-red-400 w-3';
            el.className = ok ? 'flex items-center gap-1.5 text-xs text-gray-700 dark:text-gray-300' : 'flex items-center gap-1.5 text-xs text-gray-400';
        }
        const score = Object.values(checks).filter(Boolean).length * 25;
        const levels = [ [25,'bg-red-400','Weak'], [50,'bg-amber-400','Fair'], [75,'bg-blue-400','Good'], [100,'bg-brand-500','Strong'] ];
        const [,color,label] = levels.find(([s]) => score <= s) || levels[3];
        bar.className = `h-full rounded-full transition-all duration-300 ${color}`;
        bar.style.width = score + '%';
        text.textContent = label;
        text.className = `text-xs font-semibold ${color.replace('bg-','text-')}`;
        btn.disabled = score < 100;
    }

    function checkPasswordMatch() {
        const pw = document.getElementById('password').value;
        const cpw = document.getElementById('password_confirmation').value;
        document.getElementById('passwordMatchStatus').classList.toggle('hidden', pw !== cpw || !cpw.length);
    }

    function togglePasswordVisibility(id) {
        const input = document.getElementById(id);
        const icon = document.getElementById(id + '-eye');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.className = input.type === 'password' ? 'fas fa-eye text-sm' : 'fas fa-eye-slash text-sm';
    }

    function showModal(id) { const m = document.getElementById(id); m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden'; }
    function hideModal(id) { const m = document.getElementById(id); m.classList.add('hidden'); m.classList.remove('flex'); document.body.style.overflow = ''; }

    function showSendCodeModal() {
        const pw = document.getElementById('password').value;
        if (pw.length < 8) { if (window.showToast) showToast('Please enter a valid password first', 'error'); return; }
        showModal('sendCodeModal');
    }
    function closeSendCodeModal() { hideModal('sendCodeModal'); }
    function closeCodeModal() { hideModal('codeModal'); clearInterval(countdownTimer); }

    let countdownTimer;
    function startTimer() {
        let t = 300;
        const timerEl = document.getElementById('timer');
        const resend = document.getElementById('resendSection');
        const timerSec = document.getElementById('timerSection');
        clearInterval(countdownTimer);
        countdownTimer = setInterval(() => {
            t--;
            const m = Math.floor(t/60), s = t%60;
            timerEl.textContent = `${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
            if (t <= 0) { clearInterval(countdownTimer); timerSec.classList.add('hidden'); resend.classList.remove('hidden'); }
        }, 1000);
    }

    async function sendVerificationCode() {
        const btn = document.getElementById('sendCodeBtn');
        btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
        try {
            const r = await fetch('{{ route("profile.sendCode") }}', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'}, body: JSON.stringify({}) });
            const d = await r.json();
            if (d.message) {
                if (window.showToast) showToast('Verification code sent!', 'success');
                closeSendCodeModal();
                showModal('codeModal');
                startTimer();
                setTimeout(() => document.getElementById('verificationCode').focus(), 300);
            } else { if (window.showToast) showToast('Failed to send code', 'error'); }
        } catch { if (window.showToast) showToast('Network error. Try again.', 'error'); }
        finally { btn.disabled = false; btn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Send Verification Code'; }
    }

    async function verifyCode() {
        const code = document.getElementById('verificationCode').value;
        if (code.length !== 6) { if (window.showToast) showToast('Enter a valid 6-digit code', 'error'); return; }
        const btn = document.getElementById('verifyCodeBtn');
        btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
        try {
            const r = await fetch('{{ route("profile.verifyCode") }}', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'}, body: JSON.stringify({code}) });
            const d = await r.json();
            if (d.status) {
                if (window.showToast) showToast('Code verified!', 'success');
                closeCodeModal();
                setTimeout(() => {
                    const form = document.getElementById('updatePasswordForm');
                    const h = document.createElement('input'); h.type='hidden'; h.name='password'; h.value=document.getElementById('password').value;
                    form.appendChild(h); form.submit();
                }, 800);
            } else { if (window.showToast) showToast('Invalid verification code', 'error'); }
        } catch { if (window.showToast) showToast('Network error. Try again.', 'error'); }
        finally { btn.disabled = false; btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Verify & Update Password'; }
    }

    async function resendVerificationCode() {
        const btn = document.getElementById('resendCodeBtn');
        btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1 text-xs"></i>Sending...';
        try {
            const r = await fetch('{{ route("profile.sendCode") }}', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'}, body: JSON.stringify({}) });
            const d = await r.json();
            if (d.message) {
                if (window.showToast) showToast('New code sent!', 'success');
                document.getElementById('resendSection').classList.add('hidden');
                document.getElementById('timerSection').classList.remove('hidden');
                startTimer();
            } else { if (window.showToast) showToast('Failed to resend', 'error'); }
        } catch { if (window.showToast) showToast('Network error. Try again.', 'error'); }
        finally { btn.disabled = false; btn.innerHTML = '<i class="fas fa-redo mr-1 text-xs"></i>Resend Code'; }
    }

    document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeSendCodeModal(); closeCodeModal(); } });
</script>

@endsection