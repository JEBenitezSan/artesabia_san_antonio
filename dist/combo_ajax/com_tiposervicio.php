<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_tiposervicio`, `tipo_servicio` FROM `tipo_servicios`";
$laboratorio = $conexion->prepare($Consulta);
$laboratorio->execute(); 
$conexion=null;
 ?>
<option Value="">Selecciona</option>
  <?php foreach ($laboratorio as $opciones):?>
<option value= "<?php echo $opciones['id_tiposervicio']?>">
<?php echo $opciones['tipo_servicio'];?>
</option>

<?php endforeach
?>


