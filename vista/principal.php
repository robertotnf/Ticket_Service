<?php

$resultado = $db->totalIncidenciasEstado();
?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-5">
        <div class="card shadow-sm text-center">
            <div class="card-header fs-4 fw-bold ">
                Total incidencias
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $resultado["totales"] ?></h5>
            </div>
        </div>
    </div>

</div>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-5 mt-4">
        <div class="card shadow-sm text-center">
            <div class="card-header fs-4 fw-bold">
                Incidencias abiertas
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $resultado["abiertas"] ?></h5>
                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar text-bg-sucess" style="width: <?= $resultado["pAbiertas"] ?>%"><?= $resultado["pAbiertas"] ?>%</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-5 mt-4">
        <div class="card shadow-sm text-center">
            <div class="card-header fs-4 fw-bold">
                Incidencias en proceso
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $resultado["enProceso"] ?></h5>
                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar text-bg-warning" style="width: <?= $resultado["pEnProceso"] ?>%"><?= $resultado["pEnProceso"] ?>%</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-5 mt-4">
        <div class="card shadow-sm text-center">
            <div class="card-header fs-4 fw-bold">
                Incidencias cerradas
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $resultado["cerradas"] ?></h5>
                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar text-bg-success" style="width: <?= $resultado["pCerradas"] ?>%"><?= $resultado["pCerradas"] ?>%</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-5 mt-4">
        <div class="card shadow-sm text-center">
            <div class="card-header fs-4 fw-bold">
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
</div>