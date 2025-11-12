<?php
include "../core/Conexao.php";

function buscar_itens()
{
    global $conection;

    $query = "SELECT 
                i.name AS linguagem,
                c.name AS empresa,
                i.type AS tipo,
                t.name AS tag
            FROM items i
            LEFT JOIN companies c ON i.company_id = c.id_company
            LEFT JOIN item_tags it ON i.id_item = it.item_id
            LEFT JOIN tags t ON it.tag_id = t.id_tag
            ORDER BY i.name;";

    $resultado = mysqli_query($conection, $query);
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}
?>