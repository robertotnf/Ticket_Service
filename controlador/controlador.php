<?php
session_start();


if(isset($_GET["redireccion"])){

    $_SESSION["navegacion"]= $_GET["redireccion"];
    header("location:../index.php");
}

if(isset($_POST["accion"])){
    require_once("db.php");
    $db= new BaseDeDatos();
    if($_POST["accion"] == "registrar"){
        $db-> insertarUsuario($_POST["email"], $_POST["password"]);
    }
}







?>