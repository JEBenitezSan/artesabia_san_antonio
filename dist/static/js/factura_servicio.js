
 $(document).ready(function() {
/// focus en el input predeterminado
document.getElementById("buscar_produc").focus();

 /// Plugin selecc para la busqueda de clientes
 $('.js-example-basic-multiple').select2({
    language: "es"
});

/// Busqueda de los datos de stock de factura
$(obtener_registros());
function obtener_registros(bus_product)
{
	$.ajax({
		url : 'envios_bd/busqueda_servicio.php',
		type : 'POST',
		dataType : 'html',
		data : { bus_product: bus_product },
	})

	.done(function(resultado){
		$("#tabla_resul_produt").html(resultado);
	})
}

$(document).on('keyup', '#buscar_produc', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_registros(valorBusqueda);
	}
	else
	{
		obtener_registros();
	}
});

/// al precionar enter llama  a una funcion
$("body").keydown(function(event) {
    if (event.keyCode == "13")
     {
        llamar_datos_busqueda();
     }
});

/// Al dar click al boton agregar tambien llama a la funcion
$("#add_product").click(function(){
    llamar_datos_busqueda();
});

///Funcion de llamar datos
function llamar_datos_busqueda(){
    valor = document.getElementById("buscar_produc").value;
    if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) 
    {
      
    Swal.fire({
    type: 'error',
    title: 'No es posible',
    text: 'Nose se puede agregar productos. Busca el producto a facturar',
    timer: 1200,
    })

    document.getElementById("buscar_produc").focus();
    } 
  else {
          $(".agre_produc").hide();
          $(".borrar_producto").show();
          var produc_clon = document.getElementById('resul_clon');	
          var produc_clon_resu = produc_clon.cloneNode(true)
          $("#tabla_clone").append(produc_clon_resu);

          $("#buscar_produc").val("");
          $("#tabla_resul_produt").html("");
          document.getElementById("buscar_produc").focus();
       }
}
///Borrar el nodo de un producto agregado
$(document).on('click', '.borrar_producto', function (event) {
    event.preventDefault();

    $(this).closest('tr').remove();
    document.getElementById("buscar_produc").focus();
    cal_total_fact();
    vuelto(); 

});

/// agregar de forma independiente el producto
$(document).on('click', '.agre_produc', function (event) {
    event.preventDefault();

    $(".agre_produc").hide();
    $(".borrar_producto").show();
    
    $(this).parents("tr").clone().appendTo("tbody#tabla_clone");

    $("#buscar_produc").val("");
    $("#tabla_resul_produt").html("");
    document.getElementById("buscar_produc").focus();
  

});

//// Obtener lista de clientes
$(obtener_registrio_clientes());
function obtener_registrio_clientes(consulta) 
    {
    $.ajax({
        url : 'combo_ajax/com_cliente.php',
        type : 'POST',
        dataType : 'html',
  })
 
    .done(function(respuesta){
        $("#selec_control").html(respuesta);
    })
    
    .fail(function() {
        console.log("error");	
  });
  
 }

 //// Obtener lista de clientes
$(obtener_registrio_descuento());
function obtener_registrio_descuento(consulta) 
    {
    $.ajax({
        url : 'combo_ajax/com_descuento.php',
        type : 'POST',
        dataType : 'html',
  })
 
    .done(function(respuesta){
        $("#decuento_apli").html(respuesta);
    })
    
    .fail(function() {
        console.log("error");	
  });
  
 }
/// Escuchar el cambio en input con la classe y validar si hay campos o no
 $(document).on('change', '.precio_venta', function(){

    var precioventa = +$(this).closest('tr').find('input[id=precio_venta]').val();
    var preciototalventa = +$(this).closest('tr').find('input[id=precio_total_venta]').val();
    
                if (precioventa < 1)
                  { 
                
                    $(this).closest('tr').find('input[id=precio_venta]').val("").focus();
                    Swal.fire({
                        type: 'error',
                        title: 'No es posible',
                        text: 'Ingrese un precio valida',
                        footer: '<strong> El precio deve ser mayor a 0</strong>'
                      }) 
                  }
                  else if (precioventa == '')
                  { 
                    $(this).closest('tr').find('input[id=precio_venta]').val("").focus();
                    
                    Swal.fire({
                        type: 'error',
                        title: 'No es posible',
                        text: 'No has ingresado un precio valido',
                        footer: '<strong> Su precio es: '+preciototalventa+'</strong>'
                      }) 
                  }
  
  });


  
$('#cal_vuelto').on('change', '#decuento_apli', function (){

    validar_descuento();
    vuelto();     

  })
/// enviar factura
$('#form_factura_servicio').submit(function(e){                         
        e.preventDefault(); 
   
        var totalfaccom = document.getElementById('total_fac_com').value;	
     
        if (totalfaccom === "")
        {
            Swal.fire({
                type: 'error',
                title: 'Verifica que tenga productos agregados',
                text: 'Productos No facturados !!!',
            })

        }
        else {

                $.ajax({
                type : 'POST',
                url : 'envios_bd/facturar_servicio.php',
                data : $('#form_factura_servicio').serialize(),
                success: function (data){
                
                        if (data == 1) 
                        {
                            document.getElementById("form_factura_servicio").reset();
                            table_servicios.ajax.reload(null, false);

                                Swal.fire({
                                    type: 'success',
                                    title: 'Factura realizada correctamente',
                                    html: '<h6>Servicios facturados !!!&nbsp;<img src="static/iconos/factura.ico" alt="Exito" width="32" height="32"></h6>',
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                    }).then((result) => {
                                        if(result.value)
                                        {
                                            location.reload()
                                            } 
                                        });
                        }
                        if (data == 0)
                        {
                            Swal.fire({
                                type: 'error',
                                title: 'Factura no ingresado',
                                html: '<h6>Factura no ingresada !!!&nbsp; <i class="fas fa-times"></i></h6>',
                                showConfirmButton: false,
                                timer: 2500,})

                                setTimeout(function(){
                                    window.location.href = "error.php";
                            }, 2000);
                                
                        }

                    }

                });

            }

});

///cada ves que introdusca un caracter llamara la funcion de vuelto
$('#cal_vuelto').on('keyup','#efectivo_fac', function (){
    vuelto();
  });




/// Agregar cliente desde factura

/// Abrir modal y ponerlo statico
$("#agre_cliente").click(function(){
    $('#Modal_Cliente').modal({backdrop: 'static', keyboard: false})
    $('#Modal_Cliente').modal('show');
})

/// Guardar cliente
$('#form_cliente').submit(function(e){                         
    e.preventDefault(); 
    var datoscliente = 'envios_bd/lista_cliente_crud.php';
              
              $.ajax({
              type : 'POST',
              url : datoscliente,
              data : $('#form_cliente').serialize(),
              success: function (data){
        
              if (data==1) {
                  document.getElementById("form_cliente").reset();
      
                  Swal.fire({
                      type: 'success',
                      title: 'Cliente Guardado Correctamente',
                      text: 'Datos Guardados!!!', })
                          } 
                          else 
                             {
                              Swal.fire({
                                  type: 'error',
                                  title: 'No se pudo ingresar el Cliente',
                                  text: 'Datos No Ingresados!!!',
                              })
                            }
                     }
      
                  })             
});
/// actualizar el combo de lista de clientes
$('#cerrar_cliente').click(function(){ 
    $('#selec_control').load('combo_ajax/com_cliente.php');
});

/// Agregar porcentaje de factura de descuento
/// Abrir modal
$('#add_por_descuento').click(function(){ 
    $('#modal_add_porcdescuento').modal({backdrop: 'static', keyboard: false})
    $('#modal_add_porcdescuento').modal('show');
  })


$('#actua_porcedescuento').click(function(){ 
    $('#decuento_apli').load('combo_ajax/com_descuento.php');
});

/// Guardar porcentaje mandarlo a la insersion
$('#add_form_porcendescuento').submit(function(e){                         
    e.preventDefault(); 

$.ajax({
type : 'POST',
url : 'envios_bd/porce_descuento.php',
data : $('#add_form_porcendescuento').serialize(),
success: function (data)
{
  if (data == 1)
  {
      document.getElementById("add_form_porcendescuento").reset();

        Swal.fire({
            type: 'success',
            title: 'Registrado Correctamente',
            html: '<h6>% de Descuento Ingresado!!!</h6>',
            showConfirmButton: true
             })
  }
  if (data == 0)
  {
      Swal.fire({
          type: 'error',
          title: 'Registrados no ingresado',
          html: '<h6>% de Descuento No Ingresados!!!</h6>',
          showConfirmButton: false,
          timer: 1600,})
  }
}

});

});



/// Busqueda de los datos de servicio de factura por nombre
$(obtener_re_nombre_fac());
function obtener_re_nombre_fac(bus_product)
{
	$.ajax({
		url : 'envios_bd/busqueda_servicio_all.php',
		type : 'POST',
		dataType : 'html',
		data : { bus_product: bus_product },
	})

	.done(function(resultado){
		$("#tabla_resul_produt").html(resultado);
	})
}

$(document).on('keyup', '#busc_servi_nombre', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_re_nombre_fac(valorBusqueda);
	}
	else
	{
		obtener_re_nombre_fac();
	}
});


/// Tabla de servicios
    var opc_servi = 'lista_servicios';
    var today = new Date();
    const fecha_expor = today.toLocaleString() 
    
    table_servicios = $('#table_servicios').DataTable({ 
                    
        "footerCallback": function ( row, data, start, end, display )
        {
            tota_entra_desc = this.api()
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
               
            $(this.api().column(4).footer()).html('C$: '+tota_entra_desc);	
            ////--------------------------------------------------->
            gran_total_b = this.api()
            .column(5)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            var gran_total_b = gran_total_b.toFixed(2);
            $(this.api().column(5).footer()).html('C$: '+gran_total_b);	
            ////--------------------------------------------------->
            gran_total_c = this.api()
            .column(6)
            .data()
            .reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            }, 0 );
            var gran_total_c = gran_total_c.toFixed(2);
            $(this.api().column(6).footer()).html('C$: '+gran_total_c);
          
            ////--------------------------------------------------->


        }, 
        createdRow: function ( row, data, index )
        {    
            $('td', row).eq(4).css('font-weight', ' bold');
            $('td', row).eq(4).css('background-color', '#75C788');
            $('td', row).eq(5).css('background-color', '#3BA755');
            $('td', row).eq(5).css('font-weight', ' bold');
            $('td', row).eq(6).css('background-color', '#ECBB6F');
            $('td', row).eq(6).css('font-weight', ' bold');
 

            if (data['estado'] == 'Pendiente')
            {
                $('td', row).eq(7).css('background-color', '#dc3545');
                $('td', row).eq(7).css('font-weight', ' bold');
            }

            if (data['estado'] == 'Entregado')
            {
                $('td', row).eq(7).css('background-color', '#3BA755');
                $('td', row).eq(7).css('font-weight', ' bold');
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
            title: 'Reporte de Inventario',
            filename: 'Reporte_de_Inventario_'+fecha_expor,
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11]
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
                columns: [0,1,2,3,4,5,6,7,8,9,10,11]
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
                columns: [0,1,2,3,4,5,6,7,8,9,10,11]
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
        url : 'envios_bd/ingresar_servicio.php',
        method: 'POST', 
        data : {opc_servi}, 
        dataSrc:"",
       }),

       columns:[
        {data: "id_servicio"},
        {data: "tipo_servicio"},
        {data: "observaciones"},
        {data: "fecha_entreda"},
        {data: "precio_inversion",render: $.fn.dataTable.render.number(",", ".", 2, " ")},
        {data: "precio_servicio",render: $.fn.dataTable.render.number(",", ".", 2, " ")},
        {data: "precio_total_venta",render: $.fn.dataTable.render.number(",", ".", 2, " ")},
        {data: "estado"},
        {data: "fecha_ingresado"},
        {data: "usuario"},
        {defaultContent: "<button type='button' class='btn btn-sm btn-warning editar_servicio'><i class='fas fa-pen'></i></button>"}, 

    ],
    
    }); 
/// Fin de tabla de servicios

/// Abrir modal nuevo servicios
$('#new_servi').click(function(){ 
    $('#modal_nuevo_servicio').modal({backdrop: 'static', keyboard: false})
    $('#modal_nuevo_servicio').modal('show');
  })
/// Actualizar lista de servicios
  $('#actualiza_servicio').click(function(){ 
    // $('#decuento_apli').load('combo_ajax/com_descuento.php');
    console.log("Nuevo servicio");
});
/// Guardar nuevo servicio mandarlo a la insersion
$('#agregar_form_servicio').submit(function(e){                         
    e.preventDefault(); 

            $.ajax({
            type : 'POST',
            url : 'envios_bd/ingresar_servicio.php',
            data : $('#agregar_form_servicio').serialize(),
            success: function (data)
                                {
                                if (data == 1)
                                {
                                    document.getElementById("agregar_form_servicio").reset();
                                    table_servicios.ajax.reload(null, false);

                                        Swal.fire({
                                            type: 'success',
                                            title: 'Registrado Correctamente',
                                            html: '<h6>Servicio Ingresado!!!</h6>',
                                            showConfirmButton: true
                                            })
                                }
                                if (data == 0)
                                {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Registrados no ingresado',
                                        html: '<h6>Servicioo No Ingresados!!!</h6>',
                                        showConfirmButton: false,
                                        timer: 1600,})
                                }
                                }

            });

});

/// AL precionar se calcula el total de costo del servico
$('#tol_servicio').on('keyup','#precio_inversion', function (){
    total_servicio ();
 })

$('#tol_servicio').on('keyup','#precio_servicio', function (){
    total_servicio ();
})


 //// Obtener lista de tipo de servicios
 $(obtener_tipo_servicios());
 function obtener_tipo_servicios(consulta) 
     {
     $.ajax({
         url : 'combo_ajax/com_tiposervicio.php',
         type : 'POST',
         dataType : 'html',
   })
  
     .done(function(respuesta){
         $(".selec_tipo_servi").html(respuesta);
     })
     
     .fail(function() {
         console.log("error");	
   });
   
  }

/// Abrir modal de editar servicios
$(document).on('click', '.editar_servicio', function(){

    fila = $(this).closest("tr");	
    id_servicio =  fila.find('td:eq(0)').text();
 
    $('#modal_editar_servicio').modal({backdrop: 'static', keyboard: false})
    $('#modal_editar_servicio').modal('show');

    $("#id_servicio").val(id_servicio);

});

/// Abrir modal de agregar tipo servicios
$(document).on('click', '#add_tiposervi', function(){
 
    $('#modal_tiposervi').modal({backdrop: 'static', keyboard: false})
    $('#modal_tiposervi').modal('show');


});

// Enviar nuevo registro de tipo de servicio
$('#agregar_for_tiposervi').submit(function(e){                         
    e.preventDefault(); 

            $.ajax({
            type : 'POST',
            url : 'envios_bd/ingresar_servicio.php',
            data : $('#agregar_for_tiposervi').serialize(),
            success: function (data)
                                {
                                if (data == 1)
                                {
                                    document.getElementById("agregar_for_tiposervi").reset();
                                    table_servicios.ajax.reload(null, false);

                                        Swal.fire({
                                            type: 'success',
                                            title: 'Registrado Correctamente',
                                            html: '<h6>Tipo de Servicio Ingresado!!!</h6>',
                                            showConfirmButton: true
                                            })
                                }
                                if (data == 0)
                                {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Registrados no ingresado',
                                        html: '<h6>Tipo de Servicio No Ingresados!!!</h6>',
                                        showConfirmButton: false,
                                        timer: 1600,})
                                }
                                }

});

/// Actualizar tipo de producto
$('#actualiza_tiposervi').click(function(){ 
    $('#selectiposervi').load('combo_ajax/com_tiposervicio.php');
});



});


});//// al cargar el html


  function total_servicio (){

    var myFloat = precio_inversion = parseFloat($('#precio_inversion').val());
    var myFloat = precio_servicio = parseFloat($('#precio_servicio').val());
    var myFloat = precio_total = parseFloat($('#precio_total').val());

    if (isNaN(precio_inversion) || isNaN(precio_servicio))  
    {
        precio_inversion=0.00;
        precio_total=0.00;
        precio_servicio=0;
    }

    aplicar_ganancia = parseFloat(precio_servicio) + parseFloat(precio_inversion);
    var myFloat = aplicar_ganancia = aplicar_ganancia.toFixed(2); 
    $('input#precio_total').val(aplicar_ganancia);
   
}

/// Funcion que hace multiplicar unop a uno a los producto se llama desde el html
function multi_validar(){  
    var cantidad = document.querySelectorAll('.precio_venta');


              const cantidad_cons = 1;
              var sumaprecios = document.querySelectorAll('.precio_venta');
              var subtotals = document.querySelectorAll('.total_subcompra');
          
                      for(var i = 0; i < cantidad.length; i++)
                        { 
                          
                                 cal_total_fact();
                                 validar_descuento();
                                 vuelto(); 
                                 
                                 subtotals[i].value = (sumaprecios[i].value * cantidad_cons).toFixed(2); 
                        }

                   
}



/// calcula total de la factura
function cal_total_fact()
{
    var total_fac = 0;     
    $('.total_subcompra').each(function() { 
    total_fac += parseFloat($(this).val()); 
    }); 
     $("#total_fac_com").val(total_fac.toFixed(3));

     validar_descuento();
}

/// Aplica y valida descuento
function validar_descuento () {
    var myFloat = total_fac_desc = parseFloat($('#total_fac_com').val());

    descuento_apli  = $.trim($("#decuento_apli").val());
    var myFloat = aplicar_des = total_fac_desc/100 * descuento_apli;
    var myFloat = aplicar_des = aplicar_des.toFixed(2); 
    gran_total = total_fac_desc - aplicar_des
    var myFloat = gran_total = gran_total.toFixed(2); 
    $('input#total_fac').val(aplicar_des);
    $('input#total_fac_neto').val(gran_total);
  }

/// Calcula el vuelto 
function vuelto() {
    var myFloat = efectivo=parseFloat($('#efectivo_fac').val());
      var myFloat = total_fac=parseFloat($('#total_fac_neto').val());

              if (isNaN(efectivo))
                 {efectivo=0;}
              if (isNaN(total_fac))
                 {total_fac=0;}   

      vuelto_efectivo = efectivo - total_fac;
      var myFloat = vuelto_efectivo= vuelto_efectivo.toFixed(2); 
     
     $('input#vuelto_cliente').val(vuelto_efectivo);

     var validar_vuelto = parseFloat($('#vuelto_cliente').val());

     if (validar_vuelto < 0){
        document.getElementById('vuelto_cliente').style.backgroundColor = '#E25555';
    }
     else {
        document.getElementById('vuelto_cliente').style.backgroundColor = '#0dcaf0';
    }
}
