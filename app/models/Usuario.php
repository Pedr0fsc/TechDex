<?php

include "../core/Conexao.php";

function load_simple_env($path) {
    $vars = [];
    if (!file_exists($path)) return $vars;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (!strpos($line, '=')) continue;
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if ($value && ($value[0] === '"' || $value[0] === "'")) {
            $value = substr($value, 1, -1);
        }
        $vars[$name] = $value;
    }
    return $vars;
}

$env = load_simple_env(__DIR__ . "/../.env");
$key = $env['AES_KEY'] ?? null;

if (!is_string($key) || strlen($key) !== 32) {
    $key = '12345678901234567890123456789012';
}

function encrypt_aes256cbc(string $plaintext, string $key): string {
    $method = 'AES-256-CBC';
    $ivlen = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $cipher_raw = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $cipher_raw);
}

function decrypt_aes256cbc_js(string $ciphertext_base64, string $key): string {
    $method = 'AES-256-CBC';
    $ciphertext_base64 = trim($ciphertext_base64);
    $ciphertext_base64 = str_replace(' ', '+', $ciphertext_base64);

    $data = base64_decode($ciphertext_base64, true);
    if ($data === false) {
        error_log("Falha ao decodificar base64: " . substr($ciphertext_base64, 0, 30));
        return '';
    }

    $ivlen = openssl_cipher_iv_length($method);
    if (strlen($data) < $ivlen) {
        error_log("IV inválido: tamanho " . strlen($data) . " (esperado >= $ivlen)");
        return '';
    }

    $iv = substr($data, 0, $ivlen);
    $ciphertext = substr($data, $ivlen);

    $decrypted = openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
    if ($decrypted === false) {
        error_log("Falha ao descriptografar: " . openssl_error_string());
        return '';
    }
    return $decrypted;
}

function cadastrar_usuario($nome, $username, $email, $senha)
{
    global $conection;

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = mysqli_stmt_init($conection);
    $sql = "INSERT INTO usuario (nome, username, email, senha) VALUES (?, ?, ?, ?)";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $username, $email, $senha_hash);
    $resultado = mysqli_stmt_execute($stmt);

    return $resultado;
}

function entrar_usuario($username, $senha)
{
    global $conection;

    $stmt = mysqli_stmt_init($conection);
    $query = "SELECT * FROM usuario WHERE username = ?";
    if (!mysqli_stmt_prepare($stmt, $query)) {
        return ["status"=>"n","mensagem"=>"Erro no sistema."];
    }
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        if (password_verify($senha, $usuario['senha'])) {
            unset($usuario['senha']);
            return [
                "status" => "s",
                "mensagem" => "Login bem-sucedido!",
                "usuario" => $usuario
            ];
        } else {
            return ["status" => "n", "mensagem" => "Senha incorreta!"];
        }
    } else {
        return ["status" => "n", "mensagem" => "Usuário não encontrado!"];
    }
}