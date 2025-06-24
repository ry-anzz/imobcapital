@extends('landingpage.app')

@section('content')
<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="register-logo">
            <h2>Cadastre-se na ImobCapital</h2>
        </div>

        <form method="POST" action="{{ route('register') }}" id="formRegister">
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
                
                <div style="display: flex; gap: 8px;">
                    <select name="ddd" id="ddd" required style="flex: 0 0 40px;">
                        <option value="+55" selected>🇧🇷 +55</option>
                        <option value="+1">🇺🇸 +1</option>
                        <option value="+351">🇵🇹 +351</option>
                        <option value="+44">🇬🇧 +44</option>
                        <option value="+34">🇪🇸 +34</option>
                        <option value="+49">🇩🇪 +49</option>
                        <option value="+33">🇫🇷 +33</option>
                        <option value="+81">🇯🇵 +81</option>
                        <option value="+61">🇦🇺 +61</option>
                    </select>

                    <input type="tel" name="telefone" id="telefone" placeholder="Digite o telefone" required>
                </div>

            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="********" required>

                <div class="password-strength" style="height: 5px; background: #ddd; margin-top: 5px; border-radius: 3px;">
                    <div id="strengthBar" style="height: 5px; width: 0%; background: red; border-radius: 3px;"></div>
                </div>

                <small style="display: block; margin-top: 5px;">
                    Sua senha deve conter pelo menos:
                    <ul style="margin-top: 5px;">
                        <li>Mínimo 8 caracteres</li>
                        <li>Letras maiúsculas e minúsculas</li>
                        <li>Números</li>
                        <li>Caracteres especiais (!@#$%&*)</li>
                    </ul>
                </small>
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

            <button type="submit" class="btn-register" id="btnRegister" disabled>Cadastrar</button>

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

<script>
// Máscaras por país
const masks = {
    '+55': '(##) #####-####',
    '+1': '(###) ###-####',
    '+351': '## ### ####',
    '+44': '#### ### ####',
    '+34': '### ### ###',
    '+49': '#### ####',
    '+33': '## ## ## ## ##',
    '+81': '##-####-####',
    '+61': '#### ### ###'
};

const dddSelect = document.getElementById('ddd');
const telefoneInput = document.getElementById('telefone');

function applyMask(value, mask) {
    let numbers = value.replace(/\D/g, '');
    let result = '';
    let idx = 0;

    for (let m of mask) {
        if (m === '#' && numbers[idx]) {
            result += numbers[idx++];
        } else if (m !== '#') {
            result += m;
        }
    }
    return result;
}

function updatePlaceholder() {
    const selectedDDD = dddSelect.value;
    const mask = masks[selectedDDD] || 'Digite o telefone';
    telefoneInput.placeholder = mask;
    telefoneInput.value = '';
    telefoneInput.maxLength = mask.replace(/[^#]/g, '').length + mask.replace(/#/g, '').length;
}

dddSelect.addEventListener('change', updatePlaceholder);

telefoneInput.addEventListener('input', function(e) {
    const selectedDDD = dddSelect.value;
    const mask = masks[selectedDDD];

    if (mask) {
        e.target.value = applyMask(e.target.value, mask);
    }
});

updatePlaceholder();

// Validação da senha
const passwordInput = document.getElementById('password');
const strengthBar = document.getElementById('strengthBar');
const btnRegister = document.getElementById('btnRegister');
const formRegister = document.getElementById('formRegister');

passwordInput.addEventListener('input', function() {
    const value = passwordInput.value;

    const hasUpper = /[A-Z]/.test(value);
    const hasLower = /[a-z]/.test(value);
    const hasNumber = /[0-9]/.test(value);
    const hasSpecial = /[!@#\$%\^&\*\(\)\-\_\+=\.]/.test(value);
    const hasMinLength = value.length >= 8;

    let score = 0;
    if (hasUpper) score++;
    if (hasLower) score++;
    if (hasNumber) score++;
    if (hasSpecial) score++;
    if (hasMinLength) score++;

    // Atualiza barra de força
    let width = (score / 5) * 100;
    strengthBar.style.width = width + '%';

    if (score <= 2) {
        strengthBar.style.background = 'red';
    } else if (score <= 4) {
        strengthBar.style.background = 'orange';
    } else {
        strengthBar.style.background = 'green';
    }

    // Habilita botão apenas se todos requisitos atendidos
    if (score === 5) {
        btnRegister.disabled = false;
    } else {
        btnRegister.disabled = true;
    }
});
</script>
@endsection
