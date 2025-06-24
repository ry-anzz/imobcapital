<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Exibe o formulário de login.
     */
    public function showLoginForm()
    {
        return view('landingpage.login');
    }

    /**
     * Processa a tentativa de login.
     */
  public function login(Request $request)
{
    // Validação dos dados
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ], [
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'Digite um e-mail válido.',
        'password.required' => 'A senha é obrigatória.',
    ]);

    // Tenta autenticar o usuário
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Você precisa verificar seu e-mail antes de acessar a conta.'
            ])->withInput($request->only('email'));
        }

        return redirect()->intended('/dashboard')->with('success', 'Login realizado com sucesso!');
    }

    // Se falhar, retorna com erro
    return back()->withErrors([
        'email' => 'As credenciais fornecidas estão incorretas.',
    ])->withInput($request->only('email'));
}

    /**
     * Faz logout do usuário.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout realizado com sucesso!');
    }
}
