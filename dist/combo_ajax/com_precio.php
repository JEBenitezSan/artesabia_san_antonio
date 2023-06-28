<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_prec_mate`,`prec_compra`,`moneda` FROM `precio_material`";

$categoria_producto = $conexion->prepare($Consulta);
$categoria_producto->execute(); 
$conexion=null;
 ?>
<option Value="">Precios</option>
  <?php foreach ($categoria_producto as $opciones):?>
     
<option value= "<?php echo $opciones['id_prec_mate']?>">
<?php echo $opciones['prec_compra'].' '.$opciones['moneda'];?>
</option>

<?php endforeach
?>
