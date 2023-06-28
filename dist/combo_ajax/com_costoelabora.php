<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_precio_elabora`,`precio_elaboracion`,`moneda` FROM `precio_elaboracion`";
$categoria_producto = $conexion->prepare($Consulta);
$categoria_producto->execute(); 
$conexion=null;
 ?>
<option Value="">Precio de Fabricación</option>
  <?php foreach ($categoria_producto as $opciones):?>
     
<option value= "<?php echo $opciones['id_precio_elabora']?>">
<?php echo $opciones['precio_elaboracion'].' '.$opciones['moneda']; ?>

</option>

<?php endforeach
?>
