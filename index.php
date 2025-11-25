<?php
session_start();



if(!isset($_SESSION['navegacion'])){
    
    $_SESSION['navegacion']= "identificar";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Service</title>
    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    
    <link rel="stylesheet" href="assets/estilo.css">
    
    
</head>
<body>
    <?php
        if($_SESSION['navegacion'] == "identificar" || $_SESSION['navegacion'] == "registrar" ){
            include("vista/acceso.php");
        }
        
            

    ?>

     
    
    
</body>
</html>