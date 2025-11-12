<?php
include "../models/Usuario.php";

// Recebe dados do formulário
$nome = trim($_POST["nome"] ?? "");
$username = trim($_POST["username"] ?? "");
$email = trim($_POST["email"] ?? "");
$senha = trim($_POST["senha"] ?? "");

// Verifica se todos os campos estão preenchidos
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
            "mensagem" => "Falha ao cadastrar! (verifique se o usuário já existe)"
        ];
    }
} else {
    $retorno = [
        "status" => "n",
        "mensagem" => "Preencha todos os campos!"
    ];
}

echo json_encode($retorno);
?>
