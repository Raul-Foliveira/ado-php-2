<?php

try {
    require_once 'abrir_transacao.php';
    include_once "operacoes.php";


    $chave = isset($_GET["chave"]) ? (int) $_GET["chave"] : 0;
    $nome_comum = '';
    $nome_substancia = '';
    $tarja = 'preta';
    $preco = '';
    $tipo = '';
    $qtd_por_caixa = '';
    $unidade_medida = '';
    $fabricante = '';

    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obter os valores do formulário
        $chave = $_POST['chave'];
        $nome_comum = $_POST['nome_comum'];
        $nome_substancia = $_POST['nome_substancia'];
        $tarja = $_POST['tarja'];
        $preco = $_POST['preco'];
        $tipo = $_POST['tipo'];
        $qtd_por_caixa = $_POST['qtd_por_caixa'];
        $unidade_medida = $_POST['unidade_medida'];
        $fabricante = $_POST['fabricante'];
        if($chave > 0) {
            $query = "UPDATE medicamento SET nome_comum = :nome_comum, nome_substancia = :nome_substancia, tarja = :tarja, preco = :preco, tipo = :tipo, qtd_por_caixa = :qtd_por_caixa, unidade_medida = :unidade_medida, fabricante = :fabricante WHERE chave = :chave";
            $stmt = $pdo->prepare($query);
            $stmt->execute(["nome_comum" => $nome_comum, "nome_substancia" => $nome_substancia, "tarja" => $tarja, "preco" => $preco, "tipo" => $tipo, "qtd_por_caixa" => $qtd_por_caixa, "unidade_medida" => $unidade_medida, "fabricante" => $fabricante, "chave" => $chave]);

            // Redirecionar para a página de listagem após inserir
            header("Location: listar.php");
            
        } else {
            inserirDados(["nome_comum" => $nome_comum, "nome_substancia" => $nome_substancia, "tarja" => $tarja, "preco" => $preco, "tipo" => $tipo, "qtd_por_caixa" => $qtd_por_caixa, "unidade_medida" => $unidade_medida, "fabricante" => $fabricante]);

            // Redirecionar para a página de listagem após inserir
            header("Location: listar.php");
        }
    }

    if($chave > 0) {    
        $query = "SELECT * FROM medicamento WHERE chave = :chave";
        $stmt = $pdo->prepare($query);
        $resultMedicamento = $stmt->execute(["chave" => $chave]);

        // var_dump($resultMedicamento); debugar
        $nome_comum = $resultMedicamento["nome_comum"];
        $nome_substancia = $resultMedicamento["nome_substancia"];
        $tarja = $resultMedicamento["tarja"];
        $preco = $resultMedicamento["preco"];
        $tipo = $resultMedicamento["tipo"];
        $qtd_por_caixa = $resultMedicamento["qtd_por_caixa"];
        $unidade_medida = $resultMedicamento["unidade_medida"];
        $fabricante = $resultMedicamento["fabricante"];
    }

    $query = "SELECT * FROM tipo_medicamento";
    $resultTipoMedicamentos = $pdo->query($query);

    $query = "SELECT * FROM tipo_unidade_medida";
    $resultUnidadeMedida = $pdo->query($query);

    $query = "SELECT * FROM tipo_tarja";
    $resultTarjas = $pdo->query($query);
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
            <input type="hidden" id="chave" name="chave" value="<?=$chave?>">
            <div>
                <label for="nome_comum">Nome Comum:</label>
                <input type="text" id="nome_comum" name="nome_comum" value="<?=$nome_comum?>">
            </div>
            <div>
                <label for="nome_substancia">Nome Substância:</label>
                <input type="text" id="nome_substancia" name="nome_substancia" value="<?=$nome_substancia?>">
            </div>
            <div>
                <label for="tarja">Tarja:</label>
                <?php
                    while ($linha = $resultTarjas->fetch()) {
                        $checked = '';

                        if($tarja == $linha["cor"]) {
                            $checked = 'checked';
                        }
                        echo '<input type="radio" id="tarja" name="tarja" value="'.$linha["cor"].'" '.$checked.'> '.$linha["cor"];
                    }
                ?>

            </div>
            <div>
                <label for="preco">Preço:</label>
                <input type="text" id="preco" name="preco" value="<?=$preco?>">
            </div>
            <div>
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo">
                    <option value="">Selecionar</option>
                    <?php
                        while ($linha = $resultTipoMedicamentos->fetch()) {
                            
                            $selected = '';

                            if($tipo == $linha["tipo"]) {
                                $selected = 'selected';
                            }

                            echo '<option value="'.$linha["tipo"].'" '.$selected.'>'.$linha["tipo"].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="qtd_por_caixa">Quantidade por Caixa:</label>
                <input type="number" id="qtd_por_caixa" name="qtd_por_caixa" min="1" value="<?=$qtd_por_caixa?>">
            </div>
            <div>
                <label for="unidade_medida">Unidade de Medida:</label>
                <select id="unidade_medida" name="unidade_medida">
                    <option value="">Selecionar</option>
                    <?php
                        while ($linha = $resultUnidadeMedida->fetch()) {
                            $selected = '';

                            if($unidade_medida == $linha["sigla"]) {
                                $selected = 'selected';
                            }

                            echo '<option value="'.$linha["sigla"].'" '.$selected.'>'.$linha["sigla"].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="fabricante">Fabricante:</label>
                <input type="text" id="fabricante" name="fabricante" value="<?=$fabricante?>">
            </div>
            <div>
                <button type="submit">Salvar</button>
            </div>
        </form>
    </body>
</html>
<?php
    $transacaoOk = true;
} finally {
    include 'fechar_transacao.php';
}
