<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_artesano`, CONCAT(`nombre`,' ',`apellido`) `nombreapellido` FROM `artesano`";
$categoria_producto = $conexion->prepare($Consulta);
$categoria_producto->execute(); 
$conexion=null;
 ?>
<option Value="">Elige Artesano</option>
  <?php foreach ($categoria_producto as $opciones):?>
     
<option value= "<?php echo $opciones['id_artesano']?>">
<?php echo $opciones['nombreapellido'];?>
</option>

<?php endforeach
?>
