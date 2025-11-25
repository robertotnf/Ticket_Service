<?php
$navegacion = $_SESSION["navegacion"];

?>
    
<div class="container-form">
        <div class="header">
            <div class="logo-title">
                <img src="assets/logo-azul.png" alt="">
            </div>
            <div class="menu">
                <a href="controlador/controlador.php?redireccion=identificar"><li class="<?= $navegacion == "identificar" ?"active": "" ?>">Identificar</li></a>
                <a href="controlador/controlador.php?redireccion=registrar"><li class="<?= $navegacion == "registrar" ?"active": "" ?>">Registrar</li></a>
            </div>
        </div>
        
        <form action="controlador/controlador.php" method="post" class="form">
            <input type="hidden" name="accion" value ="<?= $navegacion ?>"/>
            <div class="welcome-form"><h1>Bienvenido</h1></div>
           <div class="line-input">
                <input type="email" placeholder="Email" name="email">
            </div>
            <div class="line-input">
                <input type="password" placeholder="Contraseña" name="password">
            </div>
            <?php if($navegacion == "registrar"){ ?>
                <div class="line-input">
                    <input type="password" placeholder="Confirmar contraseña" name="password2">
                </div>
                
            <?php } ?>
            
            <button type="submit"><?= $navegacion != "registrar" ?"Entrar": "Registrar" ?></button>

        </form>
    </div>
