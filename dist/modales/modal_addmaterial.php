<div class="modal fade" id="modal_addstock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header tabla_estilo">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar productos al Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn_add_stock"></button>
      </div>
      <div class="modal-body" id="cap_id_add">
          <form id = "form_addstock_new" autocomplete="off"> 

                <div class="row">

                <div class="col-md-6" id="add_stock_edit">
                      <input type="hidden" name="user" value="<?php echo $id_usuario;?>" id="user" readonly>
                      <input type="hidden" name="opc_compra" value="update_add_material" id="opc_compra" readonly>
                      <input type="hidden" name="unidamedida" value="" id="unidamedida" readonly>
                      <!----------------------------------------------------->
                      <small class="form-label">Id_Material</small>
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" name="id_material" id="id_material" 
                          placeholder="Id Material" required readonly>
                      </div>
                      <!--------------------------------------------->
                      <small class="form-label">Codigo</small>
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" name="codmaterial" id="codmaterial"
                          placeholder="Codigo de material" required readonly>
                      </div>
                      <!----------------------------------------------------->
                      <small class="form-label">Tipo Material</small>
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" name="tipomaterial" id="tipomaterial"
                          placeholder="Tipo de material" required readonly>
                      </div>
                      <!----------------------------------------------------->
                      <small class="form-label">Tipo Material</small>
                      <div class="input-group mb-3">
                        <select class="tipo_material form-select" name="id_tipo_material" id="id_tipo_material" required>

                        </select>
                      </div>
                      <!----------------------------------------------------->
                      <div class="alert alert-warning my-3 alert_estilo" role="alert" style="border-radius: 13px;">
                      <small class="form-label">Cantidad Existente</small>
                      <small class="badge rounded-pill bg-danger" id="ud_medida"></small>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="stock_exi_add" id="stock_exi_add"
                          placeholder="Digita estoy existente" required readonly>
                      </div>
                      <!----------------------------------------------------->
                      <small class="form-label">Cantidad de material a agregar</small> 
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="new_stock_add" id="new_stock_add"
                          placeholder="Digita cantidad a agregar" required>
                      </div>
                      <!----------------------------------------------------->
                      <small class="form-label">Nuevo total</small>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="new_total_stock_add" id="new_total_stock_add"
                          placeholder="Nuevo Material existente" required readonly>
                      </div>
                      </div>
                      <!----------------------------------------------------->
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
                        <small class="form-label">Nuevo Precio</small>
                        <div class="input-group mb-2">
                          <input type="number" class="form-control" name="nuevo_precio" id="nuevo_precio"
                            placeholder="Nuevo precio a agregar" required readonly>
                        </div>
                        <!----------------------------------------------------->
                        <small class="form-label">Color</small>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="colormaterial" id="colormaterial"
                            placeholder="Digita color de material" aria-label="Digita presentacion" required>
                        </div>
                      <!----------------------------------------------------->

                </div>

               </div>
                <!----------------------------floatingInputValue------------------------->
            

      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-warning btn_claro" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-warning btn_oscuro" id="add_stock_db">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>