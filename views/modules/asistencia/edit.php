<?php
require("../../partials/routes.php");
require("../../../app/Controllers/AsistenciaController.php");

use App\Controllers\AsistenciaController;
use Carbon\Carbon;

?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE'] ?> | Editar Asistencia</title>
    <?php require("../../partials/head_imports.php"); ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("../../partials/navbar_customization.php"); ?>

    <?php require("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Asistencia</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/">Asistencia</a></li>
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <?php if (!empty($_GET['respuesta'])) { ?>
                <?php if ($_GET['respuesta'] != "correcto") { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Error al crear la asistencia: <?= $_GET['mensaje'] ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Información De La Asistencia</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                            data-source="create.php" data-source-selector="#card-refresh-content"
                                            data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <?php if (!empty($_GET["id"]) && isset($_GET["id"])) { ?>
                                <p>
                                <?php
                                $DataAsistencia = AsistenciaController::searchForID($_GET["id"]);
                                if (!empty($DataAsistencia)) {
                                    ?>

                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <!-- form start -->
                                        <form class="form-horizontal" method="post" id="frmEditAsistencia"
                                              name="frmEditAsistencia"
                                              action="../../../app/Controllers/AsistenciaController.php?action=edit">

                                            <input id="id" name="id" value="<?php echo $DataAsistencia->getId(); ?>" hidden
                                                   required="required" type="text">

                                            <div class="form-group row">
                                                <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                                                <div class="col-sm-10">
                                                    <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>" class="form-control" id="fecha"
                                                           name="fecha"  value="<?= $DataAsistencia->getFecha(); ?> "  placeholder="Ingrese la fecha">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hora_ingreso" class="col-sm-2 col-form-label">Hora De Ingreso</label>
                                                <div class="col-sm-10">
                                                    <input required type="time" class="form-control" id="hora_ingreso" name="hora_ingreso"
                                                           value="<?= $DataAsistencia->getHoraIngreso(); ?> placeholder="Ingrese la hora de ingreso">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="observacion" class="col-sm-2 col-form-label">Observación</label>
                                                <div class="col-sm-10">
                                                    <select id="observacion" name="observacion" class="custom-select">

                                                        <option <?= ($DataAsistencia->getObservacion() == "Ninguna") ? "selected" : ""; ?> value="Ninguna">Ninguna</option>
                                                        <option <?= ($DataAsistencia->getObservacion() == "Ejemplo1") ? "selected" : ""; ?> value="Ejemplo1">Ejemplo1</option>
                                                        <option <?= ($DataAsistencia->getObservacion() == "Ejemplo2") ? "selected" : ""; ?> value="Ejemplo2">Ejemplo2</option>
                                                        <option <?= ($DataAsistencia->getObservacion() == "Ejemplo3") ? "selected" : ""; ?> value="Ejemplo3">Ejemplo3</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="usuarios_id" class="col-sm-2 col-form-label">Tipo De Ingreso</label>
                                                <div class="col-sm-4">

                                                    <div class="form-group">
                                                        <select multiple class="form-control">
                                                            <option value="Institución">Institución</option>
                                                            <option <?= ($DataAsistencia->getTipoIngreso() == "Institución") ? "selected" : ""; ?> value="Institución">Institución</option>
                                                            <option value="Restaurante">Restaurante</option>
                                                            <option <?= ($DataAsistencia->getTipoIngreso() == "Restaurante") ? "selected" : ""; ?> value="Restaurante">Restaurante</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hora_salida" class="col-sm-2 col-form-label">Hora De Salida</label>
                                                <div class="col-sm-10">
                                                    <input required type="time" class="form-control" id="hora_salida" name="hora_salida"
                                                           value="<?= $DataAsistencia->getHoraSalida(); ?> placeholder="Ingrese la hora de salida">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="usuarios_id" class="col-sm-2 col-form-label">Documento Estudiante</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" minlength="6" class="form-control"
                                                           id="usuarios_id" name="usuarios_id"  value="<?= $DataAsistencia->getUsuariosId(); ?> placeholder="Ingrese su documento">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                                <div class="col-sm-10">
                                                    <select id="estado" name="estado" class="custom-select">
                                                        <option <?= ($DataAsistencia->getEstado() == "Activo") ? "selected" : ""; ?> value="Activo">Activo</option>
                                                        <option <?= ($DataAsistencia->getEstado() == "Inactivo") ? "selected" : ""; ?> value="Inactivo">Inactivo</option>

                                                    </select>
                                                </div>
                                            </div>


                                            <hr>
                                            <button type="submit" class="btn btn-info">Enviar</button>
                                            <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                            <!-- /.card-footer -->
                                        </form>
                                    </div>
                                    <!-- /.card-body -->
                                <?php } else { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        No se encontro ningun registro con estos parametros de
                                        busqueda <?= ($_GET['mensaje']) ?? "" ?>
                                    </div>
                                <?php } ?>
                                </p>
                            <?php } ?>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require('../../partials/footer.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('../../partials/scripts.php'); ?>
</body>
</html>