<?php
$perguntas = [];

if (file_exists("perguntas_multiplas.json")) {

    $perguntas = json_decode(
        file_get_contents("perguntas_multiplas.json"),
        true
    );
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["respostas"])) {
        echo "Nenhuma resposta enviada!";
        exit;
    }

    $respostas = $_POST["respostas"];

    $respostasSalvas = [];

    $acertos = 0;
    $total = count($perguntas);

    foreach ($respostas as $i => $r) {

        $respostasSalvas[] = [
            "id" => $i,
            "resposta" => $r
        ];

        if (
            isset($perguntas[$i]) &&
            $r == $perguntas[$i]["correta"]
        ) {

            $acertos++;
        }
    }

    file_put_contents(
        "respostas_multiplas.json",
        json_encode($respostasSalvas, JSON_PRETTY_PRINT)
    );

    echo "<h3>Você acertou $acertos de $total perguntas!</h3><hr>";
    exit;
}
?>

<form id="formPerguntas">

    <?php foreach ($perguntas as $i => $p) { ?>

        <?php if (trim($p["pergunta"]) == "")
            continue; ?>

        <div>

            <p><b><?php echo $p["pergunta"]; ?></b></p>

            <label style="display:block;">
                A
                <input type="radio" name="respostas[<?php echo $i; ?>]" value="A" required>
                <?php echo $p["a"]; ?>
            </label>

            <label style="display:block;">
                B
                <input type="radio" name="respostas[<?php echo $i; ?>]" value="B" required>
                <?php echo $p["b"]; ?>
            </label>

            <label style="display:block;">
                C
                <input type="radio" name="respostas[<?php echo $i; ?>]" value="C" required>
                <?php echo $p["c"]; ?>
            </label>

            <label style="display:block;">
                D
                <input type="radio" name="respostas[<?php echo $i; ?>]" value="D" required>
                <?php echo $p["d"]; ?>
            </label>

        </div>

    <?php } ?>

    <br>

    <button type="submit">Salvar</button>

    <a href="index.php" style="margin-left: 15px;">
        <button type="button">Voltar</button>
    </a>

</form>

<div id="resultado"></div>

<script>
    document.getElementById("formPerguntas").addEventListener("submit", function (e) {

        e.preventDefault();

        fetch("perguntas_multiplas.php", {
            method: "POST",
            body: new FormData(this)
        })
            .then(r => r.text())
            .then(t => {
                document.getElementById("resultado").innerHTML = t;
            });

    });
</script>
