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

    if (!file_exists("perguntas_multiplas.txt")) {
        echo "Arquivo não encontrado!";
        exit;
    }

    $linhas = file("perguntas_multiplas.txt", FILE_IGNORE_NEW_LINES);

    if (!isset($linhas[$id])) {
        echo "Pergunta não encontrada!";
        exit;
    }

    $d = explode(";", $linhas[$id]);

    if (count($d) < 6) {
        echo "Pergunta inválida!";
        exit;
    }

    echo "<b>" . $d[0] . "</b><br>";
    echo "A) " . $d[1] . "<br>";
    echo "B) " . $d[2] . "<br>";
    echo "C) " . $d[3] . "<br>";
    echo "D) " . $d[4] . "<br>";

} else {

    if (!file_exists("perguntas_texto.txt")) {
        echo "Arquivo não encontrado!";
        exit;
    }

    $linhas = file("perguntas_texto.txt", FILE_IGNORE_NEW_LINES);

    if (!isset($linhas[$id])) {
        echo "Pergunta não encontrada!";
        exit;
    }

    echo "<b>" . $linhas[$id] . "</b>";
}
?>

<br><br>
<a href="index.php">Voltar</a>
