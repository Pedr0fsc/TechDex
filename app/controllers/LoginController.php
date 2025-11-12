<?php

include "../models/usuario.php";
global $key;

$username_enc = $_POST["username"] ?? "";
$senha_enc = $_POST["senha"] ?? "";

if (!$username_enc || !$senha_enc) {
    echo json_encode(["status"=>"n","mensagem"=>"Preencha todos os campos!"]);
    exit;
}

$username = decrypt_aes256cbc_js($username_enc, $key);
$senha = decrypt_aes256cbc_js($senha_enc, $key);

if ($username === '' || $senha === '') {
    echo json_encode(["status"=>"n","mensagem"=>"Erro ao descriptografar campos."]);
    exit;
}

$resultado = entrar_usuario($username, $senha);
echo json_encode($resultado);
