<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Cliente
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

    //Trae todos los clientes registrados
    public function getClientes()
    {
        $query = "SELECT nombres_cliente, apellidos_cliente, nombre_tipo_documento, documento_cliente, celular_cliente, email_cliente, direccion_cliente, id_cliente FROM cliente
            LEFT JOIN tipo_documento ON tipo_documento.id_tipo_documento = cliente.fkID_tipo_documento
            WHERE cliente.estado = 1 ";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea un nuevo cliente
    public function insertaCliente($data)
    {
        $query  = "INSERT INTO cliente (nombres_cliente,apellidos_cliente,fkID_tipo_documento,documento_cliente, email_cliente, celular_cliente, direccion_cliente) VALUES ('" . $data['nombres_cliente'] . "', '" . $data['apellidos_cliente'] . "', '" . $data['fkID_tipo_documento'] . "', '" . $data['documento_cliente'] . "', '" . $data['email_cliente'] . "', '" . $data['celular_cliente'] . "','" . $data['direccion_cliente'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consultar cliente
    public function consultaCliente($data)
    {
        $query = "SELECT id_cliente, nombres_cliente, apellidos_cliente, documento_cliente, direccion_cliente, email_cliente, celular_cliente, fkID_tipo_documento FROM cliente
                WHERE id_cliente = '" . $data['id_cliente'] . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Edita un cliente
    public function editaCliente($data)
    {
        $query  = "UPDATE cliente SET nombres_cliente = '" . $data['nombres_cliente'] . "',apellidos_cliente = '" . $data['apellidos_cliente'] . "',fkID_tipo_documento = '" . $data['fkID_tipo_documento'] . "',documento_cliente = '" . $data['documento_cliente'] . "',celular_cliente = '" . $data['celular_cliente'] . "',direccion_cliente = '" . $data['direccion_cliente'] . "',email_cliente = '" . $data['email_cliente'] . "'  WHERE id_cliente = '" . $data['id_cliente'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Elimina logico un cliente
    public function eliminaLogicoCliente($data)
    {
        $query  = "UPDATE cliente SET estado = '2' WHERE id_cliente = '" . $data['id_cliente'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
