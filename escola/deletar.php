<?php

function excluirAluno($matricula)
{
    $matricula = trim($matricula);

    if ($matricula == "") {
        return "Informe a matricula!";
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

        if ($dados[0] != $matricula) {
            fwrite($arq, $linha);
        } else {
            $achou = true;
        }
    }

    fclose($arq);

    return $achou ? "Aluno excluido!" : "Matricula nao encontrada!";
}
