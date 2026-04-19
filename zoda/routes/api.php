<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\VerificationController;

Route::post('/topup-data', [TopupController::class, 'sendData']);
Route::post('/generate-verification', [VerificationController::class, 'generate']);