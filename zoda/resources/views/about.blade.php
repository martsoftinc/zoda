@extends('layouts.frontlayout')

@section('title', 'About Us — Koda.africa')

@section('content')
  <section class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 pt-12 md:pt-20 pb-24 md:pb-32">

      <div class="max-w-3xl mx-auto">

        <!-- Header -->
        <div class="mb-10 md:mb-14 text-center">
          <div class="yellow rounded-full px-4 py-2 w-fit text-sm font-semibold mb-5 mx-auto">Company</div>
          <h1 class="text-4xl md:text-6xl font-extrabold text-[#1a1a1a] leading-tight">About Koda.Africa</h1>
          <p class="text-lg text-[#3c3c43] mt-5 max-w-2xl mx-auto">
            A rewards-based content and advertising platform built for African readers and brands.
          </p>
        </div>

        <!-- Card -->
        <div class="rounded-[20px] bg-white p-7 sm:p-10 md:p-14 shadow-sm border border-gray-100">
          <div class="space-y-6 text-lg text-[#3c3c43] leading-relaxed">
            <p>
              Koda.Africa is a rewards-based content and advertising platform that connects African readers with brands,
              businesses, and organizations looking to reach real people. We believe your attention has value, and Koda
              gives you the opportunity to earn rewards for the attention you give to sponsored content.
            </p>

            <p>
              On Koda.Africa, brands create sponsored article campaigns to promote their products, services, websites,
              and ideas. Readers can browse available campaigns, choose content that interests them, read the sponsored
              articles, and earn rewards by completing verified reading activities.
            </p>

            <p>
              Our goal is to create a platform that benefits both readers and brands. Readers can discover useful and
              interesting content while earning rewards, while advertisers can reach real African audiences through
              sponsored content and measurable campaigns.
            </p>

            <p>
              Koda.Africa is built around transparency, genuine engagement, and simplicity. Readers choose the campaigns
              they want to participate in, while advertisers can promote their content and reach audiences across
              African markets.
            </p>

            <p>
              Whether you want to earn rewards by reading or promote your brand to African consumers, Koda.Africa
              provides a simple way to connect the two.
            </p>
          </div>
        </div>

        <!-- CTA -->
        <div class="text-center mt-12 md:mt-16">
          <a href="/login" class="btn-blue inline-block font-semibold px-8 py-4 rounded-full transition-colors">
            Join koda.africa
          </a>
        </div>

      </div>

    </div>
  </section>
@endsection