$(document).ready(function() {
/// data de cajas
    var opc_caja = 'lista_caja';
    datatabla_cajaprin = $('#datatabla_cajaprin').DataTable({  
        createdRow: function ( row, data, index )
        {    
            if (data['estado_caja'] == "Abierto" )
            {
                $('td', row).eq(6).css('background-color', '#d4edda');
                $('td', row).eq(10).html("<button type='button' class='btn btn-warning btn-sm cerrar_caja'  style='width: 80%'><i class='fas fa-times'></i></button>");
            }

            if (data['estado_caja'] == "Cerrado" )
            {
                $('td', row).eq(6).css('background-color', '#34A2CB');
                $('td', row).eq(10).html("<button type='button' class='btn btn-primary btn-sm'  style='width: 80%' disabled><i class='fas fa-check'></i></button>");
            }

            if (data['monto_final_caja'] == null)
            {
                $('td', row).eq(2).css('background-color', '#34A2CB');
                $('td', row).eq(2).html('<i class="fas fa-lock"></i>');
            } 
            if (data['fecha_cerrar_caja'] == null)
            {
                $('td', row).eq(4).css('background-color', '#34A2CB');
                $('td', row).eq(4).html('<i class="fas fa-lock"></i>');
            } 

            if (data['total_cierre_caja'] == null)
            {
                $('td', row).eq(5).css('background-color', '#34A2CB');
                $('td', row).eq(5).html('<i class="fas fa-lock"></i>');
            } 

            if (data['descrip_cerrar_caja'] == null)
            {
                $('td', row).eq(9).css('background-color', '#34A2CB');
                $('td', row).eq(9).html('<i class="fas fa-lock"></i>');
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
            title: 'Reporte de Creditos Cancelados',
            filename: 'Reporte de Creditos Cancelados',
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de clientes',
            filename: 'Reporte de clientes',
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir clientes',
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
        url : 'envios_bd/admin_caja.php',
        method: 'POST', 
        data : {opc_caja}, 
        dataSrc:"",
       }),

       columns:[
        {data: "id_caja"},
        {data: "monto_inicial_caja"},
        {data: "monto_final_caja"},
        {data: "fecha_apertuta_caja"},
        {data: "fecha_cerrar_caja"},
        {data: "total_cierre_caja"},
        {data: "estado_caja"},
        {data: "usuario"},
        {data: "nombres_user"},
        {data: "descrip_cerrar_caja"},
        {defaultContent: ""}, 

    ],
    
    });  

/// datas de productos
data_produc_fac ();
/// al hacer clic desaparece y aparece tablas caja y entradas ventas

/// data de cajas anteriores
data_caja_anteriores ();
///-------------------------->

/// Ocultar y mostrar al ser clic al cada boton
    var x = document.getElementById("datatabla_cajaprin_2");
    x.style.display = "none";
    var y = document.getElementById("caja_anterior_ocultar");
    y.style.display = "none";

    $(document).on("click", "#admin_caja", function(){
        var x = document.getElementById("productos");
        x.style.display = "none";

        var y = document.getElementById("caja_anterior_ocultar");
        y.style.display = "none";

        $("#datatabla_cajaprin_2").show("slow");

    });

    $(document).on("click", "#movimientos", function(){
        var x = document.getElementById("datatabla_cajaprin_2");
        x.style.display = "none";

        var y = document.getElementById("caja_anterior_ocultar");
        y.style.display = "none";

        $("#productos").show("slow");

    });

    $(document).on("click", "#anterior_caja", function(){
        var x = document.getElementById("datatabla_cajaprin_2");
        x.style.display = "none";

        var y = document.getElementById("productos");
        y.style.display = "none";

        $("#caja_anterior_ocultar").show("slow");

    });



/// Abrir modal abrir caja
    $(document).on("click", "#btn_abrir_caja", function(){
        $('#modal_abrir_caja').modal({backdrop: 'static', keyboard: false})
        $('#modal_abrir_caja').modal('show');
    });


/// Abrir modal salida caja
    $(document).on("click", "#btn_salida_caja", function(){
        $('#modal_salida_caja').modal({backdrop: 'static', keyboard: false})
        $('#modal_salida_caja').modal('show');
        
        var utili_dispo = document.getElementById("total_utilidad_input").value;
        $("#utilidad_disponible").val(utili_dispo);

    });
    /// validad si lo que introduce el usuario es menor que la utilidad disponible
    $(document).on('keyup', '#monto_salida', function()
    {
        var utili_dispo_intup = document.getElementById("utilidad_disponible").value;
        var monto_salida = document.getElementById("monto_salida").value;
        
        if(Number(utili_dispo_intup) < Number(monto_salida)){
            Swal.fire({
                type: 'error',
                title: 'Error',
                html: 'Error salida supera la cantidad de utilidad disponible',
                footer:'<hr><strong>Cantidad disponible es: ' + utili_dispo_intup + '</strong><hr>',})
                $("#monto_salida").val('').focus();
        }
        else { return }
        

    });
    

///Apertura de caja
    $('#form_abrir_caja').submit(function(e){                         
        e.preventDefault(); 
        var datoscliente = 'envios_bd/admin_caja.php';
                  
                  $.ajax({
                  type : 'POST',
                  url : datoscliente,
                  data : $('#form_abrir_caja').serialize(),
                  success: function (data){
            
                  if (data==1) 
                  {

                      document.getElementById("form_abrir_caja").reset();
                      datatabla_cajaprin.ajax.reload(null, false);
                      caja_anterior_data.ajax.reload(null, false);

                      Swal.fire({
                          type: 'success',
                          title: 'Caja abierta Correctamente',
                          text: 'Datos Guardados!!!', })
                } 
                    else 
                        {
                        Swal.fire({
                            type: 'error',
                            title: 'No se pudo abrir una nueva caja',
                            text: 'Tiene una caja ya abierta!!!',
                          })
                       }
                }
          
                      })             
    });
/// Salida de caja gastos
    $('#formsalida_caja').submit(function(e){                         
        e.preventDefault(); 
        var datoscliente = 'envios_bd/admin_caja.php';
                  
                  $.ajax({
                  type : 'POST',
                  url : datoscliente,
                  data : $('#formsalida_caja').serialize(),
                  success: function (data){
            
                  if (data==1) 
                  {
                    
                      document.getElementById("formsalida_caja").reset();
                      datatabla_cajaprin.ajax.reload(null, false);
                     
          
                      Swal.fire({
                          type: 'success',
                          title: 'Salida registrada Correctamente',
                          text: 'Datos Guardados!!!', })
                } 
                    else 
                        {
                        Swal.fire({
                            type: 'error',
                            title: 'No se puede guardar una salida',
                            text: 'No hay una caja abierta!!!',
                          })
                       }
                }
          
                      })             
    });
/// Cerrar caja
    $(document).on("click", ".cerrar_caja", function(){
        fila = $(this).closest("tr");	
        id_caja = parseInt(fila.find('td:eq(0)').text());

        $('#modal_cerrar_caja').modal({backdrop: 'static', keyboard: false})
        $('#modal_cerrar_caja').modal('show');

        $("#id_caja").val(id_caja);

        const total_cierre_caja = document.getElementById("total_cierre_caja").value;
        const to_neto_cajacierre = document.getElementById("to_neto_cajacierre").value;

        $("#monto_cerrar_caja").val(total_cierre_caja);
        $("#monto_final_caja").val(to_neto_cajacierre);
        
    });
    /// Cerrar caja update a la caja abierta
    $('#form_cerrar_caja').submit(function(e){                         
        e.preventDefault(); 
        var datoscliente = 'envios_bd/admin_caja.php';
                  
                  $.ajax({
                  type : 'POST',
                  url : datoscliente,
                  data : $('#form_cerrar_caja').serialize(),
                  success: function (data){
            
                  if (data==1) 
                  {

                      document.getElementById("form_cerrar_caja").reset();
                      datatabla_cajaprin.ajax.reload(null, false);
                      caja_anterior_data.ajax.reload(null, false);
          
                      Swal.fire({
                          type: 'success',
                          title: 'Caja cerrada correctamente',
                          text: 'Caja cerrada!!!', })
                } 
                    else 
                        {
                        Swal.fire({
                            type: 'error',
                            title: 'No se puede cerrar caja',
                            text: 'No hay una caja abierta!!!',
                          })
                       }
                }
          
                      })             
    });


    // Actualizar cada sierto tiempo los widgets de entradas, capital y utilidad

        setInterval(function(){
            productos_id.ajax.reload(null, false);
            datos_widgets ();
       }, 10000);

       datos_widgets ();
       
/// Confirmar factura que entra a caja
    $(document).on("click", ".comfirmar_fac", function(){

        fila = $(this).closest("tr");	

        num_fact_comfir = parseInt(fila.find('td:eq(1)').text());
        opc_caja = "confirmar_fac";
        estado_con_fac = "Recibido";

        var datos_confir = 'envios_bd/admin_caja.php';;

          $.ajax({
            type : 'POST',
            url : datos_confir,
            data :{num_fact_comfir, opc_caja, estado_con_fac},
            success: function (data)
                    {
                    
                            if (data==1) 
                            {
                                productos_id.ajax.reload(null, false);
                                Swal.fire({
                                    position: 'center',
                                    type: 'success',
                                    title: 'Confirmado Num:'+num_fact_comfir,
                                    showConfirmButton: false,
                                    timer: 1100
                                });
                        } 
                            else 
                                {
                                Swal.fire({
                                    type: 'error',
                                    title: 'No se puedo confirmar factura',
                                    text: 'Verifica!!!',
                                    });
                                }
                    }
    
                });

    });
    /// mostrar detalle de productos cargado a la factura
    $(document).on("click", "tbody td.detallefact", function(){

        fila = $(this).closest("tr");	
        num_factura = parseInt(fila.find('td:eq(1)').text());
        tipo_fac = fila.find('td:eq(2)').text();

        $("#editar_tipo_fac").val(tipo_fac); 
        $("#tipo_factura_editar").val(tipo_fac); 
        

        detalle_porfactura ( num_factura, tipo_fac );

        $('#modal_detalle_venta').modal({backdrop: 'static', keyboard: false})
        $('#modal_detalle_venta').modal('show');

    });

    /// Abri modal para editar uno a uno los productos cargado a la factura
    $(document).on("click", ".btneditar_detallefac_pro", function(){

         $('#modad_editar_dellfact').modal('show');   

         fila = $(this).closest("tr");	
         id_detall_factura = parseInt(fila.find('td:eq(0)').text());
         id_num_factura = parseInt(fila.find('td:eq(1)').text());
         cod_barra =fila.find('td:eq(2)').text();
         nombre_product = fila.find('td:eq(3)').text();
         prec_venta_detall = parseFloat(fila.find('td:eq(4)').text());
         cant_detall = parseInt(fila.find('td:eq(5)').text());
         sub_total = parseFloat(fila.find('td:eq(6)').text());
         id_detall_stock_pro = parseInt(fila.find('td:eq(8)').text());

         valores = {id_detall_factura, id_num_factura, cod_barra, nombre_product, prec_venta_detall, cant_detall, sub_total, id_detall_stock_pro}

         $("#id_detall_factura").val(valores.id_detall_factura); 
         $("#id_num_factura").val(valores.id_num_factura);
         $("#cod_barra").val(valores.cod_barra);
         $("#nombre_product").val(valores.nombre_product);
         $("#prec_venta_detall").val(valores.prec_venta_detall);
         $("#cant_detall").val(valores.cant_detall);
         $("#sub_total").val(valores.sub_total);
         $("#id_detall_stock_pro").val(valores.id_detall_stock_pro);

         $("#cant_detall_val").val(valores.cant_detall);

        
    });

    /// Calcular el nuevo precio en el modal editar detalle y mandar 2 variable a la funcion
    $('#edit_sub_dellpro').on('keyup','#cant_detall', function (){
        var cant_detall = parseInt($('#cant_detall').val());
        var prec_venta_detall = parseFloat($('#prec_venta_detall').val());

        multi_input_edit (prec_venta_detall, cant_detall); 
        $("#sub_total").val(input_total);
        
    });

    /// Calcular el nuevo precio en el modal editar detalle y mandar 2 variable a la funcion
    $('#edit_sub_dellpro').on('keyup','#prec_venta_detall', function (){
        var cant_detall = parseInt($('#cant_detall').val());
        var prec_venta_detall = parseFloat($('#prec_venta_detall').val());

        multi_input_edit (prec_venta_detall, cant_detall); 
        $("#sub_total").val(input_total);
        
    });
/// Mandar los datos del modal editar detalle de factura a ejecutar la edicion
    $('#form_editar_dellfac').submit(function(e){                         
        e.preventDefault(); 
        var datoscliente = 'envios_bd/admin_factura.php';
                  
                  $.ajax({
                  type : 'POST',
                  url : datoscliente,
                  data : $('#form_editar_dellfac').serialize(),
                  success: function (data){
            
                  if (data==1) 
                  {
                      document.getElementById("form_editar_dellfac").reset();
                      detalle_venta_factura.ajax.reload(null, false);
                      productos_id.ajax.reload(null, false);
          
                      Swal.fire({
                          type: 'success',
                          title: 'Detalle editado correctamente',
                          text: 'Factura actualizada !!!', })

                          $('#modad_editar_dellfact').modal('hide');
                } 
                    else 
                        {
                        Swal.fire({
                            type: 'error',
                            title: 'No se realizo la edición',
                            text: 'Factura no actualizada !!!',
                          })
                       }
                }
          
                      })             
    });


    ///Borrar producto cargado a la factura de forma unitaria
    $(document).on("click", ".btnborrar_detallefac_pro", function(){

        fila = $(this).closest("tr");	
        id_detalle_fac = parseInt(fila.find('td:eq(0)').text());
        nombre_pro_dell = fila.find('td:eq(3)').text();

        Swal.fire({
            title: 'Estas seguro de realizar esta accion ?',
            text: 'Eliminar producto Código : '+id_detalle_fac+' '+nombre_pro_dell,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar !'
          }).then((result) => {
            if (result.value) {
              Swal.fire(
                'Borrado!',
                'El producto fue eliminado correctamente.',
                'success'
              )
            }
          })

    });
/// Abrir modal de salida de caja
    $(document).on("click", "#lista_salida", function(){

        const id_caja_abirta = document.getElementById("val_caja_abierta").value;
        /// Funcion de datatable lista de salida del modal
        
        datalistasalidaC ( id_caja_abirta );

        $('#modal_salida_listaC').modal({backdrop: 'static', keyboard: false})
        $('#modal_salida_listaC').modal('show');

       



    });
/// imprimir factura copia
    $(document).on("click", ".fac_print_copi", function(){
        fila = $(this);	
        num_factura = parseInt($(this).closest('tr').find('td:eq(1)').text());
        tipofac = $(this).closest('tr').find('td:eq(2)').text();
        $(".num_fac").val(num_factura);
        $(".tipo_fac").val(tipofac);
        
        
    });

    
});  

/// Datos de widgets
function datos_widgets (){
  
        opc_caja = 'caja_widgets';

        $.ajax({
            url:"envios_bd/admin_caja.php",
            type:"POST",
            datatype: "json",
            data: {opc_caja}, 
            success:function(data){
            var js = JSON.parse(data);
            if(js)
                {
                    for(var i = 0; i < js.length; i++)
                          {
                           
                            salida = js[i].salida;
                            prec_venta_detall = js[i].prec_venta_detall;
                            capital = js[i].capital;
                            utilidad = js[i].utilidad;
                            total_efectivo = js[i].total_efectivo_caja;
                            
                            if (js[i].salida == null)
                            {
                                salida = 0;
                            }
                                utilidad_net = parseFloat(utilidad) - parseFloat(salida);
                            
                            //////-------------------------->
                            if (js[i].salida)
                            {
                                $('#total_salidas').html(salida + ' C$');    
                            }
                            else if (js[i].salida == null){
                                $('#total_salidas').html('0.00 C$');
                            }
                            //////-------------------------->
                            if (js[i].prec_venta_detall)
                            { 
                                $('#total_entradas').html(prec_venta_detall + ' C$');  
                            }
                            else if (js[i].prec_venta_detall == null){
                                $('#total_entradas').html('0.00 C$');
                            }
                            //////-------------------------->
                            if (js[i].capital)
                            { 
                                $('#total_capital').html(capital + ' C$');    
                            }
                            else if (js[i].capital == null){
                                $('#total_capital').html('0.00 C$');
                            }
                            //////-------------------------->
                            if (js[i].utilidad)
                            {
                                $('#total_utilidad').html(utilidad_net+' C$');
                                $('#total_utilidad_input').val(utilidad_net);
                            }
                            else if (js[i].utilidad == null){
                                $('#total_utilidad').html('0.00 C$');
                                $('#total_utilidad_input').val('0.00');
                            }
                           //////-------------------------->
                           
                           var totalcierrecaja = document.getElementById("total_cierre_caja").value;
                           totalefectivocaja = totalcierrecaja - js[i].salida;
                           $("#to_neto_cajacierre").val(totalefectivocaja);
        
                          }
               }
      
            if(data == 0)
            {
                    const alerta_wid = '<div class="col-md-8 animated fadeIn">'+
                                        '<div class="alert alert-primary alert-dismissible fade show" role="alert">'+
                                        '<strong>No hay productos facturados</strong> En cuanto se realice la primera venta te actualizaremos.'+
                                        ' <i class="fas fa-exclamation-triangle"></i>'+
                                        ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                                        '</div>'+
                                        '</div>';

                 $("#alert_widgets").html(alerta_wid);

                  $('#total_salidas').html('0.00 C$');
                  $('#total_entradas').html('0.00 C$');
                  $('#total_capital').html('0.00 C$');
                  $('#total_utilidad').html('0.00 C$');
                  $('#total_utilidad_input').val("0.00");
            }
      
            }
        });
}

/// Datos de productos que entran a caja
function data_produc_fac () {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

        var opc_caja = "caja_entradas_fac";

        productos_id = $('#productos_id').DataTable({  
            
            "footerCallback": function ( row, data, start, end, display )
            {
                tota_entra_desc = this.api()
                    .column(8)
                    .data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0 );
                    var tota_entra_desc = tota_entra_desc.toFixed(2);
                $(this.api().column(8).footer()).html(tota_entra_desc);	

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
                $('td', row).eq(7).css('background-color', '#34A2CB');
                $('td', row).eq(7).css('font-weight', ' bold');

                if (data['confirma_caja'] == "Pendiente" )
                {
                    $('td', row).eq(13).html("<button type='button' class='btn btn_perso_s btn-sm comfirmar_fac' style='width: 50%'><i class='fas fa-stopwatch fa-lg'></i></button>"); 
                    $('td', row).eq(13).css('background-color', '#E7E7E7');

                    $('td', row).eq(7).css('background-color', '#c9422a');
                    $('td', row).eq(11).css('background-color', '#c9422a');
                    $('td', row).eq(11).html("<i class='fas fa-exclamation-triangle'></i><strong> Pendiente</strong>");
                }
        
                if (data['confirma_caja'] == "Recibido" ) 
                { 
                    const btn_print_copia = '<form id="for_copia_user" method="POST" action="print_copia_fac.php">'+
                                            '<input type="hidden" class="form-control num_fac" name="num_fac" value="" id="num_fac">'+
                                            '<input type="hidden" class="form-control tipo_fac" name="tipo_fac" value="" id="tipo_fac">'+
                                            ' <button type="submit" class="btn btn-outline-primary btn-sm fac_print_copi">'+
                                                ' <img src="static/iconos/print.ico" alt="print" width="25" height="25">'+
                                            '  </button>'
                                            '</form>';

                    $('td', row).eq(13).html(btn_print_copia); 
                    $('td', row).eq(13).css('background-color', '#E7E7E7');
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
                title: 'Reporte productos entrada caja',
                filename: 'Reporte_productos_entrada_caja'+fecha_expor,
        
                //Aquí es donde generas el botón personalizado
                text: '<button type="button" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i></button>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer: true,
                title: 'Reporte productos entrada caja',
                filename: 'Reporte_productos_entrada_caja'+fecha_expor,
                text: '<button type="button" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i></button>',
                exportOptions: {
                    columns: [0, ':visible']
                },
    
            },
            
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Imprimir productos caja',
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
            url : 'envios_bd/admin_caja.php',
            method: 'POST', 
            data : {opc_caja}, 
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
            {defaultContent: ''}
        ],
        
        });  
    
}

/// Datos de detalle de facturas, modal todo los productos que estan cargados por cada factura
function detalle_porfactura ( num_factura, tipo_fac ) {

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
        url : 'envios_bd/admin_factura.php',
        method: 'POST', 
        data : {num_factura, tipo_fac, opc_fac}, 
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

function data_caja_anteriores () {

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    var opc_caja = 'lista_caja_anteriores';
    caja_anterior_data = $('#caja_anterior_data').DataTable({  
        createdRow: function ( row, data, index )
        {    
            if (data['estado_caja'] == "Abierto" )
            {
                $('td', row).eq(6).css('background-color', '#42AD5C');
                $('td', row).eq(10).html("<button type='button' class='btn btn-danger btn-sm cerrar_caja'  style='width: 80%'><i class='fas fa-times'></i></button>");
            }

            if (data['estado_caja'] == "Cerrado" )
            {
                $('td', row).eq(6).css('background-color', '#EB8876');
                $('td', row).eq(10).html("<button type='button' class='btn btn-primary btn-sm'  style='width: 80%' disabled><i class='fas fa-check'></i></button>");
            }

            if (data['monto_final_caja'] == null)
            {
                $('td', row).eq(2).css('background-color', '#EB8876');
                $('td', row).eq(2).html('<i class="far fa-clock fa-lg"></i>');
            } 
            if (data['fecha_cerrar_caja'] == null)
            {
                $('td', row).eq(4).css('background-color', '#EB8876');
                $('td', row).eq(4).html('<i class="far fa-clock fa-lg"></i>');
            } 

            if (data['total_cierre_caja'] == null)
            {
                $('td', row).eq(5).css('background-color', '#EB8876');
                $('td', row).eq(5).html('<i class="far fa-clock fa-lg"></i>');
            } 

            if (data['descrip_cerrar_caja'] == null)
            {
                $('td', row).eq(9).css('background-color', '#EB8876');
                $('td', row).eq(9).html('<i class="far fa-clock fa-lg"></i>');
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
            title: 'Reporte caja anteriores',
            filename: 'Reporte_caja_anteriores_'+fecha_expor,
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte caja anteriores',
            filename: 'Reporte_caja_anteriores_'+fecha_expor,
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir caja anteriores',
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

    "order": [[ 0, "desc" ]],
  
    ajax:({          
        url : 'envios_bd/admin_caja.php',
        method: 'POST', 
        data : {opc_caja}, 
        dataSrc:"",
       }),

       columns:[
        {data: "id_caja"},
        {data: "monto_inicial_caja"},
        {data: "monto_final_caja"},
        {data: "fecha_apertuta_caja"},
        {data: "fecha_cerrar_caja"},
        {data: "total_cierre_caja"},
        {data: "estado_caja"},
        {data: "usuario"},
        {data: "nombres_user"},
        {data: "descrip_cerrar_caja"},
        {defaultContent: ""}, 

    ],
    
    }); 
}

/// Multiplocar campos de edicion de detalle de factura
function multi_input_edit (input_1, input_2 ){
    var myFloat = input_1;
    var myFloat = input_2; 
  
    if (isNaN(input_2))  
    {
      input_2 = 0;
    }
  
    var myFloat = input_total = parseFloat(input_1) * parseFloat(input_2);
  
    return input_total;
   
  }

function datalistasalidaC ( id_caja_abirta ) {
    
    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    var opc_caja = 'lista_salida_c';
    data_lista_salida = $('#data_lista_salida').DataTable({  
        
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
            title: 'Reporte de salidas',
            filename: 'Reporte_de_salidas_'+fecha_expor,
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de salidas',
            filename: 'Reporte_de_salidas_'+fecha_expor,
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir de salidas',
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></button>'
        },

    ],
    destroy: true,
  
    ajax:({          
        url : 'envios_bd/admin_caja.php',
        method: 'POST', 
        data : {opc_caja, id_caja_abirta}, 
        dataSrc:"",
       }),

       columns:[
        {data: "id_salida"},
        {data: "tipo_salida"},
        {data: "descripcion_salida"},
        {data: "monto_salida"},
        {data: "usuario"},
        {defaultContent: '<div class="btn-group" role="group" aria-label="Basic example">'+
                          '<button type="button" class="btn btn-info edit_salida"><i class="fas fa-pencil"></i></button>'+
                          '<button type="button" class="btn btn-warning del_salida"><i class="fas fa-trash-alt"></i></button> </div>'}, 

    ],
    
     });  

}