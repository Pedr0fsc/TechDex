<?php
include "../core/Conexao.php";

function cadastrar_usuario($nome, $username, $email, $senha)
{
    global $conection;

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = mysqli_stmt_init($conection);
    $sql = "INSERT INTO usuario (nome, username, email, senha) VALUES (?, ?, ?, ?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $username, $email, $senha_hash);
    $resultado = mysqli_stmt_execute($stmt);

    return $resultado;
}