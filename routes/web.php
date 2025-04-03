<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'PreventBackHistory'])->group(function () {

    Route::controller(AuthController::class)->group(function() {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        Route::post('/logout', 'logout')->name('logout');
    });
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/', 'index')->name('index');

    Route::get('/login', 'loginPage')->name('auth.login');
    Route::post('/login', 'login')->name('login');

    Route::get('/customer-registration', 'customerRegistrationPage')->name('customer.registrationPage');
    Route::post('/customer-registration', 'customerRegister')->name('customer.registration');

    Route::get('/admin-registration', 'adminRegistrationPage')->name('admin.registrationPage');
    Route::post('/admin-registration', 'adminRegister')->name('admin.registration');
    
    Route::get('/verify-otp', 'showVerifyOtpPage')->name('otp.verify.page');
    Route::post('/verify-otp', 'verifyOtp')->name('verify.otp');
});