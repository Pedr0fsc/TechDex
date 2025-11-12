<?php

include "../models/usuario.php";

global $key;

$nome_enc = $_POST["nome"] ?? "";
$username_enc = $_POST["username"] ?? "";
$email_enc = $_POST["email"] ?? "";
$senha_enc = $_POST["senha"] ?? "";

if (!$nome_enc || !$username_enc || !$email_enc || !$senha_enc) {
    echo json_encode(["status" => "n", "mensagem" => "Preencha todos os campos!"]);
    exit;
}

// Descriptografa com o mesmo formato usado no JS (IV + ciphertext base64)
$nome = decrypt_aes256cbc_js($nome_enc, $key);
$username = decrypt_aes256cbc_js($username_enc, $key);
$email = decrypt_aes256cbc_js($email_enc, $key);
$senha = decrypt_aes256cbc_js($senha_enc, $key);

if ($nome === '' || $username === '' || $email === '' || $senha === '') {
    echo json_encode(["status" => "n", "mensagem" => "Erro ao descriptografar campos."]);
    exit;
}

$resultado = cadastrar_usuario($nome, $username, $email, $senha);

if ($resultado) {
    $retorno = [
        "status" => "s",
        "mensagem" => "Cadastrado com sucesso!"
    ];
} else {
    $retorno = [
        "status" => "n",
        "mensagem" => "Falha ao cadastrar!"
    ];
}

echo json_encode($retorno);