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
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">Profile Settings</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 hidden md:block">Manage your account information</p>
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

<!-- Main Content -->
<main class="p-4 md:p-6">
    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-6 fade-in" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <div>
                    <p class="font-medium">{{ session()->get('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 fade-in" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-3"></i>
                <div>
                    <p class="font-medium">{{ session()->get('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Profile Information -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Personal Information</h2>
                    <div class="w-12 h-12 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user text-primary text-xl"></i>
                    </div>
                </div>

                <form id="updatePasswordForm" method="POST" action="{{ route('profile.updatePassword') }}">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-user mr-2 text-gray-400"></i>Full Name
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white" 
                                       value="{{ Auth::user()->name }}" 
                                       disabled>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Cannot be changed</p>
                        </div>

                        <!-- Account Number -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-id-card mr-2 text-gray-400"></i>Account Number
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white" 
                                       value="{{ Auth::user()->account_id }}" 
                                       disabled>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Unique identifier</p>
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
                            </label>
                            <div class="relative">
                                <input type="email" 
                                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white" 
                                       value="{{ Auth::user()->email }}" 
                                       disabled>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Verified email address</p>
                        </div>

                        <!-- Country -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-globe mr-2 text-gray-400"></i>Country
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white" 
                                       value="{{ Auth::user()->country }}" 
                                       disabled>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                    <span class="flag-icon flag-icon-{{ strtolower(Auth::user()->country) }}"></span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Account region</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            

        <!-- Right Column - Account Stats & Info -->
        <div class="space-y-6">
            <!-- Account Summary -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Account Summary</h3>
                
                <div class="space-y-4">
                    <!-- Account Status -->
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Status</span>
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm font-medium">
                            <i class="fas fa-check-circle mr-1"></i> Active
                        </span>
                    </div>
                    
                    <!-- Member Since -->
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Member Since</span>
                        <span class="font-medium">{{ auth()->user()->created_at->format('d M Y') }}</span>
                    </div>
                    
                    <!-- Last Login -->
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Last Login</span>
                        <span class="font-medium">{{ now()->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <!-- Email Verified -->
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Email Verified</span>
                        <span class="text-green-500">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    </div>
                </div>
                
                
            </div>

           

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Quick Actions</h3>
                
                <div class="space-y-3">
                    <a href="/publisher" class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-home text-primary"></i>
                            </div>
                            <span>Back to Dashboard</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </a>
                    
                    <a href="/payments" class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-500/10 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-history text-green-500"></i>
                            </div>
                            <span>History</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </a>
                    
                    <a href="/referrals" class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-users text-secondary"></i>
                            </div>
                            <span>Referral Program</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal 1: Send Access Code Modal -->
<div id="sendCodeModal" class="modal-overlay hidden" onclick="closeSendCodeModal()">
    <div class="modal-content max-w-md" onclick="event.stopPropagation()">
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Security Verification</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Step 1 of 2</p>
                </div>
                <button onclick="closeSendCodeModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Content -->
            <div class="text-center py-4">
                <div class="w-20 h-20 mx-auto mb-6 bg-primary/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-envelope text-primary text-3xl"></i>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Send Verification Code</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    A verification code will be sent to your registered email address:
                    <span class="font-medium text-primary">{{ Auth::user()->email }}</span>
                </p>
                
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-0.5 mr-3"></i>
                        <p class="text-sm text-yellow-700 dark:text-yellow-300">
                            For security reasons, verification is required before changing your password.
                        </p>
                    </div>
                </div>
                
                <button onclick="sendVerificationCode()" 
                        id="sendCodeBtn"
                        class="w-full bg-gradient-to-r from-primary to-secondary text-white py-4 rounded-xl font-bold text-lg hover:opacity-90 transition flex items-center justify-center">
                    <i class="fas fa-paper-plane mr-3"></i>
                    Send Verification Code
                </button>
                
                <button onclick="closeSendCodeModal()" class="w-full text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 py-3 mt-4">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal 2: Enter Access Code Modal -->
<div id="codeModal" class="modal-overlay hidden" onclick="closeCodeModal()">
    <div class="modal-content max-w-md" onclick="event.stopPropagation()">
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Enter Verification Code</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Step 2 of 2</p>
                </div>
                <button onclick="closeCodeModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Content -->
            <div class="text-center py-4">
                <div class="w-20 h-20 mx-auto mb-6 bg-green-500/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-shield-alt text-green-500 text-3xl"></i>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Check Your Email</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Enter the 6-digit verification code sent to:
                    <span class="font-medium text-primary">{{ Auth::user()->email }}</span>
                </p>
                
                <!-- Code Input -->
                <div class="mb-8">
                    <input type="text" 
                           id="verificationCode"
                           maxlength="6"
                           class="w-full px-4 py-4 text-center text-3xl font-bold tracking-widest border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                           placeholder="000000"
                           oninput="formatCodeInput()">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Enter the 6-digit code</p>
                </div>
                
                <!-- Timer -->
                <div id="timerSection" class="mb-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Code expires in: 
                        <span id="timer" class="font-bold text-primary">05:00</span>
                    </p>
                </div>
                
                <!-- Resend Code -->
                <div id="resendSection" class="hidden mb-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Didn't receive the code?</p>
                    <button onclick="resendVerificationCode()" 
                            id="resendCodeBtn"
                            class="text-primary hover:text-primary/80 font-medium">
                        <i class="fas fa-redo mr-2"></i>
                        Resend Code
                    </button>
                </div>
                
                <!-- Buttons -->
                <div class="space-y-3">
                    <button onclick="verifyCode()" 
                            id="verifyCodeBtn"
                            class="w-full bg-gradient-to-r from-primary to-secondary text-white py-4 rounded-xl font-bold text-lg hover:opacity-90 transition">
                        <i class="fas fa-check-circle mr-3"></i>
                        Verify & Update Password
                    </button>
                    
                    <button onclick="closeCodeModal()" class="w-full text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 py-3">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Password validation
function validatePassword() {
    const password = document.getElementById('password').value;
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');
    const requirements = document.getElementById('passwordRequirements');
    const updateBtn = document.getElementById('updateProfileBtn');
    
    if (password.length === 0) {
        document.getElementById('passwordStrength').classList.add('hidden');
        updateBtn.disabled = true;
        return;
    }
    
    document.getElementById('passwordStrength').classList.remove('hidden');
    
    // Check requirements
    const hasLength = password.length >= 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasLowercase = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    
    // Update requirement indicators
    updateRequirement('reqLength', hasLength);
    updateRequirement('reqUppercase', hasUppercase);
    updateRequirement('reqLowercase', hasLowercase);
    updateRequirement('reqNumber', hasNumber);
    
    // Calculate strength
    let strength = 0;
    let color = '';
    let text = '';
    
    if (hasLength) strength += 25;
    if (hasUppercase) strength += 25;
    if (hasLowercase) strength += 25;
    if (hasNumber) strength += 25;
    
    if (strength <= 25) {
        color = 'bg-red-500';
        text = 'Weak';
    } else if (strength <= 50) {
        color = 'bg-yellow-500';
        text = 'Fair';
    } else if (strength <= 75) {
        color = 'bg-blue-500';
        text = 'Good';
    } else {
        color = 'bg-green-500';
        text = 'Strong';
    }
    
    strengthBar.className = `h-full rounded-full transition-all duration-300 ${color}`;
    strengthBar.style.width = `${strength}%`;
    strengthText.textContent = text;
    strengthText.className = `text-xs font-medium ${color.replace('bg-', 'text-')}`;
    
    // Enable/disable update button
    updateBtn.disabled = strength < 75;
}

function updateRequirement(elementId, isValid) {
    const element = document.getElementById(elementId);
    const icon = element.querySelector('i');
    
    if (isValid) {
        icon.className = 'fas fa-check text-green-500 mr-2';
    } else {
        icon.className = 'fas fa-times text-red-500 mr-2';
    }
}

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    const matchStatus = document.getElementById('passwordMatchStatus');
    
    if (confirmPassword.length === 0) {
        matchStatus.classList.add('hidden');
        return;
    }
    
    if (password === confirmPassword) {
        matchStatus.classList.remove('hidden');
    } else {
        matchStatus.classList.add('hidden');
    }
}

function togglePasswordVisibility(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.parentElement.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

// Modal Functions
function showSendCodeModal() {
    // Check if password meets requirements
    const password = document.getElementById('password').value;
    if (password.length < 8) {
        showToast('Please enter a valid password first', 'error');
        return;
    }
    
    // Show confirm password field
    document.getElementById('confirmPasswordSection').classList.remove('hidden');
    
    const modal = document.getElementById('sendCodeModal');
    modal.classList.add('active');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeSendCodeModal() {
    const modal = document.getElementById('sendCodeModal');
    modal.classList.remove('active');
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}

function closeCodeModal() {
    const modal = document.getElementById('codeModal');
    modal.classList.remove('active');
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}

// Timer for verification code
let countdownTimer;
let timeLeft = 300; // 5 minutes in seconds

function startTimer() {
    const timerElement = document.getElementById('timer');
    const resendSection = document.getElementById('resendSection');
    const timerSection = document.getElementById('timerSection');
    
    clearInterval(countdownTimer);
    timeLeft = 300;
    
    countdownTimer = setInterval(() => {
        timeLeft--;
        
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeLeft <= 0) {
            clearInterval(countdownTimer);
            timerSection.classList.add('hidden');
            resendSection.classList.remove('hidden');
        }
    }, 1000);
}

function formatCodeInput() {
    const input = document.getElementById('verificationCode');
    let value = input.value.replace(/\D/g, ''); // Remove non-digits
    value = value.substring(0, 6); // Limit to 6 digits
    input.value = value;
}

// API Functions
async function sendVerificationCode() {
    const sendBtn = document.getElementById('sendCodeBtn');
    const originalText = sendBtn.innerHTML;
    
    sendBtn.disabled = true;
    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Sending...';
    
    try {
        const response = await fetch('{{ route('profile.sendCode') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        });
        
        const data = await response.json();
        
        if (data.message) {
            showToast('Verification code sent to your email!', 'success');
            
            // Close send modal and open code modal
            closeSendCodeModal();
            
            const codeModal = document.getElementById('codeModal');
            codeModal.classList.add('active');
            codeModal.style.display = 'flex';
            
            // Start timer
            startTimer();
            
            // Focus on code input
            setTimeout(() => {
                document.getElementById('verificationCode').focus();
            }, 300);
        } else {
            showToast('Failed to send verification code', 'error');
        }
    } catch (error) {
        showToast('Network error. Please try again.', 'error');
    } finally {
        sendBtn.disabled = false;
        sendBtn.innerHTML = originalText;
    }
}

async function verifyCode() {
    const code = document.getElementById('verificationCode').value;
    const verifyBtn = document.getElementById('verifyCodeBtn');
    const originalText = verifyBtn.innerHTML;
    
    if (code.length !== 6) {
        showToast('Please enter a valid 6-digit code', 'error');
        return;
    }
    
    verifyBtn.disabled = true;
    verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Verifying...';
    
    try {
        const response = await fetch('{{ route('profile.verifyCode') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ code: code })
        });
        
        const data = await response.json();
        
        if (data.status) {
            showToast('Code verified successfully!', 'success');
            
            // Close modal
            closeCodeModal();
            
            // Submit the form after delay
            setTimeout(() => {
                const password = document.getElementById('password').value;
                const form = document.getElementById('updatePasswordForm');
                
                // Create hidden input for password
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'password';
                hiddenInput.value = password;
                form.appendChild(hiddenInput);
                
                // Submit form
                form.submit();
            }, 1000);
        } else {
            showToast('Invalid verification code', 'error');
        }
    } catch (error) {
        showToast('Network error. Please try again.', 'error');
    } finally {
        verifyBtn.disabled = false;
        verifyBtn.innerHTML = originalText;
    }
}

async function resendVerificationCode() {
    const resendBtn = document.getElementById('resendCodeBtn');
    const originalText = resendBtn.innerHTML;
    
    resendBtn.disabled = true;
    resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Sending...';
    
    try {
        const response = await fetch('{{ route('profile.sendCode') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        });
        
        const data = await response.json();
        
        if (data.message) {
            showToast('New verification code sent!', 'success');
            
            // Restart timer
            document.getElementById('resendSection').classList.add('hidden');
            document.getElementById('timerSection').classList.remove('hidden');
            startTimer();
        } else {
            showToast('Failed to resend code', 'error');
        }
    } catch (error) {
        showToast('Network error. Please try again.', 'error');
    } finally {
        resendBtn.disabled = false;
        resendBtn.innerHTML = originalText;
    }
}

// Toast function (from layout)
function showToast(message, type = 'success', duration = 3000) {
    if (typeof window.showToast === 'function') {
        window.showToast(message, type, duration);
    } else {
        // Fallback alert
        alert(message);
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Initialize password validation
    validatePassword();
    
    // Close modals on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSendCodeModal();
            closeCodeModal();
        }
    });
});
</script>

@endsection