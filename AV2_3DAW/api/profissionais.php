<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();

$lista = conexao()
    ->query('SELECT id, nome, foto FROM profissionais ORDER BY nome')
    ->fetchAll();

responder_json(['ok' => true, 'profissionais' => $lista]);
