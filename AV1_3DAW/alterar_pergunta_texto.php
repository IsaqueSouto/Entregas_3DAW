<?php
if ($_POST) {
    $id = $_POST['id'];
    $nova = $_POST['pergunta'];

    $linhas = file('perguntas_texto.txt');
    $linhas[$id] = $nova . PHP_EOL;

    file_put_contents('perguntas_texto.txt', implode('', $linhas));

    echo "Pergunta alterada!";
    exit;
}
?>

<form id="formAlterar">
    ID: <input name="id"><br>
    Nova pergunta: <input name="pergunta"><br>
    <button>Alterar</button>
</form>

<div id="mensagem"></div>

<a href="index.php">Voltar</a>

<script>
document.getElementById("formAlterar").addEventListener("submit", function(e){

    e.preventDefault();

    fetch("alterar_pergunta_texto.php", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.text())
    .then(t => {
        document.getElementById("mensagem").innerHTML = t;
    });

});
</script>
