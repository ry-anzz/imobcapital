@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Investir</h2>
</div>

<div class="invest-container">
    <div class="invest-form-card">
        <h3>Simular e realizar investimento</h3>

        <form>
            <div class="form-group">
                <label for="valor">Valor a investir</label>
                <input type="number" id="valor" name="valor" placeholder="Ex: 5000.00" min="100" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="prazo">Prazo do investimento</label>
                <select id="prazo" name="prazo" required>
                    <option value="12">12 meses</option>
                    <option value="24">24 meses</option>
                    <option value="36">36 meses</option>
                </select>
            </div>

            <div class="form-group">
                <label>Rentabilidade estimada</label>
                <p class="rentabilidade-estimada">2,5% ao mês</p>
            </div>

            <div class="form-group">
                <label>Data de vencimento estimada</label>
                <p class="vencimento">29/05/2026</p>
            </div>

            <div class="form-group">
                <label>Total estimado no vencimento</label>
                <p class="total-vencimento">R$ 8.450,00</p>
            </div>

            <button type="submit" class="btn-investir">Confirmar Investimento</button>
        </form>
    </div>

    <div class="avisos-investimento">
        <h4>Informações importantes:</h4>
        <ul>
            <li>Investimentos têm carência de 12 meses.</li>
            <li>Resgates antecipados podem gerar perda de rentabilidade.</li>
            <li>Rentabilidade sujeita a alterações de mercado.</li>
        </ul>
    </div>
</div>
@endsection
