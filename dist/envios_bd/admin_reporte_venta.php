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
$vende_dor = (isset($_POST['vende_dor'])) ? $_POST['vende_dor'] : '';

/// Datos de panilla empleado
$id_usuario_v = (isset($_POST['id_usuario_v'])) ? $_POST['id_usuario_v'] : '';
$id_por_comi = (isset($_POST['id_por_comi'])) ? $_POST['id_por_comi'] : '';
$id_salario = (isset($_POST['id_salario'])) ? $_POST['id_salario'] : '';
$comision = (isset($_POST['comision'])) ? $_POST['comision'] : '';
$total_neto = (isset($_POST['total_neto'])) ? $_POST['total_neto'] : '';
$fech_ran_1 = (isset($_POST['fech_ran_1'])) ? $_POST['fech_ran_1'] : '';
$fech_ran_2 = (isset($_POST['fech_ran_2'])) ? $_POST['fech_ran_2'] : '';
$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';

// Data para detalle de factura
$idfactura = (isset($_POST['idfactura'])) ? $_POST['idfactura'] : '';

// Data para el borrar producto y revertirlo
$id_detalle_fac = (isset($_POST['id_detalle_fac'])) ? $_POST['id_detalle_fac'] : '';
$cod_barra = (isset($_POST['cod_barra'])) ? $_POST['cod_barra'] : '';
$cantidad_rever = (isset($_POST['cantidad_rever'])) ? $_POST['cantidad_rever'] : '';
$num_factura_deta = (isset($_POST['num_factura_deta'])) ? $_POST['num_factura_deta'] : '';


/// Opc de switch valida que opc ejecutar 
$opc_repor_vta = (isset($_POST['opc_repor_vta'])) ? $_POST['opc_repor_vta'] : '';

switch($opc_repor_vta) 
{
    case "lista_repor_venta":

        $repor_venta="SELECT
        `factura`.`id_num_factura`,
        CONCAT(`cliente`.`nombre_cliente`,' ',`cliente`.`apellido_cliente`) AS `nom_cliente`,
        `factura`.`total_factura`,
        `factura`.`total_descuent`,
        `factura`.`total_fac_neto`,
        `factura`.`id_cant_porcendes`,
        `usuarios`.`usuario`
        
        FROM `factura` 
            LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura` 
            LEFT JOIN `stock_productos` ON `detalle_factura`.`id_stock_productos` = `stock_productos`.`id_stock_productos` 
            LEFT JOIN `cliente` ON `factura`.`id_cliente` = `cliente`.`id_cliente` 
            LEFT JOIN `usuarios` ON `cliente`.`id_usuario` = `usuarios`.`id_usuario`
            
            WHERE (`factura`.`fecha_factura` >= '$fecha_1') AND (`factura`.`fecha_factura` <= '$fecha_2') 
            GROUP BY `factura`.`id_num_factura`";

        $reporte_venta = $conexion->prepare($repor_venta);
        $reporte_venta->execute(); 
        
		$data = $reporte_venta->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case"detalle_fac":

        $detalle_fact="SELECT 
                        `detalle_factura`.`id_detall_factura`,
                        `detalle_factura`.`id_num_factura`,
                        `stock_productos`.`cod_barra`,
                        `stock_productos`.`nom_producto`,
                        `detalle_factura`.`prec_venta_detall`,
                        `detalle_factura`.`cant_detall`,
                        `detalle_factura`.`sub_total`
                        
                        FROM `detalle_factura` 
                            LEFT JOIN `stock_productos` ON `detalle_factura`.`id_stock_productos` = `stock_productos`.`id_stock_productos`
                            WHERE `detalle_factura`.`id_num_factura` = ?";
        $detallefact = $conexion->prepare($detalle_fact);
        $detallefact->execute([$idfactura]); 
        
		$data = $detallefact->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "borrar_producto_fac":

        $delete_detalle_fac="DELETE FROM `detalle_factura` WHERE `id_detall_factura` = ?";
        $delete_detallefac = $conexion->prepare($delete_detalle_fac);
        $delete_detallefac->execute([$id_detalle_fac]); 

        if($delete_detallefac->rowCount() >= 1) 
        {
            $total_factura="SELECT SUM(`sub_total`) AS `nuevo_total_fac` FROM `detalle_factura` WHERE `id_num_factura` = ?";
            $totalfactura = $conexion->prepare($total_factura);
            $totalfactura->execute([$num_factura_deta]); 
            $totalfac_nuevo = 0;
            foreach ( $totalfactura as $rowsum) { 
                $totalfac_nuevo = $rowsum['nuevo_total_fac'];
            }

            $fac_consul="SELECT `efectivo`, `id_cant_porcendes` FROM `factura` WHERE `id_num_factura` = ?";
            $facconsul = $conexion->prepare($fac_consul);
            $facconsul->execute([$num_factura_deta]); 

            $id_cantporcen = 0; $efectivo = 0;
            foreach ( $facconsul as $row_fac) { 
                $efectivo = $row_fac['efectivo'];
                $id_cantporcen = $row_fac['id_cant_porcendes'];
            }

            $consul_stock_exist="SELECT `cantidad` FROM `stock_productos` WHERE `cod_barra` = ?";
            $consul_stockexist = $conexion->prepare($consul_stock_exist);
            $consul_stockexist->execute([$cod_barra]);
            $cant_existe = 0; 
            foreach ( $consul_stockexist as $row) {
                $cant_existe = $row['cantidad'];
            }
             $nuevo_cantidad = $cant_existe + $cantidad_rever;

            $update_stock="UPDATE `stock_productos` SET `cantidad`= ? WHERE `cod_barra` = ?";
            $updatestock = $conexion->prepare($update_stock);
            $updatestock->execute([$nuevo_cantidad, $cod_barra]);
            if($updatestock->rowCount() >= 1) 
            {
                // Calculo de descuento para actualizar factura principal
                $tota_descuento = ($totalfac_nuevo/100)*$id_cantporcen;
                $total_facneto = $totalfac_nuevo - $tota_descuento;
                $efectivo_dado = $efectivo - $total_facneto;
                
                $update_fac_totales="UPDATE `factura` SET `total_factura`= ?,
                                                          `total_descuent`= ?,
                                                          `total_fac_neto`= ?,
                                                          `vuelto_fac` = ? 
                                                          WHERE `id_num_factura` = ?";
                $update_factotales = $conexion->prepare($update_fac_totales);
                $update_factotales->execute([$totalfac_nuevo, $tota_descuento, $total_facneto, $efectivo_dado, $num_factura_deta]);
                if($update_factotales->rowCount() >= 1) 
                { echo 1;} else { echo "Error 1";}
                 
            } 
            else {
                echo "Error 2";
                }

        } else { echo "Error 3";}
                
    break;

    case "lista_venta_vendedor":

        $repor_venta_vende="SELECT 
        `detalle_factura`.`id_num_factura`,
        `stock_productos`.`cod_barra`,
        `stock_productos`.`nom_producto`,
        `cat_precio`.`prec_compra`,
        `cat_precio`.`prec_venta`,
        `detalle_factura`.`cant_detall`,
        `detalle_factura`.`prec_venta_detall`,
        `detalle_factura`.`sub_total`,
        ((`detalle_factura`.`sub_total`)-(`cat_precio`.`prec_compra`*`detalle_factura`.`cant_detall`)) AS `ganania`,
        `usuarios`.`usuario`
        
        FROM `stock_productos` 
            LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_productos` 
            LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_stock_productos` = `stock_productos`.`id_stock_productos` 
            LEFT JOIN `factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura` 
            LEFT JOIN `usuarios` ON `cat_precio`.`id_usuario` = `usuarios`.`id_usuario`
            
             WHERE  (`factura`.`fecha_factura` >= '$fecha_1') AND (`factura`.`fecha_factura` <= '$fecha_2') AND (`factura`.`id_usuario` = '$vende_dor')
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