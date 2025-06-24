<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentabilidadeDiaria;

class AdminInvestimentoController extends Controller
{
 public function ajustarDiario(Request $request)
{
    $validated = $request->validate([
        'rentabilidade_dia' => 'required|numeric',
      'data_referencia' => 'required|date|before_or_equal:today',
        'obs' => 'nullable|string',
    ]);

    // Transforma a data para datetime (inclui horas) para evitar duplicidade
    $dataReferencia = \Carbon\Carbon::parse($validated['data_referencia'])->setTime(now()->hour, now()->minute, now()->second);

 RentabilidadeDiaria::create([
    'data_referencia' => $validated['data_referencia'],
    'rentabilidade_percentual' => $validated['rentabilidade_dia'],
    'obs' => $validated['obs'] ?? null,
]);

    return redirect()->back()->with('success', 'Rentabilidade salva com sucesso!');
}

}
