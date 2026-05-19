<?php
include("editar.php");
include("deletar.php");

$msg = "";

$matricula = $_POST['matricula'] ?? "";
$nome = $_POST['nome'] ?? "";
$email = $_POST['email'] ?? "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['limpar'])) {
        $msg = limparTabela();
    } else if (isset($_POST['excluir'])) {
        $msg = excluirAluno($matricula);
    } else if (isset($_POST['editar'])) {
        $msg = editarAluno($matricula, $nome, $email);
    } else {
        $msg = salvarAluno($matricula, $nome, $email);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<script>

function validarForm(){

    let matricula = document.getElementById("matricula").value;
    let nome = document.getElementById("nome").value;
    let email = document.getElementById("email").value;

    let msg = "";

    if(matricula.trim() == "")
        msg += "Matricula não preenchida\n";

    if(nome.trim() == "")
        msg += "Nome não preenchido\n";

    if(email.trim() == "")
        msg += "Email não preenchido\n";
    else{
        let re = /\S+@\S+\.\S+/;
        if(!re.test(email))
            msg += "Email inválido\n";
    }

    if(msg != ""){
        alert(msg);
        return false;
    }

    return true;
}

</script>
</head>
<body>

<h1>Criar / Editar Aluno</h1>

<form method="POST" onsubmit="return validarForm();">

    Matricula:
    <input type="text" name="matricula" id="matricula"><br><br>

    Nome:
    <input type="text" name="nome" id="nome"><br><br>

    Email:
    <input type="text" name="email" id="email"><br><br>

    <input type="submit" value="Criar Novo Aluno">
    <input type="submit" name="editar" value="Editar Aluno">
    <input type="submit" name="excluir" value="Excluir Aluno">
    <input type="submit" name="limpar" value="Limpar Tabela">
</form>

<p>
<?php echo $msg; ?>
</p>

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
                echo "<tr>
                        <td>$dados[0]</td>
                        <td>$dados[1]</td>
                        <td>$dados[2]</td>
                      </tr>";
            }
        }
    }

    fclose($arqAluno);
}
?>

</table>
</body>
</html>
