<?php
include "../core/Conexao.php";

function cadastrar_usuario($nome, $email, $senha) {
    global $conection;

    $stmt = mysqli_stmt_init($conection);
    $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha);
    $resultado = mysqli_stmt_execute($stmt);

    return $resultado;
}

