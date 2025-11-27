<?php
require_once("controlador/db.php");
$crear = $_SESSION["navegacion"] == "crear";
$gestionar = $_SESSION["navegacion"] == "gestionar";
$editar = $_SESSION["navegacion"] == "editar";

if (!$crear) {
    $incidencia = $db->getIncidencia($_GET["id"]);
}

?>
<h3><?= $crear ? "CREAR" : ($editar ? "EDITAR" : "GESTIONAR") ?> INCIDENCIA</h3>

<div class="container">
    <main>
        <form action="controlador/controlador.php" method="POST">
            <!-- Grd row -->
            <div class="form-row">
                <!-- Grid column -->

                <div class="col">
                    <?php if (!$crear) { ?>
                        <input type="hidden" value="<?= $_GET["id"] ?>" name="id" />
                    <?php } ?>
                    <label for="categoria">Categoría:</label>
                    <select class="browser-default custom-select" name="categoria" <?= $gestionar ? "disabled" : "" ?>>

                        <?php
                        $resultado = $db->listarCategorias();
                        foreach ($resultado as $fila) {
                        ?>
                            <option value="<?= $fila["id"] ?>" <?= !$crear && $fila["id"] == $incidencia["id_categoria"] ? "selected" : "" ?>><?= $fila["categoria"] ?></option>

                        <?php
                        }
                        ?>
                    </select>
                    <label for="problematica">Problemática:</label>
                    <select class="browser-default custom-select" name="problematica" <?= $gestionar ? "disabled" : "" ?>>
                        <?php
                        $resultado = $db->listarProblematica();
                        foreach ($resultado as $fila) {
                        ?>
                            <option value="<?= $fila["id"] ?>" <?= !$crear && $fila["id"] == $incidencia["id_problematica"] ? "selected" : "" ?>><?= $fila["problematica"] ?></option>
                        <?php
                        }
                        ?>
                    </select>

                </div>
                <div class="col">
                    <label for="fecha_inicio">Fecha de inicio:</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" <?= $gestionar || $editar ? "disabled" : "" ?> value="<?= date("Y-m-d", strtotime($incidencia["fecha_inicio"])) ?>" /></br>
                    <label for="nom_dep">Nombre del departamento:</label>
                    <select class="browser-default custom-select" name="nom_dep" <?= $gestionar ? "disabled" : "" ?>>
                        <?php
                        $resultado = $db->listarDepartamentos();
                        foreach ($resultado as $fila) {
                        ?>
                            <option value="<?= $fila["cod"] ?>" <?= !$crear && $fila["cod"] == $incidencia["id_departamento"] ? "selected" : "" ?>><?= $fila["nom_dep"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <!-- Grid column -->
                <label for="asunto">Asunto:</label>
                <input type="text" class="form-control" placeholder="Asunto" name="asunto" required <?= $gestionar || $editar ? "disabled" : "" ?> value="<?= !$crear ? $incidencia["asunto"] : "" ?>">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="descripcion" required <?= $gestionar ? "disabled" : "" ?>><?= !$crear ? $incidencia["descripcion"] : "" ?></textarea>
            </div>
            <div class="col">
                <label for="estado">Estado:</label>
                <select class="browser-default custom-select" name="estado" <?= !$gestionar ? "disabled" : "" ?> required>
                    <?php
                    $resultado = $db->listarEstados();
                    foreach ($resultado as $fila) {

                    ?>
                        <option value="<?= $fila["id"] ?>" <?= $gestionar && $fila["id"] == 1 ? "disabled" : "" ?>><?= $fila["estado"] ?> </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <br />
            <label for="resolucion">Comentario:</label>
            <input type="text" class="form-control" name="resolucion" <?= !$gestionar ? "disabled" : "" ?> required>

            <!-- Grd row -->
            <button type="submit" class="btn btn-outline-primary">Registrar</button>
            <div class="mensaje">
            </div>
        </form>

    </main>
</div>