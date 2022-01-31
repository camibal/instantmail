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
         <title>Informe de devoluciones</title>
         <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.min.css" />
    </head>
    <body>
    <!-- Modal -->';

//HTML
$cadena .= '
          <div id="tablaEnvios" class="w-100">
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" class="text-center">
                    <img src="../../imagenes/logoInformes.png" class="img-fluid">
                  </th>
                  <th scope="col" colspan="3" class="text-center">
                    <h4>
                      <strong>
                        Informe devoluciones
                      </strong>
                    </h4>
                  </th>
                    <th scope="col" colspan="3" class="text-center">
                      <strong>
                        Fecha y hora impresion:<br>';

$cadena .= date('Y-m-d H:i:s');

$cadena .= '
                      </strong>
                    </th>
                  </tr>
                  <tr>
                    <th scope="col">No envio</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Mensajero</th>
                    <th scope="col">Destinatario</th>
                    <th scope="col">Valor</th>
                  </tr>
                </thead>
                <tbody id="contenidoEnvios">';

$tipo = $_GET['tipo'];
if ($tipo == 'informe_devoluciones') {
    if($_GET["fecha_inicial_devoluciones"] == '' || $_GET["fecha_final_devoluciones"] == ''){
      $where = '';
    } else {
      $fecha_inicial = $_GET['fecha_inicial_devoluciones'];
      $fecha_final = $_GET['fecha_final_devoluciones'];
      $where = " AND (fecha_envio >= '".$fecha_inicial."' AND fecha_envio <= '".$fecha_final."')";
    }
    //Instancia del informes
    $informes = new Informes();
    //Lista del menu Nivel 1
    $listaEnvios = $informes->getEnviosDevoluciones($where);
    //Se recorre array de nivel 1
    if (isset($listaEnvios)) {
        $contador = 0;
        $total_valor = 0;
        for ($i = 0; $i < sizeof($listaEnvios); $i++) {
            $cadena .= '<tr>';
            $cadena .= '<td>' . $listaEnvios[$i]["numero_envio"] . '</td>';            
            $cadena .= '<td>' . $listaEnvios[$i]["nombres_cliente"] . ' ' . $listaEnvios[$i]["apellidos_cliente"] . '</td>';
            $cadena .= '<td>' . $listaEnvios[$i]["nombre_estado_envio"] . '</td>';
            $cadena .= '<td>' . $listaEnvios[$i]["fecha_envio"] . '</td>';
            $cadena .= '<td>' . $listaEnvios[$i]["nombres_mensajero"] . ' ' . $listaEnvios[$i]["apellidos_mensajero"] . '</td>';
            $cadena .= '<td>' . $listaEnvios[$i]["destinatario_envio"] . '</td>';
            $cadena .= '<td>' . number_format($listaEnvios[$i]["valor_envio"],0,".",".") . '</td>';

            $total_valor = $total_valor + $listaEnvios[$i]["valor_envio"] ;

            $cadena .= '</tr>';
            $contador++;
        }
    } else {
        $cadena .= '<tr>';
        $cadena .= '<td colspan="10">No existen devoluciones</td>';
        $cadena .= '</tr>';
    }
}

$cadena .=  '<tr>
              <td scope="col" colspan="6">
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
$dompdf->stream("Informe de devoluciones");
