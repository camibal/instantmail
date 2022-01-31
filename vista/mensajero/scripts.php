<script type="text/javascript">
	//Funcion para el Datatable
    $(document).ready(function () {
        $('#tablaMensajeros').DataTable(
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

    //Funcion boton crear mensajero
	$("#btn_crear_mensajero").click(function(){
		$("#modalMensajeroLabel").text("Crear mensajero");
		$("#btn_guardar_mensajero").attr("data-accion","crear");
		$("#form_mensajero")[0].reset();
		$("#btn_guardando").hide();
		limpiar_campos();
	});

	//Funcion guardar mensajero
	$("#btn_guardar_mensajero").click(function(){
		resultado = campos_incompletos();
		if(resultado == true){
			accion = $(this).attr('data-accion');
			if(accion == 'crear'){
				crea_mensajero();
			}
			if(accion == 'editar'){
				edita_mensajero();
			}
		}
	});

	//Campos incompletos
	function campos_incompletos(){
		var bandera = true;
		if($("#nombres_mensajero").val().length == 0){
			bandera = false;
			marcar_campos("#nombres_mensajero", 'incorrecto');
		} else {
			marcar_campos("#nombres_mensajero", 'correcto');
		}
		if($('#celular_mensajero').val().trim() == 0){
			bandera = false;
			marcar_campos("#celular_mensajero", 'incorrecto');
		}  else {
			marcar_campos("#celular_mensajero", 'correcto');
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

	//Funcion para guardar el mensajero
	function crea_mensajero(){
	 	nombres_mensajero = $("#nombres_mensajero").val();
	 	apellidos_mensajero = $("#apellidos_mensajero").val();
	 	fkID_tipo_documento = $("#fkID_tipo_documento").val();
	 	documento_mensajero = $("#documento_mensajero").val();
	 	celular_mensajero = $("#celular_mensajero").val();

	    $.ajax({
	      url: "../controlador/ajaxMensajero.php",
	      data: 'nombres_mensajero='+nombres_mensajero+'&apellidos_mensajero='+apellidos_mensajero+'&fkID_tipo_documento='+fkID_tipo_documento+'&documento_mensajero='+documento_mensajero+'&celular_mensajero='+celular_mensajero+'&tipo=inserta'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_guardar_mensajero").hide();
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

	//Carga eventos
	carga_eventos();

	//Carga el mensajero por el ID
	function carga_mensajero(id_mensajero){

	    console.log("Carga el mensajero "+ id_mensajero);

	    $.ajax({
	        url: "../controlador/ajaxMensajero.php",
	        data: "id_mensajero="+id_mensajero+"&tipo=consulta",
	        dataType: 'json'
	    })
	    .done(function(data) {

	        $.each(data[0], function( key, value ) {
	          console.log(key+"--"+value);
	          $("#"+key).val(value);
	        });

	        id_mensajero = data.id_mensajero;
	    })
	    .fail(function(data) {
	        console.log(data);
	    })
	    .always(function(data) {
	        console.log(data);
	    });
	};

	//Funcion para guardar el mensajero
	function edita_mensajero(){
		id_mensajero = $("#id_mensajero").val();
	 	nombres_mensajero = $("#nombres_mensajero").val();
	 	apellidos_mensajero = $("#apellidos_mensajero").val();
	 	fkID_tipo_documento = $("#fkID_tipo_documento").val();
	 	documento_mensajero = $("#documento_mensajero").val();
	 	celular_mensajero = $("#celular_mensajero").val();

	    $.ajax({
	      url: "../controlador/ajaxMensajero.php",
	      data: 'id_mensajero='+id_mensajero+'&nombres_mensajero='+nombres_mensajero+'&apellidos_mensajero='+apellidos_mensajero+'&fkID_tipo_documento='+fkID_tipo_documento+'&documento_mensajero='+documento_mensajero+'&celular_mensajero='+celular_mensajero+'&tipo=edita'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_guardar_mensajero").hide();
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

	//Funcion para eliminar el mensajero
	function elimina_mensajero(id_mensajero){
	    $.ajax({
	      url: "../controlador/ajaxMensajero.php",
	      data: 'id_mensajero='+id_mensajero+'&tipo=elimina_logico'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_eliminar_mensajero").hide();
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

    //Funcion para cargar sitio
    function cargar_sitio(){
  		$("#modalMensajero").removeClass("show");
 		$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
  		$('.modal-backdrop').remove();//eliminamos el backdrop del modal
  		$('#tabla').load('mensajero/index.php');
    }

	//Funcion editar
	function evento_editar(){
		$("[name*='btn_editar']").click(function(){
			id_mensajero = $(this).attr('data-id-mensajero');
			console.log('Entro a editar mensajero');
			$("#modalMensajeroLabel").text("Editar mensajero");
			carga_mensajero(id_mensajero);
			$("#btn_guardar_mensajero").attr("data-accion","editar");
			$("#btn_guardando").hide();
			limpiar_campos();
		});
	}

	//Funcion eliminar
	function evento_eliminar(){
		//Funcion eliminar mensajero
		$("[name*='btn_eliminar']").click(function(){
			$("#btn_eliminando").hide();
			id_mensajero = $(this).attr('data-id-mensajero');
			$("#btn_eliminar_mensajero").attr("data-id-mensajero",id_mensajero);
		});

		//Funcion eliminar mensajero
		$("[name*='btn_eliminar_mensajero']").click(function(){
			id_mensajero = $(this).attr('data-id-mensajero');
			elimina_mensajero(id_mensajero);
		});
	}

	//Funcion para pasar eventos
	function carga_eventos(){
		evento_editar();
		evento_eliminar();
	}

    //Funcion para pasar eventos
    $(".paginate_button").click(function(){
        carga_eventos();
    });

    //Funcion para pasar eventos
    $("[type*='search']").keypress(function(){
        carga_eventos();
    });
	
	//Funcion para limpiar campos
	function limpiar_campos(){
		$("input").removeClass('is-invalid');
		$("input").removeClass('is-valid');
		$("select").removeClass('is-invalid');
		$("select").removeClass('is-valid');
	}

    //Funcion solo permite numeros
    $(function(){
        $(".soloNumeros").keydown(function(event){
            //alert(event.keyCode);
            if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9){
                return false;
            }
        });
    });
</script>
