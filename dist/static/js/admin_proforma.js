$(document).ready(function() {
document.getElementById("buscar_producfor").focus();
 /// Plugin selecc para la busqueda de clientes
 $('.js-example-basic-multiple').select2({
    language: "es"
});
/// Busqueda de los datos de stock de proforma
$(obtener_registros());
function obtener_registros(bus_product)
{
	$.ajax({
		url : 'envios_bd/busqueda_produc_all.php',
		type : 'POST',
		dataType : 'html',
		data : { bus_product: bus_product },
	})

	.done(function(resultado){
		$("#tablaresul_produtprofor").html(resultado);
	})
}

$(document).on('keyup', '#buscar_producfor', function()
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



/// agregar de forma independiente el producto
$(document).on('click', '.agre_produc', function (event) {
    event.preventDefault();

    $(".agre_produc").hide();
    $(".borrar_producto").show();
    
    $(this).parents("tr").clone().appendTo("tbody#tabla_clone");

    $("#buscar_producfor").val("");
    $("#tablaresul_produtprofor").html("");
    document.getElementById("buscar_producfor").focus();
  

});

///Borrar el nodo de un producto agregado
$(document).on('click', '.borrar_producto', function (event) {
    event.preventDefault();

    $(this).closest('tr').remove();
    document.getElementById("buscar_producfor").focus();

});

/// Validar cantidad disponible
$(document).on('change', '.cant_compra', function(){

    var cantidad_existe = +$(this).closest('tr').find('input[id=cant_stock]').val();
    var cantidad = +$(this).closest('tr').find('input[id=cant_compra]').val();
  
                  if (cantidad > cantidad_existe)
                  { 
                    $(this).closest('tr').find('input[id=cant_compra]').val("").focus();
                    
                    Swal.fire({
                        type: 'warning',
                        title: 'No es posible',
                        text: 'La cantidad solicitada sobre pasa el Stock Existente',
                        footer: '<strong> Cantidad Disponible: '+cantidad_existe+'</strong>'
                      }) 
                  }
                  else if (cantidad < 1)
                  { 
                
                    $(this).closest('tr').find('input[id=cant_compra]').val("").focus();
                    Swal.fire({
                        type: 'error',
                        title: 'No es posible',
                        text: 'Ingrese una cantidad valida',
                        footer: '<strong> La cantidad deve ser mayor a 0</strong>'
                      }) 
                  }
                  else if (cantidad == '')
                  { 
                    $(this).closest('tr').find('input[id=cant_compra]').val("").focus();
                    
                    Swal.fire({
                        type: 'error',
                        title: 'No es posible',
                        text: 'No has ingresado cantidad Valida',
                        footer: '<strong> Cantidad Disponible: '+cantidad_existe+'</strong>'
                      }) 
                  }
  
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

 /// Abrir modal y ponerlo statico
$("#agre_cliente").click(function(){
    $('#Modal_Cliente').modal({backdrop: 'static', keyboard: false})
    $('#Modal_Cliente').modal('show');
});

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
      
                  });           
});

/// actualizar el combo de lista de clientes
$('#cerrar_cliente').click(function(){ 
    $('#selec_control').load('combo_ajax/com_cliente.php');
});

/// al precionar enter llama  a una funcion
$("body").keydown(function(event) {
    if (event.keyCode == "13")
     {
        llamar_datos_busqueda();
     }
});


/// enviar factura
$('#form_proforma').submit(function(e){                         
    e.preventDefault(); 

    var totalfaccom = document.getElementById('total_fac_com').value;	
 
    if (totalfaccom === "")
    {
        Swal.fire({
            type: 'error',
            title: 'Verifica que tenga productos agregados',
            text: 'Productos No agregados !!!',
        })

    }
    else {

            $.ajax({
            type : 'POST',
            url : 'envios_bd/proforma.php',
            data : $('#form_proforma').serialize(),
            success: function (data){
            
                    if (data == 1) 
                    {
                        document.getElementById("form_proforma").reset();

                            Swal.fire({
                                type: 'success',
                                title: 'Proforma realizada correctamente',
                                html: '<h6>Producto agregados !!!&nbsp;<img src="static/iconos/factura.ico" alt="Exito" width="32" height="32"></h6>',
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
                            title: 'Proforma no ingresado',
                            html: '<h6>Productos no ingresada !!!&nbsp; <i class="fas fa-times"></i></h6>',
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

    var cantidad = document.querySelectorAll('.cant_compra');
    var sumaprecios = document.querySelectorAll('.prec_venta');
    var subtotals = document.querySelectorAll('.total_subcompra');

            for(var i = 0; i < cantidad.length; i++)
              { 
                  subtotals[i].value = (sumaprecios[i].value * cantidad[i].value).toFixed(2);     
                  cal_total_fact();              
              }        
}

/// calcula total de la factura
function cal_total_fact()
{
    var total_fac = 0;     
    $('.total_subcompra').each(function() { 
    total_fac += parseFloat($(this).val()); 
    }); 
     $("#total_fac_com").val(total_fac.toFixed(2));

}

///Funcion de llamar datos
function llamar_datos_busqueda(){
    valor = document.getElementById("buscar_producfor").value;
    if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) 
    {
      
    Swal.fire({
    type: 'error',
    title: 'No es posible',
    text: 'Nose se puede agregar productos. Busca el producto que dea agregar',
    timer: 1200,
    })

    document.getElementById("buscar_producfor").focus();
    } 
  else {
          $(".agre_produc").hide();
          $(".borrar_producto").show();
          var produc_clon = document.getElementById('resul_clon');	
          var produc_clon_resu = produc_clon.cloneNode(true)
          $("#tabla_clone").append(produc_clon_resu);

          $("#buscar_producfor").val("");
          $("#tabla_resul_produt").html("");
          document.getElementById("buscar_producfor").focus();
       }
}

