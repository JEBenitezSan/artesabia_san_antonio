<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/inventario_estilo.css"> 
<!----------------------------------------------------------->

<div class="container-fluid animated fadeIn">

<div class="row justify-content-center">


<div class="col-md-5">
<div class="alert alert-primary figura">
      <h2 align="center">Inventario &nbsp;<img src="static/iconos/inventario.ico" alt="Exito" width="42" height="42"></h2>
</div>
</div>


<div class="table-responsive my-3"> 
      <table class='table table-bordered table-hover table-sm' id='stock_productos' style="width: 100%;">
        <thead class="table-primary">
          <tr align="center">
            <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
            <th scope="col">Cod_Barra</th>
            <th scope="col">Nombre</th>
            <th scope="col">Cant_Pro</th>
            <th scope="col">P_Venta</th>
            <th scope="col">G_Total_B</th>
            <th scope="col">P_Compra</th>
            <th scope="col">G_Total_C</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Tipo_Pro</th>
            <th scope="col">%_Utili</th>
            <th scope="col">G_Total_U</th>
            <th scope="col">Acciones</th>
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
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
<script src="static/js/admin_inventario.js"></script>





