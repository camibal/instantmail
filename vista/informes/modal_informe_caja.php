<!-- Modal -->
<?php
setlocale(LC_ALL, "es_ES");
?>
<div class="modal fade" id="modalCajaScrollable" tabindex="-1" role="dialog" aria-labelledby="modalCajaScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCajaScrollableTitle">Informe de caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div id="tablaCaja" class="w-100">
            <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" class="text-center">
                    <img src="../imagenes/logoInformes.png" class="img-fluid">
                  </th>
                  <th scope="col" colspan="2" class="text-center">
                    <h4>
                      <strong>
                        Informe caja
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
                  <th scope="col" class="text-center">Fecha</th>
                  <th scope="col" class="text-center">Tipo movimiento</th>
                  <th scope="col" class="text-center">Observaciones</th>
                  <th scope="col" class="text-center">Valor</th>                  
                </tr>
                </thead>
                <tbody id="contenidoCaja">
                  <?php $informes->getTablaCaja('');?>
                  <tr>
                    <td scope="col" colspan="4" class="text-right"><p><small><em>Fecha y hora impresion :<?php echo date('Y-m-d H:i:s'); ?></small></em></p></td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn_imprimir_caja"><i class="fas fa-print"></i></button>
        <button type="button" class="btn btn-success" id="btn_excel_caja"><i class="fas fa-file-excel"></i></button>
        <button type="button" class="btn btn-danger" id="btn_pdf_caja"><i class="far fa-file-pdf"></i></button>
      </div>
    </div>
  </div>
</div>
