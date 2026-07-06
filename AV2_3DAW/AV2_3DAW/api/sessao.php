<?php
require __DIR__ . '/../funcoes.php';
json_saida(['ok' => logado(), 'email' => $_SESSION['email'] ?? null]);
