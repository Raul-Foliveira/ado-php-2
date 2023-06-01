<?php
    require_once 'conectar.php';
    
    function listarDados() {
        global $pdo;
        $sql = "SELECT * FROM medicamento";
        $result = [];
        $consulta = $pdo ->query ($sql);
        while ($linha = $consulta ->fetch ()) {
            $linha2 = array ();
            $result[] = $linha;
        }
        
        return $result;
    }

    function inserirDados($dados) {
        global $pdo; 
        $sql = "INSERT INTO medicamento (nome_comum, nome_substancia, tarja, preco, tipo, qtd_por_caixa, unidade_medida, fabricante)".
            "VALUES (:nome_comum,:nome_substancia,:tarja,:preco,:tipo,:qtd_por_caixa,:unidade_medida,:fabricante) ";
        $pdo->prepare($sql)->execute($dados);
        return $pdo->lastInsertId(); 
        

    }

    function alterarDados($chave) {
        global $pdo;
        $sql = "UPDATE medicamento SET".
        "nome_comum= :nome_comum," .
        " nome_substancia= :nome_substancia,".
        "tarja = :tarja, " .


        "preco = :preco, " .
        "tipo = :tipo, ".
        "qtd_por_caixa = :qtd_por_caixa, " .
        "unidade_medida = :unidade_medida " .
        "fabricante = :fabricante " .

        "WHERE chave = :chave";
    
    $pdo->prepare($sql)->execute($chave);
        
       

        
        }

      
    

    function excluirDados($chave) {

        global $pdo;
        $sql = "DELETE FROM medicamento WHERE chave = :chave";
        $pdo->prepare($sql)->execute (["chave" => $chave]);
        
       
    }

    function lerDados($chave) {
        global $pdo;
      
        
        $query = "SELECT * FROM medicamento WHERE chave = :chave";
        $stmt = $pdo->prepare($query);
        
      
    
    }   

?>

