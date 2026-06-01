<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $linha = $_POST["pergunta"] . ";" . $_POST["a"] . ";" . $_POST["b"] . ";" . $_POST["c"] . ";" . $_POST["d"] . ";" . strtoupper($_POST["correta"]) . "\n";

    file_put_contents("perguntas_multiplas.txt", $linha, FILE_APPEND);

    echo "Pergunta salva!";
    exit;
}
?>

<form id="formPergunta">
    Pergunta:<br>
    <input name="pergunta" required><br><br>

    A:<input name="a" required><br>
    B:<input name="b" required><br>
    C:<input name="c" required><br>
    D:<input name="d" required><br><br>

    Resposta correta (A/B/C/D):<br>
    <input name="correta" maxlength="1" required><br><br>

    <button>Salvar</button>
</form>

<div id="mensagem"></div>

<a href="index.php">Voltar</a>

<script>
document.getElementById("formPergunta").addEventListener("submit", function(e){

    e.preventDefault();

    fetch("criar_pergunta_multipla.php", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.text())
    .then(t => {
        document.getElementById("mensagem").innerHTML = t;
    });

});
</script>
