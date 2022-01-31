<?php
header("Pragma: public");
header("Expires: 0");
$filename = "Informe de envios.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

include dirname(__file__, 2) . '../../modelo/informes.php';
?>
		<div id="tablaEnvios">
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th scope="col">No envio</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Mensajero</th>
                  <th scope="col">Destinatario</th>
                  <th scope="col">Valor</th>
                </tr>
                </thead>
                <tbody id="contenidoEnvios">
                	<?php
                    $tipo = $_GET['tipo'];
                    if ($tipo == 'informe_envios') {
                        if($_GET["fecha_inicial_envios"] == '' || $_GET["fecha_final_envios"] == ''){
                          $where = '';
                        } else {
                          $fecha_inicial = $_GET['fecha_inicial_envios'];
                          $fecha_final = $_GET['fecha_final_envios'];
                          $where = " AND (fecha_envio >= '".$fecha_inicial."' AND fecha_envio <= '".$fecha_final."')";
                        }
                        //Instancia del informes
                        $informes = new Informes();
                        //Lista del menu Nivel 1
                        $listaEnvios = $informes->getEnvios($where);
                        //Se recorre array de nivel 1
                        if (isset($listaEnvios)) {
                            $contador = 0;
                            $total_valor = 0;
                            $total_abono = 0;
                            $total_saldo = 0;
                            for ($i = 0; $i < sizeof($listaEnvios); $i++) {
                                    echo '<tr>';
                                    echo '<td>' . $listaEnvios[$i]["numero_envio"] . '</td>';
                                    echo '<td>' . $listaEnvios[$i]["nombres_cliente"] . ' ' . $listaEnvios[$i]["apellidos_cliente"] . '</td>';
                                    echo '<td>' . $listaEnvios[$i]["nombre_estado_envio"] . '</td>';
                                    echo '<td>' . $listaEnvios[$i]["nombres_mensajero"] . ' ' . $listaEnvios[$i]["apellidos_mensajero"] . '</td>';
                                    echo '<td>' . $listaEnvios[$i]["destinatario_envio"] . '</td>';
                                    echo '<td>' . $listaEnvios[$i]["valor_envio"] . '</td>';
                                    echo '</tr>';

                                    $total_valor = $total_valor + $listaEnvios[$i]["valor_envio"] ;

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
                    <td scope="col" colspan="5"><p class="text-right"><b>Total</b></p></td>
                    <td class="text-right">
                      <span><b><?php echo number_format($total_valor,0,'.','.'); ?></b></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>