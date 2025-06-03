@extends('landingpage.app')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="login-logo">
            <h2>Entrar na ImobCapital</h2>
        </div>

        
            @csrf

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="seu@email.com" required>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="********" required>
            </div>

            <div class="form-options">
                <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
            </div>

            <a href="{{route('dashboard')}}"><button type="submit" class="btn-login">Entrar</button></a>
        

        <p class="register-link">Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se</a>
</p>
    </div>
</div>
@endsection
