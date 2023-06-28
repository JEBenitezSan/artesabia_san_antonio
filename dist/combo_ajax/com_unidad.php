<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_unimedidas`,`unidad_medida` FROM `unidmedida`";

$categoria_producto = $conexion->prepare($Consulta);
$categoria_producto->execute(); 
$conexion=null;
 ?>
<option Value="">Unidad de medida</option>
  <?php foreach ($categoria_producto as $opciones):?>
     
<option value= "<?php echo $opciones['id_unimedidas']?>">
<?php echo $opciones['unidad_medida'];?>
</option>

<?php endforeach
?>
