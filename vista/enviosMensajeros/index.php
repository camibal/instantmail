<?php include "../../controlador/envios_controller.php";?>
<?php
session_start();
$idUsuario = $_SESSION['id_usuario'];
$enviosController  = new enviosController();
$permisos  = $enviosController->Permisos($idUsuario, 9);
?>
<div class="row">
    <div class="col-md-6 text-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
              </ol>
        </nav>
    </div>
    <div class="col-md-6 text-right">
    </div>
</div>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table display" id="tablaEnvios" style="width:100%">
            <thead class="bg-gradient-info text-white">
                <tr>
                    <th>
                        Número
                    </th>
                    <th>
                        Fecha creación
                    </th>
                    <th>
                        Estado
                    </th>
                    <th>
                        Cliente
                    </th>
                    <th>
                        Destinatario
                    </th>
                    <th>
                        Valor
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
                <?php $enviosController->getTablaEnviosMensajero($permisos, $idUsuario);?>
            </tbody>
        </table>
    </div>
</div>
<?php include "../copyright.php";?>
<?php include "modal_envio.php";?>
<?php include "modal_envio_detalle.php";?>
<?php include "scripts.php";?>