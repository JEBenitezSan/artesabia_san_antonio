<div class="modal fade" id="confir_modal_admin" tabindex="-4" aria-labelledby="modal_abrir_cajaLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      
        <div class="modal-header" style="background-color:#c9422a; color: white;">    
        <h5 class="modal-title" id="modal_abrir_cajaLabel">Permisos Administrativo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="actua_caja_admin"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <div class="col-md-12">
  
        <form id="form_confir_admin" method="POST">
              
              <div class="row form-group align-content-center">
              <div class="input-group">
              
                    <div class="col-md-12">
                    
                    <input type="hidden" value="validar_admin" name="opc_valiadmin" readonly>

                      <label class="form-label"><strong>Contraseña ADMIN</strong>&nbsp;<i class="fas fa-shield-alt"></i></label>
                      <div class="input-group mb-3">
                        <input type="password" class="form-control" name="conf_pass_admin" id="conf_pass_admin"
                              placeholder="Digita contraseña administrador" aria-label="Digita contraseña administrador" required>
                      </div>
                      <!----------------------------------------------------->
                    </div>

              </div>
              </div>
              
      </div>
      <!----------------------------------------------------------------------------------------->
      </div>

 
          <button type="submit" class="btn btn-danger" style="background-color:#c9422a">
           <i class="fas fa-shield-alt"></i>
 
          </button>  
      </form>	
     


    </div>
  </div>
</div>


	

						
  