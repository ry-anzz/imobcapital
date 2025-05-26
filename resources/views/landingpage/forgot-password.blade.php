@extends('landingpage.app')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="login-logo">
            <h2>Esqueceu a senha?</h2>
            <p>Digite seu e-mail para receber o link de recuperação</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="seu@email.com" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login" style="background-color:#e85408;">Enviar link</button>
        </form>

        <p class="register-link">
            <a href="{{ route('login') }}">Voltar para login</a>
        </p>
    </div>
</div>
@endsection
