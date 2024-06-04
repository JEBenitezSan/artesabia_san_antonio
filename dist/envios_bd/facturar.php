<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$decuento_apli = (isset($_POST['decuento_apli'])) ? $_POST['decuento_apli'] : '';

$cliente_fac = (isset($_POST['cliente_fac'])) ? $_POST['cliente_fac'] : '';
$total_fac_com = (isset($_POST['total_fac_com'])) ? $_POST['total_fac_com'] : ''; 
$total_fac_descuen = (isset($_POST['total_fac_descuen'])) ? $_POST['total_fac_descuen'] : ''; 
$total_fac_neto = (isset($_POST['total_fac_neto'])) ? $_POST['total_fac_neto'] : ''; 
$efectivo_fac = (isset($_POST['efectivo_fac'])) ? $_POST['efectivo_fac'] : ''; 
$user = (isset($_POST['user'])) ? $_POST['user'] : '';
$vuelto_cliente = (isset($_POST['vuelto_cliente'])) ? $_POST['vuelto_cliente'] : '';
$condiciones_fac = (isset($_POST['condiciones_fac'])) ? $_POST['condiciones_fac'] : '';

$estado_fact = 'Pendiente';
$tipo_fac = 'Producto';

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

/// datos array
$id_stock_produc = (isset($_POST['id_stock_produc'])) ? $_POST['id_stock_produc'] : '';  
$cod_barra = (isset($_POST['cod_barra'])) ? $_POST['cod_barra'] : '';  
$cant_stock = (isset($_POST['cant_stock'])) ? $_POST['cant_stock'] : '';  
$prec_venta = (isset($_POST['prec_venta'])) ? $_POST['prec_venta'] : '';  
$cant_compra = (isset($_POST['cant_compra'])) ? $_POST['cant_compra'] : ''; 
$total_subcompra = (isset($_POST['total_subcompra'])) ? $_POST['total_subcompra'] : ''; 
$id_detall_stock_pro = (isset($_POST['id_detall_stock_pro'])) ? $_POST['id_detall_stock_pro'] : ''; 

$numero = (isset($_POST['id_stock_produc'])) ? $_POST['id_stock_produc'] : '';  



$insertar= "INSERT INTO `factura`(`id_num_factura`, `id_cliente`, `total_factura`, `total_descuent`, `total_fac_neto`, `efectivo`, `vuelto_fac`, `fecha_factura`, `condiciones_fac`, `id_usuario`, `id_cant_porcendes`,`confirma_caja`, `tipo_factura`) 
            VALUES (NULL,'$cliente_fac','$total_fac_com','$total_fac_descuen','$total_fac_neto','$efectivo_fac','$vuelto_cliente','$fech_ingre','$condiciones_fac','$user','$decuento_apli',NULL,'$tipo_fac')";
$factura = $conexion->prepare($insertar);
$factura->execute(); 

    if($factura->rowCount() >= 1) 
        {
            /// Consulta la ultima factura ingreasada por cada usuario
            $consulta= "SELECT MAX(`factura`.`id_num_factura`) AS num_fac
            FROM  `factura` WHERE `factura`.`id_usuario` = $user AND  `factura`.`tipo_factura` = '$tipo_fac'";
            $num_factura = $conexion->prepare($consulta);
            $num_factura->execute();
            foreach ($num_factura as $row) 
            { $numfac = $row['num_fac']; }
            /// ---------------------------///

            for ($i=0; $i < count($numero); $i++)
            {
            $insertar_dell = "INSERT INTO 
            `detalle_factura`(`id_detall_factura`, `id_num_factura`, `id_stock_productos`, `prec_venta_detall`, `cant_detall`, `sub_total`, `id_usuario`) 
            VALUES (NULL, '$numfac', '$id_stock_produc[$i]', '$prec_venta[$i]', '$cant_compra[$i]', '$total_subcompra[$i]', '$user')";
            $detalle_factura = $conexion->prepare($insertar_dell);
            $detalle_factura->execute(); 

                if($factura->rowCount() >= 1) {

                    /// update de el stock restarle la cantidad comprada
                    $consulta= "SELECT `id_stock_productos`, `cod_barra`, `cantidad` FROM `stock_productos`
                    WHERE `id_stock_productos`= '$id_stock_produc[$i]'";
                    $stock_productos = $conexion->prepare($consulta);
                    $stock_productos->execute();
        
                    foreach ($stock_productos as $row) 
                    {
                    $stock_actual = $row['cantidad'];
                    }

                    $total_stock = $stock_actual - $cant_compra[$i];

                    $consulta = "UPDATE `stock_productos` SET `cantidad`='$total_stock'
                    WHERE `id_stock_productos` = '$id_stock_produc[$i]'";
                    $actualizacion = $conexion->prepare($consulta);
                    $actualizacion->execute();


                }


            }

            echo 1;
        }

        else {
            echo 0;
        }



$conexion=null;

?>