<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndicacaoController extends Controller
{
    public function index() // mantém o padrão 'index' da rota
    {
        $user = Auth::user();
        $indicados = $user->indicados()->with('investimentos')->get();

        // Conta o total investido por indicado
        foreach ($indicados as $ind) {
            $ind->investimento_total = $ind->investimentos->sum('valor');
        }

        $total_indicados = $indicados->count();
        $saldo = $user->saldo;
        $total_investido = $user->investimentos->sum('valor');

        // Regras de Progressão
        $nivel = 0;

        if ($user->hasVerifiedEmail()) {
            $nivel = 1;
        }

        if ($nivel >= 1 && $indicados->where('investimento_total', '>=', 100)->count() >= 5) {
            $nivel = 2;
        }

        if ($nivel >= 2 && $saldo >= 5000) {
            $nivel = 3;
        }

        if ($nivel >= 3 && $indicados->where('investimento_total', '>=', 500)->count() >= 5 && $saldo >= 15000) {
            $nivel = 4;
        }

        if ($nivel >= 4 &&
            $indicados->where('investimento_total', '>=', 1500)->count() >= 10 &&
            $saldo >= 25000 &&
            $total_investido >= 100000) {
            $nivel = 5;
        }

        if ($user->nivel !== $nivel) {
            $user->nivel = $nivel;
            $user->save();
        }


        return view('dashboard.indicar', [
            'indicados'        => $indicados,
            'total_indicados'  => $total_indicados,
            'nivel_atual'      => $nivel,
        ]);
    }
}
