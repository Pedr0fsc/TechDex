<?php
include "../models/usuario.php";

$nome = $_POST["nome"] ?? "";
$username = $_POST["username"] ?? "";
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";

if ($nome && $username && $email && $senha) {
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
} else {
    $retorno = [
        "status" => "n",
        "mensagem" => "Preencha todos os campos!"
    ];
}

echo json_encode($retorno);