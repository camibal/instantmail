<?php include "../../controlador/calificacion_controller.php";?>
<?php
session_start();
$idUsuario = $_SESSION['id_usuario'];
$calificacionController  = new calificacionController();
$permisos  = $calificacionController->Permisos($idUsuario, 8);
?>
<div class="row">
    <div class="col-md-6 text-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Calificaciones</li>
              </ol>
        </nav>
    </div>
    <div class="col-md-6 text-right">
    </div>
</div>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table display" id="tablaCalificacion" style="width:100%">
            <thead class="bg-gradient-info text-white">
                <tr>
                    <th>
                        No envio
                    </th>
                    <th>
                        Estado
                    </th>
                    <th>
                        Mensajero
                    </th>
                    <th>
                        Fecha
                    </th>
                    <?php if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
    ?>
                    <th>
                        Opciones
                    </th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php $calificacionController->getTablaCalificacion($permisos, $idUsuario);?>
            </tbody>
        </table>
    </div>
</div>
<?php include "scripts.php";?>
<?php include "modal_calificacion.php";?>