<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$nom_cliente = (isset($_POST['nom_cliente'])) ? $_POST['nom_cliente'] : '';
$ape_cliente = (isset($_POST['ape_cliente'])) ? $_POST['ape_cliente'] : '';
$cedu_cli = (isset($_POST['cedu_cli'])) ? $_POST['cedu_cli'] : '';
$sexo_cliente = (isset($_POST['sexo_cliente'])) ? $_POST['sexo_cliente'] : '';
$num_clien = (isset($_POST['num_clien'])) ? $_POST['num_clien'] : '';
$correo_cli = (isset($_POST['correo_cli'])) ? $_POST['correo_cli'] : '';
$user = (isset($_POST['user'])) ? $_POST['user'] : '';

$opc_client = (isset($_POST['opc_client'])) ? $_POST['opc_client'] : '';

switch($opc_client) 
{
	case "list":
		$consulta='SELECT 
		`cliente`.`id_cliente`,
		`cliente`.`nombre_cliente`,
		`cliente`.`apellido_cliente`,
		`cliente`.`num_cedula`,
		`cliente`.`num_celular`,
		`admin_user`.`nombres_user`
		FROM `cliente` 
			LEFT JOIN `usuarios` ON `cliente`.`id_usuario` = `usuarios`.`id_usuario` 
			LEFT JOIN `admin_user` ON `admin_user`.`id_usuario` = `usuarios`.`id_usuario`';

		$cliente = $conexion->prepare($consulta);
		$cliente->execute(); 

		$data = $cliente->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
	break;

	case "add":
		 $consulta="INSERT INTO `cliente`(`id_cliente`,`nombre_cliente`,`apellido_cliente`,`sexo`,`num_cedula`,`num_celular`,`id_usuario`)
		               VALUES (NULL,'$nom_cliente','$ape_cliente','$sexo_cliente','$cedu_cli','$num_clien','$user')";
 
		 $add_cliente = $conexion->prepare($consulta);
		 $add_cliente->execute(); 
		 if($add_cliente->rowCount() >= 1) 
		 {
			echo 1;
		 } else {
			echo 0;
		 }
	break;

}


$conexion=null;
?>