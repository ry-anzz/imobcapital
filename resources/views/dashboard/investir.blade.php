@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Investir</h2>
</div>

<div class="invest-container">
    <div class="invest-form-card">
        <h3>Simular e realizar investimento</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($percentual_dia > 0)
            <p><strong>Rentabilidade atual:</strong> {{ number_format($percentual_dia, 2, ',', '.') }}% ao dia</p>
        @else
            <p><strong>Atenção:</strong> Nenhuma rentabilidade foi definida para hoje.</p>
        @endif

        <form action="{{ route('investimentos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="valor">Valor a investir</label>
                <!-- Campo VISUAL -->
                <input type="text" id="valor" placeholder="R$ 0,00" required>
                <!-- Campo oculto que será enviado no POST -->
                <input type="hidden" id="valor_limpo" name="valor">
            </div>

            <div class="form-group">
                <label for="prazo">Prazo do investimento: <strong><span id="prazoDisplay">30</span> dias</strong></label>
                <input type="range" id="prazo" name="prazo" min="0" max="7" value="3">
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
            <li>Simulação baseada na taxa de hoje definida pelo administrador.</li>
        </ul>
    </div>
</div>

<script>
    const rentabilidadePercentual = {{ $percentual_dia ?? 0 }}; // ex: 0.8 (% ao dia)

    document.addEventListener('DOMContentLoaded', () => {
        const valorInput = document.getElementById('valor');
        const valorLimpoInput = document.getElementById('valor_limpo');
        const prazoInput = document.getElementById('prazo');
        const prazoDisplay = document.getElementById('prazoDisplay');
        const rentabilidadeEl = document.querySelector('.rentabilidade-estimada');
        const vencimentoEl = document.querySelector('.vencimento');
        const totalVencimentoEl = document.querySelector('.total-vencimento');

        const prazos = [3, 7, 15, 30, 45, 60, 90, 180];

        function formatarMoedaBR(valor) {
            return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        }

        function limparMascara(valor) {
            return parseFloat(valor.replace(/[^\d,]/g, '').replace(',', '.')) || 0;
        }

        function atualizarSimulacao() {
            const valorDigitado = limparMascara(valorInput.value);
            const prazoIndex = parseInt(prazoInput.value);
            const dias = prazos[prazoIndex];

            if (!valorDigitado || isNaN(valorDigitado)) {
                rentabilidadeEl.textContent = '--';
                vencimentoEl.textContent = '--';
                totalVencimentoEl.textContent = '--';
                valorLimpoInput.value = '';
                return;
            }

            valorLimpoInput.value = valorDigitado.toFixed(2);

            const taxaDiaria = rentabilidadePercentual / 100; // ex: 0.5 para 50%
            const rendimento = valorDigitado * taxaDiaria * dias;
            const total = valorDigitado + rendimento;

            prazoDisplay.textContent = dias;
            rentabilidadeEl.textContent = `${(taxaDiaria * dias * 100).toFixed(2)}% no período`;

            const hoje = new Date();
            const vencimento = new Date(hoje.setDate(hoje.getDate() + dias));
            vencimentoEl.textContent = vencimento.toLocaleDateString('pt-BR');

            totalVencimentoEl.textContent = formatarMoedaBR(total);
        }

        valorInput.addEventListener('input', () => {
            let valor = valorInput.value.replace(/\D/g, '');
            valor = (parseInt(valor) / 100).toFixed(2);
            valor = valor.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            valorInput.value = `R$ ${valor}`;
            atualizarSimulacao();
        });

        prazoInput.addEventListener('input', atualizarSimulacao);

        atualizarSimulacao(); // chama no carregamento inicial
    });
</script>

@endsection
