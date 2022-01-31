<?php
include dirname(__file__, 2) . '/modelo/calificacion.php';

class calificacionController extends calificacion
{

    public function __construct()
    {
        # code...
    }

    //Trae los permisos
    public function Permisos($id_usuario, $id_modulo){
        $calificacion     = new Calificacion();
        $resultado = $calificacion->getPermisos($id_usuario, $id_modulo);
        return $resultado;
    }

    //Tabla de calificaciones
    public function getTablaCalificacion($permisos, $id_usuario)
    {
        //Instancia del calificacion
        $calificacion = new Calificacion();
        //Lista del menu Nivel 1
        $listaCalificacion = $calificacion->getCalificacion($id_usuario);
        //Se recorre array de nivel 1
        if ($permisos[0]["consultar"] == 1) {
            if (isset($listaCalificacion)) {
                for ($i = 0; $i < sizeof($listaCalificacion); $i++) {
                    echo '<tr>';
                    echo '<td>' . $listaCalificacion[$i]["numero_envio"] . '</td>';
                    if($listaCalificacion[$i]["estado_calificacion"] == 0){
                        $estadoCalificacion = 'Sin calificar';
                    } else {
                        $estadoCalificacion = 'Calificado';
                    }
                    echo '<td>' . $estadoCalificacion . '</td>';
                    echo '<td>' . $listaCalificacion[$i]["nombres_mensajero"]. ' ' .$listaCalificacion[$i]["apellidos_mensajero"] . '</td>';
                    echo '<td>' . $listaCalificacion[$i]["fecha_envio"]. '</td>';
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '<td>';
                    }
                    if ($permisos[0]["editar"] == 1) {
                        echo '<button type="button" class="btn btn-success" data-target="#modalCalificacion" data-toggle="modal" name="btn_editar" data-id-calificacion="' . $listaCalificacion[$i]["id_calificacion"] . '"><i class="far fa-check-circle"></i></button>&nbsp;';
                    };
                    if ($permisos[0]["editar"] == 1 || $permisos[0]["eliminar"] == 1) {
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="9">No existen calificacions</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="9">No tienen permisos para consultar</td>';
            echo '</tr>';
        }
    }

}