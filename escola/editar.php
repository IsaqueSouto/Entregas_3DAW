<?php

function salvarAluno($matricula, $nome, $email)
{

    if ($matricula == "" || $nome == "" || $email == "") {
        return "Preencha todos os campos!";
    }

    $arqAluno = fopen("alunos.txt", "a");
    fwrite($arqAluno, $matricula . ";" . $nome . ";" . $email . "\n");
    fclose($arqAluno);

    return "Deu tudo certo!";
}

function limparTabela()
{
    $arqAluno = fopen("alunos.txt", "w");
    fwrite($arqAluno, "matricula;nome;email\n");
    fclose($arqAluno);
}

function editarAluno($matricula, $nome, $email)
{

    if ($matricula == "" || $nome == "" || $email == "") {
        return "Preencha todos os campos!";
    }

    if (!file_exists("alunos.txt")) {
        return "Arquivo nao encontrado!";
    }

    $linhas = file("alunos.txt");
    $arqAluno = fopen("alunos.txt", "w");

    $achou = false;

    foreach ($linhas as $linha) {
        $dados = explode(";", $linha);

        if ($dados[0] == $matricula) {
            $linha = $matricula . ";" . $nome . ";" . $email . "\n";
            $achou = true;
        }

        fwrite($arqAluno, $linha);
    }

    fclose($arqAluno);

    if ($achou) {
        return "Aluno atualizado!";
    }

    return "Matricula nao encontrada!";
}
?>
