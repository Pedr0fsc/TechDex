<?php

    include "../core/Conexao.php";

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $stmt = mysqli_stmt_init($conection);
    $query = "INSERT INTO usuario(nome, email, senha) VALUES (?,?,?)";
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt,"sss", $nome, $email, $senha);
    $resultado = mysqli_stmt_execute($stmt);

    if($resultado == True){
        $retorno_cadastro["status"] = "s";
        $retorno_cadastro["mensagem"] = "Cadastrado com sucesso!";
    } else {
        $retorno_cadastro["status"] = "n";
        $retorno_cadastro["mensagem"] = "Falha ao cadastrar!";
    }

    echo json_encode($retorno_cadastro);

?>