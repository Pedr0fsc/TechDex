<?php
include "../core/Conexao.php";

function descriptografar($dados_criptografados) {
    $chave = getenv('AES_KEY');
    $iv = getenv('AES_IV');
    $dados_decodificados = base64_decode($dados_criptografados);

    return openssl_decrypt($dados_decodificados, 'AES-256-CBC', $chave, OPENSSL_RAW_DATA, $iv);
}


function cadastrar_usuario($nome, $username, $email, $senha)
{
    global $conection;

    // Descriptografa os dados vindos do JS
    $nome = descriptografar($nome);
    $username = descriptografar($username);
    $email = descriptografar($email);
    $senha = descriptografar($senha);

    // Criptografa a senha para o banco (hash)
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = mysqli_stmt_init($conection);
    $sql = "INSERT INTO usuario (nome, username, email, senha) VALUES (?, ?, ?, ?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $username, $email, $senha_hash);
    $resultado = mysqli_stmt_execute($stmt);

    return $resultado;
}

function entrar_usuario($username, $senha)
{
    global $conection;

    // Descriptografa os dados recebidos
    $username = descriptografar($username);
    $senha = descriptografar($senha);

    $stmt = mysqli_stmt_init($conection);
    $query = "SELECT * FROM usuario WHERE username = ?";
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        if (password_verify($senha, $usuario['senha'])) {
            return [
                "status" => "s",
                "mensagem" => "Login bem-sucedido!",
                "usuario" => $usuario
            ];
        } else {
            return [
                "status" => "n",
                "mensagem" => "Senha incorreta!"
            ];
        }
    } else {
        return [
            "status" => "n",
            "mensagem" => "Usuário não encontrado!"
        ];
    }
}