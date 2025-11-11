<?php
include "../models/Tag.php";

$dados = buscar_tags();
echo json_encode($dados);
