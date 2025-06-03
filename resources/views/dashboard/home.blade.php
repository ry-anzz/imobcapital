@extends('dashboard.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboard/extended-home.css') }}">

<div class="dashboard-title">
    <h2>Dashboard</h2>
</div>

<div class="main-dashboard-card">
    {{-- Card 1: Total Investido / Rendimento / Rentabilidade --}}
    <div class="dashboard-summary clickable">
        <div class="top-summary">
            <h4>Total Investido</h4>
            <p class="value" data-value="R$ 35.000,00">****</p>
        </div>

        <div class="bottom-summary">
            <div class="summary-item">
                <h4>Rendimento no Mês</h4>
                <p class="value" data-value="R$ 950,00">****</p>
            </div>
            <div class="summary-item">
                <h4>Rentabilidade no Mês</h4>
                <p class="value" data-value="2,7%">****</p>
            </div>
        </div>

        <a href="/dashboard/carteira">
            <span class="material-symbols-outlined icon-action">chevron_right</span>
        </a>
    </div>

    {{-- Card 2: Conta Corrente --}}
    <div class="conta-corrente clickable">
        <div class="conta-content">
            <div>
                <h4>Conta-corrente</h4>
                <p class="value" data-value="R$ 1.200,00">****</p>
            </div>
            <a href="/dashboard/conta">
                <span class="material-symbols-outlined icon-action">chevron_right</span>
            </a>
        </div>
    </div>

    {{-- Card 3: Indicações --}}
    <div class="indicacoes-card clickable">
        <div class="indicacoes-content">
            <div>
                <h4>Indicações</h4>
                <p>5 amigos</p>
                <h4>Ganhos</h4>
                <p class="value" data-value="R$ 300,00">****</p>
            </div>
            <a href="/dashboard/indicar">
                <span class="material-symbols-outlined icon-action">chevron_right</span>
            </a>
        </div>
    </div>

    {{-- Gráfico de Rentabilidade --}}
    <div class="chart-container">
        <canvas id="rentabilidadeChart"></canvas>
    </div>

    {{-- Últimas Movimentações --}}
    <div class="ultimas-movimentacoes">
        <h4>Últimas Movimentações</h4>
        <ul>
            <li>+ R$ 500,00 - Investimento - 20/05</li>
            <li>- R$ 200,00 - Retirada - 18/05</li>
            <li>+ R$ 100,00 - Indicação - 15/05</li>
        </ul>
            <a href="/dashboard/conta" class="ver-todas">Ver todas</a>
    </div>
</div>

{{-- Gráfico com Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('rentabilidadeChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Rentabilidade %',
                data: [1.8, 2.0, 2.5, 2.2, 2.7, 3.1],
                borderColor: '#e85408',
                backgroundColor: 'rgba(232,84,8,0.1)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

{{-- Script para esconder/mostrar valores --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('toggle-visibility');
        const icon = toggleBtn?.querySelector('.material-symbols-outlined');
        const values = document.querySelectorAll('.value');
        let isVisible = true;

        toggleBtn?.addEventListener('click', () => {
            isVisible = !isVisible;
            values.forEach(el => {
                el.textContent = isVisible ? el.dataset.value : '****';
            });
            if (icon) icon.textContent = isVisible ? 'visibility_off' : 'visibility';
        });
    });
</script>
@endsection
    