<?php
if ($_POST) {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];

    if ($tipo == "multipla") {
        $arquivo = 'perguntas_multiplas.txt';
    } else {
        $arquivo = 'perguntas_texto.txt';
    }

    if (file_exists($arquivo)) {
        $linhas = file($arquivo);
        $novasLinhas = [];

        foreach ($linhas as $index => $linha) {
            if ($index != $id) {
                $novasLinhas[] = $linha;
            }
        }

        file_put_contents($arquivo, implode('', $novasLinhas));

        echo "Pergunta excluída com sucesso!";
    } else {
        echo "Arquivo não encontrado!";
    }

    exit;
}
?>

<form id="formExcluir">
    ID: <input name="id" required><br><br>

    Tipo:
    <select name="tipo" required>
        <option value="multipla">Múltipla Escolha</option>
        <option value="texto">Texto</option>
    </select>

    <br><br>

    <button>Excluir</button>
</form>

<div id="mensagem"></div>

<a href="index.php">Voltar</a>

<script>
document.getElementById("formExcluir").addEventListener("submit", function(e){

    e.preventDefault();

    fetch("excluir_pergunta.php", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.text())
    .then(t => {
        document.getElementById("mensagem").innerHTML = t;
    });

});
</script>
