<div class="modal fade" id="modal_artesano" tabindex="-4" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
		
      <div class="modal-header"  style="background-color:#AF5C04">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Artesano</h5>
    
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_artesano">
   
                </button>
      </div>

                <div class="modal-body">

                              <form id="form_artesano" method="POST" autocomplete="off">

                              <div class="col-md-12">
                              <div class="container-fluid">
                              <!----------------------------------------------------->
                              <div class="form-floating mb-3">
                              <input type="text" value="" id="nom_artesano" name="nom_artesano" class="form-control" placeholder="Nombre del Artesano" required>
                              <label for="nom_artesano">Nombre Artesano</label>
                              </div>
                          
                              <!----------------------------------------------------->  
                              <div class="form-floating mb-3">
                              <input type="text" value="" id="apell_artesano" name="apell_artesano" class="form-control" placeholder="Apellido del Artesano" required>
                              <label for="apell_artesano">Apellido Artesano</label>
                              </div>
                              <input type="hidden" name="user_artesano" value="<?php echo $id_usuario;?>" id="user_artesano" readonly>
                              <input type="hidden" value="add_artesano" name="opc_combo" readonly >

                              <!----------------------------------------------------->
                              <div class="form-floating mb-3">
                              <input type="text" value="" id="cedu_artesano" name="cedu_artesano" class="form-control" placeholder="Cedula del Artesano">
                              <label for="cedu_artesano">Cedula de identidad </label>
                              </div>
                              <!----------------------------------------------------->
                              <div class="form-floating mb-3">
                              <input type="number" value="" id="num_artesano" name="num_artesano" class="form-control" placeholder="Numero del Artesano">
                              <label for="num_artesano">Numero Telefónico</label>
                              </div>
                              <!----------------------------------------------------->
                              <div class="form-floating mb-3">
                              <select id="sexo_artesano" name="sexo_artesano" class="form-select" aria-label="Floating label select example">
                                      <option value="">Elige una opcion</option>
                                      <option value="Masculino">Masculino</option> 
                                      <option value="Femenino">Femenino</option>   
                              </select>
                              <label for="sexo_artesano">Sexo de Artesano</label>
                              </div>
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