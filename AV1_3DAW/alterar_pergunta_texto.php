<?php
if ($_POST) {
    $id = $_POST['id'];
    $nova = $_POST['pergunta'];
    $linhas = file('perguntas_texto.txt');
    $linhas[$id] = $nova . PHP_EOL;
    file_put_contents('perguntas_texto.txt', implode('', $linhas));
    echo "Pergunta alterada!";
}
?>
<form method="post">
    ID: <input name="id"><br>
    Nova pergunta: <input name="pergunta"><br>
    <button>Alterar</button>
</form>
<a href="index.php">Voltar</a>
