<?php 
include_once "conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$id_producto = (isset($_POST['cod_barra'])) ? $_POST['cod_barra'] : '';

$con_cant= "SELECT `cantidad` FROM `materiales` WHERE `codigo` = '$id_producto'";
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

<nav class="navbar navbar-light bg-dark animated">
  <div class="container">
       <a class="btn btn-primary regresar" href="stock_materiales.php" role="button">
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
                `materiales`.`codigo`,
                `tipo_material`.`tipo_material`, 
                CONCAT(`precio_material`.`prec_compra`,' ',`precio_material`.`moneda`) `prec_compra`

            FROM `materiales` 
                LEFT JOIN `tipo_material` ON `materiales`.`id_tipomaterial` = `tipo_material`.`id_tipomaterial` 
                LEFT JOIN `unidmedida` ON `materiales`.`id_unimedidas` = `unidmedida`.`id_unimedidas` 
                LEFT JOIN `precio_material` ON `precio_material`.`id_materiales` = `materiales`.`id_materiales`
            WHERE `precio_material`.`id_prec_mate` = (SELECT MAX(`precio_material`.`id_prec_mate`) FROM `precio_material` WHERE  `precio_material`.`id_materiales` = `materiales`.`id_materiales`) AND `materiales`.`codigo` = '$id_producto'
            ORDER BY `materiales`.`id_materiales` DESC";
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

  
	
