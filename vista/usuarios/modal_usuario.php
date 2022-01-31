<!-- Modal -->
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-info text-white text-center">
        <h5 class="modal-title" id="modalUsuarioLabel">Crear Usuario</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_usuario" enctype="multipart/form-data">
          <input type="hidden" name="id_usuario" id="id_usuario">
          <input type="hidden" name="pass_antiguo" id="pass_antiguo">
          <input type="hidden" name="foto_usuario">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nombres:</label>
            <div class="col-sm-7">
              <input class="form-control" type="text" id="nombres_usuario" name="nombres_usuario" required="true">
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Apellidos:</label>
            <div class="col-sm-7">
              <input class="form-control" type="text" id="apellidos_usuario" name="apellidos_usuario">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Tipo documento:</label>
            <div class="col-sm-7">
              <select class="form-control" id="fkID_tipo_documento" name="fkID_tipo_documento"required="true">
                <?php $usuarioController->getSelectTipoDocumento();?>
              </select>
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">No documento:</label>
            <div class="col-sm-7">
              <input class="form-control" type="text" id="documento_usuario" name="documento_usuario" required="true">
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nickname:</label>
            <div class="col-sm-7">
              <input class="form-control" type="text" id="nickname_usuario" name="nickname_usuario" required="true">
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Password:</label>
            <div class="col-sm-7">
              <input class="form-control" type="Password" id="pass_usuario" name="pass_usuario" required="true">
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Rol:</label>
            <div class="col-sm-7">
              <select class="form-control" id="fkID_rol" name="fkID_rol" required="true">
                <?php $usuarioController->getSelectRol();?>
              </select>
            </div>
            <div class="col-sm-2 text-danger">
              *
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Cliente:</label>
            <div class="col-sm-7">
              <select class="form-control" id="fkID_cliente" name="fkID_cliente">
                <?php $usuarioController->getSelectCliente();?>
              </select>
            </div>
            <div class="col-sm-2 text-danger" id="requerido_cliente">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Mensajero:</label>
            <div class="col-sm-7">
              <select class="form-control" id="fkID_mensajero" name="fkID_mensajero">
                <?php $usuarioController->getSelectMensajero();?>
              </select>
            </div>
            <div class="col-sm-2 text-danger" id="requerido_mensajero">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Foto:</label>
            <div class="col-sm-7">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="archivo" name="archivo" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Subir...</label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center" id="foto">

            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button data-accion="crear" type="button" class="btn btn-success" id="btn_guardar_usuario">Guardar</button>
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
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Realmente desea eliminar el registro?
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="btn_cancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn_eliminar_usuario" name="btn_eliminar_usuario">Eliminar</button>
        <button class="btn btn-danger" id="btn_eliminando" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Eliminando...
        </button>
      </div>
    </div>
  </div>
</div>
