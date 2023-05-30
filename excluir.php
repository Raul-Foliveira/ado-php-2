<?php
require_once 'conectar.php';

    function excluirDados($chave, $conexao) {
        $chave = mysqli_real_escape_string($conexao, $chave);
        $query = "DELETE FROM medicamento WHERE chave=$chave";
        $result = mysqli_query($conexao, $query);
        return $result;
    }

    $chave = isset($_GET["chave"]) ? (int) $_GET["chave"] : 0;
    $id = excluirDados($chave, $pdoClient);

    header("Location: listar.php");
    exit();

?>
