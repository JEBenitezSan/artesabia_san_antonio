$(document).ready(function() {

    document.getElementById("cod_barra").focus();

    
    /// data de de stock productos
        var opc_stock = 'lista_stock';
        var today = new Date();
        const fecha_expor = today.toLocaleString() 
        
        stock_productos = $('#stock_productos').DataTable({ 
                        
            "footerCallback": function ( row, data, start, end, display )
            {
                tota_entra_desc = this.api()
                    .column(8)
                    .data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0 );
                   
                $(this.api().column(8).footer()).html('Ud:_'+tota_entra_desc);	

            }, 
    
        createdRow: function ( row, data, index )
        {    
            $('td', row).eq(5).css('background-color', '#EFCEAB');
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
                title: 'Reporte de productos stock',
                filename: 'Reporte_de_stock_'+fecha_expor,
                //Aquí es donde generas el botón personalizado
                text: '<button type="button" class="btn btn-warning btn_claro btn-sm"><i class="fas fa-file-excel fa-lg"></i></button>',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                },
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer: true,
                title: 'Reporte de productos stock',
                filename: 'Reporte_de_stock_'+fecha_expor,
                text: '<button type="button" class="btn btn-warning btn_claro btn-sm"><i class="fas fa-file-pdf fa-lg"></i></button>',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                },
    
            },
            
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Imprimir stock',
                text: '<button type="button" class="btn btn-warning btn_claro btn-sm"><i class="fas fa-print fa-lg"></i></button>',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                },
                customize: function(win)
                {
                    $(win.document.body)
                    .prepend(
                        '<img src="http://localhost/arte_san_antonio/dist/static/iconos/logofar.png" width="80" height="75"/>'
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
            {
                extend: 'colvis',
                text: '<button type="button" class="btn btn-warning btn_claro btn-sm"><i class="fas fa-crop-alt fa-lg"></i></button>',
                postfixButtons: ['colvisRestore']
            }
        ],
        destroy: true,
        order: [[ 0, 'des']],
      
        ajax:({          
            url : 'envios_bd/admin_stockmaterial.php',
            method: 'POST', 
            data : {opc_stock}, 
            dataSrc:"",
           }),
    
           columns:[
            {data: "id_materiales"},
            {
                className: 'cod_material_clic',
                orderable: false,
                data: 'codigo',
            },
            {data: "id_tipomaterial"},
            {data: "tipo_material"},
            {data: "color"},
            {data: "cantidad"},
            {data: "id_unimedidas"},
            {data: "unidad_medida"},
            {data: "prec_compra"},
            {data: "moneda"},
            {defaultContent: "<button type='button' class='btn btn-sm btn-warning btn_claro editar_stock_error'><img src='static/iconos/edit_stock.ico' alt='Exito' width='20' height='20'></button>"},  
    
        ],
        
        }); 



        /// Mandar el dato en donde de clic al input 
        $(document).on("click", ".cod_material_clic", function(){
            const cod_produc_clic = parseInt($(this).closest('tr').find('td:eq(1)').text()) ;
            console.log(cod_produc_clic);
            $("#cod_barra").val(cod_produc_clic);
        });


        /// Abrir modal para editar el stock
        $(document).on("click", ".editar_stock_error", function(){

            const id_stock_produc = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
            const cod_barra = ($(this).closest('tr').find('td:eq(1)').text()) ;
            const nombre_product = ($(this).closest('tr').find('td:eq(2)').text()) ;
            const cant_stock = parseInt($(this).closest('tr').find('td:eq(3)').text()) ;
            const categoria = ($(this).closest('tr').find('td:eq(4)').text()) ;
            const id_precio = parseInt($(this).closest('tr').find('td:eq(6)').text()) ;
            const prec_compra = parseFloat($(this).closest('tr').find('td:eq(7)').text()) ;
            const porcen_utili = parseFloat($(this).closest('tr').find('td:eq(8)').text()) ;
            const prec_venta = parseFloat($(this).closest('tr').find('td:eq(9)').text()) ;
            const id_detalle_stoedit = ($(this).closest('tr').find('td:eq(10)').text()) ;
          
          $("#id_stock_add").val(id_stock_produc);
          $("#id_detalle_stoedit").val(id_detalle_stoedit);
          $("#cod_barra_add").val(cod_barra);
          $("#nom_producto_add").val(nombre_product);
          $("#stock_exi_add").val(cant_stock);
          $("#id_precio_add").val(id_precio);
          $("#pre_compra_add").val(prec_compra);
          $("#porcen_utili_add").val(porcen_utili);
          $("#prec_vent_add").val(prec_venta);
          $("#categoria_edit").val(categoria);

            $('#modaleditar_stock').modal({backdrop: 'static', keyboard: false})
            $('#modaleditar_stock').modal('show');
            
        });


   
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

        document.getElementById('remo_aler').style.backgroundColor = '#cce5ff';
        /// activar campos de precios
        $('#activar_campo_precios').click(function () {
            if ($('#activar_campo_precios').is(':checked')) {
            
                $("#pre_compra_add").removeAttr("readonly");
                $("#porcen_utili_add").removeAttr("readonly");
                //$("#prec_vent_add").removeAttr("readonly");
                document.getElementById('remo_aler').style.backgroundColor = '#f8d7da';

                $("#id_precio_add").val('NULL');
                $("#pre_compra_add").val('');
                $("#porcen_utili_add").val('');
                $("#prec_vent_add").val('');
                
            } else {
                $("#pre_compra_add").attr("readonly","readonly");
                $("#porcen_utili_add").attr("readonly","readonly");
                //$("#prec_vent_add").attr("readonly","readonly");
                document.getElementById('remo_aler').style.backgroundColor = '#cce5ff';

            
            }
        });
        
//// Agregar datos del modal para actualizar stock y compra
$('#form_editstock').submit(function(e){                         
    e.preventDefault(); 
  
     var datos_faccompra = 'envios_bd/admin_stock.php';
  
    $.ajax({
      type : 'POST',
      url : datos_faccompra,
      data : $('#form_editstock').serialize(),
      success: function (data)
      {
  
      if (data==1) {

        document.getElementById("form_editstock").reset();

        stock_productos.ajax.reload(null, false);
        
            Swal.fire({
              type: 'success',
              title: 'Datos editados correctamente!!!',
              html: '<h6>Stock de producto actualizados</h6>',
            });  
  
                } 
  
       else if (data == 0){
      
            Swal.fire({
              type: 'error',
              title: 'Datos No editados!!!',
              html: '<h6>No se pudo editar el producto &nbsp; &nbsp;<i class="fas fa-exclamation-triangle"></i></h6>',
            });    
              }
     }
  
    });    
  
  }); 

/// al dar clic en precio de comopra se realiza el calculo y llama a una funcion
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
  
  /// al dar clic en precio de comopra se realiza el calculo y llama a una funcion
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
  


    });   
    /// calcula la ganancia
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
