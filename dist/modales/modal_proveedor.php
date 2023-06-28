<div class="modal fade" id="modal_add_proveedor" tabindex="-4" aria-labelledby="modal_add_proveedorLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">

        <div class="modal-header" style="background-color:#0dcaf0">    
        <h5 class="modal-title" id="modal_add_proveedorLabel">Registrar proveedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="actua_modal_proveedor"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <div class="col-md-12">
  
        <form id="add_form_proveedor" method="POST">
              
              <div class="row form-group align-content-center">
              <div class="input-group">
              
                    <div class="col-md-12">
                      <!-----------------------------------------------------> 
                      <input type="hidden" name="user_modal_proveedor" value="<?php echo $id_usuario;?>" id="user_modal_pordescuent" readonly>
                      <input type="hidden" name="opc_provee" value="add_proveedor" id="opc_provee" readonly> 

                      <div class="form-floating mb-3">
                        <input type="text" value="" id="nom_proveedor" name="nom_proveedor" class="form-control" placeholder="Nombre de proveedor" required>
                        <label for="nom_proveedor">Nombre de proveedor</label>
                      </div>
                    <!----------------------------------------------------->
                      <div class="form-floating mb-3">
                          <input type="text" value="" id="ruc_proveedor" name="ruc_proveedor" class="form-control" placeholder="Ruc de proveedor" required>
                          <label for="ruc_proveedor">Ruc de proveedor</label>
                      </div>
                      <!----------------------------------------------------->
                      <div class="form-floating mb-3">
                          <input type="text" value="" id="tele_proveedor" name="tele_proveedor" class="form-control" placeholder="Telefono del proveedor" required>
                          <label for="tele_proveedor">Telefono del proveedor</label>
                      </div>
                      <!----------------------------------------------------->
                      <div class="form-floating mb-3">
                          <input type="text" value="" id="direc_proveedor" name="direc_proveedor" class="form-control" placeholder="Direccion proveedor" required>
                          <label for="direc_proveedor">Dirección proveedor</label>
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


	

						
  