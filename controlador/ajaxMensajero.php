<?php
include dirname(__file__, 2) . '/modelo/mensajero.php';

$mensajero = new Mensajero();
$tipo    = $_GET['tipo'];

if ($tipo == 'inserta') {
    if ($mensajero->insertaMensajero($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'consulta') {
    $resultado = $mensajero->consultaMensajero($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($mensajero->editaMensajero($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'elimina_logico') {
    if ($mensajero->eliminaLogicoMensajero($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}