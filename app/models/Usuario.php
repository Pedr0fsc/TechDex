<?php
include "../core/Conexao.php";

/**
 * Criptografa texto com AES-256-CBC
 */
function criptografar($texto) {
    $chave = getenv('AES_KEY');
    $iv = getenv('AES_IV');

    $criptografado = openssl_encrypt($texto, 'AES-256-CBC', $chave, OPENSSL_RAW_DATA, $iv);
    return base64_encode($criptografado); // codifica para armazenar no banco
}

/**
 * Descriptografa texto com AES-256-CBC
 */
function descriptografar($texto_cripto) {
    $chave = getenv('AES_KEY');
    $iv = getenv('AES_IV');

    $dados_decod = base64_decode($texto_cripto);
    return openssl_decrypt($dados_decod, 'AES-256-CBC', $chave, OPENSSL_RAW_DATA, $iv);
}

/**
 * Cadastra novo usuário
 */
function cadastrar_usuario($nome, $username, $email, $senha)
{
    global $conection;

    // 🔐 Criptografa campos
    $nome_enc = criptografar($nome);
    $username_enc = criptografar($username);
    $email_enc = criptografar($email);

    // ✅ Gera um hash determinístico do username para busca posterior
    $username_hash = hash('sha256', $username);

    // 🔑 Hasheia a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = mysqli_stmt_init($conection);
    $sql = "INSERT INTO usuario (nome, username, username_hash, email, senha)
            VALUES (?, ?, ?, ?, ?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $nome_enc, $username_enc, $username_hash, $email_enc, $senha_hash);
    $resultado = mysqli_stmt_execute($stmt);

    return $resultado;
}


/**
 * Faz login do usuário
 */
function entrar_usuario($username, $senha)
{
    global $conection;

    // ⚠️ Usa o mesmo hash SHA-256 do cadastro
    $username_hash = hash('sha256', $username);

    $stmt = mysqli_stmt_init($conection);
    $query = "SELECT * FROM usuario WHERE username_hash = ?";
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 's', $username_hash);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        if (password_verify($senha, $usuario['senha'])) {
            $usuario['nome'] = descriptografar($usuario['nome']);
            $usuario['username'] = descriptografar($usuario['username']);
            $usuario['email'] = descriptografar($usuario['email']);
            return ["status" => "s", "mensagem" => "Login bem-sucedido!", "usuario" => $usuario];
        } else {
            return ["status" => "n", "mensagem" => "Senha incorreta!"];
        }
    } else {
        return ["status" => "n", "mensagem" => "Usuário não encontrado!"];
    }
}