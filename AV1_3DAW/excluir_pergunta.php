<?php
if ($_POST) {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];

    if ($tipo == "multipla") {
        $arquivo = 'perguntas_multiplas.txt';
    } else {
        $arquivo = 'perguntas_texto.txt';
    }

    if (file_exists($arquivo)) {
        $linhas = file($arquivo);
        $novasLinhas = [];

        foreach ($linhas as $index => $linha) {
            if ($index != $id) {
                $novasLinhas[] = $linha;
            }
        }

        file_put_contents($arquivo, implode('', $novasLinhas));

        echo "Pergunta excluída com sucesso!";
    } else {
        echo "Arquivo não encontrado!";
    }
}
?>

<form method="post">
    ID: <input name="id" required><br><br>

    Tipo:
    <select name="tipo" required>
        <option value="multipla">Múltipla Escolha</option>
        <option value="texto">Texto</option>
    </select>

    <br><br>

    <button>Excluir</button>
</form>

<a href="index.php">Voltar</a>
