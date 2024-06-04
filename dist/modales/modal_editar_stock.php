<div class="modal fade" id="modaleditar_stock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header" style='background-color:#AF5C04; color:#ffffff;'>
        <h5 class="modal-title" id="staticBackdropLabel">Agregar productos al Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_add_stock"></button>
      </div>
      <div class="modal-body" id="cap_id_add">
          <form id = "form_add_productos" autocomplete="off"> 

                <div class="row">

                <div class="col-md-12 col-lg-6 col-12" id="add_stock_edit">
                      <input type="hidden" name="user_registro_add" value="<?php echo $id_usuario;?>" id="user_registro_add" readonly>
                      <input type="hidden" name="opc_invet" value="guardar_stock_con_precios" id="opc_invet" readonly>
                      <!----------------------------------------------------->
                      <small class="form-label">
                        Id_Stock
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Codigo de barra</small>
                      <div class="input-group mb-2">

                        <input type="text" class="form-control" name="id_stock_add" id="id_stock_add" 
                          placeholder="Id producto" aria-label="Id producto" required readonly>

                          <input type="text" class="form-control" name="cod_barra_add" id="cod_barra_add"
                          placeholder="Codigo de barra" aria-label="Codigo de barra" required readonly>

                      </div>

                      <!----------------------------------------------------->
                      <small class="form-label">Nombre de producto</small>
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" name="nom_producto_add" id="nom_producto_add"
                          placeholder="Digita nombre de producto" aria-label="Digita nombre de producto" required>

                          <input type="text" class="form-control" name="tipo_producto" id="tipo_producto"
                          placeholder="Digita nombre de producto" aria-label="Digita nombre de producto" required readonly>
                      </div>
                      <!----------------------------------------------------->

                      <div class="alert alert-dark" role="alert">
                          <small class="form-label">Stock Existente</small>
                          <div class="input-group mb-2">
                            <input type="text" class="form-control" name="stock_exi_add" id="stock_exi_add"
                              placeholder="Digita estoy existente" aria-label="Digita stock existente" required readonly>
                          </div>
                          <!----------------------------------------------------->
                          <small class="form-label">Cantidad de producto a agregar</small> 
                          <div class="input-group mb-2">
                            <input type="text" class="form-control" name="new_stock_add" id="new_stock_add"
                              placeholder="Digita cantidad de productos a agregar" aria-label="Digita cantidad de productos a agregar" required onkeyup="suma_num_producto();">
                          </div>
                          <!----------------------------------------------------->
                          <small class="form-label">Cantidad de producto nuevo</small> 
                          <div class="input-group mb-2">
                            <input type="text" class="form-control" name="cant_new_produc" id="cant_new_produc"
                              placeholder="Total de productos" aria-label="Total de productos" required readonly>
                          </div>
                          <!----------------------------------------------------->
                       </div>
                </div>

                <div class="col-md-12 col-lg-6 col-12" id="mul_utili_add">
                        <div class="alert" role="alert" id="remo_aler" style="border-radius: 28px;">
                            <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="activar_campo_precios">
                            <label class="form-check-label" for="activar_campo_precios">Activa si hay un nuevo precio</label>
                          </div>
                       </div>
                        <!----------------------------------------------------->
                        <small class="form-label">Precio de compra</small>
                        <div class="input-group mb-2">
                          <input type="text" class="form-control" name="pre_compra_add" id="pre_compra_add"
                            placeholder="Digita precio de compra" aria-label="Digita precio de compra" required readonly onkeyup="ganancia_porcen_add();"> 
                        </div>
                        <!----------------------------------------------------->
                        <small class="form-label">Porcentaja de utilidad %</small>
                        <div class="input-group mb-2">
                          <input type="text" class="form-control" name="porcen_utili_add" id="porcen_utili_add"
                            placeholder="Digita porcentaje de utilidad" aria-label="Digita porcentaje de utilidad" required readonly onkeyup="ganancia_porcen_add();">
                        </div>
                        <!----------------------------------------------------->
                        <small class="form-label">Precio de venta</small>
                        <div class="input-group mb-2">
                          <input type="text" class="form-control" name="prec_vent_add" id="prec_vent_add"
                            placeholder="Digita precio de venta" aria-label="Digita precio de venta" required readonly onkeyup="obtener_porcen_add();">
                        </div>
                        <!--------------------------------------------->

                </div>

               </div>
                <!----------------------------floatingInputValue------------------------->
            

      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-warning btn_claro" id="add_stock_db">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>