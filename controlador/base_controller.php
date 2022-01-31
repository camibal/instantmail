<?php
include dirname(__file__, 2) . '/modelo/base.php';

class baseController extends base
{

    public function __construct()
    {
        # code...
    }

    //Trae los permisos
    public function Permisos($id_usuario, $id_modulo){
        $base     = new Base();
        $resultado = $base->getPermisos($id_usuario, $id_modulo);
        return $resultado;
    }

    //Tabla de bases
    public function getTablaBase($permisos)
    {
        //Instancia del base
        $base = new Base();
        //Lista del menu Nivel 1
        $listaBases = $base->getBase();
        //Se recorre array de nivel 1
        if ($permisos[0]["consultar"] == 1) {
            if (isset($listaBases)) {
                for ($i = 0; $i < sizeof($listaBases); $i++) {
                    echo '<tr>';
                    echo '<td>' . $listaBases[$i]["fecha_movimiento"] .'</td>';
                    echo '<td>' . $listaBases[$i]["nombre_tipo_movimiento"] . '</td>';
                    echo '<td class="text-right">' . number_format($listaBases[$i]["valor_movimiento"],0,'.','.') . '</td>';
                    echo '<td>' . $listaBases[$i]["observaciones_movimiento"] . '</td>';
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '<td>';
                    }
                    if ($permisos[0]["editar"] == 1) {
                        echo '<button type="button" class="btn btn-warning" data-target="#modalBase" data-toggle="modal" name="btn_editar" data-id-movimiento="' . $listaBases[$i]["id_movimiento"] . '"><i class="fas fa-pen-square"></i></i></button>&nbsp;';
                    };
                    if ($permisos[0]["eliminar"] == 1) {
                        echo '<button type="button" class="btn btn-danger" name="btn_eliminar" data-id-movimiento="' . $listaBases[$i]["id_movimiento"] . '" data-toggle="modal" data-target="#eliminarModal"><i class="fas fa-trash-alt"></i></button>';
                    }
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="9">No existen bases</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="9">No tienen permisos para consultar</td>';
            echo '</tr>';
        }
    }

    //Funcion para lista desplegable de tipo movimiento
    public function getSelectTipoMovimiento()
    {
        //Instancia del base
        $base = new Base();
        //Lista del menu Nivel 1
        $listaTipoMov = $base->getTipoMovimiento();
        //Se recorre array de nivel 1
        if (isset($listaTipoMov)) {
            echo '<option selected value="0">Seleccione...</option>';
            for ($i = 0; $i < sizeof($listaTipoMov); $i++) {
                //Valida si es el valor
                if ($valor == $listaTipoMov[$i]["id_tipo_movimiento"]) {
                    $seleccionado = "selected";
                } else {
                    $seleccionado = "";
                }
                echo '<option value="' . $listaTipoMov[$i]["id_tipo_movimiento"] . '" ' . $seleccionado . '>' . $listaTipoMov[$i]["nombre_tipo_movimiento"] . '</option>';
            }
        }
    }
}
