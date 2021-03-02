<?php

//require_once("../../partials/check_login.php");
require("../../partials/routes.php");;

use App\Controllers\CursoController;
use App\Controllers\MatriculaController;
use App\Models\GeneralFunctions;
use Carbon\Carbon;

$nameModel = "Asistencia";
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION['frm'.$pluralModel] ?? NULL;

?>

<!DOCTYPE html>
<html>
<head>
    <title> Consulta <?= $nameModel?> | <?= $_ENV['TITLE_SITE'] ?></title>
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
                        <h1>Consultar <?= $nameModel ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item"><a href="index.php"><?= $pluralModel ?></a></li>
                            <li class="breadcrumb-item active">Consultar</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Generar Mensaje de alerta -->
            <?= (!empty($_GET['respuesta'])) ? GeneralFunctions::getAlertDialog($_GET['respuesta'], $_GET['mensaje']) : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Información de la Asistencia</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                            data-source="consulta.php" data-source-selector="#card-refresh-content"
                                            data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" id="frmConsulta<?= $nameModel ?>"
                                          name="frmConsulta<?= $nameModel ?>"
                                          action="../../../app/Controllers/MainController.php?controller=<?= $nameModel ?>&action=consulta">


                                        <div class="form-group row">
                                            <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                                            <div class="col-sm-3">
                                                <input required type="date" class="form-control datetimepicker-input"  id="fecha"
                                                       name="fecha" placeholder="Ingrese la fecha" value="<?= $frmSession['fecha'] ?? '' ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="cursos_id" class="col-sm-2 col-form-label">Curso</label>
                                            <div class="col-sm-10">
                                                <?= CursoController::selectCurso(
                                                    array(
                                                        'id' => 'cursos_id',
                                                        'name' => 'cursos_id',
                                                        'defaultValue' => (!empty($frmSession['cursos_id'])) ? $frmSession['cursos_id'] : '',
                                                        'class' => 'form-control select2bs4 select2-info',
                                                        'where' => "estado = 'Activo'"
                                                    )
                                                );
                                                ?>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="matriculas_id" class="col-sm-2 col-form-label">Estudiante</label>
                                            <div class="col-sm-10">

                                                <?= MatriculaController::selectMatricula(array (
                                                    'id' => 'matriculas_id',
                                                    'name' => 'matriculas_id',
                                                    'defaultValue' => (!empty($frmSession['matriculas_id'])) ? $frmSession['matriculas_id'] : '',
                                                    'class' => 'form-control select2bs4 select2-info',
                                                    'where' => "estado = 'Activo'"))

                                                ?>
                                            </div>
                                        </div>




                                    <hr>
                                    <button type="submit" class="btn btn-info">Enviar</button>
                                    <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                    <!-- /.card-footer -->
                                </form>
                            </div>
                            <!-- /.card-body -->

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
