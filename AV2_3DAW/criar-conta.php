<?php
require 'funcoes.php';
$titulo_pagina = 'Criar Conta';
include 'topo.php';
?>
<main class="conteudo">
    <h2>Criar Conta</h2>
    <form id="form-cadastro">
        <label>Telefone:</label>
        <input type="text" name="telefone" required>
        <label>CPF:</label>
        <input type="text" name="cpf" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <label>Confirmar senha:</label>
        <input type="password" name="confirmar" required>
        <button type="submit" class="btn">Criar Conta</button>
        <a href="login.php" class="btn">Voltar</a>
    </form>
    <p class="erro" id="erro" style="display:none"></p>
</main>
<script src="js/api.js"></script>
<script>
    document.getElementById('form-cadastro').addEventListener('submit', async (e) => {
        e.preventDefault();
        const fd = new FormData(e.target);
        const { status, json } = await chamarApi('api/criar-conta.php', {
            telefone: fd.get('telefone'), cpf: fd.get('cpf'),
            email: fd.get('email'), senha: fd.get('senha'), confirmar: fd.get('confirmar')
        });
        if (status === 200 && json.ok) {
            location.href = 'login.php';
        } else {
            const map = {
                campos_obrigatorios: 'Preencha todos os campos',
                senhas_diferentes: 'As senhas não são iguais',
                email_ja_cadastrado: 'Esse email já está cadastrado'
            };
            const erro = document.getElementById('erro');
            erro.textContent = map[json.erro] || 'Erro ao criar conta';
            erro.style.display = 'block';
        }
    });
</script>
</body>

</html>