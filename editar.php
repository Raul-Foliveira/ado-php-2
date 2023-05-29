<?php
        $query = "SELECT * FROM medicamento WHERE chave=".$_REQUEST["chave"];
    $return = $conectar-> $query($sql);
?>


<html>
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
