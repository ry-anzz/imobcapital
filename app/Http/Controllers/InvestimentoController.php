<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investimento;
use App\Models\RentabilidadeDiaria;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InvestimentoController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
     
        $request->validate([
            'valor' => 'required|string',
            'prazo' => 'required|integer|min:0|max:7',
        ]);

        $prazos = [3, 7, 15, 30, 45, 60, 90, 180];
        $prazoDias = $prazos[$request->prazo];

      $valorInvestido = (float) $request->valor;



        $percentualDia = RentabilidadeDiaria::orderByDesc('data_referencia')->value('rentabilidade_percentual') ?? 0;

        // Verifica saldo
        if ($user->saldo < $valorInvestido) {
            return redirect()->back()->with('error', 'Saldo insuficiente.');
        }

        $taxa = $percentualDia / 100;
        $rendimento = $valorInvestido * $taxa * $prazoDias;
        $totalEstimado = $valorInvestido + $rendimento;

        $hoje = now();
        $vencimento = $hoje->copy()->addDays($prazoDias);

        // Cria o investimento
        Investimento::create([
            'user_id' => $user->id,
            'valor' => $valorInvestido,
            'prazo_dias' => $prazoDias,
            'rentabilidade_percentual' => $percentualDia,
            'data_inicio' => $hoje,
            'data_vencimento' => $vencimento,
            'valor_estimado' => $totalEstimado,
        ]);

        // Atualiza o saldo do usuário
        $user->saldo -= $valorInvestido;
        $user->save();

        return redirect()->back()->with('success', 'Investimento realizado com sucesso!');
    }

    public function create()
    {
        $hoje = now()->toDateString();
        $rentabilidade = RentabilidadeDiaria::where('data_referencia', $hoje)->first();

        $percentual = $rentabilidade?->rentabilidade_percentual ?? 0;

        return view('dashboard.investir', [
            'percentual_dia' => $percentual
        ]);
    }

    public function carteira()
    {
        $usuarioId = Auth::id();
        $investimentos = Investimento::where('user_id', $usuarioId)->get();

        foreach ($investimentos as $investimento) {
            $valorBase = $investimento->valor;
            $acumulado = 0;

            $dataInicio = Carbon::parse($investimento->data_inicio)->toDateString();
            $dataHoje = now()->toDateString();

            $rentabilidades = RentabilidadeDiaria::whereBetween('data_referencia', [$dataInicio, $dataHoje])
                ->orderBy('data_referencia')
                ->get();

            foreach ($rentabilidades as $r) {
                $acumulado += $valorBase * ($r->rentabilidade_percentual / 100);
            }

            $investimento->rendimento_acumulado = round($acumulado, 2);
            $investimento->valor_atual = round($valorBase + $acumulado, 2);
        }

        return view('dashboard.carteira', compact('investimentos'));
    }

    public function show($id)
    {
        $investimento = Investimento::findOrFail($id);

        $valorInicial = $investimento->valor;
        $dataInicio = Carbon::parse($investimento->data_inicio)->startOfDay();
        $dataHoje = now()->startOfDay();

        $rentabilidades = RentabilidadeDiaria::whereBetween('data_referencia', [$dataInicio->toDateString(), $dataHoje->toDateString()])
            ->orderBy('data_referencia')
            ->get();

        $rendimentoAcumulado = 0;

        foreach ($rentabilidades as $r) {
            $rendimentoAcumulado += $valorInicial * ($r->rentabilidade_percentual / 100);
        }

        $valorAtual = $valorInicial + $rendimentoAcumulado;

        $rendimentoHoje = 0;
        $rentabilidadeHoje = $rentabilidades->firstWhere('data_referencia', $dataHoje->toDateString());
        if ($rentabilidadeHoje) {
            $rendimentoHoje = round($valorInicial * ($rentabilidadeHoje->rentabilidade_percentual / 100), 2);
        }

        $investimento->valor_atual = round($valorAtual, 2);
        $investimento->rendimento_acumulado = round($rendimentoAcumulado, 2);

        return view('dashboard.detalhes', [
            'investimento' => $investimento,
            'rendimentoAcumulado' => $investimento->rendimento_acumulado,
            'rendimentoHoje' => $rendimentoHoje,
            'saldo' => $valorAtual,
            'rentabilidades' => $rentabilidades
        ]);
    }

    public function reinvestir(Request $request, $id)
    {
        $investimento = Investimento::findOrFail($id);
        $valor = floatval($request->input('valor'));
        $fonte = $request->input('fonte');

        if ($valor <= 0) {
            return back()->withErrors(['valor' => 'O valor deve ser maior que zero.']);
        }

        if ($fonte === 'rendimentos') {
            if ($investimento->rendimento_acumulado < $valor) {
                return back()->withErrors(['valor' => 'Valor maior que o rendimento disponível.']);
            }
            $investimento->rendimento_acumulado -= $valor;
        } elseif ($fonte === 'conta') {
            $usuario = auth()->user();
            if ($usuario->saldo < $valor) {
                return back()->withErrors(['valor' => 'Saldo insuficiente.']);
            }
            $usuario->saldo -= $valor;
            $usuario->save();
        }

        $investimento->valor += $valor;
        $investimento->save();

        return back()->with('success', 'Reinvestimento realizado com sucesso.');
    }

    public function resgatar(Request $request, $id)
    {
        $investimento = Investimento::findOrFail($id);
        $user = Auth::user();

        // Valor sempre será o valor disponível total
        $valorResgate = $investimento->valor;
        $rendimentoAcumulado = 0;

        $dataInicio = Carbon::parse($investimento->data_inicio)->toDateString();
        $dataHoje = now()->toDateString();

        $rentabilidades = RentabilidadeDiaria::whereBetween('data_referencia', [$dataInicio, $dataHoje])->get();
        foreach ($rentabilidades as $r) {
            $rendimentoAcumulado += $valorResgate * ($r->rentabilidade_percentual / 100);
        }

        $valorAtual = $valorResgate + $rendimentoAcumulado;

        // Credita o valor total ao usuário
        $user->saldo += $valorAtual;
        $user->save();

        // Exclui o investimento, pois foi resgatado totalmente
        $investimento->delete();

        return redirect()->route('dashboard')->with('success', 'Resgate total realizado com sucesso!');
    }
}
