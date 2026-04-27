<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    file_put_contents("perguntas_texto.txt", $_POST["pergunta"] . "\n", FILE_APPEND);
    echo "Pergunta salva!";
}
?>
<form method="POST">
    Pergunta:<br>
    <input name="pergunta" required size="60"><br><br>
    <button>Salvar</button>
</form>
<a href="index.php">Voltar</a>
