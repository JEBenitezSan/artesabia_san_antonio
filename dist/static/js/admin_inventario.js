$(document).ready(function() {
    /// data de de stock productos
        var opc_invet = 'lista_invent';
        
        var today = new Date();

        const fecha_expor = today.toLocaleString() 
        
        stock_productos = $('#stock_productos').DataTable({ 
                        
            "footerCallback": function ( row, data, start, end, display )
            {
                tota_entra_desc = this.api()
                    .column(3)
                    .data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0 );
                   
                $(this.api().column(3).footer()).html('Ud: '+tota_entra_desc);	
                ////--------------------------------------------------->
                gran_total_b = this.api()
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
                var gran_total_b = gran_total_b.toFixed(2);
                $(this.api().column(5).footer()).html(gran_total_b);	
                ////--------------------------------------------------->
                gran_total_c = this.api()
                .column(7)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
                var gran_total_c = gran_total_c.toFixed(2);
                $(this.api().column(7).footer()).html(gran_total_c);
              
                ////--------------------------------------------------->
                gran_utulidad_n = this.api()
                .column(11)
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );
                var gran_utulidad_n = gran_utulidad_n.toFixed(2);
                $(this.api().column(11).footer()).html(gran_utulidad_n);

            }, 
            createdRow: function ( row, data, index )
            {    
                $('td', row).eq(3).css('background-color', '#B2D8BB');
                $('td', row).eq(3).css('font-weight', ' bold');
                $('td', row).eq(4).css('background-color', '#75C788');
                $('td', row).eq(5).css('background-color', '#3BA755');
                $('td', row).eq(5).css('font-weight', ' bold');
                $('td', row).eq(6).css('background-color', '#ECBB6F');
                $('td', row).eq(7).css('background-color', '#DA9222');
                $('td', row).eq(7).css('font-weight', ' bold');
                $('td', row).eq(13).css('background-color', '#54AFF3');
                $('td', row).eq(13).css('font-weight', ' bold');
                $('td', row).eq(14).css('background-color', '#0590F7');
                $('td', row).eq(14).css('font-weight', ' bold');
                
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
            {
                extend: 'colvis',
                text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-crop-alt"></i></button>',
                postfixButtons: ['colvisRestore']
            }
        ],
        destroy: true,
      
        ajax:({          
            url : 'envios_bd/admin_inventario.php',
            method: 'POST', 
            data : {opc_invet}, 
            dataSrc:"",
           }),
    
           columns:[
            {data: "id_stock_produc"},
            {data: "cod_barra"},
            {data: "nombre_product"},
            {data: "cant_producto"},
            {data: "prec_venta"},
            {data: "subtotal_brut",render: $.fn.dataTable.render.number(",", ".", 2, " ")},
            {data: "prec_compra"},
            {data: "subtotal_cap",render: $.fn.dataTable.render.number(",", ".", 2, " ")},
            {data: "nom_proveedor"},
            {data: "categoria"},
            {data: "porcen_utili"},
            {data: "gran_utili",render: $.fn.dataTable.render.number(",", ".", 2, " ")},
            {defaultContent: "<button type='button' class='btn btn-sm btn-primary'><i class='fas fa-check'></i></button>"}, 
    
        ],
        
        }); 
    }); 

