<?php
include dirname(__FILE__, 2) . "/config/conexion.php";
/**
 *
 */
class Login
{
    private $conn;
    private $link;

    public function __construct()
    {
        $this->conn = new Conexion();
        $this->link = $this->conn->conectarse();
    }

    //Trae datos del usuario
    public function getUsuariolog($id_usuario)
    {
        $query = "SELECT nombres_usuario, apellidos_usuario, id_usuario, foto_usuario FROM `usuario`
                WHERE id_usuario = '" . $id_usuario . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae la información de ver modulo
    public function getVerModulo($id_usuario)
    {
        $query  = "SELECT nombre_modulo, nombre_icono FROM permisos 
            INNER JOIN modulos ON modulos.id_modulo = permisos.fkID_modulo 
            INNER JOIN usuario ON usuario.fkID_rol = permisos.fkID_rol 
            WHERE id_usuario = '" . $id_usuario . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    
    //Obtiene el usuario por nickname
    public function getUserByNickname($usuarioNombre = null)
    {
        if (!empty($usuarioNombre)) {
            $query  = "SELECT id_usuario FROM usuario WHERE nickname_usuario = '" . $usuarioNombre . "' AND estado=1";
            $result = mysqli_query($this->link, $query);
            $data   = array();
            while ($data[] = mysqli_fetch_assoc($result));
            array_pop($data);
            return $data;
        } else {
            return false;
        }
    }

    //Verifica contraseña
    public function getPass($usuarioNombre = null, $password = null)
    {
        
        if (!empty($usuarioNombre)) {
            if (!empty($password)) {
                $query  = "SELECT id_usuario FROM usuario WHERE nickname_usuario ='" . $usuarioNombre . "' AND pass_usuario=sha1('" . $password . "')";
                $result = mysqli_query($this->link, $query);
                $data   = array();
                while ($data[] = mysqli_fetch_assoc($result));
                array_pop($data);
                return $data;
            }
        } else {
            return false;
        }
    }
}
