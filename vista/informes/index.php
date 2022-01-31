<?php include "scripts.php";?>
<?php include "../../controlador/informes_controller.php";?>
<?php $informes = new informesController();?>
<form>

    <div class="row p-2">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Informe envios</h5>
                    <div class="row">
                        <div class="card-text col-6">
                            Fecha inicial
                        </div>
                        <div class="card-text col-6">
                            <input type="date" id="fecha_inicial_envios">
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-text col-6">
                            Fecha final
                        </div>
                        <div class="card-text col-6">
                            <input type="date" id="fecha_final_envios">
                        </div> 
                    </div>     
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalEnviosScrollable" id="btn_generar_envios">
                            Generar informe
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Informe devoluciones</h5>
                    <div class="row">
                        <div class="card-text col-6">
                            Fecha inicial
                        </div>
                        <div class="card-text col-6">
                            <input type="date" id="fecha_inicial_devoluciones">
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-text col-6">
                            Fecha final
                        </div>
                        <div class="card-text col-6">
                            <input type="date" id="fecha_final_devoluciones">
                        </div> 
                    </div>     
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalDevolucionesScrollable" id="btn_generar_devoluciones">
                            Generar informe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Informe calificaciones</h5>
                    <div class="row">
                        <div class="card-text col-6">
                            Fecha inicial
                        </div>
                        <div class="card-text col-6">
                            <input type="date" id="fecha_inicial_calificaciones">
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-text col-6">
                            Fecha final
                        </div>
                        <div class="card-text col-6">
                            <input type="date" id="fecha_final_calificaciones">
                        </div> 
                    </div>     
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCalificacionesScrollable" id="btn_generar_calificaciones">
                            Generar informe
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Informe caja</h5>
                    <div class="row">
                        <div class="card-text col-6">
                            Fecha inicial
                        </div>
                        <div class="card-text col-6">
                            <input type="date" id="fecha_inicial_caja">
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-text col-6">
                            Fecha final
                        </div>
                        <div class="card-text col-6">
                            <input type="date" id="fecha_final_caja">
                        </div> 
                    </div>     
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCajaScrollable" id="btn_generar_caja">
                            Generar informe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>  

</form>
<?php include "modal_informe_envios.php";?>
<?php include "modal_informe_devoluciones.php";?>
<?php include "modal_informe_calificaciones.php";?>
<?php include "modal_informe_caja.php";?>