$('#formLogin').submit(function(e){
   e.preventDefault();
   var usuario = $.trim($("#usuario").val());    
   var password =$.trim($("#password").val());    
    
   if(usuario.length == "" || password == ""){
      Swal.fire({
          type:'warning',
          title:'Debe ingresar un usuario y/o password',
      });
      return false; 
    }else{

        $.ajax({
           url:"bd/login.php",
           type:"POST",
           data: $('#formLogin').serialize(),
           success:function(data){ 
            
               if(data == 1){
      
                   Swal.fire({
                       type:'error',
                       title:'Usuario y/o password incorrecta',
                   });
               }
               else
               {

                document.getElementById("habilitarloader").style.display="block";

                setTimeout(function(){
                     window.location.href = "dist/index.php";
                }, 1200);

                
                //    Swal.fire({
                //        type:'success',
                //        title:'¡Conexión exitosa!',
                //        confirmButtonColor:'#3085d6',
                //        confirmButtonText:'Ingresar'
                //    }).then((result) => {
                //        if(result.value){
                //            //window.location.href = "vistas/pag_inicio.php";
                          
                //        }
                //   })
                   
               }
           }    
        });
    }     
});

$(document).ready(function () {
    $('#mostrar_contrasena').click(function () {
      if ($('#mostrar_contrasena').is(':checked')) {
        $('#password').attr('type', 'text');
      } else {
        $('#password').attr('type', 'password');
      }
    });
  });