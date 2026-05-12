<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\publisherController;
use App\Http\Controllers\advertiserController;
use App\Http\Controllers\loginController;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\MomoWithdrawalController;
use App\Http\Controllers\BinanceWithdrawalController;
use App\Http\Controllers\CashoutController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\Nigeriabankcontroller;
use App\Http\Controllers\SouthAfricaBankController;
use Laravel\Socialite\Facades\Socialite;


Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/nigeria', function () {
    return view('user.redeemcash.nigeria');
});


Route::get('/tutorial', function () {
    return view('tutorial');
})->name('tutorial');
/*
Route::get('/signup-publisher', function () {
    return view('registerpub');
});

*/












#Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/auth/google/{referralCode?}', [AuthController::class, 'redirectToGoogleWithReferral'])->name('google.login');




Route::get('/refresh-task-list', [PublisherController::class, 'refreshTaskList'])->name('refreshTaskList');
Route::get('/signup-advertiser', function () {
    return view('registeradv');
});


Route::get('/resetpassword', function () {
    return view('resetpassword');
});
Route::get('/newpassword', function () {
    return view('newpassword');
});

Route::get('/test', function () {
    return view('test');
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/terms', function () {
    return view('terms');
});
Route::get('/privacy', function () {
    return view('privacy');
});
Route::get('/home2', function () {
    return view('user.dash2');
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/test-ip', function (Request $request) {
    return response()->json([
        'ip' => $request->ip(),
        'cf_connecting_ip' => $request->header('CF-Connecting-IP'),
        'x_forwarded_for' => $request->header('X-Forwarded-For'),
    ]);
});


Route::get('/redirect/{id}', [publisherController::class, 'redirectToArticle']);

Route::get('/list-browsers', function () {
    $agent = new Agent();

    // Get all the available browsers
    $browsers = $agent->getBrowsers();

    return response()->json($browsers);
});
Route::middleware(['web'])->group(function () {
Route::get('/login', [loginController::class, 'loginPage'])->name('login');
Route::post('/login', [loginController::class, 'login'])->name('userlogin');
Route::get('/signup', [loginController::class, 'signupAdvertiser']);
Route::get('/signup-publisher', [loginController::class, 'signupPublisher']);
Route::post('/signup-publisher', [loginController::class, 'createUser'])->name('createUser');
Route::post('/signup-advertiser', [loginController::class, 'createAdvertiser'])->name('createAdvertiser');

Route::get('resetpassword', [loginController::class, 'showResetForm'])->name('resetpassword');
Route::post('resetpassword', [loginController::class, 'sendResetLinkEmail'])->name('sendResetLinkEmail');
// show password reset form
Route::get('resetpage/{token}', [loginController::class, 'showResetPage'])->name('passwordresetpage');
Route::post('resetpage', [loginController::class, 'reset'])->name('reset');
});

Route::middleware(['auth'])->group(function () {
Route::get('/profile/complete', [AuthController::class, 'showCompleteForm'])->name('profile.complete');
Route::post('/profile/complete', [AuthController::class, 'completeProfile']);
});

//publishers add mobile to meddleware
Route::middleware(['auth','completeprofile', 'single.session','tutorial', 'publisher',])->group(function () {
Route::get('/publisher', [publisherController::class, 'publisherDashboard'])->name('publisher');
Route::get('/payments', [publisherController::class, 'payments'])->name('payments');
Route::post('/payments/settings', [publisherController::class, 'PaymentMethodSettings'])->name('paymentsettings');
Route::post('/payments', [publisherController::class, 'requestPayment'])->name('paymentrequest');
#Route::post('/payments', [publisherController::class, 'PaymentMethodSettings'])->name('PaymentMethodSettings');
//Route::get('/publisher', [publisherController::class, 'displayTasks'])->name('task');
Route::get('/show/{id}', [publisherController::class, 'show'])->name('show');
Route::post('/job', [publisherController::class, 'verifyCode'])->name('verifyCode');
Route::get('/profile', [publisherController::class, 'Profile']);
Route::get('/statistics', [publisherController::class, 'Stats']);
Route::get('/linkexpired', [publisherController::class, 'linkexpired'])->name('linkexpired');
Route::get('/logout', [publisherController::class, 'logout'])->name('logout');
Route::post('/profile/send-code', [publisherController::class, 'sendCode'])->name('profile.sendCode');
Route::post('/profile/verify-code', [publisherController::class, 'verifyPasswordCode'])->name('profile.verifyCode');
Route::post('/profile/update-password', [publisherController::class, 'updatePassword'])->name('profile.updatePassword');
Route::get('/referrals', [publisherController::class, 'referrals']);

#Route::get('/profile/complete', [AuthController::class, 'showCompleteForm'])->name('profile.complete')->withoutMiddleware(CompleteProfileMiddleware::class);
#Route::post('/profile/complete', [AuthController::class, 'completeProfile'])->withoutMiddleware(CompleteProfileMiddleware::class);

Route::post('/clear-task-session', [publisherController::class, 'clearTaskSession'])
    ->name('clear.task.session');

 //Reloadly toptup form   

Route::get('/topup-form', [TopupController::class, 'showForm'])->name('topup.form');
Route::post('/topup-data', [TopupController::class, 'sendData'])->name('topup.send');

Route::get('/redeem', [TopupController::class, 'showWithdrawForm']);
Route::get('/choose', [TopupController::class, 'choose'])->name('choose');

//payments routes
Route::get('/momo', [CashController::class, 'momo'])->name('momo');
Route::post('/momo', [MomoWithdrawalController::class, 'store'])->name('momo.store');
Route::get('/binance', [BinanceWithdrawalController::class, 'index'])->name('binance');
Route::post('/binance', [BinanceWithdrawalController::class, 'store'])->name('binance.store');

Route::get('/watch-tutorial', [AuthController::class, 'showTutorialComplete'])->name('tutorial.page');
Route::post('/watch-tutorial', [AuthController::class, 'tutorialComplete'])->name('tutorial.complete');


//Mpesa routes
Route::get('/mpesa', [MpesaController::class, 'index'])->name('mpesa.index');
Route::post('/mpesa', [MpesaController::class, 'store'])->name('mpesa.store');

// Nigeria bank transfer routes
Route::get('/withdraw/nigeria-bank', [NigeriaBankController::class, 'index'])->name('bank.nigeria.index');
Route::post('/withdraw/nigeria-bank', [NigeriaBankController::class, 'store'])->name('bank.nigeria.store');


// South africa bank transfer routes
Route::get('/withdraw/south-africa', [SouthAfricaBankController::class, 'index'])->name('bank.southafrica.index');
Route::post('/withdraw/south-africa', [SouthAfricaBankController::class, 'store'])->name('bank.southafrica.store');





});


//advertisers
Route::middleware(['auth', 'advertiser'])->group(function () {
Route::get('/advertiser', [advertiserController::class, 'advertiserDashboard'])->name('advertiser');
Route::get('/transaction', [advertiserController::class, 'Transaction']);
Route::get('/analytics', [advertiserController::class, 'Analytics']);
Route::get('/userdata', [advertiserController::class, 'userdata']);
// Email Routes
Route::get('/email-campaigns', [advertiserController::class, 'EmailCampagnShow']);
Route::post('/email-campaigns', [advertiserController::class, 'SendCampaignEmails'])->name('SendEmails');

Route::get('/userlist', [advertiserController::class, 'userlist'])->name('userlist');
Route::get('/adgroup', [advertiserController::class, 'Adgroup'])->name('adgroup');
Route::post('/adgroup', [advertiserController::class, 'storeAdgroup'])->name('storeAdgroup');
Route::get('/support', [advertiserController::class, 'Support']);
Route::get('/campaign-list', [advertiserController::class, 'CampaignList'])->name('campaign-list');
Route::get('/create-campaign', [advertiserController::class, 'createCampaign']);
Route::get('/create-adgroup', [advertiserController::class, 'createAdgroup']);
Route::post('/create-campaign', [advertiserController::class, 'store'])->name('store');
Route::get('/delete-campaign/{id}', [advertiserController::class, 'deletecampaign'])->name('delete-campaign');
});