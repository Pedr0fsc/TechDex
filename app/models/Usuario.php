<?php
include "../core/Conexao.php";

function cadastrar_usuario($nome, $email, $senha)
{
    global $conection;

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = mysqli_stmt_init($conection);
    $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha_hash);
    $resultado = mysqli_stmt_execute($stmt);

    return $resultado;
}