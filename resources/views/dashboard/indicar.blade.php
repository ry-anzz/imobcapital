@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Minhas Indicações</h2>
   
</div>

<div class="indicacoes-container">
    <div class="niveis-indicacao">
         <p class="codigo-indicacao">Seu código de indicação: <strong>ABC123</strong></p>
        <h3>Seus Níveis</h3>
        <div class="cards-niveis">
            @for ($i = 1; $i <= 10; $i++)
                <div class="card-nivel {{ $i <= 4 ? 'conquistado' : '' }} {{ $i === 4 ? 'atual' : '' }}">
                    <p><strong>Nível {{ $i }}</strong></p>
                    <p>{{ 10 + ($i - 1) * 5 }}%</p>
                </div>
            @endfor
        </div>
    </div>

    <div class="info-indicacoes">
        <div class="resumo-indicacoes-card">
            <h3>Resumo</h3>
            <ul>
                <li><strong>Total de pessoas indicadas:</strong> 4</li>
                <li><strong>Seu nível atual:</strong> Nível 4</li>
                <li><strong>Porcentagem de ganho por indicado:</strong> 25%</li>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>João Silva</td>
                        <td>joao@email.com</td>
                        <td>01/06/2025</td>
                    </tr>
                    <tr>
                        <td>Maria Santos</td>
                        <td>maria@email.com</td>
                        <td>02/06/2025</td>
                    </tr>
                    <tr>
                        <td>Pedro Lima</td>
                        <td>pedro@email.com</td>
                        <td>03/06/2025</td>
                    </tr>
                    <tr>
                        <td>Ana Paula</td>
                        <td>ana@email.com</td>
                        <td>04/06/2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
