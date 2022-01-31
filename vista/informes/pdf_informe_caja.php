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
	       <title>Informe de caja</title>
	       <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.min.css" />
    </head>
    <body>
    <!-- Modal -->';

//HTML
$cadena .= '
          <div id="tablaCaja" class="w-100">
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" class="text-center">
                    <img src="../../imagenes/logoInformes.png" class="img-fluid">
                  </th>
                  <th scope="col" colspan="2" class="text-center">
                    <h4>
                      <strong>
                        Informe caja
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
                    <th scope="col">Fecha</th>
                    <th scope="col">Tipo movimiento</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col" class="text-right">Valor</th>
                  </tr>
                </thead>
                <tbody id="contenidoCaja">';

$tipo = $_GET['tipo'];
if ($tipo == 'informe_caja') {
    if($_GET["fecha_inicial_caja"] == '' || $_GET["fecha_final_caja"] == ''){
      $where = '';
    } else {
      $fecha_inicial = $_GET['fecha_inicial_caja'];
      $fecha_final = $_GET['fecha_final_caja'];
      $where = " AND (fecha_movimiento >= '".$fecha_inicial."' AND fecha_movimiento <= '".$fecha_final."')";
    }
    //Instancia del informes
    $informes = new Informes();
    //Lista del menu Nivel 1
    $listaCaja = $informes->getCaja($where);
    //Se recorre array de nivel 1
    if (isset($listaCaja)) {
        $contador = 0;
        $total_valor = 0;
        for ($i = 0; $i < sizeof($listaCaja); $i++) {
            $cadena .= '<tr>';
            $cadena .= '<td>' . $listaCaja[$i]["fecha_movimiento"] . '</td>';            
            $cadena .= '<td>' . $listaCaja[$i]["nombre_tipo_movimiento"] . '</td>';
            $cadena .= '<td>' . $listaCaja[$i]["observaciones_movimiento"] . '</td>';
            $cadena .= '<td class="text-right">' . number_format($listaCaja[$i]["valor_movimiento"],0,".",".") . '</td>';

            if($listaCaja[$i]["fkID_tipo_movimiento"] == 2){
              $total_valor = $total_valor - $listaCaja[$i]["valor_movimiento"] ;
            } else {
              $total_valor = $total_valor + $listaCaja[$i]["valor_movimiento"] ;
            }

            $cadena .= '</tr>';
            $contador++;
        }
    } else {
        $cadena .= '<tr>';
        $cadena .= '<td colspan="10">No existen envios</td>';
        $cadena .= '</tr>';
    }
}

$cadena .=  '<tr>
              <td scope="col" colspan="3">
                <p class="text-right"><b>Total</b></p>
              </td>
              <td class="text-right">
                <span><b>'. number_format($total_valor,0,".",".") .'</b></span>
              </td>
            </tr>';

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
$dompdf->stream("Informe de caja");