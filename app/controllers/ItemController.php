<?php
include "../models/Item.php";

$dados = buscar_itens();
echo json_encode($dados);
