<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");
/// Datos de comisiones
$usermodal_comision = (isset($_POST['usermodal_comision'])) ? $_POST['usermodal_comision'] : '';
$comision_add = (isset($_POST['comision_add'])) ? $_POST['comision_add'] : '';
$descrip_comision = (isset($_POST['descrip_comision'])) ? $_POST['descrip_comision'] : '';

/// Datos de salario
$usermodal_salario = (isset($_POST['usermodal_salario'])) ? $_POST['usermodal_salario'] : '';
$salario_add = (isset($_POST['salario_add'])) ? $_POST['salario_add'] : '';
$descrip_salario = (isset($_POST['descrip_salario'])) ? $_POST['descrip_salario'] : '';

/// datos de fecha a imprimir
$fecha_1 = (isset($_POST['fecha_1'])) ? $_POST['fecha_1'] : '';
$fecha_2 = (isset($_POST['fecha_2'])) ? $_POST['fecha_2'] : '';

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
                        `factura`.`fecha_factura`,
                        `cliente`.`nombre_cliente`, 
                        `usuarios`.`usuario`
        
        FROM `factura` 
            LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura` 
            LEFT JOIN `stock_productos` ON `detalle_factura`.`id_stock_produc` = `stock_productos`.`id_stock_produc` 
            LEFT JOIN `cliente` ON `factura`.`id_cliente` = `cliente`.`id_cliente` 
            LEFT JOIN `usuarios` ON `factura`.`id_usuario` = `usuarios`.`id_usuario`

            WHERE (`factura`.`fecha_factura` >= '$fecha_1') AND (`factura`.`fecha_factura` <= '$fecha_2') 
            
            GROUP BY `detalle_factura`.`id_detall_factura`";
        $reporte_venta = $conexion->prepare($repor_venta);
        $reporte_venta->execute(); 
        
		$data = $reporte_venta->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "lista_venta_vendedor":

        $repor_venta_vende="SELECT 
        `factura`.`id_num_factura`, 
        `factura`.`total_descuent`,
        `factura`.`id_cant_porcendes`,
        `factura`.`total_fac_neto`,
         SUM( (`cat_precio`.`prec_compra`) * (`detalle_factura`.`cant_detall`) ) AS 'capital_vendedor',
        `factura`.`id_caja`,
        `factura`.`confirma_caja`,
        `cliente`.`nombre_cliente`, 
        `usuarios`.`usuario`,
        `factura`.`fecha_factura`

        FROM `factura` 
        LEFT JOIN `cliente` ON `factura`.`id_cliente` = `cliente`.`id_cliente` 
        LEFT JOIN `usuarios` ON `factura`.`id_usuario` = `usuarios`.`id_usuario` 
        LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura` 
        LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `detalle_factura`.`id_stock_produc`
        
        WHERE `cat_precio`.`id_precio` = (SELECT MAX(`cat_precio`.`id_precio`) FROM `cat_precio` WHERE `cat_precio`.`id_stock_produc` =  `detalle_factura`.`id_stock_produc`) AND
                (`factura`.`fecha_factura` >= '$fecha_1') AND 
                (`factura`.`fecha_factura` <= '$fecha_2') AND
                (`factura`.`id_usuario` = '$vende_dor')
            
            GROUP BY `factura`.`fecha_factura`
            ORDER BY `factura`.`fecha_factura` DESC";
        $reporte_venta_vendedor = $conexion->prepare($repor_venta_vende);
        $reporte_venta_vendedor->execute(); 
        
		$data = $reporte_venta_vendedor->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "add_comision":

        $inser_comision="INSERT INTO `porcentaje_comision`(`id_por_comi`, `porcen_comision`, `id_usuario`) 
                                                         VALUES ('$comision_add', '$descrip_comision', '$usermodal_comision')";
        $insercomision = $conexion->prepare($inser_comision);
        $insercomision->execute(); 

            if($insercomision->rowCount() >= 1) 
            {
                echo 1;
            }
            else {
                echo 0;
            }

    break;

    case "add_salario":
        $inser_salario="INSERT INTO `salario`(`id_salario`, `salario_neto`, `descripcion`, `id_usuario`) 
                                        VALUES (NULL,'$salario_add','$descrip_salario','$usermodal_salario')";
        $insersalario = $conexion->prepare($inser_salario);
        $insersalario->execute(); 

        if($insersalario->rowCount() >= 1) 
        {
        echo 2;
        }
        else {
        echo 0;
        }
    break;

    case "guardar_planilla":

        $consul_salario_id = "SELECT `id_salario` FROM `salario` WHERE `salario_neto` = '$id_salario'";
        $consulsalarioid = $conexion->prepare($consul_salario_id);
        $consulsalarioid->execute(); 
  
        foreach ($consulsalarioid as $row) 
        {
        $idsalario = $row['id_salario'];
        }

        $inser_planilla="INSERT INTO `planilla_pago`(`id_plani_pago`, `id_usuario_v`, `id_por_comi`, `id_salario`, `comision`, `total_neto`, `fecha_realizada`, `fech_ran_1`, `fech_ran_2`, `id_usuario`)
                                                         VALUES (NULL, '$id_usuario_v', '$id_por_comi', '$idsalario', '$comision', '$total_neto', '$fech_ingre', '$fech_ran_1', '$fech_ran_2', '$id_usuario')";
        $inserplanilla = $conexion->prepare($inser_planilla);
        $inserplanilla->execute(); 

        if($inserplanilla->rowCount() >= 1) 
        {
        echo 1;
        }
        else {
        echo 0;
        }

    break;
}
$conexion=null;
?>