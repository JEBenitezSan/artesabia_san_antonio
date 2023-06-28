<div class="modal fade" id="modal_salida_caja" tabindex="-4" aria-labelledby="modal_salida_cajaLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">

        <div class="modal-header" style="background-color:#c9422a; color:white;">    
        <h5 class="modal-title" id="modal_salida_cajaLabel">Salida o Gastos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="actua_categoriapro"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <div class="col-md-12">
  
        <form id="formsalida_caja" method="POST" autocomplete="off">
              
              <div class="row form-group align-content-center">
              <div class="input-group">
              
                    <div class="col-md-12" id="valsalidainput"> 

                      <!-----------------------------------------------------> 
                      <input type="hidden" name="user_salida_caj" value="<?php echo $id_usuario;?>" id="user_modal_catpro" readonly>
                      
                      <input type="hidden" name="opc_caja" value="salida_caja" id="opc_caja" readonly>
                 
                      <div class="alert alert-danger" role="alert">
                      <small>Utilidad disponible para usar</small>
                      <input type="" class="form-control" id="utilidad_disponible" name="utilidad_disponible" placeholder="Utilidad disponible" required readonly>
                      </div>

                      <div class="form-floating mb-3 my-4">
                      <input type="text" class="form-control" id="gasto_salida" name="gasto_salida" placeholder="Tipo de Salida" required>
                      <label for="gasto_salida">Tipo de Salida</label> 
                      </div>

                      <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="descrip_salida" name="descrip_salida" placeholder="Descripcion" required>
                      <label for="descrip_salida">Descripcion de Salida</label>
                      </div>

                      <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="monto_salida" name="monto_salida" placeholder="Monto de Salida" required>
                      <label for="monto_salida">Monto de Salida</label>
                      </div>
                      <!----------------------------------------------------->
                    </div>

              </div>
              </div>
              
      </div>
      <!----------------------------------------------------------------------------------------->
      </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn_perso_s" style="color:white;">
          Agregar <i class="far fa-save"></i>
 
          </button>  
      </form>	
      </div>


    </div>
  </div>
</div>


	

						
  