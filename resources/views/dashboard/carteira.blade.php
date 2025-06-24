@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Minha Carteira</h2>
</div>

<div class="carteira-wrapper">
    @foreach($investimentos as $investimento)
        <div class="investimento-card">
            <div class="investimento-topo">
                <h4>{{ $investimento->nome_fundo ?? 'ImobCapital' }}</h4>
                <span class="status {{ $investimento->status_class }}">{{ $investimento->status_text }}</span>
            </div>

            <div class="investimento-detalhes">
                <h3>ImobCapital Renda Fixa</h3>
                <p><strong>Valor investido:</strong> R$ {{ number_format($investimento->valor, 2, ',', '.') }}</p>
            </div>

            <div class="investimento-acao">
                <a href="{{ route('investimentos.show', $investimento->id) }}" class="ver-detalhes">
                    Detalhes do investimento #{{ $investimento->id }}
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
