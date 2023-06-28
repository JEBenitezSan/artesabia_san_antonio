<?php require_once "plantilla/parte_superior.html"?>

<link rel="stylesheet" href="static/css/elaboracion_estilo.css"> 
<!----------------------------------------------------------->
<form name="form_fabricacion" id="form_fabricacion" >
  <div class="container-fluid animated fadeIn">
    <div class="row">
      
      <!----------------------col-1------------------------------------>
      <div class="col-md-4">
            <div class="alert alert-dark" role="alert" id="cambio_precio">
            
              <small class="form-label">Cliente</small>
              <div class="input-group mb-3">
                  <select class="form-select js-example-basic-multiple" id="selec_control" name="cliente_fac" required>

                  </select>
                    <button class="btn btn-warning btn_oscuro agregar_clien" type="button"  id="agre_cliente">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
              </div>

              <hr>
              <!------------------------------------->
    
              <h3 align="center">Artesano</h3>

              <!------------------------------------->
              <small class="form-label">Artesano</small>
              <div class="input-group mb-3">
                  <select class="form-select" id="com_artesano" name="com_artesano" required>
                        
                  </select>
                    <button class="btn btn-warning btn_oscuro add_artesano" type="button" id="add_artesano">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
              </div>
              <!------------------------------------->
              <small class="form-label">Modelo</small>
              <div class="input-group mb-3">
                  <select class="form-select" id="com_modelo" name="com_modelo" required>
                        
                  </select>
                    <button class="btn btn-warning btn_oscuro add_diseno" type="button" id="add_modelo">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
              </div>
              <!------------------------------------->
              <small class="form-label">Diseño</small>
              <div class="input-group mb-3">
                  <select class="form-select" id="com_diseno" name="com_diseno" required>
                        
                  </select>
                    <button class="btn btn-warning btn_oscuro add_diseno" type="button" id="add_diseno">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
              </div>
              <!------------------------------------->
              <small class="form-label">Costo elaboración</small>
              <div class="input-group mb-3">
                  <select class="form-select" id="com_costoelabora" name="com_costoelabora" required>
                      
                  </select>
                    <button class="btn btn-warning btn_oscuro add_costoelabora" type="button" id="add_costoelabora">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
              </div>
              <!------------------------------------->
              <small>Fecha de finalización</small>
              <div class="input-group mb-3">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  <input type="datetime-local" class="form-control" placeholder="Fecha finalización" id="fecha_finaliza" name="fecha_finaliza">
              </div>
              <!------------------------------------->
              <hr>
              <small class="form-label">Total de materiales</small>
              <div class="input-group mb-3">
                <input type="number" class="form-control" name="total_elaboracion" id="total_elaboracion" placeholder="Total elaboración" required readonly>
                <input type="hidden" class="form-control" name="user" id="user" value="<?php echo $id_usuario; ?>">

                
              </div>

              <small class="form-label">Total mas elaboración</small>
              <div class="input-group mb-3">
                
                <input type="text" class="form-control" name="pre_elab" id="pre_elab" placeholder="Precio elaboración" required readonly>      
              </div>
            </div>
      </div>
      <!-------------------------col-2--------------------------------->
      <div class="col-md-8">
          <h2>Asignacion de materiales</h2>

            <div class="alert alert-secondary" role="alert">
              <div class="row">

                <div class="col-md-8 my-2">
                    <small>Busque de material</small>
                    <input type="text" class="form-control busca_material" name="busca_material" id="busca_material" placeholder="Digita el material">
                </div>

                <div class="col-md-4">

                  <div class="row my-2">
        
                      <button class="btn btn-warning btn-sm btn_oscuro mb-2" type="submit" id="buscar" style="width: 100%; height: 40px;"><i class="fas fa-paper-plane"></i></button>
            
                      <a href="javascript:window.open('print_fabricacion.php','','width=800, height=1000, left=580, top=50, toolbar = yes');" class="btn btn-warning btn_claro" role="button" aria-disabled="true" style="width: 100%"><i class="fa fa-print" aria-hidden="true"></i></a>

              
                  </div>
                  
                    
                </div>
              </div>
            </div>

        <!----------------------------------------------------------->
            <div class="table-responsive"> 
                  <table class='table responsive-table table-sm table-bordered border-warning'
                  id='tabla_material' name='produc_resul' style="background-color: #ffffff;">
                  <thead class="table-warning">
                    <tr align="center">
                      <th scope="col" class="celda_estilo"><i class="fa fa-key" aria-hidden="true"></i></th>
                      <th scope="col" class="tabla_estilo">Codigo</th>
                      <th scope="col" class="tabla_estilo"><i class="fa fa-key" aria-hidden="true"></i></th>
                      <th scope="col" class="tabla_estilo">Tipo Material</th>
                      <th scope="col" class="tabla_estilo">Color</th>
                      <th scope="col" class="tabla_estilo">Precio</th>
                      <th scope="col" class="tabla_estilo">Stock</th>
                      <th scope="col" class="celda_estilo">Cant</th>
                      <th scope="col" class="tabla_estilo">SubTotal</th>
                      <th scope="col" class="tabla_estilo"><i class="fa fa-key" aria-hidden="true"></i></th>
                      <th scope="col" class="tabla_estilo">UndMedi</th>
                      <th scope="col" class="tabla_estilo">Opc</th>
                    </tr>
                  </thead>
                  <tbody id="table_material_exit" align="center">

                  </tbody>
                  </table>
                </div>
        <!----------------------------------------------------------->
              <hr>
        <!----------------------------------------------------------->
          
              <div class="table-responsive"> 
                  <table class='table responsive-table table-sm table-bordered border-warning'
                    id='tabla_clone' name='produc_resul' style="background-color: #ffffff;">
                  <thead class="table-warning">
                    <tr align="center">
                      <th scope="col" class="celda_estilo"><i class="fa fa-key" aria-hidden="true"></i></th>
                      <th scope="col" class="tabla_estilo">Codigo</th>
                      <th scope="col" class="tabla_estilo"><i class="fa fa-key" aria-hidden="true"></i></th>
                      <th scope="col" class="tabla_estilo">Tipo Material</th>
                      <th scope="col" class="tabla_estilo">Color</th>
                      <th scope="col" class="tabla_estilo">Precio</th>
                      <th scope="col" class="tabla_estilo">Stock</th>
                      <th scope="col" class="celda_estilo">Cant</th>
                      <th scope="col" class="tabla_estilo">SubTotal</th>
                      <th scope="col" class="tabla_estilo"><i class="fa fa-key" aria-hidden="true"></i></th>
                      <th scope="col" class="tabla_estilo">UndMedi</th>
                      <th scope="col" class="tabla_estilo">Opc</th>
                    </tr>
                  </thead>
                  <tbody id="producto_existe" align="center">

                  </tbody>
                  </table>
              </div>

      </div>
      <!----------------------------------------------------------->
    </div>
  </div>
</form>
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
<?php require_once "modales/modal_cliente.php";?>

<script src="static/js/elaboracion.js"></script>
  





