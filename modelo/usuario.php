<?php
include dirname(__FILE__, 2) . "/config/conexion.php";
/**
 *
 */
class Usuario
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

    //Trae los roles
    public function getRol()
    {
        $query  = "SELECT nombre_rol, id_rol FROM roles WHERE estado = 1 ORDER BY nombre_rol";
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

    //Trae los clientes
    public function getClientes()
    {
        $query  = "SELECT nombres_cliente, apellidos_cliente,id_cliente FROM cliente WHERE estado = 1 ORDER BY nombres_cliente";
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

    //Crea un nuevo usuario
    public function insertaUsuario($data)
    {
        $nombreFinal = "";
        if ($_FILES['archivo']['tmp_name'] != "") {
            //Toma la extension del archivo
            $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
            //Encripta el nombre tomando fecha y hora actual
            $nombreEncriptado = sha1(date("Y-m-d H:i:s"));
            //Concatena nombre con extension
            $nombreFinal = $nombreEncriptado . "." . $extension;
            //Copia el archivo al servidor
            move_uploaded_file($_FILES['archivo']['tmp_name'], "../subidas/" . $nombreFinal);
        }

        $query  = "INSERT INTO `usuario`(nombres_usuario, apellidos_usuario, fkID_tipo_documento, documento_usuario, nickname_usuario, pass_usuario, fkID_rol, fkID_cliente, fkID_mensajero, foto_usuario) VALUES ('" . $data['nombres_usuario']  . "','" . $data['apellidos_usuario'] . "', '" . $data['fkID_tipo_documento'] . "', '" . $data['documento_usuario'] . "','" . $data['nickname_usuario'] . "',sha1( '" . $data['pass_usuario'] . "'), '" . $data['fkID_rol'] . "', '" . $data['fkID_cliente'] . "', '" . $data['fkID_mensajero'] . "', '" . $nombreFinal . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Traer un usuario registrados
    public function consultaUsuario($data)
    {
        $query = "SELECT nombres_usuario, apellidos_usuario, id_usuario, fkID_tipo_documento, documento_usuario, nickname_usuario, pass_usuario, fkID_rol, fkID_cliente, fkID_mensajero, foto_usuario FROM usuario
                WHERE id_usuario = '" . $data['id_usuario'] . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Elimina logico un usuario
    public function eliminaLogicoUsuario($data)
    {
        $query  = "UPDATE usuario SET estado = 2 WHERE id_usuario = '" . $data['id_usuario'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Edita Usuario
    public function editaUsuario($data)
    {
        if ($data['pass_usuario'] === $data['pass_antiguo']) {
            $r = "";
        } else {
            $r = ",pass_usuario = sha1('" . $data['pass_usuario'] . "')";
        }

        if ($_FILES['archivo']['tmp_name'] != "") {
            //Toma la extension del archivo
            $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
            //Encripta el nombre tomando fecha y hora actual
            $nombreEncriptado = sha1(date("Y-m-d H:i:s"));
            //Concatena nombre con extension
            $nombreFinal = $nombreEncriptado . "." . $extension;
            //Copia el archivo al servidor
            move_uploaded_file($_FILES['archivo']['tmp_name'], "../subidas/" . $nombreFinal);
        } else {
            $nombreFinal = $data["foto_usuario"];
        }

        $query  = "UPDATE usuario SET nombres_usuario = '" . $data["nombres_usuario"] . "', apellidos_usuario = '" . $data["apellidos_usuario"] . "' , fkID_tipo_documento = '" . $data["fkID_tipo_documento"] . "', documento_usuario = '" . $data["documento_usuario"] . "',nickname_usuario = '" . $data['nickname_usuario'] . "', fkID_rol = '" . $data["fkID_rol"] . "', fkID_cliente = '" . $data["fkID_cliente"] . "', fkID_mensajero = '" . $data["fkID_mensajero"] . "', foto_usuario = '" . $nombreFinal . "' $r WHERE id_usuario = '" . $data['id_usuario'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
