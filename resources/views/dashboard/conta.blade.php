@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Conta-corrente</h2>
</div>

<div class="conta-wrapper">
    <!-- Saldo e Ações -->
    <div class="saldo-box">
        <div class="saldo-info">
            <h4>Saldo disponível</h4>
            <p class="saldo-valor">R$ 1.250,00</p>
        </div>
        <div class="acoes-conta">
            <button class="btn" id="btn-depositar">Depositar</button>
            <button class="btn" id="btn-sacar">Sacar</button>
        </div>
    </div>

    <!-- Filtros -->
    <div class="filtros">
        <input type="text" placeholder="Buscar por descrição..." class="filtro-input">
        <select class="filtro-select">
            <option value="todos">Todos</option>
            <option value="deposito">Depósitos</option>
            <option value="saque">Saques</option>
            <option value="transferencia">Transferências</option>
        </select>
    </div>

    <!-- Histórico de movimentações -->
    <div class="historico">
        <h4>Histórico de movimentações</h4>
        <ul>
            <li>
                <span class="tipo deposito">Depósito</span>
                <span>R$ 500,00</span>
                <span>10/05/2025</span>
            </li>
            <li>
                <span class="tipo saque">Saque</span>
                <span>R$ 300,00</span>
                <span>08/05/2025</span>
            </li>
            <li>
                <span class="tipo transferencia">Transferência</span>
                <span>R$ 100,00</span>
                <span>05/05/2025</span>
            </li>
        </ul>
    </div>
</div>

<!-- Modal Depositar -->
<div class="modal" id="modal-depositar">
    <div class="modal-content">
        <span class="close" data-close="#modal-depositar">&times;</span>
        <h3>Depósito</h3>
        <form>
            <label for="valor-deposito">Valor a depositar</label>
            <input type="number" id="valor-deposito" placeholder="Ex: 1000,00" />

            <label for="origem-fundos">Origem dos fundos</label>
            <input type="text" id="origem-fundos" placeholder="Ex: Banco X" />

            <button type="submit" class="btn">Confirmar Depósito</button>
        </form>
    </div>
</div>

<!-- Modal Sacar -->
<div class="modal" id="modal-sacar">
    <div class="modal-content">
        <span class="close" data-close="#modal-sacar">&times;</span>
        <h3>Saque</h3>
        <form>
            <label for="valor-saque">Valor a sacar</label>
            <input type="number" id="valor-saque" placeholder="Ex: 500,00" />

            <label for="destino-saque">Conta de destino</label>
            <input type="text" id="destino-saque" placeholder="Banco, Agência, Conta" />

            <button type="submit" class="btn">Confirmar Saque</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('btn-depositar').onclick = () => {
            document.getElementById('modal-depositar').style.display = 'flex';
        };
        document.getElementById('btn-sacar').onclick = () => {
            document.getElementById('modal-sacar').style.display = 'flex';
        };
        document.querySelectorAll('.close').forEach(el => {
            el.onclick = () => {
                const modal = document.querySelector(el.dataset.close);
                modal.style.display = 'none';
            };
        });
        window.onclick = (e) => {
            if (e.target.classList.contains('modal')) {
                e.target.style.display = 'none';
            }
        };
    });
</script>
@endsection
