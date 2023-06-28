<?php require_once "plantilla/parte_superior.html"?>
<link rel="stylesheet" href="static/css/estilo_lista_utilidades.css"> 
<!----------------------------------------------------------->
<div class="container">
<div class="card border_perso mb-4 card_info_utili animated fadeIn" style="max-width: 100%;">

  <div class="card-header alert alert-primary container_son" role="alert">
 

      <div class="row">
        <div class="col-md-6">
            <h4 align="center" class="my-3">Utilidades generadas </h4> 
        </div>
        <div class="col-md-6">
        <a class="btn btn-primary mb-3" href="reporte_utilidades.php" role="button" id="lista_utilidades">
         <img src="static/iconos/back.ico" alt="Exito" width="32" height="32">
         Regresar Gestión de utilidades 
        </a>
            
        </div>
    </div>


  </div>
        <div class="card-body text_primary">

            <div class="table-responsive bordes_margen animated fadeIn"> 
                <table class='table table-bordered table-sm' id='reporte_ventas_utilidad' style="width: 100%; background-color: #ffffff;">
                    <thead class="table_color">
                    <tr align="center">
                        <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
                        <th scope="col">Salidas</th>
                        <th scope="col">Entradas</th>
                        <th scope="col">Salarios</th>
                        <th scope="col"><i class="fas fa-tags"></i> Utilidades</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Fecha_Inicio</th>
                        <th scope="col">Fecha_Final</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Actiones</th>
                    </tr>
                    </thead>
                    <tbody align="center">

                        <tfoot class="table_color">
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
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        
        </div>
</div>
</div>
<!----------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>

<script src="static/js/admin_lista_utilidad.js"></script>
<script src="static/js/numeral.min.js"></script>







