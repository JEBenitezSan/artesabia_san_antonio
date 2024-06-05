<div class="modal fade" id="Modal_Cliente" tabindex="-4" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
		
      <div class="modal-header"  style="background-color:#AF5C04">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
    
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_cliente">
   
                </button>
      </div>

	 <div class="modal-body">

                <form id="form_cliente" method="POST" autocomplete="off">

                <div class="col-md-12">
                <div class="container-fluid">
                <!----------------------------------------------------->
                <div class="form-floating mb-3">
                <input type="text" value="" id="nom_cliente" name="nom_cliente" class="form-control" placeholder="Nombre del Cliente" required>
                <label for="nom_cliente">Nombre Cliente</label>
                </div>
            
                <!----------------------------------------------------->  
                <div class="form-floating mb-3">
                <input type="text" value="" id="ape_cliente" name="ape_cliente" class="form-control" placeholder="Apellido del Cliente" required>
                <label for="ape_cliente">Apellido Cliente</label>
                </div>
                <input type="hidden" name="user" value="<?php echo $id_usuario;?>" id="user" readonly>
                <input type="hidden" value="add" name="opc_client" readonly >

                <!----------------------------------------------------->
                <div class="form-floating mb-3">
                <input type="text" value="" id="cedu_cli" name="cedu_cli" class="form-control" placeholder="Cedula del Cliente">
                <label for="cedu_cli">Cedula de identidad </label>
                </div>

                <!----------------------------------------------------->
                <div class="form-floating mb-3">
                <select id="sexo_cliente" name="sexo_cliente" class="form-select" aria-label="Floating label select example">
                        <option value="">Elige una opcion</option>
                        <option value="Masculino">Masculino</option> 
                        <option value="Femenino">Femenino</option>   
                </select>
                <label for="sexo_cliente">Sexo de cliente</label>
                </div>
                <!----------------------------------------------------->
                <div class="form-floating mb-3">
                <input type="number" value="" id="num_clien" name="num_clien" class="form-control" placeholder="Numero del Cliente">
                <label for="num_clien">Numero Telefónico</label>
                </div>

                <button type="submit" id="btn_clientes_new" class="cliente_lis btn btn-warning btn_claro">Guardar <i class="far fa-save"></i></button>
                <!----------------------------------------------------->

                </div>
                </div>


               
   </div>
                <button type="button" id="btn_editar_cliente" class="btn btn-outline-warning btn_claro btn-sm" style='display: none;'>Editar <i class="far fa-edit"></i></button>
                </form>	

  							
 	
    </div>			
  </div>	
 </div>			
 
<!------------------------------------------------------>