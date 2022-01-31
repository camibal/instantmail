<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Mensajero
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
        $query = "SELECT * FROM permisos
                INNER JOIN usuario ON usuario.fkID_rol = permisos.fkID_rol        
                WHERE id_usuario ='" . $id_usuario . "' and fkID_modulo ='" . $id_modulo . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los mensajeros
    public function getMensajeros()
    {
        $query = "SELECT id_mensajero, nombres_mensajero, apellidos_mensajero, fkID_tipo_documento, documento_mensajero, celular_mensajero, nombre_tipo_documento  FROM mensajero 
                INNER JOIN tipo_documento ON tipo_documento.id_tipo_documento = mensajero.fkID_tipo_documento 
                WHERE mensajero.estado = 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los tipos de documento
    public function getTipoDocumento()
    {
        $query  = "SELECT id_tipo_documento, nombre_tipo_documento FROM tipo_documento WHERE estado = 1 ORDER BY nombre_tipo_documento";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea un nuevo mensajero
    public function insertaMensajero($data)
    {
        $query  = "INSERT INTO mensajero (nombres_mensajero,apellidos_mensajero,fkID_tipo_documento,documento_mensajero,celular_mensajero) VALUES ('" . $data['nombres_mensajero'] . "', '" . $data['apellidos_mensajero'] . "', '" . $data['fkID_tipo_documento'] . "', '" . $data['documento_mensajero'] . "', '" . $data['celular_mensajero'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consultar mensajero
    public function consultaMensajero($data)
    {
        $query = "SELECT * FROM mensajero
                WHERE id_mensajero = '" . $data['id_mensajero'] . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Edita un mensajero
    public function editaMensajero($data)
    {
        $query  = "UPDATE mensajero SET nombres_mensajero = '" . $data['nombres_mensajero'] . "',apellidos_mensajero = '" . $data['apellidos_mensajero'] . "',fkID_tipo_documento = '" . $data['fkID_tipo_documento'] . "',documento_mensajero = '" . $data['documento_mensajero'] . "',celular_mensajero = '" . $data['celular_mensajero'] . "'  WHERE id_mensajero = '" . $data['id_mensajero'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Elimina logico un mensajero
    public function eliminaLogicoMensajero($data)
    {
        $query  = "UPDATE mensajero SET estado = '2' WHERE id_mensajero = '" . $data['id_mensajero'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
