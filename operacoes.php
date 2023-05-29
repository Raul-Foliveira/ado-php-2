<?php
    require_once 'conectar.php';
    
    function listarDados() {
        $query = "SELECT * FROM medicamento";
        $result = mysqli_query($pdoClient, $query);
        
        return $result;
    }

    function inserirDados($nome_comum, $nome_substancia, $tarja, $preco, $tipo, $qtd_por_caixa, $unidade_medida, $fabricante) {
        require_once('abrir_transacao.php');

        abrir_transacao($pdoClient);
        
        require_once('fechar_transacao.php');

        fechar_transacao($pdoClient);
        
        return $result;
    }

    function alterarDados($chave, $nome_comum, $nome_substancia, $tarja, $preco, $tipo, $qtd_por_caixa, $unidade_medida, $fabricante) {
        require_once('abrir_transacao.php');
        abrir_transacao($pdoClient);

        
        $query = "UPDATE medicamento 
                SET nome_comum='$nome_comum', nome_substancia='$nome_substancia', tarja='$tarja', preco='$preco', tipo='$tipo', 
                    qtd_por_caixa='$qtd_por_caixa', unidade_medida='$unidade_medida', fabricante='$fabricante' 
                WHERE chave=$chave";
        $result = mysqli_query($pdoClient, $query);
        
        require_once('fechar_transacao.php');
        fechar_transacao($pdoClient);

        
        return $result;
    }

    function excluirDados($chave) {
        require_once('abrir_transacao.php');
      

        
        $query = "DELETE FROM medicamento WHERE chave=$chave";
        $result = mysqli_query($pdoClient, $query);
        
        require_once('fechar_transacao.php');
       

        
        return $result;
    }

    function lerDados($chave) {
        require_once('abrir_transacao.php');
        
        $query = "SELECT * FROM medicamento WHERE chave=$chave";
        $result = mysqli_query($pdoClient, $query);
        
        require_once('fechar_transacao.php');
        
        return $result;
    }   

?>
