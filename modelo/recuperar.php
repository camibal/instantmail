<?php
include dirname(__FILE__, 2) . "/config/conexion.php";
/**
 *
 */
class Recuperar
{
    private $conn;
    private $link;

    public function __construct()
    {
        $this->conn = new Conexion();
        $this->link = $this->conn->conectarse();
    }

    //Trae todos los permisos
    public function getPermisos($id_usuario, $id_modulo)
    {
        $query = "SELECT consultar,editar, eliminar, crear FROM permisos
                    INNER JOIN usuario ON usuario.fkID_rol = permisos.fkID_rol        
                    WHERE id_usuario ='" . $id_usuario . "' and fkID_modulo ='" . $id_modulo . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los usuario registrados
    public function getUsuario()
    {
        $query = "SELECT nombres_usuario, apellidos_usuario, nickname_usuario, nombre_rol, id_usuario FROM usuario
                INNER JOIN roles ON roles.id_rol = usuario.fkID_rol
                WHERE usuario.estado = 1 ";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los emails de cliente
    public function getCorreosClientes($email)
    {
        $query = "SELECT id_usuario, count(*) as cantidad FROM usuario
        WHERE email_usuario = '$email' AND estado = 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    //guarda email y token para recuperar contraseña
    public function postTablaTokens($token, $id_usuario, $fecha)
    {
        $query  = "INSERT INTO `tokens`(token, fkID_usuario, estado, fecha) VALUES ('" . $token  . "', '" . $id_usuario . "', '" . 0 . "', '" . $fecha . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }
    //Actualizar tabla tokens
    public function updateTablaTokens($token, $fecha)
    {
        $query  = "UPDATE tokens SET estado = 0, fecha = '$fecha'  WHERE token = '$token'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }
    //Consulta si el estado esta en 0 o en 1 y si la fecha es la actual
    public function getEstadoFecha($token, $fecha)
    {
        $query  = "SELECT id, token, estado FROM tokens WHERE token = '$token' AND estado = 0 AND fecha = '$fecha'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    //Consulta la tabla tokens
    public function getTokens($token)
    {
        $query  = "SELECT id, token FROM tokens WHERE token = '$token'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    // update esatdo
    public function updateEstado($token)
    {
        $query  = "UPDATE tokens SET estado = 1 WHERE token = '" . $token . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }
    // update password
    public function updatePassword($id_usuario, $password)
    {
        $query  = "UPDATE usuario SET pass_usuario = '$password' WHERE id_usuario = $id_usuario";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
