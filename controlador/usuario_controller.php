<?php
include dirname(__file__, 2) . '/modelo/usuario.php';

class usuarioController extends usuario
{
    //Constructor
    public function __construct()
    {
        # code...
    }

    //Trae los permisos
    public function Permisos($id_usuario, $id_modulo)
    {
        $usuario     = new Usuario();
        $resultado = $usuario->getPermisos($id_usuario, $id_modulo);
        return $resultado;
    }

    //Funcion para traer tabla
    public function getTablaUsuario($permisos)
    {
        $usuario      = new Usuario();
        $listaUsuario = $usuario->getUsuario();
        if ($permisos[0]["consultar"] == 1) {
            if (isset($listaUsuario)) {
                for ($i = 0; $i < sizeof($listaUsuario); $i++) {
                    echo '<tr>';
                    echo '<td class="text-center" style="cursor: pointer">' . $listaUsuario[$i]["nombres_usuario"] . '</td>';
                    echo '<td class="text-center" style="cursor: pointer">' . $listaUsuario[$i]["apellidos_usuario"] . '</td>';
                    echo '<td class="text-center" style="cursor: pointer">' . $listaUsuario[$i]["nickname_usuario"] . '</td>';
                    echo '<td class="text-center" style="cursor: pointer">' . $listaUsuario[$i]["nombre_rol"] . '</td>';
                    if ($permisos[0]["editar"] == 1) {
                        echo '<td class="text-center"><button type="button" class="btn btn-warning text-center" data-target="#modalUsuario" data-toggle="modal" name="btn_editar" data-id-Usuario="' . $listaUsuario[$i]["id_usuario"] . '"><i class="fas fa-pen-square"></i></button></td>';
                    }
                    if ($permisos[0]["eliminar"] == 1) {
                        echo '<td class="text-center"> <button type="button" class="btn btn-danger" name="btn_eliminar" data-id-usuario="' . $listaUsuario[$i]["id_usuario"] . '" data-toggle="modal" data-target="#eliminarModal"><i class="fas fa-trash-alt"></i></button></td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="9">No existen usuarios</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="9">No tienen permisos para consultar</td>';
            echo '</tr>';
        }
    }

    //Funcion para lista desplegable de Rol
    public function getSelectRol()
    {
        //Instancia del usuario
        $usuario = new Usuario();
        //Lista del menu Nivel 1
        $listaRol = $usuario->getRol();
        //Se recorre array de nivel 1
        if (isset($listaRol)) {
            echo '<option selected value="0">Seleccione...</option>';
            for ($i = 0; $i < sizeof($listaRol); $i++) {
                //Valida si es el valor
                if ($valor == $listaRol[$i]["id_rol"]) {
                    $seleccionado = "selected";
                } else {
                    $seleccionado = "";
                }
                echo '<option value="' . $listaRol[$i]["id_rol"] . '" ' . $seleccionado . '>' . $listaRol[$i]["nombre_rol"] . '</option>';
            }
        }
    }

    //Funcion para lista desplegable de tipo documento
    public function getSelectTipoDocumento()
    {
        //Instancia del usuario
        $usuario = new Usuario();
        //Lista del menu Nivel 1
        $listaTipoDoc = $usuario->getTipoDocumento();
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

    //Funcion para lista desplegable de cliente
    public function getSelectCliente()
    {
        //Instancia del usuario
        $usuario = new Usuario();
        //Lista del menu Nivel 1
        $listaCliente = $usuario->getClientes();
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
                echo '<option value="' . $listaCliente[$i]["id_cliente"] . '" ' . $seleccionado . '>' . $listaCliente[$i]["nombres_cliente"] . ' ' . $listaCliente[$i]["apellidos_cliente"] . '</option>';
            }
        }
    }

    //Funcion para lista desplegable de mensajero
    public function getSelectMensajero()
    {
        //Instancia del usuario
        $usuario = new Usuario();
        //Lista del menu Nivel 1
        $listaMensajero = $usuario->getMensajeros();
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
                echo '<option value="' . $listaMensajero[$i]["id_mensajero"] . '" ' . $seleccionado . '>' . $listaMensajero[$i]["nombres_mensajero"] . ' ' . $listaMensajero[$i]["apellidos_mensajero"] . '</option>';
            }
        }
    }
    //Funcion para consultar usuario en DB
    public function getConsultUser()
    {
        $usuario      = new Usuario();
        $listaUsuario = $usuario->getUsuario();
        echo  $listaUsuario;
        return $listaUsuario;
    }
}
