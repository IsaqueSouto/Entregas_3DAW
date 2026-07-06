<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_saida(['ok' => false, 'erro' => 'metodo_invalido'], 405);
}

$forma = $_POST['forma'] ?? '';
if ($forma === '' || empty($_SESSION['agendamento_atual'])) {
    json_saida(['ok' => false, 'erro' => 'dados_incompletos'], 400);
}

$ag = $_SESSION['agendamento_atual'];
$ehMensal = !empty($ag['mensal']);

$profissionalId = null;
if (!empty($ag['profissional'])) {
    $profissionalId = (int) $ag['profissional'];
}

$servico = $ag['servico'] ?? '';

$pdo = conexao();
$stmt = $pdo->prepare(
    'INSERT INTO agendamentos
        (usuario_email, profissional_id, dia, servico, horario, mensal, forma_pagamento)
     VALUES (?, ?, ?, ?, ?, ?, ?)'
);
$stmt->execute([
    $_SESSION['email'],
    $profissionalId,
    $ag['dia'],
    $servico,
    $ag['horario'],
    $ehMensal ? 'sim' : 'não',
    $forma,
]);

$ag['id'] = (int) $pdo->lastInsertId();
$ag['profissional'] = $profissionalId;
$ag['servico'] = $servico;
$ag['mensal'] = $ehMensal ? 'sim' : 'não';
$ag['forma_pagamento'] = $forma;
$ag['data_pagamento'] = date('Y-m-d H:i:s');
$_SESSION['ultimo_agendamento'] = $ag;
unset($_SESSION['agendamento_atual']);

json_saida(['ok' => true, 'agendamento' => $ag]);
