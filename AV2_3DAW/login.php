<?php
require 'funcoes.php';
$titulo_pagina = 'Entrar';
include 'topo.php';
?>
<main class="conteudo">
    <h2>Entrar</h2>
    <form id="form-login">
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <button type="submit" class="btn">Entrar</button>
        <a href="criar-conta.php" class="btn">Criar Conta</a>
    </form>
    <p class="erro" id="erro" style="display:none"></p>
</main>
<script src="js/api.js"></script>
<script>
    document.getElementById('form-login').addEventListener('submit', async (e) => {
        e.preventDefault();
        const fd = new FormData(e.target);
        const { status, json } = await chamarApi('api/login.php', {
            email: fd.get('email'), senha: fd.get('senha')
        });
        if (status === 200 && json.ok) {
            location.href = 'painel.php';
        } else {
            const erro = document.getElementById('erro');
            erro.textContent = json.erro === 'credenciais_invalidas'
                ? 'Email ou senha inválidos' : (json.erro || 'Erro ao entrar');
            erro.style.display = 'block';
        }
    });
</script>
</body>

</html>