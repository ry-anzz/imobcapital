@extends('landingpage.app')

@section('content')
<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="register-logo">
            <h2>Cadastre-se na ImobCapital</h2>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nome completo</label>
                <input type="text" name="name" id="name" placeholder="Seu nome completo" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="seu@email.com" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" id="telefone" placeholder="(XX) XXXXX-XXXX" required>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="********" required>
            </div>


            <div class="form-group">
    <label for="password_confirmation">Confirme a Senha</label>
    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********" required>
</div>


            <div class="form-group">
                <label for="codigo_convite">Código de convite</label>
                <input type="text" name="codigo_convite" id="codigo_convite" placeholder="Código de convite (opcional)">
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" name="termos" id="termos" required>
                <label for="termos">Concordo com os <a href="#">Termos de Uso</a></label>
            </div>

            <button type="submit" class="btn-register">Cadastrar</button>

            @if ($errors->any())
    <div class="form-errors">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        </form>

        <p class="login-link">Já tem uma conta? <a href="{{ route('login') }}">Entre aqui</a></p>
    </div>
</div>
@endsection