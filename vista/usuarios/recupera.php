<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Se ingluye el header
include '../head.php';
//Se incluye el modelo
include '../../modelo/usuario.php';
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
    <form id="form_send_email" method="POST">
      <div class="form-group row text-center">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <h1 class="text-white">¿Olvido su contraseña?</h1>
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-2 col-1">
        </div>
        <div class="col-md-8 col-10">
          <p class="text-white">Por favor escriba su Email, en el recibirá los pasos para reestablecer la contraseña</p>
        </div>
        <div class="col-md-2 col-1">
        </div>
      </div>
      <div class="form-group row text-center">
        <div class="col-md-3 col-1">
        </div>
        <div class="col-md-6 col-10">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="col-md-3 col-1">
        </div>
      </div>
      <div class="form-group row text-center">
        <div class="col-md-3 col-1">
        </div>
        <div class="col-md-6 col-10">
          <button type="submit" class="btn btn-success w-100" value="Recuperar" id="enviar" name="Recuperar">Enviar</button>
          <button class="btn btn-success w-100 d-none" id="enviando" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Enviando...
          </button>
        </div>
        <div class="col-md-3 col-1">
        </div>
      </div>
    </form>
  </div>
</div>

<?php
//Se ingluye el header
include '../footer.php';
include "scripts.php";
?>