<?php require_once "plantilla/parte_superior.html"?>

<?php 
include_once "conexion/conexion_user.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

        $num_factura= "SELECT `id_num_factura` FROM `factura`ORDER BY `id_num_factura` DESC LIMIT 1";
        $numfactura = $conexion->prepare($num_factura);
        $numfactura->execute();

        $numfactura_generar = 0;
        foreach ($numfactura as $row) 
        {
        $numfactura_generar = $row['id_num_factura'];
        }

?>

<link rel="stylesheet" href="static/css/factura_estilo.css"> 
<!----------------------------------------------------------->
<div class="container-fluid">
  

  <!----------------------------------------------------------->
    <div class="row">
      <div class="col-md-8">

        <div class="row">

          <div class="col-md-6">
              <h2>Factura de Productos</h2> 
          </div>

          <div class="col-md-6">
                <div class="group mb-3">
                   <i class="fas fa-search icon"></i>
                   <input placeholder="Buscar producto por nombre" type="search" class="input_buscar" id="busc_produc_nombre">
                </div>
          </div>

        </div>
        
      <div class="alert alert-secondary animated fadeIn" role="alert">

            <div class="row">
              <div class="col-md-8">
                  <small class="form-label">Busqueda</small>
                  <input type="number" class="form-control mb-2" id="buscar_produc" placeholder="Buscar producto">
              </div>
              <div class="col-md-4">
          
              <div class="d-grid gap-2 col-12 mx-auto">
                <button class="btn btn-primary" id="add_product" type="button">Agregar <i class="fa fa-plus" aria-hidden="true"></i></button>
                <a href="javascript:window.open('print_factura.php','','width=800, height=1000, left=580, top=50, toolbar = yes');" class="btn btn-secondary" role="button" aria-disabled="true"><i class="fa fa-print" aria-hidden="true"></i></a>

              </div>

              </div>
            </div>

      </div>
      <!-----------------------Resultado de la busqueda------------------------------------>
      <div class="table-responsive">

          <table class='table responsive-table table-bordered table-sm' id='tabla' name='produc_resul'>
          <thead class="table-secondary">
            <tr align="center">
              <th scope="col">#_Id</th>
              <th scope="col">Cod_Barra</th>
              <th scope="col">Nombre</th>
              <th scope="col">Stock</th>
              <th scope="col">Precio</th>
              <th scope="col">Precio_Total</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Sub_total</th>
              <th scope="col" class="table-danger">Cod_V</th>
              <th scope="col" class="table-danger">Can_V</th>
              <th scope="col" class="table-danger">Opc</th>
            </tr>
          </thead>
          <tbody class="tabla-area" id="tabla_resul_produt" align="center">


          </tbody>
          </table>

      </div>
      <!----------------------Fin de busqueda-------------------------------------> 


  <hr>
  <!----------------------Envio post de factura------------------------------------>
  <form name="form_factura" id="form_factura" method="POST" >
      <div class="alert alert-primary" role="alert">
        <h5>Detalles</h5>
        <hr>


        <div class="table-responsive"> 
        <table class='table responsive-table table-bordered border-primary table-sm' id='tabla' name='produc_resul'>
          <thead class="table-primary">
            <tr align="center">
              <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
              <th scope="col">Cod_Barra</th>
              <th scope="col">Nombre</th>
              <th scope="col">Stock</th>
              <th scope="col">Precio</th>
              <th scope="col">Precio_Total</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Sub_total</th>
              <th scope="col">Cod_V</th>
              <th scope="col">Can_V</th>
              <th scope="col">Borrar</th>
            </tr>
          </thead>
          <tbody id="tabla_clone" align="center">


          </tbody>
          </table>

        </div>


      </div><!--Alert--->
    </div><!--columna--->
      

      
      <div class="col-md-4">

      <div class="alert alert-primary animated fadeIn" role="alert">

            <h5 value>Factura numero: <?php echo $numfactura_generar+1; ?></h5>
            <hr class="hr_class">

            <small class="form-label">Cliente</small>
              <div class="input-group mb-3">
                  <select class="form-select js-example-basic-multiple" style="width: 85%" id="selec_control" name="cliente_fac">
                  </select>
                  <button class="btn btn-info agregar_clien" type="button" style="width: 15%" id="agre_cliente">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </button>
              </div>

              <div id="cal_vuelto">
          
            
                      <small class="form-label">Sub Total factura</small>
                      <input type="number" class="form-control mb-3 total_fac_com" 
                            name="total_fac_com" id="total_fac_com" 
                            placeholder="Sub Total de factura" 
                            readonly required>
                      <hr class="hr_class">
                      <small class="form-label">Aplica descuento</small>
                      <div class="input-group">
                          <select class="form-select decuento_apli" id="decuento_apli" name="decuento_apli" required>

                          </select>   
                          <button class="btn btn-primary" type="button" id="add_por_descuento"><i class="fas fa-plus"></i></button>
                      </div>

                      <small class="form-label">Descuento</small>
                      <input type="number" value="" class="form-control total_fac" 
                            name="total_fac_descuen" id="total_fac" placeholder="Total de factura" 
                            readonly required>
          
                      <hr class="hr_class">
                          <input type="hidden" value="<?php echo $id_usuario; ?>" name="user" readonly>

                      <small class="form-label"><strong>Total Neto:</strong></small>
                      <input type="number" value="" class="form-control total_fac_neto" 
                          name="total_fac_neto" id="total_fac_neto" placeholder="Total Neto:"  
                          readonly required>
                          <br>
              
                  <div class="row">
                      <div class="col-md-7">
                      <input type="number" value="" class="form-control efectivo_fac mb-2" style="width: 100%"
                            name="efectivo_fac" id="efectivo_fac" placeholder="Digita efectivo" 
                            required>

                      </div>
                      <div class="col-md-5">
                      <input type="number" value="" class="form-control vuelto_cliente" style="width: 100%"
                            name="vuelto_cliente" id="vuelto_cliente" placeholder="Vuelto" 
                            required readonly>
                      </div>
                  </div>

                <div class="form-floating">
                  <textarea class="form-control" name="condiciones_fac" placeholder="Condiciones" id="tex_condiciones"></textarea>
                  <label for="tex_condiciones">Condiciones</label>
                </div>

                  <hr class="hr_class">

                  <button type="submit" class="btn btn-primary btn-lg mb-2" style="width: 100%"> 
                    Facturar
                    <i class="fa fa-cog fa-spin fa-fw"></i>
                  </button>
    

                  
              </div>
  <!----------------------Envio post de factura fin--------------------------------->
  </form>
      </div>

      </div>
      
    </div>
 <!----------------------------------------------------------->      
</div>
<!---------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
<?php require_once "modales/modal_cliente.php";?>
<?php require_once "modales/modal_descuento.php";?>


<script src="static/js/factura.js"></script>
  





