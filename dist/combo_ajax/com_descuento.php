<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT `id_cant_porcendes`,`descrip_porcendes` FROM `porcen_descuento`";
$porcen_descuento = $conexion->prepare($Consulta);
$porcen_descuento->execute(); 
$conexion=null;
 ?>
<option Value="">Aplicar descuento</option>
  <?php foreach ($porcen_descuento as $opciones):?>
     
<option value= "<?php echo $opciones['id_cant_porcendes']?>">
<?php echo $opciones['descrip_porcendes'];?>
</option>

<?php endforeach
?>
