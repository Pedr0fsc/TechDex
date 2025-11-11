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

function entrar_usuario($username, $senha)
{
    global $conection;
    
    $stmt = mysqli_stmt_init($conection);
    $query = "SELECT * FROM usuario WHERE username = ?";
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        // Verifica a senha criptografada
        if (password_verify($senha, $usuario['senha'])) {
            return [
                "status" => "s",
                "mensagem" => "Login bem-sucedido!",
                "usuario" => $usuario
            ];
        } else {
            return [
                "status" => "n",
                "mensagem" => "Senha incorreta!"
            ];
        }
    } else {
        return [
            "status" => "n",
            "mensagem" => "Usuário não encontrado!"
        ];
    }
}