<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/estilo_reporte_utilidades.css"> 
<!----------------------------------------------------------->
<div class="container-fluid animated fadeIn">
    <div class="row">
        <div class="col-md-6">
            <h4 align="center" class="my-3">Reporte. Gestión de utilidades </h4> 
        </div>
        <div class="col-md-6">
        <a class="btn btn-primary mb-3" href="lista_utilidades.php" role="button" id="lista_utilidades">
          Lista de utilidad guardadas  <img src="static/iconos/lista_u.ico" alt="Exito" width="32" height="32" >
        </a>
            
        </div>
    </div>

<!----------------------------------------------------------->
<div class="alert alert-primary container_box" role="alert">
    <input type="hidden" name="user_planilla" value="<?php echo $id_usuario;?>" id="user_planilla" class="form-control" readonly>

            <div class="row container_input" id="fecha_repor">
            
                    <div class="col-md-3">
                        <small>Fecha inicial</small>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            <input type="datetime-local" class="form-control fechas_i" placeholder="Fecha inicial" id="fecha_info1" name="fecha_info1">
                        </div>
                    </div>

                    <div class="col-md-3">
                    <small>Fecha final</small>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            <input type="datetime-local" class="form-control fechas_i" placeholder="Fecha final" id="fecha_info2" name="fecha_info2">
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-outline-primary" id="cal_utili" style="width: 100%; height: 100%;">
                        Calcular 
                        <img src="static/iconos/ganancia.ico" alt="Exito" width="52" height="52">
                    </button>
                    </div>
            

                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-outline-info" id="guardar_final_utili" style="width: 100%; height: 100%;">
                        Guardar 
                        <img src="static/iconos/final_utili.ico" alt="Exito" width="52" height="52">
                    </button>
                    </div>
                
            </div>
</div>
<div style="display: none;">
    <h5 id="total_salidas_id"></h5>
    <h5 id="total_entradas_id"></h5>
    <h5 id="total_servicios_id"></h5>
    <h5 id="total_salario_id"></h5>
    <h5 id="gran_totalentradasid"></h5>
    <h5 id="total_gananciapro_id"></h5>
</div>


<!---------------------------------------------->
<div class="row animated fadeIn my-4">
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
        <div class="card card_caja_salario text-dark bg-light mb-3" style="width: 100%;">
            <div class="card-header card_header_salario"><i class="fas fa-search-dollar fa-lg"></i>&nbsp;&nbsp;<strong>Salario</strong></div>
            <div class="card-body">
              <h5 class="card-" align="center" id="total_salario"></h5>
            </div>
        </div>
    </div>
    <!----------------------------------------------------------->
    <div class="col-md-3">
        <div class="card card_caja_utili text-dark mb-3" id="card_caja_utili" style="width: 100%;">
            <div class="card-header card_header_utili" id="card_header_utili">
              <i class="fas fa-hand-holding-usd fa-lg"></i>&nbsp;&nbsp;<strong>Utilidad Neta</strong></div>
            <div class="card-body">
              <h5 class="card-" align="center" id="total_utilidad"></h5>
            </div>
        </div>
    </div>
    <!----------------------------------------------------------->
</div>

<!------------------------Productos----------------------------------->
<div class="card border_perso mb-4 card_info_utili" style="max-width: 100%;">

  <div class="card-header alert alert-primary container_son" role="alert">
      <h4 align="center">Reporte. Ventas </h4> 
  </div>
        <div class="card-body text_primary">

        <div class="table-responsive bordes_margen animated fadeIn"> 
            <table class='table table-bordered table-sm' id='reporte_ventas_utilidad' style="width: 100%; background-color: #ffffff;">
                <thead class="table-primary">
                <tr align="center">
                    <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
                    <th scope="col">C_Barra</th>
                    <th scope="col">Nombre</th>
                    <th scope="col"><i class="fas fa-tags"></i> Neto</th>
                    <th scope="col"><i class="fas fa-tags"></i> Apli</th>
                    <th scope="col">P_Venta</th>
                    <th scope="col">Cant</th>
                    <th scope="col">S_Total</th>
                    <th scope="col">P_compra</th>
                    <th scope="col">Fecha_Fac</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Actiones</th>
                </tr>
                </thead>
                <tbody align="center">

                    <tfoot class="table-primary">
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
                        </tr>
                    </tfoot>
                </tbody>
            </table>
        </div>
        
        </div>
</div>
<!------------------------Servicios----------------------------------->

<div class="card border_perso mb-4 card_info_utili" style="max-width: 100%;">

  <div class="card-header alert" role="alert"  style="background-color: #7C9BC9;">
      <h4 align="center">Reporte. Servicios </h4> 
  </div>
        <div class="card-body text_primary">

        <div class="table-responsive bordes_margen animated fadeIn"> 
            <table class='table table-bordered table-sm' id='reporte_ventas_servicios' style="width: 100%; background-color: #ffffff;">
                <thead class="table-primary">
                <tr align="center">
                    <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
                    <th scope="col">C_Barra</th>
                    <th scope="col">Nombre</th>
                    <th scope="col"><i class="fas fa-tags"></i> Neto</th>
                    <th scope="col"><i class="fas fa-tags"></i> Apli</th>
                    <th scope="col">P_Venta</th>
                    <th scope="col">Cant</th>
                    <th scope="col">S_Total</th>
                    <th scope="col">Fecha_Fac</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Actiones</th>
                </tr>
                </thead>
                <tbody align="center">

                    <tfoot class="table-primary">
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
                        </tr>
                    </tfoot>
                </tbody>
            </table>
        </div>
        
        </div>
</div>
<!----------------------------------------------------------->

<!-- 
<div class="separador"></div> -->

<!----------------------------------------------------------->

<div class="row">
    <!----------------------------------------------------------->
    <div class="col-md-12">
        <div class="card border_perso_1 mb-4 card_info_utili_1" style="max-width: 100%;">

        <div class="card-header alert alert-success container_son_2" role="alert">
            <h4 align="center">Salidas administrativas</h4> 
        </div>
                <div class="card-body text-primary color_texto">
                    <div class="table-responsive">
            
                        <table class='table table-bordered table-sm' id='tabla_1' style="width: 100%; background-color: #ffffff;">
                            <thead class="table-danger">
                            <tr align="center">
                                <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
                                <th scope="col">Tipo_Salida</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Caja</th>
                                <th scope="col">Descrop_Caja</th>
                                <th scope="col">Fecha_realizada</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody align="center">

                                <tfoot class="table-danger">
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
                                    </tr>
                                </tfoot>
                            </tbody>
                        </table>

                    </div>
                </div>
        </div>
    </div>
    <!----------------------------------------------------------->
    <div class="col-md-12">
        <div class="card border_perso_1 mb-4 card_info_utili_2" style="max-width: 100%;">

        <div class="card-header alert alert-primary container_son_2" role="alert">
            <h4 align="center">Pagos al personal </h4> 
        </div>
                <div class="card-body text-primary color_texto">
                    <div class="table-responsive">

                    <table class='table table-bordered table-sm' id='tabla_2' style="width: 100%; background-color: #ffffff;">
                        <thead class="table-danger">
                        <tr align="center">
                            <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
                            <th scope="col">Vendedor</th>
                            <th scope="col">Comisión</th>
                            <th scope="col">Salario</th>
                            <th scope="col">Total_Neto</th>
                            <th scope="col">Fecha_Pago</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody align="center">

                            <tfoot class="table-danger">
                                <tr align="center">
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
                </div>
        </div>
    </div>
    <!----------------------------------------------------------->
</div>

<!----------------------------------------------------------->
</div>
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>

<script src="static/js/admin_reporte_utilidad.js"></script>
<script src="static/js/numeral.min.js"></script>







