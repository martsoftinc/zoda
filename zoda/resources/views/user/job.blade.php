@extends('user.layout')
@section('content')

<main class="px-4 lg:px-6 py-6 max-w-5xl mx-auto">

    {{-- ═══════════════════════════════════
         PAGE HEADER
    ═══════════════════════════════════ --}}
    <div class="flex items-center justify-between gap-4 mb-6 animate-slide-up">
        <div class="flex items-center gap-4">
            <a href="/publisher"
               class="w-10 h-10 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 flex items-center justify-center text-gray-500 hover:border-brand-300 hover:text-brand-600 dark:hover:text-brand-400 transition-all shadow-card">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white leading-tight">Complete Article</h1>
                <p class="text-xs text-gray-400 dark:text-gray-500">Read fully then submit your code to earn</p>
            </div>
        </div>

        {{-- Session timer --}}
        <div id="sessionTimerBadge"
             class="hidden md:flex items-center gap-2 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 text-amber-700 dark:text-amber-300 text-sm font-semibold px-4 py-2 rounded-2xl">
            <i class="fas fa-clock text-amber-500 text-xs"></i>
            <span id="timerMinutes">15</span>:<span id="timerSeconds">00</span>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-brand-50 dark:bg-brand-900/30 border border-brand-200 dark:border-brand-800 text-brand-800 dark:text-brand-200 px-4 py-3 rounded-2xl text-sm mb-5 animate-slide-up">
            <i class="fas fa-check-circle text-brand-500 flex-shrink-0"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-2xl text-sm mb-5 animate-slide-up">
            <i class="fas fa-exclamation-circle text-red-500 flex-shrink-0"></i>{{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        {{-- ══════════════════════════════════════
             LEFT: Instructions (desktop 3 cols)
        ══════════════════════════════════════ --}}
        <div class="lg:col-span-3 space-y-5">

            {{-- Steps card --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-6 animate-slide-up delay-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-brand-600 dark:text-brand-400 text-sm"></i>
                    </div>
                    <h2 class="font-bold text-gray-900 dark:text-white">How to Complete This Task</h2>
                </div>

                <div class="space-y-6">
                    @php
                        $steps = [
                            ['num'=>'1','color'=>'from-brand-500 to-brand-400','title'=>'Open the Article','desc'=>'Click the <strong>Visit Site</strong> button to open the article in a new tab. Keep this tab open while you read.'],
                            ['num'=>'2','color'=>'from-blue-500 to-blue-400','title'=>'Read All Pages','desc'=>'Read the article completely. Click <strong>"Next"</strong> at the bottom to move between pages. You will read 3 pages in total.'],
                            ['num'=>'3','color'=>'from-purple-500 to-purple-400','title'=>'Get Your Code','desc'=>'On the last page, click the <strong>"Share"</strong> button. An alphanumeric verification code will appear — copy it.'],
                            ['num'=>'4','color'=>'from-amber-500 to-amber-400','title'=>'Submit & Earn','desc'=>'Return to this tab, paste the <strong>exact code</strong> in the field (case-sensitive), then hit Submit to earn your points.'],
                        ];
                    @endphp

                    @foreach($steps as $i => $step)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br {{ $step['color'] }} flex items-center justify-center flex-shrink-0 shadow-md text-white font-bold text-sm">
                                {{ $step['num'] }}
                            </div>
                            <div class="pt-1 flex-1">
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm mb-1">{{ $step['title'] }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">{!! $step['desc'] !!}</p>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <div class="ml-5 w-px h-4 bg-gray-100 dark:bg-gray-800"></div>
                        @endif
                    @endforeach
                </div>

                {{-- Warning --}}
                <div class="mt-6 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 rounded-2xl">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5 flex-shrink-0 text-sm"></i>
                        <div class="text-xs text-amber-700 dark:text-amber-300 space-y-1">
                            <p class="font-semibold mb-1.5">Important</p>
                            <p>• Do not close this tab while reading the article</p>
                            <p>• Read all pages completely before generating the code</p>
                            <p>• Session expires in 15 minutes for security</p>
                            <p>• The code is <strong>case-sensitive</strong> — copy it exactly</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tutorial (desktop) --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-6 animate-slide-up delay-2">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-2xl bg-red-50 dark:bg-red-900/20 flex items-center justify-center">
                            <i class="fas fa-play text-red-500 text-xs"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white text-sm">Need Help?</h3>
                            <p class="text-xs text-gray-400">Watch the tutorial</p>
                        </div>
                    </div>
                    <a href="https://youtu.be/t0NOPs17KgM" target="_blank"
                       class="text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline flex items-center gap-1">
                        Open in YouTube <i class="fas fa-external-link-alt text-[10px]"></i>
                    </a>
                </div>
                <div class="rounded-2xl overflow-hidden bg-gray-100 dark:bg-gray-800">
                    <iframe class="w-full h-44 block"
                            src="https://www.youtube.com/embed/t0NOPs17KgM"
                            title="PaidReader Tutorial"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                </div>
            </div>

        </div>

        {{-- ══════════════════════════════════════
             RIGHT: Visit + Verify + Task Info
        ══════════════════════════════════════ --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Visit Site card --}}
            <div class="bg-gradient-to-br from-brand-600 to-brand-400 rounded-3xl p-6 text-white shadow-lg shadow-brand-500/25 animate-slide-up delay-1 relative overflow-hidden">
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

            {{-- Verification form --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-6 animate-slide-up delay-2">
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

                        {{-- Code preview --}}
                        <div id="codePreview" class="hidden mt-2 flex items-center justify-between bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl px-3 py-2">
                            <span class="text-xs text-gray-400">Your code:</span>
                            <code id="codePreviewText" class="font-mono text-xs font-bold text-gray-900 dark:text-white"></code>
                        </div>
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

                    {{-- Locked button --}}
                    <button type="submit" id="submitBtn"
                            class="w-full flex items-center justify-center gap-2 bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 font-bold py-4 rounded-2xl cursor-not-allowed text-sm"
                            disabled>
                        <i class="fas fa-lock text-xs"></i> Submit Verification
                    </button>

                    {{-- Active submit (shown after countdown) --}}
                    <button type="submit" id="finalSubmitBtn"
                            class="hidden w-full flex items-center justify-center gap-2 bg-gradient-to-r from-brand-500 to-brand-600 text-white font-bold py-4 rounded-2xl hover:-translate-y-0.5 hover:shadow-lg hover:shadow-brand-500/30 transition-all text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        <i class="fas fa-paper-plane text-xs"></i> Submit & Earn Points
                    </button>

                </form>

                {{-- Clear / Cancel --}}
                <div class="grid grid-cols-2 gap-3 mt-4 pt-4 border-t border-gray-50 dark:border-gray-800">
                    <button onclick="clearCode()"
                            class="py-3 rounded-2xl bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-eraser text-xs"></i> Clear
                    </button>
                    <a href="/publisher" onclick="return confirmCancelTask()"
                       class="py-3 rounded-2xl bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-sm font-semibold hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-times text-xs"></i> Cancel
                    </a>
                </div>
            </div>

            {{-- Task info card --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-card p-5 animate-slide-up delay-3">
                <h3 class="font-bold text-gray-900 dark:text-white text-sm mb-4">Task Info</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400 dark:text-gray-500">Article</span>
                        <span class="text-xs font-semibold text-gray-900 dark:text-white text-right max-w-[160px] leading-tight">{{ $task->campaign_name }}</span>
                    </div>
                    <div class="flex items-center justify-between pt-2 border-t border-gray-50 dark:border-gray-800">
                        <span class="text-xs text-gray-400 dark:text-gray-500">Task ID</span>
                        <span class="font-mono text-xs text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 px-2 py-1 rounded-lg">{{ $task->id }}</span>
                    </div>
                    <div class="flex items-center justify-between pt-2 border-t border-gray-50 dark:border-gray-800">
                        <span class="text-xs text-gray-400 dark:text-gray-500">Est. Time</span>
                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">3–5 minutes</span>
                    </div>
                    <div class="flex items-center justify-between pt-2 border-t border-gray-50 dark:border-gray-800">
                        <span class="text-xs text-gray-400 dark:text-gray-500">Code Type</span>
                        <span class="bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300 text-xs font-semibold px-2.5 py-1 rounded-full">Alphanumeric</span>
                    </div>
                    <div class="flex items-center justify-between pt-2 border-t border-gray-50 dark:border-gray-800">
                        <span class="text-xs text-gray-400 dark:text-gray-500">Status</span>
                        <span class="bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> In Progress
                        </span>
                    </div>
                </div>
            </div>

            {{-- Mobile session timer --}}
            <div id="mobileTimerBadge"
                 class="md:hidden flex items-center justify-center gap-2 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 text-amber-700 dark:text-amber-300 text-sm font-semibold px-4 py-3 rounded-2xl">
                <i class="fas fa-clock text-amber-500 text-xs"></i>
                Session: <span id="timerMinutesMobile">15</span>:<span id="timerSecondsMobile">00</span>
            </div>

        </div>
    </div>
</main>

<script>
    let countdownInterval, sessionInterval;
    let timeLeft = 120, sessionTimeLeft = 900;
    let hasVisited = false, codeHidden = true;

    document.addEventListener('DOMContentLoaded', () => {
        // Restore session if returning to same task
        const savedId = sessionStorage.getItem('currentTaskId');
        const savedAt = parseInt(sessionStorage.getItem('taskStartedAt') || '0');
        const elapsed = Math.floor((Date.now() - savedAt) / 1000);

        if (savedId === '{{ $task->id }}' && elapsed < 900) {
            sessionTimeLeft = Math.max(0, 900 - elapsed);
            timeLeft = Math.max(0, 120 - elapsed);
            hasVisited = sessionStorage.getItem('hasVisitedSite') === 'true';
            if (timeLeft <= 0) unlockSubmit();
        } else {
            sessionStorage.setItem('currentTaskId', '{{ $task->id }}');
            sessionStorage.setItem('taskStartedAt', Date.now());
        }

        startCountdown();
        startSessionTimer();

        document.getElementById('visitSiteBtn')?.addEventListener('click', () => {
            hasVisited = true;
            sessionStorage.setItem('hasVisitedSite', 'true');
            if (window.showToast) showToast('Article opened. Read all pages to get your code.', 'success');
        });

        window.addEventListener('beforeunload', handleUnload);
    });

    function startCountdown() {
        if (timeLeft <= 0) { unlockSubmit(); return; }
        countdownInterval = setInterval(() => {
            timeLeft--;
            const el = document.getElementById('countdown');
            if (el) el.textContent = timeLeft;
            const bar = document.getElementById('countdownBar');
            if (bar) bar.style.width = ((timeLeft / 120) * 100) + '%';
            if (timeLeft <= 0) { clearInterval(countdownInterval); unlockSubmit(); }
        }, 1000);
    }

    function unlockSubmit() {
        document.getElementById('countdownDisplay')?.classList.add('hidden');
        document.getElementById('submitBtn')?.classList.add('hidden');
        const finalBtn = document.getElementById('finalSubmitBtn');
        if (finalBtn) { finalBtn.classList.remove('hidden'); finalBtn.disabled = false; }
        if (window.showToast) showToast('Ready! Paste your code and submit.', 'success');
    }

    function startSessionTimer() {
        document.getElementById('sessionTimerBadge')?.classList.remove('hidden');
        sessionInterval = setInterval(() => {
            sessionTimeLeft--;
            const m = Math.floor(sessionTimeLeft / 60), s = sessionTimeLeft % 60;
            const pad = n => String(n).padStart(2,'0');
            const set = (mId, sId) => { const mEl = document.getElementById(mId), sEl = document.getElementById(sId); if(mEl) mEl.textContent = pad(m); if(sEl) sEl.textContent = pad(s); };
            set('timerMinutes','timerSeconds');
            set('timerMinutesMobile','timerSecondsMobile');
            if (sessionTimeLeft <= 300) {
                document.getElementById('sessionTimerBadge')?.classList.replace('bg-amber-50','bg-red-50');
                document.getElementById('mobileTimerBadge')?.classList.replace('bg-amber-50','bg-red-50');
            }
            if (sessionTimeLeft <= 0) { clearInterval(sessionInterval); showExpiredModal(); }
        }, 1000);
    }

    function onCodeInput() {
        const input = document.getElementById('verificationCode');
        const preview = document.getElementById('codePreview');
        const previewText = document.getElementById('codePreviewText');
        const val = input.value.trim();
        if (val.length > 0) {
            preview.classList.remove('hidden');
            previewText.textContent = val;
        } else {
            preview.classList.add('hidden');
        }
    }

    async function pasteCode() {
        try {
            const text = await navigator.clipboard.readText();
            const input = document.getElementById('verificationCode');
            input.value = text;
            onCodeInput();
            if (window.showToast) showToast('Code pasted!', 'success');
        } catch { if (window.showToast) showToast('Paste manually — clipboard access denied.', 'error'); }
    }

    function toggleCodeVis() {
        const input = document.getElementById('verificationCode');
        const icon = document.getElementById('codeEye');
        codeHidden = !codeHidden;
        input.type = codeHidden ? 'text' : 'password';
        icon.className = codeHidden ? 'fas fa-eye text-xs' : 'fas fa-eye-slash text-xs';
    }

    function clearCode() {
        const input = document.getElementById('verificationCode');
        if (input) { input.value = ''; input.focus(); }
        document.getElementById('codePreview')?.classList.add('hidden');
        if (window.showToast) showToast('Cleared', 'success');
    }

    function confirmCancelTask() {
        if (hasVisited) return confirm('Cancel this task? Your progress will be lost.');
        return true;
    }

    function handleUnload(e) {
        if (hasVisited && sessionTimeLeft > 60 && sessionTimeLeft <= 840) {
            e.preventDefault();
            e.returnValue = 'You have a task in progress.';
        }
    }

    function showExpiredModal() {
        clearSession();
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4';
        modal.innerHTML = `
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl w-full max-w-sm p-6 border border-gray-100 dark:border-gray-800 text-center">
                <div class="w-16 h-16 bg-red-50 dark:bg-red-900/20 rounded-3xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Session Expired</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Your 15-minute session has expired. Return to the dashboard and start the task again.</p>
                <a href="/publisher" class="flex items-center justify-center gap-2 bg-gradient-to-r from-brand-500 to-brand-600 text-white font-bold py-4 rounded-2xl hover:opacity-90 transition text-sm">
                    <i class="fas fa-home"></i> Back to Dashboard
                </a>
            </div>`;
        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';
    }

    async function clearSession() {
        try {
            await fetch('{{ route("clear.task.session") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                body: JSON.stringify({ taskId: '{{ $task->id }}' }),
                keepalive: true
            });
        } catch {}
        sessionStorage.removeItem('currentTaskId');
        sessionStorage.removeItem('taskStartedAt');
        sessionStorage.removeItem('hasVisitedSite');
    }

    // Guard form submission
    document.getElementById('verificationForm')?.addEventListener('submit', function(e) {
        if (timeLeft > 0) {
            e.preventDefault();
            if (window.showToast) showToast('Wait for the countdown to finish first.', 'error');
            return false;
        }
        const btn = document.getElementById('finalSubmitBtn');
        if (btn) { btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin text-xs mr-2"></i>Verifying...'; }
        setTimeout(() => { if (btn) { btn.disabled = false; btn.innerHTML = '<i class="fas fa-paper-plane text-xs"></i> Submit & Earn Points'; } }, 6000);
    });
</script>

@endsection