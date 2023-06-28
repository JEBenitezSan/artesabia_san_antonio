<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

date_default_timezone_set('America/Managua');
$fecha_hoy = date("Y-m-d 00:00:00");
$fecha_despues = date("Y-m-d 23:59:59");

/// Abrir caja
$usermodal_caja = (isset($_POST['usermodal_caja'])) ? $_POST['usermodal_caja'] : '';
$salgo_inici_caja = (isset($_POST['salgo_inici_caja'])) ? $_POST['salgo_inici_caja'] : '';
$estado_caja = (isset($_POST['estado_caja'])) ? $_POST['estado_caja'] : ''; /// Vaiable reutilizada

/// Salida caja
$user_salida_caj = (isset($_POST['user_salida_caj'])) ? $_POST['user_salida_caj'] : '';
$gasto_salida = (isset($_POST['gasto_salida'])) ? $_POST['gasto_salida'] : '';
$descrip_salida = (isset($_POST['descrip_salida'])) ? $_POST['descrip_salida'] : '';
$monto_salida = (isset($_POST['monto_salida'])) ? $_POST['monto_salida'] : '';

/// Cerrar caja
$monto_cerrar_caja = (isset($_POST['monto_cerrar_caja'])) ? $_POST['monto_cerrar_caja'] : '';
$monto_final_caja = (isset($_POST['monto_final_caja'])) ? $_POST['monto_final_caja'] : '';
$descripcion_cerrarcaja = (isset($_POST['descripcion_cerrarcaja'])) ? $_POST['descripcion_cerrarcaja'] : '';
$usermodal_caja_cerrar = (isset($_POST['usermodal_caja_cerrar'])) ? $_POST['usermodal_caja_cerrar'] : '';
$id_caja = (isset($_POST['id_caja'])) ? $_POST['id_caja'] : '';

/// Cofirmar factura
$num_fact_comfir = (isset($_POST['num_fact_comfir'])) ? $_POST['num_fact_comfir'] : '';
$estado_con_fac = (isset($_POST['estado_con_fac'])) ? $_POST['estado_con_fac'] : '';

/// caja widgets

/// Lista de salida de caja
$id_caja_abirta = (isset($_POST['id_caja_abirta'])) ? $_POST['id_caja_abirta'] : '';

$opc_caja = (isset($_POST['opc_caja'])) ? $_POST['opc_caja'] : '';

switch($opc_caja) 
{
    case "lista_caja":

        $consul_caja="SELECT 
                        `caja`.`id_caja`, 
                        `caja`.`monto_inicial_caja`,
                        `caja`.`monto_final_caja`,
                        `caja`.`fecha_apertuta_caja`,
                        `caja`.`fecha_cerrar_caja`,
                        `caja`.`total_cierre_caja`,
                        `caja`.`estado_caja`,
                        `usuarios`.`usuario`, 
                        `admin_user`.`nombres_user`,
                        `caja`.`descrip_cerrar_caja`

                        FROM `caja` 
                            LEFT JOIN `usuarios` ON `caja`.`id_usuario` = `usuarios`.`id_usuario` 
                            LEFT JOIN `admin_user` ON `admin_user`.`id_usuario` = `usuarios`.`id_usuario`
                            WHERE (`caja`.`fecha_apertuta_caja` >= '$fecha_hoy') and (`caja`.`fecha_apertuta_caja` <= '$fecha_despues')";
        $caja_lis = $conexion->prepare($consul_caja);
        $caja_lis->execute(); 
        
		$data = $caja_lis->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "lista_caja_anteriores":

        $consul_caja="SELECT 
                        `caja`.`id_caja`, 
                        `caja`.`monto_inicial_caja`,
                        `caja`.`monto_final_caja`,
                        `caja`.`fecha_apertuta_caja`,
                        `caja`.`fecha_cerrar_caja`,
                        `caja`.`total_cierre_caja`,
                        `caja`.`estado_caja`,
                        `usuarios`.`usuario`, 
                        `admin_user`.`nombres_user`,
                        `caja`.`descrip_cerrar_caja`

                        FROM `caja` 
                            LEFT JOIN `usuarios` ON `caja`.`id_usuario` = `usuarios`.`id_usuario` 
                            LEFT JOIN `admin_user` ON `admin_user`.`id_usuario` = `usuarios`.`id_usuario`";
        $caja_lis = $conexion->prepare($consul_caja);
        $caja_lis->execute(); 
        
		$data = $caja_lis->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "abrir_caja":

        $consul_abiert= "SELECT `id_caja` FROM `caja` WHERE `estado_caja` = 'Abierto'";
        $resultado_caj = $conexion->prepare($consul_abiert);
        $resultado_caj->execute();

        $caja_abierta = 0;
        foreach ($resultado_caj as $row) 
        {
        $caja_abierta = $row['id_caja'];
        }
  
        if ($caja_abierta >= 1) 
        {echo 0;}

        if ($caja_abierta <= 0)
        {
            $consulta="INSERT INTO `caja`(`id_caja`, `monto_inicial_caja`, `monto_final_caja`, `fecha_apertuta_caja`, `fecha_cerrar_caja`, `total_cierre_caja`, `estado_caja`, `id_usuario`, `descrip_cerrar_caja`, `id_usuario_cerro`)
            VALUES (NULL, '$salgo_inici_caja', NULL, '$fech_ingre ', NULL, NULL, '$estado_caja', '$usermodal_caja', NULL, NULL)";
           $proveedor = $conexion->prepare($consulta);
           $proveedor->execute(); 
           if($proveedor->rowCount() >= 1) 
           {
            echo 1;
           } else {
                  echo 0;
                 }

        }

    break;

    case "salida_caja":

        $consul_abiert= "SELECT `id_caja` FROM `caja` WHERE `estado_caja` = 'Abierto'";
        $resultado_caj = $conexion->prepare($consul_abiert);
        $resultado_caj->execute();

        $caja_abierta = 0;
        foreach ($resultado_caj as $row) 
        {
        $caja_abierta = $row['id_caja'];
        }
  
        if ($caja_abierta >= 1) 
        {
            $insertar_sali= "INSERT INTO `salida`
            (`id_salida`, `tipo_salida`, `descripcion_salida`, `monto_salida`, `id_usuario_salida`, `id_caja`,`fecha_salida`) 
            VALUES (null,'$gasto_salida','$descrip_salida','$monto_salida','$user_salida_caj','$caja_abierta','$fech_ingre')";
            $resultado = $conexion->prepare($insertar_sali);
            $resultado->execute();   

            if($resultado->rowCount() >= 1)
            {
                echo 1;
            }
            else {echo 0;} 
        }

        if ($caja_abierta <= 0)
        {
            echo 0;
        }

    break;

    case "cerrar_caja":
        $update_bd = "UPDATE `caja` SET
         `monto_final_caja`= '$monto_cerrar_caja ',
         `fecha_cerrar_caja`= '$fech_ingre',
         `total_cierre_caja`= '$monto_final_caja',
         `estado_caja` = '$estado_caja',
         `descrip_cerrar_caja` = '$descripcion_cerrarcaja',
         `id_usuario_cerro` = '$usermodal_caja_cerrar'
          WHERE `id_caja` = '$id_caja'";

        $resultado = $conexion->prepare($update_bd);
        $resultado->execute(); 

        if($resultado->rowCount() >= 1)
        {echo 1;}

        else {echo 0;}

    break;

    case "caja_widgets":

        $consul_widg= "SELECT `id_caja` FROM `caja` WHERE `estado_caja` = 'Abierto'";
        $resultado_widg = $conexion->prepare($consul_widg);
        $resultado_widg->execute();

        $caja_abierta = 0;
        foreach ($resultado_widg as $row) 
        {
        $caja_abierta = $row['id_caja'];
        }
  
        if ($caja_abierta <= 0) 
        {echo 0;}

        if ($caja_abierta >= 1)
        {
           $consulta_consul_widgets="SELECT 
                    
          TRUNCATE( (SUM( (`detalle_factura`.`prec_venta_detall`) * (`detalle_factura`.`cant_detall`) ))
          - ( SELECT SUM(`factura`.`total_descuent`) FROM `factura` WHERE `factura`.`id_caja` = '$caja_abierta'),3) AS `prec_venta_detall`,  
   
          SUM( (`cat_precio`.`prec_compra`) * (`detalle_factura`.`cant_detall`) ) AS 'capital',

          TRUNCATE( 
            SUM( (`detalle_factura`.`prec_venta_detall` - `cat_precio`.`prec_compra`) * (`detalle_factura`.`cant_detall`) ) -
          (SELECT SUM(`factura`.`total_descuent`) FROM `factura` WHERE `factura`.`id_caja` = '$caja_abierta') + 
          (SELECT TRUNCATE( SUM(`total_fac_neto`), 3) AS `tota_servi` FROM `factura`
           WHERE `tipo_factura` ='Servicio' AND `id_caja` ='$caja_abierta'), 3) AS 'utilidad',

          TRUNCATE( (SELECT SUM(`monto_salida`) FROM `salida` WHERE `id_caja` = '$caja_abierta'), 3) AS `salida`,

          TRUNCATE( ( SUM((`detalle_factura`.`prec_venta_detall`) * (`detalle_factura`.`cant_detall`)) - 
            (SELECT SUM(`factura`.`total_descuent`) FROM `factura` WHERE `factura`.`id_caja` = '$caja_abierta') ), 3) AS `total_efectivo_caja`

                 FROM `factura` 
                     LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura` 
                     LEFT JOIN `stock_productos` ON `detalle_factura`.`id_stock_produc` = `stock_productos`.`id_stock_produc` 
                     LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_produc`
                     
                     WHERE `cat_precio`.`id_precio` = (SELECT MAX(`cat_precio`.`id_precio`) FROM `cat_precio` WHERE `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_produc`) AND 
                      `factura`.`id_caja` = '$caja_abierta'";
           $consul_widgets = $conexion->prepare($consulta_consul_widgets);
           $consul_widgets->execute(); 

            $data = $consul_widgets->fetchAll(PDO::FETCH_ASSOC);
            print json_encode($data, JSON_UNESCAPED_UNICODE);

        }


    break;

    case "caja_entradas_fac":

        $consul_widg= "SELECT `id_caja` FROM `caja` WHERE `estado_caja` = 'Abierto'";
        $resultado_widg = $conexion->prepare($consul_widg);
        $resultado_widg->execute();

        $caja_abierta = 0;
        foreach ($resultado_widg as $row) 
        {
        $caja_abierta = $row['id_caja'];
        }

           $consulta_entradas_fac="SELECT 
           `factura`.`id_num_factura`,
           `factura`.`tipo_factura`,
           `cliente`.`id_cliente`,
            CONCAT(`nombre_cliente`,' ',`apellido_cliente`) `nombre_apellido`,
            SUM(`detalle_factura`.`cant_detall`) AS `cant_detall`,
            `factura`.`total_factura`,
            `factura`.`total_descuent`,
            `factura`.`total_fac_neto`,
            `factura`.`efectivo`,
            `factura`.`vuelto_fac`,
            `factura`.`confirma_caja`,
            `usuarios`.`usuario`
            
            FROM `cliente` 
            LEFT JOIN `factura` ON `factura`.`id_cliente` = `cliente`.`id_cliente` 
            LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura` 
            LEFT JOIN `stock_productos` ON `detalle_factura`.`id_stock_produc` = `stock_productos`.`id_stock_produc`
            LEFT JOIN `usuarios` ON `factura`.`id_usuario` = `usuarios`.`id_usuario`
              
              WHERE (`factura`.`id_caja` = '$caja_abierta')
              GROUP BY `factura`.`id_num_factura`, `cliente`.`id_cliente`";
           $consul_entradas_fac = $conexion->prepare($consulta_entradas_fac);
           $consul_entradas_fac->execute(); 
           
            $data = $consul_entradas_fac -> fetchAll(PDO::FETCH_ASSOC);
            print json_encode($data, JSON_UNESCAPED_UNICODE);


    break;

    case "confirmar_fac":

        $update_confirmar="UPDATE `factura` SET `confirma_caja`='$estado_con_fac' 
        WHERE `id_num_factura` = '$num_fact_comfir' ";
        $consul_update_confirmar = $conexion->prepare($update_confirmar);
        $consul_update_confirmar->execute();
        
        if($consul_update_confirmar->rowCount() >= 1)
        {
            echo 1;
        }

        else {
            echo 0;
        } 
        

    break;

    case "lista_salida_c":

        $consul_salida_lisc="SELECT 
                    `salida`.`id_salida`,
                    `salida`.`tipo_salida`,
                    `salida`.`descripcion_salida`,
                    `salida`.`monto_salida`,
                    `usuarios`.`usuario`

                    FROM `salida` 
                        LEFT JOIN `usuarios` ON `salida`.`id_usuario_salida` = `usuarios`.`id_usuario`
                        WHERE `id_caja` = '$id_caja_abirta '";
        $caja_lis_salida = $conexion->prepare($consul_salida_lisc);
        $caja_lis_salida->execute(); 
        
		$data = $caja_lis_salida->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

}
$conexion=null;
?>
