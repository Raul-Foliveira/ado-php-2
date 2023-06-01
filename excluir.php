<?php
try {
    include "abrir_transacao.php";
    include_once "operacoes.php";

 

    $chave = (int) $_POST["chave"];
    $id = excluirDados($chave);

    header("Location: listar.php");


    $transacaoOk = true;


} finally {
    include "fechar_transacao.php";
}
?>
