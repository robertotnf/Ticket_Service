<?php
session_start();
require_once("db.php");

//Gestión de redirección
if (isset($_GET["redireccion"])) {
    if ($_GET["redireccion"] == "logout") {
        session_destroy();
        header("location:../index.php");
    } else {
        $_SESSION["navegacion"] = $_GET["redireccion"];
        if ($_GET["redireccion"] == "gestionar" || $_GET["redireccion"] == "editar") {

            header("location:../index.php?id=" . $_GET["id"]);
        } elseif ($_GET["redireccion"] == "cancelar") {
            $db->cancelarIncidencia($_GET["id"]);
            $_SESSION["navegacion"] = "principal";
            header("location:../index.php");
        } elseif ($_GET["redireccion"] == "inicio") {
            $_SESSION["navegacion"] = "principal";
            header("location:../index.php");
        } else {
            header("location:../index.php");
        }
    }
} else {
    //Gestión de submits

    if ($_SESSION["navegacion"] == "registrar") {
        if (isset($_POST["check"])) {
            $check = 1;
        } else {
            $check = 0;
        }
        $usuario = $db->insertarUsuario($_POST["email"], $_POST["password"], $check);
        $_SESSION["usuario"] = $usuario[0];
        header("location:../index.php");
    } else if ($_SESSION["navegacion"] == "identificar") {

        $resultado = $db->comprobarUsuario($_POST["email"], $_POST["password"]);
        if (count($resultado) > 0) {
            $_SESSION["usuario"] = $resultado[0];
            $_SESSION["navegacion"] = "principal";
        }
        header("location:../index.php");
    } else if ($_SESSION["navegacion"] == "crear") {
        $estado = 1;
        $db->insertarIncidencia($_SESSION["usuario"]["id"], $_POST["nom_dep"], $_POST["asunto"], $_POST["descripcion"], $_POST["categoria"], $_POST["problematica"], $estado, $_POST["fecha_inicio"]);
        header("location:../index.php");
    } else if ($_SESSION["navegacion"] == "gestionar") {

        $db->setIncidencia($_POST["id"], $_POST["estado"], $_POST["resolucion"], $_SESSION["usuario"]["id"]);
        $_SESSION["navegacion"] = "principal";
        header("location:../index.php");
    } else if ($_SESSION["navegacion"] == "editar") {
        $db->editarIncidencia($_POST["id"], $_SESSION["usuario"]["id"], $_POST["nom_dep"],  $_POST["descripcion"],  $_POST["categoria"],  $_POST["problematica"]);
        $_SESSION["navegacion"] = "principal";
        header("location:../index.php");
    }
    /* else if ($_SESSION["navegacion"] == "buscar") {
    $db->listarIncidencias($_SESSION["id"], $_POST["nom_dep"], $_POST["texto"], $_POST["categoria"], $_POST["problematica"], $_POST["estado"]);
    header("location:../index.php");
} else if ($_SESSION["navegacion"] == "asignada") {
    header("location:../index.php");
}*/
}
