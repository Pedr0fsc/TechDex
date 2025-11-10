<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="/TechDex/public/assets/css/style.css">
    <script src="/TechDex/public/assets/js/script.js" defer></script>

</head>

<body>
    <div class="body_container">
        <div class="header_partial">
            <?php include "./partials/header.php"; ?>
        </div>
        <div class="form_content">
            <h2>Sign Up</h2>

            <form id="form-cadastro" class="form_inputs">
                <input type="text" name="nome" placeholder="Nome" /><br>
                <input type="text" name="username" placeholder="Username" /><br>
                <input type="email" name="email" placeholder="E-mail" /><br>
                <input type="password" name="senha" placeholder="Senha" /><br>
                <button type="button" onclick="cadastrar()"> Cadastrar </button>
            </form>

            <p id="campo_retorno"></p>
        </div>
        <div class="footer_partial">
            <?php include "./partials/footer.php"; ?>
        </div>
    </div>

</body>

</html>