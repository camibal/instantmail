<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Calificacion
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

    //Trae todos las calificaciones
    public function getCalificacion($id_usuario)
    {
        $query = "SELECT numero_envio,estado_calificacion,nombres_mensajero, apellidos_mensajero, fecha_envio, id_calificacion FROM calificacion
            INNER JOIN envio ON envio.id_envio = calificacion.fkID_envio
            INNER JOIN mensajero ON mensajero.id_mensajero = calificacion.fkID_mensajero
            INNER JOIN usuario ON usuario.fkID_cliente = calificacion.fkID_cliente
            WHERE estado_calificacion = 0 AND calificacion.estado = 1 AND usuario.id_usuario = '" . $id_usuario . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Consultar calificacion
    public function consultaCalificacion($data)
    {
        $query = "SELECT numero_envio,estado_calificacion,nombres_mensajero, apellidos_mensajero,fecha_envio, id_calificacion FROM calificacion
            INNER JOIN envio ON envio.id_envio = calificacion.fkID_envio
            INNER JOIN mensajero ON mensajero.id_mensajero = calificacion.fkID_mensajero
            WHERE id_calificacion = '" . $data['id_calificacion'] . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Edita calificacion
    public function editaCalificacion($data)
    {
        $query  = "UPDATE calificacion SET estado_calificacion='1' ,fecha_calificacion = '" . date('Y-m-d') . "', valor_calificacion = '" . $data['valor_calificacion'] . "', observaciones_calificacion = '" . $data['observaciones_calificacion'] . "'  WHERE id_calificacion = '" . $data['id_calificacion'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
}
