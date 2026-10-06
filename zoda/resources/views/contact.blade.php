@extends('layouts.frontlayout')
@section('title', 'Contact Us — Koda.africa')

@push('styles')
  <style>
    .contact-card {
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .contact-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 32px rgba(0,0,0,0.08);
    }
  </style>
@endpush

@section('content')
  <section class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 pt-12 md:pt-20 pb-24 md:pb-32">

      <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-12 md:mb-16 text-center">
          <div class="yellow rounded-full px-4 py-2 w-fit text-sm font-semibold mb-5 mx-auto">Company</div>
          <h1 class="text-4xl md:text-6xl font-extrabold text-[#1a1a1a] leading-tight">Get in touch</h1>
          <p class="text-lg text-[#3c3c43] mt-5 max-w-2xl mx-auto">
            Questions, partnerships, or feedback — we'd love to hear from you.
          </p>
        </div>

        <!-- Offices -->
        <h2 class="text-2xl md:text-3xl font-bold text-[#1a1a1a] mb-6">Our offices</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-14">

          <!-- Accra -->
          <div class="contact-card rounded-[20px] bg-white p-6 sm:p-8 shadow-sm border border-gray-100">
            <div class="w-12 h-12 rounded-2xl yellow flex items-center justify-center mb-5">
              <i class="fas fa-location-dot text-[#1a1a1a] text-lg"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1a1a1a] mb-3">Accra</h3>
            <p class="text-[#3c3c43] leading-relaxed">
              Unit F02, City Galleria Mall,<br>
              Spintex Rd,<br>
              Accra, Ghana
            </p>
          </div>

          <!-- Lagos -->
          <div class="contact-card rounded-[20px] bg-white p-6 sm:p-8 shadow-sm border border-gray-100">
            <div class="w-12 h-12 rounded-2xl yellow flex items-center justify-center mb-5">
              <i class="fas fa-location-dot text-[#1a1a1a] text-lg"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1a1a1a] mb-3">Lagos</h3>
            <p class="text-[#3c3c43] leading-relaxed">
              42 Kusenla Street,<br>
              Off Chisco Bus Stop, Ikate,<br>
              Lekki, Lagos
            </p>
          </div>

          <!-- Rosebank -->
          <div class="contact-card rounded-[20px] bg-white p-6 sm:p-8 shadow-sm border border-gray-100">
            <div class="w-12 h-12 rounded-2xl yellow flex items-center justify-center mb-5">
              <i class="fas fa-location-dot text-[#1a1a1a] text-lg"></i>
            </div>
            <h3 class="text-xl font-bold text-[#1a1a1a] mb-3">Rosebank</h3>
            <p class="text-[#3c3c43] leading-relaxed">
              24 Cradock Avenue,<br>
              Rosebank,<br>
              Gauteng, South Africa, 2196
            </p>
          </div>

        </div>

        <!-- Reach us -->
        <h2 class="text-2xl md:text-3xl font-bold text-[#1a1a1a] mb-6">Reach us</h2>

        <div class="rounded-[20px] bg-white p-7 sm:p-10 shadow-sm border border-gray-100">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <!-- Email -->
            <a href="mailto:support@Koda.africa" class="flex items-start gap-4 group">
              <div class="w-11 h-11 rounded-xl bg-[#e8f0ff] flex items-center justify-center flex-shrink-0">
                <i class="fas fa-envelope text-[#1f6ff8]"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-[#1a1a1a] mb-1">Email</div>
                <div class="text-[#3c3c43] group-hover:text-[#1f6ff8] transition-colors">support@Koda.africa</div>
              </div>
            </a>

            <!-- Facebook -->
            <a href="https://web.facebook.com/profile.php?id=61586566859696" target="_blank" rel="noopener" class="flex items-start gap-4 group">
              <div class="w-11 h-11 rounded-xl bg-[#e8f0ff] flex items-center justify-center flex-shrink-0">
                <i class="fab fa-facebook-f text-[#1f6ff8]"></i>
              </div>
              <div>
                <div class="text-sm font-semibold text-[#1a1a1a] mb-1">Facebook</div>
                <div class="text-[#3c3c43] group-hover:text-[#1f6ff8] transition-colors">Follow us on Facebook</div>
              </div>
            </a>

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

