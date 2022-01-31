<?php
include dirname(__file__, 2) . '/modelo/caja.php';

$caja = new Caja();
$tipo    = $_GET['tipo'];

if ($tipo == 'inserta') {
    if ($caja->insertaCaja($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'consulta') {
    $resultado = $caja->consultaCaja($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($caja->editaCaja($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'elimina_logico') {
    if ($caja->eliminaLogicoCaja($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}
?>