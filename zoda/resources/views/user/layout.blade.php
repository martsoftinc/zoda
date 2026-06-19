<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koda.africa - Earn Cash Reading Articles</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PWA -->
    <meta name="theme-color" content="#10b981">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Koda.africa">
    <link rel="apple-touch-icon" href="{{ asset('images/icon-192.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">


    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        mono: ['DM Mono', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50:  '#f0fdf6',
                            100: '#dcfce9',
                            200: '#bbf7d4',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        gold: '#f59e0b',
                        danger: '#ef4444',
                    },
                    boxShadow: {
                        'sidebar': '4px 0 24px rgba(0,0,0,0.06)',
                        'card': '0 2px 16px rgba(0,0,0,0.06)',
                        'card-hover': '0 8px 32px rgba(0,0,0,0.10)',
                    }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 99px; }
        .dark ::-webkit-scrollbar-thumb { background: #374151; }

        /* ── Sidebar ── */
        #sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: 260px; z-index: 40;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
        }
        #sidebar.open { transform: translateX(0); }

        @media (min-width: 1024px) {
            #sidebar { transform: translateX(0); }
            #main-content { margin-left: 260px; }
            #sidebar-overlay { display: none !important; }
            #mobile-menu-btn { display: none; }
        }

        /* ── Sidebar overlay ── */
        #sidebar-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,0.4);
            z-index: 39; display: none; backdrop-filter: blur(2px);
        }
        #sidebar-overlay.show { display: block; }

        /* ── Nav items ── */
        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 16px; border-radius: 12px;
            font-size: 14px; font-weight: 500;
            color: #6b7280; cursor: pointer;
            transition: all 0.18s ease; text-decoration: none;
        }
        .nav-item:hover { background: #f0fdf6; color: #16a34a; }
        .nav-item.active { background: #dcfce9; color: #15803d; font-weight: 600; }
        .dark .nav-item { color: #9ca3af; }
        .dark .nav-item:hover { background: rgba(34,197,94,0.12); color: #4ade80; }
        .dark .nav-item.active { background: rgba(34,197,94,0.18); color: #4ade80; }

        .nav-item .icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
            background: #f3f4f6; color: #6b7280;
            transition: all 0.18s ease;
        }
        .nav-item:hover .icon, .nav-item.active .icon {
            background: #bbf7d4; color: #15803d;
        }
        .dark .nav-item .icon { background: #1f2937; color: #9ca3af; }
        .dark .nav-item:hover .icon, .dark .nav-item.active .icon {
            background: rgba(34,197,94,0.2); color: #4ade80;
        }

        /* ── Mobile bottom nav ── */
        #bottom-nav {
            position: fixed; bottom: 0; left: 0; right: 0;
            z-index: 30; display: flex;
            box-shadow: 0 -1px 0 rgba(0,0,0,0.06);
        }
        @media (min-width: 1024px) { #bottom-nav { display: none; } }
        .bottom-tab {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 8px 4px; gap: 3px; font-size: 10px;
            font-weight: 500; color: #9ca3af;
            transition: color 0.2s; cursor: pointer;
            text-decoration: none; background: transparent; border: none;
        }
        .bottom-tab.active, .bottom-tab:hover { color: #16a34a; }
        .dark .bottom-tab.active, .dark .bottom-tab:hover { color: #4ade80; }
        .bottom-tab i { font-size: 18px; }

        /* ── Dark mode toggle ── */
        .toggle-track {
            width: 44px; height: 24px; border-radius: 99px;
            background: #e5e7eb; position: relative;
            cursor: pointer; transition: background 0.25s;
            flex-shrink: 0;
        }
        .dark .toggle-track { background: #22c55e; }
        .toggle-thumb {
            position: absolute; top: 3px; left: 3px;
            width: 18px; height: 18px; border-radius: 50%;
            background: white; box-shadow: 0 1px 4px rgba(0,0,0,0.2);
            transition: transform 0.25s cubic-bezier(0.4,0,0.2,1);
        }
        .dark .toggle-thumb { transform: translateX(20px); }

        /* ── Card animations ── */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up { animation: slideUp 0.5s ease both; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.10s; }
        .delay-3 { animation-delay: 0.15s; }
        .delay-4 { animation-delay: 0.20s; }

        /* ── Toast ── */
        @keyframes toastIn {
            from { opacity: 0; transform: translateY(8px) translateX(-50%); }
            to   { opacity: 1; transform: translateY(0)   translateX(-50%); }
        }
        .toast { animation: toastIn 0.3s ease both; }

        /* ── Task card ── */
        .task-card {
            border-left: 3px solid #22c55e;
            transition: all 0.25s ease;
        }
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.10);
        }

        /* ── Stat card glow ── */
        .stat-glow-green { box-shadow: 0 0 0 1px rgba(34,197,94,0.15), 0 4px 20px rgba(34,197,94,0.08); }
        .stat-glow-gold  { box-shadow: 0 0 0 1px rgba(245,158,11,0.15), 0 4px 20px rgba(245,158,11,0.08); }

        /* ── Progress bar ── */
        .progress-bar { height: 6px; border-radius: 99px; background: #e5e7eb; overflow: hidden; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, #22c55e, #4ade80); border-radius: 99px; transition: width 0.6s ease; }
        .dark .progress-bar { background: #374151; }

        /* ── Redeem badge pulse ── */
        @keyframes badgePulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.4); }
            50%       { box-shadow: 0 0 0 6px rgba(239,68,68,0); }
        }
        .badge-pulse { animation: badgePulse 2s infinite; }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-200 min-h-screen">

    {{-- ── Install PWA button ── --}}
    <button id="installPwaBtn" onclick="installPWA()"
        class="hidden fixed top-4 right-4 z-50 bg-gradient-to-r from-brand-500 to-gold text-white text-sm font-semibold px-4 py-2 rounded-xl shadow-lg">
        <i class="fas fa-download mr-2"></i>Install App
    </button>

    {{-- ═══════════════ SIDEBAR ═══════════════ --}}
    <div id="sidebar-overlay" onclick="closeSidebar()"></div>

    <aside id="sidebar" class="bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800">

        {{-- Logo --}}
        <div class="px-5 py-5 border-b border-gray-100 dark:border-gray-800">
            <a href="/publisher" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-brand-500 flex items-center justify-center shadow-md shadow-brand-500/30">
                    <i class="fas fa-book-open text-white text-sm"></i>
                </div>
                <span class="font-bold text-lg text-gray-900 dark:text-white">Koda<span class="text-brand-500">.africa</span></span>
            </a>
        </div>

        {{-- User card --}}
        <div class="mx-4 my-4 p-4 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 text-white relative overflow-hidden">
            <div class="absolute -top-4 -right-4 w-20 h-20 bg-white/10 rounded-full"></div>
            <div class="absolute -bottom-6 -left-3 w-16 h-16 bg-white/10 rounded-full"></div>
            <div class="relative z-10">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center font-bold text-base mb-3">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                <p class="font-bold text-sm leading-tight">{{ auth()->user()->name }}</p>
              
            </div>
        </div>

        {{-- Nav links --}}
        <nav class="px-3 pb-4 space-y-1">
            <p class="text-xs font-semibold text-gray-400 dark:text-gray-600 uppercase tracking-widest px-3 mb-2 mt-2">Main</p>

            <a href="/publisher" class="nav-item {{ request()->is('publisher') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-home"></i></span> Dashboard
            </a>
            <a href="/profile" class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-user"></i></span> Profile
            </a>
            <a href="/payments" class="nav-item {{ request()->is('payments') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-clock"></i></span> History
            </a>
            <a href="/referrals" class="nav-item {{ request()->is('referrals') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-users"></i></span> Referrals
            </a>

            <p class="text-xs font-semibold text-gray-400 dark:text-gray-600 uppercase tracking-widest px-3 mb-2 mt-4">Earnings</p>

            <a href="/choose" class="nav-item {{ request()->is('choose') ? 'active' : '' }}">
                <span class="icon" style="background:#fee2e2;color:#ef4444;">
                    <i class="fas fa-money-bill-wave"></i>
                </span>
                <span>Withdraw</span>
                <span class="ml-auto bg-danger text-white text-xs font-bold px-2 py-0.5 rounded-full badge-pulse">Cash</span>
            </a>

            <p class="text-xs font-semibold text-gray-400 dark:text-gray-600 uppercase tracking-widest px-3 mb-2 mt-4">Support</p>

            <a href="/contact" target="_blank"  class="nav-item">
                <span class="icon"><i class="fas fa-envelope"></i></span> Contact Us
            </a>
            <div class="nav-item" onclick="confirmLogout()">
                <span class="icon"><i class="fas fa-sign-out-alt"></i></span> Logout
            </div>
        </nav>

        {{-- Dark mode toggle in sidebar --}}
        <div class="mx-4 mb-4 mt-2 p-3 rounded-2xl bg-gray-50 dark:bg-gray-800 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-sm" id="theme-icon-sidebar">☀️</span>
                <span class="text-sm font-medium text-gray-600 dark:text-gray-300" id="theme-label-sidebar">Light mode</span>
            </div>
            <div class="toggle-track" onclick="toggleDark()" role="button" aria-label="Toggle dark mode">
                <div class="toggle-thumb"></div>
            </div>
        </div>

        {{-- Version --}}
        <div class="px-5 pb-5">
            <p class="text-xs text-gray-400 dark:text-gray-600 font-mono">Koda.africa v2.0</p>
        </div>
    </aside>

    {{-- ═══════════════ MAIN CONTENT ═══════════════ --}}
    <div id="main-content" class="min-h-screen pb-20 lg:pb-0 transition-all duration-300">

        {{-- ── Top Header ── --}}
        <header class="sticky top-0 z-30 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center justify-between px-4 lg:px-6 h-16">

                {{-- Left: hamburger + logo --}}
                <div class="flex items-center gap-3">
                    <button id="mobile-menu-btn" onclick="openSidebar()"
                        class="w-9 h-9 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-brand-50 dark:hover:bg-gray-700 transition-colors lg:hidden">
                        <i class="fas fa-bars text-sm"></i>
                    </button>
                    <span class="font-bold text-gray-900 dark:text-white text-lg lg:hidden">
                        Koda<span class="text-brand-500">.africa</span>
                    </span>
                </div>

                {{-- Right: dark mode + user --}}
                <div class="flex items-center gap-3">

                    {{-- Dark mode toggle --}}
                    <div class="hidden sm:flex items-center gap-2">
                        <span class="text-sm" id="theme-icon-header">☀️</span>
                        <div class="toggle-track" onclick="toggleDark()" role="button" aria-label="Toggle dark mode">
                            <div class="toggle-thumb"></div>
                        </div>
                        <span class="text-sm" id="theme-icon-header-moon">🌙</span>
                    </div>

                    {{-- Divider --}}
                    <div class="hidden sm:block w-px h-6 bg-gray-200 dark:bg-gray-700"></div>

                    {{-- User chip --}}
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-brand-500/25">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white leading-tight">{{ auth()->user()->name }}</p>
                            @if($credit ?? false)
                            <p class="text-xs text-brand-600 dark:text-brand-400 font-medium leading-tight">{{ number_format($credit->credit ?? 0) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        <div class="px-4 lg:px-6 pt-4 space-y-2">
            @if(session()->has('success'))
                <div class="flex items-center gap-3 bg-brand-50 dark:bg-brand-900/30 border border-brand-200 dark:border-brand-800 text-brand-800 dark:text-brand-200 px-4 py-3 rounded-2xl text-sm animate-slide-up" role="alert">
                    <i class="fas fa-check-circle text-brand-500 flex-shrink-0"></i>
                    <span>{{ session()->get('success') }}</span>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="flex items-center gap-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-2xl text-sm animate-slide-up" role="alert">
                    <i class="fas fa-exclamation-circle text-red-500 flex-shrink-0"></i>
                    <span>{{ session()->get('error') }}</span>
                </div>
            @endif
        </div>

        {{-- Page content --}}
        @yield('content')
    </div>

    {{-- ═══════════════ MOBILE BOTTOM NAV ═══════════════ --}}
    <nav id="bottom-nav" class="bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
        <a href="/publisher" class="bottom-tab {{ request()->is('publisher') ? 'active' : '' }}">
            <i class="fas fa-home"></i><span>Home</span>
        </a>
        <a href="/choose" class="bottom-tab {{ request()->is('choose') ? 'active' : '' }}">
            <i class="fas fa-dollar-sign"></i><span>Withdraw</span>
        </a>
        <a href="/referrals" class="bottom-tab {{ request()->is('referrals') ? 'active' : '' }}">
            <i class="fas fa-users"></i><span>Referrals</span>
        </a>
        <button class="bottom-tab" onclick="toggleDark()">
            <i class="fas fa-moon" id="bottom-theme-icon"></i><span id="bottom-theme-label">Dark</span>
        </button>
        <button class="bottom-tab" onclick="openSidebar()">
            <i class="fas fa-bars"></i><span>Menu</span>
        </button>
    </nav>

    {{-- Logout form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

    <script>
        // ── Dark mode ──
        const html = document.documentElement;

        function applyTheme(dark) {
            if (dark) {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
            updateThemeUI(dark);
        }

        function updateThemeUI(dark) {
            const icons = ['theme-icon-sidebar', 'theme-icon-header'];
            icons.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = dark ? '🌙' : '☀️';
            });
            const labelSidebar = document.getElementById('theme-label-sidebar');
            if (labelSidebar) labelSidebar.textContent = dark ? 'Dark mode' : 'Light mode';
            const bottomIcon = document.getElementById('bottom-theme-icon');
            if (bottomIcon) { bottomIcon.className = dark ? 'fas fa-sun' : 'fas fa-moon'; }
            const bottomLabel = document.getElementById('bottom-theme-label');
            if (bottomLabel) bottomLabel.textContent = dark ? 'Light' : 'Dark';
        }

        function toggleDark() {
            applyTheme(!html.classList.contains('dark'));
        }

        // Init theme
        const saved = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        applyTheme(saved === 'dark' || (!saved && prefersDark));

        // ── Sidebar ──
        function openSidebar() {
            document.getElementById('sidebar').classList.add('open');
            document.getElementById('sidebar-overlay').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebar-overlay').classList.remove('show');
            document.body.style.overflow = '';
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeSidebar();
        });

        // ── Logout ──
        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logout-form').submit();
            }
        }

        // ── PWA install ──
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            const btn = document.getElementById('installPwaBtn');
            if (btn) btn.classList.remove('hidden');
        });
        function installPWA() {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then(() => { deferredPrompt = null; });
            }
        }

        // ── Toast utility ──
        window.showToast = function(message, type = 'success') {
            document.querySelectorAll('.app-toast').forEach(t => t.remove());
            const toast = document.createElement('div');
            const color = type === 'success' ? 'bg-gray-900 dark:bg-gray-800' : 'bg-red-600';
            toast.className = `app-toast toast fixed bottom-24 lg:bottom-6 left-1/2 ${color} text-white text-sm font-medium px-5 py-3 rounded-2xl shadow-xl z-50 flex items-center gap-2`;
            toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle text-brand-400' : 'exclamation-circle text-red-200'}"></i><span>${message}</span>`;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ── Service worker ──
        @if(config('pwa.serviceWorker.cache'))
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').catch(e => console.log('SW failed:', e));
            });
        }
        @endif

        // ── Scroll animations ──
        document.addEventListener('DOMContentLoaded', () => {
            const obs = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.style.opacity = '1';
                        e.target.style.transform = 'translateY(0)';
                        obs.unobserve(e.target);
                    }
                });
            }, { threshold: 0.08 });
            document.querySelectorAll('.task-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(16px)';
                card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                obs.observe(card);
            });
        });
    </script>
</body>
</html>