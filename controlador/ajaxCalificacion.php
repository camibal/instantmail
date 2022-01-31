<?php
include dirname(__file__, 2) . '/modelo/calificacion.php';

$calificacion = new Calificacion();
$tipo    = $_GET['tipo'];

if ($tipo == 'inserta') {
    if ($calificacion->insertaCalificacion($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'consulta') {
    $resultado = $calificacion->consultaCalificacion($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($calificacion->editaCalificacion($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'elimina_logico') {
    if ($calificacion->eliminaLogicoCalificacion($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}