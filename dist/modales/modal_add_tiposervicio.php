<div class="modal fade" id="modal_tiposervi" tabindex="-4" aria-labelledby="modal_tiposerviLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

        <div class="modal-header" style="background-color:#212529; color: #ffffff">    
        <h5 class="modal-title" id="modal_tiposerviLabel">Nuevo Servicio</h5>
        <button type="button" class="btn-close actualiza_tiposervi" data-bs-dismiss="modal" aria-label="Close" id="actualiza_tiposervi"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
        <form id="agregar_for_tiposervi" method="POST" autocomplete="off"> 
            
              <input type="hidden" name="user_modal_tiposervi" value="<?php echo $id_usuario;?>" id="user_modal_tiposervi" readonly>
              <input type="hidden" name="opc_servi" value="add_tipo_servi" id="opc_servi" readonly>
              <!----------------------------------------------------->
              <div class="form-floating mb-3">
                  <input type="text" value="" id="tipo_servicio" name="tipo_servicio" class="form-control" placeholder="Digita nuevo servicio" required>
                  <label for="tipo_servicio">Digita nuevo servicio</label>
              </div>
              <!----------------------------------------------------->
              <div class="form-floating mb-3">
                  <input type="text" value="" id="descrip_tiposervi" name="descrip_tiposervi" class="form-control" placeholder="Descripción de servicio" required>
                  <label for="descrip_tiposervi">Descripción</label>
              </div>
                 
      <!----------------------------------------------------------------------------------------->
      </div>

      <div class="modal-footer" style="background-color:#212529; color: #ffffff">
          <button type="submit" class="btn btn-primary">
          Agregar <i class="far fa-save"></i>
 
          </button>  
      </form>	
      </div>


    </div>
  </div>
</div>


	

						
  