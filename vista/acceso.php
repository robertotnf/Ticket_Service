<?php
$navegacion = $_SESSION["navegacion"];

?>

<div class="mx-auto pb-4 bg-light">
    <div class="header">
        <div class="logo-title">
            <img src="assets/logo-azul.png" alt="">
        </div>
        <div class="menu">
            <a href="controlador/controlador.php?redireccion=identificar">
                <li class="<?= $navegacion == "identificar" ? "active" : "" ?>">Identificar</li>
            </a>
            <a href="controlador/controlador.php?redireccion=registrar">
                <li class="<?= $navegacion == "registrar" ? "active" : "" ?>">Registrar</li>
            </a>
        </div>
    </div>

    <form id="frm" action="controlador/controlador.php" method="post" class="form">
        <div class="welcome-form">
            <h1>Bienvenido</h1>
        </div>
        <div class="line-input">
            <input type="email" id="email" placeholder="Email" name="email" required>
        </div>
        <div class="line-input">
            <input type="password" id="password" placeholder="Contraseña" name="password" required>
        </div>
        <?php if ($navegacion == "registrar") { ?>
            <div class="line-input">
                <input type="password" id="password2" placeholder="Confirmar contraseña" name="password2" required>


            </div>
            <div class="line-input">
                <label for="check">Administrador</label>
                <input type="checkbox" id="check" placeholder="Confirmar contraseña" name="check">
            </div>
        <?php } ?>

        <button type="submit"><?= $navegacion != "registrar" ? "Entrar" : "Registrar" ?></button>

    </form>
</div>
<?php if ($navegacion == "registrar") { ?>
    <script>
        document.getElementById('frm').addEventListener('submit', function(e) {
            e.preventDefault();
            validarPasswords();
        })
    </script>
<?php } ?>