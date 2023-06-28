$(document).ready(function() {
    /// Detectar cambio en la fecha1 y mandar los valores
$('#fecha_repor').on('change', '#fecha_info1', function (){
    fecha_info1  = $.trim($("#fecha_info1").val());
    fecha_info2  = $.trim($("#fecha_info2").val());

    tabla_ventas_utilidad (fecha_info1, fecha_info2);
    tabla_11 (fecha_info1, fecha_info2);
    tabla_22 (fecha_info1, fecha_info2);
    $('#total_utilidad').html('0.000 C$');  
    
}); 


/// Detectar cambio en la fecha2 y mandar los valores
$('#fecha_repor').on('change', '#fecha_info2', function (){
    const fecha_info1  = $.trim($("#fecha_info1").val());
    const fecha_info2  = $.trim($("#fecha_info2").val());
    $('#total_utilidad').html('0.000 C$');  

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
            tabla_ventas_utilidad (fecha_info1, fecha_info2);
            tabla_11 (fecha_info1, fecha_info2);
            tabla_22 (fecha_info1, fecha_info2);
        }
}); 

/// Envio datos predeterminados al cargar la pagina
let date = new Date();
fecha_info2= date.toISOString().split('T')[0];
var fecha_info3 = "0000/00/00";
var fecha_info1 = "0000/00/00";
tabla_ventas_utilidad ();


$('#total_utilidad').html('0.000 C$');  


});

/// funcion de tabla de reporte de ventas
function tabla_ventas_utilidad () {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    // const fecha_1 = fecha_1_;
    // const fecha_2 = fecha_2_;

    var opc_repor_vta = 'lista_utilidad';
    reporte_ventas_utilidad = $('#reporte_ventas_utilidad').DataTable({  

        "footerCallback": function ( row, data, start, end, display )
        {

            entradas_1 = this.api()
            .column(2)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            entradas1 = entradas_1.toFixed(3); 
            var myNumeral = numeral (entradas1);
            var entradas11 = myNumeral.format('0,0.000');
            $(this.api().column(2).footer()).html('<i class="fas fa-money-bill-wave"></i> '+ entradas11);	
            //----------------->

            salario_1 = this.api()
            .column(3)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            salario1 = salario_1.toFixed(3);  
            var myNumeral = numeral (salario1);
            var salario11 = myNumeral.format('0,0.000');
            $(this.api().column(3).footer()).html('<i class="fas fa-money-bill-wave"></i> '+salario11);	
            
            //----------------->
            
            utilidad_1 = this.api()
            .column(4)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            utilidad1 = utilidad_1.toFixed(3); 
            var myNumeral = numeral (utilidad1);
            var utilidad11 = myNumeral.format('0,0.000');

            $(this.api().column(4).footer()).html('<i class="fas fa-money-bill-wave"></i> '+ utilidad11);	


        }, 
        
        createdRow: function ( row, data, index )
        {    

            if (data['utilidad'] < 0)
            {
                $('td', row).eq(4).css('background-color', '#dc3545');
                $('td', row).eq(4).css('font-weight', ' bold');
            }
            if (data['utilidad'] > 0)
            {
                $('td', row).eq(4).css('background-color', '#198754');
                $('td', row).eq(4).css('font-weight', ' bold');
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
            title: 'Reporte de utilidades',
            filename: 'Reporte_de_utilidades'+fecha_expor,
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de utilidades',
            filename: 'Reporte_de_utilidades'+fecha_expor,
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir utilidades',
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></button>'
        },
    //Botón para colvis para ejegir que columnas quieres mostrar
        // {
        //     extend: 'colvis',
        //     text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-crop-alt"></i></button>',
        //     postfixButtons: ['colvisRestore']
        // }
    ],
    destroy: true,
    order: [[ 0, 'des']],
  
    ajax:({          
        url : 'envios_bd/admin_venta_utilidad.php',
        method: 'POST', 
        data : {opc_repor_vta}, 
        dataSrc:"",
       }),

       columns:[
        {data: "id_utili"},
        {data: "salidas"},
        {data: "entradas"},
        {data: "salarios"},
        {data: "utilidad"},
        {data: "fecha_reali"},
        {data: "fecha_1r"},
        {data: "fecha_2r"},
        {data: "usuario"},
        {defaultContent: "<button type='button' class='btn btn-primary btn-sm'  style='width: 80%' disabled><i class='fas fa-check'></i></button>"}, 

    ],
    
    });  
}
