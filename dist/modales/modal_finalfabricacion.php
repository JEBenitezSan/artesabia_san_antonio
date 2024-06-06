<div class="modal fade" id="modal_final_fabricacion" tabindex="-1" aria-labelledby="exampleCerrarCaja" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header" style="background-color: #c8711f; color:white"> 	
        <h5 class="modal-title" id="exampleCerrarCaja" >Cerrar Caja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="form_fabrica_final" autocomplete="off">
        <div class="modal-body">
          <div class="row">
              <div class="col-md-6">
                  <!-----------------------------------------------------> 
                  <div class="mb-2">
                      <small>ID</small>
                      <input type="text" value="" id="id_fabricacion" name="id_fabricacion" class="form-control" placeholder="Id fabricación" required readonly>
                  </div>
                  <!-----------------------------------------------------> 
                  <small>Cliente</small>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                      <input type="text" value="" id="cliente_f" name="cliente_f" class="form-control" placeholder="Nombre cliente" required readonly>
                  </div>
                  <!----------------------------------------------------->
                  <div class="mb-2">
                      <small>Artesano</small>
                      <input type="text" value="" id="artesano" name="artesano" class="form-control" placeholder="Artesano elaboración" required readonly>
                  </div>
                  <!-----------------------------------------------------> 
                  <div class="mb-2">
                      <small>Modelo</small>
                      <input type="text" value="" id="nombre_modelo" name="nombre_modelo" class="form-control" placeholder="Modelo" required readonly>
                  </div>
                  <!-----------------------------------------------------> 
                  <div class="mb-2">
                      <small>Diseño</small>
                      <input type="text" value="" id="nombre_diseno" name="nombre_diseno" class="form-control" placeholder="Diseño" required readonly>
                  </div>
                  <!----------------------------------------------------->
              </div>
              <div class="col-md-6">
                  <!-----------------------------------------------------> 
                  <div class="mb-2">
                      <small>Total inversión</small>
                      <input type="text" value="" id="total" name="total" class="form-control" placeholder="Total de inversión" required readonly>
                  </div>
                  <!-----------------------------------------------------> 
                  <small>Porcentaje de ganancia</small>
                  <div class="input-group mb-2">
                      <input type="text" value="" id="porcen_ganancia" name="porcen_ganancia" class="form-control" placeholder="Digite el porcentaje de ganacia" required onkeyup="ganancia_porcen();">
                      <span class="input-group-text"><i class="fas fa-percentage"></i></span> 
                    </div>
                  <!-----------------------------------------------------> 
                  <small>Total Venta</small>
                  <div class="input-group mb-2">
                      <input type="text" value="" id="total_neto" name="total_neto" class="form-control" placeholder="Total neto de venta" required onkeyup="obtener_porcen();">
                      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span> 
                    </div>
                  <!----------------------------------------------------->
                  <small class="form-label">Tipo de producto</small>
                  <div class="input-group mb-3">
                      <select class="form-select tipo_producto" id="tipo_producto" name="tipo_producto">
                      </select>
                  </div>
                  <!----------------------------------------------------->
                  <small>Código Barra</small>
                  <div class="input-group mb-2">
                      <input type="text" value="" id="cod_barra_gene" name="cod_barra_gene" class="form-control" placeholder="Codigo de barra" readonly>
                      <span class="input-group-text"><i class="fas fa-barcode"></i></span> 
                    </div>
                  <!----------------------------------------------------->
              </div>
          </div>


        </div>
        <input type="hidden" name="user_regsitro_proceso" value="<?php echo $id_usuario;?>" id="user_regsitro_proceso" readonly>
        <input type="hidden" name="opc_procesos" value="agregar_pro_encargo" id="opc_procesos" readonly>


        <div class="modal-footer">
          <div align='right'>
              <button class="btn btn_perso_s btn_claro" id="cerrar_caja_btn" type="submit">
                Guardar
              </button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>