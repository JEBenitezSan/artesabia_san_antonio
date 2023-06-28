<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$user_modal_catpro = (isset($_POST['user_modal_catpro'])) ? $_POST['user_modal_catpro'] : '';
$categoria_pro = (isset($_POST['categoria_pro'])) ? $_POST['categoria_pro'] : '';
$descrip_cat = (isset($_POST['descrip_cat'])) ? $_POST['descrip_cat'] : '';

date_default_timezone_set('America/Managua');
$fecha_ingre_g = date("Y-m-d H:i:s");

$opc_catpro = (isset($_POST['opc_catpro'])) ? $_POST['opc_catpro'] : '';

switch($opc_catpro) 
{
	case "add_catpro":

		$inser="INSERT INTO `categoria_producto`(`id_categoria_produc`, `categoria`, `descripcion_cat`, `id_usuario`, `fecha_ingre_cat`)
               VALUES (NULL,'$categoria_pro','$descrip_cat','$user_modal_catpro','$fecha_ingre_g')";
		$categoria = $conexion->prepare($inser);
		$categoria->execute(); 
        if($categoria->rowCount() >= 1) 
        {
           echo 1;
        } else {
           echo 0;
        }

	break;

	case "delete_catpro":
		 
	break;

}


$conexion=null;
?>