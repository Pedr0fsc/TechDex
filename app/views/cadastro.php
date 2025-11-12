<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechDex | Sign Up</title>

    <link rel="stylesheet" href="/TechDex/public/assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
    <script src="/TechDex/public/assets/js/script.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="card">
            <h2>Sign Up</h2>

            <form id="form-cadastro" class="form">

                <label>Nome</label>
                <input type="text" name="nome" placeholder="Nome" /><br>

                <label>Nome de usuário</label>
                <input type="text" name="username" placeholder="Username" /><br>

                <label>Email</label>
                <input type="email" name="email" placeholder="E-mail" /><br>

                <label>Senha</label>
                <input type="password" name="senha" placeholder="Senha" /><br>

                <button type="button" class="submit" onclick="cadastrar()"> Cadastrar </button>
            </form>

            <p id="cadastro_retorno"></p>
        </div>
    </div>

</body>

</html>