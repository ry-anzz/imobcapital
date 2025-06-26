    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>ImobCapital</title>

        <link rel="stylesheet" href="{{ asset('css/dashboard/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard/home.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard/carteira.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard/detalhes.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard/conta.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard/investir.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard/investiradm.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard/indicar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard/perfil.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{asset('images/fav.ico')}}">
    </head>
    <body>

    <div class="dashboard-container">
        <aside class="sidebar" id="sidebar">
        <div class="sidebar-header user-profile">
        <img src="{{ asset('images/fav.ico') }}" alt="Foto do usuário" class="user-photo">
        <div class="user-level">
        <div class="user-info">
        Olá, {{ explode(' ', Auth::user()->name)[0] ?? 'Usuário' }}
    </div>


            <span style="color:#FFA500">Nível {{Auth::user()->nivel}}</span>
        </div>
    </div>



            <nav class="sidebar-nav">
                <ul>    
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <a href="/dashboard">
            <span class="material-symbols-outlined icon">home</span>
            <span class="text">Home</span>
        </a>
    </li>
    <li class="{{ request()->is('dashboard/carteira') ? 'active' : '' }}">
        <a href="/dashboard/carteira">
            <span class="material-symbols-outlined icon">monitoring</span>
            <span class="text">Carteira</span>
        </a>
    </li>
    <li class="{{ request()->is('dashboard/investir') ? 'active' : '' }}">
        <a href="/dashboard/investir">
            <span class="material-symbols-outlined icon">paid</span>
            <span class="text">Investir</span>
        </a>
    </li>

@if (Auth::check() && Auth::user()->email === 'vicenteryan385@gmail.com')
    <li class="{{ request()->is('dashboard/investiradm') ? 'active' : '' }}">
        <a href="/dashboard/investiradm">
            <span class="material-symbols-outlined icon">bar_chart</span>
            <span class="text">Investir ADM</span>
        </a>
    </li>
@endif


    <li class="{{ request()->is('dashboard/conta') ? 'active' : '' }}">
        <a href="/dashboard/conta">
            <span class="material-symbols-outlined icon">wallet</span>
            <span class="text">Conta</span>
        </a>
    </li>
    <li class="{{ request()->is('dashboard/indicar') ? 'active' : '' }}">
        <a href="/dashboard/indicar">
            <span class="material-symbols-outlined icon">featured_seasonal_and_gifts</span>
            <span class="text">Indicar</span>
        </a>
    </li>
    <li class="{{ request()->is('dashboard/perfil') ? 'active' : '' }}">
        <a href="/dashboard/perfil">
            <span class="material-symbols-outlined icon">account_circle</span>
            <span class="text">Perfil</span>
        </a>
    </li>
        
            <li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                <span class="material-symbols-outlined icon">logout</span>
                <span class="text">Sair</span>
            </button>
        </form>
        

                </ul>
            </nav>
        </aside>

        <div class="main-content">
            <header class="topbar">
            <button id="toggle-sidebar" class="sidebar-toggle">
        <span id="sidebar-icon" class="material-symbols-outlined" style="color:#e85408">chevron_left</span>
    </button>

                <button id="mobile-menu-btn" class="mobile-menu-btn">
        <span class="material-symbols-outlined">menu</span>
    </button>


                <div class="user-info-group">
                    <div class="user-info">Olá, Usuário</div>
                @php
        $saldo = auth()->user()->saldo ?? 0;
        // Formata para R$ 1.234,56
        $saldoFormatado = 'R$ ' . number_format($saldo, 2, ',', '.');
    @endphp

    <div class="user-balance">
        <span class="value" data-value="{{ $saldoFormatado }}">****</span>
        <button id="toggle-visibility" class="toggle-visibility">
            <span class="material-symbols-outlined">visibility_off</span>
        </button>
    </div>

                </div>
            </header>

            <main class="content-area">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggleSidebarBtn = document.getElementById('toggle-sidebar');
        const sidebarIcon = document.getElementById('sidebar-icon');
        const toggleVisibilityBtn = document.getElementById('toggle-visibility');
        const icon = toggleVisibilityBtn.querySelector('.material-symbols-outlined');
        const values = document.querySelectorAll('.value');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const overlay = document.getElementById('overlay');

        let isVisible = false;

        // Sempre iniciar com sidebar aberto
        localStorage.setItem('sidebarClosed', false);
        sidebar.classList.remove('closed');
        sidebarIcon.textContent = 'chevron_left';

        toggleSidebarBtn.addEventListener('click', () => {
            sidebar.classList.toggle('closed');
            const isClosed = sidebar.classList.contains('closed');
            sidebarIcon.textContent = isClosed ? 'chevron_right' : 'chevron_left';
            localStorage.setItem('sidebarClosed', isClosed);
        });

        toggleVisibilityBtn.addEventListener('click', () => {
            isVisible = !isVisible;
            values.forEach(el => {
                el.textContent = isVisible ? el.dataset.value : '****';
            });
            icon.textContent = isVisible ? 'visibility' : 'visibility_off';
        });

        // Abrir menu mobile
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
        });

        // Fechar ao clicar no overlay
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        });
    });
    </script>



    <div id="overlay" class="overlay"></div>

    </body>
    </html>
