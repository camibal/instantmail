<!-- Modal -->
<?php
setlocale(LC_ALL, "es_ES");
?>
<div class="modal fade" id="modalCalificacionesScrollable" tabindex="-1" role="dialog" aria-labelledby="modalCalificacionesScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCalificacionesScrollableTitle">Informe de calificaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div id="tablaCalificaciones" class="w-100">
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" class="text-center">
                    <img src="../imagenes/logoInformes.png" class="img-fluid">
                  </th>
                  <th scope="col" class="text-center">
                    <h4>
                      <strong>
                        Informe calificaciones
                      </strong>
                    </h4>
                  </th>
                  <th scope="col" class="text-center">
                    <strong>
                        Fecha y hora impresion:<br>
                        <?php echo date('Y-m-d H:i:s'); ?>
                    </strong>
                  </th>
                </tr>
                <tr>
                  <th scope="col" class="text-center">Mensajero</th>
                  <th scope="col" class="text-center">Total de envios</th>
                  <th scope="col" class="text-center">Promedio</th>
                </tr>
                </thead>
                <tbody id="contenidoCalificaciones">
                  <?php $informes->getTablaCalificaciones('');?>
                  <tr>
                    <td scope="col" colspan="3" class="text-right"><p><small><em>Fecha y hora impresion :<?php echo date('Y-m-d H:i:s'); ?></small></em></p></td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn_imprimir_calificaciones"><i class="fas fa-print"></i></button>
        <button type="button" class="btn btn-success" id="btn_excel_calificaciones"><i class="fas fa-file-excel"></i></button>
        <button type="button" class="btn btn-danger" id="btn_pdf_calificaciones"><i class="far fa-file-pdf"></i></button>
      </div>
    </div>
  </div>
</div>
