<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    if (!file_exists("alunos.txt")) {
        $arq = fopen("alunos.txt", "w") or die("erro");
        fwrite($arq, "matricula;nome;email\n");
        fclose($arq);
    }

    $arq = fopen("alunos.txt", "a") or die("erro");
    fwrite($arq, "$matricula;$nome;$email\n");
    fclose($arq);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html>

<body>

    <h1>Criar Novo Aluno</h1>

    <form method="POST">
        Matricula: <input type="text" name="matricula"><br><br>
        Nome: <input type="text" name="nome"><br><br>
        Email: <input type="text" name="email"><br><br>
        <input type="submit" value="Cadastrar">
    </form>

    <hr>

    <h1>Listar Alunos</h1>

    <table border="1">
        <tr>
            <th>Matricula</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>

        <?php
        if (file_exists("alunos.txt")) {
            $arq = fopen("alunos.txt", "r") or die("erro");

            while (!feof($arq)) {
                $linha = fgets($arq);
                $d = explode(";", $linha);

                if (count($d) == 3) {
                    echo "<tr><td>$d[0]</td><td>$d[1]</td><td>$d[2]</td></tr>";
                }
            }

            fclose($arq);
        }
        ?>

    </table>

</body>

</html>