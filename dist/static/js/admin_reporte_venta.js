$(document).ready(function() {

// Abrir modal detalle de factura
$(document).on('click', '.detalle_fac', function (event) {
        event.preventDefault();

        let id_factura = $(this).closest('tr').find('td:eq(1)').text();
        detalle_factura ( id_factura );

    $('#modal_detalle_facturado').modal({backdrop: 'static', keyboard: false})
    $('#modal_detalle_facturado').modal('show');
});

/// Borrar abordaje y todos los pasajeros que contengan ese abordaje
$(document).on('click', '.borrar_producto_fac', function() {

   var id_detalle_fac = parseInt($(this).closest('tr').find('td:eq(0)').text());
   var num_factura_deta = parseInt($(this).closest('tr').find('td:eq(1)').text());
   var cod_barra = $(this).closest('tr').find('td:eq(2)').text();
   var producto = $(this).closest('tr').find('td:eq(3)').text();
   var cantidad_rever = $(this).closest('tr').find('td:eq(5)').text();



            var opc_repor_vta = "borrar_producto_fac";
            var datospaciente = 'envios_bd/admin_reporte_venta.php';

                    Swal.fire({
                        type:'warning',
                        title:'Quieres eliminar de forma permanete el producto : '+producto+' ?',
                        showCancelButton: true,
                        confirmButtonColor:'#3085d6',
                        confirmButtonText:'Aceptar',
                        cancelButtonText: 'Cancelar',
                        allowEscapeKey: false, // Para evitar que se cierre con la tecla Escape
                        allowOutsideClick: false, // Para evitar que se cierre haciendo clic afuera del cuadro de diálogo
                    }).then((result) => {
                       if(result.value){

                                $.ajax({
                                    type : 'POST',
                                    url : datospaciente,
                                    data : { id_detalle_fac : id_detalle_fac, 
                                             opc_repor_vta : opc_repor_vta, 
                                             cod_barra : cod_barra,
                                             cantidad_rever : cantidad_rever,
                                             num_factura_deta : num_factura_deta },
                                    success: function (data){
                            
                                    if (data==1) {
                            
                                        Swal.fire({
                                            type: 'success',
                                            title: 'Producto borrado correctamente',
                                            text: 'Exito !!!', })
                                            detalle_factura_produc.ajax.reload(null, false);
                                            reporte_venta_tabla.ajax.reload(null, false);

                                                } 
                                                else 
                                                {
                                                    Swal.fire({
                                                        type: 'error',
                                                        title: 'Producto no borrado',
                                                        text: 'Error !!!',
                                                    })
                                                }
                                        }
                            
                                        });
                          
                                   }
                  })
});
 

/// imprimir factura copia
$(document).on("click", ".fac_print_copi", function(){

    num_factura = parseInt($(this).closest('tr').find('td:eq(1)').text());
    $(".num_fac").val(num_factura);
   
});

    /// Detectar cambio en la fecha1 y mandar los valores
$('#fecha_repor').on('change', '#fecha_info1', function (){
    fecha_info1  = $.trim($("#fecha_info1").val());
    fecha_info2  = $.trim($("#fecha_info2").val());

    tabla_reporte_venta (fecha_info1, fecha_info2);
    
}); 

/// Detectar cambio en la fecha2 y mandar los valores
$('#fecha_repor').on('change', '#fecha_info2', function (){
    fecha_info1  = $.trim($("#fecha_info1").val());
    fecha_info2  = $.trim($("#fecha_info2").val());

    if(fecha_info1 > fecha_info2)

        {
            $('#fecha_info2').val('').focus();

                Swal.fire({
                    type: 'warning',
                    title: 'No es posible',
                    text: 'La fecha final, no puede ser menor a la fecha inicial Verifica...!',
                    footer: '<a href>Ayuda</a>',
                })

        } 

    else 
        {
            tabla_reporte_venta (fecha_info1, fecha_info2);
        }
}); 

/// Envio datos predeterminados al cargar la pagina
let date = new Date();
let year = date.getFullYear();
let month = String(date.getMonth() + 1).padStart(2, '0'); // Los meses empiezan desde 0
let day = String(date.getDate()).padStart(2, '0');
let hours = String(date.getHours()).padStart(2, '0');
let minutes = String(date.getMinutes()).padStart(2, '0');
let seconds = String(date.getSeconds()).padStart(2, '0');

let fechaHoraActual = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

var fecha_info1 = "2000/01/01";
tabla_reporte_venta (fecha_info1, fechaHoraActual);


});
// Funcion detalle de factura
function detalle_factura ( id_factura ) {

    let idfactura = id_factura;
    var opc_repor_vta = 'detalle_fac';
        
    var today = new Date();

    const fecha_expor = today.toLocaleString() 
    
    detalle_factura_produc = $('#detalle_factura').DataTable({ 
                    
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
            $('td', row).eq(4).css('background-color', '#75C788');
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
            filename: 'Detalle_fac_'+idfactura+'_'+fecha_expor,
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
            filename: 'Detalle_fac_'+fecha_expor,
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
        url : 'envios_bd/admin_reporte_venta.php',
        method: 'POST', 
        data : {opc_repor_vta, idfactura}, 
        dataSrc:"",
       }),

       columns:[
        {data: "id_detall_factura"},
        {data: "id_num_factura"},
        {data: "cod_barra"},
        {data: "nom_producto"},
        {data: "prec_venta_detall",render: $.fn.dataTable.render.number(",", ".", 2, "$ ")},
        {data: "cant_detall"},
        {data: "sub_total",render: $.fn.dataTable.render.number(",", ".", 2, "$ ")},
        {defaultContent: "<button type='button' class='btn btn-sm btn-danger borrar_producto_fac'><i class='fas fa-trash-alt'></i></button>"}, 

    ],
    
    }); 

}
/// funcion de tabla de reporte de ventas

function tabla_reporte_venta (fecha_1_, fecha_2_) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    const fecha_1 = fecha_1_;
    const fecha_2 = fecha_2_;

    var opc_repor_vta = 'lista_repor_venta';

    const btn_print_copia = '<form id="form_copia_fact" method="POST" action="print_factura_copia.php" target="_blank">'+
    '<input type="hidden" class="form-control num_fac" name="num_fac" value="" id="num_fac">'+
    ' <button type="submit" class="btn btn-dark btn-sm fac_print_copi" style="width: 100%">'+
        '<i class="fa-solid fa-print"></i>'+
    '  </button>' 
    '</form>';
    reporte_venta_tabla = $('#reporte_venta_tabla').DataTable({  
        scrollX:        true,   // Habilitar desplazamiento horizontal
        scrollCollapse: true,   // Hacer colapsar el scroll cuando no haya suficientes filas
        fixedHeader: true,      // Fijar el encabezado
        scrollXInner: "100%",   //  

        "footerCallback": function ( row, data, start, end, display )
        {
            
            //----------------->

            total_descuento = this.api()
                .column(3)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
                           // Formatear el número
                totaldescuento = parseFloat(total_descuento).toLocaleString('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            $(this.api().column(3).footer()).html('<i class="fas fa-tags"></i> '+totaldescuento);	
            
            //----------------->

            total_vta_venta = this.api()
            .column(4)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
        
            total_vta_ventas = total_vta_venta.toFixed(2); 
            
            // Formatear el número
            total_vta_ventas_formateado = parseFloat(total_vta_ventas).toLocaleString('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            
            $(this.api().column(4).footer()).html('<i class="fas fa-money-bill-wave"></i> ' + total_vta_ventas_formateado);
            
            //----------------->

            cant_vta_venta = this.api()
            .column(5)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
           
            // Formatear el número
            cant_vtaventa = parseFloat(cant_vta_venta).toLocaleString('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            $(this.api().column(5).footer()).html('<i class="fas fa-sort-amount-up-alt"></i> '+cant_vtaventa);	

            
            //----------------->
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
            title: 'Reporte de venta',
            filename: 'Reporte_de_venta_'+fecha_expor,
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-warning btn_claro btn-sm"><i class="fas fa-file-excel"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de venta',
            filename: 'Reporte_de_venta_'+fecha_expor,
            text: '<button type="button" class="btn btn-warning btn_claro btn-sm"><i class="fas fa-file-pdf"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir venta',
            text: '<button type="button" class="btn btn-warning btn_claro btn-sm"><i class="fas fa-print"></i></button>'
        },

    ],
    destroy: true,
    order: [[1, 'desc']],
    ajax:({          
        url : 'envios_bd/admin_reporte_venta.php',
        method: 'POST', 
        data : {opc_repor_vta, fecha_1, fecha_2}, 
        dataSrc:"",
       }),

       columns:[

        { 
        className: 'detalle_fac',
        orderable: false,
        data: null,
        defaultContent: "<button type='button' class='btn btn-warning btn_claro btn-sm print'  style='width: 100%'><i class='fas fa-list-ol'></i></button>",
        }, 
        {data: "id_num_factura"},
        {data: "nom_cliente"},
        {data: "total_factura",render: $.fn.dataTable.render.number(",", ".", 2, "$ ")},
        {data: "total_descuent",render: $.fn.dataTable.render.number(",", ".", 2, "$ ")},
        {data: "total_fac_neto",render: $.fn.dataTable.render.number(",", ".", 2, "$ ")},
        {data: "id_cant_porcendes"},
        {data: "usuario"},
        {defaultContent: btn_print_copia}, 

    ],
    
    });  
}