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
            <p class="saldo-valor">R${{ explode(' ', Auth::user()->saldo)[0] ?? 'Usuário' }}</p>
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
        </select>
    </div>

    <!-- Histórico de movimentações -->
    <div class="historico">
        @if (session('message'))
    <div class="alert success">{{ session('message') }}</div>
@endif

@if (session('error'))
    <div class="alert error">{{ session('error') }}</div>
@endif
        <h4>Histórico de movimentações</h4>
     <ul>
    @forelse ($historico as $mov)
        <li>
            <span class="tipo {{ $mov->tipo }}">{{ ucfirst($mov->tipo) }}</span>
            <span>R$ {{ number_format($mov->valor, 2, ',', '.') }}</span>
            <span>{{ $mov->created_at->format('d/m/Y') }}</span>
        </li>
    @empty
        <li>Sem movimentações registradas.</li>
    @endforelse
</ul>

    </div>
</div>

<!-- Modal Depositar -->
<div class="modal" id="modal-depositar">
    <div class="modal-content">
        <span class="close" data-close="#modal-depositar">&times;</span>
        <h3>Depósito</h3>
      <form method="POST" action="{{ route('conta.depositar') }}">
    @csrf
    <label for="valor-deposito">Valor a depositar</label>
    <input type="number" name="valor" id="valor-deposito" placeholder="Ex: 1000,00" required />

    <label for="origem-fundos">Origem dos fundos</label>
    <input type="text" name="origem" id="origem-fundos" placeholder="Ex: Banco X" required />

    <button type="submit" class="btn">Confirmar Depósito</button>
</form>

    </div>
</div>

<!-- Modal Sacar -->
<div class="modal" id="modal-sacar">
    <div class="modal-content">
        <span class="close" data-close="#modal-sacar">&times;</span>
        <h3>Saque</h3>
       <form method="POST" action="{{ route('conta.sacar') }}">
    @csrf
    <label for="valor-saque">Valor a sacar</label>
    <input type="number" name="valor" id="valor-saque" placeholder="Ex: 500,00" required />

    <label for="destino-saque">Conta de destino</label>
    <input type="text" name="destino" id="destino-saque" placeholder="Banco, Agência, Conta" required />

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

    // FILTRO FUNCIONALIDADE
    const filtroDescricao = document.querySelector('.filtro-input');
    const filtroTipo = document.querySelector('.filtro-select');
    const listaMov = document.querySelectorAll('.historico ul li');

    function aplicarFiltros() {
        const termo = filtroDescricao.value.toLowerCase();
        const tipoSelecionado = filtroTipo.value;

        listaMov.forEach(li => {
            const descricao = li.textContent.toLowerCase();
            const tipo = li.querySelector('.tipo')?.classList[1] || '';

            const correspondeDescricao = descricao.includes(termo);
            const correspondeTipo = (tipoSelecionado === 'todos' || tipo === tipoSelecionado);

            if (correspondeDescricao && correspondeTipo) {
                li.style.display = 'flex';
            } else {
                li.style.display = 'none';
            }
        });
    }

    filtroDescricao.addEventListener('input', aplicarFiltros);
    filtroTipo.addEventListener('change', aplicarFiltros);
});

</script>
@endsection
