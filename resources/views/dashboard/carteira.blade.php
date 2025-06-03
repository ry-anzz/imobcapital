@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Minha Carteira</h2>
</div>

<div class="carteira-wrapper">
    <div class="investimento-card">
        <div class="investimento-topo">
            <h4>ImobCapital Renda Fixa</h4>
            <span class="status ativo">Ativo</span>
        </div>

        <div class="investimento-detalhes">
            <p><strong>Valor Investido:</strong> <span class="value" data-value="R$ 10.000,00">****</span></p>
            <p><strong>Rentabilidade:</strong> 1,5% ao mês</p>
            <p><strong>Rendimento Acumulado:</strong> R$ 750,00</p>
            <p><strong>Início:</strong> 01/02/2024</p>
        </div>

        <div class="investimento-acao">
            <a href="/dashboard/detalhes" class="ver-detalhes">Ver detalhes</a>
        </div>
    </div>

    <div class="investimento-card">
        <div class="investimento-topo">
            <h4>ImobCapital Fundo Imobiliário</h4>
            <span class="status ativo">Ativo</span>
        </div>

        <div class="investimento-detalhes">
            <p><strong>Valor Investido:</strong> <span class="value" data-value="R$ 15.000,00">****</span></p>
            <p><strong>Rentabilidade:</strong> 2,1% ao mês</p>
            <p><strong>Rendimento Acumulado:</strong> R$ 1.050,00</p>
            <p><strong>Início:</strong> 15/03/2024</p>
        </div>

        <div class="investimento-acao">
            <a href="/dashboard/detalhes" class="ver-detalhes">Ver detalhes</a>
        </div>
    </div>

    <div class="investimento-card">
        <div class="investimento-topo">
            <h4>ImobCapital Pré-Fixado</h4>
            <span class="status finalizado">Finalizado</span>
        </div>

        <div class="investimento-detalhes">
            <p><strong>Valor Investido:</strong> <span class="value" data-value="R$ 8.000,00">****</span></p>
            <p><strong>Rentabilidade:</strong> 2,0% ao mês</p>
            <p><strong>Rendimento Total:</strong> R$ 960,00</p>
            <p><strong>Início:</strong> 10/10/2023</p>
        </div>

        <div class="investimento-acao">
            <a href="/dashboard/detalhes" class="ver-detalhes">Ver detalhes</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const values = document.querySelectorAll('.value');
        values.forEach(el => {
            el.textContent = el.dataset.value;
        });
    });
</script>
@endsection
