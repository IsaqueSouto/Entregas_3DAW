<?php
if ($_POST) {

    $id = $_POST['id'];
    $tipo = $_POST['tipo'];

    if ($tipo == "multipla") {
        $arquivo = 'perguntas_multiplas.json';
    } else {
        $arquivo = 'perguntas_texto.json';
    }

    if (file_exists($arquivo)) {

        $linhas = json_decode(
            file_get_contents($arquivo),
            true
        );

        $novasLinhas = [];

        foreach ($linhas as $index => $linha) {
            if ($index != $id) {
                $novasLinhas[] = $linha;
            }
        }

        file_put_contents(
            $arquivo,
            json_encode($novasLinhas, JSON_PRETTY_PRINT)
        );

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
    document.getElementById("formExcluir").addEventListener("submit", function (e) {

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
