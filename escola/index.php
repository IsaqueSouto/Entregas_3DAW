<?php
include("editar.php");
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['limpar'])) {
        limparTabela();
        $msg = "Tabela limpa!";
    } else if (isset($_POST['editar'])) {
        $msg = editarAluno($_POST["matricula"], $_POST["nome"], $_POST["email"]);
    } else {
        $msg = salvarAluno($_POST["matricula"], $_POST["nome"], $_POST["email"]);
    }
}
?>

<!DOCTYPE html>
<html>

<body>

    <h1>Criar / Editar Aluno</h1>

    <form method="POST">
        Matricula: <input type="text" name="matricula"><br><br>
        Nome: <input type="text" name="nome"><br><br>
        Email: <input type="text" name="email"><br><br>

        <input type="submit" value="Criar Novo Aluno">
        <input type="submit" name="editar" value="Editar Aluno">
    </form>

    <p><?php echo $msg ?></p>

    <form method="POST">
        <input type="submit" name="limpar" value="Limpar Tabela">
    </form>

    <hr>

    <h1>Listar Alunos</h1>

    <table border="1">

        <?php
        if (file_exists("alunos.txt")) {

            $arqAluno = fopen("alunos.txt", "r");

            while (!feof($arqAluno)) {
                $linha = fgets($arqAluno);

                if ($linha != "") {
                    $dados = explode(";", $linha);

                    if (count($dados) == 3 && $dados[0] != "matricula") {
                        echo "<tr><td>$dados[0]</td><td>$dados[1]</td><td>$dados[2]</td></tr>";
                    }
                }
            }

            fclose($arqAluno);
        }
        ?>

    </table>

</body>

</html>
