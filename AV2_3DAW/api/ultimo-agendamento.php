<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();
json_saida(['ok' => true, 'agendamento' => $_SESSION['ultimo_agendamento'] ?? null]);
