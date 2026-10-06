@extends('layouts.frontlayout')

@section('title', 'Get Started — Koda.africa')

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* ── Tab switcher ── */
    .tab-bar {
      display: grid;
      grid-template-columns: 1fr 1fr;
      background: #f9fafb;
      border: 1px solid #e5e7eb;
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
      color: #6b7280;
      background: transparent;
    }
    .tab-btn.active {
      background: #fff;
      color: #1a1a1a;
      box-shadow: 0 1px 3px rgba(0,0,0,0.06), inset 0 0 0 1px #e5e7eb;
    }
    .tab-btn .tab-check {
      width: 16px; height: 16px;
      border-radius: 50%;
      background: #e4f7ea;
      display: flex; align-items: center; justify-content: center;
      font-size: 8px;
      color: #16a34a;
      flex-shrink: 0;
      opacity: 0;
      transition: opacity 0.2s;
    }
    .tab-btn.done .tab-check { opacity: 1; }

    /* ── Panels ── */
    .panels-wrap { overflow: hidden; position: relative; }
    .panels-inner {
      display: flex;
      transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1);
      will-change: transform;
    }
    .panel { flex: 0 0 100%; width: 100%; }

    /* ── FAQ accordion ── */
    .faq-item {
      border: 1px solid #e5e7eb;
      border-radius: 14px;
      overflow: hidden;
      transition: border-color 0.2s;
      background: #fff;
    }
    .faq-item.open { border-color: #1f6ff8; }
    .faq-trigger {
      width: 100%; text-align: left;
      background: #fff;
      padding: 15px 18px;
      cursor: pointer;
      display: flex; align-items: center; justify-content: space-between; gap: 10px;
      transition: background 0.15s;
      border: none;
      color: #1a1a1a;
    }
    .faq-trigger:hover { background: #f9fafb; }
    .faq-item.open .faq-trigger { background: #f0f6ff; }
    .faq-chevron {
      color: #9ca3af;
      font-size: 11px;
      flex-shrink: 0;
      transition: transform 0.3s, color 0.2s;
    }
    .faq-item.open .faq-chevron { transform: rotate(180deg); color: #1f6ff8; }
    .faq-body { max-height: 0; overflow: hidden; transition: max-height 0.35s cubic-bezier(0.4,0,0.2,1); }
    .faq-item.open .faq-body { max-height: 300px; }
    .faq-content {
      padding: 13px 18px 15px;
      color: #3c3c43;
      font-size: 13.5px;
      line-height: 1.75;
      border-top: 1px solid #f3f4f6;
    }

    /* ── Check items ── */
    .check-item {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 13px 15px;
      border-radius: 12px;
      background: #fff;
      border: 1.5px solid #e5e7eb;
      cursor: pointer;
      transition: background 0.15s, border-color 0.15s;
      user-select: none;
    }
    .check-item:hover { background: #f9fafb; }
    .check-item.checked { background: #f0f6ff; border-color: #1f6ff8; }
    .check-box {
      width: 20px; height: 20px; border-radius: 6px;
      border: 1.5px solid #d1d5db;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; margin-top: 1px;
      transition: background 0.15s, border-color 0.15s;
      background: #fff;
    }
    .check-item.checked .check-box { background: #1f6ff8; border-color: #1f6ff8; }
    .check-box i { font-size: 10px; color: #fff; opacity: 0; transition: opacity 0.15s; }
    .check-item.checked .check-box i { opacity: 1; }

    /* ── Buttons ── */
    .btn-locked {
      background: #f3f4f6;
      color: #9ca3af;
      border: 1.5px solid #e5e7eb;
      cursor: not-allowed;
      pointer-events: none;
    }
    .btn-active {
      background: #1f6ff8;
      color: #fff;
      border: none;
      cursor: pointer;
      transition: transform .2s, box-shadow .2s, background .2s;
    }
    .btn-active:hover {
      background: #1a5fd0;
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(31,111,248,0.25);
    }

    /* ── Video ── */
    .video-wrap { position:relative; padding-bottom:56.25%; height:0; overflow:hidden; border-radius:16px; }
    .video-wrap iframe { position:absolute; top:0; left:0; width:100%; height:100%; border:none; }

    /* ── Ring ── */
    .ring-track { stroke: #e5e7eb; }
    .ring-fill  { stroke: #1f6ff8; stroke-linecap: round; }

    /* ── Step indicators ── */
    .step-done   { background:#1f6ff8; color:#fff; }
    .step-active { background:#e8f0ff; color:#1f6ff8; border:1.5px solid #1f6ff8; }
    .step-todo   { background:#f3f4f6; color:#9ca3af; }

    /* ── Modal ── */
    .backdrop { background: rgba(0,0,0,0.45); backdrop-filter: blur(6px); }
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
@endpush

@section('content')
  <section class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 pt-12 md:pt-20 pb-24 md:pb-32">

      <div class="w-full max-w-2xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-10 fade-up">
          <div class="yellow rounded-full px-4 py-2 w-fit text-sm font-semibold mb-5 mx-auto">Getting started</div>
          <h1 class="text-4xl md:text-5xl font-extrabold text-[#1a1a1a] leading-tight">Almost there</h1>
          <p class="text-lg text-[#3c3c43] mt-4">Two quick steps before you start earning.</p>
        </div>

        <!-- Steps -->
        <div class="flex items-center justify-center gap-3 mb-10 fade-up d1">
          <div class="flex items-center gap-1.5">
            <div class="w-7 h-7 rounded-full step-done flex items-center justify-center text-xs font-bold">
              <i class="fas fa-check text-[10px]"></i>
            </div>
            <span class="text-xs font-semibold text-[#1f6ff8] hidden sm:inline">Sign Up</span>
          </div>
          <div class="w-8 sm:w-12 h-px bg-gray-300"></div>
          <div class="flex items-center gap-1.5">
            <div class="w-7 h-7 rounded-full step-active flex items-center justify-center text-xs font-bold">2</div>
            <span class="text-xs font-semibold text-[#1f6ff8] hidden sm:inline">Tutorial</span>
          </div>
          <div class="w-8 sm:w-12 h-px bg-gray-300"></div>
          <div class="flex items-center gap-1.5">
            <div class="w-7 h-7 rounded-full step-todo flex items-center justify-center text-xs font-bold">3</div>
            <span class="text-xs font-semibold text-gray-400 hidden sm:inline">Dashboard</span>
          </div>
        </div>

        <!-- Main card -->
        <div class="rounded-[20px] bg-white p-6 sm:p-8 shadow-sm border border-gray-100 fade-up d2">

          <!-- Tab bar -->
          <div class="tab-bar mb-7" id="tab-bar">
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
                  <h2 class="text-xl sm:text-2xl font-extrabold text-[#1a1a1a] leading-tight mb-2">
                    Read Before You Start
                  </h2>
                  <p class="text-[#3c3c43] text-sm leading-relaxed">
                    Understand how Koda.africa works, then confirm you agree to continue.
                  </p>
                </div>

                <!-- FAQ -->
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3">Frequently Asked Questions</p>
                <div class="flex flex-col gap-2 mb-7">

                  <div class="faq-item">
                    <button class="faq-trigger" onclick="toggleFaq(this)">
                      <div class="flex items-center gap-2.5">
                        <span class="text-[#1f6ff8] text-xs font-bold w-5 flex-shrink-0">Q1</span>
                        <span class="font-semibold text-sm text-[#1a1a1a]">How do I earn with Koda.africa?</span>
                      </div>
                      <i class="fas fa-chevron-down faq-chevron"></i>
                    </button>
                    <div class="faq-body">
                      <div class="faq-content">You earn by reading brands sponsored articles assigned to you on your dashboard. Each article you complete adds cash to your balance. Once you reach the minimum withdrawal amount, you can request a payout. You can withdraw via Mobile Money (Ghana &amp; Kenya) or Bank Transfer (Nigeria &amp; South Africa).</div>
                    </div>
                  </div>

                  <div class="faq-item">
                    <button class="faq-trigger" onclick="toggleFaq(this)">
                      <div class="flex items-center gap-2.5">
                        <span class="text-[#1f6ff8] text-xs font-bold w-5 flex-shrink-0">Q2</span>
                        <span class="font-semibold text-sm text-[#1a1a1a]">When and how do I get paid?</span>
                      </div>
                      <i class="fas fa-chevron-down faq-chevron"></i>
                    </button>
                    <div class="faq-body">
                      <div class="faq-content">We pay on the 1st, 15th and 25th of the month.Payouts are processed once you reach the minimum withdrawal amount shown in your dashboard. You can request payment via your account's dashboard by clicking the "Withdraw" button. Processing typically takes 1–2 business days, please note we don't process payments on weekends.</div>
                    </div>
                  </div>

                  <div class="faq-item">
                    <button class="faq-trigger" onclick="toggleFaq(this)">
                      <div class="flex items-center gap-2.5">
                        <span class="text-[#1f6ff8] text-xs font-bold w-5 flex-shrink-0">Q3</span>
                        <span class="font-semibold text-sm text-[#1a1a1a]">Are there rules I must follow?</span>
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
                        <span class="text-[#1f6ff8] text-xs font-bold w-5 flex-shrink-0">Q4</span>
                        <span class="font-semibold text-sm text-[#1a1a1a]">Is it totally free ?</span>
                      </div>
                      <i class="fas fa-chevron-down faq-chevron"></i>
                    </button>
                    <div class="faq-body">
                      <div class="faq-content">It's free to join and start earning. There are no upgrades or additional fees required. </div>
                    </div>
                  </div>

                  <div class="faq-item">
                    <button class="faq-trigger" onclick="toggleFaq(this)">
                      <div class="flex items-center gap-2.5">
                        <span class="text-[#1f6ff8] text-xs font-bold w-5 flex-shrink-0">Q5</span>
                        <span class="font-semibold text-sm text-[#1a1a1a]">How much can I earn?</span>
                      </div>
                      <i class="fas fa-chevron-down faq-chevron"></i>
                    </button>
                    <div class="faq-body">
                      <div class="faq-content">You can earn by reading articles assigned to you on your dashboard. The amount you earn depends on the number of articles you complete.</div>
                    </div>
                  </div>

                  <div class="faq-item">
                    <button class="faq-trigger" onclick="toggleFaq(this)">
                      <div class="flex items-center gap-2.5">
                        <span class="text-[#1f6ff8] text-xs font-bold w-5 flex-shrink-0">Q6</span>
                        <span class="font-semibold text-sm text-[#1a1a1a]">How can I earn more?</span>
                      </div>
                      <i class="fas fa-chevron-down faq-chevron"></i>
                    </button>
                    <div class="faq-body">
                      <div class="faq-content">
                          You can earn by reading sponsored articles assigned to you on your dashboard. You can also earn extra money by sharing your referral link. When someone signs up using your link and makes a withdrawal, you earn a referral reward based on their country: ₦150 in Nigeria, GH₵3 in Ghana, KSh3 in Kenya, and R3 in South Africa. For example, referring 500 Nigerian users who each make a withdrawal could earn you ₦75,000 in referral rewards. Share your link with friends and family and earn extra while helping them make money in their free time.
                      </div>
                    </div>
                  </div>

                </div>

                <!-- Divider -->
                <div class="flex items-center gap-3 mb-4">
                  <div class="flex-1 h-px bg-gray-200"></div>
                  <span class="text-[11px] text-gray-400 font-semibold uppercase tracking-widest">Confirm &amp; agree</span>
                  <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- Checkboxes -->
                <div class="flex flex-col gap-2 mb-5">
                  <div class="check-item" id="chk-1" onclick="toggleCheck('chk-1')">
                    <div class="check-box"><i class="fas fa-check"></i></div>
                    <div>
                      <p class="text-sm font-semibold text-[#1a1a1a]">I understand how earning and payouts work</p>
                      <p class="text-xs text-gray-500 mt-0.5">I know I earn by reading and I need a minimum balance to withdraw.</p>
                    </div>
                  </div>
                  <div class="check-item" id="chk-2" onclick="toggleCheck('chk-2')">
                    <div class="check-box"><i class="fas fa-check"></i></div>
                    <div>
                      <p class="text-sm font-semibold text-[#1a1a1a]">I agree to the rules — no bots, one account only</p>
                      <p class="text-xs text-gray-500 mt-0.5">I will read honestly and not use automation or create duplicate accounts.</p>
                    </div>
                  </div>
                  <div class="check-item" id="chk-3" onclick="toggleCheck('chk-3')">
                    <div class="check-box"><i class="fas fa-check"></i></div>
                    <div>
                      <p class="text-sm font-semibold text-[#1a1a1a]">I accept the Terms of Service &amp; Privacy Policy</p>
                      <p class="text-xs text-gray-500 mt-0.5">I have read and agree to Koda.africa's <a href="/terms" target="_blank" class="text-[#1f6ff8] hover:underline">terms and conditions</a>.</p>
                    </div>
                  </div>
                </div>

                <!-- Progress -->
                <div class="mb-5">
                  <div class="flex justify-between items-center mb-1.5">
                    <span class="text-[11px] text-gray-500 font-medium">Confirmations</span>
                    <span id="chk-count" class="text-[11px] font-bold text-gray-500">0 / 3</span>
                  </div>
                  <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div id="chk-bar" class="h-full bg-[#1f6ff8] rounded-full" style="width:0%; transition: width 0.35s cubic-bezier(0.4,0,0.2,1);"></div>
                  </div>
                </div>

                <!-- Continue to tutorial button -->
                <button id="faq-continue-btn"
                        onclick="goToTutorial()"
                        class="btn-locked w-full flex items-center justify-center gap-3 py-4 px-6 rounded-full font-bold text-sm">
                  <i id="faq-btn-icon" class="fas fa-lock text-sm"></i>
                  <span id="faq-btn-label">Tick all boxes to continue</span>
                  <i class="fas fa-arrow-right text-xs opacity-60"></i>
                </button>
                <p id="faq-helper" class="text-center text-xs text-gray-500 mt-3">Check all three boxes above to unlock the tutorial.</p>

              </div>
              <!-- end panel 1 -->

              <!-- ══ PANEL 2: Tutorial ══ -->
              <div class="panel" id="panel-tutorial">

                <div class="text-center mb-6">
                  <h2 class="text-xl sm:text-2xl font-extrabold text-[#1a1a1a] leading-tight mb-2">
                    Watch the Tutorial
                  </h2>
                  <p class="text-[#3c3c43] text-sm leading-relaxed">
                    Watch the full video to see exactly how to read and earn.
                  </p>
                </div>

                <!-- Video -->
                <div class="video-wrap mb-5 shadow-sm ring-1 ring-gray-100">
                  <iframe
                      src="https://www.youtube.com/embed/4gqi4anuWGA?rel=0&modestbranding=1"
                      title="Koda.africa Tutorial"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                      allowfullscreen>
                  </iframe>
                </div>

                <!-- Progress bar -->
                <div class="mb-5">
                  <div class="flex items-center justify-between mb-2">
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Video progress</span>
                    <span id="progress-label" class="text-[11px] font-bold text-gray-500">0%</span>
                  </div>
                  <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                    <div id="progress-bar" class="h-full bg-[#1f6ff8] rounded-full" style="width:0%; transition:none;"></div>
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
                      <span id="timer-num" class="font-bold leading-none text-[#1a1a1a]" style="font-size:18px;">60</span>
                      <span id="timer-sub" class="font-medium leading-none mt-0.5 text-gray-500" style="font-size:9px;">secs</span>
                    </div>
                  </div>

                  <button id="continue-btn"
                          onclick="onContinue()"
                          class="btn-locked w-full sm:flex-1 flex items-center justify-center gap-3 py-4 px-6 rounded-full font-bold text-base">
                    <i id="btn-icon" class="fas fa-lock text-sm"></i>
                    <span id="btn-label">Wait&nbsp;<span id="btn-countdown">60</span>s to continue</span>
                  </button>
                </div>

                <p id="helper-text" class="text-center text-xs text-gray-500 mt-4">
                  The button unlocks after <strong class="text-[#1a1a1a]">60 seconds</strong> — please watch the full video.
                </p>

                <!-- Back link -->
                <button onclick="switchTab(0)" class="w-full mt-4 text-xs text-gray-500 hover:text-[#1f6ff8] transition-colors flex items-center justify-center gap-1.5">
                  <i class="fas fa-arrow-left text-[10px]"></i> Back to FAQ
                </button>

              </div>
              <!-- end panel 2 -->

            </div>
          </div>
          <!-- end panels -->

        </div>

        <p class="text-center text-xs text-[#3c3c43] mt-6">
          You only need to do this once.
        </p>
      </div>

    </div>
  </section>

  <!-- ══ MODAL: Understood? ══ -->
  <div id="modal-confirm" class="backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="modal-card bg-white rounded-[20px] shadow-2xl w-full max-w-sm p-6 sm:p-8 text-center">
      <div class="w-16 h-16 rounded-3xl bg-[#e8f0ff] flex items-center justify-center mx-auto mb-5">
        <i class="fas fa-circle-question text-[#1f6ff8] text-2xl"></i>
      </div>
      <h2 class="text-xl font-extrabold text-[#1a1a1a] mb-2 leading-tight">Have you understood<br>the tutorial?</h2>
      <p class="text-[#3c3c43] text-sm mb-7 leading-relaxed">Make sure you know how to read articles and earn points before you start.</p>
      <div class="flex flex-col sm:flex-row gap-3">
        <form id="tutorial-complete-form" action="{{ route('tutorial.complete') }}" method="POST" class="flex-1">
          @csrf
          <button type="submit" class="w-full flex items-center justify-center gap-2 btn-blue font-bold py-4 rounded-full transition-colors text-sm">
            <i class="fas fa-check-circle"></i> Yes, I'm ready!
          </button>
        </form>
        <button onclick="onNo()" class="flex-1 flex items-center justify-center gap-2 bg-white hover:bg-gray-50 border border-gray-200 text-[#3c3c43] font-bold py-4 rounded-full transition-colors text-sm">
          <i class="fas fa-rotate-left"></i> No, watch again
        </button>
      </div>
      <p class="text-xs text-gray-400 mt-5">You can re-watch the video at any time.</p>
    </div>
  </div>

  <!-- ══ MODAL: Watch again ══ -->
  <div id="modal-watchagain" class="backdrop fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="modal-card bg-white rounded-[20px] shadow-2xl w-full max-w-sm p-6 sm:p-8 text-center">
      <div class="w-16 h-16 rounded-3xl yellow flex items-center justify-center mx-auto mb-5">
        <i class="fas fa-triangle-exclamation text-[#1a1a1a] text-2xl"></i>
      </div>
      <h2 class="text-xl font-extrabold text-[#1a1a1a] mb-2 leading-tight">Please watch the video again</h2>
      <p class="text-[#3c3c43] text-sm mb-7 leading-relaxed">No worries! Go back and watch the tutorial fully so you know exactly how to earn with Koda.africa.</p>
      <button onclick="closeWatchAgain()" class="w-full flex items-center justify-center gap-2 btn-blue font-bold py-4 rounded-full transition-colors text-sm">
        <i class="fas fa-play-circle"></i> OK, I'll watch it again
      </button>
      <p class="text-xs text-gray-400 mt-5">The continue button will remain active.</p>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    /* ══ TAB / PANEL ══ */
    let currentTab = 0;
    let faqDone = false;

    function switchTab(idx) {
      if (idx === 1 && !faqDone) return;

      currentTab = idx;
      document.getElementById('panels-inner').style.transform =
        idx === 0 ? 'translateX(0)' : 'translateX(-100%)';

      document.getElementById('tab-faq').classList.toggle('active', idx === 0);
      document.getElementById('tab-tutorial').classList.toggle('active', idx === 1);

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
        label.textContent = 'Continue to Tutorial';
        helper.innerHTML = '<span style="color:#1f6ff8;font-weight:600;">&#10003; All confirmed!</span> Click to watch the tutorial.';
        document.getElementById('chk-count').style.color = '#1f6ff8';
      } else {
        btn.classList.add('btn-locked'); btn.classList.remove('btn-active');
        icon.className = 'fas fa-lock text-sm';
        label.textContent = 'Tick all boxes to continue';
        helper.innerHTML = 'Check all three boxes above to unlock the tutorial.';
        document.getElementById('chk-count').style.color = '';
      }
    }

    function goToTutorial() {
      if (checks.size < 3) return;
      faqDone = true;

      document.getElementById('tab-faq').classList.add('done');
      document.getElementById('faq-check').style.opacity = '1';

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

    let remaining    = TOTAL;
    let timerDone    = false;
    let timerStarted = false;
    let intervalId   = null;

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

      if      (remaining > 15) ring.style.stroke = '#1f6ff8';
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
      ring.style.stroke = '#1f6ff8';
      ring.style.transition = 'stroke-dashoffset 0.4s ease';
      ring.style.strokeDashoffset = '0';
      timerNum.textContent = '✓';
      timerSub.textContent = 'done';
      progressBar.style.width = '100%';
      progressLbl.textContent = '100%';
      progressLbl.style.color = '#1f6ff8';

      document.getElementById('tab-tutorial').classList.add('done');
      document.getElementById('tutorial-check').style.opacity = '1';

      btn.classList.remove('btn-locked'); btn.classList.add('btn-active');
      btn.removeAttribute('disabled'); btn.style.pointerEvents = 'auto';
      btnIcon.className = 'fas fa-circle-check text-sm';
      btnLabel.innerHTML = 'I have completed the video';
      helperText.innerHTML = '<span style="color:#1f6ff8;font-weight:600;">&#10003; Unlocked!</span> Click the button to continue.';
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

    document.getElementById('tab-tutorial').style.opacity = '0.5';
    document.getElementById('tab-tutorial').style.pointerEvents = 'none';

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
@endpush