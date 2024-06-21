<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/estilo_reporte_venta.css"> 
<!----------------------------------------------------------->
<div class="container-fluid animated fadeIn">
<h4 align="center">Ventas generales</h4>
<!----------------------------------------------------------->
<div class="alert alert-light alert_reporventa" role="alert">
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
                    <small>Fecha inicial</small>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Tipo Fac</span>

                        <select class="form-select" aria-label="Default select example">
                            <option selected>Elije una opcion</option>
                            <option value="1">Fac Credito</option>
                            <option value="2">Fac Efectivo</option>
                        </select>

                    </div>
                </div>
            
        </div>
</div>
<!----------------------------------------------------------->




<!----------------Tabla de informacion-------------->
<div class="row my-4 animated fadeIn">
<div class="container-fluid">
    <div class="alert alert-light alert_reporventa" role="alert">
        <div class="col-md-12">

            <div class="table-responsive bordes_margen"> 
                <table class='table table-bordered table-hover table-sm' id='reporte_venta_tabla' style="width: 100%;">
                    <thead class=""  style="background-color: #FDCE95;">
                    <tr align="center">
                        <th scope="col">-</th>
                        <th scope="col">Num_Fac</th>
                        <th scope="col">Nombre_Cliente</th>
                        <th scope="col">Total_Fac</th>
                        <th scope="col">Descuento_Fac</th>
                        <th scope="col">Total_Fac_Neto</th>
                        <th scope="col">% Des</th>
                        <th scope="col">User</th>
                        <th scope="col">Print</th>
                    </tr>
                    </thead>
                    <tbody align="center">

                        <tfoot class="" style="background-color: #FDCE95;">
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
</div>
<!----------------Tabla de informacion-------------->


</div>
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
<?php require_once "modales/modal_detalle_facturado.php";?>

<script src="static/js/admin_reporte_venta.js"></script>








