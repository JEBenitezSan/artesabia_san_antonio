<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$Consulta = "SELECT
            `usuarios`.`id_usuario`,
            CONCAT(`admin_user`.`nombres_user`,' ',`admin_user`.`apelldos_user`) `nombre_apellido`

FROM `usuarios` 
	LEFT JOIN `admin_user` ON `admin_user`.`id_usuario` = `usuarios`.`id_usuario`";

$usuario = $conexion->prepare($Consulta);
$usuario->execute(); 

$conexion=null;
 ?>
<option Value="">Vendedor</option>
  <?php foreach ($usuario as $opciones):?>
     
<option value= "<?php echo $opciones['id_usuario']?>">
<?php echo $opciones['nombre_apellido']; ?>
</option>

<?php endforeach
?>
