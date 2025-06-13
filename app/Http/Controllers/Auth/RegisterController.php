<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'telefone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'termos'   => 'accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'telefone'       => $request->telefone,
            'codigo_convite' => $request->codigo_convite,
            'password'       => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()-> route('login'); // ajuste a rota se necessário
    }

        public function showRegistrationForm()
{
    return view('landingpage.register'); // ou o caminho correto da sua view
}

}
