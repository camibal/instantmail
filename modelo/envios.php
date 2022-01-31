<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Envios
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

    //Trae todos los envios registrados
    public function getEnvios()
    {
        $query = "SELECT id_envio,numero_envio,fecha_envio,nombre_estado_envio,nombres_cliente, destinatario_envio, celular_envio, direccion_envio, apellidos_cliente, nombres_mensajero, apellidos_mensajero,valor_envio FROM envio
            INNER JOIN estado_envio ON estado_envio.id_estado_envio = envio.fkID_estado_envio
            INNER JOIN cliente ON cliente.id_cliente = envio.fkID_cliente
            LEFT JOIN mensajero ON mensajero.id_mensajero = envio.fkID_mensajero
            WHERE envio.estado = 1 
            ORDER BY id_envio DESC";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los estados de los envios
    public function getEstadoEnvio()
    {
        $query = "SELECT id_estado_envio,nombre_estado_envio FROM estado_envio
            WHERE estado = 1 ";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los clientes
    public function getClientes()
    {
        $query  = "SELECT nombres_cliente, apellidos_cliente, id_cliente FROM cliente WHERE estado = 1 ORDER BY nombres_cliente";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los envios registrados por cliente
    public function getEnviosCliente($id_usuario)
    {
        $query = "SELECT id_envio,numero_envio,fecha_envio,nombre_estado_envio,nombres_cliente, destinatario_envio, celular_envio, direccion_envio, apellidos_cliente, nombres_mensajero, apellidos_mensajero,valor_envio FROM envio
            INNER JOIN estado_envio ON estado_envio.id_estado_envio = envio.fkID_estado_envio
            INNER JOIN cliente ON cliente.id_cliente = envio.fkID_cliente
            INNER JOIN usuario ON usuario.fkID_cliente = cliente.id_cliente
            LEFT JOIN mensajero ON mensajero.id_mensajero = envio.fkID_mensajero
            WHERE envio.estado = 1 AND usuario.id_usuario = '" . $id_usuario . "'
            ORDER BY id_envio DESC";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los envios registrados por mensajero
    public function getEnviosMensajero($id_usuario)
    {
        $query = "SELECT fkID_estado_envio, id_envio,numero_envio,fecha_envio,nombre_estado_envio,nombres_cliente, destinatario_envio, celular_envio, direccion_envio, apellidos_cliente, nombres_mensajero, apellidos_mensajero,valor_envio FROM envio
            INNER JOIN estado_envio ON estado_envio.id_estado_envio = envio.fkID_estado_envio
            INNER JOIN cliente ON cliente.id_cliente = envio.fkID_cliente
            INNER JOIN usuario ON usuario.fkID_mensajero = envio.fkID_mensajero
            INNER JOIN mensajero ON mensajero.id_mensajero = envio.fkID_mensajero
            WHERE envio.estado = 1 AND usuario.id_usuario = '" . $id_usuario . "'
            ORDER BY id_envio DESC";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los estados de los envios para mensajeros
    public function getEstadoEnvioMensajero()
    {
        $query = "SELECT id_estado_envio,nombre_estado_envio FROM estado_envio
            WHERE estado = 1 AND (id_estado_envio = 3 or id_estado_envio = 4)";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea un nuevo envio
    public function insertaEnvio($data)
    {
        $query  = "INSERT INTO envio (numero_envio,fecha_envio,fkID_estado_envio,fkID_cliente, destinatario_envio, celular_envio, direccion_envio, email_envio, valor_envio, observaciones_envio, fkID_mensajero) VALUES ('" . $data['numero_envio'] . "', '" . $data['fecha_envio'] . "', '" . $data['fkID_estado_envio'] . "', '" . $data['fkID_cliente'] . "', '" . $data['destinatario_envio'] . "','" . $data['celular_envio'] . "', '" . $data['direccion_envio'] . "', '" . $data['email_envio'] . "', '" . $data['valor_envio'] . "','" . $data['observaciones_envio'] . "','" . $data['fkID_mensajero'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consulta el ultimo ID de envio
    public function ultimoEnvio()
    {
        $query  = "SELECT id_envio FROM envio ORDER BY envio.id_envio DESC LIMIT 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Inserta en historial
    public function insertaHistorial($id_envio, $data)
    {
        $nombreFinal = "";
        if($_FILES['archivo']['tmp_name'] != ""){
            //Toma la extension del archivo
            $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
            //Encripta el nombre tomando fecha y hora actual
            $nombreEncriptado = sha1(date("Y-m-d H:i:s")); 
            //Concatena nombre con extension
            $nombreFinal = $nombreEncriptado. "." .$extension;
            //Copia el archivo al servidor
            move_uploaded_file($_FILES['archivo']['tmp_name'], "../subidas/" . $nombreFinal);
        }

        $query  = "INSERT INTO historial_envio (fkID_envio,fecha_historial,fkID_estado_envio,fkID_cliente, destinatario_historial, celular_historial, direccion_historial, email_historial, valor_historial, observaciones_historial, fkID_mensajero, evidencia_historial) VALUES ('" . $id_envio . "', '" . $data['fecha_envio'] . "', '" . $data['fkID_estado_envio'] . "', '" . $data['fkID_cliente'] . "', '" . $data['destinatario_envio'] . "','" . $data['celular_envio'] . "', '" . $data['direccion_envio'] . "', '" . $data['email_envio'] . "', '" . $data['valor_envio'] . "','" . $data['observaciones_envio'] . "','" . $data['fkID_mensajero'] . "','" . $nombreFinal . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consultar envio
    public function consultaEnvio($data)
    {
        $query = "SELECT id_envio, numero_envio, fecha_envio, destinatario_envio, email_envio, celular_envio, valor_envio, fkID_estado_envio, fkID_cliente, fkID_mensajero, observaciones_envio, direccion_envio FROM envio
                WHERE id_envio = '" . $data['id_envio'] . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Edita un envio
    public function editaEnvio($data)
    {
        $query  = "UPDATE envio SET fecha_envio = '" . $data['fecha_envio'] . "',fkID_estado_envio = '" . $data['fkID_estado_envio'] . "',fkID_cliente = '" . $data['fkID_cliente'] . "',destinatario_envio = '" . $data['destinatario_envio'] . "',celular_envio = '" . $data['celular_envio'] . "',direccion_envio = '" . $data['direccion_envio'] . "',email_envio = '" . $data['email_envio'] . "',valor_envio = '" . $data['valor_envio'] . "',observaciones_envio = '" . $data['observaciones_envio'] . "',fkID_mensajero = '" . $data['fkID_mensajero'] . "'  WHERE id_envio = '" . $data['id_envio'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    //Elimina logico un envio
    public function eliminaLogicoEnvio($data)
    {
        $query  = "UPDATE envio SET estado = '2' WHERE id_envio = '" . $data['id_envio'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consultar detalle del envio
    public function consultaDetalleEnvio($data)
    {
        $query = "SELECT nombre_estado_envio,nombres_cliente, apellidos_cliente, nombres_mensajero, apellidos_mensajero, observaciones_historial, fecha_historial, direccion_historial, celular_historial, destinatario_historial, evidencia_historial FROM historial_envio
                INNER JOIN estado_envio ON estado_envio.id_estado_envio = historial_envio.fkID_estado_envio
                INNER JOIN cliente ON cliente.id_cliente = historial_envio.fkID_cliente
                LEFT JOIN mensajero ON mensajero.id_mensajero = historial_envio.fkID_mensajero
                WHERE fkID_envio = '" . $data['id_envio'] . "'
                ORDER BY id_historial_envio ASC";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    
    //Trae los mensajeros
    public function getMensajeros()
    {
        $query  = "SELECT nombres_mensajero, apellidos_mensajero, id_mensajero FROM mensajero WHERE estado = 1 ORDER BY nombres_mensajero";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Inserta calificacion
    public function insertaCalificacion($data)
    {
        $query  = "INSERT INTO calificacion (fkID_envio, fkID_mensajero, fkID_cliente) VALUES ('" . $data['id_envio']  . "', '" . $data['fkID_mensajero'] . "', '" . $data['fkID_cliente'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
