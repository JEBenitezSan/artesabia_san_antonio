<div class="modal fade" id="modalediuser" tabindex="-4" aria-labelledby="modalediuserLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">

        <div class="modal-header" style="background-color:#4a92df">    
        <h5 class="modal-title" id="modalediuserLabel">Editar datos de usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="actua_laboratorio"></button>
      </div>

      <div class="modal-body">
      <!---------------------------------------------------------------->
      <div class="col-md-12">
  
        <form id="edit_form_user" method="POST" autocomplete="off">
              
              <div class="row form-group align-content-center">
              <div class="input-group">
              
                    <div class="col-md-12">
                      <!-----------------------------------------------------> 

                      <input type="hidden" name="opc_user" value="editar_user" id="opc_user" readonly>

                        <!----------------------------------------------------->
                        <div class="mb-3">
                        <small>Id usuario</small>
                        <input type="text" value="" id="id_usuarioedi" name="id_usuarioedi" class="form-control" placeholder="Id de usuario" required readonly>
                        </div>
                        <!----------------------------------------------------->
                        <div class="mb-3">
                        <small>Usuario de sesión</small>
                        <input type="text" value="" id="user_sesion" name="user_sesion" class="form-control" placeholder="Usuario de inicio de sesión" required>
                        </div>
                        <!----------------------------------------------------->
                        <div class="mb-3">
                        <small>Tipo de usuario <i class="fas fa-user-shield"></i></small>
                        <input type="text" value="" id="tipousuario" name="" class="form-control" placeholder="" readonly>
                           <select class="tipo_user_edit custom-select my-2" id="tipo_user_edit" name="tipo_user_edit" required>
                                <option value="">Elige permiso de User</opcion>  
                                <option value="Admin">Administrador</opcion>
                                <option value="User">Usuario</opcion>
                           </select>
                        </div>
                        <!----------------------------------------------------->
                        <div class="mb-3">
                        <small>Estado</small>
                        <input type="text" value="" id="estadousuario" name="" class="form-control" placeholder="" readonly>
                          <select class="estado_user custom-select my-2" id="estado_user" name="estado_user" required>
                                <option value="">Cambia el esatdo de usuario</opcion>  
                                <option value="Activo">Activo</opcion>
                                <option value="Inactivo">Inactivo</opcion>
                           </select>
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


	

						
  