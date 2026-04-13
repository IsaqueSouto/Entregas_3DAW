<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perguntas - Múltipla Escolha</title>
</head>
<body>

<h3>Perguntas de Múltipla Escolha</h3>

<?php
$arquivo = fopen("perguntas_multiplas.txt", "r") or die("Erro ao abrir arquivo");

$perguntas = [];

while (!feof($arquivo)) {

    $linha = fgets($arquivo);

    if (trim($linha) != "") {

        $dados = explode(";", $linha);
        $perguntas[] = $dados;
    }
}

fclose($arquivo);
?>

<form method="POST">

<?php
for ($i = 0; $i < count($perguntas); $i++) {

    echo "<p><strong>" . $perguntas[$i][0] . "</strong></p>";

    echo "<label><input type='radio' name='respostas[$i]' value='A' required> A) " . $perguntas[$i][1] . "</label><br>";
    echo "<label><input type='radio' name='respostas[$i]' value='B'> B) " . $perguntas[$i][2] . "</label><br>";
    echo "<label><input type='radio' name='respostas[$i]' value='C'> C) " . $perguntas[$i][3] . "</label><br>";
    echo "<label><input type='radio' name='respostas[$i]' value='D'> D) " . $perguntas[$i][4] . "</label><br><br>";
}
?>

<button type="submit">Salvar</button>

</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $respostas = $_POST["respostas"];

    $arquivo = fopen("respostas_multiplas.txt", "a") or die("Erro ao abrir arquivo");

    for ($i = 0; $i < count($perguntas); $i++) {

        $linha = $perguntas[$i][0] . ";" . $respostas[$i] . "\n";
        fwrite($arquivo, $linha);
    }

    fclose($arquivo);

    echo "<p>Respostas salvas com sucesso</p>";
}
?>

</body>
</html>