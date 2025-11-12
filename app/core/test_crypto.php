<?php
// --- Teste de criptografia e descriptografia AES-256-CBC ---

// Use as MESMAS chaves que estão no seu .env ou no seu código PHP
$AES_KEY = getenv('AES_KEY');
$AES_IV  = getenv('AES_IV');                 // 16 chars

$texto = "teste_username";

echo "<h3>Teste de criptografia PHP (AES-256-CBC)</h3>";

$criptografado = base64_encode(
    openssl_encrypt($texto, 'AES-256-CBC', $AES_KEY, OPENSSL_RAW_DATA, $AES_IV)
);

echo "<strong>Texto original:</strong> $texto<br>";
echo "<strong>Criptografado (base64):</strong> $criptografado<br>";

$descriptografado = openssl_decrypt(
    base64_decode($criptografado),
    'AES-256-CBC',
    $AES_KEY,
    OPENSSL_RAW_DATA,
    $AES_IV
);

echo "<strong>Descriptografado:</strong> $descriptografado<br>";

if ($texto === $descriptografado) {
    echo "<span style='color:green;'>✅ Criptografia e descriptografia funcionando!</span>";
} else {
    echo "<span style='color:red;'>❌ Algo está errado — chaves, IV ou codificação incompatíveis.</span>";
}
?>