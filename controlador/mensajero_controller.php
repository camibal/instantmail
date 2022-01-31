<?php
include dirname(__file__, 2) . '/modelo/mensajero.php';

class mensajeroController extends mensajero
{

    public function __construct()
    {
        # code...
    }

    //Trae los permisos
    public function Permisos($id_usuario, $id_modulo){
        $mensajero     = new Mensajero();
        $resultado = $mensajero->getPermisos($id_usuario, $id_modulo);
        return $resultado;
    }

    //Tabla de mensajeros
    public function getTablaMensajeros($permisos)
    {
        //Instancia del mensajero
        $mensajero = new mensajero();
        //Lista del menu Nivel 1
        $listaMensajeros = $mensajero->getMensajeros();
        //Se recorre array de nivel 1
        if ($permisos[0]["consultar"] == 1) {
            if (isset($listaMensajeros)) {
                for ($i = 0; $i < sizeof($listaMensajeros); $i++) {
                    echo '<tr>';
                    echo '<td>' . $listaMensajeros[$i]["nombres_mensajero"] .' '.$listaMensajeros[$i]["apellidos_mensajero"]. '</td>';
                    echo '<td>' . $listaMensajeros[$i]["nombre_tipo_documento"] . '</td>';
                    echo '<td>' . $listaMensajeros[$i]["documento_mensajero"] . '</td>';
                    echo '<td>' . $listaMensajeros[$i]["celular_mensajero"] . '</td>';
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '<td>';
                    }
                    if ($permisos[0]["editar"] == 1) {
                        echo '<button type="button" class="btn btn-warning" data-target="#modalMensajero" data-toggle="modal" name="btn_editar" data-id-mensajero="' . $listaMensajeros[$i]["id_mensajero"] . '"><i class="fas fa-pen-square"></i></i></button>&nbsp;';
                    };
                    if ($permisos[0]["eliminar"] == 1) {
                        echo '<button type="button" class="btn btn-danger" name="btn_eliminar" data-id-mensajero="' . $listaMensajeros[$i]["id_mensajero"] . '" data-toggle="modal" data-target="#eliminarModal"><i class="fas fa-trash-alt"></i></button>';
                    }
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="9">No existen mensajeros</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="9">No tienen permisos para consultar</td>';
            echo '</tr>';
        }
    }

    //Funcion para lista desplegable de tipo documento
    public function getSelectTipoDocumento()
    {
        //Instancia del mensajero
        $mensajero = new Mensajero();
        //Lista del menu Nivel 1
        $listaTipoDoc = $mensajero->getTipoDocumento();
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
}
