<h3>Múltipla Escolha</h3>
<?php
if (file_exists("perguntas_multiplas.txt")) {
    $linhas = file("perguntas_multiplas.txt", FILE_IGNORE_NEW_LINES);

    foreach ($linhas as $i => $l) {
        $d = explode(";", $l);

        if (count($d) < 6)
            continue;

        echo "<b>" . $d[0] . "</b><br>";
        echo "A) " . $d[1] . "<br>";
        echo "B) " . $d[2] . "<br>";
        echo "C) " . $d[3] . "<br>";
        echo "D) " . $d[4] . "<br>";
        echo "Correta: " . $d[5] . "<br><br>";
    }
}
?>

<h3>Perguntas de Texto</h3>
<?php
if (file_exists("perguntas_texto.txt")) {
    $linhas = file("perguntas_texto.txt");
    foreach ($linhas as $i => $l) {
        echo "<b>" . $l . "</b><br><br>";
    }
}
?>
<a href="index.php">Voltar</a>
