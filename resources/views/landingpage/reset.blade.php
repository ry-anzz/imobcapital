@extends('landingpage.app')

@section('content')
<div class="reset-password-container">

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h2>Redefinir senha</h2>

    <form method="POST" action="{{ route('password.reset') }}">
        @csrf

       <input type="hidden" name="email" value="{{ session('password_reset_email') ?? request('email') }}">


        <div class="form-group">
            <label for="password">Nova senha</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirme a nova senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <button type="submit">Redefinir senha</button>
    </form>
</div>
@endsection
