$(document).ready(function() {

     //// Obtener lista de tipo de servicios
 $(obtener_tipo_producto());
 function obtener_tipo_producto(consulta) 
     {
     $.ajax({
         url : 'combo_ajax/com_tipo_producto.php',
         type : 'POST',
         dataType : 'html',
   })
  
     .done(function(respuesta){
         $(".tipo_producto").html(respuesta);
     })
     
     .fail(function() {
         console.log("error");	
   });
   
  }

    /// data de de stock productos
        var opc_invet = 'lista_invent';
        
        var today = new Date();

        const fecha_expor = today.toLocaleString() 
        
        stock_productos = $('#stock_productos').DataTable({ 
            scrollX:        true,   // Habilitar desplazamiento horizontal
            scrollCollapse: true,   // Hacer colapsar el scroll cuando no haya suficientes filas
            fixedHeader: true,      // Fijar el encabezado
            scrollXInner: "100%",   //    
                        
            "footerCallback": function ( row, data, start, end, display )
            {
            
                ////--------------------------------------------------->
                gran_total_b = this.api()
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
                var gran_total_b = gran_total_b.toFixed(2);
                $(this.api().column(5).footer()).html(gran_total_b);	
                ////--------------------------------------------------->
                gran_total_c = this.api()
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
                var gran_total_c = gran_total_c.toFixed(2);
                $(this.api().column(6).footer()).html(gran_total_c);

            }, 
            createdRow: function ( row, data, index )
            {    
                $('td', row).eq(4).css('font-weight', ' bold');
                $('td', row).eq(5).css('background-color', '#B2D8BB');
                $('td', row).eq(5).css('font-weight', ' bold');
                $('td', row).eq(6).css('background-color', '#75C788');
                $('td', row).eq(6).css('font-weight', ' bold');

            },
            
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                 },
                 "sProcessing":"Procesando...",
            },
        
        
            responsive: "true",
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",     
            buttons: [
            {
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Reporte de Inventario',
                filename: 'Reporte_de_Inventario_'+fecha_expor,
                //Aquí es donde generas el botón personalizado
                text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                },
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer: true,
                title: 'Reporte de inventario',
                filename: 'Reporte_de_inventario_'+fecha_expor,
                text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i></button>',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                },
            },
            
            //Botón para print
            {
                extend: 'print',
                footer: true,
                orientation:'landscape',
                filename: 'Imprimir_inventario',
                text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></button>',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                },

                customize: function(win)
                {
                    $(win.document.body)
                    .prepend(
                        '<img src="http://localhost/sisservitecam/dist/static/iconos/logofar.png" width="170" height="75"/>'
                    );
     
                    var last = null;
                    var current = null;
                    var bod = [];
     
                    var css = '@page { size: landscape; }',
                        head = win.document.head || win.document.getElementsByTagName('head')[0],
                        style = win.document.createElement('style');
     
                    style.type = 'text/css';
                    style.media = 'print';
     
                    if (style.styleSheet)
                    {
                      style.styleSheet.cssText = css;
                    }
                    else
                    {
                      style.appendChild(win.document.createTextNode(css));
                    }
     
                    head.appendChild(style);
                }

            },

        ],
        destroy: true,
      
        ajax:({          
            url : 'envios_bd/admin_inventario.php',
            method: 'POST', 
            data : {opc_invet}, 
            dataSrc:"",
           }),
    
           columns:[
            {data: "id_stock_productos"},
            {
                className: 'cod_material_clic',
                orderable: false,
                data: 'cod_barra',
            },
            {data: "nom_producto"},
            {data: "tipo_producto"},
            {data: "cantidad"},
            {data: "prec_venta",render: $.fn.dataTable.render.number(",", ".", 2, "$ ")},
            {data: "sub_total",render: $.fn.dataTable.render.number(",", ".", 2, "$ ")},
            {data: "prec_compra",render: $.fn.dataTable.render.number(",", ".", 2, "$ ")},
            {data: "porcen_utili"},
            {data: "estado"},
            {data: "usuario"},
            {defaultContent: "<button type='button' class='btn btn-sm btn-warning btn_claro add_producto'><i class='fas fa-plus'></i></button>"}, 
    
        ],
        
        }); 

    /// Mandar el dato en donde de clic al input 
    $(document).on("click", ".cod_material_clic", function(){
        const cod_produc_clic = parseInt($(this).closest('tr').find('td:eq(1)').text()) ;
        console.log(cod_produc_clic);
        $("#cod_barra").val(cod_produc_clic);
    });


    /// Abrir modal para editar el stock
    $(document).on("click", ".add_producto", function(){

        const id_stock_produc = $(this).closest('tr').find('td:eq(0)').text();		
        const cod_barra = $(this).closest('tr').find('td:eq(1)').text();
        const nombre_product = $(this).closest('tr').find('td:eq(2)').text();
        const tipo_produc = $(this).closest('tr').find('td:eq(3)').text();
        const cantidad_exit = $(this).closest('tr').find('td:eq(4)').text() ;
        const precio_venta = $(this).closest('tr').find('td:eq(5)').text();
        const precio_compra = $(this).closest('tr').find('td:eq(7)').text();
        const porcen_utili = $(this).closest('tr').find('td:eq(8)').text();
        
        $("#id_stock_add").val(id_stock_produc);
        $("#cod_barra_add").val(cod_barra);
        $("#nom_producto_add").val(nombre_product);
        $("#stock_exi_add").val(cantidad_exit);
        $("#tipo_producto").val(tipo_produc);
        $("#pre_compra_add").val(convertCurrencyToNumber(precio_compra));
        $("#porcen_utili_add").val(porcen_utili);
        $("#prec_vent_add").val(convertCurrencyToNumber(precio_venta));

        $('#modaleditar_stock').modal({backdrop: 'static', keyboard: false})
        $('#modaleditar_stock').modal('show');
        
    });

    //Enviar formulario agregar producto
    $('#form_add_productos').submit(function(e){                         
        e.preventDefault(); 
        var datos_agregar_pro = 'envios_bd/admin_inventario.php';

        if ($('#activar_campo_precios').is(':checked')) {

            $.ajax({
                type : 'POST',
                url : datos_agregar_pro,
                data : $('#form_add_productos').serialize(),
                success: function (data){
                    if (data==1) 
                        {
                        document.getElementById("form_add_productos").reset();
                        stock_productos.ajax.reload(null, false);
                        Swal.fire({
                            type: 'success',
                            title: 'Productos y nuevo precio, agregados correctamente',
                            text: 'Exito !!!', })
                        } 
                    else 
                        {
                        Swal.fire({
                            type: 'error',
                            title: 'Productos y precio no agregados',
                            text: 'Error !!!',
                        })
                        }
                }
                }) 
            
        } else {
            let id_stockadd = $('#id_stock_add').val();
            let cod_barraadd = $('#cod_barra_add').val();
            let nom_productoadd = $('#nom_producto_add').val();
            let tipoproducto = $('#tipo_producto').val();
            let stock_exiadd = $('#stock_exi_add').val();
            let new_stockadd = $('#new_stock_add').val();
            let cant_newproduc = $('#cant_new_produc').val();
            let opc_invet = "guardar_stock_sin_precios";

            $.ajax({
                type : 'POST',
                url : datos_agregar_pro,
                data : {id_stockadd : id_stockadd,
                        cod_barraadd : cod_barraadd,
                        nom_productoadd : nom_productoadd,
                        tipoproducto : tipoproducto,
                        stock_exiadd : stock_exiadd,
                        new_stockadd : new_stockadd,
                        cant_newproduc : cant_newproduc,
                        opc_invet : opc_invet},
                success: function (data){
                    if (data==1) 
                        {
                        document.getElementById("form_add_productos").reset();
                        stock_productos.ajax.reload(null, false);
                        Swal.fire({
                            type: 'success',
                            title: 'Productos agregados correctamente',
                            text: 'Exito !!!', })
                        } 
                    else 
                        {
                        Swal.fire({
                            type: 'error',
                            title: 'Productos no agregados',
                            text: 'Error !!!',
                        })
                        }
                }
                }) 
        }
                              
    });

    
    /// Abrir modal para agregar nuevp producto
    $(document).on("click", ".add_new_producto", function(){

        $('#moda_add_newproduc').modal({backdrop: 'static', keyboard: false})
        $('#moda_add_newproduc').modal('show');
        
    });

    //// Enviar registro de nuevo productos
    $('#forma_new_producto').submit(function(e){                         
        e.preventDefault(); 
    
        let form_datos = document.getElementById("forma_new_producto");
        let formData = new FormData(form_datos);
    
        var datos_producto = 'envios_bd/admin_inventario.php';
        $.ajax({
            type : 'POST',
            url : datos_producto,
            processData: false,
            contentType: false,
            data: formData,
    
            success: function (data)
            {
        
            if (data==1) {
                document.getElementById("forma_new_producto").reset();
    
                Swal.fire({
                    type: 'success',
                    title: 'Producto guardado',
                    text: 'Exito !!!', })
                    stock_productos.ajax.reload(null, false);
                        } 
                        else 
                            {
                            Swal.fire({
                                type: 'error',
                                title: 'Producto no guardado',
                                text: 'Error!!!',
                            })
                            }
                    }
    
                })          
    })
        
    
    document.getElementById('remo_aler').style.backgroundColor = '#cce5ff';
    /// activar campos de precios
    $('#activar_campo_precios').click(function () {
        if ($('#activar_campo_precios').is(':checked')) {
        
            $("#pre_compra_add").removeAttr("readonly");
            $("#porcen_utili_add").removeAttr("readonly");
            //$("#prec_vent_add").removeAttr("readonly");
            document.getElementById('remo_aler').style.backgroundColor = '#f8d7da';

            // $("#pre_compra_add").val('');
            // $("#porcen_utili_add").val('');
            // $("#prec_vent_add").val('');
            
        } else {
            $("#pre_compra_add").attr("readonly","readonly");
            $("#porcen_utili_add").attr("readonly","readonly");
            //$("#prec_vent_add").attr("readonly","readonly");
            document.getElementById('remo_aler').style.backgroundColor = '#cce5ff';

        
        }
    });

    }); 

    function convertCurrencyToNumber(currencyStr) {
        // Eliminar el símbolo de moneda, las comas y los espacios
        var cleanedStr = currencyStr.replace(/[$,\s]/g, '');
        // Convertir la cadena limpia a un número
        var number = parseFloat(cleanedStr);
        return number;
    }

    function ganancia_porcen (){

        var myFloat = pre_compra = parseFloat($('#total').val());
        var myFloat = porcen_utili = parseFloat($('#porcen_ganancia').val());
        var myFloat = precio_vta = parseFloat($('#total_neto').val());
    
        if (isNaN(pre_compra) || isNaN(porcen_utili))  
        {
            pre_compra=0.00;
            precio_vta=0.00;
            porcen_utili=0;
        }
        var myFloat = porcen_ganancia = pre_compra/100 * porcen_utili;
        aplicar_ganancia = parseFloat(porcen_ganancia) + parseFloat(pre_compra);
        var myFloat = aplicar_ganancia = aplicar_ganancia.toFixed(2); 
        $('input#total_neto').val(aplicar_ganancia);
       
    }
    
    function obtener_porcen (){
    
        var myFloat = pre_compra = parseFloat($('#total').val());
        var myFloat = porcen_utili = parseFloat($('#porcen_ganancia').val());
        var myFloat = precio_vta = parseFloat($('#total_neto').val());
    
        var myFloat = numcien = 100;
    
        if (isNaN(porcen_utili) || isNaN(precio_vta))  
        {
            porcen_utili=0.00;
            precio_vta=0.00;
            
        }
        var myFloat = porcentaje = precio_vta / pre_compra;
        porcentaje_ganancia = parseFloat(porcentaje) * Number(numcien);
        porcentajeganancia = parseFloat(porcentaje_ganancia) - Number(numcien);
        var myFloat = porc_ganan = porcentajeganancia.toFixed(2); 
    
    
        $('input#porcen_ganancia').val(porc_ganan);
       
    }

    function ganancia_porcen_add (){

        var myFloat = pre_compra = parseFloat($('#pre_compra_add').val());
        var myFloat = porcen_utili = parseFloat($('#porcen_utili_add').val());
        var myFloat = precio_vta = parseFloat($('#prec_vent_add').val());

        if (isNaN(pre_compra) || isNaN(porcen_utili))  
        {
            pre_compra=0.00;
            precio_vta=0.00;
            porcen_utili=0;
        }
        var myFloat = porcen_ganancia = pre_compra/100 * porcen_utili;
        aplicar_ganancia = parseFloat(porcen_ganancia) + parseFloat(pre_compra);
        var myFloat = aplicar_ganancia = aplicar_ganancia.toFixed(2); 
        $('input#prec_vent_add').val(aplicar_ganancia);
       
    }
    
    function obtener_porcen_add (){
    
        var myFloat = pre_compra = parseFloat($('#pre_compra_add').val());
        var myFloat = porcen_utili = parseFloat($('#porcen_utili_add').val());
        var myFloat = precio_vta = parseFloat($('#prec_vent_add').val());
    
        var myFloat = numcien = 100;
    
        if (isNaN(porcen_utili) || isNaN(precio_vta))  
        {
            porcen_utili=0.00;
            precio_vta=0.00;
            
        }
        var myFloat = porcentaje = precio_vta / pre_compra;
        porcentaje_ganancia = parseFloat(porcentaje) * Number(numcien);
        porcentajeganancia = parseFloat(porcentaje_ganancia) - Number(numcien);
        var myFloat = porc_ganan = porcentajeganancia.toFixed(2); 
    
    
        $('input#porcen_utili_add').val(porc_ganan);
       
    }

    function suma_num_producto (){

        var myFloat = stock_exiadd = parseFloat($('#stock_exi_add').val());
        var myFloat = new_stockadd = parseFloat($('#new_stock_add').val());

        if (isNaN(new_stockadd) || isNaN(stock_exiadd))  
        {
            new_stockadd=0.00;
            cant_newproduc=0.00;
        }
        var producto_total = 0;
           producto_total = parseFloat(stock_exiadd) + parseFloat(new_stockadd);
        var myFloat = productototal = producto_total.toFixed(0); 
        $('input#cant_new_produc').val(productototal);
       
    }