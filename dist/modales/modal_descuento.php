<div class="modal fade" id="modal_add_porcdescuento" tabindex="-4" aria-labelledby="modal_add_porcdescuentoLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">

        <div class="modal-header" style="background-color:#0dcaf0">    
        <h5 class="modal-title" id="modal_add_porcdescuentoLabel">Registrar nuevo % de Descuento</h5>
        <button type="button" class="btn-close actua_porcedescuento" data-bs-dismiss="modal" aria-label="Close" id="actua_porcedescuento"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <div class="col-md-12">
  
        <form id="add_form_porcendescuento" method="POST">
              
              <div class="row form-group align-content-center">
              <div class="input-group">
              
                    <div class="col-md-12">
                      <!-----------------------------------------------------> 
                      <input type="hidden" name="user_modal_pordescuent" value="<?php echo $id_usuario;?>" id="user_modal_pordescuent" readonly>
                      <input type="hidden" name="opc_porcen" value="add_porcen" id="opc_porcen" readonly>

                      <div class="form-floating mb-3">
                        <input type="text" value="" id="id_cant_porcen_des" name="id_cant_porcen_des" class="form-control" placeholder="Agrega % de descuento nueva" required>
                        <label for="id_cant_porcen_des">Agrega % de descuento nueva</label>
                      </div>
                    <!----------------------------------------------------->
                      <div class="form-floating mb-3">
                          <input type="text" value="" id="descrip_porcen_desc" name="descrip_porcen_desc" class="form-control" placeholder="Descripcion del % de descuento" required>
                          <label for="descrip_porcen_desc">Descripcion del % de descuento</label>
                      </div>
                      <!----------------------------------------------------->
                    </div>

              </div>
              </div>
              
      </div>
      <!----------------------------------------------------------------------------------------->
      </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-info">
          Agregar <i class="far fa-save"></i>
 
          </button>  
      </form>	
      </div>


    </div>
  </div>
</div>


	

						
  