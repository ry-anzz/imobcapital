@extends('dashboard.app')

@section('content')
<div class="dashboard-title">
    <h2>Meu Perfil</h2>
</div>

<div class="perfil-wrapper">
    <!-- Card Dados do Usuário -->
    <div class="card perfil-card">
        <h3>Dados do Usuário</h3>
        <form action="" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" value="Ryan Vicente" required>
            </div>

            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="vicente@gmail.com" required>
            </div>

            <div class="input-group">
                <label for="codigo_indicacao">Código de Indicação</label>
                <input id="codigo_indicacao" value="ABC123" readonly>
            </div>

            <div class="input-group">
                <label for="data_cadastro">Data de Cadastro</label>
                <input  id="data_cadastro" value="06/06/2025" readonly>
            </div>

            <button type="submit" class="btn btn-laranja">Atualizar Dados</button>
        </form>
    </div>

    <!-- Card Trocar Senha -->
    <div class="card senha-card">
        <h3>Trocar Senha</h3>
        <form action="" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label for="senha_atual">Senha Atual</label>
                <input type="password" name="senha_atual" required>
            </div>

            <div class="input-group">
                <label for="nova_senha">Nova Senha</label>
                <input type="password" name="nova_senha" required>
            </div>

            <div class="input-group">
                <label for="confirmar_senha">Confirmar Nova Senha</label>
                <input type="password" name="confirmar_senha" required>
            </div>

            <button type="submit" class="btn btn-laranja">Atualizar Senha</button>
        </form>
    </div>
</div>
@endsection
