<?php
    require_once 'conectar.php';

try {
include "abrir_transacao.php";
include_once "operacoes.php";

function excluirDados($chave) {
    global $pdoClient;
   
    
    $query = "DELETE FROM medicamento WHERE chave=$chave";
    $result = mysqli_query($pdoClient, $query);
    
   

}

$chave = (int) $_POST["chave"];
$id = excluirDados($chave);


header("Location: listar.php");

$transacaoOk = true;

} finally {


include "fechar_transacao.php";
}
?>
