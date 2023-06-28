<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_diseno`, `nombre_diseno` FROM `diseno`";
$categoria_producto = $conexion->prepare($Consulta);
$categoria_producto->execute(); 
$conexion=null;
 ?>
<option Value="">Tipo de Producto</option>
  <?php foreach ($categoria_producto as $opciones):?>
     
<option value= "<?php echo $opciones['id_diseno']?>">
<?php echo $opciones['nombre_diseno'];?>
</option>

<?php endforeach
?>
