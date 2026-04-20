@extends('layouts.frontlayout')
@section('content')

{{-- ═══════════════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════════════ --}}
<section class="hero-bg relative overflow-hidden min-h-[92vh] flex items-center">

    {{-- Decorative blobs --}}
    <div class="absolute top-1/4 left-0 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl pointer-events-none -translate-x-1/2"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-brand-700/10 rounded-full blur-3xl pointer-events-none translate-x-1/3"></div>
    <div class="absolute top-10 right-1/4 w-48 h-48 bg-brand-400/5 rounded-full blur-2xl pointer-events-none"></div>

    {{-- Dot grid overlay --}}
    <div class="absolute inset-0 dot-pattern opacity-30 pointer-events-none"></div>

    <div class="container mx-auto max-w-7xl px-6 md:px-10 lg:px-16 py-20 md:py-28 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-20">

            {{-- ── Left: Text Content ── --}}
            <div class="md:w-1/2 text-center md:text-left">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 bg-brand-500/10 border border-brand-500/25 text-brand-400 text-xs font-semibold tracking-widest uppercase px-4 py-2 rounded-full mb-8 animate-fade-up">
                    <span class="w-1.5 h-1.5 bg-brand-400 rounded-full animate-pulse-slow"></span>
                    #1 Platform Worldwide
                </div>

                {{-- Headline --}}
                <h1 class="font-display text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-white leading-[1.06] mb-6 animate-fade-up" style="animation-delay:0.1s">
                    #1 Website<br>
                    <span class="text-gradient">To Earn From</span><br>
                    Reading
                </h1>

                {{-- Sub --}}
                <p class="text-gray-400 text-lg md:text-xl leading-relaxed mb-10 max-w-md mx-auto md:mx-0 animate-fade-up" style="animation-delay:0.2s">
                    Sign up, read articles and make real money — it's that simple. Join over <strong class="text-white font-semibold">1,000,000+</strong> people worldwide already earning daily.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start mb-10 animate-fade-up" style="animation-delay:0.3s">
                    <a href="{{ route('google.login') }}" class="btn-primary flex items-center justify-center gap-2.5 text-white font-bold py-4 px-8 rounded-full text-base">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#fff"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#fff"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#fff"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#fff"/>
                        </svg>
                        Continue with Google
                    </a>
                    <a href="signup-publisher" class="flex items-center justify-center gap-2 text-white font-semibold py-4 px-8 rounded-full text-base border border-white/20 hover:border-brand-400/50 hover:bg-white/5 transition-all duration-200">
                        Register with Email →
                    </a>
                </div>

                {{-- Trust signals --}}
                <div class="flex items-center gap-4 justify-center md:justify-start animate-fade-up" style="animation-delay:0.4s">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-brand-600 border-2 border-[#0b1215] flex items-center justify-center text-xs text-white font-bold">A</div>
                        <div class="w-8 h-8 rounded-full bg-blue-600 border-2 border-[#0b1215] flex items-center justify-center text-xs text-white font-bold">K</div>
                        <div class="w-8 h-8 rounded-full bg-purple-600 border-2 border-[#0b1215] flex items-center justify-center text-xs text-white font-bold">T</div>
                        <div class="w-8 h-8 rounded-full bg-amber-500 border-2 border-[#0b1215] flex items-center justify-center text-xs text-white font-bold">W</div>
                    </div>
                    <p class="text-gray-400 text-sm"><span class="text-white font-semibold">1M+</span> readers earning right now</p>
                </div>
            </div>

            {{-- ── Right: Hero Image / Card ── --}}
            <div class="md:w-1/2 flex justify-center relative animate-fade-up" style="animation-delay:0.25s">
                <div class="relative w-full max-w-md">

                    {{-- Main hero image --}}
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-black/50 border border-white/10">
                        <img
                            src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgaDU2yuq2Y48UptMW87fAd0SuMydCeBMDzXSa7V3HgGTj6E31nxzb4HcVMI6kg_xE9sPjaW5MwDC7HuwQPm9v5AiBpmtSXfJDv7BAhByXEkOTYp83aNeYYPlotjE-Ei8EYLyoR_xlEuLyHnRswu49GfnWjWnRmmX52csVJR9AA95N7G4muxt5XqKAksrNM/s16000/Add%20a%20heading%20(1).png"
                            alt="Reading and earning on PaidReader"
                            class="w-full h-auto object-cover"
                        >
                    </div>

                    {{-- Floating badge: earnings --}}
                    <div class="absolute -bottom-5 -left-6 glass-card rounded-2xl px-4 py-3 shadow-xl animate-float" style="animation-delay:0.5s">
                        <p class="text-gray-400 text-xs mb-0.5">Today's earnings</p>
                        <p class="text-brand-400 font-display font-bold text-xl">+$4.75 <span class="text-xs text-gray-500 font-normal">/ today</span></p>
                    </div>

                    {{-- Floating badge: payout --}}
                    <div class="absolute -top-4 -right-4 glass-card rounded-2xl px-4 py-3 shadow-xl animate-float" style="animation-delay:1.5s">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 bg-brand-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-bold text-sm leading-none">$500K+</p>
                                <p class="text-gray-500 text-xs">paid weekly</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     STATS SECTION
═══════════════════════════════════════════════ --}}
<section class="bg-[#0d1a12] border-y border-brand-900/50 py-12 px-6 md:px-10 lg:px-16">
    <div class="container mx-auto max-w-5xl">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            <div class="stat-card rounded-2xl px-8 py-7 text-center" data-animate>
                <div class="w-10 h-10 bg-brand-500/15 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-5 h-5 text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <p class="font-display text-4xl font-extrabold text-white mb-1.5" data-count="1000000" data-prefix="" data-suffix="M+">1M+</p>
                <p class="text-gray-400 text-sm font-medium">Registered Users</p>
            </div>

            <div class="stat-card rounded-2xl px-8 py-7 text-center" data-animate style="transition-delay:0.15s">
                <div class="w-10 h-10 bg-brand-500/15 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-5 h-5 text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="font-display text-4xl font-extrabold text-white mb-1.5">$500,000+</p>
                <p class="text-gray-400 text-sm font-medium">Weekly Paid to Our Readers</p>
            </div>

            <div class="stat-card rounded-2xl px-8 py-7 text-center" data-animate style="transition-delay:0.3s">
                <div class="w-10 h-10 bg-brand-500/15 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-5 h-5 text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="font-display text-4xl font-extrabold text-white mb-1.5">50,000+</p>
                <p class="text-gray-400 text-sm font-medium">Articles Published Daily</p>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     HOW IT WORKS
═══════════════════════════════════════════════ --}}
<section class="py-20 px-6 md:px-10 lg:px-16 bg-white">
    <div class="container mx-auto max-w-6xl">

        <div class="text-center mb-16" data-animate>
            <span class="inline-block text-brand-600 text-xs font-bold tracking-widest uppercase mb-3">Simple process</span>
            <h2 class="font-display text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">How It Works</h2>
            <p class="text-gray-500 text-lg max-w-xl mx-auto">Three simple steps to start turning your reading habit into real income.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            {{-- Connector line (desktop only) --}}
            <div class="hidden md:block absolute top-12 left-[calc(16.67%+2rem)] right-[calc(16.67%+2rem)] h-0.5 bg-gradient-to-r from-brand-200 via-brand-400 to-brand-200 z-0"></div>

            {{-- Step 1 --}}
            <div class="relative z-10 flex flex-col items-center text-center group" data-animate class="delay-1">
                <div class="w-24 h-24 rounded-2xl bg-brand-50 border-2 border-brand-100 group-hover:border-brand-400 group-hover:bg-brand-100/70 flex items-center justify-center mb-6 transition-all duration-300 shadow-sm group-hover:shadow-brand-200/50 group-hover:shadow-lg">
                    <svg class="h-10 w-10 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>
                <div class="w-7 h-7 rounded-full bg-brand-600 text-white text-xs font-bold flex items-center justify-center mb-4 shadow-md shadow-brand-600/30">1</div>
                <h3 class="font-display text-xl font-bold text-gray-900 mb-3">Sign Up Free</h3>
                <p class="text-gray-500 leading-relaxed text-sm">Create your free account in under 60 seconds. No credit card needed. Available in 150+ countries worldwide.</p>
            </div>

            {{-- Step 2 --}}
            <div class="relative z-10 flex flex-col items-center text-center group" data-animate style="transition-delay:0.15s">
                <div class="w-24 h-24 rounded-2xl bg-purple-50 border-2 border-purple-100 group-hover:border-purple-400 group-hover:bg-purple-100/70 flex items-center justify-center mb-6 transition-all duration-300 shadow-sm group-hover:shadow-purple-200/50 group-hover:shadow-lg">
                    <svg class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="w-7 h-7 rounded-full bg-purple-600 text-white text-xs font-bold flex items-center justify-center mb-4 shadow-md shadow-purple-600/30">2</div>
                <h3 class="font-display text-xl font-bold text-gray-900 mb-3">Read Articles</h3>
                <p class="text-gray-500 leading-relaxed text-sm">Browse articles on topics you love. Read through 3–5 pages and generate a code at the end to confirm you've completed the article.</p>
            </div>

            {{-- Step 3 --}}
            <div class="relative z-10 flex flex-col items-center text-center group" data-animate style="transition-delay:0.3s">
                <div class="w-24 h-24 rounded-2xl bg-amber-50 border-2 border-amber-100 group-hover:border-amber-400 group-hover:bg-amber-100/70 flex items-center justify-center mb-6 transition-all duration-300 shadow-sm group-hover:shadow-amber-200/50 group-hover:shadow-lg">
                    <svg class="h-10 w-10 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="w-7 h-7 rounded-full bg-amber-500 text-white text-xs font-bold flex items-center justify-center mb-4 shadow-md shadow-amber-500/30">3</div>
                <h3 class="font-display text-xl font-bold text-gray-900 mb-3">Withdraw Cash</h3>
                <p class="text-gray-500 leading-relaxed text-sm">Paste the code to earn points. Redeem points for cash via PayPal, bank transfer, or crypto. No limit on reads!</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     OUR STORY
═══════════════════════════════════════════════ --}}
<section class="py-20 px-6 md:px-10 lg:px-16 bg-stone-50 relative overflow-hidden">
    <div class="absolute right-0 top-0 w-72 h-72 bg-brand-100 rounded-full blur-3xl opacity-60 pointer-events-none -translate-y-1/2 translate-x-1/3"></div>

    <div class="container mx-auto max-w-6xl relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-14">

            {{-- Visual block --}}
            <div class="md:w-2/5" data-animate>
                <div class="bg-[#0b1215] rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                    <div class="absolute inset-0 dot-pattern opacity-20"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-brand-500/20 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-brand-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                            </svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-white mb-3">Built for Everyone</h3>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">We remove the barriers — high data costs, lack of incentives, limited access — and make reading rewarding for everyone.</p>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                                <p class="text-brand-400 font-bold text-lg">PayPal</p>
                                <p class="text-gray-500 text-xs">Instant transfer</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                                <p class="text-brand-400 font-bold text-lg">Crypto</p>
                                <p class="text-gray-500 text-xs">USDT / BTC</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                                <p class="text-brand-400 font-bold text-lg">Bank</p>
                                <p class="text-gray-500 text-xs">Wire transfer</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                                <p class="text-brand-400 font-bold text-lg">Gift Cards</p>
                                <p class="text-gray-500 text-xs">150+ brands</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Text --}}
            <div class="md:w-3/5" data-animate style="transition-delay:0.2s">
                <span class="inline-block text-brand-600 text-xs font-bold tracking-widest uppercase mb-3">Our mission</span>
                <h2 class="font-display text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">Our Story</h2>
                <p class="text-gray-600 leading-relaxed mb-5 text-lg">
                    We are passionate about reading and learning, and we believe that access to information is a key driver of personal and economic development. This belief inspired us to create a platform that encourages more people around the world to read regularly.
                </p>
                <p class="text-gray-500 leading-relaxed mb-8">
                    In many communities, reading is not yet a daily habit — often because of limited access, high data costs, or a lack of incentives. Our mission is to promote a culture of reading globally by combining education with real financial rewards. By allowing users to earn points and redeem them for cash, gift cards, or crypto as they read, we make learning more accessible, engaging, and sustainable for everyone.
                </p>
                <div class="flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 bg-brand-50 border border-brand-200 rounded-full px-4 py-2">
                        <div class="w-2 h-2 rounded-full bg-brand-500"></div>
                        <span class="text-brand-700 text-sm font-semibold">Instant Payouts</span>
                    </div>
                    <div class="flex items-center gap-2 bg-amber-50 border border-amber-200 rounded-full px-4 py-2">
                        <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                        <span class="text-amber-700 text-sm font-semibold">Free to Join</span>
                    </div>
                    <div class="flex items-center gap-2 bg-blue-50 border border-blue-200 rounded-full px-4 py-2">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                        <span class="text-blue-700 text-sm font-semibold">Mobile-First</span>
                    </div>
                    <div class="flex items-center gap-2 bg-purple-50 border border-purple-200 rounded-full px-4 py-2">
                        <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                        <span class="text-purple-700 text-sm font-semibold">No Limits</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     TESTIMONIALS / REVIEWS
═══════════════════════════════════════════════ --}}
<section class="py-20 px-6 md:px-10 lg:px-16 bg-white">
    <div class="container mx-auto max-w-6xl">

        <div class="text-center mb-14" data-animate>
            <span class="inline-block text-brand-600 text-xs font-bold tracking-widest uppercase mb-3">Real earners</span>
            <h2 class="font-display text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">What Our Readers Say</h2>
            <p class="text-gray-500 text-lg">Verified reviews from our global community of readers.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 max-w-4xl mx-auto">

            {{-- Review 1 --}}
            <div class="review-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6 transition-all duration-300 hover:shadow-xl" data-animate>
                <div class="flex text-amber-400 mb-4 gap-0.5">
                    @for($i=0;$i<5;$i++)
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-600 mb-5 leading-relaxed text-sm">"I use the platform every day on my commute. The articles are short and informative, and the points I earn help me get mobile data without spending extra money."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-brand-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">AB</div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Aisha B.</p>
                        <p class="text-gray-400 text-xs">London, UK</p>
                    </div>
                    <span class="ml-auto text-brand-600 bg-brand-50 text-xs font-semibold px-3 py-1 rounded-full border border-brand-100">Verified</span>
                </div>
            </div>

            {{-- Review 2 --}}
            <div class="review-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6 transition-all duration-300 hover:shadow-xl" data-animate style="transition-delay:0.1s">
                <div class="flex text-amber-400 mb-4 gap-0.5">
                    @for($i=0;$i<5;$i++)
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-600 mb-5 leading-relaxed text-sm">"The topics are relevant and easy to understand. Earning points for reading makes it easier for me to stay consistent with my daily reading habit."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">TM</div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Thomas M.</p>
                        <p class="text-gray-400 text-xs">Toronto, Canada</p>
                    </div>
                    <span class="ml-auto text-brand-600 bg-brand-50 text-xs font-semibold px-3 py-1 rounded-full border border-brand-100">Verified</span>
                </div>
            </div>

            {{-- Review 3 --}}
            <div class="review-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6 transition-all duration-300 hover:shadow-xl" data-animate style="transition-delay:0.2s">
                <div class="flex text-amber-400 mb-4 gap-0.5">
                    @for($i=0;$i<5;$i++)
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-600 mb-5 leading-relaxed text-sm">"The platform encourages me to read more often. I enjoy the variety of articles, and redeeming points for data is very convenient and fast."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">JT</div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">James T.</p>
                        <p class="text-gray-400 text-xs">New York, USA</p>
                    </div>
                    <span class="ml-auto text-brand-600 bg-brand-50 text-xs font-semibold px-3 py-1 rounded-full border border-brand-100">Verified</span>
                </div>
            </div>

            {{-- Review 4 --}}
            <div class="review-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6 transition-all duration-300 hover:shadow-xl" data-animate style="transition-delay:0.3s">
                <div class="flex text-amber-400 mb-4 gap-0.5">
                    @for($i=0;$i<5;$i++)
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-600 mb-5 leading-relaxed text-sm">"It has become part of my daily routine. Reading, learning, and earning data at the same time is a great combination I didn't expect."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-pink-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">WN</div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Wendy N.</p>
                        <p class="text-gray-400 text-xs">Sydney, Australia</p>
                    </div>
                    <span class="ml-auto text-brand-600 bg-brand-50 text-xs font-semibold px-3 py-1 rounded-full border border-brand-100">Verified</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     FAQ SECTION
═══════════════════════════════════════════════ --}}
<section class="py-20 px-6 md:px-10 lg:px-16 bg-gray-50">
    <div class="container mx-auto max-w-3xl">

        <div class="text-center mb-14" data-animate>
            <span class="inline-block text-brand-600 text-xs font-bold tracking-widest uppercase mb-3">Got questions?</span>
            <h2 class="font-display text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">Frequently Asked Questions</h2>
            <p class="text-gray-500">Everything you need to know before getting started.</p>
        </div>

        <div class="space-y-4">

            <div class="faq-item bg-white rounded-2xl shadow-sm p-6 border border-gray-100" data-animate>
                <h3 class="font-display text-lg font-bold text-gray-900 mb-2 flex items-start gap-3">
                    <span class="w-6 h-6 bg-brand-100 text-brand-700 rounded-full text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">Q</span>
                    How much cash can I earn?
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm pl-9">Your earnings are based on the points you accumulate. The more points you earn, the higher your potential rewards. You can gain more points by reading articles and inviting others — you receive 100 bonus points for every referral who makes a withdrawal.</p>
            </div>

            <div class="faq-item bg-white rounded-2xl shadow-sm p-6 border border-gray-100" data-animate style="transition-delay:0.1s">
                <h3 class="font-display text-lg font-bold text-gray-900 mb-2 flex items-start gap-3">
                    <span class="w-6 h-6 bg-brand-100 text-brand-700 rounded-full text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">Q</span>
                    How do I convert points to cash?
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm pl-9">Once you're logged in and have enough points, click on the "Redeem" link. You can withdraw via PayPal, bank transfer, crypto (USDT/BTC), or redeem for gift cards. We support payouts in 50+ countries.</p>
            </div>

            <div class="faq-item bg-white rounded-2xl shadow-sm p-6 border border-gray-100" data-animate style="transition-delay:0.15s">
                <h3 class="font-display text-lg font-bold text-gray-900 mb-2 flex items-start gap-3">
                    <span class="w-6 h-6 bg-brand-100 text-brand-700 rounded-full text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">Q</span>
                    How long does it take to receive my rewards?
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm pl-9">Internet bundles and airtime are delivered instantly. Cash payments are processed within 24–48 hours after your redemption request is submitted.</p>
            </div>

            <div class="faq-item bg-white rounded-2xl shadow-sm p-6 border border-gray-100" data-animate style="transition-delay:0.2s">
                <h3 class="font-display text-lg font-bold text-gray-900 mb-2 flex items-start gap-3">
                    <span class="w-6 h-6 bg-brand-100 text-brand-700 rounded-full text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">Q</span>
                    How do I start earning?
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm pl-9">Sign up for a free account, browse our library of articles, and start reading. Generate a verification code at the end of each article to confirm completion and earn your points — redeemable for real cash.</p>
            </div>

            <div class="faq-item bg-white rounded-2xl shadow-sm p-6 border border-gray-100" data-animate style="transition-delay:0.25s">
                <h3 class="font-display text-lg font-bold text-gray-900 mb-2 flex items-start gap-3">
                    <span class="w-6 h-6 bg-brand-100 text-brand-700 rounded-full text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">Q</span>
                    Who can join?
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm pl-9">Anyone with an internet connection and a desire to read! PaidReader.app is available in 150+ countries. If you can access the internet, you can start earning.</p>
            </div>

            <div class="faq-item bg-white rounded-2xl shadow-sm p-6 border border-gray-100" data-animate style="transition-delay:0.3s">
                <h3 class="font-display text-lg font-bold text-gray-900 mb-2 flex items-start gap-3">
                    <span class="w-6 h-6 bg-brand-100 text-brand-700 rounded-full text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">Q</span>
                    What payment methods are supported?
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm pl-9">We support PayPal, direct bank transfers (SWIFT/ACH/SEPA), cryptocurrency (USDT, BTC, ETH), and gift cards from 150+ brands including Amazon, Google Play, and iTunes.</p>
            </div>

            <div class="faq-item bg-white rounded-2xl shadow-sm p-6 border border-gray-100" data-animate style="transition-delay:0.35s">
                <h3 class="font-display text-lg font-bold text-gray-900 mb-2 flex items-start gap-3">
                    <span class="w-6 h-6 bg-brand-100 text-brand-700 rounded-full text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">Q</span>
                    What data bundles are available?
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm pl-9">We offer 500MB, 1GB, 2GB, 5GB, 10GB, and 50GB bundles. Your accumulated points determine which bundles you can redeem.</p>
            </div>

        </div>
    </div>
</section>

<script>
    // Scroll animations
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('[data-animate]');
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('in-view');
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.08 });
        items.forEach(el => obs.observe(el));
    });
</script>

@endsection