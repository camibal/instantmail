 <script type="text/javascript">
 	//Funcion boton crear Usuario
 	$("#btn_crear_usuario").click(function() {
 		$("#modalUsuarioLabel").text("Crear Usuario");
 		$("#btn_guardar_usuario").attr("data-accion", "crear");
 		$("#form_usuario")[0].reset();
 		$("#btn_guardando").hide();
 		BloquearDesbloquear("#fkID_cliente", "bloqueo");
 		BloquearDesbloquear("#fkID_mensajero", "bloqueo");
 	});

 	//Funcion para bloquear o desbloquear
 	function BloquearDesbloquear(campo, opcion) {
 		switch (opcion) {
 			case 'bloqueo':
 				$(campo).attr("disabled", "true");
 				$(campo).removeAttr("required", "true");
 				break;
 			case 'desbloqueo':
 				$(campo).removeAttr("disabled", "true");
 				$(campo).attr("required", "true");
 				break;
 		}
 	}

 	//Funcion al cambiar el select de rol
 	$("#fkID_rol").change(function() {
 		if ($(this).val() == 5) {
 			mensajeroCliente("cliente", "mensajero");
 		} else if ($(this).val() == 4) {
 			mensajeroCliente("mensajero", "cliente");
 		} else {
 			BloquearDesbloquear("#fkID_cliente", "bloqueo");
 			BloquearDesbloquear("#fkID_mensajero", "bloqueo");
 			$("#requerido_cliente").html("");
 			$("#requerido_mensajero").html("");
 			$("#fkID_mensajero").val(0);
 			$("#fkID_cliente").val(0);
 			$("#fkID_mensajero").removeClass("is-invalid");
 			$("#fkID_mensajero").removeClass("is-valid");
 			$("#fkID_cliente").removeClass("is-invalid");
 			$("#fkID_cliente").removeClass("is-valid");
 		}
 	});

 	//Funcion para los campos de mensajero y cliente
 	function mensajeroCliente(campo1, campo2) {
 		BloquearDesbloquear("#fkID_" + campo1, "desbloqueo");
 		$("#requerido_" + campo1).html("*");
 		BloquearDesbloquear("#fkID_" + campo2, "bloqueo");
 		$("#fkID_" + campo2).val(0);
 		$("#fkID_" + campo2).removeClass("is-invalid");
 		$("#fkID_" + campo2).removeClass("is-valid");
 		$("#requerido_" + campo2).html("");
 	}

 	//Funcion guardar Usuario
 	$("#btn_guardar_usuario").click(function() {
 		respuesta = validar_campos();
 		if (respuesta) {
 			accion = $(this).attr('data-accion');
 			if (accion == 'crear') {
 				crea_Usuario();
 			}
 			if (accion == 'editar') {
 				edita_Usuario();
 			}
 		}
 	});

 	//Funcion para guardar el Usuario
 	function crea_Usuario() {
 		const inputFile = document.querySelector("#archivo");
 		var formElement = document.getElementById("form_usuario");
 		formData = new FormData(formElement);
 		formData.append("tipo", "inserta");
 		formData.append("archivo", inputFile.files[0]);

 		$.ajax({
 			url: "../controlador/ajaxUsuario.php",
 			type: 'POST',
 			data: formData,
 			cache: false,
 			contentType: false,
 			processData: false,
 			success: function(r) {
 				$("#btn_guardar_usuario").hide();
 				$("#btn_guardando").show();
 				alertify.success('Creado correctamente');
 				setTimeout('cargar_sitio()', 1000);
 			}
 		})
 	}

 	//Funcion guardar Usuario
 	$("[name*='btn_cerrar_sesion']").click(function() {
 		console.log("hola")
 		$.ajax({
 				url: "../controlador/ajaxUsuario.php",
 				data: "tipo=cerrar_sesion",
 			})
 			.done(function(data) {
 				console.log(data)
 			})
 			.fail(function(data) {
 				console.log(data);
 			})
 			.always(function(data) {
 				console.log(data);
 			})
 	})

 	//Carga el Usuario por el ID
 	function carga_usuario(id_Usuario) {
 		$.ajax({
 				url: "../controlador/ajaxUsuario.php",
 				data: "id_usuario=" + id_Usuario + "&tipo=consulta",
 				dataType: 'json'
 			})
 			.done(function(data) {
 				console.log(data[0]);
 				$.each(data[0], function(key, value) {
 					if (key == "pass_usuario") {
 						$("#pass_antiguo").val(value);
 					}
 					if (key == "foto_usuario" && value != "") {
 						$("#foto").html('<img class="img-fluid mx-auto d-block" src="../subidas/' + value + '" />')
 					}
 					console.log(key + "--" + value);
 					$("#" + key).val(value);
 				});

 				id_Usuario = data.id_Usuario;
 			})
 			.fail(function(data) {
 				console.log(data);
 			})
 			.always(function(data) {
 				console.log(data);
 			})
 	};

 	//Funcion para editar el Usuario
 	function edita_Usuario() {
 		const inputFile = document.querySelector("#archivo");
 		var formElement = document.getElementById("form_usuario");
 		formData = new FormData(formElement);
 		formData.append("tipo", "edita");
 		formData.append("archivo", inputFile.files[0]);

 		$.ajax({
 			url: "../controlador/ajaxUsuario.php",
 			type: 'POST',
 			data: formData,
 			cache: false,
 			contentType: false,
 			processData: false,
 			success: function(r) {
 				$("#btn_guardar_usuario").hide();
 				$("#btn_guardando").show();
 				alertify.success('Editado correctamente');
 				setTimeout('cargar_sitio()', 1000);
 			}
 		})
 	}

 	//Funcion para eliminar el usuario
 	function elimina_usuario(id_usuario) {
 		$.ajax({
 				url: "../controlador/ajaxUsuario.php",
 				data: 'id_usuario=' + id_usuario + '&tipo=elimina_logico'
 			})
 			.done(function(data) {
 				//---------------------
 				$("#btn_eliminar_usuario").hide();
 				$("#btn_cancelar").hide();
 				$("#btn_eliminando").show();
 				alertify.success('Eliminado correctamente');
 				setTimeout('cargar_sitio()', 1000);
 			})
 			.fail(function(data) {
 				console.log(data);
 			})
 		always(function(data) {
 			console.log(data);
 		});
 	}

 	//Campos incompletos de usuario
 	function validar_campos() {
 		var bandera = true;
 		$("#form_usuario").find(':input').each(function() {
 			var elemento = this;
 			if (elemento.required == true) {
 				if (verificar_campo(elemento.id, elemento.type, elemento.value) == false) {
 					bandera = false;
 				}
 			}
 		});
 		if (bandera == false) {
 			alert('Complete el formulario');
 			return false;
 		} else {
 			return true;
 		}
 	}

 	//Funcion para verificar campos
 	function verificar_campo(id, tipo, valor) {
 		switch (tipo) {
 			case "text":
 				if (valor == "") {
 					marcar_campos("#" + id, 'incorrecto');
 					return false;
 				} else {
 					marcar_campos("#" + id, 'correcto');
 				}
 				break;
 			case "password":
 				if (valor == "") {
 					marcar_campos("#" + id, 'incorrecto');
 					return false;
 				} else {
 					marcar_campos("#" + id, 'correcto');
 				}
 				break;
 			case "select-one":
 				if (valor == 0) {
 					marcar_campos("#" + id, 'incorrecto');
 					return false;
 				} else {
 					marcar_campos("#" + id, 'correcto');
 				}
 				break;
 		}
 	}

 	//Funcion para marcar los campos
 	function marcar_campos(campo, tipo) {
 		if (tipo == 'correcto') {
 			$(campo).removeClass('is-invalid');
 			$(campo).addClass('is-valid');
 		}
 		if (tipo == 'incorrecto') {
 			$(campo).removeClass('is-valid');
 			$(campo).addClass('is-invalid');
 		}
 	}

 	//Funcion para el Datatable
 	$(document).ready(function() {
 		$('#tablaUsuarios').DataTable({
 			"pagingType": "full_numbers",
 			"lengthMenu": [
 				[10, 25, 50, -1],
 				[10, 25, 50, "Todos"]
 			],
 			"language": {
 				"lengthMenu": "Mostrando _MENU_ registros",
 				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
 				"infoEmpty": "Mostrando 0 a 0 de 0 registros",
 				"search": "Buscar:",
 				"loadingRecords": "Cargando...",
 				"processing": "Procesando...",
 				"zeroRecords": "No hay registros que coincidan.",
 				"infoEmpty": "No se encuentran registros.",
 				"infoFiltered": "(Filtrando _MAX_ registros en total)",
 				"paginate": {
 					"first": "<--",
 					"last": "-->",
 					"next": ">",
 					"previous": "<"
 				},
 				"aria": {
 					"sortAscending": ": activate to sort column ascending",
 					"sortDescending": ": activate to sort column descending"
 				},
 			},
 			"order": []
 		});
 	});

 	//Funcion para cargar sitio
 	function cargar_sitio() {
 		$("#modalEquipo").removeClass("show");
 		$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
 		$('.modal-backdrop').remove(); //eliminamos el backdrop del modal
 		$('#tabla').load('usuarios/index.php');
 	}

 	function validarEmail(email) {
 		expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 		if (!expr.test(email)) {
 			alert("Error: La dirección de correo " + email + " es incorrecta.");
 			$("#email").val("");
 		} else {
 			return true;
 		}
 	}

 	//Funcion eliminar
 	function evento_eliminar() {
 		//Funcion eliminar categoria
 		$("[name*='btn_eliminar']").click(function() {
 			$("#btn_eliminando").hide();
 			id_usuario = $(this).attr('data-id-usuario');
 			$("#btn_eliminar_usuario").attr("data-id-usuario", id_usuario);
 		});

 		//Funcion eliminar categoria
 		$("[name*='btn_eliminar_usuario']").click(function() {
 			id_usuario = $(this).attr('data-id-usuario');
 			elimina_usuario(id_usuario);
 		});
 	}

 	//Funcion para pasar eventos
 	function carga_eventos() {
 		evento_eliminar();
 		evento_paginar();
 		evento_editar();
 	}

 	//Carga eventos
 	carga_eventos();

 	//Funcion para paginar
 	function evento_paginar() {
 		//Funcion para pasar eventos
 		$(".paginate_button ").click(function() {
 			carga_eventos();
 		});

 		//Funcion para pasar eventos
 		$("[type*='search']").keypress(function() {
 			carga_eventos();
 		});
 	}

 	//Funcion editar
 	function evento_editar() {
 		$("[name*='btn_editar']").click(function() {
 			id_usuario = $(this).attr('data-id-usuario');
 			$("#modalUsuarioLabel").text("Editar usuario");
 			carga_usuario(id_usuario);
 			$("#btn_guardar_usuario").attr("data-accion", "editar");
 			$("#btn_guardando").hide();
 			limpiar_campos();
 		});
 	}

 	//Funcion para limpiar campos
 	function limpiar_campos() {
 		$("input").removeClass('is-invalid');
 		$("input").removeClass('is-valid');
 		$("select").removeClass('is-invalid');
 		$("select").removeClass('is-valid');
 	}

 	//recuperar contraseña
 	$('#form_send_email').submit(function(event) {
 		event.preventDefault();
 		let reload = document.getElementById("reload");
 		reload.classList.remove("d-none");
 		let email = document.getElementById("email").value;
 		$.ajax({
 			type: 'POST',
 			url: "../../controlador/ajaxUsuario.php",
 			data: {
 				"tipo": 'recuperar',
 				"email": email
 			},
 			success: function(data) {
 				//Cuando la interacción sea exitosa, se ejecutará esto.
 				alertify.success(data)
 				setTimeout(function() {
 					reload.classList.add("d-none");
 					location.href = "../login/index.php";
 				}, 1000)
 			},
 			error: function(data) {
 				//Cuando la interacción retorne un error, se ejecutará esto.
 				alertify.success(data)
 			}
 		})
 	})

 	// actualizar contraseña
 	$('#forgetPss').submit(function(event) {
 		event.preventDefault();
 		reload.classList.remove("d-none");
 		var email = document.getElementById("email").value;
 		var emailEncript = document.getElementById("emailEncript").value;
 		var idUser = document.getElementById("idUser").value;
 		var password = document.getElementById("password").value;
 		var con_password = document.getElementById("con_password").value;

 		if (password !== con_password) {
 			alertify.success("Las contraseñas no cinciden");
 			setTimeout('cargar_sitio()', 1000);
 		} else {
 			$.ajax({
 				type: 'POST',
 				url: "../../controlador/ajaxUsuario.php",
 				data: {
 					"tipo": "actualizar",
 					"email": email,
 					"emailEncript": emailEncript,
 					"idUser": idUser,
 					"password": password
 				},
 				success: function(data) {
 					//Cuando la interacción sea exitosa, se ejecutará esto.
 					alertify.success(data)
 					setTimeout(function() {
 						reload.classList.add("d-none");
 						location.href = "../login/index.php";
 					}, 1000)
 				},
 				error: function(data) {
 					//Cuando la interacción retorne un error, se ejecutará esto.
 					alertify.success(data)
 					setTimeout('cargar_sitio()', 1000);
 				}
 			})
 		}
 	})
 </script>