@extends('user.layout')
@section('content')

{{-- Cloudflare Turnstile Script --}}
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<main class="px-4 lg:px-6 py-6 max-w-2xl mx-auto">

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-brand-50 dark:bg-brand-900/30 border border-brand-200 dark:border-brand-800 text-brand-800 dark:text-brand-200 px-4 py-3 rounded-2xl text-sm mb-5">
            <i class="fas fa-check-circle text-brand-500 flex-shrink-0"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-2xl text-sm mb-5">
            <i class="fas fa-exclamation-circle text-red-500 flex-shrink-0"></i>{{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Open Article --}}
        <div class="bg-gradient-to-br from-brand-600 to-brand-400 rounded-3xl p-6 text-white shadow-lg shadow-brand-500/25 relative overflow-hidden">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-10 -left-5 w-24 h-24 bg-white/10 rounded-full"></div>
            <div class="relative z-10 text-center">
                <div class="w-14 h-14 mx-auto mb-4 bg-white/20 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-external-link-alt text-xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-1">Ready to Start?</h3>
                <p class="text-brand-100 text-sm mb-5">Click below to open the article in a new tab</p>
                <a href="/redirect/{{ $task->id }}"
                   target="_blank" rel="noopener noreferrer" id="visitSiteBtn"
                   class="w-full flex items-center justify-center gap-2 bg-white text-brand-700 font-bold py-4 rounded-2xl hover:bg-brand-50 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg text-sm">
                    <i class="fas fa-external-link-alt"></i> Open Article
                </a>
                <p class="text-brand-100/70 text-xs mt-3">
                    <i class="fas fa-info-circle mr-1"></i>Opens in new tab — keep both tabs open
                </p>
            </div>
        </div>

        {{-- Verification Form --}}
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-6">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                    <i class="fas fa-shield-alt text-brand-600 dark:text-brand-400 text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white text-sm">Submit Verification</h3>
                    <p class="text-xs text-gray-400">Paste the code from the article</p>
                </div>
            </div>

            <form action="{{ route('verifyCode') }}" method="POST" id="verificationForm">
                @csrf
                <input type="hidden" name="id" value="{{ $task->id }}">

                <div class="mb-4 space-y-1.5">
                    <label class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-widest flex items-center gap-1.5">
                        <i class="fas fa-key w-3 text-brand-500"></i> Verification Code
                    </label>
                    <div class="relative">
                        <input type="text" id="verificationCode" name="verificationCode"
                               class="w-full bg-gray-50 dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-3.5 pr-20 text-center text-base font-mono font-bold text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-gray-600 focus:outline-none focus:border-brand-400 dark:focus:border-brand-500 transition"
                               placeholder="Paste code here"
                               required autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                               oninput="onCodeInput()">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 flex gap-1">
                            <button type="button" onclick="pasteCode()"
                                    class="w-8 h-8 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/30 flex items-center justify-center transition-colors"
                                    title="Paste">
                                <i class="fas fa-paste text-xs"></i>
                            </button>
                            <button type="button" onclick="toggleCodeVis()"
                                    class="w-8 h-8 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-brand-900/30 flex items-center justify-center transition-colors"
                                    title="Show/Hide">
                                <i class="fas fa-eye text-xs" id="codeEye"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 dark:text-gray-600">Case-sensitive — paste exactly as shown</p>
                </div>

                {{-- Countdown --}}
                <div id="countdownDisplay" class="mb-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 flex items-center gap-1.5">
                            <i class="fas fa-clock text-amber-500 text-xs"></i> Reading time required
                        </span>
                        <span id="countdown" class="font-mono font-bold text-brand-600 dark:text-brand-400 text-sm">120</span>
                    </div>
                    <div class="h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div id="countdownBar" class="h-full bg-gradient-to-r from-brand-400 to-brand-500 rounded-full transition-all duration-1000" style="width:100%"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5 text-center">seconds remaining before you can submit</p>
                </div>

                {{-- Cloudflare Turnstile Widget --}}
                <div class="mb-4 flex justify-center">
                    <div class="cf-turnstile"
                         data-sitekey="{{ config('services.turnstile.site_key') }}"
                         data-callback="onTurnstileSuccess"
                         data-expired-callback="onTurnstileExpired"
                         data-theme="auto">
                    </div>
                </div>

                <button type="submit" id="submitBtn"
                        class="w-full flex items-center justify-center gap-2 bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 font-bold py-4 rounded-2xl cursor-not-allowed text-sm"
                        disabled>
                    <i class="fas fa-lock text-xs"></i> Submit Verification
                </button>

                <button type="submit" id="finalSubmitBtn"
                        class="hidden w-full flex items-center justify-center gap-2 bg-gradient-to-r from-brand-500 to-brand-600 text-white font-bold py-4 rounded-2xl hover:-translate-y-0.5 hover:shadow-lg hover:shadow-brand-500/30 transition-all text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                    <i class="fas fa-paper-plane text-xs"></i> Submit & Earn Cash
                </button>

            </form>
        </div>

    </div>
</main>

<script>
    let countdownInterval;
    let startTime = Date.now();
    const TOTAL = 120;
    let codeHidden = true;

    // ── Turnstile state ──────────────────────────────────────────────
    let turnstilePassed = false;
    let countdownDone   = false;

    function onTurnstileSuccess(token) {
        turnstilePassed = true;
        maybeUnlockSubmit();
    }

    function onTurnstileExpired() {
        turnstilePassed = false;
        const finalBtn = document.getElementById('finalSubmitBtn');
        if (finalBtn) { finalBtn.disabled = true; }
    }

    function maybeUnlockSubmit() {
        if (turnstilePassed && countdownDone) {
            unlockSubmit();
        }
    }
    // ────────────────────────────────────────────────────────────────

    document.addEventListener('DOMContentLoaded', () => {
        startCountdown();
        document.getElementById('visitSiteBtn')?.addEventListener('click', () => {
            if (window.showToast) showToast('Article opened. Read all pages to get your code.', 'success');
        });
    });

    function startCountdown() {
        countdownInterval = setInterval(() => {
            const elapsed = Math.floor((Date.now() - startTime) / 1000);
            const timeLeft = Math.max(0, TOTAL - elapsed);

            const el = document.getElementById('countdown');
            if (el) el.textContent = timeLeft;
            const bar = document.getElementById('countdownBar');
            if (bar) bar.style.width = ((timeLeft / TOTAL) * 100) + '%';

            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                countdownDone = true;
                maybeUnlockSubmit();
            }
        }, 500);
    }

    function unlockSubmit() {
        document.getElementById('countdownDisplay')?.classList.add('hidden');
        document.getElementById('submitBtn')?.classList.add('hidden');
        const finalBtn = document.getElementById('finalSubmitBtn');
        if (finalBtn) { finalBtn.classList.remove('hidden'); finalBtn.disabled = false; }
        if (window.showToast) showToast('Ready! Paste your code and submit.', 'success');
    }

    function onCodeInput() {
        const input = document.getElementById('verificationCode');
        const val   = input.value.trim();
        const preview = document.getElementById('codePreview');
        if (preview) {
            const previewText = document.getElementById('codePreviewText');
            if (val.length > 0) {
                preview.classList.remove('hidden');
                if (previewText) previewText.textContent = val;
            } else {
                preview.classList.add('hidden');
            }
        }
    }

    async function pasteCode() {
        try {
            const text = await navigator.clipboard.readText();
            document.getElementById('verificationCode').value = text;
            onCodeInput();
            if (window.showToast) showToast('Code pasted!', 'success');
        } catch {
            if (window.showToast) showToast('Paste manually — clipboard access denied.', 'error');
        }
    }

    function toggleCodeVis() {
        const input = document.getElementById('verificationCode');
        const icon  = document.getElementById('codeEye');
        codeHidden  = !codeHidden;
        input.type  = codeHidden ? 'text' : 'password';
        icon.className = codeHidden ? 'fas fa-eye text-xs' : 'fas fa-eye-slash text-xs';
    }

    document.getElementById('verificationForm')?.addEventListener('submit', function(e) {
        const elapsed = Math.floor((Date.now() - startTime) / 1000);
        if (elapsed < TOTAL) {
            e.preventDefault();
            if (window.showToast) showToast('Wait for the countdown to finish first.', 'error');
            return false;
        }
        if (!turnstilePassed) {
            e.preventDefault();
            if (window.showToast) showToast('Please complete the security challenge first.', 'error');
            return false;
        }
        const btn = document.getElementById('finalSubmitBtn');
        if (btn) {
            btn.disabled  = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin text-xs mr-2"></i>Verifying...';
        }
        setTimeout(() => {
            if (btn) {
                btn.disabled  = false;
                btn.innerHTML = '<i class="fas fa-paper-plane text-xs"></i> Submit & Earn Points';
            }
        }, 6000);
    });
</script>

@endsection