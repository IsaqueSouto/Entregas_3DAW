<?php
require 'funcoes.php';
exige_login();
$mostrar_sair = true;
$titulo_pagina = 'Profissionais';
include 'topo.php';
?>
<main class="conteudo">
    <h2>Nossos Profissionais</h2>
    <p>Conheça quem cuida de você na Simone Belezas:</p>
    <div class="profissionais" id="lista" style="margin-top:20px"></div>
</main>
<script src="js/api.js"></script>
<script>
    (async () => {
        const { json } = await chamarApi('api/profissionais.php');
        if (!json.ok) return;
        document.getElementById('lista').innerHTML = json.profissionais.map(p => `
        <div>
            <img src="${p.foto}" alt="${p.nome}">
            <span>${p.nome}</span>
        </div>`).join('');
    })();
</script>
</body>

</html>