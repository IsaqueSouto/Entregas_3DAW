<?php
$linhas = file("perguntas_multiplas.txt", FILE_IGNORE_NEW_LINES);
$perguntas = [];

foreach ($linhas as $l) {
    $dados = explode(";", $l);

    if (count($dados) < 6)
        continue;

    $perguntas[] = $dados;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["respostas"])) {
        echo "Nenhuma resposta enviada!";
        exit;
    }

    $respostas = $_POST["respostas"];

    $arquivo = fopen("respostas_multiplas.txt", "w");

    $acertos = 0;
    $total = count($perguntas);

    foreach ($respostas as $i => $r) {

        fwrite($arquivo, $i . ";" . $r . "\n");

        if (isset($perguntas[$i]) && $r == trim($perguntas[$i][5])) {
            $acertos++;
        }
    }

    fclose($arquivo);

    echo "<h3>Você acertou $acertos de $total perguntas!</h3><hr>";
    exit;
}
?>

<form id="formPerguntas">

    <?php foreach ($perguntas as $i => $p) { ?>

        <?php if (trim($p[0]) == "") continue; ?>

        <div>

            <p><b><?php echo $p[0]; ?></b></p>

            <label style="display:block;">
                A
                <input type='radio' name='respostas[<?php echo $i; ?>]' value='A' required>
                <?php echo $p[1]; ?>
            </label>

            <label style="display:block;">
                B
                <input type='radio' name='respostas[<?php echo $i; ?>]' value='B' required>
                <?php echo $p[2]; ?>
            </label>

            <label style="display:block;">
                C
                <input type='radio' name='respostas[<?php echo $i; ?>]' value='C' required>
                <?php echo $p[3]; ?>
            </label>

            <label style="display:block;">
                D
                <input type='radio' name='respostas[<?php echo $i; ?>]' value='D' required>
                <?php echo $p[4]; ?>
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
document.getElementById("formPerguntas").addEventListener("submit", function(e){

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
