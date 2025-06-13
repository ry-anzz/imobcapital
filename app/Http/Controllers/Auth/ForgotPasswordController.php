<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\PasswordResetCode;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('landingpage.forgot-password');
    }

   public function sendResetLinkEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ], [
        'email.exists' => 'Este e-mail não está cadastrado no sistema.'
    ]);

    $code = rand(100000, 999999);

    // Salva o código no banco ou no usuário (como combinado)
    $user = User::where('email', $request->email)->first();
    $user->reset_code = $code;
    $user->save();

    // Salva o email na sessão para usar nas próximas etapas
    session(['password_reset_email' => $request->email]);

    // Envia o email com o código
    Mail::to($request->email)->send(new PasswordResetCode($code));

    return redirect()->route('password.verify.form')->with('success', 'Código enviado para o seu e-mail.');
}

   public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:6|confirmed',
    ], [
        'email.exists' => 'E-mail não cadastrado.',
        'password.confirmed' => 'A confirmação da senha não confere.',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Usuário não encontrado.']);
    }

    try {
        $user->password = bcrypt($request->password);
        $user->reset_code = null;
        $user->reset_code_created_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Senha redefinida com sucesso! Agora faça login.');
    } catch (\Exception $e) {
        return back()->with('error', 'Erro ao redefinir a senha. Tente novamente.');
    }
}

}
