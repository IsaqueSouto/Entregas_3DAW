<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();

$lista = conexao()
    ->query('SELECT id, nome, foto FROM profissionais ORDER BY nome')
    ->fetchAll();

json_saida(['ok' => true, 'profissionais' => $lista]);
