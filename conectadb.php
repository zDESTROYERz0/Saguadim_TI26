<?php

#conecta com o servidor (xampp)
$servidor = "127.0.0.1";

#nome do banco
$banco = "saguadim";

#nome do usuario
$usuario = "root";

#senha do usuario
$senha = "";

#link de conexao com o banco 
$link = mysqli_connect($servidor, $usuario, $senha, $banco);
?>