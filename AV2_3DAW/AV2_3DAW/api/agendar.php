<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_saida(['ok' => false, 'erro' => 'metodo_invalido'], 405);
}

$horario = $_POST['horario'] ?? '';
if ($horario === '') {
    json_saida(['ok' => false, 'erro' => 'horario_obrigatorio'], 400);
}

$ehMensal = !empty($_POST['mensal']);

$_SESSION['agendamento_atual'] = [
    'profissional' => $_POST['profissional'] ?? '',
    'dia'          => $_POST['dia'] ?? '',
    'servico'      => $_POST['servico'] ?? '',
    'horario'      => $horario,
    'mensal'       => $ehMensal,
];

json_saida(['ok' => true, 'agendamento' => $_SESSION['agendamento_atual']]);
