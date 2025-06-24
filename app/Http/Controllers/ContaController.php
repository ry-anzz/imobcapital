<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movimentacao;

class ContaController extends Controller
{
    public function index()
    {
        $historico = Movimentacao::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('dashboard.conta', compact('historico'));
    }

    // Depósito fictício
    public function depositar(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric|min:1',
            'origem' => 'required|string|max:255'
        ]);

        $user = Auth::user();
        
        // Simula saldo atualizado
        $user->saldo += $request->valor;
        $user->save();

        // Grava no histórico apenas para exibição
        Movimentacao::create([
            'user_id' => $user->id,
            'tipo' => 'deposito',
            'valor' => $request->valor,
            'descricao' => 'Depósito simulado - Origem: ' . $request->origem
        ]);

        return redirect()->back()->with('message', 'Depósito realizado com sucesso.');
    }

    // Saque fictício
    public function sacar(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric|min:1',
            'destino' => 'required|string|max:255'
        ]);

        $user = Auth::user();

        if ($request->valor > $user->saldo) {
            return redirect()->back()->with('error', 'Saldo insuficiente para saque.');
        }

        $user->saldo -= $request->valor;
        $user->save();

        Movimentacao::create([
            'user_id' => $user->id,
            'tipo' => 'saque',
            'valor' => $request->valor,
            'descricao' => 'Saque simulado para: ' . $request->destino
        ]);

        return redirect()->back()->with('message', 'Saque simulado realizado com sucesso.');
    }
}
