<?php
include dirname(__file__, 2) . '/modelo/base.php';

$base = new Base();
$tipo    = $_GET['tipo'];

if ($tipo == 'inserta') {
    if($_GET['fkID_tipo_movimiento'] == 4){
        $resultado = $base->existeBase($_GET);
        if ($resultado[0]['cantidad'] > 0) {
            echo json_encode(true); //imprime el json
        } else {
            if ($base->insertaBase($_GET)) {
                echo json_encode("Se guardo"); //imprime el json
            } else {
                echo json_encode("No se guardo"); //imprime el json
            }
        }     
    } else {
        if ($base->insertaBase($_GET)) {
            echo json_encode("Se guardo"); //imprime el json
        } else {
            echo json_encode("No se guardo"); //imprime el json
        }       
    }
}

if ($tipo == 'consulta') {
    $resultado = $base->consultaBase($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($base->editaBase($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'elimina_logico') {
    if ($base->eliminaLogicoBase($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'existe') {

}
?>