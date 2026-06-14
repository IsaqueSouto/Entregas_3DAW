<h3>Múltipla Escolha</h3>

<?php
if (file_exists("perguntas_multiplas.json")) {

    $linhas = json_decode(
        file_get_contents("perguntas_multiplas.json"),
        true
    );

    foreach ($linhas as $p) {

        echo "<b>" . $p["pergunta"] . "</b><br>";
        echo "A) " . $p["a"] . "<br>";
        echo "B) " . $p["b"] . "<br>";
        echo "C) " . $p["c"] . "<br>";
        echo "D) " . $p["d"] . "<br>";
        echo "Correta: " . $p["correta"] . "<br><br>";
    }
}
?>

<h3>Perguntas de Texto</h3>

<?php
if (file_exists("perguntas_texto.json")) {

    $linhas = json_decode(
        file_get_contents("perguntas_texto.json"),
        true
    );

    foreach ($linhas as $p) {
        echo "<b>" . $p . "</b><br><br>";
    }
}
?>

<a href="index.php">Voltar</a>
