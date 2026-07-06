<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();
json_saida(['ok' => true, 'inicio_coluna' => 1, 'total_dias' => 30]);
