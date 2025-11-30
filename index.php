<?php
session_start();

require_once("controlador/db.php");


if (!isset($_SESSION["navegacion"])) {
    if (isset($_SESSION["usuario"])) {

        $_SESSION["navegacion"] = "principal";
    } else {
        $_SESSION["navegacion"] = "identificar";
    }
}

$navegacion = $_SESSION["navegacion"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SoluTIckets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/estilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="d-flex flex-column min-vh-100 p-4">
    <header class="rounded">
        <nav class="navbar navbar-light navbar-expand-sm rounded fs-5">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-brand" href="#">
                    <img src="assets/logo.png" height="50" alt="">
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php
                    if (isset($_SESSION["usuario"])) {
                    ?>
                        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                            <li class="nav-item mx-3">
                                <a class="nav-link <?= $navegacion == "principal" ? "active" : "" ?> " aria-current="page" href="controlador/controlador.php?redireccion=inicio">Inicio</a>
                            </li>
                            <li class="nav-item dropdown mx-3">
                                <a class="nav-link <?= $navegacion != "principal" ? "active" : "" ?> dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Incidencias
                                </a>
                                <ul class="dropdown-menu fs-6">
                                    <?php if ($_SESSION["usuario"]["tecnico"] != 1) { ?>
                                        <li><a class="dropdown-item" href="controlador/controlador.php?redireccion=crear">Crear incidencia</a></li>
                                    <?php } ?>
                                    <li><a class="dropdown-item" href="controlador/controlador.php?redireccion=incidencias">Todas las incidencias</a></li>
                                    <li><a class="dropdown-item" href="controlador/controlador.php?redireccion=asignadas">Mis incidencias</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                            <li class="nav-item mx-3 ">
                                <a class="nav-link" href="controlador/controlador.php?redireccion=logout"><small><?= $_SESSION["usuario"]["email"] ?>&nbsp;<?= $_SESSION["usuario"]["tecnico"] == 1 ? "(Técnico)" : "(Usuario)" ?><small>&nbsp;<i class="bi bi-box-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    <?php
                    } else {
                    ?>
                        <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                            <a class="nav-link me-3 <?= $navegacion == "identificar" ? "active" : "" ?>" href="controlador/controlador.php?redireccion=identificar">Identificar</a>
                            <a class="nav-link me-5 <?= $navegacion == "registrar" ? "active" : "" ?>" href="controlador/controlador.php?redireccion=registrar">Registrar</a>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <?php if (!empty($_SESSION['msg'])) { ?>
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show text-center fw-bold" role="alert">
                    <?= $_SESSION['msg'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            </div>
        <?php unset($_SESSION['msg']);
        } ?>

        <main class="flex-fill container-fluid py-4">
            <?php
            if ($navegacion == "identificar" || $navegacion == "registrar") {
                include("vista/acceso.php");
            } else if ($navegacion == "principal") {
                include("vista/principal.php");
            } else if ($navegacion == "crear") {
                include("vista/incidencia.php");
            } else if ($navegacion == "gestionar") {
                include("vista/incidencia.php");
            } else if ($navegacion == "incidencias" || $navegacion == "asignadas") {
                include("vista/listarIncidencias.php");
            } else if ($navegacion == "editar") {
                echo  $_GET["id"];
                include("vista/incidencia.php");
            }
            ?>
        </main>
    </div>
    <footer class="pt-3 mt-2 rounded">
        <div class="container">
            <div class="row ">

                <!-- Contacto -->
                <div class="col-12 col-md-6">
                    <div class="d-flex flex-column align-items-center">
                        <h6 class="text-uppercase fw-bold mb-1">Contacto</h6>
                        <ul class="list-unstyled mb-0">
                            <li><i class="bi bi-geo-alt-fill me-2"></i>C/ Ejemplo 123, 39000 Ciudad</li>
                            <li><i class="bi bi-telephone-fill me-2"></i><a class="link-dark text-decoration-none" href="tel:+34900111222">+34 900 111 222</a></li>
                            <li><i class="bi bi-envelope-fill me-2"></i><a class="link-dark text-decoration-none" href="mailto:info@soluTickets.com">info@soluTickets.com</a></li>
                            <li><i class="bi bi-clock-fill me-2"></i>L–V: 09:00–18:00</li>
                        </ul>
                    </div>
                </div>

                <!-- Redes / Logo -->
                <div class="col-12 col-md-6 mt-3 mt-md-0">
                    <div class="d-flex flex-column align-items-center">
                        <h6 class="text-uppercase fw-bold mb-1">Síguenos</h6>
                        <ul class="list-unstyled mb-0 ">
                            <li>
                                <i class="bi bi-linkedin me-2"></i><span>@soluTicketsLinkedIn</span>
                            </li>
                            <li>
                                <i class="bi bi-twitter-x me-2"></i><span>@soluTicketsX</span>
                            </li>
                            <li>
                                <i class="bi bi-facebook me-2"></i><span>@soluTicketsFacebook</span>
                            </li>
                            <li>
                                <i class="bi bi-instagram me-2"></i><span>@soluTicketsInstagram</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <hr class="border-secondary mt-2 mb-2">

            <div class="text-center pb-2 small">
                <div>&copy; 2025 soluTickets S.A. Todos los derechos reservados.</div>

            </div>
        </div>
    </footer>
    <script src="js/util.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>

</body>

</html>