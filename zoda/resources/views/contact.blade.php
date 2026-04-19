@extends('layouts.frontlayout')
@section('content')

<section class="py-16 px-6 md:px-10 lg:px-16 bg-white">
    <div class="container mx-auto max-w-6xl">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900">Contact</h2>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-10">
            
            <!-- 
            <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-4">Message on Telegram</h3>
                <p class="text-gray-600">@ExampleTelegram</p>
            </div> -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z"></path>
                </svg>
                    <a href="https://web.facebook.com/profile.php?id=61586566859696" 
                    style="display:inline-block; padding:12px 20px; background-color:#1877F2; color:#ffffff; text-decoration:none; border-radius:6px; font-weight:600; font-size:16px;">
                    Message / Follow us on Facebook
                    </a>
            </div>
        </div>
    </div>
</section>

@endsection