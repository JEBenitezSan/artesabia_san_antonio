<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/caja_estilo.css"> 

<?php 
include_once "conexion/conexion_user.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consul_widg= "SELECT `id_caja` FROM `caja` WHERE `estado_caja` = 'Abierto'";
        $resultado_widg = $conexion->prepare($consul_widg);
        $resultado_widg->execute();

        $caja_abierta = 0;
        foreach ($resultado_widg as $row) 
        {
        $caja_abierta = $row['id_caja'];
        }

?>
<!-----------------------Alerta------------------------------------>
<div align="center" id="alert_widgets">

</div>
<!-------------------------Alerta---------------------------------->

<!----------------------------------------------------------->
<div class="container-fluid animated fadeIn">
  <h4>Admin Caja</h4>
  <input type="hidden" name="val_caja_abierta" value="<?php echo $caja_abierta;?>" id="val_caja_abierta" readonly>
<div class="row animated fadeIn">
<!----------------------------------------------------------->
    <div class="col-md-3">
    <div class="card card_caja text-dark bg-light mb-3" id="lista_salida" style="width: 100%; cursor: pointer;">
            <div class="card-header card_header"><i class="fas fa-sign-out-alt fa-lg"></i>&nbsp;&nbsp;<strong>Salidas</strong></div>
            <div class="card-body">
              <h5 class="card-" align="center" id="total_salidas"></h5>
            </div>
        </div>
    </div>
    <!----------------------------------------------------------->
    <div class="col-md-3">
        <div class="card card_caja text-dark bg-light mb-3" style="width: 100%;">
            <div class="card-header card_header"><i class="fas fa-cart-arrow-down"></i>&nbsp;&nbsp;<strong>Entradas</strong>&nbsp;&nbsp; <i class="fas fa-sync fa-spin"></i></div>
            <div class="card-body">
              <h5 class="card-" align="center" id="total_entradas"></h5>
            </div>
        </div>
    </div>
    <!----------------------------------------------------------->
    <div class="col-md-3">
        <div class="card card_caja text-dark bg-light mb-3" style="width: 100%;">
            <div class="card-header card_header"><i class="fas fa-search-dollar fa-lg"></i>&nbsp;&nbsp;<strong>Capital</strong></div>
            <div class="card-body">
              <h5 class="card-" align="center" id="total_capital"></h5>
            </div>
        </div>
    </div>
    <!----------------------------------------------------------->
    <div class="col-md-3">
        <div class="card card_caja text-dark bg-light mb-3" style="width: 100%;">
            <div class="card-header card_header">
              <i class="fas fa-hand-holding-usd fa-lg"></i>&nbsp;&nbsp;<strong>Utilidad Neta</strong></div>
              <input type="hidden" name="total_salidas_input" value="" id="total_utilidad_input" readonly>
            <div class="card-body">
              <h5 class="card-" align="center" id="total_utilidad"></h5>
            </div>
        </div>
    </div>
<!----------------------------------------------------------->
</div>
<br>
<!--------------------Menu--------------------------------------->
<nav class="navbar navbar-expand-lg navbar-light color_menu animated fadeIn">
  <div class="container-fluid">
     <a class="navbar-brand" href="#">
        <i class="fas fa-box fa-lg"></i> 
     </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>

    <div class="collapse navbar-collapse" id="navbarScroll">

      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
            <li class="nav-item">
            <a class="nav-link active caja_btnefec" aria-current="page" id="movimientos"><strong>Movimientos</strong></a> 
            </li>
            <li class="nav-item">
               <a class="nav-link active caja_btnefec" aria-current="page" id="admin_caja"><strong>Admin Caja</strong></a>
            </li>
            <li class="nav-item">
               <a class="nav-link active caja_btnefec" aria-current="page" id="anterior_caja"><strong>Caja Anteriores</strong></a>
            </li>
      </ul>

      <div class="d-flex">
        <div class="btn-group" role="group" aria-label="Basic example" style="width: 100%">
            <button type="button" class="btn btn_perso_s" id="btn_salida_caja"><strong>Salida</strong>&nbsp;<i class="fas fa-sign-out-alt"></i></button>
            <button type="button" class="btn btn-primary btn_perso_i" id="btn_abrir_caja"><strong>Abrir Caja</strong>&nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></button>
        </div>
      </div>


    </div>

  </div>
</nav>
<!--------------------Menu--------------------------------------->
<br>
<br>
<!--------------------Tabla descripcion caja--------------------------------------->
<div class="table-responsive animated fadeIn" id='datatabla_cajaprin_2'>
<table class="table table-sm table-bordered animated" id="datatabla_cajaprin" style="width: 100%">
          <thead align="center" class="table_head">
            <tr>
              <th scope="col">Id_C</th>
              <th scope="col">Monto_I</th>
              <th scope="col">Monto_F</th>
              <th scope="col">Fecha_Apertura</th>
              <th scope="col">Fecha_Cierre</th>
              <th scope="col">Total_Caja</th>
              <th scope="col">Estado</th>
              <th scope="col">Usuario</th>
              <th scope="col">Nombre_User</th>
              <th scope="col">Descrip_Cierre</th>
              <th scope="col">Accion</th>
            </tr>
          </thead>

          <tbody align="center">


          </tbody>

       </table>
</div>

<!--------------------Tabla descripcion caja--------------------------------------->
<div class="table-responsive animated fadeIn" id='caja_anterior_ocultar'>
<table class="table table-sm table-bordered animated" id="caja_anterior_data" style="width: 100%">
          <thead align="center" class="table_head_cajaante">
            <tr>
              <th scope="col">Id_C</th>
              <th scope="col">Monto_I</th>
              <th scope="col">Monto_F</th>
              <th scope="col">Fecha_Apertura</th>
              <th scope="col">Fecha_Cierre</th>
              <th scope="col">Total_Caja</th>
              <th scope="col">Estado</th>
              <th scope="col">Usuario</th>
              <th scope="col">Nombre_User</th>
              <th scope="col">Descrip_Cierre</th>
              <th scope="col">Accion</th>
            </tr>
          </thead>

          <tbody align="center">


          </tbody>

       </table>
</div>


<!--------------------Tabla descripcion productos--------------------------------------->
<div id="productos" class="table-responsive animated fadeIn">
<table class="table table-sm table-bordered animated" id="productos_id" style="width: 100%">
          <thead align="center" class="table_head_pro">
            <tr>
              <th scope="col"><img src="static/iconos/detalle.ico" alt="Exito" width="25" height="25"></th>
              <th scope="col">Num_Fac</th>
              <th scope="col">Tipo_Factura</th>
              <th scope="col">Cod_cliente</th>
              <th scope="col">Nombre_cliente</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Total_Fac</th>
              <th scope="col">Descuento</th>
              <th scope="col">Total_Neto</th>
              <th scope="col">Efectivo</th>
              <th scope="col">Vuelto</th>
              <th scope="col">Estado_Fac</th>
              <th scope="col">Vendedor</th>
              <th scope="col">Accion</th>
            </tr>
          </thead>

          <tbody align="center">
            
          <tfoot class="table_head_pro">
            <tr align="center">
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            </tr>
        </tfoot>

          </tbody>

       </table>
</div>


  <div class="col-md-3 my-3"> 

      <small>Entrada</small> 
      <div class="input-group mb-2 card_inpu">
      <span class="input-group-text basic_color_input">
        <i class="fas fa-sign-out-alt fa-lg"></i></span>
      <input type="text" class="form-control" id="total_cierre_caja" readonly disabled style="font-weight: bold;">
      </div>

      <small>Total Neto</small>
      <div class="input-group mb-2 card_inpu">
          <span class="input-group-text basic_color_input">
            <i class="fas fa-search-dollar fa-lg"></i>
          </span>
          <input type="text" class="form-control" id="to_neto_cajacierre" readonly disabled style="font-weight: bold;">
      </div>

      <!-- <small>Otro valor</small>
      <div class="input-group mb-3 card_inpu">
      <span class="input-group-text basic_color_input"><i class="fas fa-box fa-lg"></i></span>
      <input type="text" class="form-control" readonly disabled style="font-weight: bold;">
      </div> -->

  </div>



</div> <!--Fin de container-fluid-->
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
<?php require_once "modales/modal_abrircaja.php"?>
<?php require_once "modales/modal_salidacaja.php"?>
<?php require_once "modales/modal_cerrarcaja.php"?>
<?php require_once "modales/modal_detalleventa.php"?>
<?php require_once "modales/modal_edi_detalleventa.php"?>
<?php require_once "modales/modal_salidas_lista.php"?>

  <script src="static/js/admin_caja.js"></script>





