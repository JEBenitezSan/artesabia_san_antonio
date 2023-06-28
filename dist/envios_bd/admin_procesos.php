<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

date_default_timezone_set('America/Managua');
$fecha_hoy = date("Y-m-d 00:00:00");
$fecha_despues = date("Y-m-d 23:59:59");

/// Nuevo usuario
$nombre_user = (isset($_POST['nombre_user'])) ? $_POST['nombre_user'] : ''; 
$apellido_user = (isset($_POST['apellido_user'])) ? $_POST['apellido_user'] : ''; 
$cedula_user = (isset($_POST['cedula_user'])) ? $_POST['cedula_user'] : ''; 
$sexo_user = (isset($_POST['sexo_user'])) ? $_POST['sexo_user'] : ''; 



$opc_procesos = (isset($_POST['opc_procesos'])) ? $_POST['opc_procesos'] : '';

switch($opc_procesos) 
{
    case "":
    break;

    case "lista_procesos":
        $lista_procesos = "SELECT 
                            `fabricacion`.`id_fabricacion`,
                            CONCAT(`cliente`.`nombre_cliente`,' ',`cliente`.`apellido_cliente`) AS `cliente`,
                            CONCAT(`artesano`.`nombre`,' ',`artesano`.`apellido`) AS `artesano`,
                            `fabricacion`.`fecha_inicio_fabrica`,
                            `fabricacion`.`estado`,
                            `fabricacion`.`fecha_final_fabrica`,
                            TIMESTAMPDIFF(DAY, DATE(NOW()), `fabricacion`.`fecha_final_fabrica`)  AS `total_dias`,
                            `diseno`.`nombre_diseno`, 
                            `modelo`.`nombre_modelo`,
                            `fabricacion`.`total`
                            
                            FROM `fabricacion` 
                                LEFT JOIN `diseno` ON `fabricacion`.`id_diseno` = `diseno`.`id_diseno` 
                                LEFT JOIN `artesano` ON `fabricacion`.`id_artesano` = `artesano`.`id_artesano` 
                                LEFT JOIN `cliente` ON `fabricacion`.`id_cliente` = `cliente`.`id_cliente`
                                LEFT JOIN `modelo` ON `fabricacion`.`id_modelo` = `modelo`.`id_modelo` 
                                WHERE `fabricacion`.`estado` = 'Fabricacion'";
        $listaprocesos = $conexion->prepare($lista_procesos);
        $listaprocesos->execute(); 
        
		$data = $listaprocesos->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "":
    break;

    case "":
    break;
}

$conexion=null;
?>