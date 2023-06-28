/// carga los datos al localstore
function cargar_localstore(){
        fac_num_compra = document.getElementById("fac_num_compra").value;
        fac_monto_compra = document.getElementById("fac_monto_compra").value;
        fac_fech_compra = document.getElementById("fac_fech_compra").value;
        user = document.getElementById("user").value;
        opc_compra = document.getElementById("opc_compra").value;
        proveedor_produc = document.getElementById("proveedor_produc").value;

        var obj_fac_compras = {
          numfac: fac_num_compra,
          moncompra: fac_monto_compra,
          fec_compra: fac_fech_compra,
          usuario: user,
          opc: opc_compra,
          provee_compra: proveedor_produc,
        }

        localStorage.setItem("fac_compras", JSON.stringify(obj_fac_compras));
        var obj_compras = localStorage.getItem("fac_compras");
        console.log(obj_compras);
}
/// deshabilita los campo de factura de compras
function deshabilitar_campos () {
    document.getElementById('btn_new_campra').disabled = false;
    $("#fac_num_compra").attr("readonly","readonly");
    $("#fac_monto_compra").attr("readonly","readonly");
    $("#fac_fech_compra").attr("readonly","readonly");
    document.getElementById('proveedor_produc').disabled = true;
    document.getElementById('btn_submit_compra').disabled = true;

    $("#mostar_input").show();
    $("#busqueda_compra_pro").val('');
    document.getElementById("busqueda_compra_pro").focus(); 
}

$(document).ready(function() { 

 var objet = localStorage.getItem("fac_compras");
 
    if(objet == null) 
    {
      console.log("---->Error");
      document.getElementById('btn_new_campra').disabled = true;
    }
    else if (objet.length >= 1)
    {
      objet = JSON.parse(objet);
      deshabilitar_campos();
      console.log('---->',objet);
      document.getElementById('btn_new_campra').disabled = false;

      $("#fac_num_compra").val(objet['numfac']);
      $("#fac_monto_compra").val(objet['moncompra']);
      $("#fac_fech_compra").val(objet['fec_compra']);
      $("#user").val(objet['usuario']);
      $("#opc_compra").val(objet['opc']);
      document.getElementById('proveedor_produc').disabled = false;

    }


  $('#form_fac_compra').submit(function(e){                         
    e.preventDefault(); 

     var datos_faccompra = 'envios_bd/registrar_compras.php';

    $.ajax({
      type : 'POST',
      url : datos_faccompra,
      data : $('#form_fac_compra').serialize(),
      success: function (data)
      {

      if (data==1) {
            deshabilitar_campos ();
            cargar_localstore();
                } 

       else if (data == 0){
        var num_f = document.getElementById("fac_num_compra").value;
            Swal.fire({
              type: 'error',
              title: 'Datos No Ingresados!!!',
              html: '<h6>No se pudo ingresar la factura de compra&nbsp;'+ num_f +' Ya existe &nbsp;<i class="fas fa-exclamation-triangle"></i></h6>',
            });    
              }
     }

    })    

  }); 
/// Boton deshabilita los campos disabled para agregar una nueva factura
  $("#btn_new_campra").click(function(){

    localStorage.removeItem("fac_compras");

    document.getElementById("form_fac_compra").reset();

    $("#fac_num_compra").removeAttr("readonly");
    $("#fac_monto_compra").removeAttr("readonly");
    $("#fac_fech_compra").removeAttr("readonly");

    document.getElementById('proveedor_produc').disabled = false;
    document.getElementById('btn_submit_compra').disabled = false;

     
    var x = document.getElementById("mostar_tabla");
    x.style.display = "none";

    var x = document.getElementById("mostar_form");
    x.style.display = "none";

    var x = document.getElementById("mostar_input");
    x.style.display = "none";
    
    document.getElementById("fac_num_compra").focus(); 

    document.getElementById('btn_new_campra').disabled = true;
    $("#busqueda_compra_pro").val('');


  });

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
//// Obtener lista de tipo de materiales
$(obtener_com_categoria());
function obtener_com_categoria(consulta) 
{
$.ajax({
    url : 'combo_ajax/com_tipomaterial.php',
    type : 'POST',
    dataType : 'html',
})

.done(function(respuesta){
    $(".tipo_material").html(respuesta);
})

.fail(function() {
    console.log("error");	
});

}

//// Obtener lista de unidades de medidas
$(obtener_cat_unidad());
function obtener_cat_unidad(consulta) 
{
$.ajax({
    url : 'combo_ajax/com_unidad.php',
    type : 'POST',
    dataType : 'html',
})

.done(function(respuesta){
    $(".cat_unidad").html(respuesta);
})

.fail(function() {
    console.log("error");	
});

}

//// Obtener lista de unidades de medidas
$(obtener_cat_precio());
function obtener_cat_precio(consulta) 
{
$.ajax({
    url : 'combo_ajax/com_precio.php',
    type : 'POST',
    dataType : 'html',
})

.done(function(respuesta){
    $(".cat_precio").html(respuesta);
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

 /// Abrir modal agregar categorias y ponerlo statico--------------------------------------------------->
 $(".add_tipomaterial").click(function(){
  var x = document.getElementById("add2");
  x.style.display = "none";
  var x = document.getElementById("add3");
  x.style.display = "none";

  $('#modal_add_categoria').modal({backdrop: 'static', keyboard: false})
  $('#modal_add_categoria').modal('show');
  $("#add1").show("show");
})
 /// Abrir modal agregar categorias y ponerlo statico--------------------------------------------------->
 $(".add_unidad").click(function(){
  var x = document.getElementById("add1");
  x.style.display = "none";
  var x = document.getElementById("add3");
  x.style.display = "none";

  $('#modal_add_categoria').modal({backdrop: 'static', keyboard: false})
  $('#modal_add_categoria').modal('show');
  $("#add2").show("show");
})
 /// Abrir modal agregar categorias y ponerlo statico--------------------------------------------------->
 $(".add_precio").click(function(){
  var x = document.getElementById("add1");
  x.style.display = "none";
  var x = document.getElementById("add2");
  x.style.display = "none";

  $('#modal_add_categoria').modal({backdrop: 'static', keyboard: false})
  $('#modal_add_categoria').modal('show');
  $("#add3").show("show");
})



///Guardar productos
$('#formaterial').submit(function(e){                         
  e.preventDefault(); 

        $.ajax({
        type : 'POST',
        url : 'envios_bd/registrar_compras.php',
        data : $('#formaterial').serialize(),
        success: function (data){

        if (data == 1)
        {

            document.getElementById("formaterial").reset();

              Swal.fire({
                  type: 'success',
                  title: 'Registrado Correctamente',
                  html: '<h6>Material Ingresado !!!&nbsp;<i class="fas fa-building fa-2x"></i> </h6>',
                  showConfirmButton: true,
                  })
        }
        if (data == 0)
        {
            Swal.fire({
                type: 'error',
                title: 'Material no ingresado',
                html: '<h6>Producto No Ingresados!!!&nbsp; <i class="fas fa-times"></i></h6>',
                showConfirmButton: false,
                timer: 2000,})
        }

        }

        });

});



////-----------Busqueda y acciones de validaciones en agregar o editar stock entrada de producto-------------->

$('#btnbusq_compra_pro').click(function()
{
    tabla_ajax_add_stock ();
});


/// Abrir modal y valuar campos con campos de la tabla
$(document).on("click", ".add_stock", function(){
      
  const id_materiales = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
  const tipo_material = $(this).closest('tr').find('td:eq(1)').text() ;
  const codigo_mat = parseInt($(this).closest('tr').find('td:eq(2)').text()) ;
  const color = $(this).closest('tr').find('td:eq(3)').text() ;
  const cantidad = parseInt($(this).closest('tr').find('td:eq(4)').text()) ;
  const unidad_medida = $(this).closest('tr').find('td:eq(5)').text() ;
  const id_prec_mate = parseFloat($(this).closest('tr').find('td:eq(6)').text()) ;
  const prec_compra = parseFloat($(this).closest('tr').find('td:eq(7)').text()) ;

// new_stock_add
// new_total_stock_add

$("#id_material").val(id_materiales);
$("#codmaterial").val(codigo_mat);
$("#tipomaterial").val(tipo_material);
$("#stock_exi_add").val(cantidad);
$("#id_precio_add").val(id_prec_mate);
$("#pre_compra_add").val(prec_compra);
$("#colormaterial").val(color);
$("#unidamedida").val(unidad_medida);


$("#ud_medida").html('Unidad de medida : '+unidad_medida);

   $('#modal_addstock').modal({backdrop: 'static', keyboard: false})
   $('#modal_addstock').modal('show');

    
});
 
/// Calcula la sumatoria del stock anterior mas el nuevo entrante
$('#add_stock_edit').on('keyup','#new_stock_add', function (){
  var stock_exi_add = parseInt($('#stock_exi_add').val());
  var new_stock_add = parseInt($('#new_stock_add').val());
  if (new_stock_add < 0) {
    Swal.fire({
        type: 'error',
        title: 'No es posible',
        text: 'Ingrese un nuevo stock valido',
        footer: '<strong>El stock deve ser mayor a 0</strong>'
      }) 
      
      document.getElementById("new_stock_add").focus().val('');
} 
else {
  stock_suma(stock_exi_add, new_stock_add);

  $("input#new_total_stock_add").val(stock_total);
}
});

/// al cerrar el modal recargada la informacion de la tabla ya con los datos agregadps
$('#btn_add_stock').click(function()
{
  tabla_ajax_add_stock ();
});

document.getElementById('remo_aler').style.backgroundColor = '#dec1a2';

$('#activar_campo_precios').click(function () {
  if ($('#activar_campo_precios').is(':checked')) {
 
    $("#id_precio_add").removeAttr("readonly");
    $("#nuevo_precio").removeAttr("readonly");
    $("#ntipo_moneda").removeAttr("readonly");
    //$("#prec_vent_add").removeAttr("readonly");
    document.getElementById('remo_aler').style.backgroundColor = '#f8d7da';

    $("#id_precio_add").val('Nuevo');
    $("#nuevo_precio").val('');
    $("#ntipo_moneda").val('');

     
  } else {
    $("#id_precio_add").attr("readonly","readonly");
    $("#pre_compra_add").attr("readonly","readonly");
     $("#nuevo_precio").attr("readonly","readonly");
     $("#ntipo_moneda").attr("readonly","readonly");
    document.getElementById('remo_aler').style.backgroundColor = '#dec1a2';

  
  }
});

//// Agregar datos del modal para actualizar stock y compra
$('#form_addstock_new').submit(function(e){                         
  e.preventDefault(); 

   var datos_faccompra = 'envios_bd/registrar_compras.php';

  $.ajax({
    type : 'POST',
    url : datos_faccompra,
    data : $('#form_addstock_new').serialize(),
    success: function (data)
    {

    if (data==1) {
      document.getElementById("form_addstock_new").reset();
      tabla_ajax_add_stock ();
          Swal.fire({
            type: 'success',
            title: 'Datos Ingresados!!!',
            html: '<h6>Se agrego la compra y sumamos a tu stock &nbsp; &nbsp;<i class="fa fa-check" aria-hidden="true"></i></h6>',
          });  

              } 

     else if (data == 0){
    
          Swal.fire({
            type: 'error',
            title: 'Datos No Ingresados!!!',
            html: '<h6>No se pudo ingresar el producto comprado &nbsp; &nbsp;<i class="fas fa-exclamation-triangle"></i></h6>',
          });    
            }
   }

  });    

}); 
/// Cada ves que teclee en esos dos campos llamara la funcion para
/// calcular la utilidad en formulario
$('#por_ganancia').on('keyup','#pre_compra', function (){
  var myFloat = pre_compra = parseFloat($('#pre_compra').val());
  var myFloat = porcen_utili = parseFloat($('#porcen_utili').val());
  var myFloat = precio_vta = parseFloat($('#precio_vta').val());
  if (pre_compra < 0) {
    Swal.fire({
        type: 'error',
        title: 'No es posible',
        text: 'Ingrese un precio de compra valido',
        footer: '<strong>El precio de compra deve ser mayor a 0</strong>'
      }) 
      document.getElementById("pre_compra").focus();
} 
else {
    ganancia_porcen (pre_compra, porcen_utili, precio_vta);
    $('input#precio_vta').val(aplicar_ganancia);
}
});

$('#por_ganancia').on('keyup','#porcen_utili', function (){
  var myFloat = pre_compra = parseFloat($('#pre_compra').val());
  var myFloat = porcen_utili = parseFloat($('#porcen_utili').val());
  var myFloat = precio_vta = parseFloat($('#precio_vta').val());
  if (porcen_utili < 0) {
    Swal.fire({
        type: 'error',
        title: 'No es posible',
        text: 'Ingrese un porcentaje valido',
        footer: '<strong>El porcentaje deve ser mayor a 0</strong>'
      }) 

      document.getElementById("porcen_utili").focus();
} 
else {
    ganancia_porcen (pre_compra, porcen_utili, precio_vta);
    $('input#precio_vta').val(aplicar_ganancia);
}
});

/// Cada ves que teclee en esos dos campos llamara la funcion para
/// calcular la utilidad en agregar mas stock al inventario stock
$('#mul_utili_add').on('keyup','#pre_compra_add', function (){
  var myFloat = pre_compra_add = parseFloat($('#pre_compra_add').val());
  var myFloat = porcen_utili_add = parseFloat($('#porcen_utili_add').val());
  var myFloat = prec_vent_add = parseFloat($('#prec_vent_add').val());
  if (pre_compra_add < 0) {
    Swal.fire({
        type: 'error',
        title: 'No es posible',
        text: 'Ingrese precio de compra valido',
        footer: '<strong>El precio de compra deve ser mayor a 0</strong>'
      }) 

      document.getElementById("pre_compra_add").focus();
}
else {
   ganancia_porcen (pre_compra_add,porcen_utili_add,prec_vent_add);
   $('input#prec_vent_add').val(aplicar_ganancia);
}
});


$('#mul_utili_add').on('keyup','#porcen_utili_add', function (){
  var myFloat = pre_compra_add = parseFloat($('#pre_compra_add').val());
  var myFloat = porcen_utili_add = parseFloat($('#porcen_utili_add').val());
  var myFloat = prec_vent_add = parseFloat($('#prec_vent_add').val());
 if (porcen_utili_add < 0) {
      Swal.fire({
          type: 'error',
          title: 'No es posible',
          text: 'Ingrese un porcentaje valido',
          footer: '<strong>El porcentaje deve ser mayor a 0</strong>'
        }) 

        document.getElementById("porcen_utili_add").focus();
 }

 else {
     ganancia_porcen (pre_compra_add,porcen_utili_add,prec_vent_add);
     $('input#prec_vent_add').val(aplicar_ganancia);
 }
});

 
 

});/// Carga la pagina


function tabla_ajax_add_stock (){
  
  busqueda_compra_pro  = $.trim($("#busqueda_compra_pro").val());
  opc_compra = 'add_lista_compra';

  $.ajax({
      url:"envios_bd/registrar_compras.php",
      type:"POST",
      datatype: "json",
      data: {busqueda_compra_pro, opc_compra}, 
      success:function(data){
      var js = JSON.parse(data);
      if(js)
          {
              var tabla;
              for(var i = 0; i < js.length; i++)
                    {
                      let cantidad = js[i].cantidad
                      let precio = js[i].prec_compra
                      let total = precio * cantidad;

                      tabla+='<tr>'+
                    '<td style="font-weight: bold;">'+js[i].id_materiales+'</td>'+ 
                    '<td>'+js[i].tipo_material+'</td>'+
                    '<td>'+js[i].codigo+'</td>'+
                    '<td>'+js[i].color+'</td>'+
                    '<td>'+js[i].cantidad+' '+js[i].unidad_medida+'</td>'+
                    '<td>'+js[i].unidad_medida+'</td>'+
                    '<td>'+js[i].id_prec_mate+'</td>'+
                    '<td>'+js[i].prec_compra+' '+js[i].moneda+'</td>'+
                    '<td>'+total+' '+js[i].moneda+'</td>'+
                    '<th><button type="button" class="btn-sm btn btn-warning btn_oscuro add_stock">'+
                    '<img src="static/iconos/add.ico" alt="Agregar Cliente" width="30" height="30"></img>'+
                    '</button></th>'+
                    '</tr>'; 
                    }

              $('#producto_existe').html(tabla);

              var x = document.getElementById("mostar_form");
              x.style.display = "none";

              $("#mostar_tabla").show("slow");

              document.getElementById("busqueda_compra_pro").focus(); 
      
         }

      if(data == 0)
      {
        var x = document.getElementById("mostar_tabla");
        x.style.display = "none";
        $("#mostar_form").show("slow");

          var busqueda_compra_pro = document.getElementById("busqueda_compra_pro").value;
        //  var fac_compras_nueva = document.getElementById("numfac_new_compra").value;

         $("#cod_material").val(busqueda_compra_pro);
        //  $("#fac_compras_nueva").val(fac_compras_nueva);

         document.getElementById("busqueda_compra_pro").focus(); 
         $("#busqueda_compra_pro").val('');
  
      }

      }
  });
}

function ganancia_porcen (pre_compra, porcen_utili, precio_vta){

  var myFloat = pre_compra 
  var myFloat = porcen_utili 
  var myFloat = precio_vta

  if (isNaN(pre_compra) || isNaN(porcen_utili))  
  {
      pre_compra=0.00;
      precio_vta=0.00;
      porcen_utili=0;
  }
  var myFloat = porcen_ganancia = pre_compra/100 * porcen_utili;
  aplicar_ganancia = parseFloat(porcen_ganancia) + parseFloat(pre_compra);
  var myFloat = aplicar_ganancia = aplicar_ganancia.toFixed(2); 

  return aplicar_ganancia;
 
}

function stock_suma (stock_actual, stock_nuevo ){
  var myFloat = stock_actual;
  var myFloat = stock_nuevo; 

  if (isNaN(stock_nuevo))  
  {
    stock_nuevo = 0;
  }

  var myFloat = stock_total = parseInt(stock_actual) + parseInt(stock_nuevo);

  return stock_total;
 
}
