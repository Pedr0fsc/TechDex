<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechDex</title>
    <link rel="stylesheet" href="/TechDex/public/assets/css/home.css">
    <link rel="stylesheet" href="/TechDex/public/assets/fonts/fontawesome-free-web/fontawesome-free-web/css/all.css">
    <script defer src="/TechDex/public/assets/js/folders.js"></script>
</head>
<body>
    <header>

            <div class="header-logo">
                <i class="fa-solid fa-code"></i>
                <p>TechDex</p>
            </div>
            <div class="header-login">
                <p>usuario</p>
                <i class="fa-solid fa-user"></i>
                <i class="fa-solid fa-right-from-bracket"><a href="/TechDex/app/views/login.php"></a></i>
            </div>
           
    </header>
    <div class="principal">
        <div class="principal-barra-pesquisa">
                <div class="principal-barra-pesquisa-botoes">
                    <a  class="botao" href="/TechDex/app/views/itens.php">Itens</a>
                    <a class="botao" href="/TechDex/app/views/folders.php">Minhas pastas</a>
                </div>
            <input  type="text" placeholder="Buscar...">     
        <div class="principal-itens-cabecario">
            <span>Todas as minhas pastas</span>
            <button class="botao"> + Adicionar</button>
        </div>
        <div id="list">
      

        </div>

    </div>
    <footer>
        <div></div>

    </footer>
    
</body>
</html>