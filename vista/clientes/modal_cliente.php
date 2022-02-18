<!-- Modal -->
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="modalClienteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-info text-white">
        <h5 class="modal-title" id="modalClienteLabel"></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_cliente" method="POST">
          <input type="hidden" id="id_cliente">
          <div class="form-group row">
            <label for="nombres_cliente" class="col-sm-3 col-form-label">Nombres:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="nombres_cliente" required="true" style="text-transform:uppercase;">
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="apellidos_cliente" class="col-sm-3 col-form-label">Apellidos:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="apellidos_cliente" required="true" style="text-transform:uppercase;">
            </div>
          </div>
          <div class="form-group row">
            <label for="rsocial_cliente" class="col-sm-3 col-form-label">Ciudad:</label>
            <div class="col-sm-7">
              <select class="form-control" id="ciudad_cliente" name="ciudad_cliente"required="true">
                <?php $clienteController->getCiudades();?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="rsocial_cliente" class="col-sm-3 col-form-label">Tipo documento:</label>
            <div class="col-sm-7">
              <select class="form-control" id="fkID_tipo_documento" name="fkID_tipo_documento"required="true">
                <?php $clienteController->getSelectTipoDocumento();?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="documento_cliente" class="col-sm-3 col-form-label">Documento:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control soloNumeros" id="documento_cliente" required="true" style="text-transform:uppercase;">
            </div>
          </div>
          <div class="form-group row">
            <label for="celular_cliente" class="col-sm-3 col-form-label">Celular:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control soloNumeros" minlength="10" maxlength="10" id="celular_cliente" required="true" style="text-transform:uppercase;">
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="direccion_cliente" class="col-sm-3 col-form-label">Dirección:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="direccion_cliente" required="true" style="text-transform:uppercase;">
            </div>
          </div>
          <div class="form-group row">
            <label for="email_cliente" class="col-sm-3 col-form-label">Email:</label>
            <div class="col-sm-7">
              <input type="email" class="form-control" id="email_cliente" required="true" style="text-transform:uppercase;">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button data-accion="crear" type="button" class="btn btn-success" id="btn_guardar_cliente">Guardar</button>
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
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Realmente desea eliminar el registro?
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="btn_cancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn_eliminar_cliente" name="btn_eliminar_cliente">Eliminar</button>
        <button class="btn btn-danger" id="btn_eliminando" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Eliminando...
        </button>
      </div>
    </div>
  </div>
</div>
