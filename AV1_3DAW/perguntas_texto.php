<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perguntas de Texto</title>
</head>
<body>

<h3>Perguntas de Texto</h3>

<?php
$arquivo = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");

$perguntas = [];

while (!feof($arquivo)) {

    $linha = fgets($arquivo);

    if (trim($linha) != "") {
        $perguntas[] = trim($linha);
    }
}

fclose($arquivo);
?>

<form method="POST">

<?php
for ($i = 0; $i < count($perguntas); $i++) {

    echo "<p><strong>" . $perguntas[$i] . "</strong></p>";
    echo "<textarea name='respostas[]' rows='3' cols='60' required></textarea><br><br>";
}
?>

<button type="submit">Salvar</button>

</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $respostas = $_POST["respostas"];

    $arquivo = fopen("respostas_texto.txt", "a") or die("Erro ao abrir arquivo");

    for ($i = 0; $i < count($perguntas); $i++) {

        fwrite($arquivo, $perguntas[$i] . ";" . $respostas[$i] . "\n");
    }

    fclose($arquivo);

    echo "<p>Salvo com sucesso</p>";
}
?>

</body>
</html>