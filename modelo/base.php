<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Base
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
        $query = "SELECT usuario.fkID_rol, consultar,editar, eliminar, crear FROM permisos
                INNER JOIN usuario ON usuario.fkID_rol = permisos.fkID_rol        
                WHERE id_usuario ='" . $id_usuario . "' and fkID_modulo ='" . $id_modulo . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos la base
    public function getBase()
    {
        $query = "SELECT id_movimiento, fecha_movimiento, nombre_tipo_movimiento, valor_movimiento, observaciones_movimiento  FROM movimiento
            INNER JOIN tipo_movimiento ON tipo_movimiento.id_tipo_movimiento = movimiento.fkID_tipo_movimiento
            WHERE movimiento.estado = 1 AND (fkID_tipo_movimiento = 3 or fkID_tipo_movimiento = 4)";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los tipos de movimiento
    public function getTipoMovimiento()
    {
        $query  = "SELECT id_tipo_movimiento, nombre_tipo_movimiento FROM tipo_movimiento 
            WHERE estado = 1 AND (id_tipo_movimiento = 3 OR id_tipo_movimiento = 4)
            ORDER BY nombre_tipo_movimiento";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea un nuevo movimiento
    public function insertaBase($data)
    {
        $query  = "INSERT INTO movimiento (fecha_movimiento, fkID_tipo_movimiento, valor_movimiento, observaciones_movimiento) VALUES ('" . $data['fecha_movimiento'] . "', '" . $data['fkID_tipo_movimiento'] . "', '" . $data['valor_movimiento'] . "', '" . $data['observaciones_movimiento'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consultar movimiento
    public function consultaBase($data)
    {
        $query = "SELECT id_movimiento, fecha_movimiento, fkID_tipo_movimiento, valor_movimiento, observaciones_movimiento
                FROM movimiento
                WHERE id_movimiento = '" . $data['id_movimiento'] . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Edita un movimiento
    public function editaBase($data)
    {
        $query  = "UPDATE movimiento SET fkID_tipo_movimiento = '" . $data['fkID_tipo_movimiento'] . "',valor_movimiento = '" . $data['valor_movimiento'] . "',observaciones_movimiento = '" . $data['observaciones_movimiento'] . "'  WHERE id_movimiento = '" . $data['id_movimiento'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Elimina logico un movimiento
    public function eliminaLogicoBase($data)
    {
        $query  = "UPDATE movimiento SET estado = '2' WHERE id_movimiento = '" . $data['id_movimiento'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consultar si existe base
    public function existeBase($data)
    {
        $query = "SELECT COUNT(id_movimiento) as cantidad
                FROM movimiento
                WHERE fecha_movimiento = '" . $data['fecha_movimiento'] . "' and estado = 1 AND fkID_tipo_movimiento = 4";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
}
