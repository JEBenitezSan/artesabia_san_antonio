
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
		url : 'envios_bd/busqueda_produc.php',
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


  
$('#cal_vuelto').on('change', '#decuento_apli', function (){

    validar_descuento();
    vuelto();     

  })
/// enviar factura
$('#form_factura').submit(function(e){                         
        e.preventDefault(); 
   
    $.ajax({
    type : 'POST',
    url : 'envios_bd/facturar.php',
    data : $('#form_factura').serialize(),
    success: function (data){
    
            if (data == 1) 
            {
                document.getElementById("form_factura").reset();

                    Swal.fire({
                        type: 'success',
                        title: 'Factura realizada correctamente',
                        html: '<h6>Producto facturados !!!&nbsp;<img src="static/iconos/factura.ico" alt="Exito" width="32" height="32"></h6>',
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

/// Ocultar boto de agregar descuento
var y = document.getElementById("add_por_descuento");
y.style.display = "none";

/// Si el check esta activo o no se detectta el cambio
$('#deshabilitar_descuent').click(function () {
    if ($('#deshabilitar_descuent').is(':checked')) {
        
        $('#confir_modal_admin').modal('show');
  
    } else {

        $("#add_por_descuento").hide();
    }
  });
/// Enviar datos a confirmar pass de admin
$('#form_confir_admin').submit(function(e){                         
    e.preventDefault(); 

            $.ajax({
            type : 'POST',
            url : 'envios_bd/confirmar_admin.php',
            data : $('#form_confir_admin').serialize(),
            success: function (data)
            {
            if (data != 0)
            {
                document.getElementById("form_confir_admin").reset();

                $('#confir_modal_admin').modal('hide');

                Swal.fire({
                    type: 'success',
                    title: 'Hola '+ data +' Bienvenido Administrador',
                    html: '<h6>Un gusto saludarle</h6>',
                    showConfirmButton: true,
                      })

                $("#add_por_descuento").show("slow");


            }
            if (data == 0)
            {
                Swal.fire({
                    type: 'error',
                    title: 'No tienes permiso para habilitar esta opción',
                    html: '<h6>Error !!! se alerto al Administrador</h6>',
                    showConfirmButton: false,
                    timer: 2000,})

                    $("#deshabilitar_descuent").prop("checked", false);
            }
            }

            });

});

/// deshabilitar check una ves agregado el descuento con el admin

$('.actua_porcedescuento').click(function () {

    $("#deshabilitar_descuent").prop("checked", false);
 
    $("#add_por_descuento").hide();

});

/// Busqueda de los datos de stock de factura por nombre
$(obtener_todo_productos());
function obtener_todo_productos(bus_product)
{
	$.ajax({
		url : 'envios_bd/busqueda_produc_all.php',
		type : 'POST',
		dataType : 'html',
		data : { bus_product: bus_product },
	})

	.done(function(resultado){
		$("#tabla_resul_produt").html(resultado);
	})
}

$(document).on('keyup', '#busc_produc_nombre', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_todo_productos(valorBusqueda);
	}
	else
	{
		obtener_todo_productos();
	}
});

});//// al cargar el html


/// Funcion que hace multiplicar unop a uno a los producto se llama desde el html
function multi_validar(){   

    var cantidad = document.querySelectorAll('.cant_compra');
    var sumaprecios = document.querySelectorAll('.prec_venta');
    var subtotals = document.querySelectorAll('.total_subcompra');

            for(var i = 0; i < cantidad.length; i++)
              { 
                  subtotals[i].value = (sumaprecios[i].value * cantidad[i].value).toFixed(2); 

                       cal_total_fact();
                       validar_descuento();
                       vuelto();                    
              }
            
}

function cal_total_fact()
{
    var total_fac = 0;     
    $('.total_subcompra').each(function() { 
    total_fac += parseFloat($(this).val()); 
    }); 
     $("#total_fac_com").val(total_fac);

     validar_descuento();
}

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
