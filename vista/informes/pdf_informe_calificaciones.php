<?php
include dirname(__file__, 2) . '../../modelo/informes.php';
// Halamos las librerias de dompdf
require_once '../../librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
// Inicializamos dompdf
$dompdf = new Dompdf();
//HTML
$cadena = '
<!DOCTYPE html>
    <head>
         <title>Informe de calificaciones</title>
         <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.min.css" />
    </head>
    <body>
    <!-- Modal -->';

//HTML
$cadena .= '
          <div id="tablaCalificaciones" class="w-100">
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" class="text-center">
                    <img src="../../imagenes/logoInformes.png" class="img-fluid">
                  </th>
                  <th scope="col" class="text-center">
                    <h4>
                      <strong>
                        Informe calificaciones
                      </strong>
                    </h4>
                  </th>
                    <th scope="col" class="text-center">
                      <strong>
                        Fecha y hora impresion:<br>';

$cadena .= date('Y-m-d H:i:s');

$cadena .= '
                      </strong>
                    </th>
                  </tr>
                  <tr>
                    <th scope="col" class="text-center">Mensajero</th>
                    <th scope="col" class="text-center">Total de calificaciones</th>
                    <th scope="col" class="text-center">Promedio</th>
                  </tr>
                </thead>
                <tbody id="contenidoCalificaciones">';

$tipo = $_GET['tipo'];
if ($tipo == 'informe_calificaciones') {
    if($_GET["fecha_inicial_calificaciones"] == '' || $_GET["fecha_final_calificaciones"] == ''){
      $where = '';
    } else {
      $fecha_inicial = $_GET['fecha_inicial_calificaciones'];
      $fecha_final = $_GET['fecha_final_calificaciones'];
      $where = " AND (fecha_calificacion >= '".$fecha_inicial."' AND fecha_calificacion <= '".$fecha_final."')";
    }
    //Instancia del informes
    $informes = new Informes();
    //Lista del menu Nivel 1
    $listaCalificaciones = $informes->getCalificaciones($where);
    //Se recorre array de nivel 1
    if (isset($listaCalificaciones)) {
        $contador = 0;
        for ($i = 0; $i < sizeof($listaCalificaciones); $i++) {
            $cadena .= '<tr>';        
            $cadena .= '<td class="text-center">' . $listaCalificaciones[$i]["nombres_mensajero"] . ' ' . $listaCalificaciones[$i]["apellidos_mensajero"] . '</td>';
            $cadena .= '<td class="text-center">' . $listaCalificaciones[$i]["cantidad"] . '</td>';
            $cadena .= '<td class="text-center">' . $listaCalificaciones[$i]["promedio"] . '</td>';

            $cadena .= '</tr>';
            $contador++;
        }
    } else {
        $cadena .= '<tr>';
        $cadena .= '<td colspan="3">No existen calificaciones</td>';
        $cadena .= '</tr>';
    }
}

$cadena .=    '</tbody>
              </table>
              </div>
            </div>';
$cadena .= '
    </body>
</html>';

$dompdf->loadHtml($cadena);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream("Informe de calificaciones");