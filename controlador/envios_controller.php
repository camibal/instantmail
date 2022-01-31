<?php
include dirname(__file__, 2) . '/modelo/envios.php';

class enviosController extends Envios
{

    public function __construct()
    {
        # code...
    }

    //Trae los permisos
    public function Permisos($id_usuario, $id_modulo){
        $envios     = new Envios();
        $resultado = $envios->getPermisos($id_usuario, $id_modulo);
        return $resultado;
    }

    //Tabla de envios
    public function getTablaEnvios($permisos)
    {
        //Instancia del envio
        $envio = new Envios();
        //Lista del menu Nivel 1
        $listaEnvios = $envio->getEnvios();
        //Se recorre array de nivel 1
        if ($permisos[0]["consultar"] == 1) {
            if (isset($listaEnvios)) {
                for ($i = 0; $i < sizeof($listaEnvios); $i++) {
                    echo '<tr>';
                    echo '<td>' . $listaEnvios[$i]["numero_envio"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["fecha_envio"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["nombre_estado_envio"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["nombres_cliente"]. ' ' .$listaEnvios[$i]["apellidos_cliente"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["direccion_envio"]. ' - ' .$listaEnvios[$i]["destinatario_envio"] . ' - (' .$listaEnvios[$i]["celular_envio"] . ')</td>';
                    echo '<td align="right">'.number_format($listaEnvios[$i]["valor_envio"],0,'.','.').'</td>';
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '<td>';
                    }
                    if ($permisos[0]["consultar"] == 1) {
                        echo '<button type="button" class="btn btn-info" data-target="#modalEnvioDetalle" data-toggle="modal" name="btn_detalles" data-id-envio="' . $listaEnvios[$i]["id_envio"] . '"><i class="fas fa-eye"></i></button>&nbsp;';
                    };
                    if ($permisos[0]["editar"] == 1) {
                        echo '<button type="button" class="btn btn-warning" data-target="#modalEnvio" data-toggle="modal" name="btn_editar" data-id-envio="' . $listaEnvios[$i]["id_envio"] . '"><i class="fas fa-pen-square"></i></i></button>&nbsp;';
                    };
                    if ($permisos[0]["eliminar"] == 1) {
                        echo '<button type="button" class="btn btn-danger" name="btn_eliminar" data-id-envio="' . $listaEnvios[$i]["id_envio"] . '" data-toggle="modal" data-target="#eliminarModal"><i class="fas fa-trash-alt"></i></button>';
                    }
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="9">No existen envios</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="9">No tienen permisos para consultar</td>';
            echo '</tr>';
        }
    }

    //Funcion para lista desplegable de estado del envio
    public function getSelectEstadoEnvio()
    {
        //Instancia del envio
        $envio = new Envios();
        //Lista del menu Nivel 1
        $listaEstadoEnvio = $envio->getEstadoEnvio();
        //Se recorre array de nivel 1
        if (isset($listaEstadoEnvio)) {
            echo '<option selected value="0" selected>Seleccione...</option>';
            for ($i = 0; $i < sizeof($listaEstadoEnvio); $i++) {
                //Valida si es el valor
                if ($valor == $listaEstadoEnvio[$i]["id_estado_envio"]) {
                    $seleccionado = "selected";
                } else {
                    $seleccionado = "";
                }
                echo '<option value="' . $listaEstadoEnvio[$i]["id_estado_envio"] . '" ' . $seleccionado . '>' . $listaEstadoEnvio[$i]["nombre_estado_envio"] . '</option>';
            }
        }
    }

    //Funcion para lista desplegable de cliente
    public function getSelectCliente()
    {
        //Instancia del envio
        $envio = new Envios();
        //Lista del menu Nivel 1
        $listaCliente = $envio->getClientes();
        //Se recorre array de nivel 1
        if (isset($listaCliente)) {
            echo '<option selected value="0">Seleccione...</option>';
            for ($i = 0; $i < sizeof($listaCliente); $i++) {
                //Valida si es el valor
                if ($valor == $listaCliente[$i]["id_cliente"]) {
                    $seleccionado = "selected";
                } else {
                    $seleccionado = "";
                }
                echo '<option value="' . $listaCliente[$i]["id_cliente"] . '" ' . $seleccionado . '>' . $listaCliente[$i]["nombres_cliente"] . ' '. $listaCliente[$i]["apellidos_cliente"]. '</option>';
            }
        }
    }

    //Funcion para lista desplegable de mensajero
    public function getSelectMensajero()
    {
        //Instancia del envio
        $envio = new Envios();
        //Lista del menu Nivel 1
        $listaMensajero = $envio->getMensajeros();
        //Se recorre array de nivel 1
        if (isset($listaMensajero)) {
            echo '<option selected value="0">Seleccione...</option>';
            for ($i = 0; $i < sizeof($listaMensajero); $i++) {
                //Valida si es el valor
                if ($valor == $listaMensajero[$i]["id_mensajero"]) {
                    $seleccionado = "selected";
                } else {
                    $seleccionado = "";
                }
                echo '<option value="' . $listaMensajero[$i]["id_mensajero"] . '" ' . $seleccionado . '>' . $listaMensajero[$i]["nombres_mensajero"] . ' '. $listaMensajero[$i]["apellidos_mensajero"]. '</option>';
            }
        }
    }

    //Tabla de envios de clients
    public function getTablaEnviosCliente($permisos, $id_usuario)
    {
        //Instancia del envio
        $envio = new Envios();
        //Lista del menu Nivel 1
        $listaEnvios = $envio->getEnviosCliente($id_usuario);
        //Se recorre array de nivel 1
        if ($permisos[0]["consultar"] == 1) {
            if (isset($listaEnvios)) {
                for ($i = 0; $i < sizeof($listaEnvios); $i++) {
                    echo '<tr>';
                    echo '<td>' . $listaEnvios[$i]["numero_envio"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["fecha_envio"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["nombre_estado_envio"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["nombres_cliente"]. ' ' .$listaEnvios[$i]["apellidos_cliente"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["direccion_envio"]. ' - ' .$listaEnvios[$i]["destinatario_envio"] . ' - (' .$listaEnvios[$i]["celular_envio"] . ')</td>';
                    echo '<td align="right">'.number_format($listaEnvios[$i]["valor_envio"],0,'.','.').'</td>';
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '<td>';
                    }
                    if ($permisos[0]["consultar"] == 1) {
                        echo '<button type="button" class="btn btn-info" data-target="#modalEnvioDetalle" data-toggle="modal" name="btn_detalles" data-id-envio="' . $listaEnvios[$i]["id_envio"] . '"><i class="fas fa-eye"></i></button>&nbsp;';
                    };
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="9">No existen envios</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="9">No tienen permisos para consultar</td>';
            echo '</tr>';
        }
    }

    //Tabla de envios de mensajeros
    public function getTablaEnviosMensajero($permisos, $id_usuario)
    {
        //Instancia del envio
        $envio = new Envios();
        //Lista del menu Nivel 1
        $listaEnvios = $envio->getEnviosMensajero($id_usuario);
        //Se recorre array de nivel 1
        if ($permisos[0]["consultar"] == 1) {
            if (isset($listaEnvios)) {
                for ($i = 0; $i < sizeof($listaEnvios); $i++) {
                    echo '<tr>';
                    echo '<td>' . $listaEnvios[$i]["numero_envio"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["fecha_envio"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["nombre_estado_envio"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["nombres_cliente"]. ' ' .$listaEnvios[$i]["apellidos_cliente"] . '</td>';
                    echo '<td>' . $listaEnvios[$i]["direccion_envio"]. ' - ' .$listaEnvios[$i]["destinatario_envio"] . ' - (' .$listaEnvios[$i]["celular_envio"] . ')</td>';
                    echo '<td align="right">'.number_format($listaEnvios[$i]["valor_envio"],0,'.','.').'</td>';
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '<td>';
                    }
                    if ($permisos[0]["consultar"] == 1) {
                        echo '<button type="button" class="btn btn-info" data-target="#modalEnvioDetalle" data-toggle="modal" name="btn_detalles" data-id-envio="' . $listaEnvios[$i]["id_envio"] . '"><i class="fas fa-eye"></i></button>&nbsp;';
                    };
                    if ($permisos[0]["editar"] == 1 && ($listaEnvios[$i]["fkID_estado_envio"] != 3 && $listaEnvios[$i]["fkID_estado_envio"] != 4)) {
                        echo '<button type="button" class="btn btn-warning" data-target="#modalEnvio" data-toggle="modal" name="btn_editar" data-id-envio="' . $listaEnvios[$i]["id_envio"] . '"><i class="fas fa-pen-square"></i></i></button>&nbsp;';
                    };
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="9">No existen envios</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="9">No tienen permisos para consultar</td>';
            echo '</tr>';
        }
    }

    //Funcion para lista desplegable de estado del envio
    public function getSelectEstadoEnvioMensajero()
    {
        //Instancia del envio
        $envio = new Envios();
        //Lista del menu Nivel 1
        $listaEstadoEnvio = $envio->getEstadoEnvioMensajero();
        //Se recorre array de nivel 1
        if (isset($listaEstadoEnvio)) {
            echo '<option selected value="0" selected>Seleccione...</option>';
            for ($i = 0; $i < sizeof($listaEstadoEnvio); $i++) {
                //Valida si es el valor
                if ($valor == $listaEstadoEnvio[$i]["id_estado_envio"]) {
                    $seleccionado = "selected";
                } else {
                    $seleccionado = "";
                }
                echo '<option value="' . $listaEstadoEnvio[$i]["id_estado_envio"] . '" ' . $seleccionado . '>' . $listaEstadoEnvio[$i]["nombre_estado_envio"] . '</option>';
            }
        }
    }
}
