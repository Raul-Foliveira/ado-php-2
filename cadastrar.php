<?php
// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os valores do formulário
    $nome_comum = $_POST['nome_comum'];
    $nome_substancia = $_POST['nome_substancia'];
    $tarja = $_POST['tarja'];
    $preco = $_POST['preco'];
    $tipo = $_POST['tipo'];
    $qtd_por_caixa = $_POST['qtd_por_caixa'];
    $unidade_medida = $_POST['unidade_medida'];
    $fabricante = $_POST['fabricante'];

    // Incluir o arquivo com as funções
    require_once 'conectar.php';

    

    $query = "INSERT INTO medicamento (nome_comum, nome_substancia, tarja, preco, tipo, qtd_por_caixa, unidade_medida, fabricante) 
            VALUES ('".$nome_comum."', '".$nome_substancia."',
            '".$tarja."', '".$preco."', '".$tipo."', '".$qtd_por_caixa."',
            '".$unidade_medida."', '".$fabricante."')";
        $result = mysqli_query($pdoClient, $query);

    // Chamar a função inserirDados para inserir os dados no banco de dados
    //$resultado = inserirDados($nome_comum, $nome_substancia, $tarja, $preco, $tipo, $qtd_por_caixa, $unidade_medida, $fabricante);

    if ($result) {
        // Redirecionar para a página de listagem após inserir
        header("Location: listar.php");
        exit;
    } else {
        // Exibir mensagem de erro, caso ocorra um problema na inserção
        echo "Erro ao cadastrar o medicamento.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Medicamento</title>
</head>
<body>
    <form method="POST" action="cadastrar.php">
        <div>
            <label for="nome_comum">Nome Comum:</label>
            <input type="text" id="nome_comum" name="nome_comum">
        </div>
        <div>
            <label for="nome_substancia">Nome Substância:</label>
            <input type="text" id="nome_substancia" name="nome_substancia">
        </div>
        <div>
            <label for="tarja">Tarja:</label>
            <input type="text" id="tarja" name="tarja">
        </div>
        <div>
            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco">
        </div>
        <div>
            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo">
        </div>
        <div>
            <label for="qtd_por_caixa">Quantidade por Caixa:</label>
            <input type="text" id="qtd_por_caixa" name="qtd_por_caixa">
        </div>
        <div>
            <label for="unidade_medida">Unidade de Medida:</label>
            <input type="text" id="unidade_medida" name="unidade_medida">
        </div>
        <div>
            <label for="fabricante">Fabricante:</label>
            <input type="text" id="fabricante" name="fabricante">
        </div>
        <div>
            <button type="submit">Salvar</button>
        </div>
    </form>
</body>
</html>
