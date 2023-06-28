$(document).ready(function() {

/// datas de productos
const id_usuario = $.trim($("#id_usuario").val());
data_produc_fac ( id_usuario );


    // Actualizar cada sierto tiempo los widgets de entradas, capital y utilidad

        setInterval(function(){
            productos_id.ajax.reload(null, false);
       }, 10000);


    /// mostrar detalle de productos cargado a la factura
    $(document).on("click", "tbody td.detallefact", function(){

        fila = $(this).closest("tr");	
        num_factura = parseInt(fila.find('td:eq(1)').text());
        tipo_fac = fila.find('td:eq(2)').text();

        detalle_porfactura ( num_factura, tipo_fac);

        $('#modal_detalle_venta').modal({backdrop: 'static', keyboard: false})
        $('#modal_detalle_venta').modal('show');

    });

/// imprimir factura copia
    $(document).on("click", ".fac_print_copi", function(){

        num_factura = parseInt($(this).closest('tr').find('td:eq(1)').text());
        tipofac = $(this).closest('tr').find('td:eq(2)').text();
        $(".num_fac").val(num_factura);
        $(".tipo_fac").val(tipofac);
        

    });


    
});  



/// Datos de productos que entran a caja
function data_produc_fac ( id_usuario ) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

        var opc_fac_user = "entradas_fac_user";

        productos_id = $('#productos_id').DataTable({  
            
            "footerCallback": function ( row, data, start, end, display )
            {
                tota_entra_desc = this.api()
                    .column(7)
                    .data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0 );
                    var tota_entra_desc = tota_entra_desc.toFixed(2);
                $(this.api().column(7).footer()).html(tota_entra_desc);	

                total_entra_sindes = this.api()
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
                var total_entra_sindes = total_entra_sindes.toFixed(2);
                $(this.api().column(5).footer()).html(total_entra_sindes);	

                descuento_aplica = this.api()
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
                var descuento_aplica = descuento_aplica.toFixed(2);
                $(this.api().column(6).footer()).html(descuento_aplica);	

                
                $("#total_cierre_caja").val(tota_entra_desc);
                
            },
            createdRow: function ( row, data, index )
            {    
                $('td', row).eq(0).css('background-color', '#E7E7E7');
                $('td', row).eq(8).css('background-color', '#34A2CB');
                $('td', row).eq(8).css('font-weight', ' bold');

                if (data['confirma_caja'] == "Pendiente" )
                {
                    $('td', row).eq(13).html("<button type='button' class='btn btn_perso_s btn-sm comfirmar_fac'><i class='fas fa-stopwatch fa-lg'></i></button>"); 
                    $('td', row).eq(13).css('background-color', '#E7E7E7');

                    $('td', row).eq(8).css('background-color', '#c9422a');
                    $('td', row).eq(11).css('background-color', '#c9422a');
                    $('td', row).eq(11).html("<i class='fas fa-exclamation-triangle'></i><strong> Pendiente</strong>");
                }
        
                if (data['confirma_caja'] == "Recibido" ) 
                { 
                     const btn_print_copia = '<form id="for_copia_user" method="POST" action="user_print_copia_fac.php">'+
                                            '<input type="hidden" class="form-control num_fac" name="num_fac" value="" id="num_fac">'+
                                            '<input type="hidden" class="form-control tipo_fac" name="tipo_fac" value="" id="tipo_fac">'+
                                            ' <button type="submit" class="btn btn-outline-primary btn-sm fac_print_copi">'+
                                                ' <img src="static/iconos/print.ico" alt="print" width="25" height="25">'+
                                            '  </button>'
                                            '</form>';

                    $('td', row).eq(13).html(btn_print_copia); 
                    // $('td', row).eq(12).css('background-color', '#E7E7E7');
                    $('td', row).eq(11).css('background-color', '#34A2CB');
                    $('td', row).eq(11).html("<i class='fas fa-check'></i> <strong> Recibido</strong>");
                }
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
                title: 'Reporte productos vendidos User',
                filename: 'Reporte_productos_vendido'+fecha_expor,
        
                //Aquí es donde generas el botón personalizado
                text: '<button type="button" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i></button>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer: true,
                title: 'Reporte productos vendidos User',
                filename: 'Reporte_productos_vendido'+fecha_expor,
                text: '<button type="button" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i></button>',
                exportOptions: {
                    columns: [0, ':visible']
                },
    
            },
            
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Imprimir productos vendidos user',
                text: '<button type="button" class="btn btn-info btn-sm"><i class="fas fa-print"></i></button>'
            },
        //Botón para colvis para ejegir que columnas quieres mostrar
            {
                extend: 'colvis',
                text: '<button type="button" class="btn btn-info btn-sm"><i class="fas fa-crop-alt"></i></button>',
                postfixButtons: ['colvisRestore']
            }
        ],
        destroy: true,

        "order": [[ 1, "desc" ]],
        
        ajax:({          
            url : 'envios_bd/user_admin_caja.php',
            method: 'POST', 
            data : {opc_fac_user, id_usuario}, 
            dataSrc:"",
           }),
    // <div class="entra_detalle_caja">  </div>
           columns:[
            {   className: 'detallefact',
                orderable: false,
                data: null,
                defaultContent: '<img src="static/iconos/shoppingcar.ico" alt="Exito" width="32" height="32">',
            }, 
            {data: "id_num_factura"},
            {data: "tipo_factura"},
            {data: "id_cliente"},
            {data: "nombre_apellido"},
            {data: "cant_detall"},
            {data: "total_factura"},
            {data: "total_descuent"},
            {data: "total_fac_neto"},
            {data: "efectivo"},
            {data: "vuelto_fac"},
            {data: "confirma_caja"},
            {data: "usuario"},
            {defaultContent: ''},  
        ],
        
        });  
    
}

/// Datos de detalle de facturas, modal todo los productos que estan cargados por cada factura
function detalle_porfactura ( num_factura, tipo_fac ) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 
    
    var opc_fac_user = "detalle_fac";

         const btn_accion_factu = "<div class='text-center'>"+
                                        "<div class='btn-group'>"+
                                                "<button class='btn btn-info btn-sm btneditar_detallefac_pro' disabled><i class='fas fa-pen'></i></button>"+
                                                "<button class='btn btn-danger btn-sm btnborrar_detallefac_pro' style='color:#000000' disabled><i class='fas fa-trash'></i></button>"+
                                        "</div>"+
                                    "</div>";

    detalle_venta_factura = $('#detalle_venta_factura').DataTable({  
        createdRow: function ( row, data, index )
        {    
                $('td', row).eq(7).html(btn_accion_factu);
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
            title: 'Reporte de productos fac',
            filename: 'Reporte_de_productos_fac'+fecha_expor,
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-sm" style="background-color:#2378D3"><i class="fas fa-file-excel fa-lg"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de productos fac',
            filename: 'Reporte_de_productos_fac'+fecha_expor,
            text: '<button type="button" class="btn btn-sm" style="background-color:#2378D3"><i class="fas fa-file-pdf fa-lg"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir productos fac',
            text: '<button type="button" class="btn btn-sm" style="background-color:#2378D3"><i class="fas fa-print fa-lg"></i></button>'
        },

    ],
    destroy: true,

    "order": [[ 1, "desc" ]],
    
    ajax:({          
        url : 'envios_bd/user_admin_caja.php',
        method: 'POST', 
        data : {num_factura, tipo_fac, opc_fac_user}, 
        dataSrc:"",
       }),
// <div class="entra_detalle_caja">  </div>
       columns:[
        {data: "id_detall_factura"},
        {data: "id_num_factura"},
        {data: "cod_barra"},
        {data: "nombre_product"},
        {data: "prec_venta_detall"},
        {data: "cant_detall"},
        {data: 'sub_total'},
        {defaultContent: ''},
        {data: 'id_detall_stock_pro'},
       
    ],
    
    });  

}


