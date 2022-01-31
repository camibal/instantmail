<?php
include "../../controlador/mensajero_controller.php";
session_start();
$idUsuario       = $_SESSION['id_usuario'];
$mensajeroController = new mensajeroController();
$permisos        = $mensajeroController->Permisos($idUsuario, 2);
?>
<div class="row">
    <div class="col-md-6 text-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mensajero</li>
              </ol>
        </nav>
    </div>
    <div class="col-md-6 text-right">
        <?php 
            if ($permisos[0]["crear"] == 1) {
        ?>
            <button class="btn btn-success" data-target="#modalMensajero" data-toggle="modal" id="btn_crear_mensajero" type="button">
                Crear mensajero
            </button>
        <?php }?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table display" id="tablaMensajeros" style="width:100%">
            <thead class="bg-gradient-info text-white">
                <tr>
                    <th>
                        Mensajero
                    </th>
                    <th>
                        Tipo documento
                    </th>
                    <th>
                        No documento
                    </th>
                    <th>
                        Celular
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
                <?php $mensajeroController->getTablaMensajeros($permisos);?>
            </tbody>
        </table>
    </div>
</div>
<?php include "../copyright.php";?>
<?php include "scripts.php";?>
<?php include "modal_mensajero.php";?>