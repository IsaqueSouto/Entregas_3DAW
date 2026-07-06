<?php
require __DIR__ . '/../funcoes.php';
session_destroy();

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    json_saida(['ok' => true]);
}
header('Location: ../login.php');
exit;
