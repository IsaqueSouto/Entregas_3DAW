<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();

$dia = isset($_GET['dia_semana']) ? trim($_GET['dia_semana']) : '';
if ($dia === '') {
    json_saida(['ok' => false, 'erro' => 'dia_obrigatorio'], 400);
}

$pdo = conexao();
$stmt = $pdo->prepare('SELECT nome FROM servicos_mensais WHERE dia_semana = ? ORDER BY id');
$stmt->execute([$dia]);
$servicos = array_map(fn($r) => $r['nome'], $stmt->fetchAll());

json_saida(['ok' => true, 'dia_semana' => $dia, 'servicos' => $servicos]);
