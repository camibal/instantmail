<script type="text/javascript">
    //Funcion para exportar a excel
    $("#btn_excel_clientes").click(function(){
      window.location = '../vista/listados/excel_listado_clientes.php?tipo=listado_clientes';
        return false;
    });

    //Funcion para exportar a PDF
    $("#btn_pdf_clientes").click(function(){      
      window.location = '../vista/listados/pdf_listado_clientes.php?tipo=listado_clientes';
        return false;
    });

    //Funcion para exportar a excel
    $("#btn_excel_mensajeros").click(function(){
      window.location = '../vista/listados/excel_listado_mensajeros.php?tipo=listado_mensajeros';
        return false;
    });

    //Funcion para exportar a PDF
    $("#btn_pdf_mensajeros").click(function(){      
      window.location = '../vista/listados/pdf_listado_mensajeros.php?tipo=listado_mensajeros';
        return false;
    });
</script>