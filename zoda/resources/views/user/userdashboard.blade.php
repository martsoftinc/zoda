@extends('user.layout')
@section('content')
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 shadow-md p-4 flex items-center justify-between sticky top-0 z-30">
        <div class="flex items-center">
            <!-- Mobile Menu Toggle -->
            <button onclick="toggleMenu()" class="md:hidden mr-3 text-gray-600 dark:text-gray-300">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <div class="flex items-center">
                <i class="fas fa-book-reader text-primary text-2xl mr-2"></i>
                <h1 class="text-2xl font-bold text-primary">.africa</h1>
            </div>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Desktop Withdrawal Button 
            <button onclick="openModal()" class="hidden md:flex withdraw-btn items-center">
                <i class="fas fa-money-bill-wave mr-2"></i>
                <span>Withdraw</span>
                @if($credit)
                    <span class="ml-2 bg-white/20 px-2 py-1 rounded text-xs">
                        ${{ $credit->credit }}
                    </span>
                @endif
            </button>-->
            
            <!-- Notification Bell 
            <div class="relative">
                <i class="fas fa-bell text-gray-600 dark:text-gray-300 text-xl"></i>
                <span class="notification-badge">3</span>
            </div>-->
            
            <!-- Mobile Menu Toggle Button -->
            <button id="menuToggle" class="md:hidden w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold">
                {{ substr(auth()->user()->name, 0, 2) }}
            </button>
            
            <!-- Desktop User Initials -->
            <div class="hidden md:flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                <div class="hidden lg:block">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                    
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    <div class="px-4 mt-2">
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 fade-in" role="alert">
                <span class="block sm:inline">{{ session()->get('success') }}</span>
            </div>
        @endif
        
        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 fade-in" role="alert">
                <span class="block sm:inline">{{ session()->get('error') }}</span>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-4 overflow-y-auto pb-24">
        <!-- Welcome Section -->
        <section class="mb-6 fade-in">
            <h2 class="text-lg font-medium text-gray-600 dark:text-gray-400">Welcome back,</h2>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}!</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Read articles and earn data bundles</p>
        </section>

        <!-- Stats Grid -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 fade-in">
                <!-- Earnings -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-500 opacity-10 rounded-full -mr-4 -mt-4"></div>
                    <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Earnings</h2>
                    <p class="text-4xl font-bold text-green-500 mt-2">
                        @if($credit)
                            @php
                                $currency = '';
                                switch(auth()->user()->country) {
                                    case 'GH':
                                        $currency = 'GH₵';
                                        break;
                                    case 'NG':
                                        $currency = '₦';
                                        break;
                                    case 'KE':
                                        $currency = 'Ksh';
                                        break;
                                    case 'ZA':
                                        $currency = 'ZAR';
                                        break;
                                    default:
                                        $currency = '$';
                                }
                            @endphp
                            {{ $currency }} {{ $credit->credit }}
                        @else
                            $0
                        @endif
                    </p>
                </div>

            <!-- Referral Bonus -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-500 opacity-10 rounded-full -mr-4 -mt-4"></div>
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Referral Bonus</h2>
                <p class="text-4xl font-bold text-yellow-500 mt-2">{{ $bonus }}</p>
                
            </div>
            
            <!-- Paid
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500 opacity-10 rounded-full -mr-4 -mt-4"></div>
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Paid</h2>
                <p class="text-4xl font-bold text-blue-500 mt-2">{{ $paid }}</p>
                
            </div> -->
        </section>

        <!-- Available Articles Section -->
        <section class="space-y-4 fade-in">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Available Articles</h2>
                <div class="flex items-center space-x-2">
                    @if(count($tasks) > 0)
                        <span class="text-primary text-sm font-medium">{{ count($tasks) }} articles</span>
                    @endif
                    @if(session()->has('open_task'))
                        <a href="{{ route('refreshTaskList') }}" class="bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-opacity-90 transition">
                            Refresh Articles
                        </a>
                    @endif
                </div>
            </div>

            @if(session()->has('open_task'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">
                    <p class="font-medium">You have an open task. Complete it first to start a new one or click on "Refresh Articles" to enable new tasks.</p>
                </div>
            @endif

            @if(count($tasks) > 0)
                <div class="space-y-4">
                    @foreach($tasks as $task)
                        <div class="task-card bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 flex justify-between items-center border-l-primary">
                            <div class="flex-1">
                           <!--      <div class="flex items-center mb-1">
                                    <span class="bg-primary bg-opacity-10 text-primary text-xs px-2 py-1 rounded-full mr-2">
                                        {{ $loop->iteration }} of {{ count($tasks) }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-clock mr-1"></i>2-5 mins
                                    </span>
                                </div> -->
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">{{ $task->campaign_name }}</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-300">Read article and complete tasks</p>
                            </div>
                            <div class="text-right">
                                @if(session()->has('open_task') && session('open_task') != $task->id)
                                    <span class="text-gray-400 text-sm" title="Complete your current task first">
                                        <i class="fas fa-lock mr-1"></i> Locked
                                    </span>
                                @else
                                    <!-- <p class="text-primary font-bold">+${{ rand(1, 5) }}</p> -->
                                    <a href="{{ route('show', ['id' => $task->id, 'token' => $task->token]) }}" 
                                       class="mt-2 bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-opacity-90 transition-all transform hover:scale-105 inline-block">
                                        Start
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <div>
                            <p class="font-bold">No articles available</p>
                            <p class="text-sm">Sorry, no articles available right now. We are working hard to add new articles, please check back tomorrow.Thanks.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tutorial Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mt-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 flex items-center">
                    <i class="fas fa-play-circle text-primary mr-2"></i> How It Works Tutorial
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                    Watch this tutorial to learn how to earn money by reading articles:
                </p>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-48 rounded-lg" 
                            src="https://www.youtube.com/embed/t0NOPs17KgM" 
                            title="PaidReader Tutorial" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Referral Section -->
            <div class="bg-gradient-to-r from-primary to-secondary rounded-xl shadow-lg p-6 mt-6 text-center text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-6 -mt-6"></div>
                <i class="fas fa-user-friends text-3xl mb-3"></i>
                <h3 class="text-xl font-bold mb-2">Get 100 points for Every Referral!</h3>
                <p class="text-sm opacity-90 mb-4">Whenever your referrals redeem their points you get 100 points automatically.</p>
                <a href="/referrals" class="bg-white text-primary px-6 py-2 rounded-lg font-semibold hover:bg-opacity-90 transition inline-block">
                    View Referrals
                </a>
            </div>
            <!-- Referral Link Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mt-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Your Referral Link</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                    Share your unique link and earn 100 points every time your referral withdraws
                </p>
                
                <!-- Referral Link Input with Copy Button -->
                <div class="mb-4">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <!-- Input Field -->
                        <div class="flex-1 relative">
                            <input type="text" 
                                   value="https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}" 
                                   readonly 
                                   class="w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-sm pr-24 sm:pr-3"
                                   id="refLink">
                            <!-- Copy Button (inside input on mobile) -->
                            <button onclick="copyReferralLink()" 
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary text-white px-4 py-1.5 rounded-md text-sm hover:bg-opacity-90 transition sm:hidden flex items-center">
                                <i class="fas fa-copy mr-1"></i> Copy
                            </button>
                        </div>
                        
                        <!-- Copy Button (full width on mobile below, inline on desktop) -->
                        <button onclick="copyReferralLink()" 
                                class="w-full sm:w-auto bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition flex items-center justify-center sm:inline-flex">
                            <i class="fas fa-copy mr-2"></i> Copy Link
                        </button>
                    </div>
                    
                    <!-- Success Message -->
                    <div id="copySuccess" class="hidden mt-2 p-2 bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-800 rounded-lg">
                        <p class="text-sm text-green-700 dark:text-green-300 flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            Link copied to clipboard!
                        </p>
                    </div>
                </div>
                
                <!-- Social Share Buttons -->
                <div class="mt-6">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4 text-center">Share on social media:</p>
                    <div class="grid grid-cols-4 gap-3 max-w-md mx-auto">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}" 
                           target="_blank" 
                           class="bg-blue-600 text-white w-full aspect-square rounded-xl flex flex-col items-center justify-center hover:bg-blue-700 transition transform hover:scale-105">
                            <i class="fab fa-facebook-f text-xl mb-1"></i>
                            <span class="text-xs">Facebook</span>
                        </a>
                        <a href="https://api.whatsapp.com/send?text=Free%20data!!!%20Earn%20free%20500mb,%201gig%20or%205gig%20by%20completing%20easy%20tasks%20online.%20Signup%20today.%20https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}" 
                           target="_blank" 
                           class="bg-green-500 text-white w-full aspect-square rounded-xl flex flex-col items-center justify-center hover:bg-green-600 transition transform hover:scale-105">
                            <i class="fab fa-whatsapp text-xl mb-1"></i>
                            <span class="text-xs">WhatsApp</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}&text=Free%20data!!!%20Earn%20free%20500mb,%201gig%20or%205gig%20by%20completing%20easy%20tasks%20online.%20Signup%20today!" 
                           target="_blank" 
                           class="bg-blue-400 text-white w-full aspect-square rounded-xl flex flex-col items-center justify-center hover:bg-blue-500 transition transform hover:scale-105">
                            <i class="fab fa-twitter text-xl mb-1"></i>
                            <span class="text-xs">Twitter</span>
                        </a>
                        <a href="https://t.me/share/url?url=https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}&text=Free%20data!!!%20Earn%20free%20500mb,%201gig%20or%205gig%20by%20completing%20easy%20tasks%20online.%20Signup%20today!" 
                           target="_blank" 
                           class="bg-blue-500 text-white w-full aspect-square rounded-xl flex flex-col items-center justify-center hover:bg-blue-600 transition transform hover:scale-105">
                            <i class="fab fa-telegram text-xl mb-1"></i>
                            <span class="text-xs">Telegram</span>
                        </a>
                    </div>
                </div>
                
                <!-- Referral Stats -->
                @if(isset($referralCount) && $referralCount > 0)
                <div class="mt-6 p-4 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Referrals</p>
                            <p class="text-2xl font-bold text-primary">{{ $referralCount }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Bonus</p>
                            <p class="text-xl font-bold text-secondary">${{ $bonus ?? 0 }}</p>
                        </div>
                    </div>
                    <a href="/referrals" class="mt-3 inline-block text-primary hover:text-primary/80 text-sm font-medium">
                        View all referrals →
                    </a>
                </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Redeem Modal -->
    <div id="redeemModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4" onclick="closeModal(event)">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto slide-in" onclick="event.stopPropagation()">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Withdraw Earnings</h2>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="mb-4 p-4 bg-primary bg-opacity-10 rounded-lg">
                    <p class="text-primary font-medium text-center">Your Balance: 
                        <span class="font-bold">
                            @if($credit)
                                ${{ $credit->credit }}
                            @else
                                $0
                            @endif
                        </span>
                    </p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h2>Send Mobile Data Bundle via Reloadly</h2>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('topup.send') }}" method="POST">
                            @csrf  {{-- Laravel's CSRF protection --}}

                            <div class="mb-3">
                                <label for="recipient_phone" class="form-label">Recipient Phone (without +)</label>
                                <input type="text" class="form-control @error('recipient_phone') is-invalid @enderror" 
                                       id="recipient_phone" name="recipient_phone" value="{{ old('recipient_phone') }}" 
                                       placeholder="e.g., 233540903921" required>
                                @error('recipient_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="recipient_country" class="form-label">Recipient Country (ISO2)</label>
                                <input type="text" class="form-control @error('recipient_country') is-invalid @enderror" 
                                       id="recipient_country" name="recipient_country" value="{{ old('recipient_country') }}" 
                                       placeholder="e.g., GH" maxlength="2" required>
                                @error('recipient_country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sender_phone" class="form-label">Sender Phone (for tracking)</label>
                                <input type="text" class="form-control @error('sender_phone') is-invalid @enderror" 
                                       id="sender_phone" name="sender_phone" value="{{ old('sender_phone') }}" 
                                       placeholder="e.g., 11231231231" required>
                                @error('sender_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sender_country" class="form-label">Sender Country (ISO2)</label>
                                <input type="text" class="form-control @error('sender_country') is-invalid @enderror" 
                                       id="sender_country" name="sender_country" value="{{ old('sender_country') }}" 
                                       placeholder="e.g., CA" maxlength="2" required>
                                @error('sender_country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount (in USD cents, e.g., 4160 for ~$10)</label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                       id="amount" name="amount" value="{{ old('amount') }}" min="100" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="operator_id" name="operator_id" value="1">
                                <label class="form-check-label" for="operator_id">
                                    Use Specific Operator ID (leave unchecked for auto-detect)
                                </label>
                                <input type="number" class="form-control mt-2 @error('operator_id') is-invalid @enderror" 
                                       id="operator_specific" name="operator_id" value="{{ old('operator_id') }}" 
                                       placeholder="e.g., 643 for MTN Ghana Data" style="display: none;">
                            </div>
                            @error('operator_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary">Send Data Bundle</button>
                        </form>
                    </div>
                </div>
                <script>
                    // Toggle operator ID input
                    document.getElementById('operator_id').addEventListener('change', function() {
                        document.getElementById('operator_specific').style.display = this.checked ? 'block' : 'none';
                    });
                </script>
                <button onclick="closeModal()" class="mt-4 w-full text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 md:hidden shadow-lg bottom-nav z-40">
        <div class="flex justify-around py-2">
            <a href="/publisher" class="flex flex-col items-center text-primary active-tab">
                <i class="fas fa-home text-lg"></i>
                <span class="text-xs mt-1">Home</span>
            </a>
            <a href="/choose" class="flex flex-col items-center text-primary active-tab">
                <i class="fas fa-dollar-sign text-lg"></i>
                <span class="text-xs mt-1">Redeem</span>
            </a>
           
            <a href="/referrals" class="flex flex-col items-center text-gray-600 dark:text-gray-300 hover:text-secondary">
                <i class="fas fa-users text-lg"></i>
                <span class="text-xs mt-1">Referrals</span>
            </a>
            <button onclick="toggleMenu()" class="flex flex-col items-center text-gray-600 dark:text-gray-300 hover:text-secondary">
                <i class="fas fa-bars text-lg"></i>
                <span class="text-xs mt-1">Menu</span>
            </button>
        </div>
    </nav>

    <script>
        // Initialize menu toggle
        document.getElementById('menuToggle').addEventListener('click', toggleMenu);
        
        // Modal functionality
        function openModal() {
            document.getElementById('redeemModal').classList.remove('hidden');
        }

        function closeModal(event) {
            if (event && event.target.id === 'redeemModal') {
                document.getElementById('redeemModal').classList.add('hidden');
            } else {
                document.getElementById('redeemModal').classList.add('hidden');
            }
        }

        // FIXED: Copy referral link function
        function copyReferralLink() {
            const refLink = document.getElementById('refLink');
            const copySuccess = document.getElementById('copySuccess');
            
            if (!refLink) {
                console.error('Referral link input not found');
                return;
            }
            
            // Select the text
            refLink.select();
            refLink.setSelectionRange(0, 99999);
            
            // Copy to clipboard using modern API
            if (navigator.clipboard && window.isSecureContext) {
                // Modern approach (requires HTTPS)
                navigator.clipboard.writeText(refLink.value).then(() => {
                    // Show success message
                    if (copySuccess) {
                        copySuccess.classList.remove('hidden');
                        // Hide message after 3 seconds
                        setTimeout(() => {
                            copySuccess.classList.add('hidden');
                        }, 3000);
                    }
                    
                    // Also show toast notification
                    showToast('Referral link copied to clipboard!');
                }).catch(err => {
                    console.error('Failed to copy: ', err);
                    // Fallback to legacy method
                    copyUsingLegacyMethod(refLink, copySuccess);
                });
            } else {
                // Legacy method for older browsers
                copyUsingLegacyMethod(refLink, copySuccess);
            }
        }

        // Legacy copy method (for older browsers)
        function copyUsingLegacyMethod(inputElement, copySuccessElement) {
            // Legacy clipboard method
            inputElement.select();
            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    if (copySuccessElement) {
                        copySuccessElement.classList.remove('hidden');
                        setTimeout(() => {
                            copySuccessElement.classList.add('hidden');
                        }, 3000);
                    }
                    showToast('Referral link copied to clipboard!');
                } else {
                    showToast('Failed to copy. Please select and copy manually.');
                }
            } catch (err) {
                console.error('Legacy copy failed: ', err);
                showToast('Please select and copy the link manually.');
            }
        }

        // Toast notification function
        function showToast(message) {
            // Remove existing toasts
            const existingToasts = document.querySelectorAll('.custom-toast');
            existingToasts.forEach(toast => toast.remove());
            
            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'custom-toast fixed bottom-24 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-900 text-white px-5 py-3 rounded-xl shadow-xl z-50 fade-in border border-gray-700 backdrop-blur-sm';
            toast.style.minWidth = '250px';
            toast.style.textAlign = 'center';
            toast.style.fontWeight = '500';
            
            toast.innerHTML = `
                <div class="flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Alias function for backward compatibility
        function copyToClipboard() {
            copyReferralLink();
        }

        // Add active state to bottom nav
        document.querySelectorAll('.bottom-nav a').forEach(item => {
            item.addEventListener('click', function(e) {
                if (!this.hasAttribute('onclick')) {
                    document.querySelectorAll('.bottom-nav a').forEach(nav => {
                        nav.classList.remove('active-tab');
                        nav.classList.add('text-gray-600', 'dark:text-gray-300');
                    });
                    this.classList.add('active-tab');
                    this.classList.remove('text-gray-600', 'dark:text-gray-300');
                }
            });
        });

        // Add animations to task cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.task-card').forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    </script>
@endsection