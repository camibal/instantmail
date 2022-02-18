<script type="text/javascript">
	//Funcion para el Datatable
    $(document).ready(function () {
        $('#tablaClientes').DataTable(
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

    //Funcion boton crear cliente
	$("#btn_crear_cliente").click(function(){
		$("#modalClienteLabel").text("Crear cliente");
		$("#btn_guardar_cliente").attr("data-accion","crear");
		$("#form_cliente")[0].reset();
		$("#btn_guardando").hide();
		limpiar_campos();
	});

	//Funcion guardar cliente
	$("#btn_guardar_cliente").click(function(){
		resultado = campos_incompletos();
		if(resultado == true){
			accion = $(this).attr('data-accion');
			if(accion == 'crear'){
				crea_cliente();
			}
			if(accion == 'editar'){
				edita_cliente();
			}
		}
	});

	//Campos incompletos
	function campos_incompletos(){
		var bandera = true;
		if($("#nombres_cliente").val().length == 0){
			bandera = false;
			marcar_campos("#nombres_cliente", 'incorrecto');
		} else {
			marcar_campos("#nombres_cliente", 'correcto');
		}
		if($('#celular_cliente').val().trim() == 0){
			bandera = false;
			marcar_campos("#celular_cliente", 'incorrecto');
		}  else {
			marcar_campos("#celular_cliente", 'correcto');
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

	//Funcion para guardar el cliente
	function crea_cliente(){
	 	nombres_cliente = $("#nombres_cliente").val();
	 	apellidos_cliente = $("#apellidos_cliente").val();
	 	fkID_tipo_documento = $("#fkID_tipo_documento").val();
	 	documento_cliente = $("#documento_cliente").val();
	 	email_cliente = $("#email_cliente").val();
	 	celular_cliente = $("#celular_cliente").val();
	 	direccion_cliente = $("#direccion_cliente").val();
	 	ciudad_cliente = $("#ciudad_cliente").val();

	    $.ajax({
	      url: "../controlador/ajaxCliente.php",
	      data: 'nombres_cliente='+nombres_cliente+'&apellidos_cliente='+apellidos_cliente+'&ciudad_cliente='+ciudad_cliente+'&fkID_tipo_documento='+fkID_tipo_documento+'&documento_cliente='+documento_cliente+'&email_cliente='+email_cliente+'&celular_cliente='+celular_cliente+'&direccion_cliente='+direccion_cliente+'&tipo=inserta'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_guardar_cliente").hide();
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

	//Carga el cliente por el ID
	function carga_cliente(id_cliente){

	    console.log("Carga el cliente "+ id_cliente);

	    $.ajax({
	        url: "../controlador/ajaxCliente.php",
	        data: "id_cliente="+id_cliente+"&tipo=consulta",
	        dataType: 'json'
	    })
	    .done(function(data) {

	        $.each(data[0], function( key, value ) {
	          console.log(key+"--"+value);
	          $("#"+key).val(value);
	        });

	        id_cliente = data.id_cliente;
	    })
	    .fail(function(data) {
	        console.log(data);
	    })
	    .always(function(data) {
	        console.log(data);
	    });
	};

	//Funcion para guardar el cliente
	function edita_cliente(){
		id_cliente = $("#id_cliente").val();
	 	nombres_cliente = $("#nombres_cliente").val();
	 	apellidos_cliente = $("#apellidos_cliente").val();
	 	documento_cliente = $("#documento_cliente").val();
	 	fkID_tipo_documento = $("#fkID_tipo_documento").val();
	 	email_cliente = $("#email_cliente").val();
	 	celular_cliente = $("#celular_cliente").val();
	 	direccion_cliente = $("#direccion_cliente").val();
		 ciudad_cliente = $("#ciudad_cliente").val();

	    $.ajax({
	      url: "../controlador/ajaxCliente.php",
	      data: 'id_cliente='+id_cliente+'&nombres_cliente='+nombres_cliente+'&apellidos_cliente='+apellidos_cliente+'&ciudad_cliente='+ciudad_cliente+'&documento_cliente='+documento_cliente+'&fkID_tipo_documento='+fkID_tipo_documento+'&email_cliente='+email_cliente+'&celular_cliente='+celular_cliente+'&direccion_cliente='+direccion_cliente+'&tipo=edita'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_guardar_cliente").hide();
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

	//Funcion para eliminar el cliente
	function elimina_cliente(id_cliente){
	    $.ajax({
	      url: "../controlador/ajaxCliente.php",
	      data: 'id_cliente='+id_cliente+'&tipo=elimina_logico'
	    })
	    .done(function(data) {
	      //---------------------
	      $("#btn_eliminar_cliente").hide();
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
  		$("#modalCliente").removeClass("show");
 		$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
  		$('.modal-backdrop').remove();//eliminamos el backdrop del modal
  		$('#tabla').load('clientes/index.php');
    }

	//Funcion editar
	function evento_editar(){
		$("[name*='btn_editar']").click(function(){
			id_cliente = $(this).attr('data-id-cliente');
			console.log('Entro a editar cliente');
			$("#modalClienteLabel").text("Editar cliente");
			carga_cliente(id_cliente);
			$("#btn_guardar_cliente").attr("data-accion","editar");
			$("#btn_guardando").hide();
			limpiar_campos();
		});
	}

	//Funcion eliminar
	function evento_eliminar(){
		//Funcion eliminar cliente
		$("[name*='btn_eliminar']").click(function(){
			$("#btn_eliminando").hide();
			id_cliente = $(this).attr('data-id-cliente');
			$("#btn_eliminar_cliente").attr("data-id-cliente",id_cliente);
		});

		//Funcion eliminar cliente
		$("[name*='btn_eliminar_cliente']").click(function(){
			id_cliente = $(this).attr('data-id-cliente');
			elimina_cliente(id_cliente);
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
</script>