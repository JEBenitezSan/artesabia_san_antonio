<div class="modal fade" id="modaleditar_stock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header" style='background-color:#1B82EC;'>
        <h5 class="modal-title" id="staticBackdropLabel">Agregar productos al Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_add_stock"></button>
      </div>
      <div class="modal-body" id="cap_id_add">
          <form id = "form_editstock" autocomplete="off"> 

                <div class="row">

                <div class="col-md-6" id="add_stock_edit">
                      <input type="hidden" name="id_user" value="<?php echo $id_usuario;?>" id="id_user" readonly>
                      <input type="hidden" name="opc_stock" value="editar_stock" id="opc_stock" readonly>
                      <!----------------------------------------------------->
                      <small class="form-label">
                        Id_Stock
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         Id_DStok</small>
                      <div class="input-group mb-2">

                        <input type="text" class="form-control" name="id_stock_add" id="id_stock_add" 
                          placeholder="Id producto" aria-label="Id producto" required readonly>

                        <input type="text" class="form-control" name="id_detalle_stoedit" id="id_detalle_stoedit" 
                          placeholder="Id producto" aria-label="Id detalle stock" required readonly>

                      </div>
                      <!----------------------------------------------------->
                      <small class="form-label">Codigo de barra</small>
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" name="cod_barra_add" id="cod_barra_add"
                          placeholder="Codigo de barra" aria-label="Codigo de barra" required readonly>
                      </div>
                      <!----------------------------------------------------->
                      <small class="form-label">Nombre de producto</small>
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" name="nom_producto_add" id="nom_producto_add"
                          placeholder="Digita nombre de producto" aria-label="Digita nombre de producto" required>
                      </div>
                      <!----------------------------------------------------->

                      <div class="alert alert-primary" role="alert">
                          <small class="form-label">Stock Existente</small>
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="stock_exi_add" id="stock_exi_add"
                              placeholder="Digita estoy existente" aria-label="Digita estoy existente" required readonly>
                          </div>
                          <!----------------------------------------------------->
                          <small class="form-label">Cantidad de producto a editar</small> 
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="new_stock_add" id="new_stock_add"
                              placeholder="Digita cantidad de productos a agregar" aria-label="Digita cantidad de productos a agregar" required>
                          </div>
                          <!----------------------------------------------------->
                       </div>
                </div>



                <div class="col-md-6" id="mul_utili_add">
                        <div class="alert" role="alert" id="remo_aler" style="border-radius: 28px;">
                            <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="activar_campo_precios">
                            <label class="form-check-label" for="activar_campo_precios">Activa si hay un nuevo precio</label>
                          </div>
                       </div>
                        <!--------------------------------------------->
                        <small class="form-label">Id_Precio</small>
                        <div class="input-group mb-2">
                          <input type="text" class="form-control" name="id_precio_add" id="id_precio_add"
                            placeholder="Digita nombre de producto" aria-label="Digita nombre de producto" required readonly>
                        </div>
                        <!----------------------------------------------------->
                        <small class="form-label">Precio de compra</small>
                        <div class="input-group mb-2">
                          <input type="number" class="form-control" name="pre_compra_add" id="pre_compra_add"
                            placeholder="Digita precio de compra" aria-label="Digita precio de compra" required readonly> 
                        </div>
                        <!----------------------------------------------------->
                        <small class="form-label">Porcentaja de utilidad %</small>
                        <div class="input-group mb-2">
                          <input type="number" class="form-control" name="porcen_utili_add" id="porcen_utili_add"
                            placeholder="Digita porcentaje de utilidad" aria-label="Digita porcentaje de utilidad" required readonly>
                        </div>
                        <!----------------------------------------------------->
                        <small class="form-label">Precio de venta</small>
                        <div class="input-group mb-2">
                          <input type="number" class="form-control" name="prec_vent_add" id="prec_vent_add"
                            placeholder="Digita precio de venta" aria-label="Digita precio de venta" required readonly>
                        </div>
                        <!--------------------------------------------->
                        <small class="form-label">Tipo Categoria</small>
                        <div class="input-group mb-2">
                          <input type="text" class="form-control" name="categoria_edit" id="categoria_edit"
                            placeholder="Categoria de producto" aria-label="Categoria de producto" required readonly>
                        </div>

                        <div class="input-group mb-2">
                        <select class="categori_pro form-select" name="categori_pro_add" id="categori_pro_add" required>

                        </select>
                        </div>
                    	  <!--------------------------------------------->

                </div>

               </div>
                <!----------------------------floatingInputValue------------------------->
            

      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="add_stock_db">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>