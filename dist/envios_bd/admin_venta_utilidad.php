<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

/// datos de fecha a imprimir
$fecha_1 = (isset($_POST['fecha_1'])) ? $_POST['fecha_1'] : '';
$fecha_2 = (isset($_POST['fecha_2'])) ? $_POST['fecha_2'] : '';

/// datos de fecha de lista de salida
$fecha_11 = (isset($_POST['fecha_11'])) ? $_POST['fecha_11'] : '';
$fecha_22 = (isset($_POST['fecha_22'])) ? $_POST['fecha_22'] : '';

/// datos de fecha de lista de pagos planilla
$fecha_111 = (isset($_POST['fecha_111'])) ? $_POST['fecha_111'] : '';
$fecha_222 = (isset($_POST['fecha_222'])) ? $_POST['fecha_222'] : '';

/// Datos de panilla empleado
$id_usuario_v = (isset($_POST['id_usuario_v'])) ? $_POST['id_usuario_v'] : '';
$id_por_comi = (isset($_POST['id_por_comi'])) ? $_POST['id_por_comi'] : '';
$id_salario = (isset($_POST['id_salario'])) ? $_POST['id_salario'] : '';
$comision = (isset($_POST['comision'])) ? $_POST['comision'] : '';
$total_neto = (isset($_POST['total_neto'])) ? $_POST['total_neto'] : '';
$fech_ran_1 = (isset($_POST['fech_ran_1'])) ? $_POST['fech_ran_1'] : '';
$fech_ran_2 = (isset($_POST['fech_ran_2'])) ? $_POST['fech_ran_2'] : '';
$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';

$vende_dor = (isset($_POST['vende_dor'])) ? $_POST['vende_dor'] : '';

/// Datos para guardar la utilidad consultada
$fech1 = (isset($_POST['fech1'])) ? $_POST['fech1'] : '';
$fech2 = (isset($_POST['fech2'])) ? $_POST['fech2'] : '';
$salida_id = (isset($_POST['salida_id'])) ? $_POST['salida_id'] : '';
$entrada_id = (isset($_POST['entrada_id'])) ? $_POST['entrada_id'] : '';
$salario_id = (isset($_POST['salario_id'])) ? $_POST['salario_id'] : '';
$utilidad_id = (isset($_POST['utilidad_id'])) ? $_POST['utilidad_id'] : '';
$user = (isset($_POST['user'])) ? $_POST['user'] : '';

$tipo_facturaP = 'Producto';
$tipo_facturaS = 'Servicio';


/// Opc de switch valida que opc ejecutar 
$opc_repor_vta = (isset($_POST['opc_repor_vta'])) ? $_POST['opc_repor_vta'] : '';

switch($opc_repor_vta) 
{
    case "lista_repor_venta":

        $repor_venta="SELECT 
                        `factura`.`id_num_factura`,
                        `stock_productos`.`cod_barra`,
                        `stock_productos`.`nombre_product`,
                        `factura`.`total_descuent`,
                        `factura`.`id_cant_porcendes`,
                        `detalle_factura`.`prec_venta_detall`,
                        `detalle_factura`.`cant_detall`,
                        `detalle_factura`.`sub_total`,
                        (`cat_precio`.`prec_compra`) *  (`detalle_factura`.`cant_detall`) AS `prec_compra`,
                        `factura`.`fecha_factura`,
                        `cliente`.`nombre_cliente`, 
                        `usuarios`.`usuario`
        
        FROM `factura` 
            LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura` 
            LEFT JOIN `stock_productos` ON `detalle_factura`.`id_stock_produc` = `stock_productos`.`id_stock_produc` 
            LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_produc` 
            LEFT JOIN `cliente` ON `factura`.`id_cliente` = `cliente`.`id_cliente` 
            LEFT JOIN `usuarios` ON `cat_precio`.`id_usuario` = `usuarios`.`id_usuario`

            WHERE (`factura`.`fecha_factura` >= '$fecha_1') AND (`factura`.`fecha_factura` <= '$fecha_2') AND (`tipo_factura` = '$tipo_facturaP') AND
             `cat_precio`.`id_precio` = (SELECT MAX(`cat_precio`.`id_precio`) FROM `cat_precio` WHERE `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_produc`)
            
            GROUP BY `detalle_factura`.`id_detall_factura`";
        $reporte_venta = $conexion->prepare($repor_venta);
        $reporte_venta->execute(); 
        
		$data = $reporte_venta->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "lista_salida":

        $repor_salida="SELECT 
        `salida`.`id_salida`,
        `salida`.`tipo_salida`,
        `salida`.`descripcion_salida`,
        `salida`.`monto_salida`,
        `usuarios`.`usuario`,
        `salida`.`id_caja`,
        `caja`.`descrip_cerrar_caja`,
        `salida`.`fecha_salida`
        
        FROM `salida` 
            LEFT JOIN `caja` ON `salida`.`id_caja` = `caja`.`id_caja` 
            LEFT JOIN `usuarios` ON `caja`.`id_usuario` = `usuarios`.`id_usuario`
            WHERE (`salida`.`fecha_salida` >= '$fecha_11') AND (`salida`.`fecha_salida` <= '$fecha_22')";
        $reporsalida = $conexion->prepare($repor_salida);
        $reporsalida->execute(); 
        
		$data = $reporsalida->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "lista_planilla":

        $repor_planilla="SELECT
                        `planilla_pago`.`id_plani_pago`,
                        (`usuarios`.`usuario`) AS 'vendedor',
                        `planilla_pago`.`comision`,
                        `salario`.`salario_neto`, 
                        `planilla_pago`.`total_neto`,
                        `planilla_pago`.`fecha_realizada`,
                        (SELECT `usuarios`.`usuario` FROM `usuarios` WHERE `usuarios`.`id_usuario` = `planilla_pago`.`id_usuario`) as 'user'
                                  
            FROM `planilla_pago` 
                LEFT JOIN `salario` ON `planilla_pago`.`id_salario` = `salario`.`id_salario` 
                LEFT JOIN `usuarios` ON `planilla_pago`.`id_usuario_v` = `usuarios`.`id_usuario`
                WHERE (`planilla_pago`.`fecha_realizada` >= '$fecha_111') AND (`planilla_pago`.`fecha_realizada` <= '$fecha_222') ";
        $reporplanilla = $conexion->prepare($repor_planilla);
        $reporplanilla->execute(); 
        
		$data = $reporplanilla->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "lista_servicio":
        $repor_venservi="SELECT 
                            `factura`.`id_num_factura`, 
                            `servicios`.`id_servicio`,
                            `servicios`.`observaciones`,
                            `factura`.`total_descuent`,
                            `factura`.`id_cant_porcendes`,
                            `detalle_factura`.`prec_venta_detall`,
                            `detalle_factura`.`cant_detall`,
                            `detalle_factura`.`sub_total`,
                            `factura`.`fecha_factura`,
                            `cliente`.`nombre_cliente`, 
                            `usuarios`.`usuario`

        FROM `factura` 
        LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura` 
        LEFT JOIN `servicios` ON `detalle_factura`.`id_servicio` = `servicios`.`id_servicio` 
        LEFT JOIN `cliente` ON `factura`.`id_cliente` = `cliente`.`id_cliente` 
        LEFT JOIN `usuarios` ON `cliente`.`id_usuario` = `usuarios`.`id_usuario`

        WHERE (`factura`.`fecha_factura` >= '$fecha_1') AND (`factura`.`fecha_factura` <= '$fecha_2') AND (`tipo_factura` = '$tipo_facturaS')

        GROUP BY `detalle_factura`.`id_detall_factura`";
        $reporvenservi = $conexion->prepare($repor_venservi);
        $reporvenservi->execute(); 

        $data = $reporvenservi->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);


    break;

    case "guardar_uti_final":

        $inser_utilidad="INSERT INTO `utilidades`(`id_utili`,
                                                  `salidas`, 
                                                 `entradas`, 
                                                 `salarios`, 
                                                 `utilidad`, 
                                                 `fecha_reali`, 
                                                 `fecha_1r`, 
                                                 `fecha_2r`,
                                                 `id_usuario`) 
                            VALUES (NULL,
                                    '$salida_id',
                                    '$entrada_id',
                                    '$salario_id',
                                    '$utilidad_id',
                                    '$fech_ingre',
                                    '$fech1',
                                    '$fech2',
                                    '$user')";
        $inserutilidad = $conexion->prepare($inser_utilidad);
        $inserutilidad->execute(); 

        if($inserutilidad->rowCount() >= 1) 
        {
        echo 1;
        }
        else {
        echo 0;
        }
    break;

    case "lista_utilidad":

        $lista_utilidad="SELECT `utilidades`.`id_utili`,
                                `utilidades`.`salidas`,
                                `utilidades`.`entradas`,
                                `utilidades`.`salarios`,
                                `utilidades`.`utilidad`,
                                `utilidades`.`fecha_reali`,
                                `utilidades`.`fecha_1r`,
                                `utilidades`.`fecha_2r`,
                                `usuarios`.`usuario`
                            FROM `utilidades` 
                                LEFT JOIN `usuarios` ON `utilidades`.`id_usuario` = `usuarios`.`id_usuario`
                                ORDER BY `utilidades`.`id_utili` DESC";
        $listautilidad = $conexion->prepare($lista_utilidad);
        $listautilidad->execute(); 
        
		$data = $listautilidad->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;
}
$conexion=null;
?>