<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>@yield('title', 'Make Money Online in Nigeria, Kenya, Ghana & South Africa | koda.africa')</title>
  <meta name="keywords" content="make money online, earn online nigeria, earn money kenya, read articles for cash ghana, online rewards south africa, koda africa">
  <meta name="author" content="koda.africa">
  <meta name="geo.region" content="NG;KE;GH;ZA">
  <meta name="target" content="Nigeria, Kenya, Ghana, South Africa">
  <link rel="canonical" href="@yield('canonical', url()->current())">
  <!-- Open Graph / Facebook / WhatsApp Sharing -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'Make Money Online in Nigeria, Kenya, Ghana & South Africa | koda.africa')">
    <meta property="og:description" content="@yield('og_description', 'Read sponsored articles and earn real cash rewards across Africa. Join koda.africa today.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-share-image.jpg'))">
    <meta property="og:site_name" content="koda.africa">

    <!-- Twitter Card Data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Make Money Online in Nigeria, Kenya, Ghana & South Africa')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Earn rewards reading sponsored articles on koda.africa.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-share-image.jpg'))">

    <!-- Structured Data / JSON-LD Schema (Google Rich Results) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "koda.africa",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/logo.png') }}",
      "description": "Read sponsored articles and earn rewards online in Nigeria, Kenya, Ghana, and South Africa.",
      "areaServed": ["Nigeria", "Kenya", "Ghana", "South Africa"]
    }
    </script>

    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">



  <meta name="description" content="@yield('meta_description', 'Make money online in Nigeria, Kenya, Ghana, and South Africa. Read sponsored articles, complete tasks, and earn rewards instantly on koda.africa.')">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', system-ui, sans-serif; background:#fef9e8; color:#1a1a1a; }
    .btn-blue { background:#1f6ff8; color:#fff; } .btn-blue:hover { background:#1a5fd0; }
    .yellow { background:#ffe45e; }
    .animate-on-scroll { opacity:0; transform:translateY(24px); transition:opacity .7s ease-out, transform .7s ease-out; }
    .animate-on-scroll.visible { opacity:1; transform:none; }
    .d1{transition-delay:.1s}.d2{transition-delay:.2s}.d3{transition-delay:.3s}
    .group:hover .wiggle { animation: wiggle .3s ease-in-out; }
    @keyframes wiggle { 0%,100%{transform:translateX(0)} 50%{transform:translateX(4px)} }
    .mobile-menu { transform:translateX(100%); transition:transform .3s ease-in-out; }
    .mobile-menu.open { transform:none; }
    .overlay { opacity:0; pointer-events:none; transition:opacity .3s; }
    .overlay.open { opacity:1; pointer-events:auto; }
    .acc { max-height:0; overflow:hidden; transition:max-height .3s ease-in-out; }
    .acc.open { max-height:600px; }
    details summary::-webkit-details-marker { display:none; }
    .phone { width:200px; height:400px; background:#1a1a1a; border-radius:32px; padding:10px; box-shadow:0 20px 40px rgba(0,0,0,.18); }
    .phone > div { background:#fff; border-radius:24px; height:100%; padding:14px 12px; display:flex; flex-direction:column; gap:10px; overflow:hidden; }
    .offer { border-radius:14px; padding:10px 12px; font-size:12px; font-weight:600; display:flex; justify-content:space-between; align-items:center; }
    .offer b { font-size:13px; }
    :root { padding-top: env(safe-area-inset-top,0px); padding-bottom: env(safe-area-inset-bottom,0px); }
    @media (prefers-reduced-motion: reduce){ *{animation:none!important; transition:none!important;} .animate-on-scroll{opacity:1;transform:none;} }
  </style>
  @stack('styles')
</head>
<body class="antialiased">

  <!-- Header -->
  <header class="sticky top-0 z-50 w-full bg-white border-b border-gray-100">
    <div class="flex items-center justify-between py-3.5 px-6 md:py-5 md:px-20 max-w-screen-xl mx-auto">
      <a href="/" class="flex items-center gap-2 shrink-0" aria-label="koda.africa home">
        <span class="flex h-9 items-center rounded-full bg-[#231F20] px-4 text-white text-lg font-extrabold tracking-tight">koda.africa</span>
      </a>
      <nav class="hidden lg:flex items-center gap-6">
        <a href="/#how" class="px-4 py-2 text-sm font-semibold hover:text-gray-500">How it works</a>
        <a href="/#rewards" class="px-4 py-2 text-sm font-semibold hover:text-gray-500">For You</a>
        <a href="#brands" class="px-4 py-2 text-sm font-semibold hover:text-gray-500">For Brands</a>
        <a href="/#faq" class="px-4 py-2 text-sm font-semibold hover:text-gray-500">FAQs</a>
      </nav>
      <div class="flex items-center gap-2">
        <a href="/login" class="hidden sm:inline-flex btn-blue text-sm font-semibold px-4 py-2 rounded-full transition-colors">Log in / Sign up</a>
        <button id="menuBtn" class="lg:hidden p-2 rounded-full bg-[#1a1a1a] text-white" aria-label="Open menu">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
        </button>
      </div>
    </div>
  </header>

  <!-- Mobile menu -->
  <div id="overlay" class="overlay fixed inset-0 z-[60] bg-black/50 backdrop-blur-sm"></div>
  <div id="menu" class="mobile-menu fixed top-0 right-0 z-[70] h-full w-full max-w-[400px] bg-white shadow-2xl overflow-y-auto">
    <div class="flex flex-col p-6">
      <div class="flex items-center justify-between mb-8">
        <span class="flex h-9 items-center rounded-full bg-[#231F20] px-4 text-white text-lg font-extrabold">koda.africa</span>
        <button id="menuClose" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200" aria-label="Close menu">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>
      <div class="flex flex-col gap-2">
        <div class="border-b border-gray-200 pb-2">
          <button class="acc-trigger flex items-center justify-between w-full py-3 text-lg font-semibold" data-target="a1">For You
            <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
          <div id="a1" class="acc"><ul class="flex flex-col gap-4 pt-2 pb-4 pl-4 text-[#3c3c43]">
            <li><a href="#how">How it works</a></li><li><a href="#rewards">Ways to earn</a></li><li><a href="#faq">FAQs</a></li></ul></div>
        </div>
        <div class="border-b border-gray-200 pb-2">
          <button class="acc-trigger flex items-center justify-between w-full py-3 text-lg font-semibold" data-target="a2">For Brands
            <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
          <div id="a2" class="acc"><ul class="flex flex-col gap-4 pt-2 pb-4 pl-4 text-[#3c3c43]">
            <li><a href="#brands">Publish an article</a></li><li><a href="#brands">Sponsored articles</a></li></ul></div>
        </div>
        <div class="border-b border-gray-200 pb-2">
          <button class="acc-trigger flex items-center justify-between w-full py-3 text-lg font-semibold" data-target="a3">Company
            <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
          <div id="a3" class="acc"><ul class="flex flex-col gap-4 pt-2 pb-4 pl-4 text-[#3c3c43]">
            <li><a href="/contact">About us</a></li><li><a href="#">Contact</a></li></ul></div>
        </div>
      </div>
      <a href="/login" class="btn-blue block w-full text-center font-semibold py-3 rounded-full mt-8">Log in / Sign up</a>
    </div>
  </div>

  <!-- Main content -->
  @yield('content')

  <!-- Footer -->
  <footer class="bg-[#1a1a1a] text-white">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20 xl:px-32 py-16 xl:py-24">
      <div class="flex flex-col md:flex-row gap-10 md:gap-5">
        <div class="md:flex-1"><h3 class="text-lg font-semibold mb-5">For You</h3>
          <ul class="flex flex-col gap-4"><li><a href="#how" class="hover:text-gray-400">How it works</a></li><li><a href="#rewards" class="hover:text-gray-400">Ways to earn</a></li><li><a href="/#faq" class="hover:text-gray-400">FAQs</a></li></ul></div>
        <div class="md:flex-1"><h3 class="text-lg font-semibold mb-5">For Brands</h3>
          <ul class="flex flex-col gap-4"><li><a href="#brands" class="hover:text-gray-400">Publish an article</a></li><li><a href="#brands" class="hover:text-gray-400">Sponsored articles</a></li></ul></div>
        <div class="md:flex-1"><h3 class="text-lg font-semibold mb-5">Company</h3>
          <ul class="flex flex-col gap-4"><li><a href="#" class="hover:text-gray-400">About us</a></li><li><a href="#" class="hover:text-gray-400">Contact</a></li></ul></div>
        <div class="md:flex-1"><h3 class="text-lg font-semibold mb-5">Legal</h3>
          <ul class="flex flex-col gap-4"><li><a href="/terms" class="hover:text-gray-400">Terms of Service</a></li><li><a href="/privacy" class="hover:text-gray-400">Privacy</a></li></ul></div>
      </div>
      <p class="mt-12 text-sm text-gray-400">© 2026 koda.africa. All rights reserved.</p>
    </div>
  </footer>

  <script>
    const menu=document.getElementById('menu'), ov=document.getElementById('overlay');
    const open=()=>{menu.classList.add('open');ov.classList.add('open');document.body.style.overflow='hidden'};
    const close=()=>{menu.classList.remove('open');ov.classList.remove('open');document.body.style.overflow=''};
    document.getElementById('menuBtn').onclick=open;
    document.getElementById('menuClose').onclick=close; ov.onclick=close;
    menu.querySelectorAll('a').forEach(a=>a.addEventListener('click',close));
    document.querySelectorAll('.acc-trigger').forEach(t=>t.addEventListener('click',()=>{
      const c=document.getElementById(t.dataset.target), ar=t.querySelector('svg');
      document.querySelectorAll('.acc').forEach(e=>{if(e!==c)e.classList.remove('open')});
      document.querySelectorAll('.acc-trigger svg').forEach(s=>{if(s!==ar)s.style.transform=''});
      c.classList.toggle('open'); ar.style.transform=c.classList.contains('open')?'rotate(180deg)':'';
    }));
    const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible')}),{threshold:.1,rootMargin:'0px 0px -40px 0px'});
    document.querySelectorAll('.animate-on-scroll').forEach(el=>io.observe(el));
  </script>
  @stack('scripts')
</body>
</html>