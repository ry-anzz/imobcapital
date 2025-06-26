<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'telefone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'termos'   => 'accepted',
            'codigo_convite' => 'nullable|string|exists:users,codigo_convite'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Procura o indicador, se existir
        $indicadorId = null;
if ($request->filled('codigo_convite')) {
    $indicador = User::where('codigo_convite', $request->codigo_convite)->first();
    if ($indicador) {
        $indicadorId = $indicador->id;
    }
}

       do {
    $codigoConvite = strtoupper(Str::random(8));
} while (User::where('codigo_convite', $codigoConvite)->exists());

$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'telefone' => $request->telefone,
    'password' => Hash::make($request->password),
    'codigo_convite' => $codigoConvite,
    'indicador_id' => $indicadorId,
    'saldo' => 1000,
]);


        event(new Registered($user)); // dispara e-mail de verificação

        return redirect()->route('verification.notice')
                         ->with('message', 'Verifique seu e-mail antes de fazer login.');
    }

    public function showRegistrationForm()
    {
        return view('landingpage.register');
    }
}
