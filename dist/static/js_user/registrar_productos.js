$(document).ready(function() {
    $('#formproductos').submit(function(e){                         
        e.preventDefault(); 
   
    $.ajax({
    type : 'POST',
    url : 'envios_bd/registrar_producto.php',
    data : $('#formproductos').serialize(),
    success: function (data){
     
      if (data == 1)
      {
  
          document.getElementById("formproductos").reset();
  
            Swal.fire({
                type: 'success',
                title: 'Registrado Correctamente',
                html: '<h6>Producto Ingresado !!!&nbsp;<i class="fas fa-building fa-2x"></i> </h6>',
                showConfirmButton: true,
                })
      }
      if (data == 0)
      {
          Swal.fire({
              type: 'error',
              title: 'Producto no ingresado',
              html: '<h6>Producto No Ingresados!!!&nbsp; <i class="fas fa-times"></i></h6>',
              showConfirmButton: false,
              timer: 2000,})
      }
  
    }
  
    });
  
  });

//// Obtener lista de laboratorio
    $(obtener_registrio_lab());
    function obtener_registrio_lab(consulta) 
        {
        $.ajax({
            url : 'combo_ajax/com_laboratorio.php',
            type : 'POST',
            dataType : 'html',
      })
     
        .done(function(respuesta){
            $(".laboratorio").html(respuesta);
        })
        
        .fail(function() {
            console.log("error");	
      });
      
     }
//// Obtener lista de proveedores
$(obtener_registro_prov());
function obtener_registro_prov(consulta) 
    {
    $.ajax({
        url : 'combo_ajax/com_proveedor.php',
        type : 'POST',
        dataType : 'html',
  })
 
    .done(function(respuesta){
        $(".proveedor_produc").html(respuesta);
    })
    
    .fail(function() {
        console.log("error");	
  });
  
 }
 //// Obtener lista de categoria
$(obtener_com_categoria());
function obtener_com_categoria(consulta) 
    {
    $.ajax({
        url : 'combo_ajax/com_categoria.php',
        type : 'POST',
        dataType : 'html',
  })
 
    .done(function(respuesta){
        $(".categori_pro").html(respuesta);
    })
    
    .fail(function() {
        console.log("error");	
  });
  
 }


 /// Abrir modal proveedor y ponerlo statico--------------------------------------------------->
$("#add_proveedor").click(function(){
    $('#modal_add_proveedor').modal({backdrop: 'static', keyboard: false})
    $('#modal_add_proveedor').modal('show');
})

/// Guardar proveedor
$('#add_form_proveedor').submit(function(e){                         
    e.preventDefault(); 
    var datoscliente = 'envios_bd/crud_proveedor.php';
              
              $.ajax({
              type : 'POST',
              url : datoscliente,
              data : $('#add_form_proveedor').serialize(),
              success: function (data){
        
              if (data==1) {
                  document.getElementById("add_form_proveedor").reset();
      
                  Swal.fire({
                      type: 'success',
                      title: 'Proveedor Guardado Correctamente',
                      text: 'Datos Guardados!!!', })
                          } 
                          else 
                             {
                              Swal.fire({
                                  type: 'error',
                                  title: 'No se pudo ingresar el Proveedor',
                                  text: 'Datos No Ingresados!!!',
                              })
                            }
                     }
      
                  })             
});
/// Actualiza combo de proveedor
$('#actua_modal_proveedor').click(function(){ 
    $('#proveedor_produc').load('combo_ajax/com_proveedor.php');
});





 /// Abrir modal laboratorio y ponerlo statico
 $("#add_laboratorio").click(function(){
    $('#modal_add_laboratorio').modal({backdrop: 'static', keyboard: false})
    $('#modal_add_laboratorio').modal('show');
})

/// Guardar laboratorio
$('#add_form_laboratorio').submit(function(e){                         
    e.preventDefault(); 
    var datoscliente = 'envios_bd/crud_laboratorio.php';
              
              $.ajax({
              type : 'POST',
              url : datoscliente,
              data : $('#add_form_laboratorio').serialize(),
              success: function (data){
        
              if (data==1) {
                  document.getElementById("add_form_laboratorio").reset();
      
                  Swal.fire({
                      type: 'success',
                      title: 'Laboratorio Guardado Correctamente',
                      text: 'Datos Guardados!!!', })
                          } 
                          else 
                             {
                              Swal.fire({
                                  type: 'error',
                                  title: 'No se pudo ingresar el Laboratorio',
                                  text: 'Datos No Ingresados!!!',
                              })
                            }
                     }
      
                  })             
});
/// Actualiza combo de laboratorio
$('#actua_laboratorio').click(function(){ 
    $('#laboratorio').load('combo_ajax/com_laboratorio.php');
});





/// Abrir modal categoria de producto y ponerlo statico
$("#add_catepro").click(function(){
    $('#modal_add_categoriapro').modal({backdrop: 'static', keyboard: false})
    $('#modal_add_categoriapro').modal('show');
})

/// Guardar categoria de producto
$('#add_form_categoriapro').submit(function(e){                         
    e.preventDefault(); 
    var datoscliente = 'envios_bd/crud_categoriapro.php';
              
              $.ajax({
              type : 'POST',
              url : datoscliente,
              data : $('#add_form_categoriapro').serialize(),
              success: function (data){
        
              if (data==1) {
                  document.getElementById("add_form_categoriapro").reset();
      
                  Swal.fire({
                      type: 'success',
                      title: 'Categoria Guardado Correctamente',
                      text: 'Datos Guardados!!!', })
                          } 
                          else 
                             {
                              Swal.fire({
                                  type: 'error',
                                  title: 'No se pudo ingresar la Categoria',
                                  text: 'Datos No Ingresados!!!',
                              })
                            }
                     }
      
                  })             
});
/// Actualiza combo de categoria de producto
$('#actua_categoriapro').click(function(){ 
    $('#categori_pro').load('combo_ajax/com_categoria.php');
});

$('#por_ganancia').on('keyup','#pre_compra', function (){
    ganancia_porcen ();
    
  })

  $('#por_ganancia').on('keyup','#porcen_utili', function (){
    ganancia_porcen ();
    
  })

  });


  function ganancia_porcen (){

    var myFloat = pre_compra = parseFloat($('#pre_compra').val());
    var myFloat = porcen_utili = parseFloat($('#porcen_utili').val());
    var myFloat = precio_vta = parseFloat($('#precio_vta').val());

    if (isNaN(pre_compra) || isNaN(porcen_utili))  
    {
        pre_compra=0.00;
        precio_vta=0.00;
        porcen_utili=0;
    }
    var myFloat = porcen_ganancia = pre_compra/100 * porcen_utili;
    aplicar_ganancia = parseFloat(porcen_ganancia) + parseFloat(pre_compra);
    var myFloat = aplicar_ganancia = aplicar_ganancia.toFixed(2); 
    $('input#precio_vta').val(aplicar_ganancia);
   
}