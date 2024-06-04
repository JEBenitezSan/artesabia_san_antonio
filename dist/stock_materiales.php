<?php require_once "plantilla/parte_superior.html"?>
<!----------------------------------------------------------->
<div class="container-fluid animated fadeIn">

<div class="alert alert-secondary">
   <form name="form_codbarra" id="form_codbarra" method="post" action="cod_barra.php">
      <div class="row">

          <div class="col-md-5">
                <h2 align="center">Stock Materiales &nbsp;&nbsp;<img src="static/iconos/stock.ico" alt="Exito" width="52" height="52"></h2>
          </div>
       
              <div class="col-md-4">
                  <small class="form-label">Codigo de producto</small>
                  <div class="input-group mb-3">
                    <input type="text" name="cod_barra" id="cod_barra" class="form-control" 
                                        placeholder="Generar código de barra" aria-label="Generar código de barra" required> 
                    <button class="btn btn-warning btn_oscuro" type="submit" id="add_proveedor"><i class="fas fa-paper-plane"></i></button>
                  </div>

              </div>
       
          
      </div>
   </form>
</div>

<div class="table-responsive my-2"> 
      <table class='table table-bordered table-hover table-sm' id='stock_productos' style="width: 100%;">
        <thead class="table-warning">
          <tr align="center">
            <th scope="col" class="tabla_estilo"><i class="fa fa-key" aria-hidden="true"></i></th>
            <th scope="col" class="tabla_estilo">Cod_Barra</th>
            <th scope="col" class="tabla_estilo">Tipo Material</th>
            <th scope="col" class="tabla_estilo">Color</th>
            <th scope="col" class="tabla_estilo">Cantidad</th>
            <th scope="col" class="tabla_estilo">Medidas</th>
            <th scope="col" class="tabla_estilo">Precio</th>
            <th scope="col" class="tabla_estilo">Totales</th>
            <th scope="col" class="tabla_estilo">Acciones</th>
          </tr>
        </thead>
        <tbody align="center">

            <tfoot class="table-warning">
                <tr align="center">
                <th class="tabla_estilo"></th>
                <th class="tabla_estilo"></th>
                <th class="tabla_estilo"></th>
                <th class="tabla_estilo"></th>
                <th class="tabla_estilo"></th>
                <th class="tabla_estilo"></th>
                <th class="tabla_estilo"></th>
                <th class="tabla_estilo"></th>
                <th class="tabla_estilo"></th>
                </tr>
            </tfoot>
        </tbody>
      </table>
</div>

</div>

<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>

<script src="static/js/admin_stockmaterial.js"></script>





