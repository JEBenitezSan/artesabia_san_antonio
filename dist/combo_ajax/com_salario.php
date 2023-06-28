<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT `id_salario`, `salario_neto` FROM `salario`";
$categoria_salario = $conexion->prepare($consulta);
$categoria_salario->execute(); 
$conexion=null;
 ?>
<option Value="">Salario aplicado</option>
  <?php foreach ($categoria_salario as $opciones):?>
     
<option value= "<?php echo $opciones['salario_neto']?>">
  <?php echo number_format($opciones['salario_neto']);?> C$
</option>

<?php endforeach
?>

