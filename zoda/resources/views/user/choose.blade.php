@extends('user.layout')
@section('content')

<!-- Header -->
<header class="bg-white dark:bg-gray-800 shadow-md p-4 md:p-6 sticky top-0 z-30">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <!-- Back Button -->
            <a href="/publisher" class="text-gray-600 dark:text-gray-300 hover:text-primary">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">Redeem Your Points</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 hidden md:block">Redeem as internet bundle or cash</p>
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

<!-- Two-Column Clickable Redeem Section -->
<div class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">Redeem Your Points</h2>
    <p class="text-gray-600 dark:text-gray-400 mb-8">Choose how you'd like to redeem your earnings</p>
    
    <div class="grid md:grid-cols-2 gap-6">
        <!-- LEFT COLUMN: Redeem as Bundle (Clickable Card) -->
        <a href="/redeem" class="block group focus:outline-none focus:ring-4 focus:ring-primary/50 rounded-2xl">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 border-2 border-transparent group-hover:border-primary group-hover:shadow-2xl transition-all duration-300 transform group-hover:-translate-y-1">
                <div class="flex flex-col items-center text-center">
                    <!-- Icon -->
                    <div class="w-24 h-24 bg-gradient-to-br from-primary to-secondary rounded-3xl flex items-center justify-center text-white text-4xl mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-wifi"></i>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Redeem as Bundle</h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Convert your points to data</p>
                    
                    <!-- Arrow indicator -->
                    <div class="mt-6 text-primary group-hover:translate-x-2 transition-transform duration-300">
                        <i class="fas fa-arrow-right text-xl"></i>
                    </div>
                </div>
            </div>
        </a>
        
        <!-- RIGHT COLUMN: Redeem as Cash (Clickable Card - Triggers Modal) -->
        <button onclick="openCashModal()" class="block w-full text-left group focus:outline-none focus:ring-4 focus:ring-danger/50 rounded-2xl">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 border-2 border-transparent group-hover:border-danger group-hover:shadow-2xl transition-all duration-300 transform group-hover:-translate-y-1 cursor-pointer">
                <div class="flex flex-col items-center text-center">
                    <!-- Icon -->
                    <div class="w-24 h-24 bg-gradient-to-br from-danger to-orange-400 rounded-3xl flex items-center justify-center text-white text-4xl mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Redeem as Cash</h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Withdraw your earnings via Binance</p>
                    
                    <!-- Arrow indicator -->
                    <div class="mt-6 text-danger group-hover:translate-x-2 transition-transform duration-300">
                        <i class="fas fa-arrow-right text-xl"></i>
                    </div>
                </div>
            </div>
        </button>
    </div>
</div>

<!-- Cash Redemption Modal - 3 Columns with No Icons -->
<div id="cashModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Background overlay with blur effect -->
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" onclick="closeCashModal()"></div>
    
    <!-- Modal container - centered with smooth animation -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal panel - slide up animation -->
            <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl animate-slide-up" 
                 id="modalPanel">
                
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-danger to-orange-400 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white flex items-center gap-2" id="modal-title">
                            <i class="fas fa-money-bill-wave"></i>
                            Choose Payment Option
                        </h3>
                        <button onclick="closeCashModal()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Modal Body - 3 Column Payment Options (No Icons) -->
                <div class="px-6 py-8">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 text-center">Select your preferred withdrawal method</p>
                    
                    <!-- 3 Column Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <!-- Mobile Money -->
                        
                        
                            <!-- Mobile Money - Show only for Ghana (GH) -->
                                    @auth
                                        @if(auth()->user()->country === 'GH')
                                            <a href="/momo" class="block w-full">
                                                <button class="group w-full p-5 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-danger hover:bg-danger/5 hover:shadow-lg transition-all duration-300 text-center cursor-pointer">
                                                    <div class="font-bold text-gray-900 dark:text-white text-lg mb-1 group-hover:text-danger transition-colors">Mobile Money</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">MTN, Vodafone, Airtel</div>
                                                </button>
                                            </a>
                                        @endif

                                        <!-- Binance - Show for everyone else -->
                                        @if(auth()->user()->country !== 'GH')
                                            <a href="/binance" class="block w-full">
                                                <button class="group w-full p-5 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-danger hover:bg-danger/5 hover:shadow-lg transition-all duration-300 text-center cursor-pointer">
                                                    <div class="font-bold text-gray-900 dark:text-white text-lg mb-1 group-hover:text-danger transition-colors">Binance</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">USDT, BNB, BUSD</div>
                                                </button>
                                            </a>
                                        @endif
                                    @endauth
                                                
                        
                       
                        
                       
                    </div>
                    
                    <!-- Cancel Button -->
                    <div class="mt-8 text-center">
                        <button onclick="closeCashModal()" class="px-6 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-lg hover:border-danger transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    /* Custom animation for modal */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(100px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-slide-up {
        animation: slideUp 0.4s ease-out forwards;
    }
    
    /* Modal backdrop blur */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }
</style>

<script>
    // Modal functions
    function openCashModal() {
        const modal = document.getElementById('cashModal');
        modal.classList.remove('hidden');
        // Prevent scrolling on body
        document.body.style.overflow = 'hidden';
    }
    
    function closeCashModal() {
        const modal = document.getElementById('cashModal');
        modal.classList.add('hidden');
        // Restore scrolling
        document.body.style.overflow = 'auto';
    }
    
    // Handle payment method selection
    function selectPaymentMethod(method) {
        // Close the modal
        closeCashModal();
        
        // Show success toast
        const toast = document.getElementById('successToast');
        const toastMessage = document.getElementById('toastMessage');
        toastMessage.textContent = `Selected: ${method}`;
        
        toast.classList.remove('translate-y-20', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
        
        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
            toast.classList.remove('translate-y-0', 'opacity-100');
        }, 3000);
        
        // Log the selection (you can replace with actual routing logic)
        console.log(`Payment method selected: ${method}`);
        
        // Example: Redirect to specific page based on selection
        // if (method === 'Mpesa') {
        //     window.location.href = '/redeem/cash/mpesa';
        // } else if (method === 'PayPal') {
        //     window.location.href = '/redeem/cash/paypal';
        // }
    }
    
    // Close modal when clicking ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCashModal();
        }
    });
    
    // Prevent modal close when clicking inside the modal panel
    document.getElementById('modalPanel')?.addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>

@endsection

