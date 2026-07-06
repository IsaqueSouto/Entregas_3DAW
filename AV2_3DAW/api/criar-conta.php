<?php
require __DIR__ . '/../funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_saida(['ok' => false, 'erro' => 'metodo_invalido'], 405);
}

$telefone = trim($_POST['telefone'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$confirmar = isset($_POST['confirmar']) ? $_POST['confirmar'] : '';

if ($telefone === '' || $cpf === '' || $email === '' || $senha === '') {
    json_saida(['ok' => false, 'erro' => 'campos_obrigatorios'], 400);
}
if ($senha !== $confirmar) {
    json_saida(['ok' => false, 'erro' => 'senhas_diferentes'], 400);
}

$pdo = conexao();
$stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
if ($stmt->fetch()) {
    json_saida(['ok' => false, 'erro' => 'email_ja_cadastrado'], 409);
}

$hash = password_hash($senha, PASSWORD_DEFAULT);
$ins = $pdo->prepare('INSERT INTO usuarios (telefone, cpf, email, senha) VALUES (?, ?, ?, ?)');
$ins->execute([$telefone, $cpf, $email, $hash]);

$_SESSION['email'] = $email;
json_saida(['ok' => true, 'email' => $email]);
