<?php
require_once("../../partials/routes.php");
require_once("../../../app/Controllers/NovedadController.php");

use App\Controllers\NovedadController;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE'] ?> | Gestionar Novedades</title>
    <?php include_once ('../../partials/head_imports.php') ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php include_once ('../../partials/navbar_customization.php') ?>

    <?php include_once ('../../partials/sliderbar_main_menu.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestionar Novedades</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestionar Novedades</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <?php if (!empty($_GET['respuesta']) && !empty($_GET['accion'])) { ?>
                <?php if ($_GET['respuesta'] == "correcto") { ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                        <?php if ($_GET['accion'] == "create") { ?>
                            La novedad se ha sido registrado con exito!
                        <?php } else if ($_GET['accion'] == "update") { ?>
                            Los datos de la novedad han sido actualizados correctamente!
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Default box -->
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Gestionar Novedades</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                data-source="index.php" data-source-selector="#card-refresh-content"
                                data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto mr-auto"></div>
                        <div class="col-auto">
                            <a role="button" href="create.php" class="btn btn-primary float-right"
                               style="margin-right: 5px;">
                                <i class="fas fa-plus"></i> Crear Novedad
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table id="tblNovedades" class="datatable table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Justificación</th>
                                    <th>Observación</th>
                                    <th>Administrador ID</th>
                                    <th>Asistencia ID</th>
                                    <th>Estado</th>
                                    <th>Creación</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $arrNovedades = NovedadController::getAll();
                                /* @var $arrNovedades \App\Models\Novedad[] */
                                foreach ($arrNovedades as $novedad) {
                                    ?>
                                    <tr>
                                        <td><?php echo $novedad->getId(); ?></td>
                                        <td><?php echo $novedad->getTipo(); ?></td>
                                        <td><?php echo $novedad->getJustificacion(); ?></td>
                                        <td><?php echo $novedad->getObservacion(); ?></td>
                                        <td><?php echo $novedad->getEstado(); ?></td>
                                        <td><?php echo $novedad->getAdministradorId(); ?></td>
                                        <td><?php echo $novedad->getAsistenciasId(); ?></td>
                                        <td><?php echo $novedad->getCreatedAt(); ?></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $novedad->getId(); ?>"
                                               type="button" data-toggle="tooltip" title="Actualizar"
                                               class="btn docs-tooltip btn-primary btn-xs"><i
                                                        class="fa fa-edit"></i></a>
                                            <a href="show.php?id=<?php echo $novedad->getId(); ?>"
                                               type="button" data-toggle="tooltip" title="Ver"
                                               class="btn docs-tooltip btn-warning btn-xs"><i
                                                        class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Justificación</th>
                                    <th>Observación</th>
                                    <th>Administrador ID</th>
                                    <th>Asistencia ID</th>
                                    <th>Estado</th>
                                    <th>Creación</th>
                                    <th>Acciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Pie de Página.
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include_once ('../../partials/footer.php') ?>
</div>
<!-- ./wrapper -->

<?php include_once ('../../partials/scripts.php') ?>
<!-- DataTables -->
<script src="<?= $adminlteURL ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/dataTables.buttons.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.bootstrap4.js"></script>
<script src="<?= $adminlteURL ?>/plugins/jszip/jszip.js"></script>
<script src="<?= $adminlteURL ?>/plugins/pdfmake/pdfmake.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.html5.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.print.js"></script>
<script src="<?= $adminlteURL ?>/plugins/datatables-buttons/js/buttons.colVis.js"></script>

<script>
    $(function () {
        $('.datatable').DataTable({
            "dom": 'Bfrtip',
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "language": {
                "url": "../../public/Spanish.json" //Idioma
            },
            "buttons": [
                'copy', 'print', 'excel', 'pdf'
            ],
            "pagingType": "full_numbers",
            "responsive": true,
            "stateSave": true, //Guardar la configuracion del usuario
        });
    });
</script>
</body>
</html>