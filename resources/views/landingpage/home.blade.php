        @extends('landingpage.app')

        @section('content')

       <header class="site-header">
    <div class="container">
        <div class="logo">
            <a href="#welcome-section">
                <img src="{{ asset('images/logo.png') }}" alt="ImobCapital" id="logo" />
            </a>
        </div>

        {{-- Menu hambúrguer para mobile --}}
        <div class="mobile-menu-toggle" id="mobile-menu-toggle">
            <span class="material-symbols-outlined">menu</span>
        </div>

        {{-- Menu de navegação para desktop --}}
        <nav class="nav-links desktop-only">
            <a href="#como-funciona">Como funciona</a>
            <a href="#sobre-nos">Sobre nós</a>
            <a href="#contato">Contato</a>
        </nav>
        
{{-- Menu do usuário no desktop --}}
<div class="profile-dropdown desktop-only">
    <span class="material-symbols-outlined">account_circle</span>
    <div class="dropdown-menu">
        <a href="{{ route('login') }}">Entrar</a>
        <a href="{{ route('register') }}">Cadastrar</a>
    </div>
</div>


    {{-- Menu hambúrguer mobile expandido --}}
    <div class="mobile-dropdown" id="mobile-dropdown">
       <a href="{{ route('login') }}">Entrar</a>
        <a href="{{ route('register') }}">Cadastrar</a>
    </div>
</header>


        <section class="welcome-section" id="welcome-section">
            <div class="container">
                <h1>Bem-vindo ao <span id="typing-text"></span></h1>
            </div>
            <p>Uma nova forma de gerenciar, visualizar e aproveitar seu patrimônio.<br>
                Simples, rápido e com total controle na palma da sua mão.</p>

                <div class="btns" >
                <a href="{{route('register')}}"><button class="btn-comecar">Começar agora</button></a>
                <a href="#como-funciona"><button class="btn-saiba">Saiba Mais</button></a>
                </div>
                
        </section>

        <section class="como-funciona" id="como-funciona">
            <div class="container">
                <h2 class="section-title">Como Funciona</h2>
    <p class="section-subtitle">
        Na ImobCapital, simplificamos seus investimentos imobiliários com uma plataforma intuitiva que coloca o controle total do seu patrimônio na palma da sua mão.
    </p>

    <div class="steps-container">
        <div class="step">
            <div class="icon">📝</div>
            <h3>Cadastro Fácil</h3>
            <p>Crie sua conta rapidamente e comece a acessar todos os recursos da plataforma sem complicação.</p>
        </div>
        <div class="step">
            <div class="icon">📊</div>
            <h3>Análise de Investimentos</h3>
            <p>Utilize ferramentas avançadas para analisar imóveis, riscos e rentabilidades, para tomar decisões seguras.</p>
        </div>
        <div class="step">
            <div class="icon">📈</div>
            <h3>Monitoramento em Tempo Real</h3>
            <p>Acompanhe a valorização e o desempenho do seu portfólio com dashboards claros e atualizados automaticamente.</p>
        </div>
    </div>
</div>
 </section>

 <section class="sobre-nos" id="sobre-nos">
    <div class="container">
        <h2 class="section-title">Sobre Nós</h2>
        <p class="section-subtitle">
            Na <strong>ImobCapital</strong>, nossa missão é transformar a forma como você gerencia seus bens imobiliários.<br>
            Com tecnologia de ponta, oferecemos uma plataforma intuitiva, acessível e segura para que você tenha o controle total do seu patrimônio.
        </p>

        <div class="sobre-grid">
            <div class="sobre-box">
                <h3>🌐 Inovação</h3>
                <p>Estamos sempre em busca de soluções tecnológicas para facilitar a sua jornada como investidor.</p>
            </div>
            <div class="sobre-box">
                <h3>🔒 Segurança</h3>
                <p>Seus dados e informações financeiras são protegidos com os mais altos padrões de segurança.</p>
            </div>
            <div class="sobre-box">
                <h3>👥 Transparência</h3>
                <p>Trabalhamos com clareza e compromisso, oferecendo total transparência em nossos processos.</p>
            </div>
        </div>
    </div>
    <h2 class="section-title">Nossa Jornada</h2>
        <p class="section-subtitle">Da ideia à inovação, construindo o futuro dos investimentos imobiliários.</p>

        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-icon">💡</div>
                <div class="timeline-content">
                    <h4>Início da Ideia</h4>
                    <p>Percebemos a dificuldade das pessoas em controlar seus imóveis de forma simples e digital.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon">🚀</div>
                <div class="timeline-content">
                    <h4>Lançamento da Plataforma</h4>
                    <p>Com uma equipe dedicada, criamos a ImobCapital para tornar o gerenciamento de patrimônio acessível.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon">🌍</div>
                <div class="timeline-content">
                    <h4>Expansão Nacional</h4>
                    <p>Usuários em todo o Brasil já utilizam a plataforma com confiança e praticidade.</p>
                </div>
            </div>
        </div>
</section>

<section class="reviews-section">
    <div class="container">
        <h2 class="section-title">O que nossos usuários dizem</h2>
        <div class="reviews-container">

            <div class="review-card">
                <div class="review-header">
                    <strong>Camila Ferreira</strong>
                    <span class="stars">★★★★★</span>
                </div>
                <p>Simplesmente incrível! A plataforma me ajudou a ter total controle dos meus imóveis. Interface intuitiva e prática.</p>
            </div>

            <div class="review-card">
                <div class="review-header">
                    <strong>Rafael Oliveira</strong>
                    <span class="stars">★★★★☆</span>
                </div>
                <p>Plataforma muito funcional. Consigo acompanhar meus imóveis com facilidade e segurança. Recomendo para quem quer praticidade.</p>
            </div>

            <div class="review-card">
                <div class="review-header">
                    <strong>Ana Souza</strong>
                    <span class="stars">★★★★★</span>
                </div>
                <p>Ótimo atendimento e muito fácil de usar. Recomendo a todos que querem investir com segurança.</p>
            </div>

        </div>
    </div>
</section>


<section class="contato-section" id="contato">
    <div class="container">
        <h2 class="section-title">Fale com a gente</h2>
        <p class="section-subtitle">Tem dúvidas, sugestões ou quer saber mais? Envie uma mensagem!</p>

        <form method="POST"  class="contato-form">
            @csrf
            <div class="form-group">
                <input type="text" name="nome" placeholder="Seu nome" required>
                <input type="email" name="email" placeholder="Seu e-mail" required>
            </div>
            <textarea name="mensagem" rows="5" placeholder="Escreva sua mensagem..." required></textarea>
            <button type="submit" class="btn-enviar">Enviar</button>
        </form>
    </div>
</section>



       <footer class="site-footer">
    <div class="footer-top">
        <img src="{{ asset('images/logo.png') }}" alt="ImobCapital" class="footer-logo" />
        <p class="footer-slogan">Investimento rápido, fácil e confiável.</p>
    </div>

    <hr class="footer-divider" />

    <div class="footer-links">
        <div class="footer-col">
            <h4>Fale Conosco</h4>
            <p>📞 +55 11 9999999</p>
            <p>✉️ imobcapital@gmail.com</p>
            <p>🌍 EUA</p>
        </div>

        <div class="footer-col">
            <h4>Site</h4>
            <ul>
                <li><a href="#">Consultar</a></li>
                <li><a href="#sobre-nos">Sobre Nós</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Legal</h4>
            <ul>
                <li><a href="#">Política</a></li>
                <li><a href="#">Termos e Serviços</a></li>
                <li><a href="#">Política de Reembolso</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Nos siga na redes sociais</h4>
            <ul>
                
                <li><a href="#">📘 Facebook</a></li>
                <li><a href="#">📸 Instagram</a></li>
            </ul>
        </div>
    </div>
</footer>







        <script>
            const textElement = document.getElementById("typing-text");
            const text = "ImobCapital";
            let index = 0;
            let isDeleting = false;

            function typeEffect() {
                if (!isDeleting) {
                    textElement.textContent = text.slice(0, index + 1);
                    index++;
                    if (index === text.length) {
                        isDeleting = true;
                        setTimeout(typeEffect, 1000); // pausa antes de apagar
                        return;
                    }
                } else {
                    textElement.textContent = text.slice(0, index - 1);
                    index--;
                    if (index === 0) {
                        isDeleting = false;
                    }
                }
                setTimeout(typeEffect, isDeleting ? 100 : 100); // velocidade de digitar/apagar
            }

            document.addEventListener("DOMContentLoaded", typeEffect);

            document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("mobile-menu-toggle");
        const dropdown = document.getElementById("mobile-dropdown");

        toggle.addEventListener("click", function () {
            dropdown.classList.toggle("show");
        });
    });
        </script>




        @endsection
