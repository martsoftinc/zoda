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
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">Redeem Data Bundle</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 hidden md:block">Exchange your points for data bundles</p>
            </div>
        </div>
        
        <!-- Points Display -->
        <div class="flex items-center space-x-4">
            <div class="hidden md:flex items-center bg-gradient-to-r from-primary/10 to-secondary/10 px-4 py-2 rounded-xl">
                <i class="fas fa-coins text-secondary mr-2"></i>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Your Points</p>
                    @php
                        $userPoints = $credit->credit ?? 0;
                    @endphp
                    <p class="text-lg font-bold text-primary">{{ $userPoints }} pts</p>
                </div>
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
    
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-4 fade-in" role="alert">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle mt-0.5 mr-3"></i>
                <div>
                    <p class="font-medium mb-2">Please fix the following errors:</p>
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Main Content -->
<main class="p-4 md:p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Exchange Points for Data</h2>
                <div class="w-12 h-12 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-wifi text-primary text-xl"></i>
                </div>
            </div>

            <form action="{{ route('topup.send') }}" method="POST" id="dataBundleForm">
                @csrf

                <!-- Recipient Information -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-mobile-alt text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recipient Details</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Recipient Phone -->
                        <div>
                            <label for="recipient_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-phone mr-2 text-gray-400"></i>Phone Number
                            </label>
                            <div class="relative">
                                <div class="flex">
                                    <div class="flex items-center justify-center px-3 bg-gray-100 dark:bg-gray-700 border-2 border-r-0 border-gray-200 dark:border-gray-600 rounded-l-xl">
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">+251</span>
                                    </div>
                                    <input type="text" 
                                           id="recipient_phone" 
                                           name="recipient_phone" 
                                           value="{{ old('recipient_phone') }}"
                                           class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-r-xl rounded-l-none bg-white dark:bg-gray-800 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-gray-900 dark:text-white"
                                           placeholder="912345678"
                                           required
                                           oninput="formatEthiopiaPhoneNumber(this)">
                                </div>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Enter Ethiopia phone number starting with 91, 92, 93, 94, 95, 96, 97, 98, 99
                            </p>
                        </div>

                        <!-- Hidden field for formatted phone (will be set by JavaScript) -->
                        <input type="hidden" id="formatted_phone" name="formatted_phone" value="">
                        
                        <!-- Recipient Country (Hidden, default to Ethiopia) -->
                        <input type="hidden" name="recipient_country" value="ET">
                        
                        <!-- Network Selection -->
                        <div>
                            <label for="network" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-network-wired mr-2 text-gray-400"></i>Select Network
                            </label>
                            <div class="relative">
                                <select id="network" 
                                        name="network"
                                        class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition appearance-none text-gray-900 dark:text-white"
                                        required
                                        onchange="updateDataPlans()">
                                    <option value="" disabled selected class="text-gray-900 dark:text-white">Choose a network</option>
                                    <option value="ethio_telecom" data-name="128" class="text-gray-900 dark:text-white">Ethio Telecom</option>
                                    <option value="safaricom_et" data-name="129" class="text-gray-900 dark:text-white">Safaricom Ethiopia</option>
                                </select>
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <!-- Hidden input for network name -->
                            <input type="hidden" id="network_name" name="network_name" value="">
                        </div>
                    </div>
                </div>

                <!-- Data Bundle Selection -->
                <div class="mb-8" id="dataPlansSection" style="display: none;">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-400 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-database text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Select Data Plan</h3>
                    </div>
                    
                    <!-- Data Plans Grid - 3 columns on mobile -->
                    <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-3 mb-6" id="plansContainer">
                        <!-- Plan cards will be dynamically inserted here -->
                    </div>
                    
                    <!-- Selected Plan Display -->
                    <div id="selectedPlanDisplay" class="hidden p-4 bg-gradient-to-r from-red-500/20 to-red-400/20 dark:from-red-500/30 dark:to-red-400/30 border-2 border-red-500 rounded-xl mb-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <h4 class="font-bold text-gray-900 dark:text-white text-lg" id="selectedPlanName">No plan selected</h4>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 ml-6" id="selectedPlanNetwork"></p>
                               <p class="text-xs text-gray-500 dark:text-gray-400 ml-6" id="selectedPlanAmount"></p> 
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-red-500" id="selectedPlanPoints">0 pts</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400" id="selectedPlanData">0 MB</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hidden inputs for selected plan -->
                    <input type="hidden" id="selected_plan_name" name="operator_id">
                    <input type="hidden" id="selected_plan_data" name="plan_data">
                    <input type="hidden" id="selected_plan_points" name="plan_points">
                    <input type="hidden" id="selected_plan_amount" name="amount">
                    <input type="hidden" name="country_code" id="countryCode" value="ET">


                </div>

                <!-- Points Information -->
                <div class="mb-8">
                    <div class="bg-gradient-to-br from-primary to-secondary rounded-xl p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-bold">Your Points Balance</h3>
                                <p class="text-white/90 text-sm">Exchange points for data bundles</p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold">{{ $userPoints }}</p>
                                <p class="text-sm opacity-90">points</p>
                            </div>
                        </div>
                        
                        <div id="pointsInfo" class="hidden">
                            <div class="flex items-center justify-between py-3 border-t border-white/20">
                                <span>Selected plan cost:</span>
                                <span class="font-bold" id="planCost">0 points</span>
                            </div>
                            <div class="hidden flex items-center justify-between py-3 border-t border-white/20">
                                <span>Plan amount:</span>
                                <span class="font-bold" id="planAmount">$0.00</span>
                            </div> 
                            <div class="flex items-center justify-between py-3 border-t border-white/20">
                                <span>Your balance after:</span>
                                <span class="font-bold" id="remainingPoints">{{ $userPoints }} points</span>
                            </div>
                        </div>
                    </div>
                    
                    @if($userPoints < 50)
                        <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 mr-3"></i>
                                <div>
                                    <p class="font-medium text-red-800 dark:text-red-300">Insufficient Points</p>
                                    <p class="text-sm text-red-700 dark:text-red-400 mt-1">
                                        You need at least 50 points to redeem your data bundle. Complete more tasks to earn points!
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        id="submitBtn"
                        class="w-full bg-gradient-to-r from-red-500 to-red-400 text-white py-4 rounded-xl font-bold text-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105 active:scale-95 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                    <i class="fas fa-shopping-cart mr-3"></i>
                    Redeem Data Bundle
                </button>
            </form>
        </div>

        <!-- How It Works -->
        <div class="mt-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 text-center">How It Works</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-primary text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">1. Enter Details</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Enter phone number and select network
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-blue-500/10 to-blue-400/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-database text-blue-500 text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">2. Choose Plan</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Select data bundle from available options
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-green-500/10 to-green-400/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-bolt text-green-500 text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">3. Instant Delivery</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Data delivered instantly to recipient
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.plan-card {
    @apply p-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl cursor-pointer transition-all duration-300 hover:border-red-500 hover:shadow-lg bg-white dark:bg-gray-800 relative;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.plan-card.selected {
    @apply border-red-500 bg-gradient-to-r from-red-500/10 to-red-400/10 dark:from-red-500/20 dark:to-red-400/20 shadow-lg;
}

.plan-card .selected-badge {
    @apply absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full;
    display: none;
}

.plan-card.selected .selected-badge {
    display: block;
}

.plan-card .plan-name {
    @apply font-bold text-gray-900 dark:text-white text-base mb-1;
}

.plan-card .plan-data {
    @apply text-xs text-gray-500 dark:text-gray-400 mb-2;
}

.plan-card .plan-points {
    @apply font-bold text-red-500 text-sm;
}

.plan-card .availability-badge {
    @apply text-xs px-1.5 py-0.5 rounded-full mt-1;
}

/* Mobile responsiveness */
@media (max-width: 640px) {
    .plan-card {
        min-height: 110px;
        padding: 0.75rem;
    }
    
    .plan-card .plan-name {
        font-size: 0.875rem;
    }
    
    .plan-card .plan-points {
        font-size: 0.75rem;
    }
}
</style>

<script>
// Data plans for each Ethiopia network with Reloadly operator IDs
const dataPlans = {
    ethio_telecom: [
        { name: '50MB', data: '50 MB', points: 50, amount: '0.50', planName: '128' },
        { name: '100MB', data: '100 MB', points: 100, amount: '1.00', planName: '128' },
        { name: '250MB', data: '250 MB', points: 200, amount: '2.00', planName: '128' },
        { name: '500MB', data: '500 MB', points: 350, amount: '3.50', planName: '128' },
        { name: '1GB', data: '1 GB', points: 500, amount: '5.00', planName: '128' },
        { name: '2GB', data: '2 GB', points: 800, amount: '8.00', planName: '128' },
        { name: '5GB', data: '5 GB', points: 1500, amount: '15.00', planName: '128' }
    ],
    safaricom_et: [
        { name: '50MB', data: '50 MB', points: 45, amount: '0.45', planName: '129' },
        { name: '100MB', data: '100 MB', points: 90, amount: '0.90', planName: '129' },
        { name: '250MB', data: '250 MB', points: 180, amount: '1.80', planName: '129' },
        { name: '500MB', data: '500 MB', points: 300, amount: '3.00', planName: '129' },
        { name: '1GB', data: '1 GB', points: 450, amount: '4.50', planName: '129' },
        { name: '2GB', data: '2 GB', points: 750, amount: '7.50', planName: '129' },
        { name: '5GB', data: '5 GB', points: 1400, amount: '14.00', planName: '129' }
    ]
};

// Network names and codes for Reloadly (Ethiopia)
const networkInfo = {
    ethio_telecom: { name: 'Ethio Telecom', code: '128' },
    safaricom_et: { name: 'Safaricom Ethiopia', code: '129' }
};

let selectedPlan = null;
let selectedNetwork = null;
let userPoints = {{ $userPoints }};

// Format Ethiopia phone number for display (now only accepts 9 digits after +251)
function formatEthiopiaPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    
    // Limit to 9 digits maximum (Ethiopia numbers are 9 digits after 251)
    if (value.length > 9) {
        value = value.substring(0, 9);
    }
    
    input.value = value;
}

// Update data plans based on selected network
function updateDataPlans() {
    const networkSelect = document.getElementById('network');
    const selectedOption = networkSelect.options[networkSelect.selectedIndex];
    const network = networkSelect.value;
    const networkCode = selectedOption.getAttribute('data-name');
    
    const plansContainer = document.getElementById('plansContainer');
    const dataPlansSection = document.getElementById('dataPlansSection');
    const networkNameInput = document.getElementById('network_name');
    
    if (!network) {
        dataPlansSection.style.display = 'none';
        resetSelection();
        selectedNetwork = null;
        networkNameInput.value = '';
        return;
    }
    
    // Set network code in hidden input
    networkNameInput.value = networkCode;
    selectedNetwork = networkInfo[network];
    dataPlansSection.style.display = 'block';
    plansContainer.innerHTML = '';
    
    const plans = dataPlans[network];
    const networkName = networkInfo[network].name;
    
    // Create plan cards
    plans.forEach((plan, index) => {
        const planCard = document.createElement('div');
        planCard.className = 'plan-card';
        planCard.dataset.index = index;
        planCard.dataset.amount = plan.amount;
        planCard.dataset.planName = plan.planName;
        planCard.onclick = function() {
            selectPlan.call(this, plan, networkName);
        };
        
        const isAvailable = userPoints >= plan.points;
        
        planCard.innerHTML = `
            <span class="selected-badge">Selected</span>
            <div class="text-center">
                <h4 class="plan-name">${plan.name}</h4>
                <p class="plan-data">${plan.data}</p>
                <div class="flex items-center justify-center">
                    <i class="fas fa-coins ${isAvailable ? 'text-yellow-500' : 'text-gray-400'} mr-1 text-xs"></i>
                    <span class="plan-points ${!isAvailable ? 'text-gray-400' : ''}">${plan.points} pts</span>
                </div>
                <div class="mt-1">
                    <span class="availability-badge ${isAvailable ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'}">
                        ${isAvailable ? 'Available' : 'Need more points'}
                    </span>
                </div>
            </div>
        `;
        
        plansContainer.appendChild(planCard);
    });
    
    resetSelection();
}

// Select a data plan
function selectPlan(plan, networkName) {
    // Check if user has enough points
    if (userPoints < plan.points) {
        showToast(`You need ${plan.points} points for this plan. You have only ${userPoints} points.`, 'error');
        return;
    }
    
    // Remove selected class from all cards
    document.querySelectorAll('.plan-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Add selected class to clicked card
    this.classList.add('selected');
    
    selectedPlan = { 
        ...plan, 
        network: networkName,
        networkCode: selectedNetwork.code
    };
    
    // Update selected plan display
    const display = document.getElementById('selectedPlanDisplay');
    const planNameElement = document.getElementById('selectedPlanName');
    const planNetworkElement = document.getElementById('selectedPlanNetwork');
    const planAmountElement = document.getElementById('selectedPlanAmount');
    const planPointsElement = document.getElementById('selectedPlanPoints');
    const planDataElement = document.getElementById('selectedPlanData');
    
    display.classList.remove('hidden');
    planNameElement.textContent = plan.name;
    planNetworkElement.textContent = networkName;
    planPointsElement.textContent = plan.points + ' pts';
    planDataElement.textContent = plan.data;
    
    // Update hidden inputs
    document.getElementById('selected_plan_name').value = plan.planName;
    document.getElementById('selected_plan_data').value = plan.data;
    document.getElementById('selected_plan_points').value = plan.points;
    document.getElementById('selected_plan_amount').value = plan.amount;
    
    // Update points info
    const pointsInfo = document.getElementById('pointsInfo');
    const planCost = document.getElementById('planCost');
    const planAmount = document.getElementById('planAmount');
    const remainingPoints = document.getElementById('remainingPoints');
    
    pointsInfo.classList.remove('hidden');
    planCost.textContent = plan.points + ' points';
    planAmount.textContent = `$${plan.amount}`;
    remainingPoints.textContent = (userPoints - plan.points) + ' points';
    
    // Enable submit button
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = false;
    submitBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
}

// Reset selection
function resetSelection() {
    selectedPlan = null;
    document.getElementById('selectedPlanDisplay').classList.add('hidden');
    document.getElementById('pointsInfo').classList.add('hidden');
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('submitBtn').classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed');
    
    // Clear hidden inputs
    document.getElementById('selected_plan_name').value = '';
    document.getElementById('selected_plan_data').value = '';
    document.getElementById('selected_plan_points').value = '';
    document.getElementById('selected_plan_amount').value = '';
    
    // Remove selected class from all cards
    document.querySelectorAll('.plan-card').forEach(card => {
        card.classList.remove('selected');
    });
}

// Convert phone number to full 251 format for backend
function convertTo251Format(phone) {
    phone = phone.replace(/\D/g, '');
    
    // Phone should be 9 digits after the +251 prefix
    // We're already showing +251 as a fixed prefix, so user only enters 9 digits
    if (phone.length === 9) {
        return '251' + phone;
    }
    // If user somehow enters 10 digits (with leading 0), remove the 0
    else if (phone.length === 10 && phone.startsWith('0')) {
        return '251' + phone.substring(1);
    }
    // If user enters 12 digits (251 + 9), it's already in correct format
    else if (phone.length === 12 && phone.startsWith('251')) {
        return phone;
    }
    
    return phone;
}

// Form validation for Ethiopia
document.getElementById('dataBundleForm').addEventListener('submit', function(e) {
    const recipientPhoneInput = document.getElementById('recipient_phone');
    let recipientPhone = recipientPhoneInput.value.replace(/\D/g, '');
    const formattedPhoneInput = document.getElementById('formatted_phone');
    const network = document.getElementById('network').value;
    const selectedPlanPoints = document.getElementById('selected_plan_points').value;
    const planAmount = document.getElementById('selected_plan_amount').value;
    
    // Phone validation for Ethiopia
    if (!recipientPhone) {
        e.preventDefault();
        showToast('Please enter a phone number', 'error');
        return false;
    }
    
    // Convert to full 251 format for backend
    const phoneForBackend = convertTo251Format(recipientPhone);
    
    // Validate final format is exactly 12 digits (251 + 9 digits)
    if (!/^251\d{9}$/.test(phoneForBackend)) {
        e.preventDefault();
        showToast('Please enter a valid Ethiopia phone number (9 digits after +251)', 'error');
        return false;
    }
    
    // Validate Ethiopia mobile prefixes (now checking the 9-digit number)
    const prefix = phoneForBackend.substring(3, 5); // Get the 2 digits after 251
    const validPrefixes = ['91', '92', '93', '94', '95', '96', '97', '98', '99', '90', '80'];
    
    if (!validPrefixes.includes(prefix)) {
        e.preventDefault();
        showToast('Please enter a valid Ethiopia mobile number (Ethio Telecom or Safaricom)', 'error');
        return false;
    }
    
    // Set the formatted value to the hidden field
    formattedPhoneInput.value = phoneForBackend;
    
    // Network validation
    if (!network) {
        e.preventDefault();
        showToast('Please select a network', 'error');
        return false;
    }
    
    // Plan validation
    if (!selectedPlanPoints) {
        e.preventDefault();
        showToast('Please select a data plan', 'error');
        return false;
    }
    
    if (!planAmount) {
        e.preventDefault();
        showToast('Plan amount is missing', 'error');
        return false;
    }
    
    const planPoints = parseInt(selectedPlanPoints);
    if (userPoints < planPoints) {
        e.preventDefault();
        showToast('Insufficient points for this data plan', 'error');
        return false;
    }
    
    // Show loading state
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Processing...';
    submitBtn.disabled = true;
    
    // Re-enable after 10 seconds if still on page (fallback)
    setTimeout(() => {
        if (submitBtn.disabled) {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }, 10000);
    
    return true;
});

// Toast notification
function showToast(message, type = 'info') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white transform translate-x-full transition-transform duration-300 ${
        type === 'error' ? 'bg-red-500' : 
        type === 'success' ? 'bg-green-500' : 
        'bg-blue-500'
    }`;
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${
                type === 'error' ? 'fa-exclamation-circle' : 
                type === 'success' ? 'fa-check-circle' : 
                'fa-info-circle'
            } mr-3"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 10);
    
    // Remove after 5 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 5000);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Auto-focus phone field
    const phoneInput = document.getElementById('recipient_phone');
    const formattedPhoneInput = document.getElementById('formatted_phone');
    
    // If there's an existing value in 251 format in the hidden field, extract just the 9 digits for display
    if (formattedPhoneInput.value && formattedPhoneInput.value.startsWith('251')) {
        const digitsOnly = formattedPhoneInput.value.substring(3);
        phoneInput.value = digitsOnly;
    }
    
    phoneInput.focus();
    
    // Set cursor to end of input if there's existing value
    if (phoneInput.value) {
        phoneInput.selectionStart = phoneInput.selectionEnd = phoneInput.value.length;
    }
    
    // Set default country to Ethiopia
    document.getElementById('recipient_country').value = 'ET';
    document.getElementById('countryCode').value = 'ET';
    
    // Listen for network selection changes
    document.getElementById('network').addEventListener('change', updateDataPlans);
    
    // Add data-name attributes to network options
    const networkOptions = document.querySelectorAll('#network option');
    networkOptions.forEach(option => {
        if (option.value) {
            const networkCode = networkInfo[option.value]?.code;
            if (networkCode) {
                option.setAttribute('data-name', networkCode);
            }
        }
    });
});
</script>

@endsection