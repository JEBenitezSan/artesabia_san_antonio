<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_categoria_produc`,`categoria` FROM `categoria_producto`";
$categoria_producto = $conexion->prepare($Consulta);
$categoria_producto->execute(); 
$conexion=null;
 ?>
<option Value="">Tipo de Producto</option>
  <?php foreach ($categoria_producto as $opciones):?>
     
<option value= "<?php echo $opciones['id_categoria_produc']?>">
<?php echo $opciones['categoria'];?>
</option>

<?php endforeach
?>
