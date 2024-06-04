<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_tipo_produc`, `tipo_producto` FROM `tipo_productos`";
$categoria_producto = $conexion->prepare($Consulta);
$categoria_producto->execute(); 
$conexion=null;
 ?>
<option Value="">Tipo de Producto</option>
  <?php foreach ($categoria_producto as $opciones):?>
     
<option value= "<?php echo $opciones['id_tipo_produc']?>">
<?php echo $opciones['tipo_producto'];?>
</option>

<?php endforeach
?>
