<?php
include("conectadb.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $login = $_POST['login'];
    

    RAND(100000,999999);


    #INSERIR INSTRUÇÕES NO BANCO
    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = 'email' OR usu_login = '$login'";
    $resultado = mysqli_query($link, $sql);
    $resultado = mysqli_fetch_array($resultado) [0];

    #VERIFICA SE EXISTE
    if($resultado >= 1){
            echo"<script.window.alert('EMAIL JÁ CADASTRADO');</script>";
            echo"<script>window.location.href='login.html';</script>";
    }
    else{
        $sql = "INSERT INTO usuarios
        (usu_nome, usu_senha, usu_status, usu_key, usu_email) VALUES ('$login', '$senha', 's', '$key', '$email')";
        mysqli_query($link, $sql);
        
    #GRAVA LOG#
        $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = '$email' AND usu_senha = '$senha' AND usu_status = 's'";
        $sql = '"'.$sql.'"';
        $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ('$sql', NOW())";
        mysqli_query($link, $sqllog);

        echo"<script>window.alert('USUARIO CADASTRADO');</script>";
        echo"<script>window.location.href='login.html';</script>";
    }
}

?>