
        <!-- Core plugin JavaScript-->

        <!-- Custom scripts for all pages-->
        <script src="componentes/js/sb-admin-2.min.js">
        </script>
        <!-- Page level plugins -->
        <script src="componentes/vendor/chart.js/Chart.min.js">
        </script>
        <!-- Page level custom scripts -->
        <script src="componentes/js/demo/chart-area-demo.js">
        </script>


 </body>
 </html>
 <script type="text/javascript">
    //esta cargando el archivo tabla.php en el div tabla
    $(document).ready(function(){
        //$('#tabla').load('usuario/Vusuario.php')
        $("[name*='btn_cerrar_sesion']").click(function(){
        console.log("hola")
        $.ajax({
            url: "../controlador/ajaxUsuario.php",
            data: "tipo=cerrar_sesion",
        })
        .done(function(data) {
            window.location="login/index.php";
        })
        .fail(function(data) {
            console.log(data);
        })
        .always(function(data) {
            console.log(data);
        })
    })
    });

    $("#menu_Usuarios").click(function(){
        $('#tabla').load('usuarios/index.php');
    });

    //Redireccion a index de mensajeros
    $("#menu_Mensajeros").click(function(){
        $('#tabla').load('mensajero/index.php');
    });

    //Redireccion a index de clientes
    $("#menu_Clientes").click(function(){
        $('#tabla').load('clientes/index.php');
    });

    //Redireccion a index de envios
    $("#menu_Envios").click(function(){
        $('#tabla').load('envios/index.php');
    });

    //Redireccion a index de envios clientes
    $("#menu_enviosClientes").click(function(){
        $('#tabla').load('enviosClientes/index.php');
    });   

    //Redireccion a index de envios mensajeros
    $("#menu_Pedidos").click(function(){
        $('#tabla').load('enviosMensajeros/index.php');
    }); 

    //Redireccion a index de calificaciones
    $("#menu_Calificaciones").click(function(){
        $('#tabla').load('calificaciones/index.php');
    });   

    //Redireccion a index de informes
    $("#menu_Informes").click(function(){
        $('#tabla').load('informes/index.php');
    });   

    //Redireccion a index de listados
    $("#menu_Listados").click(function(){
        $('#tabla').load('listados/index.php');
    });   

    //Redireccion a index de caja
    $("#menu_Caja").click(function(){
        $('#tabla').load('caja/index.php');
    });

    //Redireccion a index de base
    $("#menu_Base").click(function(){
        $('#tabla').load('base/index.php');
    });
</script>
