<div class="modal fade" id="modal_add_categoria" tabindex="-4" aria-labelledby="modal_add_categoriaLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered  modal-lg">
    <div class="modal-content">

        <div class="modal-header" style="background-color: #DD964C; color: #ffffff;">    
        <h5 class="modal-title" id="modal_add_categoriaLabel">Registrar nueva categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="actua_categoriapro"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <input type="hidden" name="user_modal_catpro" value="<?php echo $id_usuario;?>" id="user_modal_catpro" readonly>
      <input type="hidden" name="opc_catpro" value="add_catpro" id="opc_catpro" readonly>
<!----------------------------------------1------------------------------------------------->
<div id="add1" class="animated fadeIn" style="display: none;">
            <form id="add_form_categoriapro" method="POST">
              <div class="row nimated fadeIn">

                <div class="col-md-5">
                    <!----------------------------------------------------->
                    <small class="form-label md-3">Material nuevo</small>
                    <input type="number" class="form-control" name="cant_product" id="cant_product" placeholder="Digita la cantidad de producto" required>
                    <!----------------------------------------------------->
                </div>
                <div class="col-md-5">
                    <!----------------------------------------------------->
                    <small class="form-label md-3">Descripcion</small>
                    <input type="number" class="form-control" name="cant_product" id="cant_product" placeholder="Digita la cantidad de producto" required>
                    <!----------------------------------------------------->
                </div>
                <div class="col-md-2">
                    <!----------------------------------------------------->
                    <button type="submit" class="btn btn-warning btn_claro my-4" style="width: 100%;">
                       <i class="far fa-save fa-lg"></i>
                    </button>  
                    <!----------------------------------------------------->
                </div>

              </div>
            </form>
</div>	
<!-----------------------------------------2------------------------------------------------>
<div id="add2" class=" animated fadeIn" style="display: none;">

<form id="add_form_categoriapro" method="POST">
              <div class="row nimated fadeIn">

                <div class="col-md-5">
                    <!----------------------------------------------------->
                    <small class="form-label md-3">Unidad de medida nueva</small>
                    <input type="number" class="form-control" name="cant_product" id="cant_product" placeholder="Digita la cantidad de producto" required>
                    <!----------------------------------------------------->
                </div>
                <div class="col-md-5">
                    <!----------------------------------------------------->
                    <small class="form-label md-3">Descripcion</small>
                    <input type="number" class="form-control" name="cant_product" id="cant_product" placeholder="Digita la cantidad de producto" required>
                    <!----------------------------------------------------->
                </div>
                <div class="col-md-2">
                    <!----------------------------------------------------->
                    <button type="submit" class="btn btn-warning btn_claro my-4" style="width: 100%;">
                       <i class="far fa-save fa-lg"></i>
                    </button>  
                    <!----------------------------------------------------->
                </div>

              </div>
            </form>	
</div>
<!--------------------------------------3--------------------------------------------------->
<div id="add3" class="animated fadeIn" style="display: none;">
<form id="add_form_categoriapro" method="POST">
              <div class="row nimated fadeIn">

                <div class="col-md-5">
                    <!----------------------------------------------------->
                    <small class="form-label md-3">Nuevo precio</small>
                    <input type="number" class="form-control" name="cant_product" id="cant_product" placeholder="Digita la cantidad de producto" required>
                    <!----------------------------------------------------->
                </div>
                <div class="col-md-5">
                    <!----------------------------------------------------->
                    <small class="form-label md-3">Moneda</small>
                    <input type="number" class="form-control" name="cant_product" id="cant_product" placeholder="Digita la cantidad de producto" required>
                    <!----------------------------------------------------->
                </div>
                <div class="col-md-2">
                    <!----------------------------------------------------->
                    <button type="submit" class="btn btn-warning btn_claro my-4" style="width: 100%;">
                       <i class="far fa-save fa-lg"></i>
                    </button>  
                    <!----------------------------------------------------->
                </div>

              </div>
            </form>	
</div>
<!----------------------------------------------------------------------------------------->
      </div>

      <div class="modal-footer" style="background-color: #DD964C; color: #ffffff;">
            
      </div>


    </div>
  </div>
</div>


	

						
  