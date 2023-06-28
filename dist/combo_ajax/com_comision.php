<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT `id_por_comi`, `porcen_comision` FROM `porcentaje_comision`";
$categoria_comision = $conexion->prepare($consulta);
$categoria_comision->execute(); 
$conexion=null;
 ?>
<option Value="">% de comisión</option>
  <?php foreach ($categoria_comision as $opciones):?>
     
<option value= "<?php echo $opciones['id_por_comi']?>">
<?php  echo $opciones['id_por_comi'];?> <?php echo $opciones['porcen_comision'];?>
</option>

<?php endforeach
?>
