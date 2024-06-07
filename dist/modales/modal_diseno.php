<div class="modal fade" id="modal_diseno" tabindex="-4" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
		
      <div class="modal-header"  style="background-color:#AF5C04">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Diseño</h5>
    
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_diseno">
   
                </button>
      </div>

              <div class="modal-body">

                            <form id="form_diseno" method="POST" autocomplete="off">

                            <div class="col-md-12">
                            <div class="container-fluid">
                            <!----------------------------------------------------->
                            <div class="form-floating mb-3">
                            <input type="text" value="" id="diseno" name="diseno" class="form-control" placeholder="Nombre del diseño de artesania" required>
                            <label for="diseno">Nombre De Diseño</label>
                            </div>
                        
                            <!----------------------------------------------------->  
                            <div class="form-floating mb-3">
                            <input type="text" value="" id="descrip_diseno" name="descrip_diseno" class="form-control" placeholder="Apellido del Artesano" required>
                            <label for="descrip_diseno">Descripción de diseño</label>
                            </div>
                            <input type="hidden" name="user_diseno" value="<?php echo $id_usuario;?>" id="user_diseno" readonly>
                            <input type="hidden" value="add_diseno" name="opc_combo" readonly >

                            
                
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