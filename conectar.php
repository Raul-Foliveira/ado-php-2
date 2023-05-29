<?php
 //    DataBase info.
 define('HOST', 'localhost');
 define('USUARIO', 'root');
 define('SENHA', '');
 define('DB', 'dbfamarcia');

 $pdoClient = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possivel conectar!');
 mysqli_select_db($pdoClient, DB);
 mysqli_set_charset($pdoClient,"utf8");
?>
