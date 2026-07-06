<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();
$codigo = strtoupper(bin2hex(random_bytes(16)));
json_saida([
    'ok' => true,
    'codigo' => $codigo,
    'qr' => 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&color=ff00ff&bgcolor=000000&data=' . urlencode($codigo),
]);
