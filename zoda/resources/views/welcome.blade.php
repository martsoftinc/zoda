
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>koda.africa | Read sponsored articles. Earn rewards.</title>
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
</head>
<body class="antialiased">

  <!-- Header -->
  <header class="sticky top-0 z-50 w-full bg-white border-b border-gray-100">
    <div class="flex items-center justify-between py-3.5 px-6 md:py-5 md:px-20 max-w-screen-xl mx-auto">
      <a href="#" class="flex items-center gap-2 shrink-0" aria-label="koda.africa home">
        <span class="flex h-9 items-center rounded-full bg-[#231F20] px-4 text-white text-lg font-extrabold tracking-tight">koda.africa</span>
      </a>
      <nav class="hidden lg:flex items-center gap-6">
        <a href="#how" class="px-4 py-2 text-sm font-semibold hover:text-gray-500">How it works</a>
        <a href="#rewards" class="px-4 py-2 text-sm font-semibold hover:text-gray-500">For You</a>
        <a href="#brands" class="px-4 py-2 text-sm font-semibold hover:text-gray-500">For Brands</a>
        <a href="#faq" class="px-4 py-2 text-sm font-semibold hover:text-gray-500">FAQs</a>
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
            <li><a href="#">About us</a></li><li><a href="#">Contact</a></li></ul></div>
        </div>
      </div>
      <a href="/login" class="btn-blue block w-full text-center font-semibold py-3 rounded-full mt-8">Log in / Sign up</a>
    </div>
  </div>

  <!-- Hero -->
  <section class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 pt-5 md:pt-16">
      <h1 class="text-center mt-5 max-w-4xl mx-auto font-extrabold text-[2.25rem] sm:text-[2.625rem] md:text-[5rem] leading-[1.1] animate-on-scroll d1">
        Read brand stories. Earn real rewards.
      </h1>
      <p class="text-center text-lg md:text-xl max-w-2xl mx-auto mt-6 text-[#3c3c43] animate-on-scroll d1">Read stories from brands you like. Every article you finish earns you real rewards.</p>
      <div class="mt-10 flex flex-col md:flex-row items-center justify-center gap-4 animate-on-scroll d2">
        <a href="/login" class="w-full max-w-[340px] md:w-auto">
          <span class="btn-blue w-full md:w-auto font-semibold text-base px-8 py-4 rounded-full flex items-center justify-center gap-2 transition-colors group">
            Start earning
            <svg class="w-5 h-5 wiggle" viewBox="0 0 25 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m0 0-7-7m7 7-7 7"/></svg>
          </span>
        </a>
        <a href="#how" class="w-full max-w-[340px] md:w-auto border border-gray-400 text-[#3c3c43] font-semibold text-base px-8 py-4 rounded-full flex items-center justify-center hover:bg-gray-50 transition-colors">See how it works</a>
      </div>
    </div>
  </section>

  <!-- Promo card 
  <section class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 mt-20 md:mt-40">
      <div class="rounded-[20px] md:h-[400px] relative overflow-hidden animate-on-scroll" style="background: radial-gradient(circle at 75% 50%, rgba(255,228,94,0.6) 0%, #ffe45e 56%);">
        <div class="w-full h-full flex flex-col md:flex-row items-center px-8 md:px-10 xl:px-24 py-10 md:py-0 gap-8">
          <div class="flex-1">
            <div class="text-3xl md:text-4xl font-extrabold max-w-lg">You're already reading. Now it pays.</div>
            <div class="text-lg max-w-lg mt-2">Pick the brands you like and earn every time you finish one of their articles.</div>
            <a href="#" class="btn-blue mt-5 w-fit font-semibold px-6 py-3 rounded-full flex items-center gap-2 transition-colors group">Browse articles
              <svg class="w-5 h-5 wiggle" viewBox="0 0 25 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m0 0-7-7m7 7-7 7"/></svg></a>
          </div>
          <div class="phone shrink-0 md:translate-y-10" aria-hidden="true"><div>
            <div class="text-[11px] font-semibold text-gray-500">Your balance</div>
            <div class="text-2xl font-extrabold -mt-1">2,450 pts</div>
            <div class="offer bg-[#e8f0ff]">Saving smart <b>+50</b></div>
            <div class="offer bg-[#fff3c4]">Startup stories <b>+120</b></div>
            <div class="offer bg-[#e4f7ea]">Travel guide <b>+300</b></div>
            <div class="offer bg-[#fde8e8]">Tech review <b>+200</b></div>
          </div></div>
        </div>
      </div>
    </div>
  </section>-->


  <!-- Attention section -->
  <section id="attention" class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 mt-20 md:mt-40">
      <div class="rounded-[20px] bg-[#1a1a1a] text-white px-6 py-12 md:px-16 md:py-20 animate-on-scroll">
        <h2 class="text-3xl md:text-5xl font-extrabold max-w-3xl leading-tight">Your Attention Is Valuable. Stop Giving It Away for Free.</h2>
        <p class="text-lg md:text-xl text-gray-300 mt-6 max-w-2xl">Every day, brands spend millions of dollars on Facebook, TikTok, YouTube, Instagram and other platforms to get your attention.</p>

        <div class="mt-12 grid md:grid-cols-2 gap-10 md:gap-16 items-start">
          <div>
            <p class="text-xl md:text-2xl font-semibold text-gray-300">But what do you get?</p>
            <p class="text-6xl md:text-8xl font-extrabold mt-2 text-[#ffe45e]">Nothing.</p>
          </div>
          <p class="text-lg text-gray-300 max-w-md">You spend your time watching videos, reading posts and scrolling through your feed. You even spend money on internet data just to consume the content.</p>
        </div>

        <div class="mt-14 pt-12 border-t border-white/15">
          <p class="text-2xl md:text-3xl font-bold">Koda changes that.</p>
          <p class="text-lg text-gray-300 mt-4 max-w-2xl">On Koda.africa, brands pay to get the attention of real people like you. They create sponsored articles and campaigns, and you choose the ones you're interested in.</p>
          <p class="text-2xl md:text-3xl font-extrabold text-[#ffe45e] mt-8">Read. Discover. Earn rewards.</p>
          <p class="text-lg text-gray-300 mt-4 max-w-2xl">Instead of giving your attention away for free, get rewarded for it.</p>
          <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6">
            <a href="#" class="btn-blue w-fit font-semibold px-8 py-4 rounded-full transition-colors">Join Koda for free today</a>
            <p class="font-semibold">Your attention has value. Start earning from it.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How it works -->
  <section id="how" class="flex justify-center">
    <div class="max-w-screen-xl w-full mx-auto mt-24 md:mt-48 flex flex-col items-center gap-10 px-4 md:px-20 lg:px-32">
      <div class="flex w-full flex-col items-start gap-4 animate-on-scroll">
        <h2 class="text-3xl md:text-5xl font-bold">Good reading should pay you back.</h2>
        <p class="text-lg">Start earning rewards in three simple steps.</p>
      </div>
      <div class="grid w-full grid-cols-1 md:grid-cols-3 gap-5">
        <article class="flex flex-col gap-5 animate-on-scroll d1">
          <div class="relative h-[300px] w-full overflow-hidden rounded-[20px] bg-white">
            <div class="absolute left-3 top-3 flex size-10 items-center justify-center rounded-full bg-[#fef9e8] text-lg font-semibold">1</div>
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-wrap gap-2 justify-center w-[220px]" aria-hidden="true">
              <span class="yellow rounded-full px-3 py-1.5 text-sm font-semibold">Fashion</span><span class="bg-[#e8f0ff] rounded-full px-3 py-1.5 text-sm font-semibold">Tech</span>
              <span class="bg-[#e4f7ea] rounded-full px-3 py-1.5 text-sm font-semibold">Food</span><span class="bg-[#fde8e8] rounded-full px-3 py-1.5 text-sm font-semibold">Travel</span>
              <span class="yellow rounded-full px-3 py-1.5 text-sm font-semibold">Fitness</span>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-bold">Create your free account</h3>
            <p class="text-lg mt-2">It only takes 2 minutes to create an account.</p>
          </div>
        </article>
        <article class="flex flex-col gap-5 animate-on-scroll d2">
          <div class="relative h-[300px] w-full overflow-hidden rounded-[20px] bg-white">
            <div class="absolute left-3 top-3 flex size-10 items-center justify-center rounded-full bg-[#fef9e8] text-lg font-semibold">2</div>
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[220px] flex flex-col gap-3" aria-hidden="true">
              <div class="offer bg-[#e8f0ff]">Money tips <b>+50</b></div>
              <div class="offer bg-[#fff3c4]">Food story <b>+120</b></div>
              <div class="offer bg-[#e4f7ea]">Phone guide <b>+300</b></div>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-bold">Read sponsored articles</h3>
            <p class="text-lg mt-2">Choose an article that interests you.Read through the pages. You’ll usually need to read 3–5 pages.</p>
          </div>
        </article>
        <article class="flex flex-col gap-5 animate-on-scroll d3">
          <div class="relative h-[300px] w-full overflow-hidden rounded-[20px] bg-white">
            <div class="absolute left-3 top-3 flex size-10 items-center justify-center rounded-full bg-[#fef9e8] text-lg font-semibold">3</div>
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 yellow rounded-2xl w-[200px] h-[130px] flex flex-col items-center justify-center" aria-hidden="true">
              <div class="text-sm font-semibold">Reward unlocked</div><div class="text-3xl font-extrabold">Mobile money</div>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-bold">Submit the code and get rewarded</h3>
            <p class="text-lg mt-2">Generate your verification code and submit it to earn your reward..</p>
          </div>
        </article>
      </div>
      <a href="#" class="btn-blue font-semibold px-8 py-4 rounded-full flex items-center gap-2 transition-colors group animate-on-scroll d2">Start earning
        <svg class="w-5 h-5 wiggle" viewBox="0 0 25 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m0 0-7-7m7 7-7 7"/></svg></a>
    </div>
  </section>

  <!-- Stats -->
  <section class="flex justify-center">
    <div class="w-full max-w-screen-xl mt-24 md:mt-48 px-4 xl:px-32">
      <h2 class="text-4xl md:text-6xl text-center animate-on-scroll">Join readers getting rewarded across Africa</h2>
      <div class="flex flex-col md:flex-row justify-center items-center gap-8 md:gap-16 my-12 md:my-16">
        <div class="text-center animate-on-scroll d1"><div class="text-5xl font-extrabold">500k+</div><div class="text-xl">Active Members</div></div>
        <div class="text-center animate-on-scroll d2"><div class="text-5xl font-extrabold">800+</div><div class="text-xl">Brands on board</div></div>
        <div class="text-center animate-on-scroll d3"><div class="text-5xl font-extrabold">4.8★</div><div class="text-xl">Average rating</div></div>
      </div>
      <div class="text-center animate-on-scroll">
        <a href="/login" class="btn-blue inline-block font-semibold px-8 py-4 rounded-full transition-colors">Start earning</a>
      </div>
    </div>
  </section>

  <!-- Two feature blocks -->
  <section class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 mt-24 md:mt-48">
      <div id="rewards" class="flex flex-col lg:flex-row gap-10 lg:gap-20">
        <div class="flex flex-col justify-center text-center lg:text-left w-full lg:w-[420px] xl:w-[580px]">
          <div class="yellow rounded-full mx-auto lg:mx-0 px-4 py-3 w-fit text-lg font-semibold animate-on-scroll">For You</div>
          <h2 class="text-4xl md:text-6xl mt-5 animate-on-scroll d1">Rewards you actually want</h2>
          <p class="text-lg mt-4 animate-on-scroll d2">Follow the brands and topics you love, and earn real money.</p>
          <div class="mt-10 animate-on-scroll d3">
            <a href="/login" class="border border-gray-500 text-[#3c3c43] font-semibold px-8 py-4 rounded-full hover:bg-gray-50 transition-colors inline-flex items-center gap-2">See how rewards work
              <svg class="w-4 h-4" viewBox="0 0 25 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m0 0-7-7m7 7-7 7"/></svg></a>
          </div>
        </div>
        <div class="flex-1 rounded-[20px] overflow-hidden animate-on-scroll flex justify-center pt-10 min-h-[380px]" style="background: radial-gradient(circle at 0% 100%, #FFFD9F 0%, #ffe45e 56%);" aria-hidden="true">
          <div class="phone !h-[440px]"><div>
            <div class="text-[11px] font-semibold text-gray-500">Redeem</div>
            <div class="offer bg-[#e8f0ff]">Mobile Money</div>
            <div class="offer bg-[#e4f7ea]">Bank transfer</div>
            <div class="offer bg-[#fff3c4]">Mpesa</div>
            
          </div></div>
        </div>
      </div>

      <div id="brands" class="flex flex-col lg:flex-row gap-10 lg:gap-20 mt-24 md:mt-48">
        <div class="order-1 lg:order-2 flex flex-col justify-center text-center lg:text-left w-full lg:w-[420px] xl:w-[580px]">
          <div class="yellow rounded-full mx-auto lg:mx-0 px-4 py-3 w-fit text-lg font-semibold animate-on-scroll">For Brands</div>
          <h2 class="text-4xl md:text-6xl mt-5 animate-on-scroll d1">Get your story read by people who chose to read it</h2>
          <p class="text-lg mt-4 animate-on-scroll d2">Publish sponsored articles and pay for real reading time, not empty page views.</p>
          <div class="mt-10 animate-on-scroll d3">
            <a href="https://ads.koda.africa/" class="border border-gray-500 text-[#3c3c43] font-semibold px-8 py-4 rounded-full hover:bg-gray-50 transition-colors inline-flex items-center gap-2">Partner with us
              <svg class="w-4 h-4" viewBox="0 0 25 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m0 0-7-7m7 7-7 7"/></svg></a>
          </div>
        </div>
        <div class="order-2 lg:order-1 flex-1 rounded-[20px] overflow-hidden animate-on-scroll flex items-center justify-center min-h-[380px]" style="background: radial-gradient(circle at 100% 0%, rgba(255,228,94,0.5) 0%, #ffe45e 56%);" aria-hidden="true">
          <div class="bg-white rounded-2xl p-6 w-[280px] shadow-lg">
            <div class="text-sm font-semibold text-gray-500">Article results</div>
            <div class="text-4xl font-extrabold mt-1">86%</div><div class="text-sm">read to the end</div>
            <div class="mt-4 h-2 rounded-full bg-gray-100"><div class="h-2 rounded-full btn-blue" style="width:86%"></div></div>
            <div class="mt-4 text-sm font-semibold">12,400 readers</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Big CTA -->
  <div class="pt-24">
    <div class="flex flex-col md:flex-row w-full px-4 md:px-20 lg:px-32 py-16 gap-10 animate-on-scroll" style="background: radial-gradient(circle at 65% 50%, rgba(255,228,94,0.6) 0%, #ffe45e 56%);">
      <div class="flex-1 flex flex-col justify-center">
        <h2 class="text-4xl md:text-6xl lg:text-7xl font-extrabold max-w-lg text-center md:text-left mx-auto md:mx-0">Read more.<br>Earn more.</h2>
        <div class="mt-12 text-center md:text-left">
          <a href="/login" class="btn-blue inline-block font-semibold px-8 py-4 rounded-full transition-colors">Join koda.africa</a>
        </div>
      </div>
      <div class="flex-1 flex justify-center items-center" aria-hidden="true">
        <div class="phone"><div>
          <div class="text-[11px] font-semibold text-gray-500">Today</div>
          <div class="text-2xl font-extrabold -mt-1">₦15,000 </div>
          <div class="offer bg-[#e8f0ff]">GHS 300</div>
          <div class="offer bg-[#fff3c4]">R 300</div>
          <div class="offer bg-[#e4f7ea]">KSh 800</div>
        </div></div>
      </div>
    </div>
  </div>

  <!-- FAQ -->
  <section id="faq" class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 my-24 md:my-32">
      <h2 class="text-4xl md:text-6xl mb-6 animate-on-scroll">FAQs</h2>
      <div class="divide-y divide-gray-200">
        <details class="group py-4 md:py-6">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4"><h3 class="text-lg font-semibold">What is koda.africa and how does it work?</h3><span class="text-2xl group-open:rotate-45 transition-transform">+</span></summary>
          <p class="mt-4 leading-relaxed text-gray-700">koda.africa connects you with brands that publish sponsored articles. You pick the stories that interest you, read them, and earn rewards for each one you finish.</p>
        </details>
        <details class="group py-4 md:py-6">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4"><h3 class="text-lg font-semibold">How do I earn rewards?</h3><span class="text-2xl group-open:rotate-45 transition-transform">+</span></summary>
          <p class="mt-4 leading-relaxed text-gray-700">Every article you read adds to your balance. Once you reach the minimum payout threshold, you can request your payout.</p>
        </details>
        <details class="group py-4 md:py-6">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4"><h3 class="text-lg font-semibold">How will I pe paid?</h3><span class="text-2xl group-open:rotate-45 transition-transform">+</span></summary>
          <p class="mt-4 leading-relaxed text-gray-700">We pay through mobile money in Ghana and Kenya, and bank transfers in Nigeria and South Africa.</p>
        </details>
        <details class="group py-4 md:py-6">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4"><h3 class="text-lg font-semibold">When will I get paid?</h3><span class="text-2xl group-open:rotate-45 transition-transform">+</span></summary>
          <p class="mt-4 leading-relaxed text-gray-700">Koda.africa processes payments three times a month: on the 1st, 15th, and 25th. You can request a payout at any time, but your payment will be processed on the next scheduled payment date.</p>
        </details>
        <details class="group py-4 md:py-6">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4"><h3 class="text-lg font-semibold">How can my brand work with koda.africa?</h3><span class="text-2xl group-open:rotate-45 transition-transform">+</span></summary>
          <p class="mt-4 leading-relaxed text-gray-700">Publish a sponsored article, choose who should read it, and set the reward readers earn. You pay for the reading you receive.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-[#1a1a1a] text-white">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20 xl:px-32 py-16 xl:py-24">
      <div class="flex flex-col md:flex-row gap-10 md:gap-5">
        <div class="md:flex-1"><h3 class="text-lg font-semibold mb-5">For You</h3>
          <ul class="flex flex-col gap-4"><li><a href="#how" class="hover:text-gray-400">How it works</a></li><li><a href="#rewards" class="hover:text-gray-400">Ways to earn</a></li><li><a href="#faq" class="hover:text-gray-400">FAQs</a></li></ul></div>
        <div class="md:flex-1"><h3 class="text-lg font-semibold mb-5">For Brands</h3>
          <ul class="flex flex-col gap-4"><li><a href="#brands" class="hover:text-gray-400">Publish an article</a></li><li><a href="#brands" class="hover:text-gray-400">Sponsored articles</a></li></ul></div>
        <div class="md:flex-1"><h3 class="text-lg font-semibold mb-5">Company</h3>
          <ul class="flex flex-col gap-4"><li><a href="/about" class="hover:text-gray-400">About us</a></li><li><a href="/contact" class="hover:text-gray-400">Contact</a></li></ul></div>
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
</body>
</html>
