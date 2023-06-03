<?php
try {
    include "abrir_transacao.php";
    include_once "operacoes.php";

    $chave = (int) $_POST["chave"];
    if (!$chave) throw new Exception("Erro ao excluir");
    excluirDados($chave);

    header("Location: listar.php");


    $transacaoOk = true;


} finally {
    include "fechar_transacao.php";
}
?>
