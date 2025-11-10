<?php
$host = "localhost:3306";
$user = "root";
$pass = "TuffoPirata2007";
$dbname = "bdprogweb";

$conection = mysqli_connect($host, $user, $pass, $dbname);

if (!$conection) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>