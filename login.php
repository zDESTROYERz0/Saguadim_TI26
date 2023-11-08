<?php
    #INCIA SESSAO DE ACESSO
session_start();

    #INCLUI CONEXAO COM O BANCO
include("conectadb.php");
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
   
    #QUERY DE VALIDA SE USUARIO EXISTE
    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = '$email' AND usu_senha = '$senha' AND usu_status = 's'";
    $retorno = mysqli_query($link, $sql);
   
    #SUGESTAO SANITIZAÇÃO
    $retorno = mysqli_fetch_array($retorno) [0];
 
    #GRAVA LOG
    $sql ='"'.$sql.'"';
    $sqllog ="INSERT INTO tab_log (tab_query, tab_data VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);
 
    #SE O USUARIO EXISTE LOGA, SE NAO EXISTE NAO LOGA
    if ($resultado == 0){
        echo"<script>window.alert('USUARIO INCORRETO');</script>";
    }
    else{
    $sql = "SELECT * FROM usuarios WHERE usu_email = '$email' AND usu_senha = '$senha'AND usu_status = 's'";
    $retorno = mysqli_query($link,$sql);

    #GRAVA LOG
    $sql ='"'.$sql.'"';
    $sqllog ="INSERT INTO tab_log (tab_query, tab_data VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);
 
    while($tbl = mysqli_fetch_array($retorno)){
        $_SESSION['idusuario'] = $tbl[0];
        $_SESSION['nomeusuario'] = $tbl[1];
    }
        echo"<script>window.location.href='backoffice.php';</script>";
    }
 
}
 
?>