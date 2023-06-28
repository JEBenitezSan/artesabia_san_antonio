$(document).ready(function() {

var today = new Date();
const fecha_expor = today.toLocaleString() 

const opc_procesos = "lista_procesos";

    // tabla_procesos = $('#tabla_procesos').DataTable({ 
        
    //     language: {
    //         "lengthMenu": "Mostrar _MENU_ registros",
    //         "zeroRecords": "No se encontraron resultados",
    //         "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    //         "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    //         "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    //         "sSearch": "Buscar:",
    //         "oPaginate": {
    //             "sFirst": "Primero",
    //             "sLast":"Último",
    //             "sNext":"Siguiente",
    //             "sPrevious": "Anterior"
    //         },
    //         "sProcessing":"Procesando...",
    //     },


    //     responsive: "true",
    //     dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
    //                 "<'row'<'col-sm-12'tr>>" +
    //                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",     
    //     buttons: [
    //     {
    //         //Botón para Excel
    //         extend: 'excelHtml5',
    //         footer: true,
    //         title: 'Reporte de Inventario',
    //         filename: 'Reporte_de_Inventario_'+fecha_expor,
    //         //Aquí es donde generas el botón personalizado
    //         text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>',
    //         exportOptions: {
    //             columns: [0,1,2,3,4,5,6,7,8,9,10,11]
    //         },
    //     },
    //     //Botón para PDF
    //     {
    //         extend: 'pdfHtml5',
    //         orientation: 'landscape',
    //         footer: true,
    //         title: 'Reporte de inventario',
    //         filename: 'Reporte_de_inventario_'+fecha_expor,
    //         text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i></button>',
    //         exportOptions: {
    //             columns: [0,1,2,3,4,5,6,7,8,9,10,11]
    //         },
    //     },
        
    //     //Botón para print
    //     {
    //         extend: 'print',
    //         footer: true,
    //         orientation:'landscape',
    //         filename: 'Imprimir_inventario',
    //         text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></button>',
    //         exportOptions: {
    //             columns: [0,1,2,3,4,5,6,7,8,9,10,11]
    //         },

    //         customize: function(win)
    //         {
    //             $(win.document.body)
    //             .prepend(
    //                 '<img src="http://localhost/sisservitecam/dist/static/iconos/logofar.png" width="170" height="75"/>'
    //             );

    //             var last = null;
    //             var current = null;
    //             var bod = [];

    //             var css = '@page { size: landscape; }',
    //                 head = win.document.head || win.document.getElementsByTagName('head')[0],
    //                 style = win.document.createElement('style');

    //             style.type = 'text/css';
    //             style.media = 'print';

    //             if (style.styleSheet)
    //             {
    //             style.styleSheet.cssText = css;
    //             }
    //             else
    //             {
    //             style.appendChild(win.document.createTextNode(css));
    //             }

    //             head.appendChild(style);
    //         }

    //     },
    // //Botón para colvis para ejegir que columnas quieres mostrar
    //     {
    //         extend: 'colvis',
    //         text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-crop-alt"></i></button>',
    //         postfixButtons: ['colvisRestore']
    //     }
    // ],
    // destroy: true,

    // ajax:({          
    //     url : 'envios_bd/admin_procesos.php',
    //     method: 'POST', 
    //     data : {opc_procesos}, 
    //     dataSrc:"",
    // }),

    // columns:[
    //     {data: "id_fabricacion"},
    //     {data: "cliente"},
    //     {data: "artesano"},
    //     {data: "fecha_inicio_fabrica"},
    //     {data: "estado"},
    //     {data: "fecha_final_fabrica"},
    //     {data: "nombre_diseno"},
    //     {data: "total",render: $.fn.dataTable.render.number(",", ".", 2, " ")},
    //     {defaultContent: "<button type='button' class='btn btn-sm btn-primary'><i class='fas fa-check'></i></button>"}, 
    // ],

    // }); 
    notificacion_lista (opc_procesos);

    $(document).on('click', '.card_noti', function(){

        document.getElementById("form_fabrica_final").reset();

        var cliente_f = $(this).closest('div').find('div:eq(0)').text();
        var id_fabricacion_d = $(this).closest('div').find('div:eq(2)').text();
        var artesano_d = $(this).closest('div').find('div:eq(3)').text();
        var fecha_inicio_fabrica_d = $(this).closest('div').find('div:eq(4)').text();
        var estado_d = $(this).closest('div').find('div:eq(5)').text();
        var fecha_final_fabrica_d = $(this).closest('div').find('div:eq(6)').text();
        var total_dias_d = $(this).closest('div').find('div:eq(7)').text();
        var nombre_modelo_d = $(this).closest('div').find('div:eq(8)').text();
        var nombre_diseno_d = $(this).closest('div').find('div:eq(9)').text();
        var total_d = $(this).closest('div').find('div:eq(10)').text();

        let id_fabricacion = id_fabricacion_d.split(' ');
        let artesano = artesano_d.split('  ');
        let fecha_inicio_fabrica = fecha_inicio_fabrica_d.split('  ');
        let estado = estado_d.split('  ');
        let fecha_final_fabrica = fecha_final_fabrica_d.split('  ');
        let total_dias = total_dias_d.split('  ');
        let nombre_diseno = nombre_diseno_d.split('  ');
        let nombre_modelo = nombre_modelo_d.split('  ');
        let total = total_d.split('  ');

        var fabricacion_json = {
            id_fabricacion: id_fabricacion[1],
            artesano: artesano[1],
            fecha_inicio_fabrica: fecha_inicio_fabrica[1],
            estado: estado[1],
            fecha_final_fabrica: fecha_final_fabrica[1],
            total_dias: total_dias[1],
            nombre_modelo: nombre_modelo[1],
            nombre_diseno: nombre_diseno[1],
            total: total[1],
            cliente_f: cliente_f,
          }

           $('#modal_final_fabricacion').modal({backdrop: 'static', keyboard: false})
           $('#modal_final_fabricacion').modal('show');

           $("#id_fabricacion").val(fabricacion_json.id_fabricacion);
           $("#artesano").val(fabricacion_json.artesano);
           $("#nombre_modelo").val(fabricacion_json.nombre_modelo);
           $("#nombre_diseno").val(fabricacion_json.nombre_diseno);
           $("#total").val(fabricacion_json.total);
           $("#cliente_f").val(fabricacion_json.cliente_f);


    });
    
// function getValue(e){
//     const variable = e.value;
//     console.log(variable);

//     onclick="getValue(this)"
//   }
});

function notificacion_lista (opc_procesos){
 
     $.ajax({
         url:"envios_bd/admin_procesos.php",
         type:"POST",
         datatype: "json",
         data: {opc_procesos}, 
         success:function(data2){
         var lis_no_js = JSON.parse(data2);
         if(lis_no_js)
         {
             var tabla_lista_notif = '';
             for(var i = 0; i < lis_no_js.length; i++)
                   {
                    
                    tabla_lista_notif+= '<div class="col-md-3"> <div id="card_not" class="card card_noti text-white bg-warning mb-3">'+
                                            '<div class="card-header color_header" align="center"><strong>'+lis_no_js[i].cliente+'</strong></div>'+
                                            '<div class="card-body">'+
                                                '<div><i class="fas fa-shield-alt"></i> '+lis_no_js[i].id_fabricacion+'</div>'+
                                                '<div> Artesano: <i class="fas fa-tools"></i> '+lis_no_js[i].artesano+'</div>'+
                                                '<div> Fecha inicio: <i class="fas fa-calendar-alt"></i> '+lis_no_js[i].fecha_inicio_fabrica+'</div>'+
                                                '<div> Estado: <i class="fas fa-info-circle"></i> '+lis_no_js[i].estado+'</div>'+
                                                '<div> Fecha finaliza: <i class="fas fa-calendar-alt"></i> '+lis_no_js[i].fecha_final_fabrica+'</div>'+
                                                '<div> <strong>Dias para finalizar: <i class="fas fa-calendar-day"></i> '+lis_no_js[i].total_dias+'</strong></div>'+
                                                '<div> Modelo: <i class="fas fa-star"></i> '+lis_no_js[i].nombre_modelo+'</strong></div>'+
                                                '<div> Diseño: <i class="fas fa-pencil-ruler"></i> '+lis_no_js[i].nombre_diseno+'</div>'+
                                                '<div> Total: <i class="fas fa-sack-dollar"></i> '+lis_no_js[i].total+'</div>'+
                                            '</div>'+
                                        '</div></div>';
                   }
                   
 
           $('.datatabla_noti').html(tabla_lista_notif);
         }
 
         else
         {
           $('.datatabla_noti').html('0');
         }
 
         }
     });
 
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