<?php require_once "plantilla/parte_superior.html"?>

<link rel="stylesheet" href="static/css/index_estilo.css"> 
<!----------------------------------------------------------->
<div class="container-fluid animated fadeIn">
  <div class="row">

    
          <div class="container-fluid">
          <div class="row justify-content-center">
          <!--------------------------------------------->
          <div class="col-md-3">       
          <div class="card card_index border-warning mb-3" style="width: 100%;">
            <a href="caja.php"> <img src="static/imagen/ima1.jpg" class="card-img-top animated fadeIn" alt="..."> </a>
            <div class="card-body">
              <h5 class="card-title">Caja</h5>
              <p class="card-text"></p>
            </div>
          </div>      
          </div>
          <!--------------------------------------------->
          <div class="col-md-3">
          <div class="card card_index border-warning mb-3" style="width: 100%;">
          <a href="inventario_productos.php"> <img src="static/imagen/ima2.jpg" class="card-img-top animated fadeIn" alt="..."> </a>
            <div class="card-body">
              <h5 class="card-title">Inventario</h5>
              <p class="card-text">
            <!-----   Reparacion Movil <br>Reparacion Compu <br>Marketing Digital <br>Sistemas Informaticos <br>Fotocopias Impresiones otros-->
              </p>
            </div>
          </div>
          </div>
          <!--------------------------------------------->
          <div class="col-md-3">
          <div class="card card_index border-warning mb-3" style="width: 100%;">
          <a href="factura.php"> <img src="static/imagen/ima3.jpg" class="card-img-top animated fadeIn" alt="..."></a>
            <div class="card-body">
              <h5 class="card-title">Factura Productos</h5>
              <p class="card-text">
              <!----- SmartPhone <br>Gama Baja <br>Accesorios---->
              </p>
            </div>
          </div>
          </div>
          <!--------------------------------------------->
          <div class="col-md-3">
          <div class="card card_index border-warning mb-3" style="width: 100%;">
          <a href="servicios.php"> <img src="static/imagen/ima4.jpg" class="card-img-top animated fadeIn" alt="...">  </a>
            <div class="card-body">
              <h5 class="card-title">Gestión Servicios</h5>
              <p class="card-text">
              <!-----SmartPhone <br>Gama Baja <br>Accesorios--->
              </p>
            </div>
          </div>
          </div>
          <!---------------------Segunda Fila------------------------>
          <div class="col-md-3">
          <div class="card card_index border-warning mb-3" style="width: 100%;">
            <a href="registro_usuario.php"> <img src="static/imagen/ima5.jpg" class="card-img-top animated fadeIn" alt="..."> </a>
            <div class="card-body">
              <h5 class="card-title" id="btnBD">Permisos de usuario</h5>
              <p class="card-text"></p>
            </div>
          </div>
          </div>
          <!--------------------------------------------->
          <div class="col-md-3">
          <div class="card card_index border-warning mb-3" style="width: 100%;">
          <a href="reporte_ventas_vendedor.php"> <img src="static/imagen/ima6.jpg" class="card-img-top animated fadeIn" alt="..."> </a>
            <div class="card-body">
              <h5 class="card-title">Ventas y comisiones</h5>
              <p class="card-text">
            <!-----   Reparacion Movil <br>Reparacion Compu <br>Marketing Digital <br>Sistemas Informaticos <br>Fotocopias Impresiones otros-->
              </p>
            </div>
          </div>
          </div>
          <!--------------------------------------------->
          <div class="col-md-3">
          <div class="card card_index border-warning mb-3" style="width: 100%;">
          <a href="planilla.php"> <img src="static/imagen/ima7.jpg" class="card-img-top animated fadeIn" alt="..."></a>
            <div class="card-body">
              <h5 class="card-title">Pagos usuarios</h5>
              <p class="card-text">
              <!----- SmartPhone <br>Gama Baja <br>Accesorios---->
              </p>
            </div>
          </div>
          </div>
          <!--------------------------------------------->
          <div class="col-md-3">
          <div class="card card_index border-warning mb-3" style="width: 100%;">
          <a href="reporte_utilidades.php"> <img src="static/imagen/ima8.jpg" class="card-img-top animated fadeIn" alt="...">  </a>
            <div class="card-body">
              <h5 class="card-title">Utilidades</h5>
              <p class="card-text">
              <!-----SmartPhone <br>Gama Baja <br>Accesorios--->
              </p>
            </div>
          </div>
          </div>
          <!--------------------------------------------->
          </div>

          <!------->
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="static/imagen/ima1.jpg" class="d-block w-100 imgebox" alt="...">
                  </div>

                  <div class="carousel-item">
                    <img src="static/imagen/ima2.jpg" class="d-block w-100 imgebox" alt="...">
                  </div>

                  <div class="carousel-item">
                    <img src="static/imagen/ima7.jpg" class="d-block w-100 imgebox" alt="...">
                  </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>
          <!------->

          </div>


  </div>
</div>
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
  





