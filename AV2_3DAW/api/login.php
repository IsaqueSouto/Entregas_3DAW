<?php
require __DIR__ . '/../funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_saida(['ok' => false, 'erro' => 'metodo_invalido'], 405);
}

$email = trim($_POST['email'] ?? '');
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

if ($email === '' || $senha === '') {
    json_saida(['ok' => false, 'erro' => 'campos_obrigatorios'], 400);
}

$stmt = conexao()->prepare('SELECT email, senha FROM usuarios WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user || !password_verify($senha, $user['senha'])) {
    json_saida(['ok' => false, 'erro' => 'credenciais_invalidas'], 401);
}

$_SESSION['email'] = $user['email'];
json_saida(['ok' => true, 'email' => $user['email']]);
