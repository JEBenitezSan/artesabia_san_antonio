$(document).ready(function() {
    /// Detectar cambio en la fecha1 y mandar los valores
$('#fecha_repor').on('change', '#fecha_info1', function (){
    fecha_info1  = $.trim($("#fecha_info1").val());
    fecha_info2  = $.trim($("#fecha_info2").val());

    tabla_ventas_utilidad (fecha_info1, fecha_info2);
    tabla_ventas_servicios (fecha_info1, fecha_info2);
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
            tabla_ventas_servicios (fecha_info1, fecha_info2);
            tabla_11 (fecha_info1, fecha_info2);
            tabla_22 (fecha_info1, fecha_info2);
        }
}); 

/// Envio datos predeterminados al cargar la pagina
let date = new Date();
fecha_info2= date.toISOString().split('T')[0];
var fecha_info3 = "0000/00/00";
var fecha_info1 = "0000/00/00";
tabla_ventas_utilidad (fecha_info1, fecha_info3);
tabla_ventas_servicios (fecha_info1, fecha_info3);
tabla_11 (fecha_info1, fecha_info3);
tabla_22 (fecha_info1, fecha_info3);

$('#total_utilidad').html('0.000 C$');  

/// Calcular utilidad
$("#cal_utili").click(function(){

    total_salidas_id = document.getElementById("total_salidas_id").textContent;
    total_gananciapro_id = document.getElementById("total_gananciapro_id").textContent;
    total_salario_id = document.getElementById("total_salario_id").textContent;

    console.log(total_salidas_id, total_gananciapro_id, total_salario_id);

    var total_final = parseFloat(total_salario_id) + parseFloat(total_salidas_id);
    var total_final_neto = total_gananciapro_id - total_final;

     var myNumeral = numeral (total_final_neto);
     var totalfinalneto = myNumeral.format('0,0.000');

     $('#total_utilidad').html(totalfinalneto+' C$');

     if  (total_final_neto < 0 ) {
             document.getElementById('card_caja_utili').style.backgroundColor = "#D13B4D";
             document.getElementById('card_header_utili').style.backgroundColor = "#CE081F";
     }

     else if  (total_final_neto >= 0 ) {
        document.getElementById('card_caja_utili').style.backgroundColor = "#85C627";
        document.getElementById('card_header_utili').style.backgroundColor = "#4D7F04";
      }
});

/// Guardar utilidad
$("#guardar_final_utili").click(function(){

    val_fecha_info1 = $.trim($("#fecha_info1").val());
    val_fecha_info2 = $.trim($("#fecha_info2").val());
    total_salidas_id = document.getElementById("total_salidas_id").textContent;
    gran_totalentradasid = document.getElementById("total_gananciapro_id").textContent;
    total_salario_id = document.getElementById("total_salario_id").textContent;
    user_planilla = document.getElementById("user_planilla").value;
    
    var total_final = parseFloat(total_salario_id) + parseFloat(total_salidas_id);
    var total_final_neto = total_gananciapro_id - total_final;
    opc_repor_vta = "guardar_uti_final" 

    if (( val_fecha_info1 == 0) || ( val_fecha_info2 == 0)) {
        Swal.fire({
            type: 'warning',
            title: 'No es posible',
            text: 'Verifica que este seleccionado un rango de fecha',
        })

    }
    else {
        
        var obj_utili_final = {
            fech1: val_fecha_info1,
            fech2: val_fecha_info2,
            salida_id: total_salidas_id,
            entrada_id: total_gananciapro_id,
            salario_id: total_salario_id,
            utilidad_id: total_final_neto,
            user: user_planilla,
            opc_repor_vta: opc_repor_vta,
          }

          const direc_registrar = 'envios_bd/admin_venta_utilidad.php';              
          $.ajax({
          type : 'POST',
          url : direc_registrar,
          data : obj_utili_final,
          success: function (data)
          {
      
            if (data==1) 
            {
                Swal.fire({
                    type: 'success',
                    title: 'Datos Guardados',
                    text: 'Utilidad consultada guardada',
                    footer: 'Exito !!!',
                });

            } 
            else 
                {
                    Swal.fire({
                        type: 'error',
                        title: 'Datos no editados',
                        text: 'Utilidad consultada no guardada',
                        footer: 'Error !!!',
                    });
                }
          }
      
          })

    }

});


});

/// funcion de tabla de reporte de ventas
function tabla_ventas_utilidad (fecha_1_, fecha_2_) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    const fecha_1 = fecha_1_;
    const fecha_2 = fecha_2_;

    var opc_repor_vta = 'lista_repor_venta';
    reporte_ventas_utilidad = $('#reporte_ventas_utilidad').DataTable({  

        "footerCallback": function ( row, data, start, end, display )
        {
        
            //----------------->
            
            total_venta = this.api()
            .column(7)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            total_ventas = total_venta.toFixed(3); 
            $(this.api().column(7).footer()).html('<i class="fas fa-money-bill-wave"></i> '+ total_ventas);	

            $('#total_entradas_id').html(total_ventas); 

            //----------------->

            total_compra = this.api()
            .column(8)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            totalcompra = total_compra.toFixed(3); 
        $(this.api().column(8).footer()).html('<i class="fas fa-tags"></i> '+totalcompra);	

        let utili_produc = total_ventas - totalcompra;
        $(this.api().column(9).footer()).html('<i class="fas fa-money-check-alt"></i> '+utili_produc);	

        $('#total_gananciapro_id').html(utili_produc.toFixed(3)); 


            

        }, 

        createdRow: function ( row, data, index )
        {    
            $('td', row).eq(7).css('background-color', '#2F98D3');
            $('td', row).eq(7).css('font-weight', ' bold');
            $('td', row).eq(8).css('background-color', '#C87141');
            $('td', row).eq(8).css('font-weight', ' bold');
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
  
    ajax:({          
        url : 'envios_bd/admin_venta_utilidad.php',
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
        {data: "prec_compra"},
        {data: "fecha_factura"},
        {data: "nombre_cliente"},
        {data: "usuario"},
        {defaultContent: "<button type='button' class='btn btn-primary btn-sm'  style='width: 80%' disabled><i class='fas fa-check'></i></button>"}, 

    ],
    
    });  
}
/// funcion de tabla de reporte de servicio
function tabla_ventas_servicios (fecha_1_, fecha_2_) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    const fecha_1 = fecha_1_;
    const fecha_2 = fecha_2_;

    var opc_repor_vta = 'lista_servicio';
    reporte_ventas_utilidad = $('#reporte_ventas_servicios').DataTable({  

        "footerCallback": function ( row, data, start, end, display )
        {
            
            //----------------->

            total_inver = this.api()
                .column(3)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
                totalinver = total_inver.toFixed(3); 
            $(this.api().column(3).footer()).html('<i class="fas fa-tags"></i> '+totalinver);	
            
            //----------------->
            
            total_venta_servi = this.api()
            .column(7)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            total_ventas_servi = total_venta_servi; 
            $(this.api().column(7).footer()).html('<i class="fas fa-money-bill-wave"></i> '+ total_ventas_servi.toFixed(3));	
            $('#total_servicios_id').html(total_ventas_servi.toFixed(3)); 

            total_gananciapro_id = document.getElementById("total_gananciapro_id").textContent;
            totalentrada = parseFloat(total_ventas_servi) + parseFloat(total_gananciapro_id);


            var myNumeral = numeral (totalentrada);
            var totalventasservi = myNumeral.format('0,0.000');

            $('#total_entradas').html(totalventasservi+' C$'); 
            $('#gran_totalentradasid').html(totalentrada.toFixed(3)); 
            
  

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
  
    ajax:({          
        url : 'envios_bd/admin_venta_utilidad.php',
        method: 'POST', 
        data : {opc_repor_vta, fecha_1, fecha_2}, 
        dataSrc:"",
       }),

       columns:[
        {data: "id_num_factura"},
        {data: "id_servicio"},
        {data: "observaciones"},
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

/// Funcion de lista de salidas
function tabla_11 (fecha_1_, fecha_2_) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    const fecha_11 = fecha_1_;
    const fecha_22 = fecha_2_;

    var opc_repor_vta = 'lista_salida';
    tabla_1 = $('#tabla_1').DataTable({  
    
            "footerCallback": function ( row, data, start, end, display )
            {
                sum_salida = this.api()
                    .column(3)
                    .data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0 );
                sumsalida = sum_salida.toFixed(3); 
                $(this.api().column(3).footer()).html('<i class="fas fa-money-bill-wave"></i> '+sumsalida);	

                var myNumeral = numeral (sumsalida);
                var su_salida = myNumeral.format('0,0.000');

                $('#total_salidas').html(su_salida+' C$');  

                $('#total_salidas_id').html(sumsalida);  
    
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
                title: 'Reporte de salida',
                filename: 'Reporte_de_salida'+fecha_expor,
                //Aquí es donde generas el botón personalizado
                text: '<button type="button" class="btn btn-danger btn-sm"><i class="fas fa-file-excel"></i></button>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer: true,
                title: 'Reporte de salidas',
                filename: 'Reporte_de_salida'+fecha_expor,
                text: '<button type="button" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></button>',
                exportOptions: {
                    columns: [0, ':visible']
                },
    
            },
            
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Imprimir clientes',
                text: '<button type="button" class="btn btn-danger btn-sm"><i class="fas fa-print"></i></button>'
            },
        //Botón para colvis para ejegir que columnas quieres mostrar
            // {
            //     extend: 'colvis',
            //     text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-crop-alt"></i></button>',
            //     postfixButtons: ['colvisRestore']
            // }
        ],
        destroy: true,
      
        ajax:({          
            url : 'envios_bd/admin_venta_utilidad.php',
            method: 'POST', 
            data : {opc_repor_vta, fecha_11, fecha_22}, 
            dataSrc:"",
           }),
    
           columns:[
            {data: "id_salida"},
            {data: "tipo_salida"},
            {data: "descripcion_salida"},
            {data: "monto_salida"},
            {data: "usuario"},
            {data: "id_caja"},
            {data: "descrip_cerrar_caja"},
            {data: "fecha_salida"},
            {defaultContent: "<button type='button' class='btn btn-primary btn-sm'  style='width: 80%' disabled><i class='fas fa-check'></i></button>"}, 
    
        ],

    
    });  
}
/// Funcion de salarios
function tabla_22 (fecha_1_, fecha_2_) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    const fecha_111 = fecha_1_;
    const fecha_222 = fecha_2_;

    var opc_repor_vta = 'lista_planilla';
    tabla_2 = $('#tabla_2').DataTable({  
    
        "footerCallback": function ( row, data, start, end, display )
        {
            

                sum_comision = this.api()
                .column(2)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
            sumcomision = sum_comision.toFixed(3); 
            $(this.api().column(2).footer()).html('<i class="fas fa-tags"></i> '+sumcomision);

            /// -------------------------------------------------->

                sum_salario = this.api()
                .column(3)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
            sumsalario = sum_salario.toFixed(3); 
            $(this.api().column(3).footer()).html('<i class="fas fa-tags"></i> '+sumsalario);

            /// -------------------------------------------------->

                sum_total_pago = this.api()
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
            sumtotalpago = sum_total_pago.toFixed(3); 
            $(this.api().column(4).footer()).html('<i class="fas fa-money-bill-wave"></i> '+sumtotalpago);
            
            var myNumeral = numeral (sumtotalpago);
            var su_totalpago = myNumeral.format('0,0.000');

            $('#total_salario').html(su_totalpago+' C$');  
 
            $("#total_salario_id").html(sumtotalpago);

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
                title: 'Reporte de planilla',
                filename: 'Reporte_de_planilla'+fecha_expor,
        
                //Aquí es donde generas el botón personalizado
                text: '<button type="button" class="btn btn-danger btn-sm"><i class="fas fa-file-excel"></i></button>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer: true,
                title: 'Reporte de planilla',
                filename: 'Reporte_de_planilla'+fecha_expor,
                text: '<button type="button" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></button>',
                exportOptions: {
                    columns: [0, ':visible']
                },
    
            },
            
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Imprimir planilla',
                text: '<button type="button" class="btn btn-danger btn-sm"><i class="fas fa-print"></i></button>'
            },
        //Botón para colvis para ejegir que columnas quieres mostrar
            // {
            //     extend: 'colvis',
            //     text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-crop-alt"></i></button>',
            //     postfixButtons: ['colvisRestore']
            // }
        ],
        destroy: true,
      
        ajax:({          
            url : 'envios_bd/admin_venta_utilidad.php',
            method: 'POST', 
            data : {opc_repor_vta, fecha_111, fecha_222}, 
            dataSrc:"",
           }),
    
           columns:[
            {data: "id_plani_pago"},
            {data: "vendedor"},
            {data: "comision"},
            {data: "salario_neto"},
            {data: "total_neto"},
            {data: "fecha_realizada"},
            {data: "user"},
            {defaultContent: "<button type='button' class='btn btn-primary btn-sm'  style='width: 80%' disabled><i class='fas fa-check'></i></button>"}, 
    
        ],

    
    });  
}
