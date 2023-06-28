<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_proveedor`,`nom_proveedor` FROM `proveedor`";
$proveedor = $conexion->prepare($Consulta);
$proveedor->execute(); 
$conexion=null;
 ?>
<option value="">Tipo de Producto</option>
  <?php foreach ($proveedor as $opciones):?>
     
<option value= "<?php echo $opciones['id_proveedor']?>">
<?php echo $opciones['nom_proveedor'];?>
</option>

<?php endforeach
?>
