<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT `id_modelo`, `nombre_modelo` FROM `modelo`";
$categoria_modelo = $conexion->prepare($consulta);
$categoria_modelo->execute(); 
$conexion=null;
 ?>
<option Value="">Elige Artesano</option>
  <?php foreach ($categoria_modelo as $opciones):?>
     
<option value= "<?php echo $opciones['id_modelo']?>">
<?php echo $opciones['nombre_modelo'];?>
</option>

<?php endforeach
?>
