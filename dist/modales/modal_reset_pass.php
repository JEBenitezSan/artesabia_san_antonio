<div class="modal fade" id="modalresetpass" tabindex="-4" aria-labelledby="modalresetpassLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">

        <div class="modal-header show_password_reset">    
        <h5 class="modal-title" id="modalresetpassLabel">Editar datos de usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="actua_laboratorio"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <div class="col-md-12">
  
        <form id="reset_form_pass" method="POST" autocomplete="off">
              
              <div class="row form-group align-content-center">
              <div class="input-group">
              
                    <div class="col-md-12">
                      <!-----------------------------------------------------> 

                      <input type="hidden" name="opc_user" value="reset_pass" id="opc_user" readonly>

                        <!----------------------------------------------------->
                        <div class="mb-3">
                        <small>Id usuario</small>
                        <input type="text" value="" id="id_usuario_reset" name="id_usuario_reset" class="form-control" placeholder="Id de usuario" required readonly>
                        </div>
                        <!--------------------------------------------->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"><i class="fas fa-key"></i></i>&nbsp;Contraseña</label>

                            <div class="input-group">
                            <input type="password" value="" id="cantraseña_reset" name="cantraseña_reset" class="long form-control" placeholder="Contraseña" required>
                            <div class="input-group-append">
                                <button id="show_password_reset" class="btn btn-danger show_password_reset" type="button" onclick="mostrarPassword_reset()"> <span class="fa fa-eye-slash fa-lg icon_reset"></span> </button>
                            </div>
                            </div>

                        </div>
                        <!-----------------------------------------------------> 
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"><i class="fas fa-key"></i>&nbsp;Repite Contraseña </label>

                            <div class="input-group">
                            <input type="password" value="" id="repiter_con_reset" name="repiter_con_reset" class="long form-control" placeholder="Repite Contraseña" required>
                            <div class="input-group-append">
                                <button id="show_password_reset" class="btn btn-danger show_password_reset" type="button" onclick="mostrarPassword_repite_reset()"> <span class="fa fa-eye-slash fa-lg rep_ico_reset"></span> </button>
                            </div>
                            </div>

                        </div>
                        <!----------------------------------------------------->
     
                    </div>

              </div>
              </div>
              
      </div>
      <!----------------------------------------------------------------------------------------->
      </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-danger show_password_reset">
          Restaurar 
          </button>  
      </form>	
      </div>


    </div>
  </div>
</div>


	

						
  