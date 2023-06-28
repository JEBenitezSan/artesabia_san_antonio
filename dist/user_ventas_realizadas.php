<?php require_once "plantilla/parte_superior_user.html"?>
<link rel="stylesheet" href="static/css_user/estilo_ventas_realizadas.css"> 

<div class="container-fluid animated fadeIn">
<!----------------------------------------------------------->
  <h4>Admin Caja</h4>

<br>

<input type="hidden" name="id_usuario" value="<?php echo $id_usuario;?>" id="id_usuario" readonly>

<!--------------------Tabla descripcion productos---------------------------------------> 
<div id="productos" class="table-responsive animated fadeIn">
<table class="table table-sm table-bordered animated" id="productos_id" style="width: 100%">
          <thead align="center" class="table_head_pro">
            <tr>
              <th scope="col"><img src="static/iconos/detalle.ico" alt="Exito" width="25" height="25"></th>
              <th scope="col">Num_Fac</th>
              <th scope="col">Tpo_Fac</th>
              <th scope="col">Cod_cliente</th>
              <th scope="col">Nombre_cliente</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Total_Fac</th>
              <th scope="col">Descuento</th>
              <th scope="col">Total_Neto</th>
              <th scope="col">Efectivo</th>
              <th scope="col">Vuelto</th>
              <th scope="col">Estado_Fac</th>
              <th scope="col">Vendedor</th>
              <th scope="col">Accion</th>
            </tr>
          </thead>

          <tbody align="center">
            
          <tfoot class="table_head_pro">
            <tr align="center">
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            </tr>
        </tfoot>

          </tbody>

</table>
</div>



</div> <!--Fin de container-fluid-->
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior_user.html"?>

<?php require_once "modales/modal_detalleventa.php"?>

<script src="static/js_user/admin_ventas_realizadas.js"></script>





