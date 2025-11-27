<?php
require_once("controlador/db.php");
$resultado = $db->totalIncidenciasEstado();
?>
<div class="row">
    <div class="card">
        <div class="card-header">
            Total incidencias
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $resultado["totales"] ?></h5>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            Incidencias abiertas
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $resultado["abiertas"] ?></h5>
            <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar text-bg-danger" style="width: <?= $resultado["pAbiertas"] ?>%"><?= $resultado["pAbiertas"] ?>%</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            Incidencias en proceso
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $resultado["enProceso"] ?></h5>
            <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar text-bg-danger" style="width: <?= $resultado["pEnProceso"] ?>%"><?= $resultado["pEnProceso"] ?>%</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            Incidencias cerradas
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $resultado["cerradas"] ?></h5>
            <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar text-bg-danger" style="width: <?= $resultado["pCerradas"] ?>%"><?= $resultado["pCerradas"] ?>%</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            Incidencias canceladas
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $resultado["canceladas"] ?></h5>
            <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar text-bg-danger" style="width: <?= $resultado["pCanceladas"] ?>%"><?= $resultado["pCanceladas"] ?>%</div>
            </div>
        </div>
    </div>
</div>
</section>