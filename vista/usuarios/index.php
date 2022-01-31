<?php 
include "../../controlador/usuario_controller.php";
session_start();

$idUsuario       = $_SESSION['id_usuario'];
$usuarioController = new usuarioController();
$permisos        = $usuarioController->Permisos($idUsuario, 1);
?>
<div class="row">
    <div class="col-md-6 text-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
              </ol>
        </nav>
    </div>
    <div class="col-md-6 text-right">
        <?php 
            if ($permisos[0]["crear"] == 1) {
        ?>
            <button class="btn btn-success" data-target="#modalUsuario" data-toggle="modal" id="btn_crear_usuario" type="button">
                Crear usuario
            </button>
        <?php }?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-hover table-condensed table-bordered display" id="tablaUsuarios" style="width:100%">
            <thead class="bg-gradient-info text-white">
                <tr class="text-center">
                    <th>
                        Nombres
                    </th>
                    <th>
                        Apellidos
                    </th>
                    <th>
                        Nickname
                    </th>
                    <th>
                        Rol
                    </th>
                    <?php if ($permisos[0]["editar"] == 1) {
    ?>
                    <th>
                        Editar
                    </th>
                    <?php }?>
                    <?php if ($permisos[0]["eliminar"] == 1) {
    ?>
                    <th>
                        Eliminar
                    </th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php $usuarioController->getTablaUsuario($permisos);?>
            </tbody>
        </table>
    </div>
</div>
<?php include "../copyright.php";?>
<?php include "modal_usuario.php";?>
<?php include "scripts.php";?>