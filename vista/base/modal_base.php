<!-- Modal -->
<div class="modal fade" id="modalBase" tabindex="-1" role="dialog" aria-labelledby="modalBaseLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-info text-white">
        <h5 class="modal-title" id="modalBaseLabel"></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_base" method="POST">
          <input type="hidden" id="id_movimiento">
          <div class="form-group row">
            <label for="fecha_movimiento" class="col-sm-3 col-form-label">Fecha:</label>
            <div class="col-sm-7">
              <input type="date" class="form-control" id="fecha_movimiento" required="true" style="text-transform:uppercase;" value="<?php echo date('Y-m-d'); ?>" disabled>
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="fkID_tipo_movimiento" class="col-sm-3 col-form-label">Tipo movimiento:</label>
            <div class="col-sm-7">
              <select class="form-control" id="fkID_tipo_movimiento" name="fkID_tipo_movimiento"required="true">
                <?php $baseController->getSelectTipoMovimiento();?>
              </select>
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="valor_movimiento" class="col-sm-3 col-form-label">Valor:</label>
            <div class="col-sm-7">
              <input type="number" class="form-control" id="valor_movimiento" required="true">
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="descripcion_envio" class="col-sm-3 col-form-label">Observaciones:</label>
            <div class="col-sm-7">
              <textarea class="form-control" placeholder="" id="observaciones_movimiento" style="text-transform:uppercase;"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button data-accion="crear" type="button" class="btn btn-success" id="btn_guardar_base">Guardar</button>
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
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar base</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Realmente desea eliminar el registro?
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="btn_cancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn_eliminar_base" name="btn_eliminar_base">Eliminar</button>
        <button class="btn btn-danger" id="btn_eliminando" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Eliminando...
        </button>
      </div>
    </div>
  </div>
</div>
