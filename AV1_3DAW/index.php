<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AV1 - 3DAW</title>
</head>

<body>

    <h2>Cadastro de Usuário</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Nome" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $existe = false;

        if (file_exists("users.txt")) {
            $usuarios = file("users.txt");
            foreach ($usuarios as $u) {
                $dados = explode(";", $u);
                if (trim($dados[1]) == $email) {
                    $existe = true;
                    break;
                }
            }
        }

        if ($existe) {
            echo "<p>Email já cadastrado!</p>";
        } else {
            $linha = $name . ";" . $email . "\n";
            $userArq = fopen('users.txt', 'a');
            fwrite($userArq, $linha);
            fclose($userArq);
            echo "<p>Usuário cadastrado com sucesso!</p>";
        }
    }
    ?>

    <hr>
    <h2>Menu</h2>

    <a href="perguntas_multiplas.php">Responder Perguntas Objetivas</a><br><br>
    <a href="perguntas_texto.php">Responder Perguntas Discursivas</a><br><br>
    <a href="criar_pergunta_multipla.php">Criar Pergunta Múltipla</a><br><br>
    <a href="criar_pergunta_texto.php">Criar Pergunta Discursiva</a><br><br>
    <a href="listar_perguntas.php">Listar Perguntas e Respostas</a><br><br>
    <a href="listar_uma_pergunta.php">Listar Pergunta Específica</a><br>

</body>

</html>
<br>
<a href="alterar_pergunta_multipla.php">Alterar Pergunta Múltipla</a><br><br>
<a href="alterar_pergunta_texto.php">Alterar Pergunta de Texto</a><br><br>
<a href="excluir_pergunta.php">Excluir Pergunta</a><br>
