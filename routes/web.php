<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordRecoveryController;
use App\Http\Controllers\AdminInvestimentoController;
use App\Http\Controllers\InvestimentoController;
use App\Http\Controllers\CarteiraController;
use App\Http\Controllers\IndicacaoController;


// Página inicial
Route::get('/', function () {
    return view('landingpage.home');
});

// Login e Registro
Route::get('/landingpage/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/landingpage/login', [LoginController::class, 'login']);

Route::get('/landingpage/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/landingpage/register', [RegisterController::class, 'register']);

// Recuperação de senha
Route::get('/landingpage/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/landingpage/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/landingpage/verify', [PasswordRecoveryController::class, 'showVerifyForm'])->name('password.verify.form');
Route::post('/landingpage/verify', [PasswordRecoveryController::class, 'verifyCode'])->name('password.verify');

Route::get('/landingpage/reset', function (Request $request) {
    return view('landingpage.reset', ['email' => $request->email]);
})->name('password.reset.form');

Route::post('/landingpage/reset', [PasswordRecoveryController::class, 'resetPassword'])->name('password.reset');


// 🚨 Aviso após cadastro: "Verifique seu e-mail"
Route::get('/email/verify', function () {
    return view('emails.verify_email'); // Crie essa view com o aviso
})->name('verification.notice');

// 🚨 Link que o usuário recebe no e-mail
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Link de verificação inválido.');
    }

    if ($user->hasVerifiedEmail()) {
        return redirect('/landingpage/login')->with('message', 'E-mail já verificado. Faça login.');
    }

    $user->markEmailAsVerified();

    return redirect('/landingpage/login')->with('message', 'E-mail verificado com sucesso! Faça login.');
})->middleware(['signed'])->name('verification.verify');


// 🔒 Rotas protegidas por login
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.home');
    })->name('dashboard');

    Route::get('/dashboard/carteira', [InvestimentoController::class, 'carteira'])->name('carteira');
    Route::get('/detalhes/{id}', [InvestimentoController::class, 'show'])->name('investimentos.show');
    Route::get('/dashboard/investir', [InvestimentoController::class, 'create'])->name('investimentos.create');
    
    Route::get('/dashboard/investiradm', function () {
        return view('dashboard.investiradm');
    });

    Route::get('/dashboard/conta', function () {
        return view('dashboard.conta');
    });

    Route::get('/dashboard/perfil', function () {
        return view('dashboard.perfil');
    });

 Route::get('/dashboard/indicar', [IndicacaoController::class, 'index'])->name('indicar');


    Route::post('/dashboard/{id}/reinvestir', [InvestimentoController::class, 'reinvestir'])->name('investimentos.reinvestir');
    Route::post('/dashboard/{id}/resgatar', [InvestimentoController::class, 'resgatar'])->name('investimentos.resgatar');
    Route::post('/dashboard/investir', [InvestimentoController::class, 'store'])->name('investimentos.store');

    // Reenvio do link de verificação
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link de verificação reenviado!');
    })->middleware('throttle:6,1')->name('verification.send');

       Route::get('/dashboard/conta', [\App\Http\Controllers\ContaController::class, 'index'])->name('conta');

    Route::post('/dashboard/conta/depositar', [\App\Http\Controllers\ContaController::class, 'depositar'])->name('conta.depositar');
    Route::post('/dashboard/conta/sacar', [\App\Http\Controllers\ContaController::class, 'sacar'])->name('conta.sacar');
});

// Admin
Route::post('/admin/investimentos/ajustar-diario', [AdminInvestimentoController::class, 'ajustarDiario']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
