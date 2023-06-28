function format(d) {
    // `d` is the original data object for the row
    return (
        '<div class="container-fluid animated fadeIn" id="expan_reset"><div class="table-responsive"><table class="table table-bordered table-sm">'+
        '<thead class="text-center he_table">'+
                    '<th>Id</th>'+
                    '<th>Correo</th>'+
                    '<th>Contraseña</th>'+
                    '<th>Foto_Perfil</th>'+
                    '<th>Editar</th>'+    
        '</thead>'+
        '<tbody align="center">'+
                '<tr>'+
                    '<td>'+d.id_usuario+'</td>'+
                    '<td>'+d.correo_user+'</td>'+
                    '<td>'+d.password+'</td>'+ 
                    '<td><img class="img-profile rounded-circle" width="64" height="64" src="foto_perfil/'+d.foto_perfil+'"></img></td>'+
                    
            '<td><button type="button" class="btn_resetpass btn btn-outline-danger btn-sm"><i class="fas fa-marker"></i></button></td>'+
                '</tr>'+
        '</tbody>'+
            '</table> </div></div>'
    );
}

$(document).ready(function(){

    $("#form_user").submit(function(event) {
        event.preventDefault();
    
      cantraseña = document.getElementById('cantraseña');
      repiter_con = document.getElementById('repiter_con');  
    
    if (cantraseña.value == repiter_con.value)         
    {

          let form_datos = document.getElementById("form_user");
          let formData = new FormData(form_datos);

          $.ajax({
            method : 'POST',
            url : 'envios_bd/admin_user.php',
            data : formData,
            contentType: false,
            processData: false,

            success: function (data)
            {
                    if (data==1)
                    {	
                    
                    document.getElementById('form_user').reset(); 
                    
                    tabla_gestion_user.ajax.reload(null, false);
            
                    Swal.fire(
                        'Registrado',
                        'Usuario Registrado',
                        'success')
                    }

                    // if (data==2)
                    // {
                    //     Swal.fire({
                    //         type: 'warning',
                    //         title: 'Formato de imagen no admitido',
                    //         text: 'Farmato adminitido JPG',
                    //         })
                    // }

            
                else {
                    Swal.fire({
                            type: 'warning',
                            title: 'Usuario o Contraseña ya existen..!',
                            text: 'Intentalo otra vez',
                            })
                    }
        
            }
          });
    
    }
             
    else {
          $('#repiter_con').val(''); 
            document.getElementById("repiter_con").focus();
            Swal.fire({
            position: 'top-center',
            type: 'error',
            title: 'Contraseña no Cohinciden, Intentalo otra vez',
            showConfirmButton: false,
            timer: 1200
            })         
                  
         }
    
    });

/// Data de la tabla de usuarios
    const opc_user = "lista_user";

    var today = new Date();
    const fecha_expor = today.toLocaleString() 

    tabla_gestion_user = $('#tabla_gestion_user').DataTable({  
        
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
            title: 'Reporte de usuario',
            filename: 'Reporte_de_usuario'+fecha_expor,
    
            //Aquí es donde generas el botón personalizado
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i></button>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            footer: true,
            title: 'Reporte de usuario',
            filename: 'Reporte_de_usuario'+fecha_expor,
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-pdf"></i></button>',
            exportOptions: {
                columns: [0, ':visible']
            },

        },
        
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Imprimir usuario',
            text: '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></button>'
        },

    ],
    destroy: true,
  
    ajax:({          
        url : 'envios_bd/admin_user.php',
        method: 'POST', 
        data : {opc_user}, 
        dataSrc:"",
       }),

       columns:[
        {
            className:'dt-control',
            orderable:false,
            data:null,
            defaultContent: '',
        },

        {data: "id_usuario"},
        {data: "usuario"},
        {data: "nombre_apellido"},
        {data: "tipo_user"},
        {data: "estado"},
        {defaultContent: "<button type='button' class='btn btn-danger btn-sm btneditaruser'><i class='fas fa-user-edit'></i></button>"}, 

    ],
    
    });  

    /// Al dar clic se expande para mostrar mas datos
    $('#tabla_gestion_user tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = tabla_gestion_user.row(tr);
    
        if (row.child.isShown()) {
        
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
    
            row.child( format(row.data())).show();
            tr.addClass('shown');
            
        }
    });

    /// Abrir modal editar de user y ponerlo statico
$('#tabla_gestion_user tbody').on('click', 'td button.btneditaruser', function () {

    const iduser_editar = parseInt($(this).closest('tr').find('td:eq(1)').text()) ;	
    const usuario_sesion = ($(this).closest('tr').find('td:eq(2)').text()) ;	
    const tipo_usuario = ($(this).closest('tr').find('td:eq(4)').text()) ;	
    const estado_usuario = ($(this).closest('tr').find('td:eq(5)').text()) ;	
    $("#id_usuarioedi").val(iduser_editar);
    $("#user_sesion").val(usuario_sesion);
    $("#tipousuario").val(tipo_usuario);
    $("#estadousuario").val(estado_usuario);

    $('#modalediuser').modal({backdrop: 'static', keyboard: false})
    $('#modalediuser').modal('show');
        
  });

  ///Editar datos de un usuario
  $('#edit_form_user').submit(function(e){                         
    e.preventDefault(); 
    var datoscliente = 'envios_bd/admin_user.php';
              
              $.ajax({
              type : 'POST',
              url : datoscliente,
              data : $('#edit_form_user').serialize(),
              success: function (data){
        
              if (data==1) {
                  document.getElementById("edit_form_user").reset();
      
                  Swal.fire({
                      type: 'success',
                      title: 'Usuario modificado Correctamente',
                      text: 'Datos Guardados!!!', })
                      tabla_gestion_user.ajax.reload(null, false);
                          } 
                          
                          else 
                             {
                              Swal.fire({
                                  type: 'error',
                                  title: 'No se pudo modificar el usuario',
                                  text: 'Datos No Ingresados!!!',
                              })
                            }
                     }
      
                  })             
    });

/// Abrir modal de resetnde contraseña
    $('#tabla_gestion_user tbody').on('click', 'td div div td button.btn_resetpass', function () { 

        const id_rest_pass = parseInt($(this).closest('tr').find('td:eq(0)').text());	

        $("#id_usuario_reset").val(id_rest_pass);

        $('#modalresetpass').modal({backdrop: 'static', keyboard: false})
        $('#modalresetpass').modal('show');
            
      });

      /// Update a la contraseña para restablecerla
   $("#reset_form_pass").submit(function(event) {
        event.preventDefault();
    
      cantraseña_reset = document.getElementById('cantraseña_reset');
      repiter_con_reset = document.getElementById('repiter_con_reset');  
    
    if (cantraseña_reset.value == repiter_con_reset.value)         
    {
          var datoscli = 'envios_bd/admin_user.php';
          $.ajax({
          type : 'POST',
          url : datoscli,
          data : $('#reset_form_pass').serialize(),
          success: function (data)
          {
            if (data==1)
            {	
              
              document.getElementById('reset_form_pass').reset(); 
              
              tabla_gestion_user.ajax.reload(null, false);
    
              Swal.fire(
                'Registrado',
                'Contraseña restablecida',
                'success')
             }
    
    
          else {
              Swal.fire({
                      type: 'warning',
                      title: 'Contraseña no restablecida..!',
                      text: 'Intentalo otra vez',
                      })
            }
    
          }
          });
              return false;
    
    }
             
    else {
          $('#repiter_con_reset').val(''); 
            document.getElementById("repiter_con_reset").focus();
            Swal.fire({
            position: 'top-center',
            type: 'error',
            title: 'Contraseña no Cohinciden, Intentalo otra vez',
            showConfirmButton: false,
            timer: 1200
            })         
                  
         }
    
    });
    
  

});
    
    /// Mostrar passwork
    function mostrarPassword(){
            var cambio = document.getElementById("cantraseña");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        } 
    /// Validar input si las contraseña son iguales
        function mostrarPassword_repite(){
            var cambio = document.getElementById("repiter_con");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.rep_ico').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.rep_ico').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        } 

        /// Mostrar passwork reset
        function mostrarPassword_reset(){
            var cambio_reset = document.getElementById("cantraseña_reset");
            if(cambio_reset.type == "password"){
                cambio_reset.type = "text";
                $('.icon_reset').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio_reset.type = "password";
                $('.icon_reset').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        } 
    /// Validar input si las contraseña son iguales reset
        function mostrarPassword_repite_reset (){
            var cambio_reset = document.getElementById("repiter_con_reset");
            if(cambio_reset.type == "password"){
                cambio_reset.type = "text";
                $('.rep_ico_reset').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio_reset.type = "password";
                $('.rep_ico_reset').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        } 

    


