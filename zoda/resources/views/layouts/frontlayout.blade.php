<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PaidReader.app - The easiest way to make money online by reading articles.">
    <meta name="keywords" content="make money online, reading articles, earn money, passive income, PaidReader.app">
    <title>PaidReader.app - Make money online by reading articles</title>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="PaidReader.app">
    <meta name="twitter:title" content="Earn cash rewards by reading articles">
    <meta name="twitter:description" content="Join PaidReader.app to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta name="twitter:image" content="{{ asset('assets/img/banner.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="paidreader.app">
    <meta property="og:title" content="Earn cash rewards by reading articles">
    <meta property="og:description" content="Join PaidReader.app to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta property="og:image" content="{{ asset('assets/img/banner.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon-180x180.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-16x16.png') }}" sizes="16x16">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Bricolage Grotesque', 'sans-serif'],
                        body: ['Outfit', 'sans-serif'],
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
                        ink: '#0b1215',
                        amber: '#f59e0b',
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.7s ease-out forwards',
                        'fade-in': 'fadeIn 0.6s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'counter': 'counter 2s ease-out forwards',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(28px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
                        },
                    },
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Outfit', sans-serif; }
        h1, h2, h3, h4, .font-display { font-family: 'Bricolage Grotesque', sans-serif; }

        .hero-bg {
            background: #0b1215;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% 40%, rgba(34,197,94,0.13) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 70%, rgba(16,163,74,0.08) 0%, transparent 50%);
        }

        .ticker-wrap {
            background: linear-gradient(135deg, #16a34a, #15803d);
        }

        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #22c55e;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

        .glass-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(12px);
        }

        .stat-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(34,197,94,0.2);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, #22c55e, #16a34a);
        }

        .step-connector {
            background: linear-gradient(90deg, #22c55e 0%, #16a34a 100%);
        }

        .review-card:hover {
            transform: translateY(-4px);
            border-color: rgba(34,197,94,0.4);
        }

        .faq-item { border-left: 3px solid transparent; transition: all 0.3s ease; }
        .faq-item:hover { border-left-color: #22c55e; padding-left: 1rem; }

        .cta-gradient {
            background: linear-gradient(135deg, #0b1215 0%, #14532d 50%, #166534 100%);
        }

        .advertise-gradient {
            background: linear-gradient(135deg, #1e3a5f 0%, #1e4d8c 50%, #2563eb 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            transition: all 0.25s ease;
            box-shadow: 0 4px 20px rgba(34,197,94,0.35);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(34,197,94,0.5);
        }

        .text-gradient {
            background: linear-gradient(135deg, #22c55e, #86efac);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .dot-pattern {
            background-image: radial-gradient(circle, rgba(34,197,94,0.15) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }

        .mobile-menu-enter { animation: slideIn 0.3s ease-out forwards; }

        [data-animate] {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        [data-animate].in-view {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 { transition-delay: 0.1s; }
        .delay-2 { transition-delay: 0.2s; }
        .delay-3 { transition-delay: 0.3s; }
        .delay-4 { transition-delay: 0.4s; }
        .delay-5 { transition-delay: 0.5s; }
    </style>
</head>
<body class="antialiased bg-white text-gray-800 overflow-x-hidden">

    <!-- ───── NAVBAR ───── -->
    <header class="backdrop-blur-md py-4 px-6 md:px-10 lg:px-16 sticky top-0 z-50 border-b border-white/[0.06]" style="background-color: rgba(11,18,21,0.97);">
        <nav class="container mx-auto flex justify-between items-center max-w-7xl">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2.5 group">
                <div class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center shadow-lg shadow-brand-500/30 group-hover:scale-105 transition-transform">
                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="font-display font-bold text-lg text-white">PaidReader<span class="text-brand-400">.app</span></span>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-8">
                <a href="https://forms.gle/x16E5ByZJ9t6Hic38" class="nav-link text-gray-400 hover:text-white text-sm font-medium transition-colors duration-200">Advertise</a>
                <a href="https://youtu.be/2NRJ2OuE4nM" class="nav-link text-gray-400 hover:text-white text-sm font-medium transition-colors duration-200">How it Works</a>
                <a href="contact" class="nav-link text-gray-400 hover:text-white text-sm font-medium transition-colors duration-200">Contact</a>
            </div>

            <!-- CTA -->
            <div class="hidden md:flex items-center gap-3">
                <a href="/login" class="text-gray-300 hover:text-white text-sm font-medium transition-colors duration-200">Sign In</a>
                <a href="/login" class="btn-primary text-white font-semibold text-sm py-2.5 px-5 rounded-full">
                    Get Started Free →
                </a>
            </div>

            <!-- Hamburger -->
            <button id="hamburger" class="md:hidden text-gray-300 hover:text-white focus:outline-none p-1">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </nav>
    </header>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden fixed inset-0 z-50 flex flex-col" style="background-color: #0b1215;">
        <div class="flex justify-between items-center p-6 border-b border-white/10">
            <span class="font-display font-bold text-lg text-white">PaidReader<span class="text-brand-400">.app</span></span>
            <button id="close-menu" class="text-gray-400 hover:text-white p-1">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="flex flex-col gap-2 p-6 flex-1">
            <a href="https://forms.gle/x16E5ByZJ9t6Hic38" class="text-gray-300 hover:text-white text-lg font-medium py-3 border-b border-white/[0.06]">Advertise</a>
            <a href="https://youtu.be/2NRJ2OuE4nM" class="text-gray-300 hover:text-white text-lg font-medium py-3 border-b border-white/[0.06]">How it Works</a>
            <a href="contact" class="text-gray-300 hover:text-white text-lg font-medium py-3 border-b border-white/[0.06]">Contact</a>
            <a href="/login" class="text-gray-300 hover:text-white text-lg font-medium py-3 border-b border-white/[0.06]">Sign In</a>
        </div>
        <div class="p-6">
            <a href="/login" class="btn-primary block text-center text-white font-bold text-base py-4 px-6 rounded-2xl">
                Get Started Free — It's Free!
            </a>
        </div>
    </div>

    <!-- Page Content -->
    @yield('content')

    <!-- ───── CTA: JOIN READERS ───── -->
    <section class="cta-gradient py-20 px-6 md:px-10 lg:px-16 text-center relative overflow-hidden">
        <div class="dot-pattern absolute inset-0 opacity-40"></div>
        <div class="relative z-10 container mx-auto max-w-3xl">
            <span class="inline-block bg-brand-500/20 text-brand-400 text-xs font-semibold tracking-widest uppercase px-4 py-1.5 rounded-full mb-6 border border-brand-500/30">Start earning today</span>
            <h2 class="font-display text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">Ready to Start Earning?</h2>
            <p class="text-gray-300 text-lg mb-10 max-w-xl mx-auto leading-relaxed">Join over 1 million readers worldwide who are already turning their reading habit into real income every day.</p>
            <a href="signup-publisher" class="btn-primary inline-block text-white font-bold py-4 px-10 rounded-full text-lg">
                Sign Up Now — It's Free!
            </a>
        </div>
    </section>



    <!-- ───── FOOTER ───── -->
    <footer class="bg-[#080d10] text-gray-500 py-12 px-6 md:px-10 lg:px-16">
        <div class="container mx-auto max-w-7xl">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-8 pb-8 border-b border-white/[0.06]">
                <a href="/" class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-brand-600 flex items-center justify-center">
                        <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="font-display font-bold text-base text-white">PaidReader<span class="text-brand-500">.app</span></span>
                </a>
                <p class="text-gray-600 text-sm">The world's #1 platform for earning real cash by reading articles.</p>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm">&copy; 2026 PaidReader.app. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="privacy" class="text-sm hover:text-gray-300 transition-colors duration-200">Privacy Policy</a>
                    <a href="terms" class="text-sm hover:text-gray-300 transition-colors duration-200">Terms of Service</a>
                    <a href="about" class="text-sm hover:text-gray-300 transition-colors duration-200">About</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenu = document.getElementById('close-menu');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = '';
        });

        // Scroll-triggered animations
        const animatedEls = document.querySelectorAll('[data-animate]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        animatedEls.forEach(el => observer.observe(el));
    </script>
</body>
</html>