<?php

require 'funcoes.php';

$paginaInicial = 'login.php';

if (logado()) {
    $paginaInicial = 'painel.php';
}

header("Location: {$paginaInicial}");
exit;

