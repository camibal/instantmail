<script type="text/javascript">
	//Funcion para el Datatable
    $(document).ready(function () {
        $('#tablaCalificacion').DataTable(
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

    //Funcion boton crear calificacion
	$("#btn_crear_calificacion").click(function(){
		$("#modalCalificacionLabel").text("Crear calificacion");
		$("#btn_guardar_calificacion").attr("data-accion","crear");
		$("#form_calificacion")[0].reset();
		$("#btn_guardando").hide();
		limpiar_campos();
	});

	//Funcion guardar calificacion
	$("#btn_guardar_calificacion").click(function(){
		resultado = campos_incompletos();
		if(resultado == true){
			accion = $(this).attr('data-accion');
			if(accion == 'crear'){
				crea_calificacion();
			}
			if(accion == 'editar'){
				edita_calificacion();
			}
		}
	});

	//Campos incompletos
	function campos_incompletos(){
		return true;
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

	//Funcion para guardar el calificacion
	function crea_calificacion(){
	 	nombre_calificacion = $("#nombre_calificacion").val();

	    $.ajax({
	      url: "../controlador/ajaxCalificacion.php",
	      data: 'nombre_calificacion='+nombre_calificacion+'&tipo=inserta'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_guardar_calificacion").hide();
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

	//Carga el calificacion por el ID
	function carga_calificacion(id_calificacion){

	    console.log("Carga el calificacion "+ id_calificacion);

	    $.ajax({
	        url: "../controlador/ajaxCalificacion.php",
	        data: "id_calificacion="+id_calificacion+"&tipo=consulta",
	        dataType: 'json'
	    })
	    .done(function(data) {
	    	console.log(data);
	        $.each(data[0], function( key, value ) {
	           	if(key == "numero_envio"){
	        		$("#numero_envio").html(value)
	        	}
	        	if(key == "fecha_envio"){
	        		$("#fecha_envio").html(value)
	        	}
	      	    if(key == "nombres_mensajero"){
	        		$("#nombres_mensajero").html(value)
	        	}
	     	    if(key == "apellidos_mensajero"){
	        		$("#apellidos_mensajero").html(value)
	        	}
	          console.log(key+"--"+value);
	          $("#"+key).val(value);
	        });

	        id_calificacion = data.id_calificacion;
	    })
	    .fail(function(data) {
	        console.log(data);
	    })
	    .always(function(data) {
	        console.log(data);
	    });
	};

	//Funcion para guardar el calificacion
	function edita_calificacion(){
		id_calificacion = $("#id_calificacion").val();
		valor_calificacion = $("#valor_calificacion").val();
		observaciones_calificacion = $("#observaciones_calificacion").val();

	    $.ajax({
	      url: "../controlador/ajaxCalificacion.php",
	      data: 'id_calificacion='+id_calificacion+'&valor_calificacion='+valor_calificacion+'&observaciones_calificacion='+observaciones_calificacion+'&tipo=edita'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_guardar_calificacion").hide();
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

	//Funcion para eliminar el calificacion
	function elimina_calificacion(id_calificacion){
	    $.ajax({
	      url: "../controlador/ajaxCalificacion.php",
	      data: 'id_calificacion='+id_calificacion+'&tipo=elimina_logico'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_eliminar_calificacion").hide();
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
  		$("#modalCalificacion").removeClass("show");
 		$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
  		$('.modal-backdrop').remove();//eliminamos el backdrop del modal
  		$('#tabla').load('calificaciones/index.php');
    }

	//Funcion editar
	function evento_editar(){
		$("[name*='btn_editar']").click(function(){
			id_calificacion = $(this).attr('data-id-calificacion');
			$("#modalCalificacionLabel").text("Califica el servicio");
			carga_calificacion(id_calificacion);
			$("#btn_guardar_calificacion").attr("data-accion","editar");
			$("#btn_guardando").hide();
			limpiar_campos();
		});
	}

	//Funcion eliminar
	function evento_eliminar(){
		//Funcion eliminar calificacion
		$("[name*='btn_eliminar']").click(function(){
			$("#btn_eliminando").hide();
			id_calificacion = $(this).attr('data-id-calificacion');
			$("#btn_eliminar_calificacion").attr("data-id-calificacion",id_calificacion);
		});

		//Funcion eliminar calificacion
		$("[name*='btn_eliminar_calificacion']").click(function(){
			id_calificacion = $(this).attr('data-id-calificacion');
			elimina_calificacion(id_calificacion);
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

	//Funcion al pasar el mouse por la estrella
	$("[name*='btn_estrella']").mouseover(function(){
		id_estrella = $(this).attr('data-id-estrella');
		cambiaEstrella(id_estrella);
	});

	//Funcion para cambiar la clase de la estrella
	function cambiaEstrella(actual){
		removerClases();
		for (var i = 1; i <= actual; i++) {
			$("#estrella_" + i).addClass('btn-warning');
		}
		$("#valor_calificacion").val(actual);
	}

	//Funcion que remueve las clases de las estrellas
	function removerClases(){
		for (var i = 1; i <= 5; i++) {
			$("#estrella_" + i).removeClass('btn-warning');
		}
	}

</script>