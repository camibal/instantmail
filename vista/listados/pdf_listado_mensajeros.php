<?php
include dirname(__file__, 2) . '../../modelo/listados.php';
// Halamos las librerias de dompdf
require_once '../../librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
// Inicializamos dompdf
$dompdf = new Dompdf();
//HTML
$cadena = '
<!DOCTYPE html>
    <head>
         <title>Listado de mensajeros</title>
         <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.min.css" />
    </head>
    <body>
    <!-- Modal -->';

//HTML
$cadena .= '
          <div id="tablaMensajeros" class="w-100">
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
                        Listado de mensajeros
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
                    <th scope="col" class="text-center">Documento</th>
                    <th scope="col" class="text-center">Celular</th>
                  </tr>
                </thead>
                <tbody id="contenidoMensajeros">';

                $tipo = $_GET['tipo'];
                if ($tipo == 'listado_mensajeros') {
                    //Instancia de listados
                    $listados = new Listados();
                    //Lista del menu Nivel 1
                    $listaMensajeros = $listados->getMensajeros();
                    //Se recorre array de nivel 1
                    if (isset($listaMensajeros)) {
                        $contador = 0;
                        for ($i = 0; $i < sizeof($listaMensajeros); $i++) {
                          $cadena .= '<tr>';        
                          $cadena .= '<td class="text-center">' . $listaMensajeros[$i]["nombres_mensajero"] . ' ' . $listaMensajeros[$i]["apellidos_mensajero"] . '</td>';
                          $cadena .= '<td class="text-center">' . $listaMensajeros[$i]["documento_mensajero"] . '</td>';
                          $cadena .= '<td class="text-center">' . $listaMensajeros[$i]["celular_mensajero"] . '</td>';
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
$dompdf->stream("Listado de mensajeros");