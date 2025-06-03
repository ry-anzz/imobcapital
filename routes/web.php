    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\Auth\ForgotPasswordController;

    Route::get('/', function () {
        return view('/landingpage/home');
    });



    Route::get('/landingpage/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/landingpage/login', [LoginController::class, 'login']);


    Route::get('/landingpage/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/landingpage/register', [RegisterController::class, 'register']); // Se implementar o método register



    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

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

    ;
