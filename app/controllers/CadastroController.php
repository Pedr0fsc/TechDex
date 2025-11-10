<?php
include "../models/usuario.php";

$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";

if ($nome && $email && $senha) {
    $resultado = cadastrar_usuario($nome, $email, $senha);

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