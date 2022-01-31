<?php
include dirname(__file__, 2) . '/modelo/informes.php';

class informesController extends informes
{

    public function __construct()
    {
        # code...
    }

    //Tabla envios
    public function getTablaEnvios($where)
    {
        //Instancia del informes
        $informes = new informes();
        //Lista del menu Nivel 1
        $listaEnvios = $informes->getEnvios($where);
        //Se recorre array de nivel 1
        if (isset($listaEnvios)) {
            for ($i = 0; $i < sizeof($listaEnvios); $i++) {
                echo '<tr>';
                echo '<td>' . $listaEnvios[$i]["numero_envio"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["nombres_cliente"] . ' ' . $listaEnvios[$i]["apellidos_cliente"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["nombre_estado_envio"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["nombres_mensajero"] . ' ' . $listaEnvios[$i]["apellidos_mensajero"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["destinatario_envio"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["valor_envio"] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="10">No existen envios</td>';
            echo '</tr>';
        }
    }

    //Tabla envios devoluciones
    public function getTablaDevoluciones($where)
    {
        //Instancia del informes
        $informes = new informes();
        //Lista del menu Nivel 1
        $listaEnvios = $informes->getEnviosDevoluciones($where);
        //Se recorre array de nivel 1
        if (isset($listaEnvios)) {
            for ($i = 0; $i < sizeof($listaEnvios); $i++) {
                echo '<tr>';
                echo '<td>' . $listaEnvios[$i]["numero_envio"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["nombres_cliente"] . ' ' . $listaEnvios[$i]["apellidos_cliente"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["nombre_estado_envio"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["fecha_envio"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["nombres_mensajero"] . ' ' . $listaEnvios[$i]["apellidos_mensajero"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["destinatario_envio"] . '</td>';
                echo '<td>' . $listaEnvios[$i]["valor_envio"] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="10">No existen devoluciones</td>';
            echo '</tr>';
        }
    }

    //Tabla envios calificaciones
    public function getTablaCalificaciones($where)
    {
        //Instancia del informes
        $informes = new informes();
        //Lista del menu Nivel 1
        $listaCalificaciones = $informes->getCalificaciones($where);
        //Se recorre array de nivel 1
        if (isset($listaCalificaciones)) {
            for ($i = 0; $i < sizeof($listaCalificaciones); $i++) {
                echo '<tr>';
                echo '<td class="text-center">' . $listaCalificaciones[$i]["nombres_mensajero"] . ' ' . $listaCalificaciones[$i]["apellidos_mensajero"] . '</td>';
                echo '<td class="text-center">' . $listaCalificaciones[$i]["cantidad"] . '</td>';
                echo '<td class="text-center">' . $this->estrellas($listaCalificaciones[$i]["promedio"]) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="10">No existen calificaciones</td>';
            echo '</tr>';
        }
    }

    //Tabla caja
    public function getTablaCaja($where)
    {
        //Instancia del informes
        $informes = new informes();
        //Lista del menu Nivel 1
        $listaCaja = $informes->getCaja($where);
        //Se recorre array de nivel 1
        if (isset($listaCaja)) {
            for ($i = 0; $i < sizeof($listaCaja); $i++) {
                echo '<tr>';
                echo '<td>' . $listaCaja[$i]["fecha_movimiento"] . '</td>';
                echo '<td>' . $listaCaja[$i]["nombre_tipo_movimiento"] . '</td>';
                echo '<td class="text-right">' . number_format($listaCaja[$i]["valor_movimiento"],0,'.','.') . '</td>';
                echo '<td>' . $listaCaja[$i]["observaciones_movimiento"] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="10">No existen calificaciones</td>';
            echo '</tr>';
        }
    }

    //Funcion para estrellas
    public function estrellas($cantidad){
        $estrellas = "";
        for ($i=1; $i <= 5; $i++) { 
            if($i <= $cantidad){
                $clase = "btn btn-warning";
            } else {
                $clase = "btn btn-secondary";
            }
            $estrellas = $estrellas.'<button type="button" name="btn_estrella" class="'.$clase.'"><i class="fas fa-star"></i></button>&nbsp;';
        }
        return $estrellas;
    }
}
