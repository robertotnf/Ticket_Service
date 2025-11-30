<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header text-center fw-bold fs-4">
                    BIENVENIDO
                </div>
                <div class="card-body">
                    <form id="frm" action="controlador/controlador.php" method="post">
                        <div class="mb-3">
                            <input type="email" id="email" placeholder="Email" name="email" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="password" id="password" placeholder="Contraseña" name="password" required class="form-control">
                        </div>
                        <?php if ($navegacion == "registrar") { ?>
                            <div class="mb-3">
                                <input type="password" id="password2" placeholder="Confirmar contraseña" name="password2" required class="form-control">
                            </div>
                            <div class="mb-3 form-check ">
                                <label for="check" class="form-check-label">Tecnico</label>
                                <input type="checkbox" id="check" name="check" class="form-check-input">
                            </div>
                            <div class="mb-3">
                                <select name="departamento" class="form-select">
                                    <?php foreach ($db->listarDepartamentos() as $d) { ?>
                                        <option value="<?= $d['cod'] ?>"><?= $d['nom_dep'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary w-100"><?= $navegacion != "registrar" ? "Entrar" : "Registrar" ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($navegacion == "registrar") { ?>
    <script>
        document.getElementById('frm').addEventListener('submit', function(e) {
            e.preventDefault();
            validarPasswords();
        })
    </script>
<?php } ?>