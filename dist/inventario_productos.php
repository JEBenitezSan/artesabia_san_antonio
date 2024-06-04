<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/inventario_estilo.css"> 
<!----------------------------------------------------------->
<div class="container-fluid animated fadeIn">

    <div class="row justify-content-center">
      <div class="container-fluid animated fadeIn">
        <div class="alert alert-warning" style="background-color: #FDCE95;">
          <div class="row">
            <div class="col-md-6 col-lg-4 col-12">
              <h2 align="center">Inventario &nbsp;<img src="static/iconos/inventario.ico" alt="Exito" width="42" height="42"></h2>
            </div>

            <div class="col-md-6 col-lg-4 col-12">
                <button type="button" class="btn btn-warning btn_claro add_new_producto my-3" style="height: 50px; width: 100%; border-radius: 25px;">Nuevo Producto <i class="fas fa-cart-plus"></i></button>
            </div>
            
            <div class="col-md-12 col-lg-4 col-12">
                  <form name="form_codbarra" id="form_codbarra" method="post" action="cod_barra_producto.php">
                    <small class="form-label">Codigo de producto</small>
                    <div class="input-group mb-3" style="width: 100%;">
                      <input type="text" name="cod_barra" id="cod_barra" class="form-control" placeholder="Generar código de barra" required> 
                      <button class="btn btn-warning btn_oscuro" type="submit" id="add_proveedor"><i class="fas fa-paper-plane"></i></button>
                    </div>
                  </form>
              </div>
            

          </div>
        </div>
      </div>

      <div class="container-fluid animated fadeIn">
        <div class="alert alert-light alert_productos">
          <div class="table-responsive my-3"> 
                <table class='table table-bordered table-hover table-sm' id='stock_productos' style="width: 100%;">
                  <thead style="background-color: #FDCE95;">
                    <tr align="center">
                      <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
                      <th scope="col">Cod_barra</th>
                      <th scope="col">Producto</th>
                      <th scope="col">Tipo</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Precio_VTA</th>
                      <th scope="col">Sub_Total</th>
                      <th scope="col">P_Compra</th>
                      <th scope="col">%_Utili</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Usuario</th>
                      <th scope="col">OPC</th>
                    </tr>
                  </thead>
                  <tbody align="center">

                      <tfoot style="background-color: #FDCE95;">
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
  
</div>
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
<script src="static/js/admin_inventario.js"></script>
<?php require_once "modales/modal_editar_stock.php";?>
<?php require_once "modales/modal_add_producto.php";?>






