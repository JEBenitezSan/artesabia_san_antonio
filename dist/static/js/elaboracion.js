$(document).ready(function() {
    document.getElementById("busca_material").focus();
// Plugin selecc para la busqueda de clientes
 $('.js-example-basic-multiple').select2({
    language: "es"
});


/// Busqueda de los datos de stock de material
$(obtener_materiales());
function obtener_materiales(valorBusqueda)
{
	$.ajax({
		url : 'envios_bd/busqueda_materiales.php',
		type : 'POST',
		dataType : 'html',
		data : { valorBusqueda: valorBusqueda },
	})

	.done(function(resultado){
		$("#table_material_exit").html(resultado);
	})
}

$(document).on('keyup', '#busca_material', function()
{
	var valorBusqueda=$(this).val();
    
	if (valorBusqueda!="")
	{
		obtener_materiales(valorBusqueda);
	}
	else
	{
		obtener_materiales();
	}
});

///Borrar el nodo de un producto agregado
$(document).on('click', '.borrar_material', function (event) {
    event.preventDefault();

    $(this).closest('tr').remove();
    document.getElementById("busca_material").focus();
    cal_total_fabricacion()


});

/// agregar de forma independiente el producto
$(document).on('click', '.agre_material', function (event) {
    event.preventDefault();

    $(".agre_material").hide();
    $(".borrar_material").show();
    
    $(this).parents("tr").clone().appendTo("tbody#producto_existe");

    $("#busca_material").val("");
    $("#table_material_exit").html("");
    document.getElementById("busca_material").focus();
    cal_total_fabricacion()

});

/// al precionar enter llama  a una funcion
$("body").keydown(function(event) {
    if (event.keyCode == "13")
     {
        llamar_datos_busqueda();
     }
});

///Funcion de llamar datos
function llamar_datos_busqueda(){
    valor = document.getElementById("busca_material").value;
    if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) 
    {
      
    Swal.fire({
    type: 'error',
    title: 'No es posible',
    text: 'Nose se puede agregar el materi. Busca el materia a agregar',
    timer: 1200,
    })

    document.getElementById("busca_material").focus();
    } 
  else {
          $(".agre_material").hide();
          $(".borrar_material").show();
          var produc_clon = document.getElementById('resul_clon');	
          var produc_clon_resu = produc_clon.cloneNode(true)
          $("#producto_existe").append(produc_clon_resu);

          $("#busca_material").val("");
          $("#table_material_exit").html("");
          document.getElementById("busca_material").focus();
          cal_total_fabricacion()
       }
}

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
// ---------------------------------------------------------
/// Abrir modal y ponerlo statico
$("#add_artesano").click(function(){
    $('#modal_artesano').modal({backdrop: 'static', keyboard: false})
    $('#modal_artesano').modal('show');
})
/// Guardar artesano
$('#form_artesano').submit(function(e){                         
    e.preventDefault(); 
    var datoscliente = 'envios_bd/admin_combo_fabricacion.php';
              
              $.ajax({
              type : 'POST',
              url : datoscliente,
              data : $('#form_artesano').serialize(),
              success: function (data){
        
              if (data==1) {
                  document.getElementById("form_artesano").reset();
      
                  Swal.fire({
                      type: 'success',
                      title: 'Artesano Guardado Correctamente',
                      text: 'Exito !!!', })
                          } 
                          else 
                             {
                              Swal.fire({
                                  type: 'error',
                                  title: 'Artesano No Guardado',
                                  text: 'Error !!!',
                              })
                            }
                     }
      
                  })             
});
/// actualizar el combo de lista de artesano
$('#cerrar_artesano').click(function(){ 
    $('#com_artesano').load('combo_ajax/com_artesano.php');
});
// ---------------------------------------------------------
/// Abrir modal y ponerlo statico
$("#add_modelo").click(function(){
    $('#modal_modelo').modal({backdrop: 'static', keyboard: false})
    $('#modal_modelo').modal('show');
})
/// Guardar modelo
$('#form_modelo').submit(function(e){                         
    e.preventDefault(); 
    var datoscliente = 'envios_bd/admin_combo_fabricacion.php';
              
              $.ajax({
              type : 'POST',
              url : datoscliente,
              data : $('#form_modelo').serialize(),
              success: function (data){
        
              if (data==1) {
                  document.getElementById("form_modelo").reset();
      
                  Swal.fire({
                      type: 'success',
                      title: 'Modelo Guardado Correctamente',
                      text: 'Exito !!!', })
                          } 
                          else 
                             {
                              Swal.fire({
                                  type: 'error',
                                  title: 'Modelo No Guardado',
                                  text: 'Error !!!',
                              })
                            }
                     }
      
                  })             
});
/// actualizar el combo de lista de modelo
$('#cerrar_modelo').click(function(){ 
    $('#com_modelo').load('combo_ajax/com_modelo.php');
});
// ---------------------------------------------------------
/// Abrir modal y ponerlo statico
$("#add_diseno").click(function(){
    $('#modal_diseno').modal({backdrop: 'static', keyboard: false})
    $('#modal_diseno').modal('show');
})
/// Guardar diseño
$('#form_diseno').submit(function(e){                         
    e.preventDefault(); 
    var datoscliente = 'envios_bd/admin_combo_fabricacion.php';
              
              $.ajax({
              type : 'POST',
              url : datoscliente,
              data : $('#form_diseno').serialize(),
              success: function (data){
        
              if (data==1) {
                  document.getElementById("form_diseno").reset();
      
                  Swal.fire({
                      type: 'success',
                      title: 'Diseño Guardado Correctamente',
                      text: 'Exito !!!', })
                          } 
                          else 
                             {
                              Swal.fire({
                                  type: 'error',
                                  title: 'Diseño No Guardado',
                                  text: 'Error !!!',
                              })
                            }
                     }
      
                  })             
});
/// actualizar el combo de lista de modelo
$('#cerrar_diseno').click(function(){ 
    $('#com_diseno').load('combo_ajax/com_diseno.php');
});
// ---------------------------------------------------------
/// Abrir modal y ponerlo statico
$("#add_costoelabora").click(function(){
    $('#modal_precio_elaboracion').modal({backdrop: 'static', keyboard: false})
    $('#modal_precio_elaboracion').modal('show');
})
/// Guardar precio elaboracion
$('#form_pre_elabora').submit(function(e){                         
    e.preventDefault(); 
    var datoscliente = 'envios_bd/admin_combo_fabricacion.php';
              
              $.ajax({
              type : 'POST',
              url : datoscliente,
              data : $('#form_pre_elabora').serialize(),
              success: function (data){
        
              if (data==1) {
                  document.getElementById("form_pre_elabora").reset();
      
                  Swal.fire({
                      type: 'success',
                      title: 'Precio de elaboración Guardado Correctamente',
                      text: 'Exito !!!', })
                          } 
                          else 
                             {
                              Swal.fire({
                                  type: 'error',
                                  title: 'Precio de elaboración No Guardado',
                                  text: 'Error !!!',
                              })
                            }
                     }
      
                  })             
});
/// actualizar el combo de lista de modelo
$('#cerrar_elaboracion').click(function(){ 
    $('#com_costoelabora').load('combo_ajax/com_costoelabora.php');
});
// ---------------------------------------------------------
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

 //// Obtener lista de artesanos
$(obtener_registrio_artesanos());
function obtener_registrio_artesanos(consulta) 
    {
    $.ajax({
        url : 'combo_ajax/com_artesano.php',
        type : 'POST',
        dataType : 'html',
  })
 
    .done(function(respuesta){
        $("#com_artesano").html(respuesta);
    })
    
    .fail(function() {
        console.log("error");	
  });
  
 }

 //// Obtener lista de diseños
 $(obtener_registrio_disenos());
 function obtener_registrio_disenos(consulta) 
     {
     $.ajax({
         url : 'combo_ajax/com_diseno.php',
         type : 'POST',
         dataType : 'html',
   })
  
     .done(function(respuesta){
         $("#com_diseno").html(respuesta);
     })
     
     .fail(function() {
         console.log("error");	
   });
   
  }

   //// Obtener lista de costos de elabaracion
 $(obtener_registrio_elabora());
 function obtener_registrio_elabora(consulta) 
     {
     $.ajax({
         url : 'combo_ajax/com_costoelabora.php',
         type : 'POST',
         dataType : 'html',
   })
  
     .done(function(respuesta){
         $("#com_costoelabora").html(respuesta);
     })
     
     .fail(function() {
         console.log("error");	
   });
   
  }
  
   //// Obtener lista de modelos
 $(obtener_registro_modelo());
 function obtener_registro_modelo(consulta) 
     {
     $.ajax({
         url : 'combo_ajax/com_modelo.php',
         type : 'POST',
         dataType : 'html',
   })
  
     .done(function(respuesta){
         $("#com_modelo").html(respuesta);
     })
     
     .fail(function() {
         console.log("error");	
   });
   
  }

//// Cuando haga un cambio en costo de elabaracion
$('#cambio_precio').on('change', '#com_costoelabora', function (){
    consul_precio();
  });

/// Escuchar el cambio en input con la classe y validar si hay campos o no
$(document).on('change', '.cant_material', function(){


    var cantidad = +$(this).closest('tr').find('input[id=cantidad]').val();
    var cant_material = +$(this).closest('tr').find('input[id=cant_material]').val();
  
                  if (cant_material > cantidad)
                  { 
                    $(this).closest('tr').find('input[id=cant_material]').val("").focus();
                    
                    Swal.fire({
                        type: 'warning',
                        title: 'No es posible',
                        text: 'La cantidad solicitada sobre pasa el Stock Existente',
                        footer: '<strong> Cantidad Disponible: '+cantidad+'</strong>'
                      }) 
                  }
                  else if (cant_material < 1)
                  { 
                
                    $(this).closest('tr').find('input[id=cant_material]').val("").focus();
                    Swal.fire({
                        type: 'error',
                        title: 'No es posible',
                        text: 'Ingrese una cantidad valida',
                        footer: '<strong> La cantidad deve ser mayor a 0</strong>'
                      }) 
                  }
                  else if (cant_material == '')
                  { 
                    $(this).closest('tr').find('input[id=cant_material]').val("").focus();
                    
                    Swal.fire({
                        type: 'error',
                        title: 'No es posible',
                        text: 'No has ingresado cantidad Valida',
                        footer: '<strong> Cantidad Disponible: '+cantidad+'</strong>'
                      }) 
                  }
  
  });


  /// Enviar fabricacion
$('#form_fabricacion').submit(function(e){                         
    e.preventDefault(); 

    var totalfaccom = document.getElementById('total_elaboracion').value;	
 
    if (totalfaccom === "")
    {
        Swal.fire({
            type: 'error',
            title: 'Verifica que tengas materiales agregados',
            text: 'Material no agregado !!!',
        })

    }
    else {

            $.ajax({
            type : 'POST',
            url : 'envios_bd/fabricacion.php',
            data : $('#form_fabricacion').serialize(),
            success: function (data){
            
                    if (data == 1) 
                    {
                        document.getElementById("form_fabricacion").reset();

                            Swal.fire({
                                type: 'success',
                                title: 'Materiales agregados a fabricación',
                                html: '<h6>En fabricacion !!!&nbsp;<img src="static/iconos/factura.ico" alt="Exito" width="32" height="32"></h6>',
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
                            title: 'Fabricación no generada',
                            html: '<h6>No generada !!!&nbsp; <i class="fas fa-times"></i></h6>',
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

});

/// Funcion que hace multiplicar unop a uno a los producto se llama desde el html
function multi_validar(){   

    var cantidad = document.querySelectorAll('.cant_material');
    var sumaprecios = document.querySelectorAll('.prec_venta');
    var subtotals = document.querySelectorAll('.total_material');

            for(var i = 0; i < cantidad.length; i++)
              { 
                  subtotals[i].value = (sumaprecios[i].value * cantidad[i].value).toFixed(2);           
                  cal_total_fabricacion();
                  consul_precio();
                      
              }
            
}

/// calcula total costo de elaboracion
function cal_total_fabricacion()
{
    var total_fac = 0;     
    $('.total_material').each(function() { 
    total_fac += parseFloat($(this).val()); 
    }); 

    $("#total_elaboracion").val(total_fac.toFixed(3));
 
   
}

     

function consul_precio() {

        costo_elabora = parseFloat($('#com_costoelabora').val());
    $.ajax({

        url : 'combo_ajax/costo_elaboracion.php',
        type : 'POST',
        datatype: "json",
        data : {costo_elabora}, 
        success:function(data)
        {
          var js = JSON.parse(data);
          if(js)
              {
                  for(var i = 0; i < js.length; i++)
                          {
                            var totalfaccom = document.getElementById('total_elaboracion').value;
                            var precio = js[i].precio_elaboracion;
                            var total_g = parseFloat(precio) + parseFloat(totalfaccom);
                          $('input#pre_elab').val(total_g.toFixed(3)); 
                          }

              }
          }
          

        })

        
       
}
