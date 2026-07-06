<?php
require __DIR__ . '/../funcoes.php';
exige_login_api();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    json_saida(['ok' => false, 'erro' => 'id_obrigatorio'], 400);
}

$pdo = conexao();
$stmt = $pdo->prepare('SELECT id, nome, foto FROM profissionais WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$prof = $stmt->fetch();

if (!$prof) {
    json_saida(['ok' => false, 'erro' => 'nao_encontrado'], 404);
}

$stmt = $pdo->prepare('SELECT dia, horario, servico FROM profissional_dias WHERE profissional_id = ?');
$stmt->execute([$id]);
$dias = $stmt->fetchAll();

json_saida(['ok' => true, 'profissional' => $prof, 'dias' => $dias]);
