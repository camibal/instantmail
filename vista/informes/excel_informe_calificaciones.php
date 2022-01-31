<?php
header("Pragma: public");
header("Expires: 0");
$filename = "Informe de calificaciones.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

include dirname(__file__, 2) . '../../modelo/informes.php';
?>
    <div id="tablaCalificaciones">
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th scope="col">Mensajero</th>
                  <th scope="col">Total de envios</th>
                  <th scope="col">Promedio</th>
                </tr>
                </thead>
                <tbody id="contenidoCalificaciones">
                  <?php
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
                                    echo '<tr>';
                                    echo '<td>' . $listaCalificaciones[$i]["nombres_mensajero"] . ' ' . $listaCalificaciones[$i]["apellidos_mensajero"] . '</td>';
                                    echo '<td>' . $listaCalificaciones[$i]["cantidad"] . '</td>';
                                    echo '<td>' . $listaCalificaciones[$i]["promedio"] . '</td>';
                                    echo '</tr>';

                                $contador++;
                            }
                        } else {
                            echo '<tr>';
                            echo '<td colspan="10">No existen calificaciones</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
              </table>
            </div>