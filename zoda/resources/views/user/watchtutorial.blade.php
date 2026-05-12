<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started — Koda.africa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        brand: { 400:'#4ade80', 500:'#22c55e', 600:'#16a34a', 700:'#15803d' }
                    }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background: #0b1215;
            background-image:
                radial-gradient(ellipse 70% 50% at 20% 30%, rgba(34,197,94,0.10) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 80% 70%, rgba(34,197,94,0.06) 0%, transparent 55%);
            min-height: 100vh;
        }

        .dot-grid {
            background-image: radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* ── Tab switcher ── */
        .tab-bar {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 4px;
            gap: 4px;
        }
        .tab-btn {
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            cursor: pointer;
            border: none;
            transition: background 0.25s, color 0.25s, box-shadow 0.25s;
            color: rgba(255,255,255,0.35);
            background: transparent;
        }
        .tab-btn.active {
            background: rgba(34,197,94,0.14);
            color: #4ade80;
            box-shadow: inset 0 0 0 1px rgba(34,197,94,0.30);
        }
        .tab-btn .tab-check {
            width: 16px; height: 16px;
            border-radius: 50%;
            background: rgba(34,197,94,0.20);
            display: flex; align-items: center; justify-content: center;
            font-size: 8px;
            color: #22c55e;
            flex-shrink: 0;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .tab-btn.done .tab-check { opacity: 1; }

        /* ── Panels ── */
        .panels-wrap {
            overflow: hidden;
            position: relative;
        }
        .panels-inner {
            display: flex;
            transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
        }
        .panel {
            flex: 0 0 100%;
            width: 100%;
        }

        /* ── FAQ accordion ── */
        .faq-item {
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            overflow: hidden;
            transition: border-color 0.2s;
        }
        .faq-item.open { border-color: rgba(34,197,94,0.30); }
        .faq-trigger {
            width: 100%; text-align: left;
            background: rgba(255,255,255,0.03);
            padding: 15px 18px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: space-between; gap: 10px;
            transition: background 0.15s;
            border: none; color: white;
        }
        .faq-trigger:hover { background: rgba(255,255,255,0.06); }
        .faq-item.open .faq-trigger { background: rgba(34,197,94,0.06); }
        .faq-chevron {
            color: rgba(255,255,255,0.30);
            font-size: 11px;
            flex-shrink: 0;
            transition: transform 0.3s, color 0.2s;
        }
        .faq-item.open .faq-chevron { transform: rotate(180deg); color: #4ade80; }
        .faq-body { max-height: 0; overflow: hidden; transition: max-height 0.35s cubic-bezier(0.4,0,0.2,1); }
        .faq-item.open .faq-body { max-height: 300px; }
        .faq-content {
            padding: 0 18px 15px;
            color: rgba(255,255,255,0.50);
            font-size: 13.5px;
            line-height: 1.75;
            border-top: 1px solid rgba(255,255,255,0.06);
            padding-top: 13px;
        }

        /* ── Check items ── */
        .check-item {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 13px 15px;
            border-radius: 12px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s;
            user-select: none;
        }
        .check-item:hover { background: rgba(255,255,255,0.05); }
        .check-item.checked { background: rgba(34,197,94,0.07); border-color: rgba(34,197,94,0.28); }
        .check-box {
            width: 20px; height: 20px; border-radius: 6px;
            border: 1.5px solid rgba(255,255,255,0.18);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-top: 1px;
            transition: background 0.15s, border-color 0.15s;
        }
        .check-item.checked .check-box { background: #22c55e; border-color: #22c55e; }
        .check-box i { font-size: 10px; color: white; opacity: 0; transition: opacity 0.15s; }
        .check-item.checked .check-box i { opacity: 1; }

        /* ── Buttons ── */
        .btn-locked {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.28);
            border: 1.5px solid rgba(255,255,255,0.08);
            cursor: not-allowed;
            pointer-events: none;
        }
        .btn-active {
            background: linear-gradient(135deg,#22c55e,#16a34a);
            color: #fff; border: none; cursor: pointer;
            box-shadow: 0 8px 28px rgba(34,197,94,0.35);
            transition: transform .2s, box-shadow .2s;
        }
        .btn-active:hover { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(34,197,94,0.45); }

        @keyframes softPulse { 0%,100%{opacity:.4} 50%{opacity:1} }
        .soft-pulse { animation: softPulse 2s ease-in-out infinite; }

        /* ── Video ── */
        .video-wrap { position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:16px; }
        .video-wrap iframe { position:absolute; top:0; left:0; width:100%; height:100%; border:none; }

        /* ── Ring ── */
        .ring-track { stroke: rgba(255,255,255,0.10); }
        .ring-fill  { stroke: #22c55e; stroke-linecap: round; }

        /* ── Step indicators ── */
        .step-done   { background:#22c55e; color:#fff; }
        .step-active { background:rgba(34,197,94,.15); color:#4ade80; border:1.5px solid #22c55e; }
        .step-todo   { background:rgba(255,255,255,.06); color:rgba(255,255,255,.25); }

        /* ── Modal ── */
        .backdrop { backdrop-filter: blur(8px); background: rgba(0,0,0,0.70); }
        @keyframes modalIn {
            from { opacity:0; transform:translateY(20px) scale(.97); }
            to   { opacity:1; transform:translateY(0) scale(1); }
        }
        .modal-card { animation: modalIn .3s cubic-bezier(.34,1.3,.64,1) both; }

        /* ── Entrance ── */
        @keyframes fadeUp {
            from { opacity:0; transform:translateY(14px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .fade-up { animation: fadeUp 0.45s cubic-bezier(0.22,1,0.36,1) both; }
        .d1 { animation-delay:.06s } .d2 { animation-delay:.12s }
        .d3 { animation-delay:.18s } .d4 { animation-delay:.24s }
    </style>
</head>

<body class="flex flex-col items-center justify-center p-4 sm:p-6 relative overflow-x-hidden">

    <div class="dot-grid fixed inset-0 pointer-events-none z-0"></div>

    <div class="relative z-10 w-full max-w-2xl mx-auto py-8">

        <!-- Brand -->
        <div class="flex justify-center mb-7 fade-up">
            <a href="/" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-xl bg-brand-500 flex items-center justify-center shadow-lg shadow-brand-500/30 group-hover:scale-105 transition-transform">
                    <i class="fas fa-book-open text-white text-sm"></i>
                </div>
                <span class="font-bold text-lg text-white">Koda.africa<span class="text-brand-400"></span></span>
            </a>
        </div>

        <!-- Steps -->
        <div class="flex items-center justify-center gap-3 mb-7 fade-up d1">
            <div class="flex items-center gap-1.5">
                <div class="w-7 h-7 rounded-full step-done flex items-center justify-center text-xs font-bold">
                    <i class="fas fa-check text-[10px]"></i>
                </div>
                <span class="text-xs font-medium text-brand-400 hidden sm:inline">Sign Up</span>
            </div>
            <div class="w-8 sm:w-12 h-px bg-white/10"></div>
            <div class="flex items-center gap-1.5">
                <div class="w-7 h-7 rounded-full step-active flex items-center justify-center text-xs font-bold">2</div>
                <span class="text-xs font-medium text-brand-400 hidden sm:inline">Tutorial</span>
            </div>
            <div class="w-8 sm:w-12 h-px bg-white/10"></div>
            <div class="flex items-center gap-1.5">
                <div class="w-7 h-7 rounded-full step-todo flex items-center justify-center text-xs font-bold">3</div>
                <span class="text-xs font-medium text-white/25 hidden sm:inline">Dashboard</span>
            </div>
        </div>

        <!-- Main card -->
        <div class="bg-white/[0.04] border border-white/[0.08] rounded-3xl p-5 sm:p-7 backdrop-blur-sm shadow-2xl fade-up d2">

            <!-- Tab bar -->
            <div class="tab-bar mb-6" id="tab-bar">
                <button class="tab-btn active" id="tab-faq" onclick="switchTab(0)">
                    <i class="fas fa-circle-info text-xs"></i>
                    FAQ &amp; Terms
                    <span class="tab-check" id="faq-check"><i class="fas fa-check"></i></span>
                </button>
                <button class="tab-btn" id="tab-tutorial" onclick="switchTab(1)">
                    <i class="fas fa-play-circle text-xs"></i>
                    Watch Tutorial
                    <span class="tab-check" id="tutorial-check"><i class="fas fa-check"></i></span>
                </button>
            </div>

            <!-- Sliding panels -->
            <div class="panels-wrap">
                <div class="panels-inner" id="panels-inner">

                    <!-- ══ PANEL 1: FAQ & Terms ══ -->
                    <div class="panel" id="panel-faq">

                        <div class="text-center mb-6">
                            <h1 class="text-xl sm:text-2xl font-extrabold text-white leading-tight mb-1.5">
                                Read Before You Start
                            </h1>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Understand how Koda.africa works, then confirm you agree to continue.
                            </p>
                        </div>

                        <!-- FAQ -->
                        <p class="text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-3">Frequently Asked Questions</p>
                        <div class="flex flex-col gap-2 mb-6">

                            <div class="faq-item">
                                <button class="faq-trigger" onclick="toggleFaq(this)">
                                    <div class="flex items-center gap-2.5">
                                        <span class="text-brand-400 text-xs font-bold w-5 flex-shrink-0">Q1</span>
                                        <span class="font-semibold text-sm text-white">How do I earn with Koda.africa?</span>
                                    </div>
                                    <i class="fas fa-chevron-down faq-chevron"></i>
                                </button>
                                <div class="faq-body">
                                    <div class="faq-content">You earn  by reading articles assigned to you on your dashboard. Each article you complete adds cash to your balance. Once you reach the minimum withdrawal amount, you can request a payout. You can withdraw via Mobile Money ( Ghana & Kenya) or Bank Transfer( Nigeria & South Africa).</div>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-trigger" onclick="toggleFaq(this)">
                                    <div class="flex items-center gap-2.5">
                                        <span class="text-brand-400 text-xs font-bold w-5 flex-shrink-0">Q2</span>
                                        <span class="font-semibold text-sm text-white">When and how do I get paid?</span>
                                    </div>
                                    <i class="fas fa-chevron-down faq-chevron"></i>
                                </button>
                                <div class="faq-body">
                                    <div class="faq-content">Payouts are processed once you reach the minimum withdrawal amount shown in your dashboard. You can request payment via your account's dashboard by clicking the "Redeem" button. Processing typically takes 1–2 business days, please note we dont process payments on weekends.  </div>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-trigger" onclick="toggleFaq(this)">
                                    <div class="flex items-center gap-2.5">
                                        <span class="text-brand-400 text-xs font-bold w-5 flex-shrink-0">Q3</span>
                                        <span class="font-semibold text-sm text-white">Are there rules I must follow?</span>
                                    </div>
                                    <i class="fas fa-chevron-down faq-chevron"></i>
                                </button>
                                <div class="faq-body">
                                    <div class="faq-content">Yes. You must read each article fully and honestly. Using bots, scripts, or automation is strictly prohibited and will result in permanent account suspension. Only one account per person is allowed.</div>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-trigger" onclick="toggleFaq(this)">
                                    <div class="flex items-center gap-2.5">
                                        <span class="text-brand-400 text-xs font-bold w-5 flex-shrink-0">Q4</span>
                                        <span class="font-semibold text-sm text-white">Is it free or do I have to upgrade later?</span>
                                    </div>
                                    <i class="fas fa-chevron-down faq-chevron"></i>
                                </button>
                                <div class="faq-body">
                                    <div class="faq-content">It's free to join and start earning. There are no upgrades or additional fees required. Honestly any site that tells you to pay money or refer others before you can withdraw is a scam. You dont pay us anything, we rather pay you.</div>
                                </div>
                            </div>

                            <div class="faq-item">
                                <button class="faq-trigger" onclick="toggleFaq(this)">
                                    <div class="flex items-center gap-2.5">
                                        <span class="text-brand-400 text-xs font-bold w-5 flex-shrink-0">Q5</span>
                                        <span class="font-semibold text-sm text-white">How much can I earn?</span>
                                    </div>
                                    <i class="fas fa-chevron-down faq-chevron"></i>
                                </button>
                                <div class="faq-body">
                                    <div class="faq-content">You can earn by reading articles assigned to you on your dashboard. The amount you earn depends on the number of articles you complete. </div>
                                </div>
                            </div>

                        </div>

                        <!-- Divider -->
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex-1 h-px bg-white/[0.06]"></div>
                            <span class="text-[11px] text-gray-600 font-semibold uppercase tracking-widest">Confirm & agree</span>
                            <div class="flex-1 h-px bg-white/[0.06]"></div>
                        </div>

                        <!-- Checkboxes -->
                        <div class="flex flex-col gap-2 mb-5">
                            <div class="check-item" id="chk-1" onclick="toggleCheck('chk-1')">
                                <div class="check-box"><i class="fas fa-check"></i></div>
                                <div>
                                    <p class="text-sm font-semibold text-white">I understand how earning and payouts work</p>
                                    <p class="text-xs text-gray-500 mt-0.5">I know I earn by reading and I need a minimum balance to withdraw.</p>
                                </div>
                            </div>
                            <div class="check-item" id="chk-2" onclick="toggleCheck('chk-2')">
                                <div class="check-box"><i class="fas fa-check"></i></div>
                                <div>
                                    <p class="text-sm font-semibold text-white">I agree to the rules — no bots, one account only</p>
                                    <p class="text-xs text-gray-500 mt-0.5">I will read honestly and not use automation or create duplicate accounts.</p>
                                </div>
                            </div>
                            <div class="check-item" id="chk-3" onclick="toggleCheck('chk-3')">
                                <div class="check-box"><i class="fas fa-check"></i></div>
                                <div>
                                    <p class="text-sm font-semibold text-white">I accept the Terms of Service &amp; Privacy Policy</p>
                                    <p class="text-xs text-gray-500 mt-0.5">I have read and agree to Koda.africa's <a href="/terms" target="_blank" class="text-brand-400 hover:underline">terms and conditions</a>. </p>
                                </div>
                            </div>
                        </div>

                        <!-- Progress -->
                        <div class="mb-5">
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-[11px] text-gray-600 font-medium">Confirmations</span>
                                <span id="chk-count" class="text-[11px] font-bold text-gray-500">0 / 3</span>
                            </div>
                            <div class="h-1.5 bg-white/[0.07] rounded-full overflow-hidden">
                                <div id="chk-bar" class="h-full bg-gradient-to-r from-brand-500 to-brand-400 rounded-full" style="width:0%; transition: width 0.35s cubic-bezier(0.4,0,0.2,1);"></div>
                            </div>
                        </div>

                        <!-- Continue to tutorial button -->
                        <button id="faq-continue-btn"
                                onclick="goToTutorial()"
                                class="btn-locked w-full flex items-center justify-center gap-3 py-4 px-6 rounded-2xl font-bold text-sm">
                            <i id="faq-btn-icon" class="fas fa-lock text-sm soft-pulse"></i>
                            <span id="faq-btn-label">Tick all boxes to continue</span>
                            <i class="fas fa-arrow-right text-xs opacity-60"></i>
                        </button>
                        <p id="faq-helper" class="text-center text-xs text-gray-600 mt-3">Check all three boxes above to unlock the tutorial.</p>

                    </div>
                    <!-- end panel 1 -->

                    <!-- ══ PANEL 2: Tutorial ══ -->
                    <div class="panel" id="panel-tutorial">

                        <div class="text-center mb-6">
                            <h1 class="text-xl sm:text-2xl font-extrabold text-white leading-tight mb-1.5">
                                Watch the Tutorial
                            </h1>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Watch the full video to see exactly how to read and earn.
                            </p>
                        </div>

                        <!-- Video -->
                        <div class="video-wrap mb-5 shadow-xl shadow-black/40 ring-1 ring-white/10">
                            <iframe
                                src="https://www.youtube.com/embed/t0NOPs17KgM?rel=0&modestbranding=1"
                                title="Koda.africa Tutorial"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <!-- Progress bar -->
                        <div class="mb-5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[11px] font-bold text-gray-600 uppercase tracking-widest">Video progress</span>
                                <span id="progress-label" class="text-[11px] font-bold text-gray-500">0%</span>
                            </div>
                            <div class="h-1.5 bg-white/[0.07] rounded-full overflow-hidden">
                                <div id="progress-bar" class="h-full bg-gradient-to-r from-brand-500 to-brand-400 rounded-full" style="width:0%; transition:none;"></div>
                            </div>
                        </div>

                        <!-- Timer + Button -->
                        <div class="flex flex-col sm:flex-row items-center gap-4">

                            <div class="relative flex-shrink-0 flex items-center justify-center" style="width:76px;height:76px;">
                                <svg width="76" height="76" viewBox="0 0 76 76" style="transform:rotate(-90deg);">
                                    <circle class="ring-track" cx="38" cy="38" r="32" fill="none" stroke-width="5"/>
                                    <circle id="ring" class="ring-fill" cx="38" cy="38" r="32" fill="none" stroke-width="5"
                                            stroke-dasharray="201.06" stroke-dashoffset="201.06"/>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                    <span id="timer-num" class="font-bold leading-none text-white" style="font-size:18px;">60</span>
                                    <span id="timer-sub" class="font-medium leading-none mt-0.5 text-gray-500" style="font-size:9px;">secs</span>
                                </div>
                            </div>

                            <button id="continue-btn"
                                    onclick="onContinue()"
                                    class="btn-locked w-full sm:flex-1 flex items-center justify-center gap-3 py-4 px-6 rounded-2xl font-bold text-base">
                                <i id="btn-icon" class="fas fa-lock text-sm soft-pulse"></i>
                                <span id="btn-label">Wait&nbsp;<span id="btn-countdown">60</span>s to continue</span>
                            </button>
                        </div>

                        <p id="helper-text" class="text-center text-xs text-gray-500 mt-4">
                            The button unlocks after <strong class="text-gray-400">60 seconds</strong> — please watch the full video.
                        </p>

                        <!-- Back link -->
                        <button onclick="switchTab(0)" class="w-full mt-4 text-xs text-gray-600 hover:text-gray-400 transition-colors flex items-center justify-center gap-1.5">
                            <i class="fas fa-arrow-left text-[10px]"></i> Back to FAQ
                        </button>

                    </div>
                    <!-- end panel 2 -->

                </div>
            </div>
            <!-- end panels -->

        </div>

        <p class="text-center text-xs text-white/15 mt-6">
            &copy; 2026 Koda.africa &mdash; You only need to do this once.
        </p>
    </div>


    <!-- ══ MODAL: Understood? ══ -->
    <div id="modal-confirm" class="backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="modal-card bg-[#0f1c17] border border-white/[0.09] rounded-3xl shadow-2xl w-full max-w-sm p-6 sm:p-8 text-center">
            <div class="w-16 h-16 rounded-3xl bg-brand-500/15 border border-brand-500/25 flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-circle-question text-brand-400 text-2xl"></i>
            </div>
            <h2 class="text-xl font-extrabold text-white mb-2 leading-tight">Have you understood<br>the tutorial?</h2>
            <p class="text-gray-400 text-sm mb-7 leading-relaxed">Make sure you know how to read articles and earn points before you start.</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <form id="tutorial-complete-form" action="{{ route('tutorial.complete') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-brand-500 to-brand-600 hover:from-brand-600 hover:to-brand-700 text-white font-bold py-4 rounded-2xl transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-brand-500/30 text-sm">
                        <i class="fas fa-check-circle"></i> Yes, I'm ready!
                    </button>
                </form>
                <button onclick="onNo()" class="flex-1 flex items-center justify-center gap-2 bg-white/[0.05] hover:bg-white/[0.10] border border-white/10 text-gray-300 hover:text-white font-bold py-4 rounded-2xl transition-all duration-200 text-sm">
                    <i class="fas fa-rotate-left"></i> No, watch again
                </button>
            </div>
            <p class="text-xs text-gray-600 mt-5">You can re-watch the video at any time.</p>
        </div>
    </div>

    <!-- ══ MODAL: Watch again ══ -->
    <div id="modal-watchagain" class="backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="modal-card bg-[#1a130a] border border-amber-900/40 rounded-3xl shadow-2xl w-full max-w-sm p-6 sm:p-8 text-center">
            <div class="w-16 h-16 rounded-3xl bg-amber-500/15 border border-amber-500/30 flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-triangle-exclamation text-amber-400 text-2xl"></i>
            </div>
            <h2 class="text-xl font-extrabold text-white mb-2 leading-tight">Please watch the video again</h2>
            <p class="text-gray-400 text-sm mb-7 leading-relaxed">No worries! Go back and watch the tutorial fully so you know exactly how to earn with Koda.africa.</p>
            <button onclick="closeWatchAgain()" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-600 hover:to-amber-500 text-white font-bold py-4 rounded-2xl transition-all duration-200 hover:-translate-y-0.5 text-sm">
                <i class="fas fa-play-circle"></i> OK, I'll watch it again
            </button>
            <p class="text-xs text-gray-600 mt-5">The continue button will remain active.</p>
        </div>
    </div>


    <script>
        /* ══ TAB / PANEL ══ */
        let currentTab = 0;
        let faqDone = false;

        function switchTab(idx) {
            // Can't go to tutorial unless FAQ is done
            if (idx === 1 && !faqDone) return;

            currentTab = idx;
            document.getElementById('panels-inner').style.transform =
                idx === 0 ? 'translateX(0)' : 'translateX(-100%)';

            document.getElementById('tab-faq').classList.toggle('active', idx === 0);
            document.getElementById('tab-tutorial').classList.toggle('active', idx === 1);

            // Start timer when tutorial tab first becomes visible
            if (idx === 1 && !timerStarted) startTimer();
        }

        /* ══ CHECKBOXES ══ */
        const checks = new Set();

        function toggleCheck(id) {
            const el = document.getElementById(id);
            if (checks.has(id)) { checks.delete(id); el.classList.remove('checked'); }
            else                 { checks.add(id);    el.classList.add('checked'); }
            updateCheckProgress();
        }

        function updateCheckProgress() {
            const done = checks.size, total = 3;
            document.getElementById('chk-count').textContent = `${done} / ${total}`;
            document.getElementById('chk-bar').style.width = ((done / total) * 100) + '%';

            const btn    = document.getElementById('faq-continue-btn');
            const icon   = document.getElementById('faq-btn-icon');
            const label  = document.getElementById('faq-btn-label');
            const helper = document.getElementById('faq-helper');

            if (done >= total) {
                btn.classList.remove('btn-locked'); btn.classList.add('btn-active');
                icon.className = 'fas fa-circle-arrow-right text-sm';
                icon.classList.remove('soft-pulse');
                label.textContent = 'Continue to Tutorial';
                helper.innerHTML = '<span style="color:#4ade80;font-weight:600;">&#10003; All confirmed!</span> Click to watch the tutorial.';
                document.getElementById('chk-count').style.color = '#4ade80';
            } else {
                btn.classList.add('btn-locked'); btn.classList.remove('btn-active');
                icon.className = 'fas fa-lock text-sm soft-pulse';
                label.textContent = 'Tick all boxes to continue';
                helper.innerHTML = 'Check all three boxes above to unlock the tutorial.';
                document.getElementById('chk-count').style.color = '';
            }
        }

        function goToTutorial() {
            if (checks.size < 3) return;
            faqDone = true;

            // Mark FAQ tab as done
            document.getElementById('tab-faq').classList.add('done');
            document.getElementById('faq-check').style.opacity = '1';

            // Enable tutorial tab visually
            document.getElementById('tab-tutorial').style.opacity = '1';
            document.getElementById('tab-tutorial').style.pointerEvents = 'auto';

            switchTab(1);
        }

        /* ══ FAQ ACCORDION ══ */
        function toggleFaq(trigger) {
            const item   = trigger.closest('.faq-item');
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        }

        /* ══ TUTORIAL TIMER ══ */
        const TOTAL = 60;
        const R     = 32;
        const C     = +(2 * Math.PI * R).toFixed(4);

        let remaining   = TOTAL;
        let timerDone   = false;
        let timerStarted = false;
        let intervalId  = null;

        const ring         = document.getElementById('ring');
        const timerNum     = document.getElementById('timer-num');
        const timerSub     = document.getElementById('timer-sub');
        const btnCountdown = document.getElementById('btn-countdown');
        const btn          = document.getElementById('continue-btn');
        const btnIcon      = document.getElementById('btn-icon');
        const btnLabel     = document.getElementById('btn-label');
        const helperText   = document.getElementById('helper-text');
        const progressBar  = document.getElementById('progress-bar');
        const progressLbl  = document.getElementById('progress-label');

        ring.setAttribute('stroke-dasharray',  C);
        ring.setAttribute('stroke-dashoffset', C);

        function startTimer() {
            timerStarted = true;
            setTimeout(() => {
                progressBar.style.transition = `width ${TOTAL}s linear`;
                progressBar.style.width = '100%';
                intervalId = setInterval(tick, 1000);
            }, 300);
        }

        function tick() {
            remaining = Math.max(0, remaining - 1);
            const offset = C * (remaining / TOTAL);
            ring.style.transition = 'stroke-dashoffset 0.95s linear';
            ring.style.strokeDashoffset = offset;

            if      (remaining > 15) ring.style.stroke = '#22c55e';
            else if (remaining > 5)  ring.style.stroke = '#f59e0b';
            else                     ring.style.stroke = '#ef4444';

            timerNum.textContent     = remaining;
            btnCountdown.textContent = remaining;
            const pct = Math.round(((TOTAL - remaining) / TOTAL) * 100);
            progressLbl.textContent  = pct + '%';

            if (remaining <= 0) { clearInterval(intervalId); intervalId = null; unlockTutorialBtn(); }
        }

        function unlockTutorialBtn() {
            timerDone = true;
            ring.style.stroke = '#22c55e';
            ring.style.transition = 'stroke-dashoffset 0.4s ease';
            ring.style.strokeDashoffset = '0';
            timerNum.textContent = '✓';
            timerSub.textContent = 'done';
            progressBar.style.width = '100%';
            progressLbl.textContent = '100%';
            progressLbl.style.color = '#4ade80';

            // mark tutorial tab done
            document.getElementById('tab-tutorial').classList.add('done');
            document.getElementById('tutorial-check').style.opacity = '1';

            btn.classList.remove('btn-locked'); btn.classList.add('btn-active');
            btn.removeAttribute('disabled'); btn.style.pointerEvents = 'auto';
            btnIcon.className = 'fas fa-circle-check text-sm';
            btnIcon.classList.remove('soft-pulse');
            btnLabel.innerHTML = 'I have completed the video';
            helperText.innerHTML = '<span style="color:#4ade80;font-weight:600;">&#10003; Unlocked!</span> Click the button to continue.';
        }

        /* ══ MODALS ══ */
        const modalConfirm = document.getElementById('modal-confirm');
        const modalWatch   = document.getElementById('modal-watchagain');

        function showModal(el)  { el.classList.remove('hidden'); el.classList.add('flex'); document.body.style.overflow='hidden'; }
        function hideModal(el)  { el.classList.add('hidden');    el.classList.remove('flex'); document.body.style.overflow=''; }
        function onContinue()   { if (timerDone) showModal(modalConfirm); }
        function onNo()         { hideModal(modalConfirm); showModal(modalWatch); }
        function closeWatchAgain() { hideModal(modalWatch); }

        modalConfirm.addEventListener('click', e => { if (e.target === modalConfirm) hideModal(modalConfirm); });
        modalWatch  .addEventListener('click', e => { if (e.target === modalWatch)   hideModal(modalWatch); });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { hideModal(modalConfirm); hideModal(modalWatch); }
        });

        // Disable tutorial tab click until FAQ done
        document.getElementById('tab-tutorial').style.opacity = '0.4';
        document.getElementById('tab-tutorial').style.pointerEvents = 'none';

        // Form submit feedback
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('tutorial-complete-form');
            if (form) {
                form.addEventListener('submit', function() {
                    const b = this.querySelector('button');
                    b.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                    b.disabled = true;
                });
            }
        });
    </script>
</body>
</html>