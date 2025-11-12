<?php
include "../models/usuario.php";

$username = trim($_POST["username"] ?? "");
$senha = trim($_POST["senha"] ?? "");

if ($username && $senha) {
    $resultado = entrar_usuario($username, $senha);
    echo json_encode($resultado);
} else {
    echo json_encode([
        "status" => "n",
        "mensagem" => "Preencha todos os campos!"
    ]);
}
