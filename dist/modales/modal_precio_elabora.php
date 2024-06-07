<div class="modal fade" id="modal_precio_elaboracion" tabindex="-4" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
		
      <div class="modal-header"  style="background-color:#AF5C04">
                <h5 class="modal-title" id="exampleModalLabel"> Precio de elaboración de artesania</h5>
    
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_elaboracion">
   
                </button>
      </div>

              <div class="modal-body">

                            <form id="form_pre_elabora" method="POST" autocomplete="off">

                            <div class="col-md-12">
                            <div class="container-fluid">
                            <!----------------------------------------------------->
                            <div class="form-floating mb-3">
                            <input type="text" value="" id="precio_elabo" name="precio_elabo" class="form-control" placeholder="Precio de elaboración" required>
                            <label for="precio_elabo">Precio de elaboración</label>
                            </div>
                        
                            <!----------------------------------------------------->  
                            <div class="form-floating mb-3">
                            <input type="text" value="" id="tipo_moneda" name="tipo_moneda" class="form-control" placeholder="Tipo de moneda" required>
                            <label for="tipo_moneda">Tipo de Moneda</label>
                            </div>

                            <!----------------------------------------------------->  
                            <div class="form-floating mb-3">
                            <input type="text" value="" id="descrip_precio" name="descrip_precio" class="form-control" placeholder="Descripción de agregar nuevo precio" required>
                            <label for="descrip_precio">Descripción de agregar nuevo precio</label>
                            </div>

                            <input type="hidden" name="user_pre_costo" value="<?php echo $id_usuario;?>" id="user_diseno" readonly>
                            <input type="hidden" value="add_precio_elabora" name="opc_combo" readonly >

                            
                
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