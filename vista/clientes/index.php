<?php
include "../../controlador/cliente_controller.php";
session_start();
$idUsuario       = $_SESSION['id_usuario'];
$clienteController = new clienteController();
$permisos        = $clienteController->Permisos($idUsuario, 2);
?>
<div class="row">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
              </ol>
        </nav>
    </div>
    <div class="col-md-6 text-right">
        <?php 
            if ($permisos[0]["crear"] == 1) {
        ?>
        <button class="btn btn-success" data-target="#modalCliente" data-toggle="modal" id="btn_crear_cliente" type="button">
            Crear cliente
        </button>
        <?php }?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table display" id="tablaClientes" style="width:100%">
            <thead class="bg-gradient-info text-white">
                <tr>
                    <th>
                        Cliente
                    </th>
                    <th>
                        Tipo documento
                    </th>
                    <th>
                        Documento
                    </th>
                    <th>
                        Celular
                    </th>
                    <th>
                        Dirección
                    </th>
                    <th>
                        Email
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
                <?php $clienteController->getTablaClientes($permisos);?>
            </tbody>
        </table>
    </div>
</div>
<?php include "../copyright.php";?>
<?php include "scripts.php";?>
<?php include "modal_cliente.php";?>