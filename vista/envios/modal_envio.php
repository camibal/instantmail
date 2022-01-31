<!-- Modal -->
<div class="modal fade" id="modalEnvio" tabindex="-1" role="dialog" aria-labelledby="modalEnvioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-info text-white">
        <h5 class="modal-title" id="modalEnvioLabel">Crear envio</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_envio" method="POST">
          <input type="hidden" id="id_envio">
          <div class="form-group row">
            <label for="numero_envio" class="col-sm-3 col-form-label">Número guia:</label>
            <div class="col-sm-7">
              <input type="number" class="form-control" id="numero_envio" required="true" style="text-transform:uppercase;">
            </div>
            <div class="col-sm-1 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="fecha_envio" class="col-sm-3 col-form-label">Fecha:</label>
            <div class="col-sm-7">
              <input type="date" class="form-control" id="fecha_envio" required="true" style="text-transform:uppercase;" value="<?php echo date('Y-m-d'); ?>" disabled>
            </div>
            <div class="col-sm-1 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="fkID_estado_envio" class="col-sm-3 col-form-label">Estado:</label>
            <div class="col-sm-7">
              <select class="form-control" id="fkID_estado_envio" required="true">
                <?php $enviosController->getSelectEstadoEnvio();?>
              </select>
            </div>
            <div class="col-sm-1 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="fkID_cliente" class="col-sm-3 col-form-label">Cliente:</label>
            <div class="col-sm-7">
              <select class="form-control" id="fkID_cliente" name="fkID_cliente" required="true">
                <?php $enviosController->getSelectCliente();?>
              </select>
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="fkID_mensajero" class="col-sm-3 col-form-label">Mensajero:</label>
            <div class="col-sm-7">
              <select class="form-control" id="fkID_mensajero" name="fkID_mensajero" required="true">
                <?php $enviosController->getSelectMensajero();?>
              </select>
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="destinatario_envio" class="col-sm-3 col-form-label">Destinatario:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="destinatario_envio" required="true">
            </div>
            <div class="col-sm-1 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="celular_envio" class="col-sm-3 col-form-label">Celular:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="celular_envio" required="true">
            </div>
            <div class="col-sm-1 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="direccion_envio" class="col-sm-3 col-form-label">Dirección:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="direccion_envio" required="true">
            </div>
            <div class="col-sm-1 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="email_envio" class="col-sm-3 col-form-label">Email:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="email_envio" required="true">
            </div>
          </div>
          <div class="form-group row">
            <label for="valor_envio" class="col-sm-3 col-form-label">Valor:</label>
            <div class="col-sm-7">
              <input type="number" class="form-control" id="valor_envio" required="true">
            </div>
            <div class="col-sm-1 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="descripcion_envio" class="col-sm-3 col-form-label">Observaciones:</label>
            <div class="col-sm-7">
              <textarea class="form-control" placeholder="" id="observaciones_envio" style="text-transform:uppercase;"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button data-accion="crear" type="submit" class="btn btn-success" id="btn_guardar_envio">Guardar</button>
              <button class="btn btn-success" id="btn_guardando" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Guardando...
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar envio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Realmente desea eliminar el registro?
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="btn_cancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn_eliminar_envio" name="btn_eliminar_envio">Eliminar</button>
        <button class="btn btn-danger" id="btn_eliminando" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Eliminando...
        </button>
      </div>
    </div>
  </div>
</div>