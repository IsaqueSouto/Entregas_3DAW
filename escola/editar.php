<?php

function salvarAluno($matricula, $nome, $email)
{
    if ($matricula == "" || $nome == "" || $email == "") {
        return "Preencha todos os campos!";
    }

    if (!file_exists("alunos.txt")) {
        $arq = fopen("alunos.txt", "w");
        fwrite($arq, "matricula;nome;email\n");
        fclose($arq);
    }

    $arq = fopen("alunos.txt", "a");
    fwrite($arq, "$matricula;$nome;$email\n");
    fclose($arq);

    return "Aluno cadastrado!";
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
    $arq = fopen("alunos.txt", "w");

    $achou = false;

    foreach ($linhas as $linha) {

        $dados = explode(";", trim($linha));

        if ($dados[0] == "matricula") {
            fwrite($arq, $linha);
            continue;
        }

        if ($dados[0] == $matricula) {
            fwrite($arq, "$matricula;$nome;$email\n");
            $achou = true;
        } else {
            fwrite($arq, $linha);
        }
    }

    fclose($arq);

    return $achou ? "Aluno atualizado!" : "Matricula nao encontrada!";
}

function limparTabela()
{
    $arq = fopen("alunos.txt", "w");
    fwrite($arq, "matricula;nome;email\n");
    fclose($arq);

    return "Tabela limpa!";
}
