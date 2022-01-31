<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Listados
{
    private $conn;
    private $link;

    public function __construct()
    {
        $this->conn = new Conexion();
        $this->link = $this->conn->conectarse();
    }

    //Clientes
    public function getClientes()
    {
        $query = "SELECT nombres_cliente, apellidos_cliente, documento_cliente, email_cliente, celular_cliente, direccion_cliente FROM cliente
                WHERE cliente.estado = 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Mensajeros
    public function getMensajeros()
    {
        $query = "SELECT nombres_mensajero, apellidos_mensajero, documento_mensajero, celular_mensajero FROM mensajero
                WHERE mensajero.estado = 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
}