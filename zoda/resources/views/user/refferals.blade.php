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
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">Referral Program</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 hidden md:block">Earn 100 points for every referral withdrawal</p>
            </div>
        </div>
        
        <!-- Earnings Display -->
        <div class="flex items-center space-x-4">
            <div class="hidden md:flex items-center bg-gradient-to-r from-secondary/10 to-yellow-500/10 px-4 py-2 rounded-xl">
                <i class="fas fa-users text-secondary mr-2"></i>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Referrals</p>
                    <p class="text-lg font-bold text-secondary">{{ $Total }}</p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Flash Messages -->
<div class="px-4 md:px-6 pt-4">
    @if (session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-4 fade-in" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <div>
                    <p class="font-medium">{{ session()->get('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-4 fade-in" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-3"></i>
                <div>
                    <p class="font-medium">{{ session()->get('error') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Main Content -->
<main class="p-4 md:p-6">
    <!-- Referral Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- This Month Referrals -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-t-4 border-primary">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide">This Month</p>
                    <h3 class="text-3xl md:text-4xl font-bold text-primary mt-2">{{ $This_Month }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">New referrals</p>
                </div>
                <div class="p-3 bg-primary/10 rounded-xl">
                    <i class="fas fa-calendar-check text-primary text-xl"></i>
                </div>
            </div>
            
        </div>
        
        <!-- Last Month Referrals -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-t-4 border-blue-500">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide">Last Month</p>
                    <h3 class="text-3xl md:text-4xl font-bold text-blue-500 mt-2">{{ $Last_Month }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Previous month referrals</p>
                </div>
                <div class="p-3 bg-blue-500/10 rounded-xl">
                    <i class="fas fa-calendar-alt text-blue-500 text-xl"></i>
                </div>
            </div>
            
        </div>
        
        <!-- Total Referrals -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-t-4 border-secondary">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Referrals</p>
                    <h3 class="text-3xl md:text-4xl font-bold text-secondary mt-2">{{ $Total }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">All-time referrals</p>
                </div>
                <div class="p-3 bg-secondary/10 rounded-xl">
                    <i class="fas fa-users text-secondary text-xl"></i>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Referral Link Section -->
    <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl shadow-lg p-6 md:p-8 text-white mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <div class="mb-6 md:mb-0 md:mr-8">
                <h2 class="text-2xl md:text-3xl font-bold mb-2">Your Referral Link</h2>
                <p class="text-white/90">
                    Share this link and earn <strong>100 points every time</strong> your referral withdraws!
                </p>
            </div>
            
            <!-- Copy Success Message -->
            <div id="referralCopySuccess" class="hidden mb-4 md:mb-0 md:ml-4 p-3 bg-white/20 rounded-xl">
                <p class="text-sm flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    Link copied to clipboard!
                </p>
            </div>
        </div>

        <!-- Referral Link Input -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <input type="text" 
                           value="https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}" 
                           readonly 
                           class="w-full px-4 py-3.5 bg-white/5 border border-white/20 rounded-xl text-white text-sm md:text-base pr-32 referral-input focus:outline-none focus:ring-2 focus:ring-white/50"
                           id="referralLink">
                    <button onclick="copyReferralLink()" 
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white text-primary px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition sm:hidden">
                        <i class="fas fa-copy mr-1"></i> Copy
                    </button>
                </div>
                
                <!-- Desktop Copy Button -->
                <button onclick="copyReferralLink()" 
                        class="bg-white text-primary px-6 py-3.5 rounded-xl font-bold hover:bg-gray-100 transition flex items-center justify-center">
                    <i class="fas fa-copy mr-2"></i> Copy Link
                </button>
            </div>
        </div>

        <!-- Social Share Buttons -->
        <div class="mt-8">
            <p class="text-white/90 mb-4 text-center md:text-left">Share on social media:</p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-2xl mx-auto">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}" 
                   target="_blank" 
                   class="bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl p-3 flex flex-col items-center justify-center transition transform hover:scale-105">
                    <i class="fab fa-facebook-f text-xl mb-1"></i>
                    <span class="text-xs">Facebook</span>
                </a>
                <a href="https://api.whatsapp.com/send?text=Free%20data!!!%20Earn%20free%20500mb,%201gig%20or%205gig%20by%20completing%20easy%20tasks%20online.%20Signup%20today.%20https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}" 
                   target="_blank" 
                   class="bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl p-3 flex flex-col items-center justify-center transition transform hover:scale-105">
                    <i class="fab fa-whatsapp text-xl mb-1"></i>
                    <span class="text-xs">WhatsApp</span>
                </a>
                <a href="https://twitter.com/intent/tweet?url=https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}&text=Free%20data!!!%20Earn%20free%20500mb,%201gig%20or%205gig%20by%20completing%20easy%20tasks%20online.%20Signup%20today!" 
                   target="_blank" 
                   class="bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl p-3 flex flex-col items-center justify-center transition transform hover:scale-105">
                    <i class="fab fa-twitter text-xl mb-1"></i>
                    <span class="text-xs">Twitter</span>
                </a>
                <a href="https://t.me/share/url?url=https://readify.africa/signup-publisher?referral={{ Auth::user()->account_id }}&text=Free%20data!!!%20Earn%20free%20500mb,%201gig%20or%205gig%20by%20completing%20easy%20tasks%20online.%20Signup%20today!" 
                   target="_blank" 
                   class="bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl p-3 flex flex-col items-center justify-center transition transform hover:scale-105">
                    <i class="fab fa-telegram text-xl mb-1"></i>
                    <span class="text-xs">Telegram</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Referrals Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Your Referrals</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1">People who signed up using your link</p>
            </div>
            
            <div class="mt-4 md:mt-0">
                <button onclick="copyReferralLink()" 
                        class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition flex items-center">
                    <i class="fas fa-share-alt mr-2"></i>
                    Share Your Link
                </button>
            </div>
        </div>

        @if($referrals->isEmpty())
            <div class="text-center py-12">
                <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Referrals Yet</h3>
                <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto mb-6">
                    Share your referral link to start earning 100 points for every withdrawal your referrals make!
                </p>
                <button onclick="copyReferralLink()" 
                        class="bg-gradient-to-r from-primary to-secondary text-white px-8 py-3 rounded-xl font-bold hover:opacity-90 transition">
                    Share Your Link Now
                </button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Referral</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Join Date</th>
                            
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($referrals as $referral)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold mr-3">
                                            {{ substr($referral->referredUser->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">{{ $referral->referredUser->name }}</p>
                                            
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($referral->created_at)->format('d M Y') }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($referral->created_at)->format('h:i A') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($referrals->hasPages())
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Showing {{ $referrals->firstItem() }} to {{ $referrals->lastItem() }} of {{ $referrals->total() }} referrals
                    </div>
                    <div class="flex space-x-2">
                        @if($referrals->onFirstPage())
                            <span class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-400 cursor-not-allowed">
                                Previous
                            </span>
                        @else
                            <a href="{{ $referrals->previousPageUrl() }}" 
                               class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Previous
                            </a>
                        @endif
                        
                        @if($referrals->hasMorePages())
                            <a href="{{ $referrals->nextPageUrl() }}" 
                               class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Next
                            </a>
                        @else
                            <span class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-400 cursor-not-allowed">
                                Next
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </div>
</main>

<script>
    // Copy referral link function for referrals page
    function copyReferralLink() {
        const refLink = document.getElementById('referralLink');
        const copySuccess = document.getElementById('referralCopySuccess');
        
        if (!refLink) {
            console.error('Referral link input not found');
            showToast('Error: Referral link not found');
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

    // Add click event listeners to all copy buttons
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any additional functionality if needed
        console.log('Referrals page loaded');
    });
</script>

@endsection