<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();

function gerar_codigo_boleto()
{
    $partes = [];
    for ($i = 0; $i < 3; $i++) {
        $partes[] = sprintf('%05d', random_int(0, 99999)) . '.' . sprintf('%06d', random_int(0, 999999));
    }
    $dv = random_int(0, 9);
    $fv = sprintf('%014d', random_int(10000000000000, 99999999999999));
    return implode(' ', $partes) . ' ' . $dv . ' ' . $fv;
}

json_saida([
    'ok' => true,
    'codigo' => gerar_codigo_boleto(),
    'valor' => 'R$ 29,99',
    'vencimento' => date('d/m/Y', strtotime('+3 days')),
]);
