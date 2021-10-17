<?php 
    session_start();
    $valor = isset($_SESSION['login']) ? true : false;
    if(!$valor){
        header("Location: ../forms/login.php");
    }
?>