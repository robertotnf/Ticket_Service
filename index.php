<?php
session_start();

if (!isset($_SESSION['navegacion'])) {
    if (isset($_SESSION["usuario"])) {

        $_SESSION['navegacion'] = "principal";
    } else {
        $_SESSION['navegacion'] = "identificar";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ticket Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/estilo.css">

</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    if (isset($_SESSION["usuario"])) {
    ?>
        <header>
            <nav class="navbar navbar-expand-sm bg-body-tertiary">
                <div class="container-fluid">
                    <img src="assets/logo-azul.png"></img>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?= $_SESSION["navegacion"] == "principal" ? "active" : "" ?> " aria-current="page" href="controlador/controlador.php?redireccion=inicio">Inicio</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link <?= $_SESSION["navegacion"] != "principal" ? "active" : "" ?> dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Incidencias
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if ($_SESSION["usuario"]["administrador"] != 1) { ?>
                                        <li><a class="dropdown-item" href="controlador/controlador.php?redireccion=crear">Crear incidencias</a></li>
                                    <?php } ?>
                                    <li><a class="dropdown-item" href="controlador/controlador.php?redireccion=incidencias">Todas las incidencias</a></li>
                                    <li><a class="dropdown-item" href="controlador/controlador.php?redireccion=asignadas">Mis incidencias</a></li>
                                </ul>
                            </li>
                            <li class="nav-item ml-auto">
                                <a href="controlador/controlador.php?redireccion=logout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                    </svg>
                                </a>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </header>
    <?php
    }
    ?>
    <div class="container-fluid">
        <main class="flex-fill container-fluid py-4">
            <?php
            if ($_SESSION['navegacion'] == "identificar" || $_SESSION['navegacion'] == "registrar") {
                include("vista/acceso.php");
            } else if ($_SESSION['navegacion'] == "principal") {
                include("vista/principal.php");
            } else if ($_SESSION['navegacion'] == "crear") {
                include("vista/incidencia.php");
            } else if ($_SESSION['navegacion'] == "gestionar") {
                include("vista/incidencia.php");
            } else if ($_SESSION['navegacion'] == "incidencias" || $_SESSION['navegacion'] == "asignadas") {
                include("vista/listarIncidencias.php");
            } else if ($_SESSION['navegacion'] == "editar") {
                echo  $_GET["id"];
                include("vista/incidencia.php");
            }
            ?>
        </main>
        <footer class="bg-dark text-secondary p-3 text-center">
            © 2025 Copyright: Roberto Jose Reveron
        </footer>
    </div>
    <script src="js/util.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
</body>

</html>