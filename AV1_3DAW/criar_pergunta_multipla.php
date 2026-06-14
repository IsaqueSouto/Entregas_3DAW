<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $perguntas = [];

    if (file_exists("perguntas_multiplas.json")) {
        $perguntas = json_decode(
            file_get_contents("perguntas_multiplas.json"),
            true
        );
    }

    $perguntas[] = [
        "pergunta" => $_POST["pergunta"],
        "a" => $_POST["a"],
        "b" => $_POST["b"],
        "c" => $_POST["c"],
        "d" => $_POST["d"],
        "correta" => strtoupper($_POST["correta"])
    ];

    file_put_contents(
        "perguntas_multiplas.json",
        json_encode($perguntas, JSON_PRETTY_PRINT)
    );

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
    document.getElementById("formPergunta").addEventListener("submit", function (e) {

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
