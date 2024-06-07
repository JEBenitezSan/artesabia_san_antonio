<div class="modal fade" id="modal_modelo" tabindex="-4" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
		
      <div class="modal-header"  style="background-color:#AF5C04">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Artesano</h5>
    
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modelo">
   
                </button>
      </div>

              <div class="modal-body">

                            <form id="form_modelo" method="POST" autocomplete="off">

                            <div class="col-md-12">
                            <div class="container-fluid">
                            <!----------------------------------------------------->
                            <div class="form-floating mb-3">
                            <input type="text" value="" id="modelo" name="modelo" class="form-control" placeholder="Nombre de modelo de artesania" required>
                            <label for="modelo">Nombre De Modelo</label>
                            </div>
                        
                            <!----------------------------------------------------->  
                            <div class="form-floating mb-3">
                            <input type="text" value="" id="descrip_modelo" name="descrip_modelo" class="form-control" placeholder="Apellido del Artesano" required>
                            <label for="descrip_modelo">Descripción de modelo</label>
                            </div>
                            <input type="hidden" name="user_modelo" value="<?php echo $id_usuario;?>" id="user_artesano" readonly>
                            <input type="hidden" value="add_modelo" name="opc_combo" readonly >

                            
                
                            <!----------------------------------------------------->
                            <div align="right">
                            <button type="submit" id="btn_clientes_new" class="cliente_lis btn btn-warning btn_claro">Guardar <i class="far fa-save"></i></button>
                            </div>
                            <!----------------------------------------------------->

                            </div>
                            </div>


                          
              </div>
               </form>	

  							
 	
    </div>			
  </div>	
 </div>			
 
<!------------------------------------------------------>