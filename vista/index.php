<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$id_usuario    = isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : "";

$idUsuario    = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : "";
if($id_usuario == ""){
    if($idUsuario == ""){
        header("Location: login/index.php");
        exit;
    }
} else {
    $_SESSION["id_usuario"] = $id_usuario;
}

include 'head.php';

include '../controlador/login_controller.php';
$loginController = new loginController();
$datosUsuario = $loginController->UsuarioLogin($idUsuario);
?>
    <body id="page-top">
        <!-- Page Wrapper -->
        <section id="hamburguesa">
            <nav class="bg-gradient-info">
                <!-- Sidebar Toggle (Topbar) -->
                <button class="btn btn-link d-md-none rounded-circle mr-3 text-white" id="sidebarToggleTop">
                    <i class="fa fa-bars">
                    </i>
                </button>
                <!-- Topbar Search -->
            </nav>
        </section>
        <section id="menu">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion toggled" id="accordionSidebar">
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                    <!-- Nav Item - Dashboard -->
                            <li class="nav-item dropdown no-arrow" style="cursor: pointer">
                                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="userDropdown" role="button">
                                    <?php if($datosUsuario[0]["foto_usuario"] != "") {?>
                                        <img class="img-profile rounded-circle" src="<?php echo '../subidas/'. $datosUsuario[0]["foto_usuario"] ?>" />
                                    <?php } else {?>
                                        <img class="img-profile rounded-circle" src="<?php echo '../subidas/default.jpg' ?>" />
                                    <?php } ?>
                                </a>
                                    <h6 class="text-center text-white"><?php echo $datosUsuario[0]["nombres_usuario"]."\n"; ?></h6>
                                    <h6 class="text-center text-white"><?php echo $datosUsuario[0]["apellidos_usuario"]."\n"; ?></h6>
                                <!-- Dropdown - User Information -->
                                <div aria-labelledby="userDropdown" class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                    <a class="dropdown-item" data-target="#logoutModal" data-toggle="modal" href="#">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400">
                                        </i>
                                        Cerrar sesión
                                    </a>
                                </div>
                            </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                        <?php
                        
                            $vermodulo = $loginController->VerModulo($idUsuario);
                            foreach ($vermodulo as $key => $value) {
                        ?>
                            <!-- Nav Item - Charts -->
                            <li class="nav-item">
                                <a class="nav-link" id="menu_<?php if($vermodulo[$key]['nombre_modulo'] == 'Mis envios'){ echo 'enviosClientes'; } else { echo $vermodulo[$key]['nombre_modulo']; } ?>" style="cursor: pointer">
                                    <i class="<?php echo $vermodulo[$key]['nombre_icono'];?>"></i>
                                    <span>
                                        <?php echo $vermodulo[$key]['nombre_modulo'];?>
                                    </span>
                                </a>
                            </li>
                        <?php }?>
                    </hr>
                </hr>
            </ul>
            <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div class="d-flex flex-column" id="content-wrapper">
                <!-- Main Content -->
                <div id="content">
                    <div id="tabla" class="panel-default" style="margin: 20px;">
                        <div class="container-fluid text-center mt-5">
                            <img src="../imagenes/logo.png" class="img-fluid mt-5 mb-2" alt="..." width="30%">
                            <h5>
                                Dirección: Calle 16 #20 06
                            </h5>
                            <h5>
                                www.instantmailmensajeria.com
                            </h5>
                            <h5>
                                3143006024 - 3143006012 - 3043024689
                            </h5>
                        <div id="tabla" class="panel-default" style="margin: 20px;">
                    <!-- /.container-fluid -->
                </div>

                <!-- End of Main Content -->
                <!-- Footer -->

                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        </section>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up">
            </i>
        </a>
        <!-- Logout Modal-->
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="logoutModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">
                                ×
                            </span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h4><b>¿Realmente desea cerrar la sesión?</b></h4>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success col-md-3" name="btn_cerrar_sesion" id="btn_cerrar_sesion">
                            Si
                        </button>
                        <button class="btn btn-danger col-md-3" data-dismiss="modal" type="button">
                            No
                        </button>
                    </div>
                </div>
            </div>
        </div>
  <?php include 'footer.php';?>