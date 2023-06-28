<?php
session_start();
if(!isset($_SESSION['s_usuario']))
{
    header("Location: ../index.html");
}


$usuario = $_SESSION["s_usuario"];
$tipouser = $_SESSION["s_tipo_user"];
?>

<link href="static/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plantilla/framework/bootstrap/css/bootstrap.min.css"/>

<style>
.centrar {
  width: 100%;  
  min-height: 100vh;
  display: -webkit-flex;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  padding: 15px;
}

</style>

<div class="container-fluid centrar" align="center">
<div class="col-md-10">
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">
  <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;
      Error Caja Cerrada
  </h4>
  <p>Lo sentimos no puedes facturar si no hay una caja abierta, ponte en contacto con el adminstrador</p>
  <hr>

  <p class="mb-0"><strong><?php echo$usuario;?></strong>&nbsp;&nbsp;Necesitas permiso para poder accesar &nbsp;&nbsp;<a class="btn btn-sm btn-outline-danger" href="../bd/logout.php" role="button">Regresar</a></p>
  
</div>
</div>
</div>

<script src="plantilla/framework/jquery/jquery-3.6.0.min.js"></script> 
<script src="plantilla/framework/jquery/popper.min.js"></script>
<script src="plantilla/framework/bootstrap/js/bootstrap.min.js"></script>  
<script src="plantilla/framework/bootstrap/js/bootstrap.bundle.min.js"></script>  
<script src="plantilla/framework/jquery/bootstrap.bundle.min.js"></script>
<script src="plantilla/framework/jquery-easing/jquery.easing.min.js"></script>