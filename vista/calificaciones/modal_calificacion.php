<!-- Modal -->
<div class="modal fade" id="modalCalificacion" tabindex="-1" role="dialog" aria-labelledby="modalCalificacionLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-info text-white">
        <h5 class="modal-title" id="modalCalificacionLabel"></h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_calificacion" method="POST">
          <input type="hidden" id="id_calificacion">
          <div class="form-group row">
            <label for="descripcion_envio" class="col-sm-1 col-form-label"></label>
            <h4 class="col-sm-10 col-form-label text-center">¿Que te parecio el servicio del envio No <b><span id="numero_envio"></span></b>, prestado por <b><span id="nombres_mensajero"></span> <span id="apellidos_mensajero"></span></b>  el dia <b><span id="fecha_envio"></span></b>?</h4>
            <label for="descripcion_envio" class="col-sm-1 col-form-label"></label>
          </div>
          <div class="form-group row">
            <input type="hidden" id="valor_calificacion" value="0">
            <label for="descripcion_envio" class="col-sm-1 col-form-label"></label>
            <div class="col-sm-10 text-center">
              <button type="button" name="btn_estrella" data-id-estrella="1" id="estrella_1" class="btn btn-secondary"><i class="fas fa-star"></i></button>&nbsp;
              <button type="button" name="btn_estrella" data-id-estrella="2" id="estrella_2" class="btn btn-secondary"><i class="fas fa-star"></i></button>&nbsp;
              <button type="button" name="btn_estrella" data-id-estrella="3" id="estrella_3" class="btn btn-secondary"><i class="fas fa-star"></i></button>&nbsp;
              <button type="button" name="btn_estrella" data-id-estrella="4" id="estrella_4" class="btn btn-secondary"><i class="fas fa-star"></i></button>&nbsp;
              <button type="button" name="btn_estrella" data-id-estrella="5" id="estrella_5" class="btn btn-secondary"><i class="fas fa-star"></i></button>&nbsp;
            </div>
            <label for="descripcion_envio" class="col-sm-1 col-form-label"></label>
          </div>
          <div class="form-group row">
            <label for="descripcion_envio" class="col-sm-1 col-form-label"></label>
            <label for="descripcion_envio" class="col-sm-3 col-form-label">Observaciones:</label>
            <div class="col-sm-7">
              <textarea class="form-control" placeholder="" id="observaciones_calificacion" style="text-transform:uppercase;"></textarea>
            </div>
            <label for="descripcion_envio" class="col-sm-1 col-form-label"></label>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button data-accion="crear" type="button" class="btn btn-success" id="btn_guardar_calificacion">Guardar</button>
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
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar calificacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Realmente desea eliminar el registro?
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="btn_cancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn_eliminar_calificacion" name="btn_eliminar_calificacion">Eliminar</button>
        <button class="btn btn-danger" id="btn_eliminando" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Eliminando...
        </button>
      </div>
    </div>
  </div>
</div>
