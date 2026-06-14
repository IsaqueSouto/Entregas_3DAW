<?php

if (!isset($_GET["id"])) {
    ?>

    <form method="get">
        Tipo:
        <select name="tipo">
            <option value="m">Múltipla</option>
            <option value="t">Texto</option>
        </select><br><br>

        ID da pergunta:
        <input name="id" required><br><br>

        <button>Buscar</button>
    </form>

    <a href="index.php">Voltar</a>

    <?php
    exit;
}

$tipo = $_GET["tipo"] ?? "";
$id = $_GET["id"];

if (!is_numeric($id)) {
    echo "ID inválido!";
    exit;
}

$id = (int) $id;

if ($tipo == "m") {

    if (!file_exists("perguntas_multiplas.json")) {
        echo "Arquivo não encontrado!";
        exit;
    }

    $linhas = json_decode(
        file_get_contents("perguntas_multiplas.json"),
        true
    );

    if (!isset($linhas[$id])) {
        echo "Pergunta não encontrada!";
        exit;
    }

    $p = $linhas[$id];

    echo "<b>" . $p["pergunta"] . "</b><br>";
    echo "A) " . $p["a"] . "<br>";
    echo "B) " . $p["b"] . "<br>";
    echo "C) " . $p["c"] . "<br>";
    echo "D) " . $p["d"] . "<br>";

} else {

    if (!file_exists("perguntas_texto.json")) {
        echo "Arquivo não encontrado!";
        exit;
    }

    $linhas = json_decode(
        file_get_contents("perguntas_texto.json"),
        true
    );

    if (!isset($linhas[$id])) {
        echo "Pergunta não encontrada!";
        exit;
    }

    echo "<b>" . $linhas[$id] . "</b>";
}
?>

<br><br>
<a href="index.php">Voltar</a>
