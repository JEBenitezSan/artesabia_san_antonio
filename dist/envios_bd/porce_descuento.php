<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$id_cant_porcen_des = (isset($_POST['id_cant_porcen_des'])) ? $_POST['id_cant_porcen_des'] : '';
$descrip_porcen_desc = (isset($_POST['descrip_porcen_desc'])) ? $_POST['descrip_porcen_desc'] : '';
$user_modal_pordescuent = (isset($_POST['user_modal_pordescuent'])) ? $_POST['user_modal_pordescuent'] : '';

date_default_timezone_set('America/Managua');
$fecha_ingre_g=date("Y-m-d H:i:s");

$opc_porcen = (isset($_POST['opc_porcen'])) ? $_POST['opc_porcen'] : '';

switch($opc_porcen) 
{
	case "add_porcen":
            $insertar= "INSERT INTO `porcen_descuento`(`id_cant_porcendes`, `descrip_porcendes`, `fecha_ingre_des`, `id_usuario`)
            VALUES ('$id_cant_porcen_des', '$descrip_porcen_desc', '$fecha_ingre_g', '$user_modal_pordescuent')";
            $resultado = $conexion->prepare($insertar);
            $resultado->execute(); 

            if($resultado->rowCount() >= 1)
            { echo 1; }

            else { echo 0; }

    break;
    
    case "edit_porcen":

    break;

    case "dele_porcen":

    break;


}



$conexion=null;
?>