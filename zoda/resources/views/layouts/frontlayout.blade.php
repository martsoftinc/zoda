<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Readify.africa - Easiest and simpliest way to Make money online by reading articles. ">
    <meta name="keywords" content="make money online, reading articles, earn money, passive income, Readify.africa">
    <title>Readify.africa - Make money online reading articles</title>

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="Readify.africa">
    <meta name="twitter:title" content="Earn cash and free data bundles by reading articles">
    <meta name="twitter:description" content="Join Readify.africa to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta name="twitter:image" content="{{ asset('assets/img/banner.png') }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="readify.africa">
    <meta property="og:title" content="Earn cash and free data bundles by reading articles">
    <meta property="og:description" content="Join Readify.africa to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta property="og:image" content="{{ asset('assets/img/banner.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">


    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Apple Touch Icon (for iOS devices) -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon-180x180.png') }}">
    <!-- Microsoft Windows Tiles -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-16x16.png') }}" sizes="16x16">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* Light Slate 50 */
        }
        /* Custom animation for fade-in-up */
        @keyframes fadeInMoveUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInMoveUp 0.8s ease-out forwards;
        }
        .delay-200 {
            animation-delay: 0.2s;
        }
        .delay-400 {
            animation-delay: 0.4s;
        }
    </style>
</head>
<body class="antialiased text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-sm py-4 px-6 md:px-10 lg:px-16 sticky top-0 z-50">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <!-- Logo/Brand Name -->
                <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <a href="/" class="font-bold text-xl text-gray-900 hover:text-blue-600">
  Readify.africa
</a>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="https://forms.gle/x16E5ByZJ9t6Hic38" class="text-gray-600 hover:text-indigo-600 transition duration-300">Advertiser</a>
                <a href="https://youtu.be/2NRJ2OuE4nM" class="text-gray-600 hover:text-indigo-600 transition duration-300">How it Works</a>
            
                <a href="contact" class="text-gray-600 hover:text-indigo-600 transition duration-300">Contact</a>
            </div>
            <div class="hidden md:block">
                <a href="/login" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-5 rounded-lg shadow-md transition duration-300">Login/Register</a>

            </div>
            <!-- Mobile Menu Button (Hamburger) -->
            <button class="md:hidden text-gray-600 hover:text-indigo-600 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>
        
    </header>

    
@yield('content')

    <!-- Call to Action Section -->
    <section class="bg-gradient-to-r from-purple-600 to-indigo-500 text-white py-16 px-6 md:px-10 lg:px-16 text-center">
        <div class="container mx-auto max-w-3xl">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Start Earning?</h2>
            <p class="text-lg mb-8 opacity-90">Join millions of readers who are already turning their passion into profit.</p>
            <a href="signup-publisher" class="inline-block bg-white text-indigo-600 hover:bg-gray-100 font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition duration-300">
                Sign Up Now - It's Free!
            </a>
        </div>
    </section>

<section class="bg-gradient-to-r from-blue-600 to-teal-500 text-white py-16 px-6 md:px-10 lg:px-16 text-center">

        <div class="container mx-auto max-w-3xl">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Looking to increase traffic to your website? Advertise with us.</h2>
            <a href="https://forms.gle/7abGKRMRxXC2iHza8" class="inline-block bg-white text-indigo-600 hover:bg-gray-100 font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition duration-300">
                Fill the form!
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-10 px-6 md:px-10 lg:px-16">
        <div class="container mx-auto text-center md:flex md:justify-between md:items-center">
            <div class="mb-4 md:mb-0">
                <p>&copy; 2026 Readify.africa. All rights reserved.</p>
            </div>
            <div class="flex justify-center space-x-6">
                <a href="privacy" class="hover:text-white transition duration-300">Privacy Policy</a>
                <a href="terms" class="hover:text-white transition duration-300">Terms of Service</a>
                <a href="about" class="hover:text-white transition duration-300">About</a>
            </div>
        </div>
    </footer>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('.md\\:hidden');
        const mobileMenu = document.createElement('div');
        
        // Create mobile menu content with close button
        mobileMenu.innerHTML = `
            <div class="md:hidden fixed inset-0 bg-white z-50 transform translate-x-full transition-transform duration-300">
                <div class="flex justify-end p-6">
                    <button class="text-gray-600 hover:text-indigo-600 focus:outline-none close-menu-btn">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col space-y-6 px-6 pb-6">
                    <a href="#" class="text-gray-600 hover:text-indigo-600 text-lg font-medium transition duration-300">Articles</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 text-lg font-medium transition duration-300">How it Works</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 text-lg font-medium transition duration-300">Payments</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 text-lg font-medium transition duration-300">Contact</a>
                    <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-5 rounded-lg shadow-md transition duration-300 text-center">Login / Signup</a>
                </div>
            </div>
        `;
        
        // Add mobile menu to body
        document.body.appendChild(mobileMenu);
        const mobileMenuContent = mobileMenu.querySelector('div');
        
        // Toggle menu function
        function toggleMenu() {
            mobileMenuContent.classList.toggle('translate-x-full');
            mobileMenuContent.classList.toggle('translate-x-0');
            
            // Toggle body overflow to prevent scrolling when menu is open
            document.body.style.overflow = mobileMenuContent.classList.contains('translate-x-0') ? 'hidden' : '';
        }
        
        // Event listener for menu button
        mobileMenuButton.addEventListener('click', toggleMenu);
        
        // Event listener for close button
        const closeButton = mobileMenu.querySelector('.close-menu-btn');
        closeButton.addEventListener('click', toggleMenu);
        
        // Close menu when clicking on a link
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', toggleMenu);
        });
        
        // Close menu when clicking outside of it
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                toggleMenu();
            }
        });
    });
</script>
</body>
</html>
