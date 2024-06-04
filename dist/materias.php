<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/materiales.css"> 
<!-------------------------------------------------------->
<div class="container">
<div class="row">
    <div class="col-md-9">
        <h3>Registro Materiales</h3>
    </div>
</div>
</div>

<div class="container-fluid">
<div class="alert alert-secondary animated fadeIn" role="alert">
<form id="form_fac_compra" method="post">
<div class="row">

    <div class="col-md-4">
            <small class="form-label">Num Factura</small>
            <div class="input-group mb-2">
            <input type="text" class="form-control" name="fac_num_compra" id="fac_num_compra" 
                    placeholder="Digita el total de factura" required>
            </div>
 
            <small class="form-label">Monton</small>
            <div class="input-group mb-2">
            <input type="number" class="form-control" name="fac_monto_compra" id="fac_monto_compra" 
                    placeholder="Digita el total de factura" required>
            </div>
    </div>

    <div class="col-md-5">
            <small class="form-label">Fecha Factura</small>
            <div class="input-group mb-2">
            <input type="date" class="form-control" name="fac_fech_compra" id="fac_fech_compra" 
                    placeholder="Fecha compra" required>
             <input type="hidden" name="user" value="<?php echo $id_usuario;?>" id="user" readonly>
             <input type="hidden" name="opc_compra" value="fac_compra" id="opc_compra" readonly>
                    
            </div>

            <small class="form-label">Proveedor</small>   
            <div class="input-group mb-2">
            <select class="form-select proveedor_produc" name="proveedor_produc" id="proveedor_produc" required>

            </select>
            <button class="btn btn-warning btn_claro" type="button" id="add_proveedor"><i class="fas fa-plus"></i></button>
            </div>
    </div>

    <div class="col-md-3">
            <small class="form-label">Registrar</small>
            <button type="submit" class="btn btn-warning mb-2 btn_claro" id="btn_submit_compra"
             style="width: 100%">
            <strong>Guardar compra</strong>
           </button>

           <small class="form-label">Nueva compra</small>
            <button type="button" class="btn btn-warning mb-2 btn_oscuro" id="btn_new_campra"
             style="width: 100%">
            <strong>Nuevo compra</strong>
           </button>
    </div>

</div> 
</form> 
</div>   
</div>

<div style="display: none;" id="mostar_input" class="animated fadeIn">
<div class="container">
<div class="alert alert-dark" role="alert">
<div class="col-md-6">

    <div class="input-group">
        <input type="text" name="busqueda_compra_pro" id="busqueda_compra_pro" class="form-control" 
            placeholder="Digita codigo de barra"> 
            
        <button type="button" class="btn btn-warning btn_claro" 
        id="btnbusq_compra_pro">
        <i class="fa fa-search" aria-hidden="true"></i> Buscar
    </button>
    </div>
</div> 
</div> 
</div>
</div>

<!------------------------------Tabla-------------------------------------> 
<div style="display: none;" id="mostar_tabla" class="animated fadeIn">
<div class="container">
<div class="table-responsive"> 
      <table class='table responsive-table table-bordered border-warning' id='tabla' name='produc_resul'>
        <thead class="table-warning">
          <tr align="center">
            <th scope="col" class="celda_estilo"><i class="fa fa-key" aria-hidden="true"></i></th>
            <th scope="col" class="tabla_estilo">Tipo Material</th>
            <th scope="col" class="tabla_estilo">Codigo</th>
            <th scope="col" class="tabla_estilo">Color</th>
            <th scope="col" class="tabla_estilo">Cantidad</th>
            <th scope="col" class="tabla_estilo">Und Medida</th>
            <th scope="col" class="celda_estilo"><i class="fa fa-key" aria-hidden="true"></i></th>
            <th scope="col" class="tabla_estilo">Precio</th>
            <th scope="col" class="tabla_estilo">Total</th>
            <th scope="col" class="tabla_estilo">Agregar</th>
          </tr>
        </thead>
        <tbody id="producto_existe" align="center">

        </tbody>
        </table>
</div>
</div>
</div>
<!---------- --------------------Tabla------------------------------------->

<div style="display: none;" id="mostar_form" class="animated fadeIn"> 
<div class="container centrar_form">
<!-----------------------------Formulario---------------------------------------------------->
<div class="col-md-9">
                <div class="card form_pro">
                        <h3 class="card-header" style="background-color: #CCA378" align="center">
                        Registro de Productos 
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        </h3>
                        <div class="card-body">
                
                                <div class="row conten_form">
                                <!--------------------------------------------->
                                        <div class="col-md-6">
                                         <form id="formaterial" method="POST">

                                                <input type="hidden" name="user" value="<?php echo $id_usuario;?>" id="user" readonly>
                                                <input type="hidden" name="opc_compra" value="add_compra" id="opc_compra" readonly>

                                                <small class="form-label">Codigo</small>
                                                <div class="input-group mb-3">
                                                <input type="text" name="cod_material" id="cod_material" class="form-control" 
                                                        placeholder="Digita codigo del material" aria-label="Digita codigo del material" required> 
                                                </div>
                                                <!--------------------------------------------->
                                                <small class="form-label">Tipo Material</small>
                                                <div class="input-group mb-3">
                                                <select class="tipo_material form-select" name="tipo_material" id="tipo_material" required>

                                                </select>
                                                <button class="btn btn-warning add_tipomaterial btn_oscuro" type="button" id="add_tipomaterial" ><i class="fas fa-plus"></i></button>
                                                </div>
                                                <!--------------------------------------------->
                                                <small class="form-label">Color</small>
                                                <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="color_material" id="color_material"
                                                        placeholder="Digita Color" aria-label="Digita el color del material" required>
                                                </div>
                                                <!--------------------------------------------->
                                        </div>

                                        <!--user cod_barra nom_producto cant_product pre_compra porcen_utili precio_vta fecha_vence presentacion prescrip laboratorio proveedor_produc2 -->

                                        <div class="col-md-6" id="por_ganancia">
                                                <!--------------------------------------------->
                                                <small class="form-label">Cantidad</small>
                                                <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="cant_product" id="cant_product"
                                                        placeholder="Digita la cantidad de producto" aria-label="Digita la cantidad de producto" required>
                                                </div>
                                                <!---------------------------------------------> 
                                                <small class="form-label">Unidad</small> 
                                                <div class="input-group mb-3">
                                                <select class="cat_unidad form-select" name="cat_unidad" id="cat_unidad" required>

                                                </select>
                                                <button class="btn btn-warning add_unidad btn_oscuro" type="button" id="add_unidad" ><i class="fas fa-plus"></i></button>
                                                </div>
                                                <!----------------------------------------->
                                                <small class="form-label">Precio</small> 
                                                <div class="input-group mb-3">
                                                       <input type="text" class="form-control" name="cat_precio" id="cat_precio" placeholder="Precio" required>
                                                                <span class="input-group-text">Moneda</span>
                                                        <input type="text" class="form-control" name="tipo_moneda" id="tipo_moneda" placeholder="Tipo de moneda">
                                                </div>

                                                <!----------------------------------------->

                                        </div>

                                </div> <!--row-->
                        
                        </div> <!--Card Body-->

                                <div class="card-footer text-muted" align="right" style="background-color: #CCA378">
                                <button type="submit" class="btn btn-warning btn_oscuro" id="btnproduct">Guargar&nbsp;<i class="fas fa-save"></i></button>
                                </div>

                        </form>

                </div>  <!--Card-->
</div>
<!-----------------------------Formulario---------------------------------------------------->
</div>
</div>

<!-- <div class="container-fluid">
        
 require_once "stock_productos.php"

</div> -->

<!-------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
<?php require_once "modales/modal_proveedor.php"?>
<?php require_once "modales/modal_cat_prec_mater_unidad.php"?>
<?php require_once "modales/modal_addmaterial.php"?>
<script src="static/js/materiales.js"></script>