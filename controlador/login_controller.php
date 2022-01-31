<?php
include dirname(__file__, 2) . '/modelo/login.php';

class loginController extends login
{
    //Constructor
    public function __construct()
    {
        # code...
    }

    //Trae datos del ussuario
    public function UsuarioLogin($id_usuario){
        $login     = new Login();
        $resultado = $login->getUsuariolog($id_usuario);
        return $resultado;
    }

    //Trae datos del ussuario
    public function VerModulo($id_usuario){
        $login     = new Login();
        $resultado = $login->getVerModulo($id_usuario);
        return $resultado;
    }   
}