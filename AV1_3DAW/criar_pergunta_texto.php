<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $perguntas = [];

    if (file_exists("perguntas_texto.json")) {
        $perguntas = json_decode(
            file_get_contents("perguntas_texto.json"),
            true
        );
    }

    $perguntas[] = $_POST["pergunta"];

    file_put_contents(
        "perguntas_texto.json",
        json_encode($perguntas, JSON_PRETTY_PRINT)
    );

    echo "Pergunta salva!";
    exit;
}
?>

<form id="formPergunta">
    Pergunta:<br>
    <input name="pergunta" required size="60">
    <br><br>
    <button>Salvar</button>
</form>

<div id="mensagem"></div>

<a href="index.php">Voltar</a>

<script>
    document.getElementById("formPergunta")
        .addEventListener("submit", function (e) {

            e.preventDefault();

            fetch("criar_pergunta_texto.php", {
                method: "POST",
                body: new FormData(this)
            })
                .then(r => r.text())
                .then(t => {
                    document.getElementById("mensagem").innerHTML = t;
                });

        });
</script>
