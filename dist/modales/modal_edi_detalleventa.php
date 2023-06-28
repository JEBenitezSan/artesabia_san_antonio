<div class="modal fade" id="modad_editar_dellfact" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modad_editar_dellfactLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header" style="background-color:#28548C; color:white;">

      <div class="row">
        <div class="col-md-6">
            <h5 class="modal-title" id="modad_editar_dellfactLabel">Editar</h5>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" value=""
            id="editar_tipo_fac" name="editar_tipo_fac"  
            placeholder="Tipo de factura" readonly 
            style="width: 200px; background-color:#28548C; color:white; border-color: #28548C;">
        </div>
      </div>
      



        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!------------------------------>
      <div class="modal-body">

      <form id="form_editar_dellfac" method="POST">

          <div class="row">

              <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Id detalle de factura</label>
                      <input type="text" class="form-control" id="id_detall_factura" name="id_detall_factura" readonly>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Numero de factura</label>
                      <input type="text" class="form-control" id="id_num_factura" name="id_num_factura" readonly>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Código de barra</label>
                      <input type="text" class="form-control" id="cod_barra" name="cod_barra" readonly>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Producto</label>
                      <input type="text" class="form-control" id="nombre_product" name="nombre_product" readonly>
                    </div>
              </div>
              
              <input type="hidden" name="user_editardell" value="<?php echo $id_usuario;?>" id="user_editardell" readonly>
              <input type="hidden" name="opc_fac" value="editar_detalle" id="opc_fac" readonly>
              <input type="hidden" name="tipo_factura_editar" value="" id="tipo_factura_editar" readonly>

              <div class="col-md-6" id="edit_sub_dellpro">
                    <div class="mb-3">
                      <label class="form-label">Precio de venta</label>
                      <input type="text" class="form-control" id="prec_venta_detall" name="prec_venta_detall"  placeholder="Digita precio de venta">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Cantidad de producto</label>
                      <input type="number" class="form-control" id="cant_detall" name="cant_detall"  placeholder="Digita cantidad a editar" required>
                    </div>
                    <input type="hidden" class="form-control" id="cant_detall_val" name="cant_detall_val" required>

                    <div class="mb-3">
                      <label class="form-label">Sub total</label>
                      <input type="text" class="form-control" id="sub_total" name="sub_total"  placeholder="Total editado" required readonly>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Id grupo</label>
                      <input type="text" class="form-control" id="id_detall_stock_pro" name="id_detall_stock_pro" readonly>
                    </div>
              </div>


          </div>  

      </div>
      <!------------------------------>
      <div class="modal-footer" style="background-color:#28548C;">
        <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-sm btn-primary">Aceptar</button>
      </div>

      </form>

    </div>
  </div>
</div>