<div class="modal fade" id="modal_abrir_comision" tabindex="-4" aria-labelledby="modal_abrir_comisionLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      
        <div class="modal-header" style="background-color:#0275d8; color: #ffffff">    
        <h5 class="modal-title" id="modal_abrir_comisionLabel">Monto de comisión a agregar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="actua_comision"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <div class="col-md-12">
  
        <form id="form_comision" method="POST" autocomplete="OFF">
              
              <div class="row form-group align-content-center">
              <div class="input-group">
              
                    <div class="col-md-12">
                      <!-----------------------------------------------------> 
                      <input type="hidden" name="usermodal_comision" value="<?php echo $id_usuario;?>" id="usermodal_comision" readonly>
                      <input type="hidden" name="opc_repor_vta" value="add_comision" id="opc_repor_vta" readonly>
                        <!----------------------------------------------------->
                      <label class="form-label">Digita el valor (numero entero o decimal)&nbsp;<i class="fas fa-sort-numeric-up"></i></label>
                      <div class="input-group mb-3">
                        <input type="number" class="form-control" step="any" pattern="[0-9,.]+" name="comision_add" id="comision_add"
                              placeholder="Digita el valor que deseas agregar (numero entero o decimal)" aria-label="Digita el valor que deseas agregar (numero entero o decimal)" required>
                      </div>
                        <!----------------------------------------------------->
                      <label class="form-label">Descripcion de comisión a agregar&nbsp;<i class="fas fa-newspaper"></i></label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="descrip_comision" id="descrip_comision"
                              placeholder="Descripcion de comisión a gregar" aria-label="Descripcion de comision a gregar" required>
                      </div>
                      <!----------------------------------------------------->
                    </div>

              </div>
              </div>
              
      </div>
      <!----------------------------------------------------------------------------------------->
      </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
          Agregar <i class="far fa-save"></i>
 
          </button>  
      </form>	
      </div>


    </div>
  </div>
</div>


	

						
  