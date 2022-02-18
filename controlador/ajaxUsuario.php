<?php
// modelo
include dirname(__file__, 2) . '/modelo/usuario.php';

$usuario = new Usuario();
$tipo  = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : "";

if ($tipo == 'inserta') {
    if ($usuario->insertaUsuario($_REQUEST)) {
        echo $r = '1';
    } else {
        echo $r = '0';
    }
}

if ($tipo == 'consulta') {
    $resultado = $usuario->consultaUsuario($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($usuario->editaUsuario($_REQUEST)) {
        echo $r = '1';
    } else {
        echo $r = '0';
    }
}

if ($tipo == 'elimina_logico') {
    if ($usuario->eliminaLogicoUsuario($_GET)) {
        return '1';
    } else {
        return '0';
    }
}

if ($tipo == 'cerrar_sesion') {
    session_start();
    session_destroy();
    echo "si";
}
