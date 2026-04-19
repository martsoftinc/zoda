@extends('layouts.frontlayout')
@section('content')
<!-- Hero Section -->
    <section class="bg-emerald-50 text-gray-900 py-20 px-6 md:px-10 lg:px-16">
        <div class="container mx-auto max-w-6xl flex flex-col md:flex-row items-center justify-between gap-10">
            <!-- Text Content (Left) -->
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 animate-fade-in-up">
                    Earn mobile data, airtime, and cash by reading articles.
                </h1>
                <p class="text-lg md:text-xl mb-10 opacity-90 animate-fade-in-up delay-200">
                    Discover engaging articles, expand your knowledge, and earn points for every article you read — which you can redeem for mobile data, airtime and cash. It’s that simple.                </p>
                <a href="{{ route('google.login') }}" class="inline-block bg-indigo-600 text-white hover:bg-indigo-700 font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition duration-300 animate-fade-in-up delay-400">
                    Login
                </a>
                <a href="signup-publisher" class="inline-block bg-indigo-600 text-white hover:bg-indigo-700 font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition duration-300 animate-fade-in-up delay-400">
                    Register
                </a>
            </div>
            <!-- Image (Right) -->
            <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgaDU2yuq2Y48UptMW87fAd0SuMydCeBMDzXSa7V3HgGTj6E31nxzb4HcVMI6kg_xE9sPjaW5MwDC7HuwQPm9v5AiBpmtSXfJDv7BAhByXEkOTYp83aNeYYPlotjE-Ei8EYLyoR_xlEuLyHnRswu49GfnWjWnRmmX52csVJR9AA95N7G4muxt5XqKAksrNM/s16000/Add%20a%20heading%20(1).png" alt="Reading Illustration" class="rounded-xl shadow-2xl max-w-full h-auto">
            </div>
        </div>
    </section>
    <!-- How It Works Section -->
    <section class="py-16 px-6 md:px-10 lg:px-16 bg-white">
        <div class="container mx-auto max-w-6xl">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900">How It Works</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center p-6 bg-gray-50 rounded-xl shadow-md transform hover:scale-105 transition duration-300">
                    <div class="bg-indigo-100 text-indigo-600 rounded-full p-4 mb-4">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897m4.905-2.727l.777 2.897M19.082 9.077a2.896 2.896 0 00-2.892-2.892M15 15v2.5m-4.5-4.5v2.5m-4.5-4.5v2.5M12 21.5V12M12 12H3.5" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">1. Discover Articles</h3>
                    <p class="text-gray-600">Browse a wide range of high-quality articles on topics you love, from tech to lifestyle.</p>
                </div>
                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center p-6 bg-gray-50 rounded-xl shadow-md transform hover:scale-105 transition duration-300">
                    <div class="bg-purple-100 text-purple-600 rounded-full p-4 mb-4">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">2. Read & Engage</h3>
                    <p class="text-gray-600">Simply read through the articles, which usually span 3–5 pages. On the final page, generate a code to confirm that you have completed the reading.</p>
                </div>
                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center p-6 bg-gray-50 rounded-xl shadow-md transform hover:scale-105 transition duration-300">
                    <div class="bg-green-100 text-green-600 rounded-full p-4 mb-4">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">3. Earn Points</h3>
                    <p class="text-gray-600">Copy the code generated at the end of the article and paste it on the site to earn points. There’s no limit—you can read as many articles as you want.</p>
                </div>
            </div>
        </div>
    </section>


<!-- New Section: The Idea (Full Width, Orange Background) -->
    <section class="py-16 px-6 md:px-10 lg:px-16 bg-orange-50 text-center">
        <div class="container mx-auto max-w-4xl">
            <h2 class="text-3xl md:text-4xl font-bold leading-tight mb-6 text-gray-900">
                Our Story
            </h2>
            <p class="text-lg md:text-xl mb-10 opacity-90 text-gray-700">
               We are passionate about reading and learning, and we believe that access to information is a key driver of personal and economic development. This belief inspired us to create a platform that encourages more people across Africa to read regularly and build knowledge through simple, accessible content.

In many communities, reading is not yet a daily habit, often because of limited access, high data costs, or a lack of incentives. Our goal is to help remove these barriers by making reading both rewarding and practical.

Our mission is to promote a culture of reading across Africa by combining education with digital incentives. By allowing users to earn points and redeem them for mobile data as they read, we aim to make learning more accessible, engaging, and sustainable for everyone.
            </p>
        </div>
    </section>

    

    

   

    <!-- New Content Section 4: Image Left, Text Right (Blue Background) 
    <section class="py-16 px-6 md:px-10 lg:px-16 bg-blue-50">
        <div class="container mx-auto max-w-6xl flex flex-col md:flex-row-reverse items-center justify-between gap-10">
             Text Content (Right) 
            <div class="md:w-1/2 text-center md:text-left">
                <h2 class="text-3xl md:text-4xl font-bold leading-tight mb-6 text-gray-900">
                    Your Data, Your Privacy, Our Priority.
                </h2>
                <p class="text-lg md:text-xl mb-10 opacity-90 text-gray-700">
                    We are committed to protecting your privacy and ensuring the security of your data. Read with peace of mind, knowing your information is safe with us.
                </p>
            </div>
             Image (Left) 
            <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
                <img src="https://placehold.co/500x350/DBEAFE/1D4ED8?text=Pricacy+Focused" alt="Privacy and Security Illustration" class="rounded-xl shadow-2xl max-w-full h-auto">
            </div>
        </div>
    </section> -->

    <!-- Google Reviews Section -->
    <section class="py-16 px-6 md:px-10 lg:px-16 bg-gray-50">
        <div class="container mx-auto max-w-6xl">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900">What Our Readers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Review Card 1 -->
                <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex text-yellow-400 mb-3">
                        <!-- Star Icons -->
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                    </div>
                    <p class="text-gray-700 mb-4">"I use the platform every day on my commute. The articles are short and informative, and the points I earn help me get mobile data without spending extra money."</p>
                    <p class="font-semibold text-gray-900">- Aisha Bello — Lagos, Nigeria</p>
                </div>
                <!-- Review Card 2 -->
                <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex text-yellow-400 mb-3">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                    </div>
                    <p class="text-gray-700 mb-4">"The topics are relevant and easy to understand. Earning points for reading makes it easier for me to stay consistent."</p>
                    <p class="font-semibold text-gray-900">- Thabo Mokoena — Soweto, South Africa</p>
                </div>
                <!-- Review Card 3 -->
                <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex text-yellow-400 mb-3">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        
                    </div>
                    <p class="text-gray-700 mb-4">"The platform encourages me to read more often. I enjoy the variety of articles, and redeeming points for data is very convenient."</p>
                    <p class="font-semibold text-gray-900">- James Tetteh - Accra, Ghana</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="flex text-yellow-400 mb-3">
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        
                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.09l6.572-.955L10 0l2.941 6.135 6.572.955-4.758 4.655 1.123 6.545z"/></svg>
                        
                    </div>
                    <p class="text-gray-700 mb-4">"It has become part of my daily routine. Reading, learning, and earning data at the same time is a great combination."</p>
                    <p class="font-semibold text-gray-900">- Wanjiku Njoroge — Nairobi, Kenya</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 px-6 md:px-10 lg:px-16 bg-white">
        <div class="container mx-auto max-w-4xl">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900">Frequently Asked Questions</h2>
            <div class="space-y-6">
                <!-- FAQ Item 1 -->

                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">How much cash can I earn?</h3>
                    <p class="text-gray-700">Your earnings are based on the points you accumulate. The more points you earn, the higher your potential rewards. You can gain more points by reading articles and inviting others to join. For every referral, you receive 100 bonus points each time they make a withdrawal.</p>
                </div>

                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">How do I convert points to cash?</h3>
                    <p class="text-gray-700">Once you log in and have enough points, click on the “Redeem” link to convert your points into cash. Users in Ghana can withdraw via mobile money. Users in Nigeria, Kenya, and South Africa can withdraw through Binance. We are continuously working to introduce local payment options for more countries.</p>
                </div>

                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">How long does it take to receive my rewards?</h3>
                    <p class="text-gray-700">Internet bundles and airtime are delivered instantly. Cash payments are processed within 24–48 hours after your redemption request is submitted.</p>
                </div>

                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">How do I get free data bundles?</h3>
                    <p class="text-gray-700">Simply sign up for a free account, browse our selection of articles, and start reading! Generate a verification code and earn points which can be redeemed for data bundles.</p>
                </div>

                <!-- FAQ Item 1 -->
                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Who can join?</h3>
                    <p class="text-gray-700">This platform is open to anyone with an internet connection and a desire to read and earn. We welcome readers from Ghana, Nigeria, South Africa and Kenya. We are working hard to expand our reach to more africa countries.</p>
                </div>
                
                <!-- FAQ Item 1 
                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">How much can I realistically make?</h3>
                    <p class="text-gray-700">From our data, users from Tier 1 countries such as the USA, Canada, Australia, and the EU typically earn between $500 and $900 monthly. Users from Africa and other developing countries usually earn between $100 and $300. However, with referrals, some users from Africa and other developing regions make thousands of dollars monthly due to the large number of referrals they have.</p>
                </div> -->

                <!-- FAQ Item 2 -->
                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">What network providers are supported?</h3>
                    <p class="text-gray-700"> You can redeem your points for data bundles from all major providers in Ghana, Nigeria, South Africa, and Kenya.</p>
                </div>
                <!-- FAQ Item 3 -->
                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">What are the available bundles?</h3>
                    <p class="text-gray-700">We offer 500MB, 1GB, 2GB, 5GB, 10GB and 50G bundles. Your points will determine which bundles you can redeem.</p>
                </div>
                <!-- FAQ Item 4 -->
              
        </div>
    </section>
@endsection