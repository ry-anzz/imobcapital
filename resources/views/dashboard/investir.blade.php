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
                <input type="text" id="valor" name="valor" placeholder="R$ 0,00" required>
            </div>

            <div class="form-group">
                <label for="prazo">Prazo do investimento: <strong><span id="prazoDisplay">30</span> dias</strong></label>
                <input type="range" id="prazo" min="0" max="7" value="3">
            </div>

            <div class="form-group">
                <label>Rentabilidade estimada</label>
                <p class="rentabilidade-estimada">--</p>
            </div>

            <div class="form-group">
                <label>Data de vencimento estimada</label>
                <p class="vencimento">--</p>
            </div>

            <div class="form-group">
                <label>Total estimado no vencimento</label>
                <p class="total-vencimento">--</p>
            </div>

            <button type="submit" class="btn-investir">Confirmar Investimento</button>
        </form>
    </div>

    <div class="avisos-investimento">
        <h4>Informações importantes:</h4>
        <ul>
            <li>Investimentos com carência mínima de 30 dias.</li>
            <li>Resgates antecipados podem gerar perda de rentabilidade.</li>
            <li>Simulação baseada em taxa padrão de mercado.</li>
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const valorInput = document.getElementById('valor');
    const prazoInput = document.getElementById('prazo');
    const prazoDisplay = document.getElementById('prazoDisplay');
    const rentabilidadeEl = document.querySelector('.rentabilidade-estimada');
    const vencimentoEl = document.querySelector('.vencimento');
    const totalVencimentoEl = document.querySelector('.total-vencimento');

    const prazos = [3, 7, 15, 30, 45, 60, 90, 180];
    const rentabilidades = {
        3: 0.002,
        7: 0.004,
        15: 0.008,
        30: 0.015,
        45: 0.02,
        60: 0.025,
        90: 0.035,
        180: 0.07
    };

    function formatarMoeda(valor) {
        valor = valor.replace(/\D/g, '');
        valor = (parseInt(valor) / 100).toFixed(2) + '';
        valor = valor.replace('.', ',');
        valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        return 'R$ ' + valor;
    }

    function obterValorNumerico(campo) {
        return parseFloat(campo.value.replace(/\D/g, '')) / 100;
    }

    function atualizarSimulacao() {
        const valor = obterValorNumerico(valorInput);
        const prazoIndex = parseInt(prazoInput.value);
        const prazoDias = prazos[prazoIndex];

        if (isNaN(valor) || valor === 0) {
            rentabilidadeEl.textContent = '--';
            vencimentoEl.textContent = '--';
            totalVencimentoEl.textContent = '--';
            return;
        }

        const taxa = rentabilidades[prazoDias] || 0;
        const rendimento = valor * taxa;
        const total = valor + rendimento;

        prazoDisplay.textContent = prazoDias;
        rentabilidadeEl.textContent = (taxa * 100).toFixed(2) + '% no período';

        const hoje = new Date();
        const vencimento = new Date();
        vencimento.setDate(hoje.getDate() + prazoDias);
        vencimentoEl.textContent = vencimento.toLocaleDateString('pt-BR');

        totalVencimentoEl.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
    }

    valorInput.addEventListener('input', () => {
    const valorNumerico = valorInput.value.replace(/\D/g, '');
    valorInput.value = formatarMoeda(valorNumerico);
    
    // Coloca o cursor no fim
    setTimeout(() => {
        valorInput.selectionStart = valorInput.selectionEnd = valorInput.value.length;
    }, 0);

    atualizarSimulacao();
});


    prazoInput.addEventListener('input', atualizarSimulacao);

    atualizarSimulacao(); // Inicializa
});
</script>
@endsection
