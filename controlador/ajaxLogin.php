<?php
include dirname(__file__, 2) . '/modelo/login.php';

$login = new Login();
$tipo     = $_GET['tipo'];

if ($tipo == 'logeo') {
    $resultado = $login->getLogin($_GET);
    if ($resultado) {
        session_start();
        $_SESSION["id_login"] = $resultado[0]["id_login"];
        header('location: ../vista/index.php');
        //echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

//Request: Ingresar
if (isset($_POST['Ingresar'])) {
    $login = new Login();
    if ($login->getUserByNickname($_POST['username'])) {
        if ($login->getPass($_POST['username'], $_POST['passwd'])) {
            $datosUsuario = $login->getUserByNickname($_POST['username']);
            session_start(); //Registra la sesion
            $_SESSION['id_usuario'] = $datosUsuario[0]["id_usuario"];
            header('location: ../vista/index.php');
        } else {
            header('location: ../vista/login/index.php?pass=false');
        }
    } else {
        header('location: ../vista/login/index.php?existe=false');
    }
}