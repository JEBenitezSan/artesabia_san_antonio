<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$nom_laboratorio = (isset($_POST['nom_laboratorio'])) ? $_POST['nom_laboratorio'] : '';
$user_modal_laboratorio = (isset($_POST['user_modal_laboratorio'])) ? $_POST['user_modal_laboratorio'] : '';
date_default_timezone_set('America/Managua');
$fecha_ingre_g = date("Y-m-d H:i:s");

$opc_labora = (isset($_POST['opc_labora'])) ? $_POST['opc_labora'] : '';

switch($opc_labora) 
{
	case "add_labora":

		$consulta="INSERT INTO `laboratorio`(`id_laboratorio`, `nom_laboratorio`, `id_usuario`, `fecha_ingre_la`) 
                                   VALUES (NULL,'$nom_laboratorio','$user_modal_laboratorio','$fecha_ingre_g')";
		$proveedor = $conexion->prepare($consulta);
		$proveedor->execute(); 
        if($proveedor->rowCount() >= 1) 
        {
           echo 1;
        } else {
           echo 0;
        }

	break;

	case "delete_labora":
		 
	break;

}


$conexion=null;
?>