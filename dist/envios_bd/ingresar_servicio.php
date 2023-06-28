<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$user_modal_servicio = (isset($_POST['user_modal_servicio'])) ? $_POST['user_modal_servicio'] : '';
$opc_servi = (isset($_POST['opc_servi'])) ? $_POST['opc_servi'] : '';
$selec_tipo_servi = (isset($_POST['selec_tipo_servi'])) ? $_POST['selec_tipo_servi'] : '';
$observaciones = (isset($_POST['observaciones'])) ? $_POST['observaciones'] : '';
$fecha_entrega = (isset($_POST['fecha_entrega'])) ? $_POST['fecha_entrega'] : '';
$precio_inversion = (isset($_POST['precio_inversion'])) ? $_POST['precio_inversion'] : '';
$precio_servicio = (isset($_POST['precio_servicio'])) ? $_POST['precio_servicio'] : '';
$precio_total = (isset($_POST['precio_total'])) ? $_POST['precio_total'] : '';

/// Agregar tipo servicio
$user_modal_tiposervi = (isset($_POST['user_modal_tiposervi'])) ? $_POST['user_modal_tiposervi'] : '';
$tipo_servicio = (isset($_POST['tipo_servicio'])) ? $_POST['tipo_servicio'] : '';
$descrip_tiposervi = (isset($_POST['descrip_tiposervi'])) ? $_POST['descrip_tiposervi'] : '';

$estado_servi = "Pendiente";


date_default_timezone_set('America/Managua');
$fecha_ingre_ser=date("Y-m-d H:i:s");

$opc_servi = (isset($_POST['opc_servi'])) ? $_POST['opc_servi'] : '';

switch($opc_servi) 
{
	case "ingre_servi":
            $insertar= "INSERT INTO `servicios`(`id_servicio`, 
                                                `id_tiposervicio`, 
                                                `observaciones`,
                                                `fecha_entreda`, 
                                                `precio_inversion`, 
                                                `precio_servicio`, 
                                                `precio_total_venta`, 
                                                `estado`,
                                                `fecha_ingresado`,
                                                `id_usuario`)
                                        VALUES (NULL,
                                                '$selec_tipo_servi',
                                                '$observaciones',
                                                '$fecha_entrega',
                                                '$precio_inversion',
                                                '$precio_servicio',
                                                '$precio_total',
                                                '$estado_servi',
                                                '$fecha_ingre_ser',
                                                '$user_modal_servicio')";
            $resultado = $conexion->prepare($insertar);
            $resultado->execute(); 

            if($resultado->rowCount() >= 1)
            { echo 1; }

            else { echo 0; }

    break;
    
    case "lista_servicios":
        $lista_servicios="SELECT 
                        `servicios`.`id_servicio`, 
                        `tipo_servicios`.`tipo_servicio`,
                        `servicios`.`observaciones`,
                        `servicios`.`fecha_entreda`,
                        `servicios`.`precio_inversion`,
                        `servicios`.`precio_servicio`,
                        `servicios`.`precio_total_venta`,
                        `servicios`.`estado`,
                        `servicios`.`fecha_ingresado`,
                        `usuarios`.`usuario`
        FROM `servicios` 
            LEFT JOIN `tipo_servicios` ON `servicios`.`id_tiposervicio` = `tipo_servicios`.`id_tiposervicio` 
            LEFT JOIN `usuarios` ON `servicios`.`id_usuario` = `usuarios`.`id_usuario`";
        $listaservicios = $conexion->prepare($lista_servicios);
        $listaservicios->execute(); 

        $data = $listaservicios->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "add_tipo_servi":
        $insertar_tiposervi= "INSERT INTO `tipo_servicios`(`id_tiposervicio`, 
                                                 `tipo_servicio`, 
                                                 `descripcion_servi`, 
                                                 `id_usuario`) 
                                        VALUES (NULL,
                                                '$tipo_servicio',
                                                '$descrip_tiposervi',
                                                '$user_modal_tiposervi')";
        $insertartiposervi = $conexion->prepare($insertar_tiposervi);
        $insertartiposervi->execute(); 

        if($insertartiposervi->rowCount() >= 1)
        { echo 1; }

        else { echo 0; }

    break;


}

$conexion=null;
?>