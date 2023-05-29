<?php
require_once 'conectar.php';

try {
    include "abrir_transacao.php";
    include_once "operacoes.php";

    function excluirDados($chave, $conexao) {
        $chave = mysqli_real_escape_string($conexao, $chave);
        $query = "DELETE FROM medicamento WHERE chave=$chave";
        $result = mysqli_query($conexao, $query);
        return $result;
    }

    $chave = isset($_POST["chave"]) ? (int) $_POST["chave"] : 0;
    $id = excluirDados($chave, $pdoClient);

    header("Location: listar.php");
    exit();

    $transacaoOk = true;
} finally {
    include "fechar_transacao.php";
}
?>
