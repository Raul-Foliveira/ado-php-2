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

    function alterarDados($dados) {
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
    
    $pdo->prepare($sql)->execute($dados);
        
       
 }

      
    

    function excluirDados($chave) {

        global $pdo;
        $sql = "DELETE FROM medicamento WHERE chave = :chave";
        $pdo->prepare($sql)->execute(["chave" => $chave]);


          
    }

    function lerDados($dados) {
        global $pdo;
      
        $sql = "SELECT * FROM medicamento WHERE chave = :chave";
        $result = [];
        $consulta = $pdo->prepare($sql);
        $consulta->execute(["chave" => $chave]);
        return $consulta->fetch();        
        // $stmt = $pdo->prepare($query);
        
      
    
    } 

    
    function login($nome, $senha) {
        global $pdo;
        $sql = "SELECT chave, nome FROM usuario WHERE nome = :nome AND senha = :senha";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(["nome" => $nome, "senha" => $senha]);
        return $consulta->fetch();
    }  




?>

