<script type="text/javascript">
	//Funcion para el Datatable
    $(document).ready(function () {
        $('#tablaBase').DataTable(
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

    //Funcion boton crear base
	$("#btn_crear_base").click(function(){
		$("#modalBaseLabel").text("Crear movimiento");
		$("#btn_guardar_base").attr("data-accion","crear");
		$("#form_base")[0].reset();
		$("#btn_guardando").hide();
		limpiar_campos();
	});

	//Funcion guardar base
	$("#btn_guardar_base").click(function(){
		resultado = campos_incompletos();
		if(resultado == true){
			accion = $(this).attr('data-accion');
			if(accion == 'crear'){
				crea_base();
			}
			if(accion == 'editar'){
				edita_base();
			}
		}
	});

	//Campos incompletos
	function campos_incompletos(){
	  var bandera = true;
      if($("#fecha_movimiento").val() == ""){
        bandera = false;
        marcar_campos("#fecha_movimiento", 'incorrecto');
      } else {
        marcar_campos("#fecha_movimiento", 'correcto');
      }
      if($("#fkID_tipo_movimiento").val().trim() == 0){
        bandera = false;
        marcar_campos("#fkID_tipo_movimiento", 'incorrecto');
      } else {
        marcar_campos("#fkID_tipo_movimiento", 'correcto');
      }
      if($("#valor_movimiento").val() == ""){
        bandera = false;
        marcar_campos("#valor_movimiento", 'incorrecto');
      } else {
        marcar_campos("#valor_movimiento", 'correcto');
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

	//Funcion para guardar el base
	function crea_base(){
	 	fecha_movimiento = $("#fecha_movimiento").val();
	 	fkID_tipo_movimiento = $("#fkID_tipo_movimiento").val();
	 	valor_movimiento = $("#valor_movimiento").val();
	 	observaciones_movimiento = $("#observaciones_movimiento").val();

	    $.ajax({
	      url: "../controlador/ajaxBase.php",
	      data: 'fecha_movimiento='+fecha_movimiento+'&fkID_tipo_movimiento='+fkID_tipo_movimiento+'&valor_movimiento='+valor_movimiento+'&observaciones_movimiento='+observaciones_movimiento+'&tipo=inserta'
	    })
	    .done(function(data) {
	      //---------------------
	      if(data == "true"){
					alertify.error('La base para esta fecha ya fue creada, puede modificarla o eliminarla');
					return false;
	      } else {
	      	$("#btn_guardar_base").hide();
	      	$("#btn_guardando").show();
	      	alertify.success('Creado correctamente');
		  		setTimeout('cargar_sitio()',1000);
	      }
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

	//Carga el base por el ID
	function carga_movimiento(id_movimiento){

	    console.log("Carga el movimiento "+ id_movimiento);

	    $.ajax({
	        url: "../controlador/ajaxBase.php",
	        data: "id_movimiento="+id_movimiento+"&tipo=consulta",
	        dataType: 'json'
	    })
	    .done(function(data) {
	    	console.log(data);
	        $.each(data[0], function( key, value ) {
	        console.log(key+"--"+value);
	          $("#"+key).val(value);
	        });

	        id_base = data.id_base;
	    })
	    .fail(function(data) {
	        console.log(data);
	    })
	    .always(function(data) {
	        console.log(data);
	    });
	};

	//Funcion para guardar el base
	function edita_base(){
		id_movimiento = $("#id_movimiento").val();
		fkID_tipo_movimiento = $("#fkID_tipo_movimiento").val();
		valor_movimiento = $("#valor_movimiento").val();
		observaciones_movimiento = $("#observaciones_movimiento").val();

	    $.ajax({
	      url: "../controlador/ajaxBase.php",
	      data: 'id_movimiento='+id_movimiento+'&fkID_tipo_movimiento='+fkID_tipo_movimiento+'&valor_movimiento='+valor_movimiento+'&observaciones_movimiento='+observaciones_movimiento+'&tipo=edita'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_guardar_base").hide();
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

	//Funcion para eliminar el base
	function elimina_base(id_movimiento){
	    $.ajax({
	      url: "../controlador/ajaxBase.php",
	      data: 'id_movimiento='+id_movimiento+'&tipo=elimina_logico'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_eliminar_base").hide();
	      $("#btn_cancelar").hide();
	      $("#btn_eliminando").show();
	      alertify.success('Eliminado correctamente');
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
  		$("#modalBase").removeClass("show");
 		$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
  		$('.modal-backdrop').remove();//eliminamos el backdrop del modal
  		$('#tabla').load('base/index.php');
    }

	//Funcion editar
	function evento_editar(){
		$("[name*='btn_editar']").click(function(){
			id_movimiento = $(this).attr('data-id-movimiento');
			$("#modalBasesLabel").text("Califica el servicio");
			carga_movimiento(id_movimiento);
			$("#btn_guardar_base").attr("data-accion","editar");
			$("#btn_guardando").hide();
			limpiar_campos();
		});
	}

	//Funcion eliminar
	function evento_eliminar(){
		//Funcion eliminar base
		$("[name*='btn_eliminar']").click(function(){
			$("#btn_eliminando").hide();
			id_movimiento = $(this).attr('data-id-movimiento');
			$("#btn_eliminar_base").attr("data-id-movimiento",id_movimiento);
		});

		//Funcion eliminar base
		$("[name*='btn_eliminar_base']").click(function(){
			id_movimiento = $(this).attr('data-id-movimiento');
			elimina_base(id_movimiento);
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
		$("#valor_base").val(actual);
	}

	//Funcion que remueve las clases de las estrellas
	function removerClases(){
		for (var i = 1; i <= 5; i++) {
			$("#estrella_" + i).removeClass('btn-warning');
		}
	}

</script>