<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastrar Medicamento</title>
    <script>
        function confirmar() {
            if (!confirm("Tem certeza que deseja salvar os dados?")) return;
            document.getElementById("formulario").submit();
        }
    </script>
</head>
<body>
    <form method="POST" action="inserirDados.php" id="formulario">
        <div>
            <label for="nome_comum">nome_comum:</label>
            <input type="text" id="nome_comum" name="nome_comum">
        </div>
        <div>
            <label for="nome_substancia">nome_substancia:</label>
            <input type="text" id="nome_substancia" name="nome_substancia">
        </div>
        <div>
            <label for="tarja">tarja:</label>
            <input type="text" id="tarja" name="tarja">
        </div>
        <div>
            <label for="preco">preco:</label>
            <input type="text" id="preco" name="preco">
        </div>
        <div>
            <label for="tipo">tipo:</label>
            <input type="text" id="tipo" name="tipo">
        </div>
        <div>
            <label for="qtd_por_caixa">qtd_por_caixa:</label>
            <input type="text" id="qtd_por_caixa" name="qtd_por_caixa">
        </div>
        <div>
            <label for="unidade_medida">unidade_medida:</label>
            <input type="text" id="unidade_medida" name="unidade_medida">
        </div>
        <div>
            <label for="fabricante">fabricante:</label>
            <input type="text" id="fabricante" name="fabricante">
        </div>
        <div>
            <button type="button" onclick="confirmar()">Salvar</button>
        </div>
    </form>
</body>
</html>
