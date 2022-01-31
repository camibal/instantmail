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
         <title>Listado de clientes</title>
         <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.min.css" />
    </head>
    <body>
    <!-- Modal -->';

//HTML
$cadena .= '
          <div id="tablaClientes" class="w-100">
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
                        Listado de clientes
                      </strong>
                    </h4>
                  </th>
                    <th scope="col" colspan="2" class="text-center">
                      <strong>
                        Fecha y hora impresion:<br>';

$cadena .= date('Y-m-d H:i:s');

$cadena .= '
                      </strong>
                    </th>
                  </tr>
                  <tr>
                    <th scope="col" class="text-center">Cliente</th>
                    <th scope="col" class="text-center">Documento</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Celular</th>
                    <th scope="col" class="text-center">Dirección</th>
                  </tr>
                </thead>
                <tbody id="contenidoClientes">';

                $tipo = $_GET['tipo'];
                if ($tipo == 'listado_clientes') {
                    //Instancia de listados
                    $listados = new Listados();
                    //Lista del menu Nivel 1
                    $listaClientes = $listados->getClientes();
                    //Se recorre array de nivel 1
                    if (isset($listaClientes)) {
                        $contador = 0;
                        for ($i = 0; $i < sizeof($listaClientes); $i++) {
                          $cadena .= '<tr>';        
                          $cadena .= '<td class="text-center">' . $listaClientes[$i]["nombres_cliente"] . ' ' . $listaClientes[$i]["apellidos_cliente"] . '</td>';
                          $cadena .= '<td class="text-center">' . $listaClientes[$i]["documento_cliente"] . '</td>';
                          $cadena .= '<td class="text-center">' . $listaClientes[$i]["email_cliente"] . '</td>';
                          $cadena .= '<td class="text-center">' . $listaClientes[$i]["celular_cliente"] . '</td>';
                          $cadena .= '<td class="text-center">' . $listaClientes[$i]["direccion_cliente"] . '</td>';
                          $cadena .= '</tr>';
                          $contador++;
                        }
                    } else {
                        $cadena .= '<tr>';
                        $cadena .= '<td colspan="6">No existen calificaciones</td>';
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
$dompdf->stream("Listado de clientes");