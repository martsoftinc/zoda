@extends('user.layout')  <!-- Assuming your provided code is in layouts/app.blade.php -->

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform transition-all hover:scale-[1.02]">
            <!-- Header / Icon -->
            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-10 text-center">
                <div class="mx-auto w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4 animate-pulse-slow">
                    <i class="fas fa-exclamation-triangle text-white text-4xl"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                    Sorry!
                </h1>
                <p class="text-white/90 text-lg">
                    You don't have enough points yet
                </p>
            </div>

            <!-- Main Content -->
            <div class="p-6 md:p-8 text-center">
                <div class="mb-8">
                    <p class="text-gray-700 dark:text-gray-300 text-lg mb-3">
                        You need at least
                    </p>
                    <div class="inline-flex items-center justify-center bg-red-100 dark:bg-red-900/40 px-6 py-4 rounded-xl mb-4">
                        <span class="text-4xl md:text-5xl font-bold text-red-600 dark:text-red-400">1500</span>
                        <span class="text-2xl md:text-3xl font-semibold text-red-600 dark:text-red-400 ml-2">points</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 text-base">
                        to redeem your data bundle
                    </p>
                </div>

                <!-- Current Points Display -->
                @if(isset($credit) && $credit)
                    <div class="mb-8 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                        <p class="text-gray-500 dark:text-gray-400 mb-1">Your current points</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($credit->credit ?? 0) }}
                            <span class="text-xl text-gray-500 dark:text-gray-400">pts</span>
                        </p>
                    </div>
                @endif

                <!-- Call to Action -->
                <div class="space-y-4">
                    <a href="{{ url('/publisher') }}" 
                       class="block w-full bg-gradient-to-r from-primary to-emerald-500 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold py-4 px-6 rounded-xl transition-all transform hover:scale-[1.03] shadow-lg">
                        <i class="fas fa-book-reader mr-2"></i>
                        Read more articles to earn points
                    </a>
                    <!--
                    <a href="{{ url('/redeem') }}" 
                       class="block w-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-4 px-6 rounded-xl transition-all">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Redeem page
                    </a> -->
                </div>
            </div>

            <!-- Fun fact / encouragement -->
            <div class="px-6 py-5 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 text-center text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                Did you know? Reading just 50 articles can earn you up to 500+ points!
            </div>
        </div>
    </div>
@endsection