<?php

$crear = $navegacion == "crear";
$gestionar = $navegacion == "gestionar";
$editar = $navegacion == "editar";

if (!$crear) {
    $incidencia = $db->getIncidencia($_GET["id"]);
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header text-center fw-bold fs-4">
                    <?= $crear ? "CREAR" : ($editar ? "EDITAR" : "GESTIONAR") ?> INCIDENCIA
                </div>
                <div class="card-body">
                    <form action="controlador/controlador.php" method="POST">
                        <?php if (!$crear) { ?>
                            <input type="hidden" value="<?= $_GET["id"] ?>" name="id" />
                        <?php } ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="categoria" class="form-label">Categoría:</label>
                                <select class="form-select" name="categoria" id="categoria" <?= $gestionar ? "disabled" : "" ?>>
                                    <?php
                                    $resultado = $db->listarCategorias();
                                    foreach ($resultado as $fila) {
                                    ?>
                                        <option value="<?= $fila["id"] ?>" <?= !$crear && $fila["id"] == $incidencia["id_categoria"] ? "selected" : "" ?>><?= $fila["categoria"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="problematica" class="form-label">Problemática:</label>
                                <select class="form-select" name="problematica" id="problematica" <?= $gestionar ? "disabled" : "" ?>>
                                    <?php
                                    $resultado = $db->listarProblematica();
                                    foreach ($resultado as $fila) {
                                    ?>
                                        <option value="<?= $fila["id"] ?>" <?= !$crear && $fila["id"] == $incidencia["id_problematica"] ? "selected" : "" ?>><?= $fila["problematica"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                                <input type="date" name="fecha_inicio" max="<?= date('Y-m-d') ?>" id="fecha_inicio" class="form-control"
                                    <?= $gestionar || $editar ? "disabled" : "" ?>
                                    value="<?= !$crear ? date("Y-m-d", strtotime($incidencia["fecha_inicio"])) : "" ?>" required />
                            </div>
                            <div class="col-md-6">
                                <label for="nom_dep" class="form-label">Nombre del departamento:</label>
                                <select class="form-select" name="nom_dep" id="nom_dep" disabled>
                                    <?php
                                    $departamento = $_SESSION["usuario"]["departamento"];
                                    $resultado = $db->listarDepartamentos();
                                    foreach ($resultado as $fila) {
                                    ?>
                                        <option value="<?= $fila["cod"] ?>" <?= $fila["cod"] == $departamento ? "selected" : "" ?>><?= $fila["nom_dep"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="asunto" class="form-label">Asunto:</label>
                            <input type="text" class="form-control" placeholder="Asunto" name="asunto" id="asunto" required
                                <?= $gestionar || $editar ? "disabled" : "" ?>
                                value="<?= !$crear ? $incidencia["asunto"] : "" ?>">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" rows="5" name="descripcion" required
                                <?= $gestionar ? "disabled" : "" ?>><?= !$crear ? $incidencia["descripcion"] : "" ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <select class="form-select" name="estado" id="estado" <?= !$gestionar ? "disabled" : "" ?> required>
                                <?php
                                $resultado = $db->listarEstados();
                                foreach ($resultado as $fila) {
                                ?>
                                    <option value="<?= $fila["id"] ?>" <?= $gestionar && $fila["id"] == 1 ? "disabled" : "" ?>><?= $fila["estado"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="resolucion" class="form-label">Comentario:</label>
                            <input type="text" class="form-control" name="resolucion" id="resolucion"
                                <?= !$gestionar ? "disabled" : "" ?> required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                        <div class="mensaje mt-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>