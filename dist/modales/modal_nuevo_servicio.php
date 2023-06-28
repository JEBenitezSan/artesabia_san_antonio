<div class="modal fade" id="modal_nuevo_servicio" tabindex="-4" aria-labelledby="modal_nuevo_servicioLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg">
    <div class="modal-content">

        <div class="modal-header" style="background-color:#0275d8; color: #ffffff">    
        <h5 class="modal-title" id="modal_nuevo_servicioLabel">Registrar nuevo % de Descuento</h5>
        <button type="button" class="btn-close actualiza_servicio" data-bs-dismiss="modal" aria-label="Close" id="actualiza_servicio"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
        <form id="agregar_form_servicio" method="POST" autocomplete="off"> 
              
                  <div class="row">
                      <div class="col-md-6">
                              <!-----------------------------------------------------> 
                              <input type="hidden" name="user_modal_servicio" value="<?php echo $id_usuario;?>" id="user_modal_servicio" readonly>
                              <input type="hidden" name="opc_servi" value="ingre_servi" id="opc_servi" readonly>

                              <div class="input-group form-floating mb-3">
                                     
                                    <select class="form-select selec_tipo_servi" id="selectiposervi" name="selec_tipo_servi" aria-label="Floating label select example" required>
                              

                                    </select>
                                    <label for="selec_tipo_servi">Selecciona tipo</label>
                                    <button type="button" class="btn btn-primary" id="add_tiposervi"><i class="fas fa-plus"></i></button>
                            </div>
                            <!----------------------------------------------------->
                              <div class="form-floating mb-3">
                                  <input type="text" value="" id="observaciones" name="observaciones" class="form-control" placeholder="Observaciones" required>
                                  <label for="observaciones">Observaciones</label>
                              </div>
                              <!----------------------------------------------------->
                              <div class="form-floating mb-3">
                                  <input type="date" value="" id="fecha_entrega" name="fecha_entrega" class="form-control" placeholder="Fecha de entrega" required>
                                  <label for="fecha_entrega">Fecha de entrega</label>
                              </div>
                              <!----------------------------------------------------->
                      </div>

                      <div class="col-md-6" id="tol_servicio">
                                <!-----------------------------------------------------> 
                                <div class="form-floating mb-3">
                                  <input type="text" value="" id="precio_inversion" name="precio_inversion" class="form-control" placeholder="Precio de inversión" required>
                                  <label for="precio_inversion">Precio de inversión</label>
                                </div>
                              <!----------------------------------------------------->
                                <div class="form-floating mb-3">
                                    <input type="text" value="" id="precio_servicio" name="precio_servicio" class="form-control" placeholder="Precio de Servicio" required>
                                    <label for="precio_servicio">Precio de Servicio</label>
                                </div>
                                <!----------------------------------------------------->
                                <div class="form-floating mb-3">
                                    <input type="text" value="" id="precio_total" name="precio_total" class="form-control" placeholder="Precio Total" required>
                                    <label for="precio_total">Precio Total</label>
                                </div>
                                <!----------------------------------------------------->
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


	

						
  