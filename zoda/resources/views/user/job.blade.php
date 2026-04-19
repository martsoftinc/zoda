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
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">Complete Article</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 hidden md:block">Earn by reading this article</p>
            </div>
        </div>
        
        <!-- Timer Display -->
        <div class="flex items-center space-x-4">
            <div id="sessionTimer" class="hidden md:flex items-center bg-yellow-100 dark:bg-yellow-900/30 px-3 py-2 rounded-lg">
                <i class="fas fa-clock text-yellow-600 dark:text-yellow-400 mr-2"></i>
                <span class="text-sm font-medium text-yellow-700 dark:text-yellow-300">
                    Session: <span id="timerMinutes">15</span>:<span id="timerSeconds">00</span>
                </span>
            </div>
            
        </div>
    </div>
</header>

<!-- Flash Messages -->
<div class="px-4 md:px-6 pt-4">
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-4 fade-in" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <div>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-4 fade-in" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-3"></i>
                <div>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Main Content -->
<main class="p-4 md:p-6">
    <!-- Mobile First Section: Visit Site & Verification -->
    <div class="lg:hidden space-y-6 mb-6">
        <!-- Visit Site Card (Mobile First) -->
        <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl shadow-lg p-6 text-white">
            <div class="text-center mb-6">
                <div class="w-16 h-16 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-external-link-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Ready to Start?</h3>
                <p class="text-white/90">Click below to open the article</p>
            </div>
            
            <a href="/redirect/{{ $task->id }}" 
               target="_blank" 
               rel="noopener noreferrer"
               id="visitSiteBtn"
               class="w-full bg-white text-primary py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 active:scale-95 flex items-center justify-center">
                <i class="fas fa-external-link-alt mr-3"></i>
                Click to Visit Site
            </a>
            
            <div class="mt-4 text-center text-sm opacity-90">
                <i class="fas fa-info-circle mr-1"></i>
                Opens in new tab • Keep both tabs open
            </div>
        </div>

        <!-- Verification Form Card (Mobile Second) -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Verification</h3>
                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shield-alt text-primary"></i>
                </div>
            </div>

            <form action="{{ route('verifyCode') }}" method="POST" id="verificationForm">
                @csrf
                <input type="hidden" name="id" value="{{ $task->id }}" id="taskIdInput">
                
                <!-- Code Input -->
                <div class="space-y-3 mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-key mr-2"></i>Verification Code
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="verificationCode"
                               name="verificationCode" 
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-center text-lg font-mono placeholder-gray-400 dark:placeholder-gray-500"
                               placeholder="Paste your code here"
                               required
                               autocomplete="off"
                               autocorrect="off"
                               autocapitalize="off"
                               spellcheck="false">
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex space-x-1">
                            <button type="button" 
                                    onclick="pasteFromClipboard()" 
                                    class="text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 p-1"
                                    title="Paste from clipboard">
                                <i class="fas fa-paste"></i>
                            </button>
                            <button type="button" 
                                    onclick="toggleCodeVisibility()" 
                                    class="text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 p-1"
                                    title="Show/Hide code">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Enter the exact code from the article (case-sensitive)
                    </p>
                </div>

                <!-- Submit Button -->
                <div id="submitSection">
                    <div id="countdownDisplay" class="mb-4">
                        <div class="flex items-center justify-center space-x-2 text-gray-600 dark:text-gray-400">
                            <i class="fas fa-clock"></i>
                            <span>Please wait: </span>
                            <span id="countdown" class="font-bold text-primary">120</span>
                            <span>seconds</span>
                        </div>
                        <div class="progress-bar mt-2">
                            <div id="countdownBar" class="progress-fill bg-primary" style="width: 100%"></div>
                        </div>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400 mt-1">
                            Reading time required before submission
                        </p>
                    </div>
                    
                    <button type="submit" 
                            id="submitBtn"
                            class="w-full bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 py-4 rounded-xl font-bold text-lg cursor-not-allowed opacity-50 transition-all"
                            disabled>
                        <i class="fas fa-lock mr-3"></i>
                        Submit Verification
                    </button>
                </div>

                <!-- Alternative Submit (after countdown) -->
                <div id="readySubmitSection" class="hidden">
                    <button type="submit" 
                            id="finalSubmitBtn"
                            class="w-full bg-gradient-to-r from-primary to-secondary text-white py-4 rounded-xl font-bold text-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        <i class="fas fa-paper-plane mr-3"></i>
                        Submit Verification Now
                    </button>
                </div>
                
                <!-- Code Preview -->
                <div id="codePreview" class="mt-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hidden">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Your code:</span>
                        <code id="codePreviewText" class="font-mono text-sm bg-white dark:bg-gray-800 px-2 py-1 rounded text-gray-900 dark:text-white"></code>
                    </div>
                </div>
            </form>

            <!-- Quick Actions -->
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="grid grid-cols-2 gap-3">
                    <button onclick="clearForm()" 
                            class="py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition flex items-center justify-center">
                        <i class="fas fa-eraser mr-2"></i>
                        Clear
                    </button>
                    <a href="/publisher" 
                       onclick="return confirmCancelTask()"
                       class="py-2.5 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-800/50 transition flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Cancel Task
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Instructions -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">How to Complete This Task</h2>
                    <div class="w-12 h-12 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-primary text-xl"></i>
                    </div>
                </div>

                <!-- Instructions Steps -->
                <div class="space-y-8">
                    <!-- Step 1 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-xl flex items-center justify-center mr-4">
                                <span class="text-white font-bold text-lg">1</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Visit the Article</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Click the button below to open the article in a new tab. <strong>Keep this tab open</strong> while you read.
                            </p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-400 rounded-xl flex items-center justify-center mr-4">
                                <span class="text-white font-bold text-lg">2</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Read the Article</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Enjoy reading the article. Click <strong>"Next"</strong> at the bottom of the article to go the next page ( in all your will read 3 pages).
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-400 rounded-xl flex items-center justify-center mr-4">
                                <span class="text-white font-bold text-lg">3</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Get Verification Code</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                On the last page, look for and click the <strong>"share"</strong> button. Copy the <strong>alphanumeric code</strong> that appears.
                            </p>
                           
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-400 rounded-xl flex items-center justify-center mr-4">
                                <span class="text-white font-bold text-lg">4</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Submit & Verify</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Return to this tab, paste the <strong>exact code</strong> in the field below (case-sensitive), and click <strong>"Submit Verification"</strong>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Warning Box -->
                <div class="mt-8 p-5 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-0.5 mr-3 text-xl"></i>
                        <div>
                            <p class="font-medium text-yellow-800 dark:text-yellow-300 mb-1">Important Instructions</p>
                            <ul class="text-sm text-yellow-700 dark:text-yellow-400 space-y-1">
                                <li>• <strong>Do not close this tab</strong> while reading the article</li>
                                <li>• Read the article <strong>completely</strong> before generating the code</li>
                                <li>• Session will expire in <strong>15 minutes</strong> for security</li>
                                <li>• Copy the <strong>exact code</strong> (case-sensitive)</li>
                                <li>• Do not refresh the article page during reading</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Video Tutorial -->
                <div class="mt-8">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Need Help? Watch Video Tutorial</h3>
                        <a href="https://www.youtube.com/embed/t0NOPs17KgM" target="_blank" class="text-primary hover:text-primary/80 font-medium">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Open in YouTube
                        </a>
                    </div>
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe class="w-full h-48 rounded-xl" 
                                src="https://www.youtube.com/embed/t0NOPs17KgM" 
                                title="PaidReader Tutorial" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Actions (Desktop) -->
        <div class="space-y-6 hidden lg:block">
            <!-- Visit Site Card -->
            <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl shadow-lg p-6 text-white">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-external-link-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Ready to Start?</h3>
                    <p class="text-white/90">Click below to open the article</p>
                </div>
                
                <a href="/redirect/{{ $task->id }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   id="visitSiteBtnDesktop"
                   class="w-full bg-white text-primary py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 active:scale-95 flex items-center justify-center">
                    <i class="fas fa-external-link-alt mr-3"></i>
                    Click to Visit Site
                </a>
                
                <div class="mt-4 text-center text-sm opacity-90">
                    <i class="fas fa-info-circle mr-1"></i>
                    Opens in new tab • Keep both tabs open
                </div>
            </div>

            <!-- Verification Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Verification</h3>
                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-primary"></i>
                    </div>
                </div>

                <form action="{{ route('verifyCode') }}" method="POST" id="verificationFormDesktop">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}" id="taskIdInputDesktop">
                    
                    <!-- Code Input -->
                    <div class="space-y-3 mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="fas fa-key mr-2"></i>Verification Code
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="verificationCodeDesktop"
                                   name="verificationCode" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-center text-lg font-mono placeholder-gray-400 dark:placeholder-gray-500"
                                   placeholder="Paste your code here"
                                   required
                                   autocomplete="off"
                                   autocorrect="off"
                                   autocapitalize="off"
                                   spellcheck="false">
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex space-x-1">
                                <button type="button" 
                                        onclick="pasteFromClipboardDesktop()" 
                                        class="text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 p-1"
                                        title="Paste from clipboard">
                                    <i class="fas fa-paste"></i>
                                </button>
                                <button type="button" 
                                        onclick="toggleCodeVisibilityDesktop()" 
                                        class="text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 p-1"
                                        title="Show/Hide code">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            Enter the exact code from the article (case-sensitive)
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div id="submitSectionDesktop">
                        <div id="countdownDisplayDesktop" class="mb-4">
                            <div class="flex items-center justify-center space-x-2 text-gray-600 dark:text-gray-400">
                                <i class="fas fa-clock"></i>
                                <span>Please wait: </span>
                                <span id="countdownDesktop" class="font-bold text-primary">120</span>
                                <span>seconds</span>
                            </div>
                            <div class="progress-bar mt-2">
                                <div id="countdownBarDesktop" class="progress-fill bg-primary" style="width: 100%"></div>
                            </div>
                            <p class="text-xs text-center text-gray-500 dark:text-gray-400 mt-1">
                                Reading time required before submission
                            </p>
                        </div>
                        
                        <button type="submit" 
                                id="submitBtnDesktop"
                                class="w-full bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 py-4 rounded-xl font-bold text-lg cursor-not-allowed opacity-50 transition-all"
                                disabled>
                            <i class="fas fa-lock mr-3"></i>
                            Submit Verification
                        </button>
                    </div>

                    <!-- Alternative Submit (after countdown) -->
                    <div id="readySubmitSectionDesktop" class="hidden">
                        <button type="submit" 
                                id="finalSubmitBtnDesktop"
                                class="w-full bg-gradient-to-r from-primary to-secondary text-white py-4 rounded-xl font-bold text-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                            <i class="fas fa-paper-plane mr-3"></i>
                            Submit Verification Now
                        </button>
                    </div>
                    
                    <!-- Code Preview -->
                    <div id="codePreviewDesktop" class="mt-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hidden">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Your code:</span>
                            <code id="codePreviewTextDesktop" class="font-mono text-sm bg-white dark:bg-gray-800 px-2 py-1 rounded text-gray-900 dark:text-white"></code>
                        </div>
                    </div>
                </form>

                <!-- Quick Actions -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="clearFormDesktop()" 
                                class="py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition flex items-center justify-center">
                            <i class="fas fa-eraser mr-2"></i>
                            Clear
                        </button>
                        <a href="/publisher" 
                           onclick="return confirmCancelTask()"
                           class="py-2.5 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-800/50 transition flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>
                            Cancel Task
                        </a>
                    </div>
                </div>
            </div>

            <!-- Task Info Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Task Information</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Article Title</span>
                        <span class="font-medium text-right">{{ $task->campaign_name }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Task ID</span>
                        <span class="font-mono text-sm">{{ $task->id }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Estimated Time</span>
                        <span class="font-medium">3-5 minutes</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Code Type</span>
                        <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 rounded text-xs font-medium">
                            Alphanumeric
                        </span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Status</span>
                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded text-xs font-medium">
                            In Progress
                        </span>
                    </div>
                </div>
                
                <!-- Current Code Hint -->
                <div class="mt-6 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Code Hint:</p>
                    <p class="text-sm">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                        The code is case-sensitive. Copy it exactly as shown.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Global variables
let countdownInterval;
let sessionTimerInterval;
let timeLeft = 120; // 2 minutes in seconds
let sessionTimeLeft = 900; // 15 minutes in seconds
let hasVisitedSite = false;
let codeIsVisible = false;
let codeIsVisibleDesktop = false;

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    startCountdown();
    startSessionTimer();
    
    // Save task ID in sessionStorage
    sessionStorage.setItem('currentTaskId', '{{ $task->id }}');
    sessionStorage.setItem('taskStartedAt', Date.now());
    
    // Track when user visits the site (mobile)
    const visitSiteBtn = document.getElementById('visitSiteBtn');
    if (visitSiteBtn) {
        visitSiteBtn.addEventListener('click', function() {
            hasVisitedSite = true;
            sessionStorage.setItem('hasVisitedSite', 'true');
            showToast('Article opened in new tab. Read it completely to get your verification code.', 'info', 5000);
        });
    }
    
    // Track when user visits the site (desktop)
    const visitSiteBtnDesktop = document.getElementById('visitSiteBtnDesktop');
    if (visitSiteBtnDesktop) {
        visitSiteBtnDesktop.addEventListener('click', function() {
            hasVisitedSite = true;
            sessionStorage.setItem('hasVisitedSite', 'true');
            showToast('Article opened in new tab. Read it completely to get your verification code.', 'info', 5000);
        });
    }
    
    // Prevent accidental navigation
    window.addEventListener('beforeunload', handlePageUnload);
    
    // Auto-focus on code input after countdown (mobile)
    setTimeout(() => {
        const codeInput = document.getElementById('verificationCode');
        if (codeInput) {
            codeInput.focus();
            // Ensure text is visible
            codeInput.classList.add('text-gray-900', 'dark:text-white');
        }
        
        // Auto-focus on desktop input too
        const desktopCodeInput = document.getElementById('verificationCodeDesktop');
        if (desktopCodeInput) {
            desktopCodeInput.classList.add('text-gray-900', 'dark:text-white');
        }
    }, 121000); // After 2 minutes + 1 second
    
    // Ensure text colors are set on page load for dark mode
    updateDarkModeTextColors();
});

// Update text colors for dark mode
function updateDarkModeTextColors() {
    // Check if dark mode is active
    const isDarkMode = document.documentElement.classList.contains('dark');
    
    // Mobile inputs
    const mobileInput = document.getElementById('verificationCode');
    if (mobileInput) {
        mobileInput.classList.add('text-gray-900', 'dark:text-white');
        if (isDarkMode) {
            mobileInput.style.color = '#ffffff';
        }
    }
    
    // Desktop inputs
    const desktopInput = document.getElementById('verificationCodeDesktop');
    if (desktopInput) {
        desktopInput.classList.add('text-gray-900', 'dark:text-white');
        if (isDarkMode) {
            desktopInput.style.color = '#ffffff';
        }
    }
    
    // Code previews
    const codePreviewText = document.getElementById('codePreviewText');
    if (codePreviewText) {
        codePreviewText.classList.add('text-gray-900', 'dark:text-white');
    }
    
    const codePreviewTextDesktop = document.getElementById('codePreviewTextDesktop');
    if (codePreviewTextDesktop) {
        codePreviewTextDesktop.classList.add('text-gray-900', 'dark:text-white');
    }
}

// Countdown timer for submit button
function startCountdown() {
    countdownInterval = setInterval(() => {
        timeLeft--;
        
        // Update both mobile and desktop counters
        const mobileCounter = document.getElementById('countdown');
        const desktopCounter = document.getElementById('countdownDesktop');
        if (mobileCounter) mobileCounter.textContent = timeLeft;
        if (desktopCounter) desktopCounter.textContent = timeLeft;
        
        const progressWidth = (timeLeft / 120) * 100;
        
        // Update mobile progress bar
        const countdownBar = document.getElementById('countdownBar');
        if (countdownBar) countdownBar.style.width = `${progressWidth}%`;
        
        // Update desktop progress bar
        const desktopBar = document.getElementById('countdownBarDesktop');
        if (desktopBar) desktopBar.style.width = `${progressWidth}%`;
        
        if (timeLeft <= 0) {
            clearInterval(countdownInterval);
            
            // Hide countdown for mobile
            const countdownDisplay = document.getElementById('countdownDisplay');
            if (countdownDisplay) countdownDisplay.classList.add('hidden');
            
            // Hide countdown for desktop
            const countdownDisplayDesktop = document.getElementById('countdownDisplayDesktop');
            if (countdownDisplayDesktop) countdownDisplayDesktop.classList.add('hidden');
            
            // Show ready submit sections
            const readySubmitSection = document.getElementById('readySubmitSection');
            if (readySubmitSection) readySubmitSection.classList.remove('hidden');
            
            const readySubmitSectionDesktop = document.getElementById('readySubmitSectionDesktop');
            if (readySubmitSectionDesktop) readySubmitSectionDesktop.classList.remove('hidden');
            
            // Hide submit buttons
            const submitBtn = document.getElementById('submitBtn');
            if (submitBtn) submitBtn.style.display = 'none';
            
            const desktopSubmitBtn = document.getElementById('submitBtnDesktop');
            if (desktopSubmitBtn) desktopSubmitBtn.style.display = 'none';
            
            // Enable submit buttons
            const finalSubmitBtn = document.getElementById('finalSubmitBtn');
            if (finalSubmitBtn) {
                finalSubmitBtn.disabled = false;
                finalSubmitBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
            }
            
            const finalSubmitBtnDesktop = document.getElementById('finalSubmitBtnDesktop');
            if (finalSubmitBtnDesktop) {
                finalSubmitBtnDesktop.disabled = false;
                finalSubmitBtnDesktop.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
            }
            
            showToast('You can now submit your verification code!', 'success', 3000);
        }
    }, 1000);
}

// Session timer (15 minutes)
function startSessionTimer() {
    const timerMinutes = document.getElementById('timerMinutes');
    const timerSeconds = document.getElementById('timerSeconds');
    const timerDisplay = document.getElementById('sessionTimer');
    
    // Show timer on desktop
    if (timerDisplay) timerDisplay.classList.remove('hidden');
    
    sessionTimerInterval = setInterval(() => {
        sessionTimeLeft--;
        
        const minutes = Math.floor(sessionTimeLeft / 60);
        const seconds = sessionTimeLeft % 60;
        
        if (timerMinutes) timerMinutes.textContent = minutes.toString().padStart(2, '0');
        if (timerSeconds) timerSeconds.textContent = seconds.toString().padStart(2, '0');
        
        // Color change when less than 5 minutes
        if (timerDisplay && sessionTimeLeft <= 300) {
            timerDisplay.classList.remove('bg-yellow-100', 'dark:bg-yellow-900/30');
            timerDisplay.classList.add('bg-red-100', 'dark:bg-red-900/30');
        }
        
        // Color change when less than 1 minute
        if (timerDisplay && sessionTimeLeft <= 60) {
            timerDisplay.classList.remove('bg-red-100', 'dark:bg-red-900/30');
            timerDisplay.classList.add('bg-red-200', 'dark:bg-red-800/30');
        }
        
        if (sessionTimeLeft <= 0) {
            clearInterval(sessionTimerInterval);
            showSessionExpiredModal();
        }
    }, 1000);
}

// Toggle code visibility (Mobile)
function toggleCodeVisibility() {
    const input = document.getElementById('verificationCode');
    const eyeIcon = document.querySelector('button[onclick="toggleCodeVisibility()"] i');
    
    if (!input) return;
    
    if (codeIsVisible) {
        input.type = 'password';
        if (eyeIcon) eyeIcon.className = 'fas fa-eye';
        codeIsVisible = false;
    } else {
        input.type = 'text';
        if (eyeIcon) eyeIcon.className = 'fas fa-eye-slash';
        codeIsVisible = true;
    }
    
    // Ensure text is visible in dark mode
    input.classList.add('text-gray-900', 'dark:text-white');
    if (document.documentElement.classList.contains('dark')) {
        input.style.color = '#ffffff';
    }
}

// Toggle code visibility (Desktop)
function toggleCodeVisibilityDesktop() {
    const input = document.getElementById('verificationCodeDesktop');
    const eyeIcon = document.querySelector('button[onclick="toggleCodeVisibilityDesktop()"] i');
    
    if (!input) return;
    
    if (codeIsVisibleDesktop) {
        input.type = 'password';
        if (eyeIcon) eyeIcon.className = 'fas fa-eye';
        codeIsVisibleDesktop = false;
    } else {
        input.type = 'text';
        if (eyeIcon) eyeIcon.className = 'fas fa-eye-slash';
        codeIsVisibleDesktop = true;
    }
    
    // Ensure text is visible in dark mode
    input.classList.add('text-gray-900', 'dark:text-white');
    if (document.documentElement.classList.contains('dark')) {
        input.style.color = '#ffffff';
    }
}

// Paste from clipboard (Mobile)
async function pasteFromClipboard() {
    try {
        const text = await navigator.clipboard.readText();
        const input = document.getElementById('verificationCode');
        
        if (input) {
            input.value = text;
            // Ensure text is visible
            input.classList.add('text-gray-900', 'dark:text-white');
            if (document.documentElement.classList.contains('dark')) {
                input.style.color = '#ffffff';
            }
            
            showToast('Code pasted successfully!', 'success');
            
            // Show code preview
            const codePreview = document.getElementById('codePreview');
            const codePreviewText = document.getElementById('codePreviewText');
            if (codePreview && codePreviewText) {
                codePreview.classList.remove('hidden');
                codePreviewText.textContent = text;
                codePreviewText.classList.add('text-gray-900', 'dark:text-white');
            }
        }
    } catch (err) {
        showToast('Unable to paste. Please type the code manually.', 'error');
    }
}

// Paste from clipboard (Desktop)
async function pasteFromClipboardDesktop() {
    try {
        const text = await navigator.clipboard.readText();
        const input = document.getElementById('verificationCodeDesktop');
        
        if (input) {
            input.value = text;
            // Ensure text is visible
            input.classList.add('text-gray-900', 'dark:text-white');
            if (document.documentElement.classList.contains('dark')) {
                input.style.color = '#ffffff';
            }
            
            showToast('Code pasted successfully!', 'success');
            
            // Show code preview
            const codePreview = document.getElementById('codePreviewDesktop');
            const codePreviewText = document.getElementById('codePreviewTextDesktop');
            if (codePreview && codePreviewText) {
                codePreview.classList.remove('hidden');
                codePreviewText.textContent = text;
                codePreviewText.classList.add('text-gray-900', 'dark:text-white');
            }
        }
    } catch (err) {
        showToast('Unable to paste. Please type the code manually.', 'error');
    }
}

// Clear form (Mobile)
function clearForm() {
    const input = document.getElementById('verificationCode');
    if (input) {
        input.value = '';
        input.focus();
        // Ensure text color is set even when empty
        input.classList.add('text-gray-900', 'dark:text-white');
        if (document.documentElement.classList.contains('dark')) {
            input.style.color = '#ffffff';
        }
        
        // Hide code preview
        const codePreview = document.getElementById('codePreview');
        if (codePreview) codePreview.classList.add('hidden');
        
        showToast('Form cleared', 'info');
    }
}

// Clear form (Desktop)
function clearFormDesktop() {
    const input = document.getElementById('verificationCodeDesktop');
    if (input) {
        input.value = '';
        input.focus();
        // Ensure text color is set even when empty
        input.classList.add('text-gray-900', 'dark:text-white');
        if (document.documentElement.classList.contains('dark')) {
            input.style.color = '#ffffff';
        }
        
        // Hide code preview
        const codePreview = document.getElementById('codePreviewDesktop');
        if (codePreview) codePreview.classList.add('hidden');
        
        showToast('Form cleared', 'info');
    }
}

// Handle page unload
function handlePageUnload(e) {
    if (!hasVisitedSite || sessionTimeLeft > 60) {
        // Don't show warning if user hasn't started or has plenty of time
        return;
    }
    
    if (sessionTimeLeft <= 300) { // Less than 5 minutes
        e.preventDefault();
        e.returnValue = 'You have a task in progress. Are you sure you want to leave?';
        return e.returnValue;
    }
    
    // Clear session when leaving (only if task is not completed)
    const codeInput = document.getElementById('verificationCode') || document.getElementById('verificationCodeDesktop');
    const code = codeInput ? codeInput.value.trim() : '';
    if (!code || code.length < 6) {
        clearTaskSession();
    }
}

// Clear task session via AJAX
async function clearTaskSession() {
    try {
        await fetch('{{ route("clear.task.session") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ taskId: '{{ $task->id }}' }),
            keepalive: true // Ensure request completes even if page is closing
        });
    } catch (error) {
        console.error('Failed to clear session:', error);
    }
}

// Session expired modal
function showSessionExpiredModal() {
    // Create modal
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
    modal.innerHTML = `
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 mx-auto mb-4 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Session Expired</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Your task session has expired (15 minutes). Please return to the dashboard and start the task again.
                </p>
            </div>
            <a href="/publisher" 
               class="w-full bg-gradient-to-r from-primary to-secondary text-white py-4 rounded-xl font-bold text-lg hover:opacity-90 transition flex items-center justify-center">
                <i class="fas fa-home mr-3"></i>
                Return to Dashboard
            </a>
        </div>
    `;
    
    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';
    
    // Clear session
    clearTaskSession();
    sessionStorage.removeItem('currentTaskId');
    sessionStorage.removeItem('taskStartedAt');
    sessionStorage.removeItem('hasVisitedSite');
}

// Toast notification function
function showToast(message, type = 'info', duration = 3000) {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.custom-toast');
    existingToasts.forEach(toast => toast.remove());
    
    // Create toast
    const toast = document.createElement('div');
    toast.className = `custom-toast fixed top-4 right-4 bg-white dark:bg-gray-800 shadow-xl rounded-xl p-4 border-l-4 z-50 transform translate-x-full transition-transform duration-300`;
    
    // Set border color based on type
    if (type === 'success') toast.style.borderLeftColor = '#10b981';
    else if (type === 'error') toast.style.borderLeftColor = '#ef4444';
    else if (type === 'warning') toast.style.borderLeftColor = '#f59e0b';
    else toast.style.borderLeftColor = '#3b82f6';
    
    // Set icon based on type
    let icon = 'fa-info-circle';
    let iconColor = 'text-blue-500';
    if (type === 'success') {
        icon = 'fa-check-circle';
        iconColor = 'text-green-500';
    } else if (type === 'error') {
        icon = 'fa-exclamation-triangle';
        iconColor = 'text-red-500';
    } else if (type === 'warning') {
        icon = 'fa-exclamation-circle';
        iconColor = 'text-yellow-500';
    }
    
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${icon} ${iconColor} mr-3 text-xl"></i>
            <div class="flex-1">
                <p class="font-medium text-gray-900 dark:text-white">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 10);
    
    // Auto-remove after duration
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

// Confirm cancel task
function confirmCancelTask() {
    if (hasVisitedSite) {
        return confirm('Are you sure you want to cancel this task? Your progress will be lost.');
    }
    return true;
}

// Cleanup on page hide (for mobile)
document.addEventListener('visibilitychange', function() {
    if (document.hidden && hasVisitedSite) {
        showToast('Task paused. Return to complete verification.', 'warning');
    }
});

// Check if task was already started
if (sessionStorage.getItem('currentTaskId') === '{{ $task->id }}') {
    const startTime = parseInt(sessionStorage.getItem('taskStartedAt') || '0');
    const elapsed = Math.floor((Date.now() - startTime) / 1000);
    
    if (elapsed < 900) { // Less than 15 minutes
        sessionTimeLeft = 900 - elapsed;
        timeLeft = Math.max(0, 120 - Math.floor(elapsed));
        
        // Update countdown display immediately
        const mobileCounter = document.getElementById('countdown');
        const desktopCounter = document.getElementById('countdownDesktop');
        if (mobileCounter) mobileCounter.textContent = timeLeft;
        if (desktopCounter) desktopCounter.textContent = timeLeft;
        
        if (sessionStorage.getItem('hasVisitedSite') === 'true') {
            hasVisitedSite = true;
        }
        
        // If countdown is already finished, enable submit buttons
        if (timeLeft <= 0) {
            clearInterval(countdownInterval);
            
            // Hide countdown displays
            const countdownDisplay = document.getElementById('countdownDisplay');
            if (countdownDisplay) countdownDisplay.classList.add('hidden');
            
            const countdownDisplayDesktop = document.getElementById('countdownDisplayDesktop');
            if (countdownDisplayDesktop) countdownDisplayDesktop.classList.add('hidden');
            
            // Show ready submit sections
            const readySubmitSection = document.getElementById('readySubmitSection');
            if (readySubmitSection) readySubmitSection.classList.remove('hidden');
            
            const readySubmitSectionDesktop = document.getElementById('readySubmitSectionDesktop');
            if (readySubmitSectionDesktop) readySubmitSectionDesktop.classList.remove('hidden');
            
            // Hide and disable old submit buttons
            const submitBtn = document.getElementById('submitBtn');
            if (submitBtn) {
                submitBtn.style.display = 'none';
                submitBtn.disabled = true;
            }
            
            const desktopSubmitBtn = document.getElementById('submitBtnDesktop');
            if (desktopSubmitBtn) {
                desktopSubmitBtn.style.display = 'none';
                desktopSubmitBtn.disabled = true;
            }
            
            // Enable final submit buttons
            const finalSubmitBtn = document.getElementById('finalSubmitBtn');
            if (finalSubmitBtn) {
                finalSubmitBtn.disabled = false;
                finalSubmitBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
            }
            
            const finalSubmitBtnDesktop = document.getElementById('finalSubmitBtnDesktop');
            if (finalSubmitBtnDesktop) {
                finalSubmitBtnDesktop.disabled = false;
                finalSubmitBtnDesktop.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
            }
        }
    } else {
        showSessionExpiredModal();
    }
}

// Listen for dark mode changes and update text colors
const darkModeObserver = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.attributeName === 'class') {
            updateDarkModeTextColors();
        }
    });
});

darkModeObserver.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ['class']
});

// Prevent form submission if countdown hasn't finished (Mobile)
document.getElementById('verificationForm')?.addEventListener('submit', function(e) {
    if (timeLeft > 0) {
        e.preventDefault();
        showToast('Please wait for the countdown to finish before submitting', 'warning');
        return false;
    }
    
    // Show loading state for mobile
    const submitBtn = document.getElementById('finalSubmitBtn');
    if (submitBtn) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Verifying...';
        submitBtn.disabled = true;
        
        // Re-enable after 5 seconds if still on page (fallback)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
    }
    
    return true;
});

// Prevent form submission if countdown hasn't finished (Desktop)
document.getElementById('verificationFormDesktop')?.addEventListener('submit', function(e) {
    if (timeLeft > 0) {
        e.preventDefault();
        showToast('Please wait for the countdown to finish before submitting', 'warning');
        return false;
    }
    
    // Show loading state for desktop
    const submitBtn = document.getElementById('finalSubmitBtnDesktop');
    if (submitBtn) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Verifying...';
        submitBtn.disabled = true;
        
        // Re-enable after 5 seconds if still on page (fallback)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
    }
    
    return true;
});
</script>

@endsection