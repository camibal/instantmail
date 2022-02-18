<?php
include dirname(__file__, 2) . '/modelo/recuperar.php';

class recuperarController extends recuperar
{
    //Constructor
    public function __construct()
    {
        # code...
    }

    //Trae los permisos
    public function Permisos($id_usuario, $id_modulo)
    {
        $recuperar     = new Recuperar();
        $resultado = $recuperar->getPermisos($id_usuario, $id_modulo);
        return $resultado;
    }
    //Funcion para consultar usuario en DB
    public function getConsultUser()
    {
        $recuperar      = new Recuperar();
        $listaUsuario = $recuperar->getUsuario();
        echo  $listaUsuario;
        return $listaUsuario;
    }
}
