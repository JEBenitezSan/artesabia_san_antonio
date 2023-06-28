<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_tipomaterial`,`tipo_material` FROM `tipo_material`";

$categoria_producto = $conexion->prepare($Consulta);
$categoria_producto->execute(); 
$conexion=null;
 ?>
<option Value="">Material</option>
  <?php foreach ($categoria_producto as $opciones):?>
     
<option value= "<?php echo $opciones['id_tipomaterial']?>">
<?php echo $opciones['tipo_material'];?>
</option>

<?php endforeach
?>
