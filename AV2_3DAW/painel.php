<?php
require 'funcoes.php';
exige_login();
$mostrar_sair = true;
$titulo_pagina = 'Painel';
include 'topo.php';
?>
<main class="painel-container">
    <a href="profissionais.php" class="painel-btn">Escolha o seu<br>Profissional!</a>
    <a href="#" class="painel-btn">Veja os serviços<br>Mensais!</a>
</main>
</body>

</html>