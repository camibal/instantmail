<script type="text/javascript">
    //Funcion para el Datatable
    $(document).ready(function () {
        $('#tablaEnvios').DataTable(
            {
                "pagingType": "full_numbers",
                "lengthMenu": [[ 10, 25, 50, -1], [ 10, 25, 50, "Todos"]],
                "language": {
                    "lengthMenu":     "Mostrando _MENU_ registros",
                    "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                    "search":         "Buscar:",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "zeroRecords": "No hay registros que coincidan.",
                    "infoEmpty": "No se encuentran registros.",
                    "infoFiltered":   "(Filtrando _MAX_ registros en total)",
                    "paginate": {
                        "first":      "<--",
                        "last":       "-->",
                        "next":       ">",
                        "previous":   "<"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                },
                "order": []
            }
        );
    });

    //Funcion boton crear envio
    $("#btn_crear_envio").click(function(){
        $("#modalEnvioLabel").text("Crear envio");
        $("#btn_guardar_envio").attr("data-accion","crear");
        $("#form_envio")[0].reset();
        $("#btn_guardando").hide();
        limpiar_campos();
        $("#fkID_estado_envio").val(1);
        $("#fkID_estado_envio").attr("disabled","true");
    });

    //Funcion guardar envio
    $("#btn_guardar_envio").click(function(){
      resultado = campos_incompletos();
      if(resultado == true){
        accion = $(this).attr('data-accion');
        if(accion == 'crear'){
          crea_envio();
          return false;
        }
        if(accion == 'editar'){
          edita_envio();
          return false;
        }
      }
    });

    //Campos incompletos
    function campos_incompletos(){
      var bandera = true;
      if($("#numero_envio").val() == ""){
        bandera = false;
        marcar_campos("#numero_envio", 'incorrecto');
      } else {
        marcar_campos("#numero_envio", 'correcto');
      }
      if($('#fecha_envio').val() == ""){
        bandera = false;
        marcar_campos("#fecha_envio", 'incorrecto');
      } else {
        marcar_campos("#fecha_envio", 'correcto');
      }
      if($('#fkID_estado_envio').val().trim() == 0){
        bandera = false;
        marcar_campos("#fkID_estado_envio", 'incorrecto');
      } else {
        marcar_campos("#fkID_estado_envio", 'correcto');
      }
      if($("#fkID_cliente").val().trim() == 0){
        bandera = false;
        marcar_campos("#fkID_cliente", 'incorrecto');
      } else {
        marcar_campos("#fkID_cliente", 'correcto');
      }
      if($("#destinatario_envio").val() == ""){
        bandera = false;
        marcar_campos("#destinatario_envio", 'incorrecto');
      } else {
        marcar_campos("#destinatario_envio", 'correcto');
      }
      if($("#celular_envio").val() == ""){
        bandera = false;
        marcar_campos("#celular_envio", 'incorrecto');
      } else {
        marcar_campos("#celular_envio", 'correcto');
      }
      if($("#direccion_envio").val() == ""){
        bandera = false;
        marcar_campos("#direccion_envio", 'incorrecto');
      } else {
        marcar_campos("#direccion_envio", 'correcto');
      }
      if($("#valor_envio").val().length == 0){
        bandera = false;
        marcar_campos("#valor_envio", 'incorrecto');
      } else {
        marcar_campos("#valor_envio", 'correcto');
      }
      if(bandera == false){
        alertify.alert(
          'Campos incompletos',
          'Los campos con * son obligatorios',
          function(){
            alertify.error('Campos vacios');
        });
        return false;
      } else {
        return true;
      }
    }

  //Funcion para marcar los campos
  function marcar_campos(campo, tipo){
    if(tipo == 'correcto'){
      $(campo).removeClass('is-invalid');
      $(campo).addClass('is-valid');
    }
    if(tipo == 'incorrecto'){
      $(campo).removeClass('is-valid');
      $(campo).addClass('is-invalid');
    }
  }

    //Funcion para guardar el envio
    function crea_envio(){
        numero_envio = $("#numero_envio").val();
        fecha_envio = $("#fecha_envio").val();
        fkID_estado_envio = $("#fkID_estado_envio").val();
        fkID_cliente = $("#fkID_cliente").val();
        destinatario_envio = $("#destinatario_envio").val();
        celular_envio = $("#celular_envio").val();
        direccion_envio = $("#direccion_envio").val();
        email_envio = $("#email_envio").val();
        valor_envio = $("#valor_envio").val();
        observaciones_envio = $("#observaciones_envio").val();
        fkID_mensajero = $("#fkID_mensajero").val();

        $.ajax({
          url: "../controlador/ajaxEnvio.php",
          data: 'numero_envio='+numero_envio+'&fecha_envio='+fecha_envio+'&fkID_estado_envio='+fkID_estado_envio+'&fkID_cliente='+fkID_cliente+'&destinatario_envio='+destinatario_envio+'&celular_envio='+celular_envio+'&direccion_envio='+direccion_envio+'&email_envio='+email_envio+'&valor_envio='+valor_envio+'&observaciones_envio='+observaciones_envio+'&fkID_mensajero='+fkID_mensajero+'&tipo=inserta'
        })
        .done(function(data) {
          //---------------------
          $("#btn_guardar_envio").hide();
          $("#btn_guardando").show();
          alertify.success('Creado correctamente');
          setTimeout('cargar_sitio()',1000);
        })
        .fail(function(data) {
          console.log(data);
        })
        .always(function(data) {
          console.log(data);
        });
    }

    //Funcion para cargar sitio
    function cargar_sitio(){
        $("#modalEnvio").removeClass("show");
        $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove();//eliminamos el backdrop del modal
        $('#tabla').load('envios/index.php');
    }

    //Carga eventos
    carga_eventos();

    //Carga el envio por el ID
    function carga_envio(id_envio){

        console.log("Carga el envio "+ id_envio);

        $.ajax({
            url: "../controlador/ajaxEnvio.php",
            data: "id_envio="+id_envio+"&tipo=consulta",
            dataType: 'json'
        })
        .done(function(data) {

            $.each(data[0], function( key, value ) {
              console.log(key+"--"+value);
              $("#"+key).val(value);
            });

            id_envio = data.id_envio;
        })
        .fail(function(data) {
            console.log(data);
        })
        .always(function(data) {
            console.log(data);
        });
    };

    //Funcion para guardar el envio
    function edita_envio(){
        id_envio = $("#id_envio").val();
        numero_envio = $("#numero_envio").val();
        fecha_envio = $("#fecha_envio").val();
        fkID_estado_envio = $("#fkID_estado_envio").val();
        fkID_cliente = $("#fkID_cliente").val();
        destinatario_envio = $("#destinatario_envio").val();
        celular_envio = $("#celular_envio").val();
        direccion_envio = $("#direccion_envio").val();
        email_envio = $("#email_envio").val();
        valor_envio = $("#valor_envio").val();
        observaciones_envio = $("#observaciones_envio").val();
        fkID_mensajero = $("#fkID_mensajero").val();

        $.ajax({
          url: "../controlador/ajaxEnvio.php",
          data: 'id_envio='+id_envio+'&numero_envio='+numero_envio+'&fecha_envio='+fecha_envio+'&fkID_estado_envio='+fkID_estado_envio+'&fkID_cliente='+fkID_cliente+'&destinatario_envio='+destinatario_envio+'&celular_envio='+celular_envio+'&direccion_envio='+direccion_envio+'&email_envio='+email_envio+'&valor_envio='+valor_envio+'&observaciones_envio='+observaciones_envio+'&fkID_mensajero='+fkID_mensajero+'&tipo=edita'
        })
        .done(function(data) {
          //---------------------
          $("#btn_guardar_envio").hide();
          $("#btn_guardando").show();
          alertify.success('Editado correctamente');
          setTimeout('cargar_sitio()',1000);
        })
        .fail(function(data) {
          console.log(data);
        })
        .always(function(data) {
          console.log(data);
        });
    }


    //Funcion para eliminar el envio
    function elimina_envio(id_persona){
        $.ajax({
          url: "../controlador/ajaxEnvio.php",
          data: 'id_envio='+id_envio+'&tipo=elimina_logico'
        })
        .done(function(data) {
          //---------------------
          $("#btn_eliminar_envio").hide();
          $("#btn_cancelar").hide();
          $("#btn_eliminando").show();
          alertify.success('Eliminado correctamente');
          setTimeout('cargar_sitio()',1000);
        })
        .fail(function(data) {
          console.log(data);
        })
         always(function(data) {
          console.log(data);
        });
    }

    //Funcion editar
    function evento_editar(){
        //Funcion guardar equipo
        $("[name*='btn_editar']").click(function(){
            id_envio = $(this).attr('data-id-envio');
            $("#modalEnvioLabel").text("Editar envio");
            carga_envio(id_envio);
            $("#btn_guardar_envio").attr("data-accion","editar");
            $("#btn_guardando").hide();
            limpiar_campos();
            $("#fkID_estado_envio").removeAttr("disabled","true");
            $("#numero_envio").attr("disabled","true");
        });
    }

    //Funcion eliminar
    function evento_eliminar(){
        //Funcion eliminar equipo
        $("[name*='btn_eliminar']").click(function(){
            id_envio = $(this).attr('data-id-envio');
            $("#btn_eliminar_envio").attr("data-id-envio",id_envio);
            $("#btn_eliminando").hide();
        });

        //Funcion eliminar envio
        $("[name*='btn_eliminar_envio']").click(function(){
            id_envio = $(this).attr('data-id-envio');
            elimina_envio(id_envio);
        });
    }

    //Funcion para pasar eventos
    function carga_eventos(){
        evento_editar();
        evento_eliminar();
        evento_paginar();
    }

  //Funcion para paginar
  function evento_paginar(){
    //Funcion para pasar eventos
      $(".paginate_button ").click(function(){
          carga_eventos();
      });

    //Funcion para pasar eventos
      $("[type*='search']").keypress(function(){
          carga_eventos();
      });
  }

  //Funcion para limpiar campos
  function limpiar_campos(){
    $("input").removeClass('is-invalid');
    $("input").removeClass('is-valid');
    $("select").removeClass('is-invalid');
    $("select").removeClass('is-valid');
  }

  //Funcion para cargar el detllae
  $("[name*='btn_detalles']").click(function(){
      id_envio = $(this).attr('data-id-envio');
      carga_detalle(id_envio);
  });

    //Funcion para cargar detalle
    function carga_detalle(id_envio){
      $.ajax({
        url: "../controlador/ajaxEnvio.php",
        data: 'id_envio='+id_envio+'&tipo=detalle',
        dataType: 'json'
      })
      .done(function(data) {
        //---------------------
        console.log(data);
        contenido = '';
        nombres_mensajero = '';
        apellidos_mensajero = '';
        evidencia_historial = '';

        $.each(data, function (ind, elem) {
          if(elem["nombres_mensajero"] !== null){
            nombres_mensajero = elem["nombres_mensajero"];
          } else {
            nombres_mensajero = '';
          }
          if(elem["apellidos_mensajero"] !== null){
            apellidos_mensajero = elem["apellidos_mensajero"];
          } else {
            apellidos_mensajero = '';
          }
          if(elem["evidencia_historial"] !== ""){
            evidencia_historial = '<button type="button" class="btn btn-success"><a href="../subidas/' + elem["evidencia_historial"] + '" target="_blank"><i class="far fa-arrow-alt-circle-down"></i></a></button>';
          } else {
            evidencia_historial = '';
          }
          contenido += '<tr>';
          contenido += '<td class="text-center">' + elem["nombre_estado_envio"]+'</td>';
          contenido += '<td class="text-center">' + elem["fecha_historial"]+'</td>';
          contenido += '<td class="text-center">' + elem["nombres_cliente"] + ' ' + elem["apellidos_cliente"] +'</td>';
          contenido += '<td class="text-center">' + elem["direccion_historial"]+' - ' + elem["destinatario_historial"] + ' - (' + elem["celular_historial"] + ')</td>';
          contenido += '<td class="text-center">' + nombres_mensajero + ' ' + apellidos_mensajero +'</td>';
          contenido += '<td class="text-center">' + elem["observaciones_historial"]+'</td>';
          contenido += '<td class="text-center">' + evidencia_historial + '</td>';
          contenido += '</tr>';
        });
        $("#contenidoEnvio").html(contenido);
      })
      .fail(function(data) {
        $("#contenidoEnvio").html('No existen ventas.');
      })
      .always(function(data) {
        console.log(data);
      });
    }
</script>
