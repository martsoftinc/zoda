@extends('user.layout')
@section('content')

@php
    // Fetch user points from database
    $credit = DB::table('credit')
                ->where('user_id', auth()->user()->id)
                ->first();
    
    // Get points value or default to 0
    $userPoints = $credit->credit ?? 0;
@endphp

<!-- Header -->
<header class="bg-white dark:bg-gray-800 shadow-md p-4 md:p-6 sticky top-0 z-30">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <!-- Back Button -->
            <a href="/redeem" class="text-gray-600 dark:text-gray-300 hover:text-primary">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">Binance Withdrawal</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 hidden md:block">Withdraw to your Binance account</p>
            </div>
        </div>
        
        <!-- User Info -->
        <div class="flex items-center space-x-4">
            <div class="hidden md:flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold text-lg">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="hidden lg:block">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Display Success Message -->
@if(session('success'))
    <div class="max-w-3xl mx-auto px-4 pt-4">
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    </div>
@endif

<!-- Display Error Message -->
@if(session('error'))
    <div class="max-w-3xl mx-auto px-4 pt-4">
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    </div>
@endif

<!-- Display Validation Errors -->
@if($errors->any())
    <div class="max-w-3xl mx-auto px-4 pt-4">
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span class="font-bold">Please fix the following errors:</span>
            </div>
            <ul class="list-disc list-inside text-sm ml-6">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<!-- Main Content -->
<div class="max-w-3xl mx-auto px-4 py-8">
    <!-- Points Summary Card -->
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl shadow-xl p-6 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-90 mb-1">Your Available Points</p>
                <p class="text-3xl font-bold">{{ number_format($userPoints) }} points</p>
            </div>
            <div class="text-right">
                <p class="text-sm opacity-90 mb-1">Points Needed</p>
                <p class="text-2xl font-bold" id="pointsNeeded">0 points</p>
            </div>
        </div>
        <div class="mt-4 h-2 bg-white/20 rounded-full overflow-hidden">
            <div class="h-full bg-white rounded-full" id="progressBar" style="width: 0%"></div>
        </div>
        <div class="flex justify-between text-xs opacity-75 mt-2">
            <span>Min: $10 (30,000 pts)</span>
            <span id="pointsStatus">Select an amount</span>
        </div>
    </div>

    <!-- Withdrawal Form -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center">
                <i class="fab fa-binance text-2xl text-yellow-500"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Withdraw to Binance</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Enter your Binance ID to receive USDT</p>
            </div>
        </div>
        
        <form action="{{ route('binance.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Binance ID -->
            <div>
                <label for="binance_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Binance ID <span class="text-danger">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <i class="fab fa-binance text-gray-400"></i>
                    </div>
                    <input type="text" 
                           id="binance_id" 
                           name="binance_id" 
                           placeholder="Enter your Binance UID" 
                           class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                           value="{{ old('binance_id') }}"
                           required>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                    Your Binance UID can be found in your Binance account settings
                </p>
            </div>
            
            <!-- Amount Selection (Points-based) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Select Withdrawal Amount <span class="text-danger">*</span>
                </label>
                
                <!-- Amount Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 mb-4">
                    <!-- $10 - 100,000 points -->
                    <button type="button" onclick="selectAmount(10, 100000)" class="amount-option p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl text-center hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-all duration-300" data-amount="10" data-points="100000">
                        <div class="font-bold text-gray-900 dark:text-white text-lg">$10</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">100,000 pts</div>
                    </button>
                    
                    <!-- $15 - 45,000 points 
                    <button type="button" onclick="selectAmount(15, 45000)" class="amount-option p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl text-center hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-all duration-300" data-amount="15" data-points="45000">
                        <div class="font-bold text-gray-900 dark:text-white text-lg">$15</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">45,000 pts</div>
                    </button> -->
                    
                    <!-- $20 - 60,000 points -->
                    <button type="button" onclick="selectAmount(20, 200000)" class="amount-option p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl text-center hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-all duration-300" data-amount="20" data-points="60000">
                        <div class="font-bold text-gray-900 dark:text-white text-lg">$20</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">200,000 pts</div>
                    </button>
                    
                    <!-- $25 - 75,000 points 
                    <button type="button" onclick="selectAmount(25, 75000)" class="amount-option p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl text-center hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-all duration-300" data-amount="25" data-points="75000">
                        <div class="font-bold text-gray-900 dark:text-white text-lg">$25</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">75,000 pts</div>
                    </button>-->
                    
                    <!-- $30 - 90,000 points 
                    <button type="button" onclick="selectAmount(30, 90000)" class="amount-option p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl text-center hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-all duration-300" data-amount="30" data-points="90000">
                        <div class="font-bold text-gray-900 dark:text-white text-lg">$30</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">90,000 pts</div>
                    </button>-->
                    
                    <!-- $40 - 120,000 points 
                    <button type="button" onclick="selectAmount(40, 120000)" class="amount-option p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl text-center hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-all duration-300" data-amount="40" data-points="120000">
                        <div class="font-bold text-gray-900 dark:text-white text-lg">$40</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">120,000 pts</div>
                    </button>-->
                    
                    <!-- $50 - 150,000 points -->
                    <button type="button" onclick="selectAmount(50, 500000)" class="amount-option p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl text-center hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-all duration-300" data-amount="50" data-points="150000">
                        <div class="font-bold text-gray-900 dark:text-white text-lg">$50</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">500,000 pts</div>
                    </button>

                    <!-- $50 - 150,000 points -->
                    <button type="button" onclick="selectAmount(100, 1000000)" class="amount-option p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl text-center hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-all duration-300" data-amount="100" data-points="150000">
                        <div class="font-bold text-gray-900 dark:text-white text-lg">$100</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">1,000,000 pts</div>
                    </button>
                </div>
                
                <!-- Hidden input to store selected amount -->
                <input type="hidden" id="selectedAmount" name="amount" value="">
                <input type="hidden" id="selectedPoints" name="points_required" value="">
            </div>
            
            <!-- Points Balance Warning -->
            <div id="insufficientPointsWarning" class="hidden bg-danger/10 border border-danger/30 rounded-xl p-4 text-danger">
                <div class="flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p class="text-sm font-medium">Insufficient points! You need <span id="requiredPointsDisplay">0</span> points but you only have {{ number_format($userPoints) }} points.</p>
                </div>
            </div>
            
            <!-- Terms and Conditions -->
            <div class="flex items-start space-x-3 pt-4">
                <input type="checkbox" id="terms" name="terms" class="mt-1 w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary" required>
                <label for="terms" class="text-sm text-gray-600 dark:text-gray-400">
                    I confirm that the Binance ID provided is correct and I understand that withdrawals are final and cannot be reversed.
                </label>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 text-lg opacity-50 cursor-not-allowed" disabled>
                Select an amount to continue
            </button>
            
            <!-- Processing Info -->
            <div class="flex items-center justify-center space-x-6 text-sm text-gray-500 dark:text-gray-400 pt-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-clock"></i>
                    <span>Processing: 24-48 hrs</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure Transaction</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fab fa-binance"></i>
                    <span>USDT Only</span>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Selected amount styling */
    .amount-option.selected {
        border-color: #eab308;
        background-color: rgba(234, 179, 8, 0.1);
        border-width: 2px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    .dark .amount-option.selected {
        background-color: rgba(234, 179, 8, 0.2);
    }
    
    .amount-option.selected div:first-child {
        color: #eab308;
    }
</style>

<script>
    // Store user's available points (from PHP)
    const userPoints = {{ $userPoints }};
    
    // Function to select amount
    function selectAmount(amount, points) {
        // Remove selected class from all options
        document.querySelectorAll('.amount-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        // Add selected class to clicked option
        event.currentTarget.classList.add('selected');
        
        // Set hidden inputs
        document.getElementById('selectedAmount').value = amount;
        document.getElementById('selectedPoints').value = points;
        
        // Update points needed display
        document.getElementById('pointsNeeded').textContent = points.toLocaleString() + ' points';
        
        // Update progress bar
        const percentage = Math.min((points / userPoints) * 100, 100);
        document.getElementById('progressBar').style.width = percentage + '%';
        
        // Update status text
        document.getElementById('pointsStatus').innerHTML = `Required: ${points.toLocaleString()} pts`;
        
        // Check if user has enough points
        const warningDiv = document.getElementById('insufficientPointsWarning');
        const requiredDisplay = document.getElementById('requiredPointsDisplay');
        const submitBtn = document.getElementById('submitBtn');
        
        if (userPoints >= points) {
            // Enough points - enable submit
            warningDiv.classList.add('hidden');
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            submitBtn.innerHTML = `Withdraw $${amount} USDT to Binance`;
        } else {
            // Not enough points - show warning and disable submit
            requiredDisplay.textContent = points.toLocaleString();
            warningDiv.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            submitBtn.innerHTML = 'Insufficient Points';
        }
    }
    
    // On page load, check if there's a pre-selected amount from old input
    document.addEventListener('DOMContentLoaded', function() {
        const oldAmount = '{{ old('amount') }}';
        const oldPoints = '{{ old('points_required') }}';
        
        if (oldAmount && oldPoints) {
            // Find and click the corresponding button
            document.querySelectorAll('.amount-option').forEach(btn => {
                if (btn.dataset.amount == oldAmount) {
                    btn.click();
                }
            });
        }
    });
</script>

@endsection