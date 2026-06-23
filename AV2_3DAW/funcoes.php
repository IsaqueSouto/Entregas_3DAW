<?php
session_start();

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'smbel');
define('DB_USER', 'root');
define('DB_PASS', '');

function conexao()
{
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}

function logado()      { return isset($_SESSION['email']); }
function exige_login() { if (!logado()) { header('Location: login.php'); exit; } }

function responder_json($dados, $status = 200)
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    exit;
}

function exige_login_api()
{
    if (!logado()) responder_json(['ok' => false, 'erro' => 'nao_autenticado'], 401);
}
