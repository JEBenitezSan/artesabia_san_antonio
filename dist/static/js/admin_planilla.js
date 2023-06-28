$(document).ready(function() { 
    ///Obtener lista de empleados
    $(obtener_registrio_vendedor());
    function obtener_registrio_vendedor(consulta) 
        {
        $.ajax({
            url : 'combo_ajax/com_vendedor.php',
            type : 'POST',
            dataType : 'html',
      })
     
        .done(function(respuesta){
            $(".select_vendedor").html(respuesta);
        })
        
        .fail(function() {
            console.log("error");	
      });
      
     }
    /// Llamar a la funcion para cargar la informacion
    /// Envio datos predeterminados al cargar la pagina

    const fecha_info1 = "2022-01-01T00:00:00";
    const vendedor = "11"
    const opc_planilla_carg = "lis_planilla_libre";

    data_lista_planilla (fecha_info1, vendedor, opc_planilla_carg);

    
    ///Borrar comisiones y salario de empleado
    $(document).on("click", ".btnborrar_planilla", function(){

        fila = $(this).closest("tr");	
        id_planilla =  fila.find('td:eq(1)').text();
        nombre_pro_dell = fila.find('td:eq(3)').text();

        Swal.fire({
            title: 'Estas seguro de realizar esta accion ?',
            text: 'Eliminar salario Código : '+id_planilla+' de '+nombre_pro_dell,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar !'
            }).then((result) => {
            if (result.value) {

                var datoscliente = 'envios_bd/admin_planilla.php';
                var opc_planilla = "dele_planilla"
                  
                $.ajax({
                type : 'POST',
                url : datoscliente,
                data : {id_planilla, opc_planilla},
                success: function (data){
          
                        if (data==1) 
                        {
            
                            tabla_planilla.ajax.reload(null, false);

                            Swal.fire({
                                type: 'success',
                                title: 'Planilla eliminada correctamente',
                                text: 'Registro borrado !!!', })

                        } 
                        else 
                            {
                            Swal.fire({
                                type: 'error',
                                title: 'No se realizo la acción',
                                text: 'Planilla no borrada !!!',
                                })
                            }
                } });

            }
            })

    });
    
    
    
    ///Editar detalle de comisiones cargado a las comisiones del empleado
    $(document).on("click", ".btneditar_planilla", function(){

        fila = $(this).closest("tr");	
        const fecha_edit_1 =  fila.find('td:eq(11)').text();
        const fecha_edit_2 = fila.find('td:eq(12)').text();
        const vendedor_planilla = fila.find('td:eq(2)').text();
        const id_planilla_edit = fila.find('td:eq(1)').text();

        const opc_planilla_lieditar = "list_editar";

        data_lista_planilla_editar (fecha_edit_1, fecha_edit_2, opc_planilla_lieditar, vendedor_planilla)

        $('#lis_pro_comisiones').modal({backdrop: 'static', keyboard: false})
        $('#lis_pro_comisiones').modal('show');

        
        $("#id_vendedor").val(id_planilla_edit);
        $("#usuario_vende").val(vendedor_planilla);
        $("#fecha_plani1").val(fecha_edit_1);
        $("#fecha_plani2").val(fecha_edit_2);

    

    });


    /// Detectar cambio en la fecha2 y mandar los valores
$('#fecha_repor_plan').on('change', '#fecha_plani', function (){
    fecha_plani  = $.trim($("#fecha_plani").val());
    var vendedor  = $.trim($(".select_vendedor").val());
    var opc_planilla = "lista_planilla";

    data_lista_planilla (fecha_plani, vendedor, opc_planilla);
   
});


/// Detectar cambio en selecc y mandar datos de fecha y vendedor
$('#fecha_repor_plan').on('change', '.select_vendedor', function (){
    fecha_plani  = $.trim($("#fecha_plani").val());
    var vendedor  = $.trim($(".select_vendedor").val());
    var opc_planilla = "lista_planilla";

    if (fecha_plani == "")
        {
                Swal.fire({
                    type: 'warning',
                    title: 'No es posible',
                    text: 'Determina un fecha para mostrar la informacion',
                    footer: '<a href>Ayuda</a>',
                });

        } 
        else {
            data_lista_planilla (fecha_plani, vendedor, opc_planilla);
        }
}); 


/// ---------Cambio en modal editar comisiones---------->

    /// Detectar cambio en la fecha 1 de modal.
    $('#fecha_edit_comi').on('change', '#fecha_plani1', function (){
        // id_vendedor
        
         fecha_plani1  = $.trim($("#fecha_plani1").val());
         fecha_plani2  = $.trim($("#fecha_plani2").val());
         vendedor_edit = $.trim($("#usuario_vende").val());
         var opc_planilla = "list_editar";
    
        data_lista_planilla_editar (fecha_plani1, fecha_plani2, opc_planilla, vendedor_edit)
       
    });

        /// Detectar cambio en la fecha 2 de modal.
        $('#fecha_edit_comi').on('change', '#fecha_plani2', function (){

            fecha_plani1  = $.trim($("#fecha_plani1").val());
            fecha_plani2  = $.trim($("#fecha_plani2").val());
            vendedor_edit = $.trim($("#usuario_vende").val());
            var opc_planilla = "list_editar";
       
           data_lista_planilla_editar (fecha_plani1, fecha_plani2, opc_planilla, vendedor_edit)
           
        });


        /// Guardar pago planilla vendedor
        $(document).on('click', '#editar_salario', function(){

            const id_usuario_v = $.trim($("#id_vendedor").val());
            const id_por_comi = $.trim($(".select_comisiones").val());
            const id_salario = $.trim($(".select_salario").val());
            const comision = $.trim($("#comi_vendedor").val());
            const fech_ran_1 = $.trim($("#fecha_plani1").val());
            const fech_ran_2 = $.trim($("#fecha_plani2").val());

            if ((id_usuario_v == "") || (id_por_comi == "") || (id_salario == "") || (comision == "") || (fech_ran_1 == "") || (fech_ran_2 == "")) {

                Swal.fire({
                    type: 'warning',
                    title: 'No puedes guardar en planilla',
                    html: '<img src="static/iconos/obser.ico" alt="Porcentaje" width="60" height="60">'+
                        '<br><br>'+
                        'Deves de verificar que todas las opciones estan bien aplicada',

                });
            }

            else {
                const id_usuario_v = $.trim($("#id_vendedor").val());
                const id_por_comi = $.trim($(".select_comisiones").val());
                const id_salario = $.trim($(".select_salario").val());
                const comision = $.trim($("#comi_vendedor").val());
                const total_neto = document.getElementById("total_pago_valor").textContent;
                const fech_ran_1 = $.trim($("#fecha_plani1").val());
                const fech_ran_2 = $.trim($("#fecha_plani2").val());
                const id_usuario = $.trim($("#user_planilla").val());
                const opc_planilla = "editar_planilla";
            
                ttl_utili_bru  = $.trim($("#ttl_utili_bru").val());
                var totaadmincomi_valor = document.getElementById("totaadmincomi_valor").textContent;
            
                var obj_salario_editar = {
            
                    id_planil: id_usuario_v,
                    id_por_comi: id_por_comi,
                    id_salario: id_salario,
                    comision: comision,
                    total_neto: total_neto,
                    fech_ran_1: fech_ran_1,
                    fech_ran_2: fech_ran_2,
                    id_usuario: id_usuario,
                    opc_planilla: opc_planilla
            
                    }

                    console.log(obj_salario_editar);
            
                    const datoscliente = 'envios_bd/admin_planilla.php';              
                    $.ajax({
                    type : 'POST',
                    url : datoscliente,
                    data : obj_salario_editar,
                    success: function (data)
                    {
                
                                if (data==1) 
                                {
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Datos editador',
                                        text: 'Salario y comisión editados correctamente',
                                        footer: 'Exito !!!',
                                    });
                
                                    fecha_plani1  = $.trim($("#fecha_plani1").val());
                                    fecha_plani2  = $.trim($("#fecha_plani2").val());
                                    vendedor_edit = $.trim($("#usuario_vende").val());
                                    var opc_planilla = "list_editar";
                               
                                   data_lista_planilla_editar (fecha_plani1, fecha_plani2, opc_planilla, vendedor_edit);
                                   
                                   tabla_planilla.ajax.reload(null, false);
                                } 
                                else 
                                    {
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Datos no editados',
                                            text: 'Salario y comisión no editado error',
                                            footer: 'Error !!!',
                                        });
                                    }
                    }
                
                    })

             }
            
        

        }); 

    

// ----------------------------------------------------->

    /// Abrir modal comisiones
    $(document).on("click", "#comision_modal", function(){

    $('#modal_abrir_comision').modal({backdrop: 'static', keyboard: false})
    $('#modal_abrir_comision').modal('show');

    });

    /// Abri modal salario
    $(document).on("click", "#salario_modal", function(){

    $('#modal_salario').modal({backdrop: 'static', keyboard: false})
    $('#modal_salario').modal('show');

    });

    /// Agregar comsiones a categoria 
    $('#form_comision').submit(function(e){                         
    e.preventDefault(); 
    const backen_envios = 'envios_bd/admin_reporte_venta.php';
    const data_form_comi = $('#form_comision').serialize();
    
    salario_comsion ( backen_envios, data_form_comi );
        
    });

    /// Agregar salario a categoria
    $('#form_salario').submit(function(e){                         
    e.preventDefault(); 
    const backen_envios = 'envios_bd/admin_reporte_venta.php';
    const data_form_comi = $('#form_salario').serialize();
    
    salario_comsion ( backen_envios, data_form_comi );
        
    });

    //// Obtener lista de comisiones 
    $(obtener_registrio_comisiones());
    function obtener_registrio_comisiones(consulta) 
        {
        $.ajax({
            url : 'combo_ajax/com_comision.php',
            type : 'POST',
            dataType : 'html',
    })
    
        .done(function(respuesta){
            $(".select_comisiones").html(respuesta);
        })
        
        .fail(function() {
            console.log("error");	
    });
    
    }

    //// Obtener lista de salario
    $(obtener_registro_salario());
    function obtener_registro_salario(consulta) 
        {
        $.ajax({
            url : 'combo_ajax/com_salario.php',
            type : 'POST',
            dataType : 'html',
    })
    
        .done(function(respuesta){
            $(".select_salario").html(respuesta);
        })
        
        .fail(function() {
            console.log("error");	
    });
    
    }

    /// actualizar el combo de lista de comisiones
    $('#actua_comision').click(function(){ 
    $('.select_comisiones').load('combo_ajax/com_comision.php');
    });

    /// actualizar el combo de lista de salarios
    $('#actua_salario').click(function(){ 
    $('.select_salario').load('combo_ajax/com_salario.php');
    });


    /// Detectar cambio en selector de % de comisiones
    $(document).on('change', '.select_comisiones', function(){

    select_comisiones ();
    select_salario ();

    });

    /// Detectar cambio en selector de % de salario
    $(document).on('change', '.select_salario', function(){

    select_salario ();
    select_comisiones ();
    
    });


    /// mostrar detalle de productos cargado a la factura
    $(document).on("click", "tbody td.detalleplani", function(){

        fila = $(this).closest("tr");	
        num_factura = parseInt(fila.find('td:eq(1)').text());

        detalle_porfactura ( num_factura );

        $('#modal_detalle_venta').modal({backdrop: 'static', keyboard: false})
        $('#modal_detalle_venta').modal('show');

    });



// ------------------------------------------------------>

});

/// Funcion de lista de planilla de vendedores
function data_lista_planilla (fecha, vendedor, opc_planilla) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    const fecha_pla = fecha;
    const vendedor_pla = vendedor;

    const btn_accion_factu = "<div class='text-center'>"+
    "<div class='btn-group'>"+
            "<button class='btn btn-info btn-sm btneditar_planilla'><i class='fas fa-pen'></i></button>"+
            "<button class='btn btn-danger btn-sm btnborrar_planilla' style='color:#000000'><i class='fas fa-trash'></i></button>"+
    "</div>"+
"</div>";

    tabla_planilla = $('#tabla_planilla').DataTable({  
        
        "footerCallback": function ( row, data, start, end, display )
        {
            tota_entra_desc = this.api()
            .column(9)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            var tota_entra_desc = tota_entra_desc.toFixed(2);
            $(this.api().column(9).footer()).html(tota_entra_desc);	
            // --------------------->
            total_entra_sindes = this.api()
            .column(8)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            var total_entra_sindes = total_entra_sindes.toFixed(2);
            $(this.api().column(8).footer()).html(total_entra_sindes);	
            // --------------------->
            descuento_aplica = this.api()
            .column(7)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            var descuento_aplica = descuento_aplica.toFixed(2);
            $(this.api().column(7).footer()).html(descuento_aplica);	
            
        },
        createdRow: function ( row, data, index )
        {    
            $('td', row).eq(9).css('background-color', '#A2C59A');
            $('td', row).eq(9).css('font-weight', ' bold');
            $('td', row).eq(10).css('background-color', '#A2C59A');
            $('td', row).eq(10).css('font-weight', ' bold');
            
            $('td', row).eq(14).html(btn_accion_factu);
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
            title: 'Reporte de planillas canceladas',
            filename: 'Reporte_de_planillas_canceladas'+fecha_expor,
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de planillas canceladas',
            filename: 'Reporte_de_planillas_canceladas'+fecha_expor,
            text: '<button type="button" class="btn btn-success btn-sm"><i class="fas fa-file-pdf"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir planilla',
            text: '<button type="button" class="btn btn-success btn-sm"><i class="fas fa-print"></i></button>'
        },
    //Botón para colvis para ejegir que columnas quieres mostrar
        {
            extend: 'colvis',
            text: '<button type="button" class="btn btn-success btn-sm"><i class="fas fa-crop-alt"></i></button>',
            postfixButtons: ['colvisRestore']
        }
    ],
    destroy: true,

    "order": [[ 1, "desc" ]],
    
    ajax:({          
        url : 'envios_bd/admin_planilla.php',
        method: 'POST', 
        data : {opc_planilla,fecha_pla,vendedor_pla}, 
        dataSrc:"",
       }),
// <div class="entra_detalle_caja">  </div>
       columns:[
        {   className: 'detallefact',
            orderable: false,
            data: null,
            defaultContent: '<img src="static/iconos/dell_planilla.ico" alt="Exito" width="32" height="32">',
        }, 
        {data: "id_plani_pago"},
        {data: "usuario"},
        {data: "nombre_apellido_emple"},
        {data: "cedula_user"},
        {data: "id_por_comi"},
        {data: "id_salario"},
        {data: "salario_neto"},
        {data: "comision"},
        {data: "total_neto"},
        {data: "fecha_realizada"},
        {data: "fech_ran_1"},
        {data: "fech_ran_2"},
        {data: "user"},
        {defaultContent: ''},  
    ],
    
    });  

}

/// Funcion de lista de productos vendido para la edicion de salario o planilla
function data_lista_planilla_editar (fecha_1_, fecha_2_, opc_planilla_lieditar, vendedor_planilla) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 


    const fecha_edit_1 = fecha_1_;
    const fecha_edit_2 = fecha_2_;
    const opc_planilla = opc_planilla_lieditar;
    const vendedor_pla = vendedor_planilla;
    
    tabla_edit_planilla = $('#tabla_edit_planilla').DataTable({  

        "footerCallback": function ( row, data, start, end, display )
        {
            
            //----------------->

            total_descuento = this.api()
                .column(2)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
               
            $(this.api().column(2).footer()).html('<i class="fas fa-tags"></i> '+total_descuento);	
            
            //----------------->

            total_vta_venta = this.api()
            .column(4)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            total_vta_ventas = total_vta_venta.toFixed(3); 
            $(this.api().column(4).footer()).html('<i class="fas fa-money-bill-wave"></i> '+total_vta_ventas);	

            
            //----------------->

            total_capi_venta = this.api()
            .column(5)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            total_capi_ventas = total_capi_venta.toFixed(3); 
            $(this.api().column(5).footer()).html('<i class="fas fa-money-bill-wave"></i> '+total_capi_ventas);	
            //----------------->

            resul_utili_1 = total_vta_ventas - total_capi_ventas;
            resul_utili_1s = resul_utili_1.toFixed(3);

            $("#ttl_utili_bru").val(resul_utili_1s);

            select_comisiones ();
            select_salario ();

        }, 

        createdRow: function ( row, data, index )
        {    
            $('td', row).eq(0).css('background-color', '#629BF4');
            $('td', row).eq(4).css('background-color', '#629BF4');
            $('td', row).eq(4).css('font-weight', ' bold');

            $('td', row).eq(5).css('background-color', '#A7CBFE');
            $('td', row).eq(5).css('font-weight', ' bold');

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
            title: 'Reporte de planilla editadar',
            filename: 'Reporte_de planilla_editadar'+fecha_expor,
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de planilla editadar',
            filename: 'Reporte_de planilla_editadar'+fecha_expor,
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir planilla editada',
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></button>'
        },
    // //Botón para colvis para ejegir que columnas quieres mostrar
    //     {
    //         extend: 'colvis',
    //         text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-crop-alt"></i></button>',
    //         postfixButtons: ['colvisRestore']
    //     }
    ],
    destroy: true,
  
    ajax:({          
        url : 'envios_bd/admin_planilla.php',
        method: 'POST', 
        data : {opc_planilla, fecha_edit_1, fecha_edit_2, vendedor_pla}, 
        dataSrc:"",
       }),

       columns:[
        {   className: 'detalleplani',
        orderable: false,
        data: null,
        defaultContent: '<img src="static/iconos/ven_all.ico" alt="Exito" width="32" height="32">',
        }, 
        {data: "id_num_factura"},
        {data: "total_descuent"},
        {data: "id_cant_porcendes"},
        {data: "total_fac_neto"},
        {data: "capital_vendedor"},
        {data: "id_caja"},
        {data: "confirma_caja"},
        {data: "nombre_cliente"},
        {data: "usuario"},
        {data: "fecha_factura"},
        {defaultContent: "<button type='button' class='btn btn-primary btn-sm'  style='width: 80%' disabled><i class='fas fa-check'></i></button>"}, 

    ],
    
    });  
}





/// Funcion de calculo de comisiones
function select_comisiones () {
    ttl_utili_bru  = $.trim($("#ttl_utili_bru").val());
    const comision_v = document.getElementById("select_comisiones").value;
 
    porcen_aplicar = ttl_utili_bru/100;
    resul_porce_apli = porcen_aplicar * comision_v;
    $("#comi_vendedor").val(resul_porce_apli.toFixed(2));
 }
 /// Funcion de calculo de salario
 function select_salario () {
    salario_v  = $.trim($(".select_salario").val());
    comisiom_v  = $.trim($("#comi_vendedor").val());
 
    ttl_utili_bru  = $.trim($("#ttl_utili_bru").val());
    comi_vendedor  = $.trim($("#comi_vendedor").val());
 
    tota_pago = Number(salario_v) + Number(comisiom_v);
    total_pago = tota_pago.toFixed(2);
    badges = '<span class="badge rounded-pill bg-success"><span id="total_pago_valor">'+total_pago+'</span> C$</span>';
    $("#tota_salcomi").html(badges);
    
    
    tota_admin_comi = Number(ttl_utili_bru) - Number(comi_vendedor);
    totaadmincomi = tota_admin_comi.toFixed(2);
    badges_admin = '<span class="badge rounded-pill bg-warning"><span id="totaadmincomi_valor">'+totaadmincomi+'</span> C$</span>';
    $("#total_admin").html(badges_admin);
 }
 /// Funcion para guardar comisión y salarios
 function salario_comsion (backen_envios, data_form) {
                  
    $.ajax({
        type : 'POST',
        url : backen_envios,
        data : data_form,
        success: function (data){
    
                if (data==1) 
                {
                    document.getElementById("form_comision").reset();
 
                    Swal.fire({
                        type: 'success',
                        title: 'comisión agregada correctamente',
                        text: 'Exito !!!', })
 
                } 
                else if (data==2) 
                {
                    document.getElementById("form_salario").reset();
 
                    Swal.fire({
                        type: 'success',
                        title: 'Salario agregado correctamente',
                        text: 'Exito !!!', })
                } 
                else 
                    {
                    Swal.fire({
                        type: 'error',
                        title: 'Datos no guardado',
                        text: 'Error !!!',
                    })
                }
        }
 
 })  
 }

 /// Datos de detalle de facturas, modal todo los productos que estan cargados por cada factura
 function detalle_porfactura ( num_factura ) {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 
    
    var opc_fac = "detalle_factura";
 
         const btn_accion_factu = "<div class='text-center'>"+
                                        "<div class='btn-group'>"+
                                                "<button class='btn btn-info btn-sm btneditar_detallefac_pro'><i class='fas fa-pen'></i></button>"+
                                                "<button class='btn btn-danger btn-sm btnborrar_detallefac_pro' style='color:#000000'><i class='fas fa-trash'></i></button>"+
                                        "</div>"+
                                    "</div>";
 
    detalle_venta_factura = $('#detalle_venta_factura').DataTable({  

        createdRow: function ( row, data, index )
        {    
                // $('td', row).eq(7).html(btn_accion_factu);
        },
 
        "footerCallback": function ( row, data, start, end, display )
        {
            
            //----------------->
 
            total_factura_ = this.api()
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
               
            $(this.api().column(6).footer()).html('<i class="fas fa-tags"></i> '+total_factura_);	
            
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
            title: 'Reporte de productos facturados',
            filename: 'Reporte_de_productos_facturados'+fecha_expor,
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-sm" style="background-color:#2378D3"><i class="fas fa-file-excel fa-lg"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de productos facturados',
            filename: 'Reporte_de_productos_facturados'+fecha_expor,
            text: '<button type="button" class="btn btn-sm" style="background-color:#2378D3"><i class="fas fa-file-pdf fa-lg"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },
 
        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir productos facturados',
            text: '<button type="button" class="btn btn-sm" style="background-color:#2378D3"><i class="fas fa-print fa-lg"></i></button>'
        },
 
    ],
    destroy: true,
 
    "order": [[ 1, "desc" ]],
    
    ajax:({          
        url : 'envios_bd/admin_factura.php',
        method: 'POST', 
        data : {num_factura, opc_fac}, 
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
 