@extends('layouts.frontlayout')

@section('title', 'Complete Profile — Koda.africa')

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

    .field-input {
      display: flex;
      align-items: center;
      background: #fff;
      border: 1.5px solid #e5e7eb;
      border-radius: 14px;
      overflow: hidden;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .field-input:focus-within {
      border-color: #1f6ff8;
      box-shadow: 0 0 0 4px rgba(31,111,248,0.10);
    }
    .field-input .input-icon {
      padding: 0 12px;
      display: flex;
      align-items: center;
      flex-shrink: 0;
      color: #9ca3af;
    }
    .field-input input,
    .field-input select {
      flex: 1;
      background: transparent;
      border: none;
      outline: none;
      color: #1a1a1a;
      font-size: 0.9rem;
      font-family: inherit;
      padding: 12px 14px 12px 0;
      appearance: none;
      -webkit-appearance: none;
    }
    .field-input select { cursor: pointer; padding-right: 12px; }
    .field-input input::placeholder { color: #9ca3af; }

    .alert-danger-light {
      background: #fde8e8;
      border: 1px solid #fca5a5;
      color: #991b1b;
      border-radius: 12px;
      padding: 12px 16px;
      font-size: 13.5px;
    }
  </style>
@endpush

@section('content')
  <section class="flex justify-center">
    <div class="w-full max-w-screen-xl px-4 md:px-20 lg:px-32 pt-12 md:pt-20 pb-24 md:pb-32">

      <div class="w-full max-w-md mx-auto">

        <!-- Header -->
        <div class="text-center mb-10 fade-up">
          <div class="w-14 h-14 rounded-2xl bg-[#ffe45e] flex items-center justify-center mx-auto mb-5">
            <i class="fas fa-user-pen text-[#1a1a1a] text-xl"></i>
          </div>
          <h1 class="text-4xl md:text-5xl font-extrabold text-[#1a1a1a] leading-tight">Complete your profile</h1>
          <p class="text-lg text-[#3c3c43] mt-4">Just a few details to personalise your experience.</p>
        </div>

        <!-- Card -->
        <div class="fade-up d1 rounded-[20px] bg-white p-7 sm:p-9 shadow-sm border border-gray-100">

          <!-- Validation errors -->
          @if ($errors->any())
            <div class="alert-danger-light mb-5">
              <ul class="flex flex-col gap-1">
                @foreach ($errors->all() as $error)
                  <li class="flex items-start gap-2">
                    <i class="fas fa-circle-exclamation text-red-600 mt-1 flex-shrink-0 text-xs"></i>
                    <span>{{ $error }}</span>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Form -->
          <form action="/profile/complete" method="POST" class="space-y-5">
            @csrf

            <!-- Full Name -->
            <div>
              <label for="name" class="block text-sm font-semibold text-[#1a1a1a] mb-2">
                Full Name <span class="text-red-500">*</span>
              </label>
              <div class="field-input">
                <span class="input-icon"><i class="fas fa-user"></i></span>
                <input type="text" id="name" name="name" placeholder="e.g. Amara Mensah" value="{{ old('name') }}" required>
              </div>
            </div>

            <!-- Gender + Age Group -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="gender" class="block text-sm font-semibold text-[#1a1a1a] mb-2">
                  Gender <span class="text-red-500">*</span>
                </label>
                <div class="field-input">
                  <span class="input-icon"><i class="fas fa-venus-mars"></i></span>
                  <select id="gender" name="gender" required>
                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                  </select>
                </div>
              </div>

              <div>
                <label for="age_group" class="block text-sm font-semibold text-[#1a1a1a] mb-2">
                  Age Group <span class="text-red-500">*</span>
                </label>
                <div class="field-input">
                  <span class="input-icon"><i class="fas fa-calendar"></i></span>
                  <select id="age_group" name="age_group" required>
                    <option value="" disabled {{ old('age_group') ? '' : 'selected' }}>Select</option>
                    <option value="18-25" {{ old('age_group') == '18-25' ? 'selected' : '' }}>18–25</option>
                    <option value="26-35" {{ old('age_group') == '26-35' ? 'selected' : '' }}>26–35</option>
                    <option value="36-45" {{ old('age_group') == '36-45' ? 'selected' : '' }}>36–45</option>
                    <option value="46-55" {{ old('age_group') == '46-55' ? 'selected' : '' }}>46–55</option>
                    <option value="56+" {{ old('age_group') == '56+' ? 'selected' : '' }}>56+</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Country -->
            <div>
              <label for="country" class="block text-sm font-semibold text-[#1a1a1a] mb-2">
                Country <span class="text-red-500">*</span>
              </label>
              <div class="field-input">
                <span class="input-icon"><i class="fas fa-globe"></i></span>
                <select id="country" name="country" required>
                  <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select your country</option>
                  <option value="GH" {{ old('country') == 'GH' ? 'selected' : '' }}>Ghana</option>
                  <option value="NG" {{ old('country') == 'NG' ? 'selected' : '' }}>Nigeria</option>
                  <option value="KE" {{ old('country') == 'KE' ? 'selected' : '' }}>Kenya</option>
                  <option value="ZA" {{ old('country') == 'ZA' ? 'selected' : '' }}>South Africa</option>
                </select>
              </div>
            </div>

            <!-- WhatsApp / Telegram -->
            <div>
              <label for="phone" class="block text-sm font-semibold text-[#1a1a1a] mb-2">
                WhatsApp / Telegram
              </label>
              <div class="field-input">
                <span class="input-icon"><i class="fas fa-comment-dots"></i></span>
                <input type="text" id="phone" name="phone" placeholder="+233 XX XXX XXXX" value="{{ old('phone') }}">
              </div>
            </div>

            <!-- Hidden referral -->
            <input type="hidden" name="referral_code" value="{{ request('referral') }}">

            <!-- Terms -->
            <div class="flex items-start gap-3 pt-1">
              <input type="checkbox" id="iAgree" name="iAgree" required
                     class="w-4 h-4 mt-1 rounded border-gray-300 text-[#1f6ff8] focus:ring-[#1f6ff8] cursor-pointer flex-shrink-0">
              <label class="text-sm text-[#3c3c43] leading-relaxed cursor-pointer" for="iAgree">
                I agree to the
                <a href="/terms" target="_blank" class="text-[#1f6ff8] font-semibold hover:underline">terms and conditions</a>
              </label>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-blue w-full font-semibold text-base py-4 rounded-full transition-colors mt-2">
              Sign Up
            </button>
          </form>

        </div>

        <!-- Footer note -->
        <p class="text-center text-sm text-[#3c3c43] mt-8 fade-up d2">
          We never share your information with third parties.
        </p>

      </div>

    </div>
  </section>
@endsection