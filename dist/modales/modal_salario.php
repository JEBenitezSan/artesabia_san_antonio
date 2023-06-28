<div class="modal fade" id="modal_salario" tabindex="-4" aria-labelledby="modal_salarioLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      
        <div class="modal-header" style="background-color:#c9422a; color: #000000">    
        <h5 class="modal-title" id="modal_salarioLabel">Monto de salario a agregar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="actua_salario"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <div class="col-md-12">
  
        <form id="form_salario" method="POST" autocomplete="OFF">
              
              <div class="row form-group align-content-center">
              <div class="input-group">
              
                    <div class="col-md-12">
                      <!-----------------------------------------------------> 
                      <input type="hidden" name="usermodal_salario" value="<?php echo $id_usuario;?>" id="usermodal_salario" readonly>
                      <input type="hidden" name="opc_repor_vta" value="add_salario" id="opc_repor_vta" readonly>
                        <!----------------------------------------------------->
                      <label class="form-label">Digita el monto de salario&nbsp;<i class="fas fa-money-bill-alt"></i></label>
                      <div class="input-group mb-3">
                        <input type="number" class="form-control" step="any" pattern="[0-9,.]+" name="salario_add" id="salario_add"
                              placeholder="Digita el valor que deseas agregar (numero entero o decimal)" aria-label="Digita el valor que deseas agregar (numero entero o decimal)" required>
                      </div>
                        <!----------------------------------------------------->
                      <label class="form-label">Descripcion del monto de salario&nbsp;<i class="fas fa-newspaper"></i></label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="descrip_salario" id="descrip_salario"
                              placeholder="Descripcion del monto de salario a gregar" aria-label="Descripcion del monto de salario a gregar" required>
                      </div>
                      <!----------------------------------------------------->
                    </div>

              </div>
              </div>
              
      </div>
      <!----------------------------------------------------------------------------------------->
      </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-warning" style="background-color:#c9422a; color: #000000">
          Agregar <i class="far fa-save"></i>
 
          </button>  
      </form>	
      </div>


    </div>
  </div>
</div>


	

						
  