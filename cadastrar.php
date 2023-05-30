<?php
 require_once 'conectar.php';

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
$query = "SELECT * FROM tipo_medicamento";
$resultTipoMedicamentos = mysqli_query($pdoClient, $query);

$query = "SELECT * FROM tipo_unidade_medida";
$resultUnidadeMedida = mysqli_query($pdoClient, $query);

$query = "SELECT * FROM tipo_tarja";
$resultTarjas = mysqli_query($pdoClient, $query);

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
            <?php
            foreach ($resultTarjas as $linha) {
        echo '<input type="radio" id="tarja" name="tarja" value="'.$linha["cor"].'"> '.$linha["cor"];
            }
?>

        </div>
        <div>
            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco">
        </div>
        <div>
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo">
            <option value="">Selecionar</option>

            <?php
            foreach ($resultTipoMedicamentos as $linha) {
        echo '<option value="'.$linha["tipo"].'">'.$linha["tipo"].'</option>';
            }
?>
        
        </select>


        </div>
        <div>
            <label for="qtd_por_caixa">Quantidade por Caixa:</label>
            <input type="number" id="qtd_por_caixa" name="qtd_por_caixa" min="1">
        </div>
        <div>
            <label for="unidade_medida">Unidade de Medida:</label>
            <select id="unidade_medida" name="unidade_medida">

            <option value="">Selecionar</option>

            <?php
            foreach ($resultUnidadeMedida as $linha) {
        echo '<option value="'.$linha["sigla"].'">'.$linha["sigla"].'</option>';
            }
?>
            </select>
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
