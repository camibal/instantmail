<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$email = $_GET["email"];
$idUser = $_GET["idUser"];
//Se ingluye el header
include '../head.php';
//Se incluye el modelo
include '../../modelo/usuario.php';
include "../../librerias/encrypt/mcript.php";

$desencriptarEmail = $desencriptar($email);

//Se crea una nueva instancia
$usuario = new Usuario();
?>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <div class="form-group text-center">
      <?php if (isset($_GET['enviado'])) { ?>
        <div class="alert alert-success">
          Verificado el correo electronico para la nueva clave.
        </div>
      <?php } ?>
    </div>

    <div class="form-group text-center">
      <?php if (isset($_GET['pass'])) {; ?>
        <div class="alert alert-danger">
          Clave digitada invalida.
        </div>
      <?php } ?>
    </div>

    <div class="form-group text-center">
      <?php if (isset($_GET['sesion'])) { ?>
        <div class="alert alert-danger">
          Inicie sesion.
        </div>
      <?php } ?>
    </div>

    <div class="form-group text-center">
      <?php if (isset($_GET['logout'])) { ?>
        <div class="alert alert-success">
          Logout exitoso.
        </div>
      <?php } ?>
    </div>

    <!-- Login Form -->
    <form id="forgetPss" method="POST">
      <div class="form-group row text-center">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <h1 class="text-white">Recuperación de Contraseña</h1>
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-2 col-1">
        </div>
        <div class="col-md-8 col-10">
          <p class="text-white">Por favor escriba su nueva contraseña</p>
        </div>
        <div class="col-md-2 col-1">
        </div>
      </div>
      <div class="form-group row text-center">
        <div class="col-md-3 col-1">
        </div>
        <div class="col-md-6 col-10">
          <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $desencriptarEmail; ?>" required>
          <input type="hidden" class="form-control" id="emailEncript" name="emailEncript" value="<?php echo $email; ?>" required>
          <input type="hidden" class="form-control" id="idUser" name="idUser" value="<?php echo $idUser; ?>" required>
          <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña Nueva" required>
        </div>
        <div class="col-md-3 col-1">
        </div>
      </div>
      <div class="form-group row text-center">
        <div class="col-md-3 col-1">
        </div>
        <div class="col-md-6 col-10">
          <input type="password" class="form-control" id="con_password" name="con_password" placeholder="Confirmar Contraseña" required>
        </div>
        <div class="col-md-3 col-1">
        </div>
      </div>
      <div class="form-group row text-center">
        <div class="col-md-3 col-1">
        </div>
        <div class="col-md-6 col-10">
          <button type="submit" class="btn btn-success w-100" name="actualizar">Enviar</button>
        </div>
        <div class="col-md-3 col-1">
        </div>
      </div>
    </form>
  </div>
</div>

<div class="reload d-none" id="reload" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; display: flex; justify-content: center; align-items: center;">
  <img src="../../imagenes/Logo.png" alt="">
</div>
<?php
//Se ingluye el header
include '../footer.php';
include "scripts.php";
?>