<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/caja_reporte_venta.css"> 
<!----------------------------------------------------------->
<div class="container-fluid animated fadeIn">
<h4 align="center">Ventas generales</h4>
<!----------------------------------------------------------->
<div class="alert alert-light container_box" role="alert">
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
    <div class="col-md-12 container_info_reporte">

    <div class="table-responsive bordes_margen"> 
      <table class='table table-bordered table-hover table-sm' id='reporte_venta_tabla' style="width: 100%;">
        <thead class="table-primary">
          <tr align="center">
            <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
            <th scope="col">Cod_Barra</th>
            <th scope="col">Nombre</th>
            <th scope="col"><i class="fas fa-tags"></i> Neto</th>
            <th scope="col"><i class="fas fa-tags"></i> Aplicado</th>
            <th scope="col">P_Venta</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Sub_Total</th>
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
</div>
<!----------------Tabla de informacion-------------->


</div>
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>

<script src="static/js/admin_reporte_venta.js"></script>







