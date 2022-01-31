<?php
include dirname(__file__, 2) . '/modelo/cliente.php';

$cliente = new Cliente();
$tipo    = $_GET['tipo'];

if ($tipo == 'inserta') {
    if ($cliente->insertaCliente($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'consulta') {
    $resultado = $cliente->consultaCliente($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($cliente->editaCliente($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'elimina_logico') {
    if ($cliente->eliminaLogicoCliente($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}
?>