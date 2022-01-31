<?php
include dirname(__file__, 2) . '/modelo/envios.php';

$envio = new Envios();
$tipo    = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : "";

if ($tipo == 'inserta') {
    if ($envio->insertaEnvio($_GET)) {
        $fkID_envio = $envio->ultimoEnvio();
        if($envio->insertaHistorial($fkID_envio[0]["id_envio"],$_REQUEST)){
            return 'Se guardo';
        } else {
           return 'No se guardo'; 
        }
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'consulta') {
    $resultado = $envio->consultaEnvio($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($envio->editaEnvio($_REQUEST)) {
        if ($envio->insertaCalificacion($_REQUEST)) {
            if($envio->insertaHistorial($_REQUEST["id_envio"],$_REQUEST)){
                echo json_encode('Guardo historial'); //imprime el json
            } else {
                echo json_encode('Guardo calificacion'); //imprime el json
            }
        } else {
           echo json_encode('Guardo edicion');
        }
    } else {
        echo json_encode('No guardo edicion');;
    }
}

if ($tipo == 'elimina_logico') {
    if ($envio->eliminaLogicoEnvio($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'detalle') {
    $resultado = $envio->consultaDetalleEnvio($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}