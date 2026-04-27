<?php
if ($_POST) {
    $id = $_POST['id'];

    $pergunta = $_POST['pergunta'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $correta = $_POST['correta'];

    $linhas = file('perguntas_multiplas.txt', FILE_IGNORE_NEW_LINES);

    if (isset($linhas[$id])) {
        $linhas[$id] = $pergunta . ";" . $a . ";" . $b . ";" . $c . ";" . $d . ";" . $correta;

        file_put_contents('perguntas_multiplas.txt', implode("\n", $linhas));

        echo "Pergunta, respostas e alternativa correta alteradas!";
    } else {
        echo "ID inválido!";
    }
}
?>

<form method="post">
    ID: <input name="id" required><br><br>

    Pergunta: <input name="pergunta" required><br><br>

    A: <input name="a" required><br>
    B: <input name="b" required><br>
    C: <input name="c" required><br>
    D: <input name="d" required><br><br>

    Alternativa correta:
    <select name="correta" required>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select>

    <br><br>

    <button>Alterar</button>
</form>

<a href="index.php">Voltar</a>
