<?php
if (!isset($mostrar_sair))  $mostrar_sair = false;
if (!isset($titulo_pagina)) $titulo_pagina = 'Simone Belezas';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?php echo $titulo_pagina; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="topo"><h1>Simone Belezas</h1></header>
    <?php if ($mostrar_sair): ?>
        <div class="sair"><a href="logout.php">Sair</a></div>
    <?php endif; ?>
