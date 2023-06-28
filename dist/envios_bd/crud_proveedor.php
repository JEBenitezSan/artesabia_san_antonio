<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$nom_proveedor = (isset($_POST['nom_proveedor'])) ? $_POST['nom_proveedor'] : '';
$ruc_proveedor = (isset($_POST['ruc_proveedor'])) ? $_POST['ruc_proveedor'] : '';
$tele_proveedor = (isset($_POST['tele_proveedor'])) ? $_POST['tele_proveedor'] : '';
$direc_proveedor = (isset($_POST['direc_proveedor'])) ? $_POST['direc_proveedor'] : '';
$user_modal_proveedor = (isset($_POST['user_modal_proveedor'])) ? $_POST['user_modal_proveedor'] : '';
date_default_timezone_set('America/Managua');
$fecha_ingre_g = date("Y-m-d H:i:s");

$opc_provee = (isset($_POST['opc_provee'])) ? $_POST['opc_provee'] : '';

switch($opc_provee) 
{
	case "add_proveedor":

		$consulta="INSERT INTO `proveedor`(`id_proveedor`, `nom_proveedor`, `ruc_proveedor`, `telef_proveedor`, `direccion`, `id_usuario`, `fecha_ingre_prov`)
         VALUES (NULL,'$nom_proveedor','$ruc_proveedor','$tele_proveedor','$direc_proveedor','$user_modal_proveedor','$fecha_ingre_g')";

		$proveedor = $conexion->prepare($consulta);
		$proveedor->execute(); 
        if($proveedor->rowCount() >= 1) 
        {
           echo 1;
        } else {
           echo 0;
        }

	break;

	case "delete_proveedor":
		 
	break;

}


$conexion=null;
?>