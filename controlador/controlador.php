<?php
session_start();


if(isset($_GET["redireccion"])){
    if($_GET["redireccion"] == "logout"){
        session_destroy();
    }else{
        $_SESSION["navegacion"]=$_GET["redireccion"];
    }
    header("location:../index.php");
    
}

if(isset($_POST["accion"])){
    require_once("db.php");
    $db= new BaseDeDatos();
    if($_POST["accion"] == "registrar"){
        $db-> insertarUsuario($_POST["email"], $_POST["password"]);
        $_SESSION["email"] = $_POST["email"];
        header("location:../index.php");
    }else if($_POST["accion"] == "identificar"){
        $resultado = $db-> comprobarUsuario($_POST["email"], $_POST["password"]);
        if($resultado){
            $_SESSION["email"] = $_POST["email"];
        }
        header("location:../index.php");
    }

}







?>