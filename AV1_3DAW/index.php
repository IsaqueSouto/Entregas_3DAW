<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $usuarios = [];

    if (file_exists("users.json")) {
        $usuarios = json_decode(
            file_get_contents("users.json"),
            true
        );
    }
    if (!$usuarios) {
        $usuarios = [];
    }
    $existe = false;

    foreach ($usuarios as $u) {

        if ($u["email"] == $email) {
            $existe = true;
            break;
        }

    }

    if ($existe) {

        echo "Email já cadastrado!";

    } else {

        $usuarios[] = [
            "name" => $name,
            "email" => $email
        ];

        file_put_contents(
            "users.json",
            json_encode($usuarios, JSON_PRETTY_PRINT)
        );

        echo "Usuário cadastrado com sucesso!";
    }

    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AV1 - 3DAW</title>
</head>

<body>

    <h2>Cadastro de Usuário</h2>

    <form id="formUsuario">
        <input type="text" name="name" placeholder="Nome" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>

    <div id="mensagem"></div>

    <hr>

    <h2>Menu</h2>

    <a href="perguntas_multiplas.php">Responder Perguntas Objetivas</a><br><br>
    <a href="perguntas_texto.php">Responder Perguntas Discursivas</a><br><br>
    <a href="criar_pergunta_multipla.php">Criar Pergunta Múltipla</a><br><br>
    <a href="criar_pergunta_texto.php">Criar Pergunta Discursiva</a><br><br>
    <a href="listar_perguntas.php">Listar Perguntas e Respostas</a><br><br>
    <a href="listar_uma_pergunta.php">Listar Pergunta Específica</a><br><br>
    <a href="alterar_pergunta_multipla.php">Alterar Pergunta Múltipla</a><br><br>
    <a href="alterar_pergunta_texto.php">Alterar Pergunta de Texto</a><br><br>
    <a href="excluir_pergunta.php">Excluir Pergunta</a>

    <script>
        document.getElementById("formUsuario").addEventListener("submit", function (e) {

            e.preventDefault();

            fetch("index.php", {
                method: "POST",
                body: new FormData(this)
            })
                .then(r => r.text())
                .then(t => {
                    document.getElementById("mensagem").innerHTML = t;
                });

        });
    </script>

</body>

</html>
