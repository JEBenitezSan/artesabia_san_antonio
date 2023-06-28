<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");


/// Numero de factura para determinar el detalle cargado a la factura
$num_factura = (isset($_POST['num_factura'])) ? $_POST['num_factura'] : '';
$tipo_fac = (isset($_POST['tipo_fac'])) ? $_POST['tipo_fac'] : '';

/// Datos para el update de detalle de factura de forma unitaria
$id_detall_factura = (isset($_POST['id_detall_factura'])) ? $_POST['id_detall_factura'] : '';
$id_num_factura = (isset($_POST['id_num_factura'])) ? $_POST['id_num_factura'] : '';
$cod_barra = (isset($_POST['cod_barra'])) ? $_POST['cod_barra'] : '';
$nombre_product = (isset($_POST['nombre_product'])) ? $_POST['nombre_product'] : '';
$prec_venta_detall = (isset($_POST['prec_venta_detall'])) ? $_POST['prec_venta_detall'] : '';

$cant_detall = (isset($_POST['cant_detall'])) ? $_POST['cant_detall'] : '';
$sub_total = (isset($_POST['sub_total'])) ? $_POST['sub_total'] : '';

$id_detall_stock_pro = (isset($_POST['id_detall_stock_pro'])) ? $_POST['id_detall_stock_pro'] : '';
$user_editardell = (isset($_POST['user_editardell'])) ? $_POST['user_editardell'] : '';

$cant_detall_val = (isset($_POST['cant_detall_val'])) ? $_POST['cant_detall_val'] : ''; // Validar si es mayor o menor



$tipo_factura_editar = (isset($_POST['tipo_factura_editar'])) ? $_POST['tipo_factura_editar'] : ''; 
$opc_fac = (isset($_POST['opc_fac'])) ? $_POST['opc_fac'] : '';

switch($opc_fac) 
{
    case "detalle_factura":
        switch($tipo_fac) 
        {
           case "Producto":
                $consulta_dellfac="SELECT 
                            `detalle_factura`.`id_detall_factura`,
                            `detalle_factura`.`id_num_factura`,
                            `stock_productos`.`cod_barra`,
                            `stock_productos`.`nombre_product`,
                            `detalle_factura`.`prec_venta_detall`,
                            `detalle_factura`.`cant_detall`,
                            `detalle_factura`.`sub_total`,
                            `detalle_factura`.`id_detall_stock_pro`
                            FROM `stock_productos` 
                            LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_stock_produc` = `stock_productos`.`id_stock_produc` 
                            LEFT JOIN `factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura`
                            WHERE (`detalle_factura`.`id_num_factura` = '$num_factura') AND (`factura`.`tipo_factura` = '$tipo_fac')";
                $consul_dellfac = $conexion->prepare($consulta_dellfac);
                $consul_dellfac->execute(); 
                
                $data = $consul_dellfac -> fetchAll(PDO::FETCH_ASSOC);
                print json_encode($data, JSON_UNESCAPED_UNICODE);
           break;
           case "Servicio":
                $consultadellfac="SELECT 
                            `detalle_factura`.`id_detall_factura`,
                            `detalle_factura`.`id_num_factura`,
                            `tipo_servicios`.`tipo_servicio` AS `cod_barra`,
                            `servicios`.`observaciones` AS `nombre_product`, 
                            `detalle_factura`.`prec_venta_detall`,
                            `detalle_factura`.`cant_detall`,
                            `detalle_factura`.`sub_total`,
                            `factura`.`tipo_factura` AS `id_detall_stock_pro`
                            
                            FROM `tipo_servicios` 
                            LEFT JOIN `servicios` ON `servicios`.`id_tiposervicio` = `tipo_servicios`.`id_tiposervicio` 
                            LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_servicio` = `servicios`.`id_servicio` 
                            LEFT JOIN `factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura`
                            WHERE (`detalle_factura`.`id_num_factura` = '$num_factura') AND (`factura`.`tipo_factura` = '$tipo_fac')";
                $consuldellfac = $conexion->prepare($consultadellfac);
                $consuldellfac->execute(); 

                $data = $consuldellfac -> fetchAll(PDO::FETCH_ASSOC);
                print json_encode($data, JSON_UNESCAPED_UNICODE);
           break;
        }

        
    break;


    case "editar_detalle":

            switch($tipo_factura_editar) 
            {
                case "Producto":  
                    //  Validar si la cantidad introducida sea menor que el stock actual
                        $update_dellfac="UPDATE `detalle_factura` SET `cant_detall`='$cant_detall',
                                        `sub_total`='$sub_total',
                                        `id_usuario`='$user_editardell'
                        WHERE `id_detall_factura` = '$id_detall_factura'";
                        $updatedellfac = $conexion->prepare($update_dellfac);
                        $updatedellfac->execute(); 

                        if($updatedellfac->rowCount() >= 1) 
                        {   /// Consulto el stock disponible que hay en el detalle stock
                            $consul_dell_sock="SELECT `cant_producto` FROM `detalle_stock_product`
                            WHERE `id_detall_stock_pro` = '$id_detall_stock_pro'";
                            $consulta_dellstock = $conexion->prepare($consul_dell_sock);
                            $consulta_dellstock->execute(); 
                            $cant_stock_dell = 0;
                        foreach ($consulta_dellstock as $row) 
                        {
                            $cant_stock_dell = $row['cant_producto'];
                        }

                        /// Se valida si el que introduce el usuario es mayor o menor para cambiar la variable y saber si sumar o restar al stock detalle
                        if($cant_detall > $cant_detall_val)
                        {
                            $newstockdetalle = $cant_detall - $cant_detall_val; 
                            $new_stock_detalle = $cant_stock_dell - $newstockdetalle; 
                        }

                        else if ($cant_detall < $cant_detall_val)
                        {
                            $newstockdetalle = $cant_detall_val - $cant_detall; 
                            $new_stock_detalle = $cant_stock_dell + $newstockdetalle; 
                        }

                        else if ($cant_detall = $cant_detall_val)
                        {
                            $new_stock_detalle = $cant_detall_val;
                        }
                        /// Update al detalle de stock
                        $update_dell_sock="UPDATE `detalle_stock_product` SET `cant_producto`='$new_stock_detalle'
                                            WHERE `id_detall_stock_pro` = '$id_detall_stock_pro'";
                        $updatedellstock = $conexion->prepare($update_dell_sock);
                        $updatedellstock->execute(); 
                        if($updatedellstock->rowCount() >= 1) 
                        { 

                                /// Consulto el detalle factura a editar para tener referencia de las validaciones de restar o agregar a los totales
                                $consul_dell_FAC="SELECT  `id_num_factura`, SUM(`prec_venta_detall`) AS `prec_venta_detall`, SUM(`sub_total`) AS `sub_total`
                                                    FROM `detalle_factura` 
                                                    WHERE `id_num_factura` = '$id_num_factura'
                                                    GROUP BY `id_num_factura`";
                                $consulta_dellFAC = $conexion->prepare($consul_dell_FAC);
                                $consulta_dellFAC->execute(); 

                                foreach ($consulta_dellFAC as $row) 
                                {
                                    $id_num_factura_d = $row['id_num_factura'];
                                    $prec_venta_detall = $row['prec_venta_detall'];
                                    $sub_total = $row['sub_total'];
                                }

                                /// Consulto la factura a editar para tener referencia de las validaciones de restar o agregar a los totales
                                $consul_FAC="SELECT `id_num_factura`, `total_factura`, `total_descuent`, `total_fac_neto`, `efectivo`, `vuelto_fac`, `id_cant_porcendes`
                                            FROM `factura`
                                            WHERE `id_num_factura` = '$id_num_factura'";
                                $consulta_FAC = $conexion->prepare($consul_FAC);
                                $consulta_FAC->execute(); 

                                foreach ($consulta_FAC as $row) 
                                {
                                    $id_num_factura_f = $row['id_num_factura'];
                                    $total_factura = $row['total_factura'];
                                    $total_descuent = $row['total_descuent'];
                                    $total_fac_neto = $row['total_fac_neto'];
                                    $efectivo = $row['efectivo'];
                                    $vuelto_fac = $row['vuelto_fac'];
                                    $id_cant_porcendes = $row['id_cant_porcendes'];
                                }

                                $desc_edit = $sub_total/100 * $id_cant_porcendes;
                                $tota_desc_edit = $sub_total - $desc_edit;

                                $vuelto_edit = $efectivo - $tota_desc_edit;




                                $Update_FAC="UPDATE `factura` SET `total_factura`=' $sub_total',
                                        `total_descuent`='$desc_edit',
                                        `total_fac_neto`='$tota_desc_edit',
                                        `vuelto_fac`='$vuelto_edit'
                                WHERE `id_num_factura` = $id_num_factura";
                                $UpdateFAC = $conexion->prepare($Update_FAC);
                                $UpdateFAC->execute(); 

                                if($UpdateFAC->rowCount() >= 1) 
                                {
                                    $sum_stock="SELECT `id_detall_stock_pro`, SUM(`cant_producto`) AS `cant_producto`
                                                FROM `stock_productos` 
                                                LEFT JOIN `detalle_stock_product` ON `detalle_stock_product`.`id_stock_produc` = `stock_productos`.`id_stock_produc`
                                                WHERE `stock_productos`.`cod_barra` = '$cod_barra'";
                                    $sumstock = $conexion->prepare($sum_stock);
                                    $sumstock->execute(); 

                                    foreach ($sumstock as $row) 
                                    {
                                        $id_detall_stock_pro = $row['id_detall_stock_pro'];
                                        $cant_producto = $row['cant_producto'];
                                    }

                                    $Update_soctk="UPDATE `stock_productos` SET `cant_stock`='$cant_producto' 
                                                    WHERE `cod_barra` = $cod_barra";
                                    $Updatesoctk = $conexion->prepare($Update_soctk);
                                    $Updatesoctk->execute(); 
                                        
                                    if($Updatesoctk->rowCount() >= 1) 
                                    {
                                        echo 1;
                                    }
                                    else {
                                        echo 0;
                                    }

                                }

                        }
                        else { echo 0; }
                        } 
                        else{
                        echo 0;
                        }
                break;

                case "Servicio":
                    $update_dellfac="UPDATE `detalle_factura` SET 
                                    `prec_venta_detall`='$prec_venta_detall',
                                    `cant_detall`='$cant_detall',
                                    `sub_total`='$sub_total',
                                    `id_usuario`='$user_editardell'
                                     WHERE `id_detall_factura` = '$id_detall_factura'";
                    $updatedellfac = $conexion->prepare($update_dellfac);
                    $updatedellfac->execute(); 

                    if($updatedellfac->rowCount() >= 1) 
                    {   

                                        /// Consulto el detalle factura a editar para tener referencia de las validaciones de restar o agregar a los totales
                                        $consul_dell_FAC="SELECT  `id_num_factura`, SUM(`prec_venta_detall`) AS `prec_venta_detall`, SUM(`sub_total`) AS `sub_total`
                                                            FROM `detalle_factura` 
                                                            WHERE `id_num_factura` = '$id_num_factura'
                                                            GROUP BY `id_num_factura`";
                                        $consulta_dellFAC = $conexion->prepare($consul_dell_FAC);
                                        $consulta_dellFAC->execute(); 

                                        foreach ($consulta_dellFAC as $row) 
                                        {
                                            $id_num_factura_d = $row['id_num_factura'];
                                            $prec_venta_detall = $row['prec_venta_detall'];
                                            $sub_total = $row['sub_total'];
                                        }

                                        /// Consulto la factura a editar para tener referencia de las validaciones de restar o agregar a los totales
                                        $consul_FAC="SELECT `id_num_factura`, `total_factura`, `total_descuent`, `total_fac_neto`, `efectivo`, `vuelto_fac`, `id_cant_porcendes`
                                                    FROM `factura`
                                                    WHERE `id_num_factura` = '$id_num_factura'";
                                        $consulta_FAC = $conexion->prepare($consul_FAC);
                                        $consulta_FAC->execute(); 

                                        foreach ($consulta_FAC as $row) 
                                        {
                                            $id_num_factura_f = $row['id_num_factura'];
                                            $total_factura = $row['total_factura'];
                                            $total_descuent = $row['total_descuent'];
                                            $total_fac_neto = $row['total_fac_neto'];
                                            $efectivo = $row['efectivo'];
                                            $vuelto_fac = $row['vuelto_fac'];
                                            $id_cant_porcendes = $row['id_cant_porcendes'];
                                        }

                                        $desc_edit = $sub_total/100 * $id_cant_porcendes;
                                        $tota_desc_edit = $sub_total - $desc_edit;

                                        $vuelto_edit = $efectivo - $tota_desc_edit;


                                        $Update_FAC="UPDATE `factura` SET `total_factura`=' $sub_total',
                                                `total_descuent`='$desc_edit',
                                                `total_fac_neto`='$tota_desc_edit',
                                                `vuelto_fac`='$vuelto_edit'
                                        WHERE `id_num_factura` = $id_num_factura";
                                        $UpdateFAC = $conexion->prepare($Update_FAC);
                                        $UpdateFAC->execute(); 

                                        if($UpdateFAC->rowCount() >= 1) 
                                        {
                                            echo 1;
                                        }
                                        else {
                                            echo 0;
                                        }

                    }

                        else { 
                            echo 0;
                         }
                 
                break;
            }


    break;

    case "caja_entradas_fac":

    break;



}
$conexion=null;
?>