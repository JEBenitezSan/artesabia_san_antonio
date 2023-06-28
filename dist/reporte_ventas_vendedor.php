<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/estilo_vta_vendedor.css"> 
<!----------------------------------------------------------->
<div class="container-fluid animated fadeIn">
 <h4 align="center">Ventas, comisiones de usuarios y pagos</h4>
    <!----------------------------------------------------------->
    <div class="alert alert-primary container_box" role="alert">

        <input type="hidden" name="user_planilla" value="<?php echo $id_usuario;?>" id="user_planilla" class="form-control" readonly>

        <form id="form_filtro_planilla">

                <div class="row container_input" id="fecha_repor">
                
                        <div class="col-md-4">
                            <small>Fecha inicial</small>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                <input type="datetime-local" class="form-control" placeholder="Fecha inicial" id="fecha_info1" name="fecha_info1">
                            </div>
                        </div>

                        <div class="col-md-4">
                        <small>Fecha final</small>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                <input type="datetime-local" class="form-control" placeholder="Fecha final" id="fecha_info2" name="fecha_info2">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <small>Usuario vendedor</small>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-users-cog"></i></span>

                                <select class="form-select select_vendedor">
                
                                </select>

                            </div>
                        </div>
                    
                </div>
                <div class="row">
                        <div class="col-md-3 mb-2">
                                    <a class="btn btn-success" id="list_pago_btn" style="width: 100%;" href="planilla.php" role="button"> 
                                        <img src="static/iconos/lista_pagos.ico" alt="Exito" width="49" height="49">&nbsp;&nbsp;&nbsp;
                                        <i class="fas fa-long-arrow-right fa-3x"></i>
                                    </a>
                        </div>

                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>

                        <div class="col-md-3 mb-2 float-end">
                                    <button type="button" class="btn btn-primary" 
                                        style="width: 100%; height: 100%;" id="guardar_salario">
                                    <i class="fas fa-save fa-2x"></i> &nbsp;&nbsp;&nbsp;
                
                                    <i class="fas fa-sync fa-spin fa-2x"></i>
                                    </button>
                        </div>
                 </div>

        </form>
    </div>
    <!----------------------------------------------------------->


    <!----------------Tabla de informacion-------------->
    <div class="row my-4 animated fadeIn">
    <div class="container-fluid">

        <div class="col-md-12 container_info_reporte">

            <div class="table-responsive bordes_margen"> 

                <table class='table table-bordered table-sm reporte_venta_tabla' id='reporte_venta_tabla' style="width: 100%;">
                    <thead class="table-secondary">
                    <tr align="center">
                        <th scope="col">Info</th>
                        <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
                        <th scope="col"><i class="fas fa-tags"></i> Neto</th>
                        <th scope="col"><i class="fas fa-tags"></i> Aplicado</th>
                        <th scope="col">Total_Fact</th>
                        <th scope="col">Capital_Vta</th>
                        <th scope="col">Caja</th>
                        <th scope="col">Estado_Vta</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Fecha_Fact</th>

                        <th scope="col">Actiones</th>
                    </tr>
                    </thead>
                    <tbody align="center">

                        <tfoot class="table-secondary">
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

                    <!-----------------------Datos debajo de la tabla------------------------------------>
                    
                        <div class="row">
                              
                            <div class="col-md-3">
                                <!-------------- Input -------------->
                                    <small>Utilidad b generada</small> 
                                    <div class="input-group mb-2">
                                    <span class="input-group-text basic_color_input">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </span>
                                    <input type="text" class="form-control" id="ttl_utili_bru" readonly style="font-weight: bold;">
                                    </div>
                                
                                    <small>% de comisión</small> 
                                    <div class="input-group mb-2">
                                    <span class="input-group-text basic_color_input">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </span>
                                    <select class="form-select select_comisiones" id="select_comisiones" style="font-weight: bold;">
             
                                    </select>
                                    <button type="button" class="btn btn-primary" id="comision_modal"><i class="fas fa-plus"></i></button>
                                    </div>

                            </div>

                            <div class="col-md-3 mb-4">
                                 <!-------------- Input -------------->
                                    <small>Comisión vendedor</small> 
                                    <div class="input-group mb-2">
                                    <span class="input-group-text basic_color_input">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </span>
                                    <input type="text" class="form-control" id="comi_vendedor" readonly style="font-weight: bold;">
                                    </div>

                                    <small>Salario</small>
                                    <div class="input-group mb-2">
                                    <span class="input-group-text basic_color_input">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </span>
                                    <select class="form-select select_salario" style="font-weight: bold;">

                                    </select>
                                    <button type="button" class="btn btn-primary" id="salario_modal"><i class="fas fa-plus"></i></button>
                                    </div>

                            </div>

                            <div class="col-md-3">
                                 <!-------------- card info -------------->
                            <div class="card text-white bg-primary mb-3" style="max-width: 100%;" align="center">
                                <div class="card-header"><h5>Comisión de vendedor</h5></div>
                                    <div class="card-body" style="color:#1D1D1D;">

                                            <h6 class="card-title">Porcentaje <i class="fas fa-sack-dollar"></i></h6>
                                    
                                            <h4>
                                            <i class="fas fa-medal"></i>   
                                            <strong id="tota_salcomi"></strong>   
                                            <i class="fas fa-medal"></i>
                                            </h4>          
                                     
                                    </div>
                            </div>
                            </div>

                            <div class="col-md-3">
                                <!-------------- card info -------------->
                            <div class="card text-white bg-primary mb-3" style="max-width: 100%;"  align="center">
                                <div class="card-header"><h5>Comisión administrativa</h5></div>
                                    <div class="card-body" style="color:#1D1D1D;">

                                            <h6 class="card-title">Porcentaje <i class="fas fa-sack-dollar"></i></h6>

                                            <h4>
                                            <i class="fas fa-medal"></i>   
                                            <strong id="total_admin"></strong>   
                                            <i class="fas fa-medal"></i>
                                            </h4>          

                                    </div>
                            </div>
                            </div>

                        </div>
                    
                    <!----------------------------------------------------------->
        
        </div>

    </div>
    </div>
    <!----------------Tabla de informacion-------------->

</div>
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>

<?php require_once "modales/modal_detalleventa.php"?>
<?php require_once "modales/modal_comisionventa.php"?>
<?php require_once "modales/modal_salario.php"?>


<script src="static/js/admin_venta_vendedor.js"></script>







