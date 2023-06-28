$(document).ready(function() {

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
fecha_info2= date.toISOString().split('T')[0];

var fecha_info1 = "2000/01/01";
tabla_reporte_venta (fecha_info1, fecha_info2);


});

/// funcion de tabla de reporte de ventas

function tabla_reporte_venta (fecha_1_, fecha_2_) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    const fecha_1 = fecha_1_;
    const fecha_2 = fecha_2_;

    var opc_repor_vta = 'lista_repor_venta';
    reporte_venta_tabla = $('#reporte_venta_tabla').DataTable({  

        "footerCallback": function ( row, data, start, end, display )
        {
            
            //----------------->

            total_descuento = this.api()
                .column(3)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
               
            $(this.api().column(3).footer()).html('<i class="fas fa-tags"></i> '+total_descuento);	
            
            //----------------->

            total_vta_venta = this.api()
            .column(5)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            total_vta_ventas = total_vta_venta.toFixed(3); 
            $(this.api().column(5).footer()).html('<i class="fas fa-money-bill-wave"></i> '+total_vta_ventas);	

            
            //----------------->

            cant_vta_venta = this.api()
            .column(6)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
           
            $(this.api().column(6).footer()).html('<i class="fas fa-sort-amount-up-alt"></i> '+cant_vta_venta);	

            
            //----------------->

            
            total_venta = this.api()
            .column(7)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            total_ventas = total_venta.toFixed(3); 
            $(this.api().column(7).footer()).html('<i class="fas fa-money-bill-wave"></i> '+ total_ventas);	

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
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de venta',
            filename: 'Reporte_de_venta_'+fecha_expor,
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir venta',
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></button>'
        },
    //Botón para colvis para ejegir que columnas quieres mostrar
        {
            extend: 'colvis',
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-crop-alt"></i></button>',
            postfixButtons: ['colvisRestore']
        }
    ],
    destroy: true,
  
    ajax:({          
        url : 'envios_bd/admin_reporte_venta.php',
        method: 'POST', 
        data : {opc_repor_vta, fecha_1, fecha_2}, 
        dataSrc:"",
       }),

       columns:[
        {data: "id_num_factura"},
        {data: "cod_barra"},
        {data: "nombre_product"},
        {data: "total_descuent"},
        {data: "id_cant_porcendes"},
        {data: "prec_venta_detall"},
        {data: "cant_detall"},
        {data: "sub_total"},
        {data: "fecha_factura"},
        {data: "nombre_cliente"},
        {data: "usuario"},
        {defaultContent: "<button type='button' class='btn btn-primary btn-sm'  style='width: 80%' disabled><i class='fas fa-check'></i></button>"}, 

    ],
    
    });  
}