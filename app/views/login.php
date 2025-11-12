<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechDex | Login</title>

    <link rel="stylesheet" href="/TechDex/public/assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
    <script src="/TechDex/public/assets/js/script.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

</head>

<body>

    <div class="container">
        <div class="welcome-card">
            <h1>Welcome!</h1>
            <p>Entre na plataforma TechDex e acesse seus estudos do mundo Tech.</p>
            <button>Saiba mais!</button>
        </div>

        <div class="card">
            <h2>Login</h2>

            <form id="form-login">
                <label>Usuário</label>
                <input type="text" placeholder="Username" name="username">

                <label>Senha</label>
                <input type="password" name="senha" placeholder="Senha">

                <button type="button" class="submit" onclick="entrar()">Entrar</button>
            </form>
            
            <p id="login_retorno"></p>

            <a href="#">Esqueceu sua senha? Clique aqui!</a>
        </div>
    </div>

</body>

</html>