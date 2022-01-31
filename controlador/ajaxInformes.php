<?php
include dirname(__file__, 2) . '/modelo/informes.php';

$informes = new informes();
$tipo     = $_GET['tipo'];

if ($tipo == 'informe_envios') {
	if($_GET["fecha_inicial"] == '' || $_GET["fecha_final"] == ''){
		$where = '';
	} else {
		$fecha_inicial = $_GET['fecha_inicial'];
		$fecha_final = $_GET['fecha_final'];
		$where = " AND (fecha_envio >= '".$fecha_inicial."' AND fecha_envio <= '".$fecha_final."')";
	}

    $resultado = $informes->getEnvios($where);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'informe_devoluciones') {
	
	if($_GET["fecha_inicial"] == '' || $_GET["fecha_final"] == ''){
		$where = '';
	} else {
		$fecha_inicial = $_GET['fecha_inicial'];
		$fecha_final = $_GET['fecha_final'];
		$where = " AND (fecha_envio >= '".$fecha_inicial."' AND fecha_envio <= '".$fecha_final."')";
	}

    $resultado = $informes->getEnviosDevoluciones($where);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'informe_calificaciones') {
	
	if($_GET["fecha_inicial"] == '' || $_GET["fecha_final"] == ''){
		$where = '';
	} else {
		$fecha_inicial = $_GET['fecha_inicial'];
		$fecha_final = $_GET['fecha_final'];
		$where = " AND (fecha_calificacion >= '".$fecha_inicial."' AND fecha_calificacion <= '".$fecha_final."')";
	}

    $resultado = $informes->getCalificaciones($where);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'informe_caja') {
	
	if($_GET["fecha_inicial"] == '' || $_GET["fecha_final"] == ''){
		$where = '';
	} else {
		$fecha_inicial = $_GET['fecha_inicial'];
		$fecha_final = $_GET['fecha_final'];
		$where = " AND (fecha_movimiento >= '".$fecha_inicial."' AND fecha_movimiento <= '".$fecha_final."')";
	}

    $resultado = $informes->getCaja($where);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}