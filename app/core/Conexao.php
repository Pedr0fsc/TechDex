<?php
include_once "EnvLoader.php";
carregar_env(__DIR__ . "/../../.env");

$conection = mysqli_connect(
    getenv('DB_HOST'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_NAME'),
    getenv('DB_PORT')
);

if (!$conection) {
    die("Erro na conexão com o banco: " . mysqli_connect_error());
}
