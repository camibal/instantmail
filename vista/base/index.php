<?php
include "../../controlador/base_controller.php";
session_start();
$idUsuario       = $_SESSION['id_usuario'];
$baseController = new baseController();
$permisos        = $baseController->Permisos($idUsuario, 12);
?>
<div class="row">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Base</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 text-right">
        <?php 
            if ($permisos[0]["crear"] == 1) {
        ?>
        <button class="btn btn-success" data-target="#modalBase" data-toggle="modal" id="btn_crear_base" type="button">
            Crear base
        </button>
        <?php }?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table display" id="tablaBase" style="width:100%">
            <thead class="bg-gradient-info text-white">
                <tr>
                    <th>
                        Fecha
                    </th>
                    <th>
                        Tipo movimiento
                    </th>
                    <th>
                        Valor
                    </th>
                    <th>
                        Observaciones
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
                <?php $baseController->getTablaBase($permisos);?>
            </tbody>
        </table>
    </div>
</div>
<?php include "../copyright.php";?>
<?php include "scripts.php";?>
<?php include "modal_base.php";?>