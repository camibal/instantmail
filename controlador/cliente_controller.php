<?php
include dirname(__file__, 2) . '/modelo/cliente.php';

class clienteController extends cliente
{

    public function __construct()
    {
        # code...
    }

    //Trae los permisos
    public function Permisos($id_usuario, $id_modulo){
        $cliente     = new Cliente();
        $resultado = $cliente->getPermisos($id_usuario, $id_modulo);
        return $resultado;
    }

    //Funcion para lista desplegable de tipo documento
    public function getSelectTipoDocumento()
    {
        //Instancia del cliente
        $cliente = new Cliente();
        //Lista del menu Nivel 1
        $listaTipoDoc = $cliente->getTipoDocumento();
        //Se recorre array de nivel 1
        if (isset($listaTipoDoc)) {
            echo '<option selected value="0">Seleccione...</option>';
            for ($i = 0; $i < sizeof($listaTipoDoc); $i++) {
                //Valida si es el valor
                if ($valor == $listaTipoDoc[$i]["id_tipo_documento"]) {
                    $seleccionado = "selected";
                } else {
                    $seleccionado = "";
                }
                echo '<option value="' . $listaTipoDoc[$i]["id_tipo_documento"] . '" ' . $seleccionado . '>' . $listaTipoDoc[$i]["nombre_tipo_documento"] . '</option>';
            }
        }
    }

    //Tabla de clientes
    public function getTablaClientes($permisos)
    {
        //Instancia del cliente
        $cliente = new Cliente();
        //Lista del menu Nivel 1
        $listaClientes = $cliente->getClientes();
        //Se recorre array de nivel 1
        if ($permisos[0]["consultar"] == 1) {
            if (isset($listaClientes)) {
                for ($i = 0; $i < sizeof($listaClientes); $i++) {
                    echo '<tr>';
                    echo '<td>'.$listaClientes[$i]["nombres_cliente"].' '.$listaClientes[$i]["apellidos_cliente"].'</td>';
                    echo '<td>' . $listaClientes[$i]["nombre_tipo_documento"] . '</td>';
                    echo '<td>' . $listaClientes[$i]["documento_cliente"] . '</td>';
                    echo '<td>' . $listaClientes[$i]["celular_cliente"] . '</td>';
                    echo '<td>' . $listaClientes[$i]["direccion_cliente"] . '</td>';
                    echo '<td>' . $listaClientes[$i]["email_cliente"] . '</td>';
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '<td>';
                    }
                    if ($permisos[0]["editar"] == 1) {
                        echo '<button type="button" class="btn btn-warning" data-target="#modalCliente" data-toggle="modal" name="btn_editar" data-id-cliente="' . $listaClientes[$i]["id_cliente"] . '"><i class="fas fa-pen-square"></i></i></button>&nbsp;';
                    };
                    if ($permisos[0]["eliminar"] == 1) {
                        echo '<button type="button" class="btn btn-danger" name="btn_eliminar" data-id-cliente="' . $listaClientes[$i]["id_cliente"] . '" data-toggle="modal" data-target="#eliminarModal"><i class="fas fa-trash-alt"></i></button>';
                    }
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="9">No existen clientes</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="9">No tienen permisos para consultar</td>';
            echo '</tr>';
        }
    }
}
