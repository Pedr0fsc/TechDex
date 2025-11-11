<?php
include "../models/Usuario.php";

$username = $_POST["username"];
$senha = $_POST["senha"];

if ($username && $senha) {
    $resultado = entrar_usuario($username, $senha);
    echo json_encode($resultado);
} else {
    echo json_encode([
        "status" => "n",
        "mensagem" => "Preencha todos os campos!"
    ]);
}
?>