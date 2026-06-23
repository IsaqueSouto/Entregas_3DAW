<?php
require __DIR__ . '/../funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    responder_json(['ok' => false, 'erro' => 'metodo_invalido'], 405);
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    responder_json(['ok' => false, 'erro' => 'campos_obrigatorios'], 400);
}

$stmt = conexao()->prepare('SELECT email, senha FROM usuarios WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user || !password_verify($senha, $user['senha'])) {
    responder_json(['ok' => false, 'erro' => 'credenciais_invalidas'], 401);
}

$_SESSION['email'] = $user['email'];
responder_json(['ok' => true, 'email' => $user['email']]);
