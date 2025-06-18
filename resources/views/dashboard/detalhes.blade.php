@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Detalhes do Investimento</h2>
</div>

<div class="container">
    <div class="detalhes-investimento">
        <div class="info-geral">
            <h3>ImobCapital Renda Fixa</h3>
            <p><strong>Valor Investido:</strong> R$ {{ number_format($investimento->valor, 2, ',', '.') }}</p>
            <p><strong>Valor disponível para resgate:</strong> R$ {{ number_format($investimento->valor_atual, 2, ',', '.') }}</p>
            <p><strong>Rendimento Acumulado:</strong> R$ {{ number_format($investimento->rendimento_acumulado, 2, ',', '.') }}</p>
            <p><strong>Rendimento do Dia:</strong> R$ {{ number_format($rendimentoHoje, 2, ',', '.') }}</p>
            <p><strong>Data de Início:</strong> {{ \Carbon\Carbon::parse($investimento->data_inicio)->format('d/m/Y') }}</p>
            <p><strong>Vencimento:</strong> {{ \Carbon\Carbon::parse($investimento->data_vencimento)->format('d/m/Y') }}</p>
        </div>

        <h4>Histórico de Rentabilidade</h4>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f0f0f0;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Data</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">% Rentabilidade</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Rendimento (R$)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rentabilidades as $r)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ \Carbon\Carbon::parse($r->data_referencia)->format('d/m/Y') }}
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ number_format($r->rentabilidade_percentual, 2, ',', '.') }}%
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            R$ {{ number_format($investimento->valor * ($r->rentabilidade_percentual / 100), 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 10px;">Nenhum rendimento registrado ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

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
        <form method="POST" action="{{ route('investimentos.reinvestir', $investimento->id) }}">
            @csrf
            <label for="valor-reinvestir">Valor a reinvestir</label>
            <input type="text" name="valor" id="valor-reinvestir" required>

            <label for="fonte-reinvestir">Fonte dos recursos</label>
            <select name="fonte" id="fonte-reinvestir" required>
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

        <form action="{{ route('investimentos.resgatar', $investimento->id) }}" method="POST">
            @csrf

            <label for="valor-exibido">Valor a resgatar</label>
            <input type="text" id="valor-exibido" value="R$ {{ number_format($investimento->valor_atual, 2, ',', '.') }}" readonly>

            <!-- valor limpo enviado no POST -->
            <input type="hidden" name="valor" value="{{ $investimento->valor_atual }}">

            <button type="submit" class="btn">Confirmar Resgate</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
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

        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal')) {
                e.target.style.display = 'none';
            }
        });

        // Máscara de moeda (formato R$ com vírgula e ponto)
        new Cleave('#valor-reinvestir', {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.',
            numeralThousandsGroupStyle: 'thousand'
        });

        new Cleave('#valor-resgatar', {
            numeral: true,
            numeralDecimalMark: ',',
            delimiter: '.',
            numeralThousandsGroupStyle: 'thousand'
        });

        const saldo = {{ $investimento->valor_atual }};
        const percentualDia = {{ $rendimentoHoje > 0 ? ($rendimentoHoje / $investimento->valor) * 100 : 0 }};
        const segundosPorDia = 86400;
        let valorAtual = saldo;
        const ganhoPorSegundo = valorAtual * (percentualDia / 100) / segundosPorDia;
        const span = document.getElementById('valor-rendendo');
        if (span) {
            span.textContent = valorAtual.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            setInterval(() => {
                valorAtual += ganhoPorSegundo;
                span.textContent = valorAtual.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            }, 1000);
        }
    });
</script>

@endsection
