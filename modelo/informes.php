<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Informes
{
    private $conn;
    private $link;

    public function __construct()
    {
        $this->conn = new Conexion();
        $this->link = $this->conn->conectarse();
    }

    //Envios
    public function getEnvios($where)
    {
        $query = "SELECT numero_envio, nombres_cliente, apellidos_cliente, nombre_estado_envio, nombres_mensajero, apellidos_mensajero, destinatario_envio, valor_envio FROM envio
                INNER JOIN cliente ON cliente.id_cliente = envio.fkID_cliente
                INNER JOIN estado_envio ON estado_envio.id_estado_envio = envio.fkID_estado_envio
                INNER JOIN mensajero ON mensajero.id_mensajero = envio.fkID_mensajero
                WHERE envio.estado = 1 ".$where;
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Envios devoluciones
    public function getEnviosDevoluciones($where)
    {
        $query = "SELECT fecha_envio, numero_envio, nombres_cliente, apellidos_cliente, nombre_estado_envio, nombres_mensajero, apellidos_mensajero, destinatario_envio, valor_envio FROM envio
                INNER JOIN cliente ON cliente.id_cliente = envio.fkID_cliente
                INNER JOIN estado_envio ON estado_envio.id_estado_envio = envio.fkID_estado_envio
                INNER JOIN mensajero ON mensajero.id_mensajero = envio.fkID_mensajero
                WHERE envio.estado = 1 AND fkID_estado_envio = 4 ".$where;
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Calificaciones
    public function getCalificaciones($where)
    {
        $query = "SELECT SUM(valor_calificacion) AS suma, COUNT(valor_calificacion) as cantidad, ROUND((SUM(valor_calificacion)/COUNT(valor_calificacion))) as promedio, nombres_mensajero, apellidos_mensajero FROM calificacion 
            INNER JOIN mensajero ON mensajero.id_mensajero = calificacion.fkID_mensajero 
            WHERE estado_calificacion = 1 AND calificacion.estado = 1 ". $where ."
            GROUP BY fkID_mensajero";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Caja
    public function getCaja($where)
    {
        $query = "SELECT fkID_tipo_movimiento, fecha_movimiento, nombre_tipo_movimiento, valor_movimiento, observaciones_movimiento FROM movimiento
                INNER JOIN tipo_movimiento ON tipo_movimiento.id_tipo_movimiento = movimiento.fkID_tipo_movimiento
                WHERE movimiento.estado = 1 ". $where ."
                ORDER BY orden_tipo_movimiento ASC";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
}
