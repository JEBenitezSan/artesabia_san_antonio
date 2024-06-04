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
                    .column(7)
                    .data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0 );
                   
                $(this.api().column(7).footer()).html('Total:_'+tota_entra_desc);	

            }, 
    
        createdRow: function ( row, data, index )
        {    
            $('td', row).eq(4).css('background-color', '#EFCEAB');
            $('td', row).eq(4).css('font-weight', ' bold');
            $('td', row).eq(1).css('font-weight', ' bold');

            
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
            {data: "tipo_material"},
            {data: "color"},
            {data: "cantidad"},
            {data: "unidad_medida"},
            {data: "prec_compra"},
            {data: "sub_total_mate",render: $.fn.dataTable.render.number(",", ".", 2, "$ ")},
            {defaultContent: "<button type='button' class='btn btn-sm btn-warning btn_claro'><i class='fas fa-check'></i></button>"},  
    
        ],
        
        });  

        /// Mandar el dato en donde de clic al input 
        $(document).on("click", ".cod_material_clic", function(){
            const cod_produc_clic = parseInt($(this).closest('tr').find('td:eq(1)').text()) ;
            console.log(cod_produc_clic);
            $("#cod_barra").val(cod_produc_clic);
        });



    });   

