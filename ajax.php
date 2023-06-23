<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: http://localhost/ado-php-2/login.php");
    exit();
}
$usuario = $_SESSION["usuario"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>AJAX - Asynchronous Javascript and XML</title>
        <script async>
            let dadosLidos = null;
            let idxLinha = -1;
 
            function popular(dados) {
                dadosLidos = dados;
                let tabela = ""
                    + "<table>"
                    + '    <tr>'
                    + '        <th scope="column">Chave</th>'
                    + '        <th scope="column">nome_comum</th>'
                    + '        <th scope="column">nome_substancia</th>'
                    + '        <th scope="column">tarja</th>'
                    + '        <th scope="column">preco</th>'
                    + '        <th scope="column">tipo</th>'
                    + '        <th scope="column">qtd_por_caixa</th>'
                    + '        <th scope="column">unidade_medida</th>'
                    + '        <th scope="column">fabricante</th>'
                    + '    </tr>';
                let idx = 0;
                for (const linha of dados.listarr) {
                    tabela += `<tr>`
                        + `    <td>${linha.chave}</td>`
                        + `    <td>${linha.nome_comum}</td>`
                        + `    <td>${linha.nome_substancia}</td>`
                        + `    <td>${linha.tarja}</td>`
                        + `    <td>${linha.preco}</td>`
                        + `    <td>${linha.tipo}</td>`
                        + `    <td>${linha.qtd_por_caixa}</td>`
                        + `    <td>${linha.unidade_medida}</td>`
                        + `    <td>${linha.fabricante}</td>`
                        + `    <td><button type="button" onclick="editar(${idx})">Editar</button></td>`
                        + `</tr>`;
                    idx++;
                }
                tabela += ``
                    + `<tr>`
                    + `    <td colspan="6"></td>`
                    + `    <td><button type="button" onclick="novo()">Criar novo</button></td>`
                    + `</tr>`;
                document.getElementById("tipo").innerHTML = "<option>Escolha...</option>";
                for (const tipo of dados.tipos) {
                    const option = document.createElement("option");
                    option.value = tipo;
                    option.innerHTML = tipo;
                    option.id = "opcao-" + tipo;
                    document.getElementById("tipo").appendChild(option);
                }
                document.getElementById("listarr").innerHTML = tabela;
                document.getElementById("formulario").style.display = "none";
            }

            function editar(idx) {
                const linha = dadosLidos.listarr[idx];
                for (const campo in linha) {
                    const elem = document.getElementById(campo);
                    if (elem) elem.value = linha[campo];
                }
                document.getElementById("opcao-" + linha.tipo).setAttribute("selected", "selected");
                document.getElementById("formulario").style.display = "block";
                document.getElementById("div-chave").style.display = "block";
                document.getElementById("bt-excluir").style.display = "block";
            }

            function novo() {
                for (const campo of document.querySelectorAll("form input")) {
                    campo.value = "";
                }
                for (const campo of document.querySelectorAll("option")) {
                    campo.removeAttribute("selected");
                }
                document.getElementById("formulario").style.display = "block";
                document.getElementById("div-chave").style.display = "none";
                document.getElementById("bt-excluir").style.display = "none";
            }

           

            async function confirmar() {
                if (!confirm("Tem certeza que deseja salvar os dados?")) return;
                const alterar = document.getElementById("div-chave").style.display === "block";
                let dados = {};
                const campos = ["nome_comum", "nome_substancia", "tarja", "preco", "tipo", "qtd_por_caixa", "unidade_medida", "fabricante"];
                if (alterar) campos.push("chave");
                for (const campo of campos) {
                    const valor = document.getElementById(campo).value;
                    dados[campo] = valor;
                }
              
            }

            async function excluirDados() {
                if (!confirm("Tem certeza que deseja excluir ?")) return;

                const conteudo = JSON.stringify({chave: parseInt(document.getElementById("chave").value) });
                const result = await fetch("http://localhost/ado-php-2/excluir.php", {
                    method: "POST",
                    headers: {
                        "Content-type": "application/json"
                    },
                    body: conteudo
                });
                await lerDados();
            }
        </script>
    </head>
    <body>
        <h1>Seja bem-vindo(a), <?= $usuario["nome"] ?></h1>
        <form action="..//ado-php-2/logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
        <div id="listarr"></div>
        <button type="button" onclick="lerDados()">Ler o resultado</button>
        <form id="formulario" style="display:none">
            <div id="div-chave">
                <label for="chave">Chave:</label>
                <input type="text" id="chave" name="chave" value="" readonly>
            </div>
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
                <button type="button" onclick="confirmar()">Salvar</button>
                <button type="button" onclick="excluirDados()" id="bt-excluir">Excluir</button>
            </div>
        </form>
    </body>
</html>
