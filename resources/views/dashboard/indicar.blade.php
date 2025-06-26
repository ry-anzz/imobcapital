@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Minhas Indicações</h2>
</div>

<div class="indicacoes-container">
    <div class="niveis-indicacao">
        <p class="codigo-indicacao">Seu código de indicação: <strong>{{ Auth::user()->codigo_convite }}</strong></p>

        <h3>Seus Níveis</h3>
        <div class="cards-niveis">
            @php
                $percentuais = [15, 25, 40, 55, 80];
            @endphp

            @for ($i = 1; $i <= 5; $i++)
                <div class="card-nivel 
                    {{ $nivel_atual >= $i ? 'conquistado' : '' }} 
                    {{ $nivel_atual === $i ? 'atual' : '' }}">
                    
                    <p><strong>{{ $i < 5 ? 'Nível ' . $i : 'Nível Supremo' }}</strong></p>
                    <p>{{ $percentuais[$i - 1] }}%</p>

                    <div class="requisitos-nivel">
                        <ul>
                            @if ($i === 1)
                                <li>Confirmar e-mail</li>
                            @elseif ($i === 2)
                                <li>5 indicados com pelo menos R$100 investido</li>
                            @elseif ($i === 3)
                                <li>Completar o nível 2</li>
                                <li>Ter saldo de pelo menos R$5.000</li>
                            @elseif ($i === 4)
                                <li>5 indicados com pelo menos R$500 cada</li>
                                <li>Ter saldo de pelo menos R$15.000</li>
                            @elseif ($i === 5)
                                <li>10 indicados com pelo menos R$1.500 cada</li>
                                <li>Ter saldo de pelo menos R$25.000</li>
                                <li>Ter investido pelo menos R$100.000 no total</li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="info-indicacoes">
        <div class="resumo-indicacoes-card">
            <h3>Resumo</h3>
            <ul>
                <li><strong>Total de pessoas indicadas:</strong> {{ $total_indicados }}</li>
                <li><strong>Seu nível atual:</strong> {{ $nivel_atual < 5 ? 'Nível ' . $nivel_atual : 'Nível Supremo' }}</li>
                <li><strong>Porcentagem de ganho por indicado:</strong> {{ $percentuais[$nivel_atual - 1] }}%</li>
            </ul>
        </div>

        <div class="lista-indicacoes">
            <h3>Suas Indicações</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data da indicação</th>
                        <th>Investimento Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($indicados as $ind)
                        <tr>
                            <td>{{ $ind->name }}</td>
                            <td>{{ $ind->email }}</td>
                            <td>{{ $ind->created_at->format('d/m/Y') }}</td>
                            <td>R$ {{ number_format($ind->investimento_total, 2, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Nenhuma indicação cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
