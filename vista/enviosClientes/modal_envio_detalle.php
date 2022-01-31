<!-- Modal -->
<?php
setlocale(LC_ALL, "es_ES");
?>
<div class="modal fade" id="modalEnvioDetalle" tabindex="-1" role="dialog" aria-labelledby="modalEnvioDetalleTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEnvioDetalleTitle">Detalle del Envio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div id="tablaAbonos">
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th scope="col" class="text-center">
                    Estado
                  </th>
                  <th scope="col" class="text-center">
                    Fecha
                  </th>
                  <th scope="col" class="text-center">
                    Cliente
                  </th>
                  <th scope="col" class="text-center">
                    Destinatario
                  </th>
                  <th scope="col" class="text-center">
                    Mensajero
                  </th>
                  <th scope="col" class="text-center">
                    Observación
                  </th>
                  <th scope="col" class="text-center">
                    Evidencia
                  </th>
                </tr>
              </thead>
                <tbody id="contenidoEnvio">
                </tbody>
              </table>
            </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_cancelar">Cerrar</button>
      </div>
    </div>
  </div>
</div>
