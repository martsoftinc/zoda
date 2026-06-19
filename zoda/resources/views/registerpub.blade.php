<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete Profile — Koda.africa</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #0b1215;
            background-image:
                radial-gradient(ellipse 70% 50% at 20% 30%, rgba(34,197,94,0.10) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 80% 70%, rgba(34,197,94,0.06) 0%, transparent 55%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
        }

        .dot-grid {
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
            z-index: 0;
        }

        .wrap {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }

        /* ── Brand ── */
        .brand {
            display: flex;
            justify-content: center;
            margin-bottom: 1.75rem;
            animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) both;
        }

        .logo-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #22c55e;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(34,197,94,0.35);
            flex-shrink: 0;
        }

        .logo-text {
            font-weight: 800;
            font-size: 1.25rem;
            color: #fff;
        }

        .logo-text span { color: #4ade80; }

        /* ── Card ── */
        .card {
            background: #111d20;
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 24px;
            padding: 2rem 2.25rem;
            box-shadow: 0 24px 64px rgba(0,0,0,0.5);
            animation: fadeUp 0.5s 0.07s cubic-bezier(0.22,1,0.36,1) both,
                       borderShimmer 4s ease-in-out infinite;
        }

        /* ── Card header ── */
        .card-header {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .header-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: rgba(34,197,94,0.12);
            border: 1px solid rgba(34,197,94,0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .card-header h1 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
        }

        .card-header p {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
        }

        /* ── Alerts ── */
        .alert-danger {
            background: rgba(239,68,68,0.10);
            border: 1px solid rgba(239,68,68,0.25);
            color: #fca5a5;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13.5px;
            margin-bottom: 1.25rem;
        }

        .alert-danger ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        /* ── Form fields ── */
        .field { margin-bottom: 1rem; }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .field-row .field { margin-bottom: 0; }

        label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #9ca3af;
            margin-bottom: 6px;
            letter-spacing: 0.01em;
        }

        label .req { color: #f87171; }

        .input-wrap {
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 14px;
            overflow: hidden;
            transition: border-color 0.2s;
        }

        .input-wrap:focus-within {
            border-color: rgba(34,197,94,0.45);
        }

        .input-icon {
            padding: 0 12px;
            display: flex;
            align-items: center;
            flex-shrink: 0;
            color: #4b5563;
        }

        .input-wrap input,
        .input-wrap select {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            color: #e5e7eb;
            font-size: 0.9rem;
            font-family: inherit;
            padding: 11px 14px 11px 0;
            appearance: none;
            -webkit-appearance: none;
        }

        .input-wrap select option {
            background: #111d20;
            color: #e5e7eb;
        }

        .input-wrap select { cursor: pointer; padding-right: 12px; }

        .input-wrap input::placeholder { color: #4b5563; }

        /* ── Checkbox ── */
        .check-wrap {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 1rem 0;
        }

        .check-wrap input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin-top: 2px;
            accent-color: #22c55e;
            cursor: pointer;
            flex-shrink: 0;
        }

        .check-label {
            font-size: 0.8125rem;
            color: #6b7280;
            line-height: 1.5;
        }

        .check-label a {
            color: #4ade80;
            text-decoration: none;
        }

        /* ── Submit button ── */
        .btn-submit {
            width: 100%;
            background: #22c55e;
            color: #fff;
            font-family: inherit;
            font-weight: 700;
            font-size: 0.9375rem;
            border: none;
            border-radius: 14px;
            padding: 13px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 20px rgba(34,197,94,0.30);
            margin-top: 0.25rem;
        }

        .btn-submit:hover {
            background: #16a34a;
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(34,197,94,0.40);
        }

        .btn-submit:active { transform: translateY(0); }

        /* ── Footer ── */
        .footer {
            text-align: center;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.12);
            margin-top: 1.25rem;
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes borderShimmer {
            0%   { border-color: rgba(255,255,255,0.10); }
            50%  { border-color: rgba(34,197,94,0.22); }
            100% { border-color: rgba(255,255,255,0.10); }
        }

        @media (max-width: 480px) {
            .card { padding: 1.5rem 1.25rem; }
            .field-row { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
    <div class="dot-grid"></div>

    <div class="wrap">

        <!-- Brand -->
        <div class="brand">
            <a href="/" class="logo-link">
                <div class="logo-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="2" y1="12" x2="22" y2="12"/>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                    </svg>
                </div>
                <span class="logo-text">Koda<span>.africa</span></span>
            </a>
        </div>

        <!-- Card -->
        <div class="card">

            <div class="card-header">
                <div class="header-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <h1>Complete Your Profile</h1>
                <p>Just a few details to personalise your experience and get you earning.</p>
            </div>

            <!-- Validation errors (Laravel Blade) -->
            {{-- @if ($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <!-- Form -->
            <form action="/profile/complete" method="POST">
                 @csrf 

                <!-- Full Name -->
                <div class="field">
                    <label for="name">Full Name <span class="req">*</span></label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        <input type="text" id="name" name="name" placeholder="e.g. Amara Mensah" required>
                    </div>
                </div>

                <!-- Gender + Age Group -->
                <div class="field-row">
                    <div class="field">
                        <label for="gender">Gender <span class="req">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4"/>
                                    <path d="M6 20v-2a6 6 0 0 1 12 0v2"/>
                                </svg>
                            </span>
                            <select id="gender" name="gender" required>
                                <option value="" disabled selected>Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label for="age_group">Age Group <span class="req">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </span>
                            <select id="age_group" name="age_group" required>
                                <option value="" disabled selected>Select</option>
                                <option value="18-25">18–25</option>
                                <option value="26-35">26–35</option>
                                <option value="36-45">36–45</option>
                                <option value="46-55">46–55</option>
                                <option value="56+">56+</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Country -->
                <div class="field">
                    <label for="country">Country <span class="req">*</span></label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="2" y1="12" x2="22" y2="12"/>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                            </svg>
                        </span>
                        <select id="country" name="country" required>
                            <option value="" disabled selected>Select your country</option>
                            <option value="GH">Ghana</option>
                            <option value="NG">Nigeria</option>
                            <option value="KE">Kenya</option>
                            <option value="ZA">South Africa</option>
                        </select>
                    </div>
                </div>

                <!-- WhatsApp / Telegram -->
                <div class="field">
                    <label for="phone">WhatsApp / Telegram</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                        </span>
                        <input type="text" id="phone" name="phone" placeholder="+233 XX XXX XXXX">
                    </div>
                </div>

                <!-- Hidden referral -->
                <input type="hidden" name="referral_code" value="">
                <!-- In Blade: value="{{ request('referral') }}" -->

                <!-- Terms -->
                <div class="check-wrap">
                    <input type="checkbox" id="iAgree" name="iAgree" required>
                    <label class="check-label" for="iAgree">
                        I agree to the <a href="/terms" target="_blank">terms and conditions</a>
                    </label>
                </div>

                <button type="submit" class="btn-submit">Sign Up</button>
            </form>

            <p class="footer">&copy; 2026 Koda.africa</p>
        </div>

    </div>
</body>
</html>