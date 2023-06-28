<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/planilla_estilo.css"> 
<!---------------------------------------------------------->
<h3 align="center">Planilla</h3>
<div class="container-fluid">
    <!----------------------------------------------------------->
    <div class="alert alert-success container_box_plan animated fadeIn" role="alert">

        <input type="hidden" name="user_planilla" value="<?php echo $id_usuario;?>" id="user_planilla" class="form-control" readonly>

        <form id="form_filtro_planilla">

                <div class="row container_input" id="fecha_repor_plan">
                
                        <div class="col-md-4">
                        <small>Fecha Salario</small>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                <input type="datetime-local" class="form-control" placeholder="Fecha final" id="fecha_plani" name="fecha_plani">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <small>Empleado</small>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-users-cog"></i></span>

                                <select class="form-select select_vendedor">
                
                                </select>

                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                                    <a class="btn btn-success" id="list_pago_btn" style="width: 100%; height: 100%;" href="reporte_ventas_vendedor.php" role="button"> 
                                        <!-- <img src="static/iconos/lista_pagos.ico" alt="Exito" width="49" height="49"> -->
                                        <i class="fas fa-arrow-left fa-lg"></i> <h5>Regresar a comisiones</h5>
                                    </a>
                        </div>
                    
                </div>

        </form>
    </div>
    <!----------------------------------------------------------->
<br>
        <div class="table-responsive animated fadeIn"> 
            <table class='table table-bordered table-sm' id='tabla_planilla' style="width: 100%; background-color: #ffffff;">
                <thead class="table-success">
                <tr align="center">
                    <th></th>
                    <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre y apellido</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">%_<i class="fas fa-chart-line"></i></th>
                    <th scope="col">Id_Sala</th>
                    <th scope="col">Salario</th>
                    <th scope="col">T_Comisión</th>
                    <th scope="col">Total_Salario</th>
                    <th scope="col">Fecha_Pago</th>
                    <th scope="col">Fecha_Inicial</th>
                    <th scope="col">Fecha_Final</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Actiones</th>
                </tr>
                </thead>
                <tbody align="center">

                    <tfoot class="table-success">
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
                          <th></th>
                        </tr>
                    </tfoot>
                </tbody>
            </table>
        </div>

</div>

<!---------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
<?php require_once "modales/modal_listedit_comisiones.php";?>

<?php require_once "modales/modal_comisionventa.php"?>
<?php require_once "modales/modal_salario.php"?>
<?php require_once "modales/modal_detalleventa.php"?>

<script src="static/js/admin_planilla.js"></script>



