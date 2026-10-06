<!-- resources/views/auth/login.blade.php -->
@extends('layouts.frontlayout')



@section('title', 'Sign In — Koda.africa')

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @keyframes fadeUp {
      from { opacity:0; transform:translateY(18px); }
      to   { opacity:1; transform:translateY(0); }
    }
    .fade-up   { animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) both; }
    .d1 { animation-delay: .07s }
    .d2 { animation-delay: .15s }
    .d3 { animation-delay: .23s }

    .btn-google {
      background: #fff;
      border: 1.5px solid #e5e7eb;
      color: #1a1a1a;
      transition: background 0.2s, border-color 0.2s, transform 0.2s, box-shadow 0.2s;
    }
    .btn-google:hover {
      background: #fafafa;
      border-color: #d1d5db;
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .btn-google:active { transform: translateY(0); }

    .alert-danger-light {
      background: #fde8e8;
      border: 1px solid #fca5a5;
      color: #991b1b;
      border-radius: 12px;
      padding: 12px 16px;
      font-size: 13.5px;
    }
    .alert-success-light {
      background: #e4f7ea;
      border: 1px solid #86efac;
      color: #166534;
      border-radius: 12px;
      padding: 12px 16px;
      font-size: 13.5px;
    }

    @keyframes spin { to { transform: rotate(360deg); } }
    .animate-spin { animation: spin 0.8s linear infinite; }
  </style>
@endpush

@section('content')
  <section class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 pt-12 md:pt-20 pb-24 md:pb-32">

      <div class="w-full max-w-md mx-auto">

        <!-- Header -->
        <div class="text-center mb-10 fade-up">
          <div class="w-14 h-14 rounded-2xl bg-[#ffe45e] flex items-center justify-center mx-auto mb-5">
            <i class="fas fa-right-to-bracket text-[#1a1a1a] text-xl"></i>
          </div>
          <h1 class="text-4xl md:text-5xl font-extrabold text-[#1a1a1a] leading-tight">Welcome back</h1>
          <p class="text-lg text-[#3c3c43] mt-4">Sign in or register to continue earning rewards.</p>
        </div>

        <!-- Card -->
        <div class="fade-up d1 rounded-[20px] bg-white p-7 sm:p-9 shadow-sm border border-gray-100">

          <!-- Session messages -->
          @if (session()->has('success'))
            <div class="alert-success-light flex items-center gap-2.5 mb-5">
              <i class="fas fa-circle-check text-green-600 flex-shrink-0"></i>
              {{ session()->get('success') }}
            </div>
          @endif

          @if (session()->has('loginError'))
            <div class="alert-danger-light flex items-center gap-2.5 mb-5">
              <i class="fas fa-circle-exclamation text-red-600 flex-shrink-0"></i>
              {{ session()->get('loginError') }}
            </div>
          @endif

          <!-- Google Sign-In -->
          <a href="/auth/google"
             id="google-btn"
             class="btn-google w-full flex items-center justify-center gap-3.5 py-4 px-5 rounded-full font-semibold text-base cursor-pointer select-none"
             onclick="handleGoogleClick(this)">
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
          <p class="text-center text-xs text-gray-500 mt-6 leading-relaxed">
            By signing in you agree to our
            <a href="/terms" class="text-gray-700 hover:text-[#1f6ff8] transition-colors underline underline-offset-2">Terms of Service</a>
            and
            <a href="/privacy" class="text-gray-700 hover:text-[#1f6ff8] transition-colors underline underline-offset-2">Privacy Policy</a>.
          </p>

        </div>

        <!-- Trust line -->
        <p class="fade-up d2 text-center text-sm text-[#3c3c43] mt-8">
          No spam. No hidden fees. Just rewards for reading.
        </p>

      </div>

    </div>
  </section>
@endsection

@push('scripts')
  <script>
    function handleGoogleClick(el) {
      el.innerHTML = `
        <svg class="animate-spin flex-shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="10" stroke="rgba(0,0,0,0.15)" stroke-width="3"/>
          <path d="M12 2a10 10 0 0 1 10 10" stroke="#1f6ff8" stroke-width="3" stroke-linecap="round"/>
        </svg>
        <span>Redirecting to Google…</span>
      `;
      el.style.pointerEvents = 'none';
      el.style.opacity = '0.7';
    }
  </script>
@endpush