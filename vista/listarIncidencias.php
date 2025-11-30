<div class="card shadow-sm">
    <div class="card-header text-center fw-bold fs-4">
        <?= $navegacion == "incidencias" ? "TODAS LAS INCIDENCIAS" : "MIS INCIDENCIAS" ?>
    </div>
    <div class="card-body">
        <form class="row g-3" action="" method="POST">
            <div class="col-md-4">
                <label for="nom_dep" class="form-label">Departamento</label>
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
            <div class="col-md-4">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-select" name="categoria" id="categoria">
                    <option value="-1">Seleccione una opción</option>
                    <?php
                    $resultado = $db->listarCategorias();
                    foreach ($resultado as $fila) {
                    ?>
                        <option value="<?= $fila["id"] ?>"><?= $fila["categoria"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="problematica" class="form-label">Problemática</label>
                <select class="form-select" name="problematica" id="problematica">
                    <option value="-1">Seleccione una opción</option>
                    <?php
                    $resultado = $db->listarProblematica();
                    foreach ($resultado as $fila) {
                    ?>
                        <option value="<?= $fila["id"] ?>"><?= $fila["problematica"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" name="estado" id="estado">
                    <option value="-1">Seleccione una opción</option>
                    <?php
                    $resultado = $db->listarEstados();
                    foreach ($resultado as $fila) {
                    ?>
                        <option value="<?= $fila["id"] ?>"><?= $fila["estado"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-8">
                <label for="texto" class="form-label">Buscar por asunto o descripción</label>
                <input type="text" class="form-control" placeholder="Texto" name="texto" id="texto">
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>USUARIO</th>
                        <th>TÉCNICO</th>
                        <th>DEPARTAMENTO</th>
                        <th>ASUNTO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>CATEGORÍA</th>
                        <th>PROBLEMÁTICA</th>
                        <th>ESTADO</th>
                        <th>COMENTARIO</th>
                        <th>FECHA DE INICIO</th>
                        <th>FECHA DE FIN</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($navegacion == "incidencias") {
                        $usuario = NULL;
                    } else if ($navegacion == "asignadas") {
                        $usuario = $_SESSION["usuario"];
                    }

                    $departamento = $_SESSION["usuario"]["departamento"];
                    $texto = $_POST["texto"] ?? NULL;
                    $categoria = $_POST["categoria"] ?? -1;
                    $problematica = $_POST["problematica"] ?? -1;
                    $estado = $_POST["estado"] ?? -1;


                    $resultado = $db->listarIncidencias($usuario, $departamento, $texto, $categoria, $problematica, $estado);
                    foreach ($resultado as $incidencia) {
                    ?>
                        <tr>
                            <td><?= $incidencia["id"] ?></td>
                            <td><?= $incidencia["email"] ?></td>
                            <td><?= $incidencia["tecnico_email"] ?></td>
                            <td><?= $incidencia["nom_dep"] ?></td>
                            <td><?= $incidencia["asunto"] ?></td>
                            <td><?= $incidencia["descripcion"] ?></td>
                            <td><?= $incidencia["categoria"] ?></td>
                            <td><?= $incidencia["problematica"] ?></td>
                            <td><?= $incidencia["estado"] ?></td>
                            <td><?= $incidencia["resolucion"] ?></td>
                            <td><?= $incidencia["fecha_inicio"] ?></td>
                            <td><?= $incidencia["fecha_fin"] ?></td>
                            <td>
                                <?php
                                echo $incidencia["id_estado"] != 3 && $incidencia["id_estado"] != 4
                                    ? ($_SESSION["usuario"]["tecnico"] == 1
                                        ? '<a class="btn btn-sm btn-primary" href="controlador/controlador.php?redireccion=gestionar&id=' . $incidencia["id"] . '" >' .
                                        (empty($incidencia["usuario_res"])
                                            ? '<i class="bi bi-person-plus"></i>' : ($incidencia["usuario_res"] == $_SESSION["usuario"]["id"] ? '<i class="bi bi-tools"></i>' : "")) . '</a>'
                                        : ($incidencia["usuario"] == $_SESSION["usuario"]["id"]
                                            ? '<a class="btn btn-sm btn-secondary me-1" href="controlador/controlador.php?redireccion=editar&id=' . $incidencia["id"] . '" ><i class="bi bi-pencil"></i></a><a class="btn btn-sm btn-danger cancelar-incidencia" data-id="' . $incidencia["id"] . '" href="controlador/controlador.php?redireccion=cancelar&id=' . $incidencia["id"] . '" ><i class="bi bi-x-circle"></i></a>'
                                            : "")
                                    ) : "";
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.cancelar-incidencia').forEach(a => {
        a.addEventListener('click', function(e) {
            if (!confirm('¿Desea cancelar la incidencia ' + this.dataset.id + '?')) {
                e.preventDefault();
            }
        });
    });
</script>