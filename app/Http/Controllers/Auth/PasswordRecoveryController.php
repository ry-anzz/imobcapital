<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordRecoveryController extends Controller
{
    // Envia o código e salva no usuário
    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();
$code = rand(100000, 999999);
$user->reset_code = $code;
$user->reset_code_created_at = now();
$user->save();

        // Aqui você envia o email com o $code (use seu Mail, etc)

        session(['password_reset_email' => $user->email]);

        return redirect()->route('password.verify.form')
            ->with('success', 'Código enviado para o seu e-mail.');
    }

    // Exibe o formulário para o usuário digitar o código
    public function showVerifyForm()
    {
        return view('landingpage.verify');
    }

    // Verifica o código enviado pelo usuário
   public function verifyCode(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'code' => 'required|digits:6',
    ]);

    $user = User::where('email', $request->email)
                ->where('reset_code', $request->code)
                ->first();

    if (!$user) {
        return back()->withErrors(['code' => 'Código inválido.']);
    }

    // Código válido (sem expiração)

    session(['password_reset_email' => $user->email]);
    return redirect()->route('password.reset.form', ['email' => $user->email]);
}


    // Exibe a tela de redefinir senha
    public function showResetForm(Request $request)
    {
        return view('landingpage.reset', ['email' => $request->email]);
    }

    // Redefine a senha
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        $user->password = Hash::make($request->password);
        $user->reset_code = null; // limpa o código
        $user->reset_code_created_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Senha redefinida com sucesso. Faça login agora.');
    }
}
