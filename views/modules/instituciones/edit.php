<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require_once("../../../app/Controllers/InstitucionController.php");
require_once("../../../app/Controllers/UsuarioController.php");


use App\Controllers\InstitucionController;
use App\Controllers\DepartamentosController;
use App\Controllers\MunicipiosController;
use App\Controllers\UsuarioController;
use App\Models\GeneralFunctions;
use App\Models\Institucion;
use Carbon\Carbon;

$nameModel = "Institucion";
$pluralModel = $nameModel.'es';
$frmSession = $_SESSION['frm'.$pluralModel] ?? NULL;

?>

<!DOCTYPE html>
<html>
<head>
    <title> Editar <?= $nameModel?> | <?= $_ENV['TITLE_SITE'] ?></title>
    <?php require("../../partials/head_imports.php"); ?>
    <!-- DataTables -->
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
                        <h1>Editar Institucion</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item"><a href="index.php"><?= $pluralModel ?></a></li>
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Generar Mensajes de alerta -->
            <?= (!empty($_GET['respuesta'])) ? GeneralFunctions::getAlertDialog($_GET['respuesta'], $_GET['mensaje']) : ""; ?>
            <?= (empty($_GET['id'])) ? GeneralFunctions::getAlertDialog('error', 'Faltan Criterios de Búsqueda') : ""; ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Información de <?= $nameModel ?></h3>
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
                                $DataInstitucion = InstitucionController::searchForID(["id" => $_GET["id"]]);
                                /* @var $DataUsuario Institucion */
                                if (!empty($DataInstitucion)) {
                                    ?>

                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <!-- form start -->
                                        <form class="form-horizontal"  enctype="multipart/form-data" method="post" id="frmEdit<?= $nameModel ?>"
                                              name="frmEdit<?= $nameModel ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $nameModel ?>&action=edit">

                                            <input id="id" name="id" value="<?php echo $DataInstitucion->getId(); ?>" hidden
                                                   required="required" type="text">

                                            <div class="form-group row">
                                                <label for="nombre" class="col-sm-2 col-form-label">Nombres</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="nombre"
                                                           name="nombre" value="<?= $DataInstitucion->getNombre(); ?>"
                                                           placeholder="Ingrese sus nombres">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nit" class="col-sm-2 col-form-label">Nit</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="nit"
                                                           name="nit" value="<?= $DataInstitucion->getNit(); ?>"
                                                           placeholder="Ingrese su NIT">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="direccion"
                                                           name="direccion" value="<?= $DataInstitucion->getDireccion(); ?>"
                                                           placeholder="Ingrese su direccion">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="municipios_id" class="col-sm-2 col-form-label">Municipios</label>
                                                <div class="col-sm-5">
                                                    <?= DepartamentosController::selectDepartamentos(
                                                        array(
                                                            'id' => 'departamento_id',
                                                            'name' => 'departamento_id',
                                                            'defaultValue' => (!empty($DataInstitucion)) ? $DataInstitucion->getMunicipio()->getDepartamento()->getId() : '15',
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "estado = 'Activo'"
                                                        )
                                                    )
                                                    ?>
                                                </div>
                                                <div class="col-sm-5 ">
                                                    <?= MunicipiosController::selectMunicipios(
                                                        array (
                                                            'id' => 'municipios_id',
                                                            'name' => 'municipios_id',
                                                            'defaultValue' => (!empty($DataInstitucion)) ? $DataInstitucion->getMunicipiosId(): '',
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "departamento_id = ".$DataInstitucion->getMunicipio()->getDepartamento()->getId()." and estado = 'Activo'")
                                                    )
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="rector_id" class="col-sm-2 col-form-label">Rector</label>
                                                <div class="col-sm-10">

                                                    <?= UsuarioController::selectUsuario(
                                                        array (
                                                            'id' => 'rector_id',
                                                            'name' =>'rector_id',
                                                            'defaultValue' => (!empty($DataInstitucion)) ? $DataInstitucion->getRectorId(): '',
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "rol = 'Administrador' and estado = 'Activo'")
                                                    )
                                                    ?>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" minlength="6" class="form-control"
                                                           id="telefono" name="telefono"  value="<?= $DataInstitucion->getTelefono(); ?>"
                                                           placeholder="Ingrese su telefono">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="correo" class="col-sm-2 col-form-label">Correo Electrónico</label>
                                                <div class="col-sm-10">
                                                    <input required type="email" class="form-control" id="correo"
                                                           name="correo"  value="<?= $DataInstitucion->getCorreo(); ?>"
                                                           placeholder="Ingrese su correo electrónico">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                                                <div class="col-sm-10">
                                                    <select id="estado" name="estado" class="custom-select">
                                                        <option <?= ($DataInstitucion->getEstado() == "Activo")? "selected" : ""; ?> value="Activo">Activo</option>
                                                        <option <?= ($DataInstitucion->getEstado() == "Inactivo")? "selected" : ""; ?> value="Inactivo">Inactivo</option>

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