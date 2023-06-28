<div class="modal fade" id="modal_abrir_caja" tabindex="-4" aria-labelledby="modal_abrir_cajaLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      
        <div class="modal-header" style="background-color:#34A2CB">    
        <h5 class="modal-title" id="modal_abrir_cajaLabel">Aperturar Caja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="actua_caja_admin"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <div class="col-md-12">
  
        <form id="form_abrir_caja" method="POST">
              
              <div class="row form-group align-content-center">
              <div class="input-group">
              
                    <div class="col-md-12">
                      <!-----------------------------------------------------> 
                      <input type="hidden" name="usermodal_caja" value="<?php echo $id_usuario;?>" id="usermodal_caja" readonly>
                      <input type="hidden" name="opc_caja" value="abrir_caja" id="opc_caja" readonly>
                      <input type="hidden" name="estado_caja" value="Abierto" id="estado_caja" readonly>

                      <label class="form-label"><strong>Saldo inicial</strong>&nbsp;<i class="fas fa-money-bill"></i></label>
                      <div class="input-group mb-3">
                        <input type="number" class="form-control" name="salgo_inici_caja" id="salgo_inici_caja"
                              placeholder="Saldo inicial para abrir caja" aria-label="Saldo inicial para abrir caja" required>
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


	

						
  