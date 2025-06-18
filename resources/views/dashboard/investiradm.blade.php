@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Painel ADM</h2>
</div>

<div class="admin-investimento-container">
    <div class="admin-form-card">
        <form method="POST" action="/admin/investimentos/ajustar-diario">
            @csrf

            <div class="form-group">
                <label for="rentabilidade_dia">Rentabilidade do Dia (%)</label>
                <input type="number" step="0.001" name="rentabilidade_dia" id="rentabilidade_dia" placeholder="Exemplo: 0,83 equivale a ~0,83% ao mês."  required>
              
            </div>

            <div class="form-group">
                <label for="data_referencia">Data de Referência</label>
                <input type="date" name="data_referencia" id="data_referencia" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="obs">Observações (opcional)</label>
                <textarea name="obs" id="obs" rows="3" placeholder="Motivo do ajuste ou qualquer detalhe relevante..."></textarea>
            </div>

            <button type="submit" class="btn-salvar">Salvar Rentabilidade</button>
        </form>
    </div>
</div>
@endsection
