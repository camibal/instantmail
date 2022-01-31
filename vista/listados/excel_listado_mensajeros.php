<?php
header("Pragma: public");
header("Expires: 0");
$filename = "Listado de mensajeros.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

include dirname(__file__, 2) . '../../modelo/listados.php';
?>
    <div id="tablaMensajeros">
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th scope="col">Mensajero</th>
                  <th scope="col">Documento</th>
                  <th scope="col">Celular</th>
                </tr>
                </thead>
                <tbody id="contenidoMensajeros">
                  <?php
                    $tipo = $_GET['tipo'];
                    if ($tipo == 'listado_mensajeros') {
                        //Instancia del listados
                        $listados = new listados();
                        //Lista del menu Nivel 1
                        $listaMensajeros = $listados->getMensajeros();
                        //Se recorre array de nivel 1
                        if (isset($listaMensajeros)) {
                            $contador = 0;
                            for ($i = 0; $i < sizeof($listaMensajeros); $i++) {
                                    echo '<tr>';
                                    echo '<td>' . $listaMensajeros[$i]["nombres_mensajero"] . ' ' . $listaMensajeros[$i]["apellidos_mensajero"] . '</td>';
                                    echo '<td>' . $listaMensajeros[$i]["documento_mensajero"] . '</td>';
                                    echo '<td>' . $listaMensajeros[$i]["celular_mensajero"] . '</td>';
                                    echo '</tr>';

                                $contador++;
                            }
                        } else {
                            echo '<tr>';
                            echo '<td colspan="6">No existen mensajeros</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
              </table>
            </div>