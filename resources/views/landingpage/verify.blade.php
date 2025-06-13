@extends('landingpage.app')

@section('content')
<div class="verify-code-container">
    <h2>Digite o código enviado para seu e-mail</h2>

   @if(session('password_reset_email'))
    <p>Código enviado para: <strong>{{ session('password_reset_email') }}</strong></p>
@endif

<form method="POST" action="{{ route('password.verify') }}">
    @csrf

  <input type="hidden" name="email" value="{{ session('password_reset_email') ?? old('email') }}">



    <div class="form-group">
        <label for="code">Código de 6 dígitos</label>
        <input type="text" name="code" id="code" maxlength="6" required autofocus>
        @error('code')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Verificar código</button>
</form>

<p><a href="{{ route('password.request') }}">Voltar para pedir novo código</a></p>

</div>
@endsection
