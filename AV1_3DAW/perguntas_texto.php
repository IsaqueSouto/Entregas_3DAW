<?php
$perguntas = file("perguntas_texto.txt", FILE_IGNORE_NEW_LINES);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    file_put_contents("respostas_texto.txt", "");

    foreach ($_POST["respostas"] as $i => $r) {
        file_put_contents("respostas_texto.txt", $perguntas[$i] . ";" . $r . "\n", FILE_APPEND);
    }

    echo "Respostas salvas!";
    exit;
} else {
    count($perguntas) > 0 or die("Nenhuma pergunta cadastrada!");
}
?>

<form id="formPerguntas">
    <?php foreach ($perguntas as $i => $p) {
        echo "<p><b>$p</b></p>";
        echo "<textarea name='respostas[]' required></textarea><br><br>";
    } ?>

    <button>Salvar</button>
</form>

<div id="resultado"></div>
<a href="index.php">Voltar</a>
<script>
document.getElementById("formPerguntas").addEventListener("submit", function(e) {
    e.preventDefault();

    fetch("perguntas_texto.php", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.text())
    .then(t => {
        document.getElementById("resultado").innerHTML = t;
    });
});
</script>
