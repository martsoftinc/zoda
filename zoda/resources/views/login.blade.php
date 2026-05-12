<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon-180x180.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-16x16.png') }}" sizes="16x16">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="Koda.africa">
    <meta name="twitter:title" content="Make Money Online Reading Articles">
    <meta name="twitter:description" content="Join Koda.africa to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta name="twitter:image" content="{{ asset('assets/img/banner.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="koda.africa">
    <meta property="og:title" content="Make Money Online Reading Articles">
    <meta property="og:description" content="Join Koda.africa to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta property="og:image" content="{{ asset('assets/img/banner.png') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign In — Koda.africa</title>

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

        /* Google button */
        .btn-google {
            background: rgba(255,255,255,0.05);
            border: 1.5px solid rgba(255,255,255,0.10);
            color: #fff;
            transition: background 0.2s, border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        }
        .btn-google:hover {
            background: rgba(255,255,255,0.09);
            border-color: rgba(255,255,255,0.18);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.35);
        }
        .btn-google:active { transform: translateY(0); }

        /* Entrance animations */
        @keyframes fadeUp {
            from { opacity:0; transform:translateY(18px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .fade-up   { animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) both; }
        .d1 { animation-delay: .07s }
        .d2 { animation-delay: .15s }
        .d3 { animation-delay: .23s }

        /* Subtle shimmer on the card border */
        @keyframes borderShimmer {
            0%   { border-color: rgba(255,255,255,0.10); }
            50%  { border-color: rgba(34,197,94,0.22); }
            100% { border-color: rgba(255,255,255,0.10); }
        }
        .card-shimmer { animation: borderShimmer 4s ease-in-out infinite; }

        /* Alert */
        .alert-danger-dark {
            background: rgba(239,68,68,0.10);
            border: 1px solid rgba(239,68,68,0.25);
            color: #fca5a5;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13.5px;
        }
        .alert-success-dark {
            background: rgba(34,197,94,0.10);
            border: 1px solid rgba(34,197,94,0.25);
            color: #86efac;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13.5px;
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen p-4 sm:p-6 relative overflow-x-hidden">

    <div class="dot-grid fixed inset-0 pointer-events-none z-0"></div>

    <div class="relative z-10 w-full max-w-sm mx-auto">

        <!-- Brand -->
        <div class="flex justify-center mb-8 fade-up">
            <a href="/" class="flex items-center gap-2.5 group">
                <div class="w-10 h-10 rounded-xl bg-brand-500 flex items-center justify-center shadow-lg shadow-brand-500/30 group-hover:scale-105 transition-transform">
                    <i class="fas fa-globe-africa text-white"></i>
                </div>
                <span class="font-bold text-xl text-white">Koda<span class="text-brand-400">.africa</span></span>
            </a>
        </div>

        <!-- Card -->
        <div class="fade-up d1 card-shimmer rounded-3xl p-7 sm:p-9 shadow-2xl" style="background: #111d20; border: 1px solid rgba(255,255,255,0.10);">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-14 h-14 rounded-2xl bg-brand-500/15 border border-brand-500/25 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-right-to-bracket text-brand-400 text-xl"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-white mb-1.5">Welcome back</h1>
                <p class="text-gray-400 text-sm leading-relaxed">Sign in to your Koda.africa account to continue earning.</p>
            </div>

            <!-- Session messages -->
            @if (session()->has('success'))
                <div class="alert-success-dark flex items-center gap-2.5 mb-5">
                    <i class="fas fa-circle-check text-green-400 flex-shrink-0"></i>
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert-danger-dark flex items-center gap-2.5 mb-5">
                    <i class="fas fa-circle-exclamation text-red-400 flex-shrink-0"></i>
                    {{ session()->get('loginError') }}
                </div>
            @endif

            <!-- Google Sign-In -->
            <a href="/auth/google"
               id="google-btn"
               class="btn-google w-full flex items-center justify-center gap-3.5 py-4 px-5 rounded-2xl font-bold text-base cursor-pointer select-none"
               onclick="handleGoogleClick(this)">

                <!-- Google "G" logo SVG -->
                <svg width="20" height="20" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    <path fill="none" d="M0 0h48v48H0z"/>
                </svg>

                <span id="google-btn-text">Continue with Google</span>
            </a>

            <!-- Divider note -->
            <p class="text-center text-xs text-gray-600 mt-5 leading-relaxed">
                By signing in you agree to our
                <a href="/terms" class="text-gray-500 hover:text-brand-400 transition-colors underline underline-offset-2">Terms of Service</a>
                and
                <a href="/privacy" class="text-gray-500 hover:text-brand-400 transition-colors underline underline-offset-2">Privacy Policy</a>.
            </p>

        </div>

        <!-- Footer -->
        <p class="text-center text-xs text-white/15 mt-6">
            &copy; 2026 Koda.africa
        </p>

    </div>

    <script>
        function handleGoogleClick(el) {
            el.innerHTML = `
                <svg class="animate-spin flex-shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.2)" stroke-width="3"/>
                    <path d="M12 2a10 10 0 0 1 10 10" stroke="#22c55e" stroke-width="3" stroke-linecap="round"/>
                </svg>
                <span>Redirecting to Google…</span>
            `;
            el.style.pointerEvents = 'none';
            el.style.opacity = '0.7';
        }

        // Spin animation via a style tag (Tailwind CDN doesn't always include it)
        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin { to { transform: rotate(360deg); } }
            .animate-spin { animation: spin 0.8s linear infinite; }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>