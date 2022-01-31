<script type="text/javascript">
    //Carga tabla de informe envios
    $("#btn_generar_envios").click(function(){
      fecha_inicial = $("#fecha_inicial_envios").val();
      fecha_final = $("#fecha_final_envios").val();
      if(fecha_inicial > fecha_final){
        alertify.alert(
          'Fecha inicial mayor a la final',
          'La fecha inicial no puede ser mayor a la final',
          function(){
            alertify.error('Fecha inicial mayor a la final');
        });
        return false;
      } else {
        carga_tabla_envios();
      }
    });

    //Funcion para cargar tabla con filtros
    function carga_tabla_envios(){
      fecha_inicial = $("#fecha_inicial_envios").val();
      fecha_final = $("#fecha_final_envios").val();

        $.ajax({
          url: "../controlador/ajaxInformes.php",
          data: 'fecha_inicial='+fecha_inicial+'&fecha_final='+fecha_final+'&tipo=informe_envios',
          dataType: 'json'
        })
        .done(function(data) {
          //---------------------
            console.log(data);
            contenido = '';
            contador = 0;
            total_valor = 0;

               $.each(data, function (ind, elem) {
                  contenido += '<tr>';
                  contenido += '<td>' +elem["numero_envio"]+'</td>';
                  contenido += '<td>' + elem["nombres_cliente"] + elem["apellidos_cliente"] + '</td>';
                  contenido += '<td>' +elem["nombre_estado_envio"]+'</td>';
                  contenido += '<td>' + elem["nombres_mensajero"] + elem["apellidos_mensajero"] + '</td>';
                  contenido += '<td>' +elem["destinatario_envio"]+'</td>';


                  //Se formatean los valores
                  valor_envio = Intl.NumberFormat("de-DE").format(elem["valor_envio"]);

                  //Suma los totales
                  total_valor = parseInt(total_valor) + parseInt(elem["valor_envio"]);

                  contenido += '<td class="text-right">' + valor_envio +'</td>';
                  contenido += '</tr>';
                  contador++;
        });
                  contenido += '<tr>';
                  contenido += '<td scope="col" colspan="5"><p class="text-right"><b>Total</b></p></td>';

                  //Se formatean los valores
                  total_valor = Intl.NumberFormat("de-DE").format(total_valor);

                  contenido += '<td class="text-right"><span><b>'+ total_valor +'</b></span></td>';
                  contenido += '</tr>';
          $("#contenidoEnvios").html(contenido);
        })
        .fail(function(data) {
          $("#contenidoEnvios").html('No existen envios.');
        })
        .always(function(data) {
          console.log(data);
        });
    }

    //Funcion para imprimir
    $("#btn_imprimir_envios").click(function(){
      printDiv('tablaEnvios');
      return false;
    });

    //Funcion para imprimir
    function printDiv(nombreDiv) {
      var ficha = document.getElementById(nombreDiv);
      var ventimp = window.open(' ', 'popimpr');
      ventimp.document.write(ficha.innerHTML);
      ventimp.document.close();
      ventimp.print( );
      ventimp.close()
    }

    //Funcion para exportar a excel
    $("#btn_excel_envios").click(function(){
      fecha_inicial_envios = $("#fecha_inicial_envios").val();
      fecha_final_envios = $("#fecha_final_envios").val();

      window.location = '../vista/informes/excel_informe_envios.php?fecha_inicial_envios='+fecha_inicial_envios+'&fecha_final_envios='+fecha_final_envios+'&tipo=informe_envios';
        return false;
    });

    //Funcion para exportar a PDF
    $("#btn_pdf_envios").click(function(){
      fecha_inicial_envios = $("#fecha_inicial_envios").val();
      fecha_final_envios = $("#fecha_final_envios").val();
      
      window.location = '../vista/informes/pdf_informe_envios.php?fecha_inicial_envios='+fecha_inicial_envios+'&fecha_final_envios='+fecha_final_envios+'&tipo=informe_envios';
        return false;
    });

    //Carga tabla de informe devoluciones
    $("#btn_generar_devoluciones").click(function(){
      fecha_inicial = $("#fecha_inicial_devoluciones").val();
      fecha_final = $("#fecha_final_devoluciones").val();
      if(fecha_inicial > fecha_final){
        alertify.alert(
          'Fecha inicial mayor a la final',
          'La fecha inicial no puede ser mayor a la final',
          function(){
            alertify.error('Fecha inicial mayor a la final');
        });
        return false;
      } else {
        carga_tabla_devoluciones();
      }
    });

    //Funcion para cargar tabla con filtros
    function carga_tabla_devoluciones(){
      fecha_inicial = $("#fecha_inicial_devoluciones").val();
      fecha_final = $("#fecha_final_devoluciones").val();

        $.ajax({
          url: "../controlador/ajaxInformes.php",
          data: 'fecha_inicial='+fecha_inicial+'&fecha_final='+fecha_final+'&tipo=informe_devoluciones',
          dataType: 'json'
        })
        .done(function(data) {
          //---------------------
            contenido = '';
            contador = 0;
            total_valor = 0;

               $.each(data, function (ind, elem) {
                  contenido += '<tr>';
                  contenido += '<td>' +elem["numero_envio"]+'</td>';
                  contenido += '<td>' + elem["nombres_cliente"] + elem["apellidos_cliente"] + '</td>';
                  contenido += '<td>' +elem["nombre_estado_envio"]+'</td>';
                  contenido += '<td>' +elem["fecha_envio"]+'</td>';
                  contenido += '<td>' + elem["nombres_mensajero"] + elem["apellidos_mensajero"] + '</td>';
                  contenido += '<td>' +elem["destinatario_envio"]+'</td>';


                  //Se formatean los valores
                  valor_envio = Intl.NumberFormat("de-DE").format(elem["valor_envio"]);

                  //Suma los totales
                  total_valor = parseInt(total_valor) + parseInt(elem["valor_envio"]);

                  contenido += '<td class="text-right">' + valor_envio +'</td>';
                  contenido += '</tr>';
                  contador++;
        });
                  contenido += '<tr>';
                  contenido += '<td scope="col" colspan="6"><p class="text-right"><b>Total</b></p></td>';

                  //Se formatean los valores
                  total_valor = Intl.NumberFormat("de-DE").format(total_valor);

                  contenido += '<td class="text-right"><span><b>'+ total_valor +'</b></span></td>';
                  contenido += '</tr>';
          $("#contenidoDevoluciones").html(contenido);
        })
        .fail(function(data) {
          $("#contenidoEnvios").html('No existen envios.');
        })
        .always(function(data) {
          console.log(data);
        });
    }

    //Funcion para imprimir
    $("#btn_imprimir_devoluciones").click(function(){
      printDiv('tablaDevoluciones');
      return false;
    });

    //Funcion para exportar a excel
    $("#btn_excel_devoluciones").click(function(){
      fecha_inicial_devoluciones = $("#fecha_inicial_devoluciones").val();
      fecha_final_devoluciones = $("#fecha_final_devoluciones").val();

      window.location = '../vista/informes/excel_informe_devoluciones.php?fecha_inicial_devoluciones='+fecha_inicial_devoluciones+'&fecha_final_devoluciones='+fecha_final_devoluciones+'&tipo=informe_devoluciones';
        return false;
    });

    //Funcion para exportar a PDF
    $("#btn_pdf_devoluciones").click(function(){
      fecha_inicial_devoluciones = $("#fecha_inicial_devoluciones").val();
      fecha_final_devoluciones = $("#fecha_final_devoluciones").val();
      
      window.location = '../vista/informes/pdf_informe_devoluciones.php?fecha_inicial_devoluciones='+fecha_inicial_devoluciones+'&fecha_final_devoluciones='+fecha_final_devoluciones+'&tipo=informe_devoluciones';
        return false;
    });

    //Carga tabla de informe calificaciones
    $("#btn_generar_calificaciones").click(function(){
      fecha_inicial = $("#fecha_inicial_calificaciones").val();
      fecha_final = $("#fecha_final_calificaciones").val();
      if(fecha_inicial > fecha_final){
        alertify.alert(
          'Fecha inicial mayor a la final',
          'La fecha inicial no puede ser mayor a la final',
          function(){
            alertify.error('Fecha inicial mayor a la final');
        });
        return false;
      } else {
        carga_tabla_calificaciones();
      }
    });

    //Funcion para cargar tabla con filtros
    function carga_tabla_calificaciones(){
      fecha_inicial = $("#fecha_inicial_calificaciones").val();
      fecha_final = $("#fecha_final_calificaciones").val();

        $.ajax({
          url: "../controlador/ajaxInformes.php",
          data: 'fecha_inicial='+fecha_inicial+'&fecha_final='+fecha_final+'&tipo=informe_calificaciones',
          dataType: 'json'
        })
        .done(function(data) {
          //---------------------
            console.log(data);
            contenido = '';
            contador = 0;
            total_valor = 0;

               $.each(data, function (ind, elem) {
                  contenido += '<tr>';
                  contenido += '<td class="text-center">' + elem["nombres_mensajero"] + elem["apellidos_mensajero"] + '</td>';
                  contenido += '<td class="text-center">' + elem["cantidad"] + '</td>';
                  contenido += '<td class="text-center">' + estrellas(elem["promedio"]) +'</td>';
                  contenido += '</tr>';
                  contador++;
        });
          $("#contenidoCalificaciones").html(contenido);
        })
        .fail(function(data) {
          $("#contenidoCalificaciones").html('No existen calificaciones.');
        })
        .always(function(data) {
          console.log(data);
        });
    }

    //Funcion para estrellas
    function estrellas(cantidad){
        var estrellas = "";
        var clase = "";
        for (i=1; i <= 5; i++) { 
            if(i <= cantidad){
                clase = "btn btn-warning";
            } else {
                clase = "btn btn-secondary";
            }
            estrellas = estrellas + '<button type="button" class="' + clase +'"><i class="fas fa-star"></i></button>&nbsp;';
        }
        return estrellas;
    }

    //Funcion para imprimir
    $("#btn_imprimir_calificaciones").click(function(){
      printDiv('tablaCalificaciones');
      return false;
    });

    //Funcion para exportar a excel
    $("#btn_excel_calificaciones").click(function(){
      fecha_inicial_calificaciones = $("#fecha_inicial_calificaciones").val();
      fecha_final_calificaciones = $("#fecha_final_calificaciones").val();

      window.location = '../vista/informes/excel_informe_calificaciones.php?fecha_inicial_calificaciones='+fecha_inicial_calificaciones+'&fecha_final_calificaciones='+fecha_final_calificaciones+'&tipo=informe_calificaciones';
        return false;
    });

    //Funcion para exportar a PDF
    $("#btn_pdf_calificaciones").click(function(){
      fecha_inicial_calificaciones = $("#fecha_inicial_calificaciones").val();
      fecha_final_calificaciones = $("#fecha_final_calificaciones").val();
      
      window.location = '../vista/informes/pdf_informe_calificaciones.php?fecha_inicial_calificaciones='+fecha_inicial_envios+'&fecha_final_calificaciones='+fecha_final_calificaciones+'&tipo=informe_calificaciones';
        return false;
    });

    //Carga tabla de informe caja
    $("#btn_generar_caja").click(function(){
      fecha_inicial = $("#fecha_inicial_caja").val();
      fecha_final = $("#fecha_final_caja").val();
      if(fecha_inicial > fecha_final){
        alertify.alert(
          'Fecha inicial mayor a la final',
          'La fecha inicial no puede ser mayor a la final',
          function(){
            alertify.error('Fecha inicial mayor a la final');
        });
        return false;
      } else {
        carga_tabla_caja();
      }
    });

    //Funcion para cargar tabla con filtros
    function carga_tabla_caja(){
      fecha_inicial = $("#fecha_inicial_caja").val();
      fecha_final = $("#fecha_final_caja").val();

        $.ajax({
          url: "../controlador/ajaxInformes.php",
          data: 'fecha_inicial='+fecha_inicial+'&fecha_final='+fecha_final+'&tipo=informe_caja',
          dataType: 'json'
        })
        .done(function(data) {
          //---------------------
            console.log(data);
            contenido = '';
            contador = 0;
            total_valor = 0;

               $.each(data, function (ind, elem) {
                  contenido += '<tr>';
                  contenido += '<td>' + elem["fecha_movimiento"] + '</td>';
                  contenido += '<td>' + elem["nombre_tipo_movimiento"] + '</td>';
                  contenido += '<td>' + elem["observaciones_movimiento"] + '</td>';

                  //Se formatean los valores
                  valor_movimiento = Intl.NumberFormat("de-DE").format(elem["valor_movimiento"]);

                  //Suma los totales
                  if(elem["fkID_tipo_movimiento"] == 2){
                    total_valor = parseInt(total_valor) - parseInt(elem["valor_movimiento"]);
                  } else {
                    total_valor = parseInt(total_valor) + parseInt(elem["valor_movimiento"]);
                  }                  

                  contenido += '<td class="text-right">' + valor_movimiento +'</td>';
                  contenido += '</tr>';
                  contador++;
        });
                  contenido += '<tr>';
                  contenido += '<td scope="col" colspan="3"><p class="text-right"><b>Saldo en caja</b></p></td>';

                  //Se formatean los valores
                  total_valor = Intl.NumberFormat("de-DE").format(total_valor);

                  contenido += '<td class="text-right"><span><b>'+ total_valor +'</b></span></td>';
                  contenido += '</tr>';
          $("#contenidoCaja").html(contenido);
        })
        .fail(function(data) {
          $("#contenidoCaja").html('No existen envios.');
        })
        .always(function(data) {
          console.log(data);
        });
    }

    //Funcion para imprimir
    $("#btn_imprimir_caja").click(function(){
      printDiv('tablaCaja');
      return false;
    });

    //Funcion para exportar a excel
    $("#btn_excel_caja").click(function(){
      fecha_inicial_caja = $("#fecha_inicial_caja").val();
      fecha_final_caja = $("#fecha_final_caja").val();

      window.location = '../vista/informes/excel_informe_caja.php?fecha_inicial_caja='+fecha_inicial_caja+'&fecha_final_caja='+fecha_final_caja+'&tipo=informe_caja';
        return false;
    });

    //Funcion para exportar a PDF
    $("#btn_pdf_caja").click(function(){
      fecha_inicial_caja = $("#fecha_inicial_caja").val();
      fecha_final_caja = $("#fecha_final_caja").val();
      
      window.location = '../vista/informes/pdf_informe_caja.php?fecha_inicial_caja='+fecha_inicial_caja+'&fecha_final_caja='+fecha_final_caja+'&tipo=informe_caja';
        return false;
    });
</script>