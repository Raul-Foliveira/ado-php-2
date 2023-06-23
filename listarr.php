<?php
try {
    include "abrir_transacao.php";
include_once "operacoes.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type", "application/json");

$result = listarDados();
$tipos = listarDados();
$resposta = [
    "listagem" => array_values($result),
    "tipos" => array_values($tipos)
];
$json = json_encode($resposta, JSON_PRETTY_PRINT);
echo $json;

$transacaoOk = true;

} finally {
    include "fechar_transacao.php";
}
?>