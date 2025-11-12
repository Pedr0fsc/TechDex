<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechDex</title>
    <link rel="stylesheet" href="/TechDex/public/assets/css/index.css">
    <link rel="stylesheet" href="/TechDex/public/assets/fonts/fontawesome-free-web/fontawesome-free-web/css/all.css">
</head>
<body>
    <header>
        <div class="logo">
            <i class="fa-solid fa-code"></i>
            <p>TechDex</p>
        </div>
        
        <div class="login">
            <div class="menu">
                <button class="botao-user">
                    <i class="fa-solid fa-user"></i>
                    <span>Entrar</span>
                </button>
                <div class="estrutura-menu">
                    <a href="app/views/login.php">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Login
                    </a>
                    <a href="app/views/cadastro.php">
                        <i class="fa-solid fa-user-plus"></i>
                        Cadastrar
                    </a>
                </div>
            </div>
        </div>
    </header>

    <section class="welcome" id="inicio">
        <div class="welcome-content">
            <h1>WELCOME</h1>
            <p class="texto-1">Organize seu conhecimento tech de forma inteligente e eficiente</p>
            <p class="texto-2">Você quer se juntar a nós?</p>
            <div class="welcome-buttons">
                <a href="app/views/cadastro.php" class="botao comecar">Começar Agora</a>
            </div>
        </div>
        <div class="imagem">
            <i class="fa-solid fa-laptop-code"></i>
        </div>
    </section>
</body>
</html>