@extends('landingpage.app')

@section('content')
<div class="register-container">
    <div class="register-card">
        <h2>Confirmação de E-mail</h2>
        <p>Verifique sua caixa de entrada e clique no link enviado para ativar sua conta.</p>

        @if (session('message'))
            <p style="color: green;">{{ session('message') }}</p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-register">Reenviar link de verificação</button>
        </form>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Sair da conta
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
@endsection
