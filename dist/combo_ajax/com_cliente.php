<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_cliente`, CONCAT(`id_cliente`,' ',`nombre_cliente`,' ',`apellido_cliente`) `nombre_apellido` FROM `cliente`
ORDER BY `cliente`.`id_cliente` DESC";

$cliente = $conexion->prepare($Consulta);
$cliente->execute(); 
$conexion=null;
 ?>
<option Value="">Cliente</option>
  <?php foreach ($cliente as $opciones):?>
     
<option value= "<?php echo $opciones['id_cliente']?>">
<?php echo $opciones['nombre_apellido']; ?>
</option>

<?php endforeach
?>
