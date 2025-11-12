<?php
include "../core/Conexao.php";

function buscar_tags()
{
    global $conection;

    $query = "SELECT 
                t.name AS tag,
                COUNT(it.item_id) AS quantidade
            FROM tags t
            LEFT JOIN item_tags it ON t.id_tag = it.tag_id
            GROUP BY t.id_tag, t.name, t.color_hex
            ORDER BY quantidade DESC;";

    $resultado = mysqli_query($conection, $query);
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}
?>