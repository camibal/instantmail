<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Se incluye el header
include 'head.php';
//Se incluye el modelo
include '../../modelo/login.php';
//Se crea una nueva instancia
$login = new Login();
?>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <div class="form-group text-center">
      <?php if (isset($_GET['existe'])) {?>
        <div class="alert alert-danger">
          El usuario no existe o esta bloqueado.
        </div>
      <?php }?>
    </div>

    <div class="form-group text-center">
      <?php if (isset($_GET['pass'])) {;?>
        <div class="alert alert-danger">
          Clave digitada invalida.
        </div>
      <?php }?>
    </div>

    <div class="form-group text-center">
      <?php if (isset($_GET['sesion'])) {?>
        <div class="alert alert-danger">
          Inicie sesion.
        </div>
      <?php }?>
    </div>

    <div class="form-group text-center">
      <?php if (isset($_GET['logout'])) {?>
        <div class="alert alert-success">
          Logout exitoso.
        </div>
      <?php }?>
    </div>
    <!-- Icon -->
    <div class="fadeIn first">
      <img src="../../imagenes/logo.png" class="img-fluid" width="50%">
    </div>

    <!-- Login Form -->
    <form action="../../controlador/ajaxLogin.php" method="POST">
      <div class="form-group row text-center">
        <div class="col-md-3 col-1">
        </div>
        <div class="col-md-6 col-10">
          <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required>
        </div>
        <div class="col-md-3 col-1">
        </div>
      </div>
      <div class="form-group row text-center">
        <div class="col-md-3 col-1">
        </div>
        <div class="col-md-6 col-10">
          <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Contraseña" required>
        </div>
        <div class="col-md-3 col-1">
        </div>
      </div>
      <div class="form-group row text-center">
        <div class="col-md-3 col-1">
        </div>
        <div class="col-md-6 col-10">
          <button type="submit" class="btn btn-success w-100" value="Ingresar" id="ingresar" name="Ingresar">INICIAR</button>
        </div>
        <div class="col-md-3 col-1">
        </div>
      </div>
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="../usuarios/recupera.php">¿Olvido su contraseña?</a>
    </div>

  </div>
</div>
<?php
include '../footer.php';
?>