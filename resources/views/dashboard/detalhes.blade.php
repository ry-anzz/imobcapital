@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Detalhes do Investimento</h2>
</div>

<div class="container">
<div class="detalhes-investimento">
    <div class="info-geral">
        <h3>ImobCapital Renda Fixa</h3>
        <p>Status: <span class="status ativo">Ativo</span></p>
        <p><strong>Valor Investido:</strong> R$ 10.000,00</p>
        <p><strong>Rentabilidade:</strong> 1,5% ao mês</p>
        <p><strong>Rendimento Acumulado:</strong> R$ 750,00</p>
        <p><strong>Data de Início:</strong> 01/02/2024</p>
        <p><strong>Vencimento:</strong> 01/02/2025</p>
    </div>

    <div class="grafico">
        <h4>Rentabilidade ao longo do tempo</h4>
        <img src="/images/grafico-exemplo.png" alt="Gráfico de rentabilidade" style="width:100%; max-width:500px;">
    </div>

    <div class="movimentacoes">
        <h4>Movimentações</h4>
        <ul>
            <li>01/03/2024 - Rendimento mensal - R$ 150,00</li>
            <li>01/04/2024 - Rendimento mensal - R$ 150,00</li>
            <li>01/05/2024 - Rendimento mensal - R$ 150,00</li>
        </ul>
    </div>

<div class="acoes">
    <button class="btn" id="btn-reinvestir">Reinvestir</button>
    <button class="btn" id="btn-resgatar">Resgatar</button>
</div>
</div>
</div>



<!-- Modal Reinvestir -->
<div class="modal" id="modal-reinvestir">
    <div class="modal-content">
        <span class="close" data-close="#modal-reinvestir">&times;</span>
        <h3>Reinvestir Valor</h3>
        <form>
            <label for="valor-reinvestir">Valor a reinvestir</label>
            <input type="number" id="valor-reinvestir" placeholder="Ex: 1000,00" />

            <label for="fonte-reinvestir">Fonte dos recursos</label>
            <select id="fonte-reinvestir">
                <option value="conta">Conta-corrente</option>
                <option value="rendimentos">Rendimentos</option>
            </select>

            <button type="submit" class="btn">Confirmar Reinvestimento</button>
        </form>
    </div>
</div>

<!-- Modal Resgatar -->
<div class="modal" id="modal-resgatar">
    <div class="modal-content">
        <span class="close" data-close="#modal-resgatar">&times;</span>
        <h3>Solicitar Resgate</h3>
        <form>
            <label for="valor-resgatar">Valor a resgatar</label>
            <input type="number" id="valor-resgatar" placeholder="Ex: 500,00" />

            <label for="conta-destino">Conta destino</label>
            <input type="text" id="conta-destino" placeholder="Banco, Agência, Conta" />

            <button type="submit" class="btn">Confirmar Resgate</button>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const reinvestirBtn = document.getElementById('btn-reinvestir');
    const resgatarBtn = document.getElementById('btn-resgatar');

    const modalReinvestir = document.getElementById('modal-reinvestir');
    const modalResgatar = document.getElementById('modal-resgatar');

    reinvestirBtn.addEventListener('click', () => {
        modalReinvestir.style.display = 'flex';
    });

    resgatarBtn.addEventListener('click', () => {
        modalResgatar.style.display = 'flex';
    });

    document.querySelectorAll('.close').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = document.querySelector(btn.dataset.close);
            modal.style.display = 'none';
        });
    });

    // Fechar modal clicando fora
    window.addEventListener('click', (e) => {
        if (e.target.classList.contains('modal')) {
            e.target.style.display = 'none';
        }
    });
});
</script>

@endsection
