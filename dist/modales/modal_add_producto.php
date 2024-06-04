<div class="modal fade" id="moda_add_newproduc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header" style='background-color:#AF5C04; color:#ffffff;'>
        <h5 class="modal-title" id="staticBackdropLabel">Agregar nuevo productos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_add_stock"></button>
      </div>
      <form id="forma_new_producto" method="POST" name="forma_new_producto" enctype="multipart/form-data" autocomplete="off">

      <div class="modal-body" id="cap_id_add">
          <div class="row">
            <div class="col-md-6">
              
              <input type="hidden" name="user_registro" value="<?php echo $id_usuario;?>" id="user_registro" readonly>
              <input type="hidden" name="opc_invet" value="guardar_newproducto" id="opc_invet" readonly>

                <!----------------------------------------------------->
                <small class="form-label">Cod_Barra</small>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="cod_barra" id="cod_barra"
                    placeholder="Digita codigo de barra" required>
                </div>
                <!----------------------------------------------------->
                <small class="form-label">Nombre de producto</small>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="nom_producto" id="nom_producto"
                    placeholder="Digita nombre de producto" required>
                </div>
                <!----------------------------------------------------->
                <small class="form-label">Cantidad</small>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="cantidad_product" id="cantidad_product"
                    placeholder="Digita cantidad de producto" required>
                </div>
                <!----------------------------------------------------->
                <small class="form-label">Tipo de producto</small>
                    <div class="input-group mb-3">
                        <select class="form-select tipo_producto" id="tipo_producto" name="tipo_producto">
                        </select>
                        <button class="btn btn-warning btn_claro agregar_tipoproducto" type="button" id="agregar_tipoproducto">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </div>
            </div>

            <div class="col-md-6">
                <!-----------------------------------------------------> 
                <div class="mb-2">
                      <small>Precio de compra</small>
                      <input type="text" value="" id="total" name="total" class="form-control" placeholder="Precio de compra" required>
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
                <small class="form-label">Tipo Moneda</small>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="tipo_moneda" id="tipo_moneda"
                    placeholder="Digita nombre de producto" required>
                </div>
            </div>
          </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-warning btn_claro" id="add_stock_db">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>