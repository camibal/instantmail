<?php
header("Pragma: public");
header("Expires: 0");
$filename = "Informe de caja.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

include dirname(__file__, 2) . '../../modelo/informes.php';
?>
		<div id="tablaCaja">
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th scope="col">Fecha</th>
                  <th scope="col">Tipo movimiento</th>
                  <th scope="col">Observaciones</th>
                  <th scope="col">Valor</th>
                </tr>
                </thead>
                <tbody id="contenidoCaja">
                	<?php
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
                        $listaEnvios = $informes->getCaja($where);
                        //Se recorre array de nivel 1
                        if (isset($listaEnvios)) {
                            $contador = 0;
                            $total_valor = 0;
                            for ($i = 0; $i < sizeof($listaEnvios); $i++) {
                              echo '<tr>';
                              echo '<td>' . $listaEnvios[$i]["fecha_movimiento"] . '</td>';
                              echo '<td>' . $listaEnvios[$i]["nombre_tipo_movimiento"] . '</td>';
                              echo '<td>' . $listaEnvios[$i]["observaciones_movimiento"] . '</td>';
                              echo '<td>' . number_format($listaEnvios[$i]["valor_movimiento"],0,'.','.') . '</td>';
                              echo '</tr>';

                              if($listaEnvios[$i]["fkID_tipo_movimiento"] == 2){
                                $total_valor = $total_valor - $listaEnvios[$i]["valor_movimiento"] ;
                              } else {
                                $total_valor = $total_valor + $listaEnvios[$i]["valor_movimiento"] ;
                              }
                              
                              $contador++;
                            }
                        } else {
                            echo '<tr>';
                            echo '<td colspan="10">No existen envios</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                  <tr>
                    <td scope="col" colspan="3"><p class="text-right"><b>Saldo en caja</b></p></td>
                    <td class="text-right">
                      <span><b><?php echo number_format($total_valor,0,'.','.'); ?></b></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>