<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AV1_3DAW</title>
</head>
<body>

<form action="index.php" method="POST">
    <input type="text" name="name" placeholder="Name" required> <br><br>
    <input type="email" name="email" placeholder="Email" required> <br><br>
    <button type="submit">Criar</button>
</form>

<br>

<a href="perguntas_multiplas.php">Perguntas de Múltipla Escolha</a>
<br><br>
<a href="perguntas_texto.php">Perguntas de Texto</a>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $linha = $name . ";" . $email . "\n";

    $userArq = fopen('users.txt', 'a');
    fwrite($userArq, $linha);
    fclose($userArq);

    echo "<p>Usuário cadastrado com sucesso!</p>";
}
?>

</body>
</html>