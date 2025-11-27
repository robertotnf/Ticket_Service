<?php
require_once("controlador/db.php");
if ($_SESSION["navegacion"] == "incidencias") {
?>
    <h3>TODAS LAS INCIDENCIAS</h3>
<?php
} else if ($_SESSION["navegacion"] == "asignadas") {
?>
    <h3>MIS INCIDENCIAS</h3>
<?php
}
?>
<form action="" method="POST">
    <label for="nom_dep">Nombre del departamento:</label>
    <select class="browser-default custom-select" name="nom_dep">
        <option value="-1">Seleccione una opción</option>
        <?php
        $resultado = $db->listarDepartamentos();
        foreach ($resultado as $fila) {
        ?>
            <option value="<?= $fila["cod"] ?>"><?= $fila["nom_dep"] ?></option>
        <?php
        }
        ?>
    </select>
    </br>
    <label for="texto">Buscar por asunto o descripción:</label>
    <input type="text" class="form-control" placeholder="texto" name="texto">
    <label for="categoria">Categoría:</label>
    <select class="browser-default custom-select" name="categoria">
        <option value="-1">Seleccione una opción</option>
        <?php
        $resultado = $db->listarCategorias();
        foreach ($resultado as $fila) {
        ?>
            <option value="<?= $fila["id"] ?>"><?= $fila["categoria"] ?></option>

        <?php
        }
        ?>
    </select>
    <label for="problematica">Problemática:</label>
    <select class="browser-default custom-select" name="problematica">
        <option value="-1">Seleccione una opción</option>
        <?php
        $resultado = $db->listarProblematica();
        foreach ($resultado as $fila) {
        ?>
            <option value="<?= $fila["id"] ?>"><?= $fila["problematica"] ?></option>
        <?php
        }
        ?>
    </select>
    <label for="estado">Estado:</label>
    <select class="browser-default custom-select" name="estado">
        <option value="-1">Seleccione una opción</option>
        <?php
        $resultado = $db->listarEstados();
        foreach ($resultado as $fila) {
        ?>
            <option value="<?= $fila["id"] ?>"><?= $fila["estado"] ?></option>
        <?php
        }
        ?>
    </select>
    </br></br>
    <input type="submit" value="Buscar" />
</form>
<table border="2">
    <tr>
        <td>ID</td>
        <td>USUARIO</td>
        <td>DEPARTAMENTO</td>
        <td>ASUNTO</td>
        <td>DESCRIPCION</td>
        <td>CATEGORÍA</td>
        <td>PROBLEMÁTICA</td>
        <td>ESTADO</td>
        <td>COMENTARIO</td>
        <td>FECHA DE INICIO</td>
        <td>ACCIÓN</td>
    </tr>
    <?php
    require_once("controlador/db.php");
    if ($_SESSION["navegacion"] == "incidencias") {
        $usuario = NULL;
    } else if ($_SESSION["navegacion"] == "asignadas") {
        $usuario = $_SESSION["usuario"];
    }
    if (isset($_POST["nom_dep"])) {
        $nom_dep = $_POST["nom_dep"];
    } else {
        $nom_dep = -1;
    }

    if (isset($_POST["texto"])) {
        $texto = $_POST["texto"];
    } else {
        $texto = NULL;
    }

    if (isset($_POST["categoria"])) {
        $categoria = $_POST["categoria"];
    } else {
        $categoria = -1;
    }

    if (isset($_POST["problematica"])) {
        $problematica = $_POST["problematica"];
    } else {
        $problematica = -1;
    }

    if (isset($_POST["estado"])) {
        $estado = $_POST["estado"];
    } else {
        $estado = -1;
    }


    $resultado = $db->listarIncidencias($usuario, $nom_dep, $texto, $categoria, $problematica, $estado);
    foreach ($resultado as $incidencia) {

    ?>
        <tr>
            <td><?= $incidencia["id"] ?></td>
            <td><?= $incidencia["email"] ?></td>
            <td><?= $incidencia["nom_dep"] ?></td>
            <td><?= $incidencia["asunto"] ?></td>
            <td><?= $incidencia["descripcion"] ?></td>
            <td><?= $incidencia["categoria"] ?></td>
            <td><?= $incidencia["problematica"] ?></td>
            <td><?= $incidencia["estado"] ?></td>
            <td><?= $incidencia["resolucion"] ?></td>
            <td><?= $incidencia["fecha_inicio"] ?></td>
            <td><?= $incidencia["id_estado"] != 3 && $incidencia["id_estado"] != 4
                    ? ($_SESSION["usuario"]["administrador"] == 1
                        ? '<a href="controlador/controlador.php?redireccion=gestionar&id=' . $incidencia["id"] . '" >' .
                        (empty($incidencia["usuario_res"])
                            ? 'Asignarme' : ($incidencia["usuario_res"] == $_SESSION["usuario"]["id"] ? 'Gestionar' : "")) . '</a>'
                        : ($incidencia["usuario"] == $_SESSION["usuario"]["id"]
                            ? '<a href="controlador/controlador.php?redireccion=editar&id=' . $incidencia["id"] . '" > Editar </a><br/> <a href="controlador/controlador.php?redireccion=cancelar&id=' . $incidencia["id"] . '" >Cancelar</a>'
                            : "")
                    ) : "";
                ?>

            </td>

        </tr>
    <?php
        /* $_SESSION["usuario"]["administrador"] == 1
                    ? '<a href="controlador/controlador.php?redireccion=gestionar&id=' . $incidencia["id"] . '" >' . (empty($incidencia["usuario_res"]) ? 'Asignarme' : 'Gestionar') . '</a>'
                    : ($incidencia["usuario"] == $_SESSION["usuario"]["id"] && ($incidencia["id_estado"] != 3 && $incidencia["id_estado"] != 4) ? '<a href="controlador/controlador.php?redireccion=editar&id=' . $incidencia["id"] . '" > Editar </a><br/> <a href="controlador/controlador.php?redireccion=cancelar&id=' . $incidencia["id"] . '" >Cancelar</a>' : "")
     */
    }
    ?>
</table>