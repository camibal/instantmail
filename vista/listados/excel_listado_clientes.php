<?php
header("Pragma: public");
header("Expires: 0");
$filename = "Listado de clientes.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

include dirname(__file__, 2) . '../../modelo/listados.php';
?>
    <div id="tablaClientes">
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th scope="col">Cliente</th>
                  <th scope="col">Documento</th>
                  <th scope="col">Email</th>
                  <th scope="col">Celular</th>
                  <th scope="col">Dirección</th>
                </tr>
                </thead>
                <tbody id="contenidoClientes">
                  <?php
                    $tipo = $_GET['tipo'];
                    if ($tipo == 'listado_clientes') {
                        //Instancia del listados
                        $listados = new listados();
                        //Lista del menu Nivel 1
                        $listaClientes = $listados->getClientes();
                        //Se recorre array de nivel 1
                        if (isset($listaClientes)) {
                            $contador = 0;
                            for ($i = 0; $i < sizeof($listaClientes); $i++) {
                                    echo '<tr>';
                                    echo '<td>' . $listaClientes[$i]["nombres_cliente"] . ' ' . $listaClientes[$i]["apellidos_cliente"] . '</td>';
                                    echo '<td>' . $listaClientes[$i]["documento_cliente"] . '</td>';
                                    echo '<td>' . $listaClientes[$i]["email_cliente"] . '</td>';
                                    echo '<td>' . $listaClientes[$i]["celular_cliente"] . '</td>';
                                    echo '<td>' . $listaClientes[$i]["direccion_cliente"] . '</td>';
                                    echo '</tr>';

                                $contador++;
                            }
                        } else {
                            echo '<tr>';
                            echo '<td colspan="6">No existen clientes</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
              </table>
            </div>