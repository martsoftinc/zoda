@extends('layouts.frontlayout')
@section('content')

<section class="py-16 px-6 md:px-10 lg:px-16 bg-white">
  <div class="container mx-auto max-w-6xl">

    <header class="mb-12">
      <h1 class="text-4xl font-bold mb-2">Terms of Use</h1>
      <p class="text-gray-500">Effective Date: <time datetime="2025-08-21">August 21, 2025</time></p>
      <p class="mt-4 text-lg leading-relaxed">
        Welcome to <strong>Readify.Africa</strong> (“the Site,” “we,” “our,” or “us”).
        By accessing or using this website, you agree to comply with and be bound by these Terms of Use.
        If you do not agree, please do not use our services.
      </p>
    </header>

    <!-- TOC -->
    <nav class="bg-white shadow-sm rounded-lg p-5 mb-10">
      <h2 class="font-semibold text-lg">Contents</h2>
      <ol class="list-decimal list-inside mt-3 space-y-1 text-blue-600">
        <li><a href="#eligibility">Eligibility</a></li>
        <li><a href="#use-of-site">Use of the Site</a></li>
        <li><a href="#points-rewards">Points &amp; Rewards</a></li>
        <li><a href="#referral-program">Referral Program</a></li>
        <li><a href="#intellectual-property">Intellectual Property</a></li>
        <li><a href="#termination">Account Termination</a></li>
        <li><a href="#disclaimer">Disclaimer of Liability</a></li>
        <li><a href="#changes">Changes to Terms</a></li>
        <li><a href="#contact">Contact Us</a></li>
      </ol>
    </nav>

    <section id="eligibility" class="pt-8 border-t border-gray-200">
      <h2 class="text-2xl font-semibold mb-3">1. Eligibility</h2>
      <ul class="list-disc list-inside space-y-2">
        <li>You must be at least 18 years old or the legal age of majority in your country to use this site.</li>
        <li>You confirm that the information you provide is accurate and complete.</li>
      </ul>
    </section>

    <section id="use-of-site" class="pt-8 border-t border-gray-200">
      <h2 class="text-2xl font-semibold mb-3">2. Use of the Site</h2>
      <ul class="list-disc list-inside space-y-2">
        <li>Users may read articles, generate confirmation codes, and earn points in accordance with platform rules.</li>
        <li>You agree not to misuse the site, including attempts to manipulate points, referrals, or system behavior.</li>
        <li>Abuse or fraud may result in suspension or termination.</li>
      </ul>
    </section>

    <section id="points-rewards" class="pt-8 border-t border-gray-200">
      <h2 class="text-2xl font-semibold mb-3">3. Points &amp; Rewards</h2>
      <ul class="list-disc list-inside space-y-2">
        <li>Points are awarded for valid reading activity and successful code submission.</li>
        <li>Points have no cash value and cannot be exchanged for money.</li>
        <li>Points may be redeemed for mobile data or other digital rewards as listed on the site.</li>
        <li>Reward availability may vary by country, network, or time.</li>
        <li>We reserve the right to adjust points rules or redemption options at any time.</li>
      </ul>
    </section>

    <section id="referral-program" class="pt-8 border-t border-gray-200">
      <h2 class="text-2xl font-semibold mb-3">4. Referral Program</h2>
      <ul class="list-disc list-inside space-y-2">
        <li>You may earn bonus points when users you refer actively use the platform.</li>
        <li>There is no limit to the number of referrals you may invite.</li>
        <li>Fraudulent or duplicate referrals are prohibited.</li>
      </ul>
    </section>

    <section id="intellectual-property" class="pt-8 border-t border-gray-200">
      <h2 class="text-2xl font-semibold mb-3">5. Intellectual Property</h2>
      <ul class="list-disc list-inside space-y-2">
        <li>All content is the property of Readify.Africa or its licensors.</li>
        <li>Content may not be copied, republished, or redistributed without permission.</li>
      </ul>
    </section>

    <section id="termination" class="pt-8 border-t border-gray-200">
      <h2 class="text-2xl font-semibold mb-3">6. Account Termination</h2>
      <ul class="list-disc list-inside space-y-2">
        <li>Accounts may be suspended or terminated for violations.</li>
        <li>Users may request deletion at any time.</li>
      </ul>
    </section>

    <section id="disclaimer" class="pt-8 border-t border-gray-200">
      <h2 class="text-2xl font-semibold mb-3">7. Disclaimer of Liability</h2>
      <ul class="list-disc list-inside space-y-2">
        <li>Services are provided “as is” with no guarantees of availability or rewards.</li>
        <li>We are not responsible for losses related to technical issues or third-party services.</li>
      </ul>
    </section>

    <section id="changes" class="pt-8 border-t border-gray-200">
      <h2 class="text-2xl font-semibold mb-3">8. Changes to Terms</h2>
      <ul class="list-disc list-inside space-y-2">
        <li>Terms may be updated at any time.</li>
        <li>Continued use indicates acceptance.</li>
      </ul>
    </section>

    <section id="contact" class="pt-8 border-t border-gray-200">
      <h2 class="text-2xl font-semibold mb-3">9. Contact Us</h2>
      <p>If you have questions, contact:
        <a href="mailto:support@readify.africa" class="text-blue-600 hover:underline">support@readify.africa</a>.
      </p>
    </section>

  </div>
</section>

@endsection
