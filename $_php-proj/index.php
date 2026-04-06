<?php
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nomeDisc = $_POST["nome"];
    $siglaDisc = $_POST["sigla"];
    $cargaHoraria = $_POST["carga"];

    if (!file_exists("disciplinas.txt")) {
        $arquivo = fopen("disciplinas.txt", "w") or die("Erro ao criar arquivo");
        fwrite($arquivo, "nome;sigla;carga\n");
        fclose($arquivo);
    }

    $arquivo = fopen("disciplinas.txt", "a") or die("Erro ao abrir arquivo");

    $novaLinha = "$nomeDisc;$siglaDisc;$cargaHoraria\n";

    fwrite($arquivo, $novaLinha);
    fclose($arquivo);

    $mensagem = "Cadastro realizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Disciplinas</title>
</head>

<body>

    <h1>Cadastro de Disciplina</h1>

    <form method="POST">
        Nome: <input type="text" name="nome" required>
        <br><br>
        Sigla: <input type="text" name="sigla" required>
        <br><br>
        Carga Horária: <input type="text" name="carga" required>
        <br><br>
        <input type="submit" value="Cadastrar">
    </form>

    <p>
        <?php echo $mensagem; ?>
    </p>

    <hr>

    <h2>Lista de Disciplinas</h2>

    <?php
    if (file_exists("disciplinas.txt")) {

        $conteudo = file("disciplinas.txt");

        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Nome</th><th>Sigla</th><th>Carga Horária</th></tr>";

        foreach ($conteudo as $i => $linha) {

            if ($i == 0)
                continue;

            $colunas = explode(";", trim($linha));

            if (count($colunas) == 3) {
                echo "<tr>";
                echo "<td>$colunas[0]</td>";
                echo "<td>$colunas[1]</td>";
                echo "<td>$colunas[2]</td>";
                echo "</tr>";
            }
        }

        echo "</table";
    }
    ?>

</body>

</html>