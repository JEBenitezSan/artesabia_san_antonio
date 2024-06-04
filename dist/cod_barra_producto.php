<?php 
include_once "conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$id_producto = (isset($_POST['cod_barra'])) ? $_POST['cod_barra'] : '';

$con_cant= "SELECT `cantidad` FROM `stock_productos` WHERE `cod_barra` = '$id_producto'";
$concant = $conexion->prepare($con_cant);
$concant->execute();

$cant = 0;
foreach ($concant as $row) 
{
    $cant = $row['cantidad'];
}


?>
 <link rel="icon" href="static/iconos/logofar.png">
  <title>ServiTe@am</title>
<link rel="stylesheet" type="text/css" href="plantilla/framework/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="static/css/animacion.css"/>
<style>
    #flotar {
    float: left;
     }

     .regresar{
        color: #000000 !important;
        font-weight: bold; 
     }
</style>

<nav class="navbar navbar-light animated" style="background-color: #AF5C04;">
  <div class="container">
       <a class="btn btn-primary regresar" href="inventario_productos.php" role="button">
       <img src="static/iconos/regresar.ico" alt="" width="25" height="25">&nbsp;&nbsp; 
         Clic para regresar
        </a>
  </div>
</nav>
<br>


<?php for ($i=0; $i <$cant; $i++){ ?>
<!------------------------------------------>
<script type="text/javascript" src="static/cod_barra/JsBarcode.all.min.js"></script> 

<div class="container-fluid"> <!---Container--->

    <?php
    $sql = "SELECT 
    `stock_productos`.`cod_barra`,
    `stock_productos`.`nom_producto`,
    CONCAT(`cat_precio`.`prec_venta`,' ',`cat_precio`.`moneda`) AS `precio_venta`

    FROM `stock_productos` 
        LEFT JOIN `tipo_productos` ON `stock_productos`.`id_tipo_producto` = `tipo_productos`.`id_tipo_produc` 
        LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_productos` 
        LEFT JOIN `usuarios` ON `cat_precio`.`id_usuario` = `usuarios`.`id_usuario`
        
    WHERE `cat_precio`.`id_precio` = (SELECT MAX(`cat_precio`.`id_precio`) FROM `cat_precio` WHERE `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_productos`) AND
    `cod_barra` = '$id_producto'";
    $result = $conexion->prepare($sql);
    $result->execute();
    $arrayCodigos=array();
    ?> 


    <div class="row" id="flotar">
        <!----------------------------------------1-------------------------------------------------->   	
        <div class="col-md-12 animated fadeIn">
            <table class="table table-bordered table-sm table-responsive-xl" align="center">

                            <tr align="center" bgcolor="#AF5C04">
                                <th scope="col">Cdigo Productos</th>
                            </tr>

                            <tr>
                                <?php 
                            
                                    foreach ($result as $ver):
                                    $arrayCodigos[]=(string)$ver[0];
                                    ?>
                                    <td align="center">
                                <img src="static/iconos/logofar.png" alt="" width="60" height="60">
                                <svg id='<?php echo "barcode".$ver[0]; ?>'></svg>
                                </td> 
                            </tr>

                            <tr>
                                <td align="center"> <?php echo $ver[1],' ',$ver[2]; ?>  </td>
                            </tr>
                                    <?php endforeach;?>
            </table>	
        </div>
        <!----------------------------------------1-------------------------------------------------->   	
    </div>
  

</div>	<!---Container--->



<script type="text/javascript">

		function arrayjsonbarcode(j){
			json=JSON.parse(j);
			arr=[];
			for (var x in json) {
				arr.push(json[x]);
			}
			return arr;
		}

		jsonvalor='<?php echo json_encode($arrayCodigos) ?>';
		valores=arrayjsonbarcode(jsonvalor);

		for (var i = 0; i < valores.length; i++) {

			JsBarcode("#barcode" + valores[i], valores[i].toString(), {
				format: "codabar",
				lineColor: "#000",
				width: 2,
				height:30,
				displayValue: true
			});
		}
</script>
<!------------------------------------------>
<?php }?>
<script src="plantilla/framework/jquery/jquery-3.6.0.min.js"></script>
<script src="plantilla/framework/bootstrap/js/bootstrap.bundle.min.js"></script>

  
	
