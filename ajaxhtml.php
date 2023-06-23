<?php
try {
    include "abrir_transacao.php";
include_once "operacoes.php";
$result = listarDados();

?>
<table>
    <tr>
            <th scope="column">nome_comum</th>
            <th scope="column">nome_substancia</th>
            <th scope="column">tarja</th>
            <th scope="column">preco</th>
            <th scope="column">tipo</th>
            <th scope="column">qtd_por_caixa</th>
            <th scope="column">unidade_medida</th>
            <th scope="column">fabricante</th> 
    </tr>
    <?php foreach ($result as $linha) { ?>
        <tr>
            <td><?= $linha["nome_comum"] ?></td>
            <td><?= $linha["nome_substancia"] ?></td>
            <td><?= $linha["tarja"] ?></td>
            <td><?= $linha["preco"] ?></td>
            <td><?= $linha["tipo"] ?></td>
            <td><?= $linha["qtd_por_caixa"] ?></td>
            <td><?= $linha["unidade_medida"] ?></td>
            <td><?= $linha["fabricante"] ?></td>
            <td>

                <button type="button">
                    <a href="cadastrar.php?chave=<?= $linha["chave"] ?>">Editar</a>
                </button>
            </td>
        </tr>
    <?php } ?>
</table>
<button type="button"><a href="cadastrar.php">Criar novo</a></button>
<?php

$transacaoOk = true;

} finally {
    include "fechar_transacao.php";
}
?>