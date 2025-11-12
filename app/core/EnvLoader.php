<?php
function carregar_env($arquivo) {
    if (!file_exists($arquivo)) {
        throw new Exception(".env não encontrado em $arquivo");
    }

    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as $linha) {
        if (strpos(trim($linha), '#') === 0) continue; // ignora comentários

        list($chave, $valor) = explode('=', $linha, 2);
        $chave = trim($chave);
        $valor = trim($valor);

        putenv("$chave=$valor");
        $_ENV[$chave] = $valor;
        $_SERVER[$chave] = $valor;
    }
}
?>