<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordRecoveryController;

Route::get('/', function () {
    return view('landingpage.home');
});

// Login e Registro
Route::get('/landingpage/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/landingpage/login', [LoginController::class, 'login']);

Route::get('/landingpage/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/landingpage/register', [RegisterController::class, 'register']);

// Recuperação de senha - passo 1: formulário para pedir código
Route::get('/landingpage/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/landingpage/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Recuperação de senha - passo 2: formulário para verificar código
Route::get('/landingpage/verify', [PasswordRecoveryController::class, 'showVerifyForm'])->name('password.verify.form');
Route::post('/landingpage/verify', [PasswordRecoveryController::class, 'verifyCode'])->name('password.verify');

// Recuperação de senha - passo 3: formulário para redefinir senha
Route::get('/landingpage/reset', function (Request $request) {
    return view('landingpage.reset', ['email' => $request->email]);
})->name('password.reset.form');

Route::post('/landingpage/reset', [PasswordRecoveryController::class, 'resetPassword'])->name('password.reset');

// Dashboard protegido por auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.home');
    })->name('dashboard');

    Route::get('/dashboard/carteira', function () {
        return view('dashboard.carteira');
    });

    Route::get('/dashboard/detalhes', function () {
        return view('dashboard.detalhes');
    });

    Route::get('/dashboard/investir', function () {
        return view('dashboard.investir');
    });

    Route::get('/dashboard/investiradm', function () {
        return view('dashboard.investiradm');
    });

    Route::get('/dashboard/conta', function () {
        return view('dashboard.conta');
    });

    Route::get('/dashboard/perfil', function () {
        return view('dashboard.perfil');
    });

    Route::get('/dashboard/indicar', function () {
        return view('dashboard.indicar');
    });
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
