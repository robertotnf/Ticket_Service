<?php
session_start();
if (isset($_SESSION["email"])) {
    $_SESSION['navegacion'] = "principal";
}

if (!isset($_SESSION['navegacion'])) {

    $_SESSION['navegacion'] = "identificar";
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
    <div class="container-fluid">
        <main class="flex-fill container-fluid py-4">
            <?php
            if ($_SESSION['navegacion'] == "identificar" || $_SESSION['navegacion'] == "registrar") {
                include("vista/acceso.php");
            } else if ($_SESSION['navegacion'] == "principal") {
                include("vista/principal.php");
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