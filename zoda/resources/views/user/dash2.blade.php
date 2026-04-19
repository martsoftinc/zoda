<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freedatasa - Earn Points for Data Bundles</title>
    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#10b981">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Freedatasa">
    <link rel="apple-touch-icon" href="icon-192.png">
    <link rel="manifest" href="manifest.json">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10b981', // Emerald green for rewards theme
                        secondary: '#f59e0b', // Amber for accents
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom styles for enhanced UI */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .task-card {
            transition: all 0.3s ease;
            border-left: 4px solid;
        }
        
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: #e5e7eb;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(to right, #10b981, #34d399);
            border-radius: 4px;
            transition: width 0.5s ease;
        }
        
        .bottom-nav {
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .active-tab {
            color: #10b981;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }
        
        .floating-action {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(to right, #10b981, #34d399);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 40;
            transition: all 0.3s ease;
        }
        
        .floating-action:hover {
            transform: scale(1.1);
        }
        
        .animate-pulse-slow {
            animation: pulse 3s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
        
        /* Collapsible Menu Styles */
        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            display: none;
        }
        
        .menu-container {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 320px;
            height: 100%;
            background: white;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 60;
            transition: right 0.3s ease;
            overflow-y: auto;
        }
        
        .menu-container.open {
            right: 0;
        }
        
        .dark .menu-container {
            background: #1f2937;
        }
        
        .menu-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dark .menu-header {
            border-bottom: 1px solid #374151;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.2s;
            cursor: pointer;
        }
        
        .dark .menu-item {
            border-bottom: 1px solid #374151;
        }
        
        .menu-item:hover {
            background-color: #f9fafb;
        }
        
        .dark .menu-item:hover {
            background-color: #374151;
        }
        
        .menu-item i {
            width: 24px;
            margin-right: 12px;
            text-align: center;
        }
        
        .user-info {
            padding: 1.5rem;
            background: linear-gradient(to right, #10b981, #34d399);
            color: white;
        }
        
        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 shadow-md p-4 flex items-center justify-between sticky top-0 z-30">
        <div class="flex items-center">
            <i class="fas fa-database text-primary text-2xl mr-2"></i>
            <h1 class="text-2xl font-bold text-primary">Freedatasa</h1>
        </div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <i class="fas fa-bell text-gray-600 dark:text-gray-300 text-xl"></i>
                <span class="notification-badge">3</span>
            </div>
            <button id="menuToggle" class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold">
                JD
            </button>
        </div>
    </header>

    <!-- Collapsible Menu -->
    <div id="menuOverlay" class="menu-overlay" onclick="toggleMenu()"></div>
    <div id="menuContainer" class="menu-container">
        <div class="menu-header">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Menu</h2>
            <button onclick="toggleMenu()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h3 class="text-lg font-bold">John Doe</h3>
            <p class="text-sm opacity-90">1,250 points</p>
        </div>
        
        <div class="py-2">
            <div class="menu-item" onclick="navigateTo('profile')">
                <i class="fas fa-user text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Profile</span>
            </div>
            <div class="menu-item" onclick="navigateTo('redeem')">
                <i class="fas fa-gift text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Redeem</span>
            </div>
            <div class="menu-item" onclick="navigateTo('about')">
                <i class="fas fa-info-circle text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">About Us</span>
            </div>
            <div class="menu-item" onclick="navigateTo('contact')">
                <i class="fas fa-envelope text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Contact Us</span>
            </div>
            <div class="menu-item" onclick="logout()">
                <i class="fas fa-sign-out-alt text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Logout</span>
            </div>
        </div>
        
        <div class="p-4 mt-4 border-t border-gray-200 dark:border-gray-700">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">APP VERSION</h3>
            <p class="text-xs text-gray-600 dark:text-gray-300">Freedatasa v1.2.3</p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-4 overflow-y-auto pb-24">
        <!-- Welcome Section 
        <section class="mb-6 fade-in">
            <h2 class="text-lg font-medium text-gray-600 dark:text-gray-400">Welcome back,</h2>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">John Doe!</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Complete tasks to earn data bundles</p>
        </section>-->

        <!-- Section 1: Points and Redeem Grid -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 fade-in">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-primary opacity-10 rounded-full -mr-4 -mt-4"></div>
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Your Points</h2>
                <p class="text-4xl font-bold text-primary mt-2">1,250</p>
                <!--<p class="text-sm text-gray-600 dark:text-gray-300 mt-1">+50 today</p>-->
                
                <!-- Progress Bar -->
                
            </div>
            <div class="bg-gradient-to-r from-primary to-secondary rounded-xl shadow-lg p-6 flex flex-col items-center justify-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-6 -mt-6"></div>
                <i class="fas fa-gift text-white text-3xl mb-2"></i>
                <button onclick="openModal()" class="bg-white dark:bg-gray-200 text-primary px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all w-full max-w-sm transform hover:scale-105">
                    Redeem Points
                </button>
                <p class="text-white text-sm mt-2 text-center">Exchange points for airtime</p>
            </div>
        </section>

        <!-- Section 2: Tasks List -->
        <section class="space-y-4 fade-in">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Available Tasks</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-primary text-sm font-medium">10 tasks</span>
                    <div class="relative">
                        <i class="fas fa-filter text-gray-500"></i>
                    </div>
                </div>
            </div>
            
            <div class="space-y-4">
                <!-- Task 1 -->
                <div class="task-card bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 flex justify-between items-center border-l-primary">
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <span class="bg-primary bg-opacity-10 text-primary text-xs px-2 py-1 rounded-full mr-2">Easy</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400"><i class="fas fa-clock mr-1"></i>2 mins</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Read: Tech Innovations</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Article on latest gadgets</p>
                    </div>
                    <div class="text-right">
                        <p class="text-primary font-bold">+50 pts</p>
                        <button class="mt-2 bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-opacity-90 transition-all transform hover:scale-105">
                            Start Task
                        </button>
                    </div>
                </div>
                
                <!-- Task 2 -->
                <div class="task-card bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 flex justify-between items-center border-l-secondary">
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <span class="bg-secondary bg-opacity-10 text-secondary text-xs px-2 py-1 rounded-full mr-2">Medium</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400"><i class="fas fa-clock mr-1"></i>5 mins</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Complete a survey</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Share your opinion on products</p>
                    </div>
                    <div class="text-right">
                        <p class="text-primary font-bold">+100 pts</p>
                        <button class="mt-2 bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-opacity-90 transition-all transform hover:scale-105">
                            Start Task
                        </button>
                    </div>
                </div>
                
                <!-- Task 3 -->
                <div class="task-card bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 flex justify-between items-center border-l-purple-500">
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <span class="bg-purple-500 bg-opacity-10 text-purple-500 text-xs px-2 py-1 rounded-full mr-2">Medium</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400"><i class="fas fa-clock mr-1"></i>3 mins</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Install an app</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Download and open the recommended app</p>
                    </div>
                    <div class="text-right">
                        <p class="text-primary font-bold">+150 pts</p>
                        <button class="mt-2 bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-opacity-90 transition-all transform hover:scale-105">
                            Start Task
                        </button>
                    </div>
                </div>
                
                <!-- Task 4 -->
                <div class="task-card bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 flex justify-between items-center border-l-pink-500">
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <span class="bg-pink-500 bg-opacity-10 text-pink-500 text-xs px-2 py-1 rounded-full mr-2">Easy</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400"><i class="fas fa-clock mr-1"></i>1 min</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Refer a friend</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Invite friends to join Freedatasa</p>
                    </div>
                    <div class="text-right">
                        <p class="text-primary font-bold">+200 pts</p>
                        <button class="mt-2 bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-opacity-90 transition-all transform hover:scale-105">
                            Start Task
                        </button>
                    </div>
                </div>
                
                <!-- Task 5 -->
                <div class="task-card bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 flex justify-between items-center border-l-blue-500">
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <span class="bg-blue-500 bg-opacity-10 text-blue-500 text-xs px-2 py-1 rounded-full mr-2">Easy</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400"><i class="fas fa-clock mr-1"></i>2 mins</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Social media share</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Share our app on your social media</p>
                    </div>
                    <div class="text-right">
                        <p class="text-primary font-bold">+30 pts</p>
                        <button class="mt-2 bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-opacity-90 transition-all transform hover:scale-105">
                            Start Task
                        </button>
                    </div>
                </div>
                
                <!-- Add more tasks as needed -->
            </div>

            <!-- Referral Section -->
            <div class="bg-gradient-to-r from-primary to-secondary rounded-xl shadow-lg p-6 mt-6 text-center text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-6 -mt-6"></div>
                <i class="fas fa-user-friends text-3xl mb-3"></i>
                <h3 class="text-xl font-bold mb-2">Get 10 Points for Everyone You Refer!</h3>
                <p class="text-sm opacity-90 mb-4">Invite friends and earn rewards together.</p>
                <button class="bg-white text-primary px-6 py-2 rounded-lg font-semibold hover:bg-opacity-90 transition">
                    Invite Friends
                </button>
            </div>

            <!-- Copy Referral Link Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mt-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Your Referral Link</h3>
                <div class="flex items-center space-x-2 mb-4">
                    <input type="text" value="https://freedatasa.com/ref/yourcode" readonly class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 text-sm" id="refLink">
                    <button onclick="copyToClipboard()" class="bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-opacity-90 transition flex items-center">
                        <i class="fas fa-copy mr-1"></i> Copy
                    </button>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Share this link with friends to earn bonus points</p>
            </div>

            <!-- Share Links Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mt-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 text-center">Share Your Links</h3>
                <div class="flex justify-around space-x-2">
                    <a href="#" class="text-2xl hover:text-green-500 transition transform hover:scale-110">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#" class="text-2xl hover:text-blue-600 transition transform hover:scale-110">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-2xl hover:text-blue-400 transition transform hover:scale-110">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-2xl hover:text-blue-500 transition transform hover:scale-110">
                        <i class="fab fa-telegram"></i>
                    </a>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-2">Share on social media to earn more points</p>
            </div>
        </section>
    </main>

    <!-- Floating Action Button 
    <div class="floating-action md:hidden" onclick="openModal()">
        <i class="fas fa-gift text-white text-xl"></i>
    </div> -->

    <!-- Redeem Modal -->
    <div id="redeemModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4" onclick="closeModal(event)">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto slide-in" onclick="event.stopPropagation()">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Redeem Points</h2>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="mb-4 p-4 bg-primary bg-opacity-10 rounded-lg">
                    <p class="text-primary font-medium text-center">Your Balance: <span class="font-bold">1,250 points</span></p>
                </div>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Your Network</label>
                        <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
                            <option>Select Network</option>
                            <option>MTN</option>
                            <option>Airtel</option>
                            <option>Glo</option>
                            <option>9mobile</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Bundle Package</label>
                        <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
                            <option>Select Package</option>
                            <option>500MB for 250pts</option>
                            <option>1GB for 500pts</option>
                            <option>2GB for 1000pts</option>
                            <option>5GB for 2500pts</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Enter Your Mobile Number</label>
                        <input type="tel" placeholder="e.g., 08012345678" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700">
                    </div>
                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-md font-semibold hover:bg-opacity-90 transition flex items-center justify-center">
                        <i class="fas fa-gift mr-2"></i> Redeem Now
                    </button>
                </form>
                <button onclick="closeModal()" class="mt-4 w-full text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Navigation - Hidden on desktop -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 md:hidden shadow-lg bottom-nav z-40">
        <div class="flex justify-around py-2">
            <a href="#" class="flex flex-col items-center text-primary active-tab">
                <i class="fas fa-home text-lg"></i>
                <span class="text-xs mt-1">Home</span>
            </a>
            <a href="#" class="flex flex-col items-center text-gray-600 dark:text-gray-300 hover:text-secondary">
                <i class="fas fa-gift text-lg"></i>
                <span class="text-xs mt-1">Redeem</span>
            </a>
            <a href="#" class="flex flex-col items-center text-gray-600 dark:text-gray-300 hover:text-secondary">
                <i class="fas fa-user text-lg"></i>
                <span class="text-xs mt-1">Profile</span>
            </a>
            <a href="#" class="flex flex-col items-center text-gray-600 dark:text-gray-300 hover:text-secondary">
                <i class="fas fa-sign-out-alt text-lg"></i>
                <span class="text-xs mt-1">Logout</span>
            </a>
        </div>
    </nav>

    <!-- JavaScript for Modal, Copy, and Menu -->
    <script>
        // Menu functionality
        function toggleMenu() {
            const menuContainer = document.getElementById('menuContainer');
            const menuOverlay = document.getElementById('menuOverlay');
            
            if (menuContainer.classList.contains('open')) {
                menuContainer.classList.remove('open');
                menuOverlay.style.display = 'none';
            } else {
                menuContainer.classList.add('open');
                menuOverlay.style.display = 'block';
            }
        }
        
        // Initialize menu toggle button
        document.getElementById('menuToggle').addEventListener('click', toggleMenu);
        
        // Navigation functions
        function navigateTo(page) {
            toggleMenu(); // Close menu first
            switch(page) {
                case 'profile':
                    showToast('Navigating to Profile');
                    break;
                case 'redeem':
                    openModal();
                    break;
                case 'about':
                    showToast('Navigating to About Us');
                    break;
                case 'contact':
                    showToast('Navigating to Contact Us');
                    break;
            }
        }
        
        function logout() {
            toggleMenu(); // Close menu first
            if (confirm('Are you sure you want to logout?')) {
                showToast('Logging out...');
                // In a real app, you would redirect to logout endpoint
                setTimeout(() => {
                    window.location.href = '/login';
                }, 1000);
            }
        }
        
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

        function copyToClipboard() {
            const refLink = document.getElementById('refLink');
            refLink.select();
            refLink.setSelectionRange(0, 99999); // For mobile
            navigator.clipboard.writeText(refLink.value).then(() => {
                // Show a toast notification
                showToast('Referral link copied to clipboard!');
            });
        }

        function showToast(message) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-24 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg z-50 fade-in';
            toast.textContent = message;
            
            // Add to page
            document.body.appendChild(toast);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        // Add active state to bottom nav items
        document.querySelectorAll('.bottom-nav a').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.bottom-nav a').forEach(nav => {
                    nav.classList.remove('active-tab');
                    nav.classList.add('text-gray-600', 'dark:text-gray-300');
                });
                this.classList.add('active-tab');
                this.classList.remove('text-gray-600', 'dark:text-gray-300');
            });
        });

        // PWA Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => console.log('SW registered: ', registration))
                    .catch(registrationError => console.log('SW registration failed: ', registrationError));
            });
        }

        // Add animation to task cards when they come into view
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
</body>
</html>