<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readify.africa - Earn Money Reading Articles</title>
    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#10b981">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Readify.africa">
    <link rel="apple-touch-icon" href="icon-192.png">
    <link rel="manifest" href="manifest.json">

    <!-- pwa::meta -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="{{ config('pwa.manifest.theme_color') }}">
    <meta name="apple-mobile-web-app-capable" content="yes"> <!-- iOS support -->
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="apple-touch-icon" href="{{ asset('images/icon-192.png') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            //darkMode: false,  
            theme: {
                extend: {
                    colors: {
                        primary: '#10b981', 
                        secondary: '#f59e0b', 
                        danger: '#ef4444',
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
        
        /* Desktop Sidebar */
        .desktop-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 40;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .dark .desktop-sidebar {
            background: #1f2937;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
        }
        
        .desktop-sidebar.hidden {
            transform: translateX(-100%);
        }
        
        .desktop-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        
        .desktop-content.full-width {
            margin-left: 0;
        }
        
        @media (max-width: 768px) {
            .desktop-sidebar {
                transform: translateX(-100%);
            }
            
            .desktop-content {
                margin-left: 0;
            }
        }
        
        /* Mobile Menu */
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
        
        .dark .menu-container {
            background: #1f2937;
        }
        
        .menu-container.open {
            right: 0;
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
            background: #1f2937;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.2s;
            cursor: pointer;
            background: white;
        }
        
        .dark .menu-item {
            border-bottom: 1px solid #374151;
            background: #1f2937;
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
        
        .sidebar-toggle {
            position: fixed;
            left: 10px;
            top: 10px;
            z-index: 45;
            background: #10b981;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle:hover {
            transform: scale(1.1);
        }
        
        .withdraw-btn {
            background: linear-gradient(to right, #ef4444, #f87171);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .withdraw-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
        }
</style>
        <style>
.plan-card {
    @apply p-3 border-2 border-gray-200 dark:border-gray-700 rounded-xl cursor-pointer transition-all duration-300 hover:border-red-500 hover:shadow-lg bg-white dark:bg-gray-800 relative;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.plan-card.selected {
    @apply border-red-500 bg-gradient-to-r from-red-500/10 to-red-400/10 dark:from-red-500/20 dark:to-red-400/20 shadow-lg;
    border-width: 3px !important;
}

.plan-card .selected-badge {
    @apply absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full;
    display: none;
}

.plan-card.selected .selected-badge {
    display: block;
}

/* Fixed: Much better contrast for dark mode */
.plan-card .plan-name {
    @apply font-bold text-gray-900 dark:text-gray-100 text-lg mb-1;
}

.plan-card .plan-data {
    @apply text-sm text-gray-700 dark:text-gray-300 mb-2;
}

.plan-card .plan-points {
    @apply font-bold text-red-600 dark:text-red-400 text-lg;
}

.plan-card .availability-badge {
    @apply text-xs px-2 py-1 rounded-full mt-1 font-medium;
}

.plan-card .availability-badge.available {
    @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100;
}

.plan-card .availability-badge.unavailable {
    @apply bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100;
}

/* Enhanced selected state for better visibility */
.plan-card.selected .plan-name {
    @apply text-red-700 dark:text-red-300 font-extrabold;
}

.plan-card.selected .plan-points {
    @apply text-red-700 dark:text-red-300 font-extrabold;
}

/* Mobile responsiveness */
@media (max-width: 640px) {
    .plan-card {
        min-height: 110px;
        padding: 0.75rem;
    }
    
    .plan-card .plan-name {
        font-size: 0.9rem;
        font-weight: 700;
    }
    
    .plan-card .plan-data {
        font-size: 0.75rem;
    }
    
    .plan-card .plan-points {
        font-size: 0.85rem;
        font-weight: 700;
    }
}
</style>
    
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">

    <button id="installPwaBtn" onclick="installPWA()" class="hidden bg-gradient-to-r from-primary to-secondary text-white px-4 py-2 rounded-xl font-bold">
    <i class="fas fa-download mr-2"></i>Install App
    </button>
    <!-- Desktop Sidebar -->
    <div id="desktopSidebar" class="desktop-sidebar bg-white dark:bg-gray-800">
        <!-- Logo and User Info -->
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h3 class="text-lg font-bold">{{ auth()->user()->name }}</h3>
            @if($credit ?? false)
                <p class="text-sm opacity-90">Points: {{ $credit->credit ?? 0 }}</p>
            @else
                <p class="text-sm opacity-90">Welcome!</p>
            @endif
        </div>
        
        <!-- Navigation Menu -->
        <div class="py-2 bg-white dark:bg-gray-800">
            <a href="/publisher" class="menu-item bg-white dark:bg-gray-800">
                <i class="fas fa-home text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Dashboard</span>
            </a>
            <a href="/profile" class="menu-item bg-white dark:bg-gray-800">
                <i class="fas fa-user text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Profile</span>
            </a>
            <a href="/payments" class="menu-item bg-white dark:bg-gray-800">
                <i class="fas fa-dollar-sign text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">History</span>
            </a>
            <a href="/referrals" class="menu-item bg-white dark:bg-gray-800">
                <i class="fas fa-users text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Referrals</span>
                
            </a>
            <!-- Redeem Link in Sidebar -->
            <a href="/redeem" class="menu-item bg-white dark:bg-gray-800">
                <i class="fas fa-money-bill-wave text-danger"></i>
                <span class="text-gray-900 dark:text-white font-semibold">Redeem</span>
               
            </a>
            <a href="/contact" class="menu-item bg-white dark:bg-gray-800">
                <i class="fas fa-envelope text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Support</span>
            </a>
            <div class="menu-item bg-white dark:bg-gray-800" onclick="logout()">
                <i class="fas fa-sign-out-alt text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Logout</span>
            </div>
        </div>
        
        <!-- App Info -->
        <div class="p-4 mt-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">APP VERSION</h3>
            <p class="text-xs text-gray-600 dark:text-gray-300">Readify.africa v2.0</p>
        </div>
    </div>
    
    <!-- Sidebar Toggle Button (Desktop) -->
    <div class="sidebar-toggle hidden md:block" onclick="toggleDesktopSidebar()">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Mobile Menu Overlay and Container -->
    <div id="menuOverlay" class="menu-overlay md:hidden" onclick="toggleMenu()"></div>
    <div id="menuContainer" class="menu-container md:hidden bg-white dark:bg-gray-800">
        <div class="menu-header bg-white dark:bg-gray-800">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Menu</h2>
            <button onclick="toggleMenu()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h3 class="text-lg font-bold">{{ auth()->user()->name }}</h3>
            @if($credit ?? false)
                <p class="text-sm opacity-90">{{ $credit->credit ?? 0 }} points</p>
            @endif
        </div>
        
        <div class="py-2 bg-white dark:bg-gray-800">
            <a href="/publisher" class="menu-item bg-white dark:bg-gray-800" onclick="toggleMenu()">
                <i class="fas fa-home text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Dashboard</span>
            </a>
            <a href="/profile" class="menu-item bg-white dark:bg-gray-800" onclick="toggleMenu()">
                <i class="fas fa-user text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Profile</span>
            </a>
            <a href="/payments" class="menu-item bg-white dark:bg-gray-800" onclick="toggleMenu()">
                <i class="fas fa-dollar-sign text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">History</span>
            </a>
            <a href="/referrals" class="menu-item bg-white dark:bg-gray-800" onclick="toggleMenu()">
                <i class="fas fa-users text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Referrals</span>
            </a>
            <a href="/redeem" class="menu-item bg-white dark:bg-gray-800" onclick="toggleMenu();">
                <i class="fas fa-money-bill-wave text-danger"></i>
                <span class="text-gray-900 dark:text-white font-semibold">Redeem</span>
              
            </a>
            <a href="/contact" class="menu-item bg-white dark:bg-gray-800" onclick="toggleMenu()">
                <i class="fas fa-envelope text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Support</span>
            </a>
            <div class="menu-item bg-white dark:bg-gray-800" onclick="logout()">
                <i class="fas fa-sign-out-alt text-gray-600 dark:text-gray-400"></i>
                <span class="text-gray-900 dark:text-white">Logout</span>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div id="mainContent" class="desktop-content min-h-screen">
        @yield('content')
    </div>

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
        
        // Desktop sidebar functionality
        function toggleDesktopSidebar() {
            const sidebar = document.getElementById('desktopSidebar');
            const mainContent = document.getElementById('mainContent');
            
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                mainContent.classList.remove('full-width');
            } else {
                sidebar.classList.add('hidden');
                mainContent.classList.add('full-width');
            }
        }
        
        // Close mobile menu on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const menuContainer = document.getElementById('menuContainer');
                const menuOverlay = document.getElementById('menuOverlay');
                menuContainer.classList.remove('open');
                menuOverlay.style.display = 'none';
            }
        });
        
        // Show mobile menu button on desktop header
        document.getElementById('menuToggle').addEventListener('click', toggleMenu);
        
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '{{ route("logout") }}';
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to task cards
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
        });
    </script>

    @if(config('pwa.serviceWorker.cache'))
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => console.log('SW registered: ', registration))
                    .catch(registrationError => console.log('SW registration failed: ', registrationError));
            });
        }
    </script>
@endif

<script>
    let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent default prompt
    e.preventDefault();
    deferredPrompt = e;
    // Show a button in your header (e.g., add to the right column)
    const installBtn = document.getElementById('installPwaBtn');
    if (installBtn) installBtn.style.display = 'block';
});

// Button click handler
function installPWA() {
    if (deferredPrompt) {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('User accepted the install prompt');
            }
            deferredPrompt = null;
        });
    }
}
</script>
</body>
</html>