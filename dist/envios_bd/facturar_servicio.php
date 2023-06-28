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

$condiciones_fac_servi = (isset($_POST['condiciones_fac_servi'])) ? $_POST['condiciones_fac_servi'] : '';
$tipo_fac = 'Servicio';

$estado_fact = 'Pendiente';

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

/// datos array precio_venta
$id_servicio = (isset($_POST['id_servicio'])) ? $_POST['id_servicio'] : '';  
$cod_barra = (isset($_POST['cod_barra'])) ? $_POST['cod_barra'] : '';  
$cant_stock = (isset($_POST['cant_stock'])) ? $_POST['cant_stock'] : '';  
$prec_venta = (isset($_POST['prec_venta'])) ? $_POST['prec_venta'] : '';  
$total_subcompra = (isset($_POST['total_subcompra'])) ? $_POST['total_subcompra'] : ''; 
$id_detall_stock_pro = (isset($_POST['id_detall_stock_pro'])) ? $_POST['id_detall_stock_pro'] : ''; 

$cantidad = 1; 

$numero = (isset($_POST['id_servicio'])) ? $_POST['id_servicio'] : '';  

$consulta= "SELECT `id_caja` FROM `caja` WHERE `estado_caja` = 'Abierto'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$caja_abierta = 0;
foreach ($resultado as $row) 
{
$caja_abierta = $row['id_caja'];
}

if ($caja_abierta <= 0) 
{
   echo 0;
}

if ($caja_abierta >= 1)
{

        $insertar= "INSERT INTO `factura`(`id_num_factura`, `id_cliente`, `total_factura`, `total_descuent`, `total_fac_neto`, `efectivo`, `vuelto_fac`, `fecha_factura`, `condiciones_fac`, `id_usuario`, `id_cant_porcendes`,`id_caja`,`confirma_caja`,`tipo_factura`) 
                    VALUES (NULL,'$cliente_fac','$total_fac_com','$total_fac_descuen','$total_fac_neto','$efectivo_fac','$vuelto_cliente','$fech_ingre','$condiciones_fac_servi','$user','$decuento_apli','$caja_abierta','$estado_fact','$tipo_fac')";
        $factura = $conexion->prepare($insertar);
        $factura->execute(); 

            if($factura->rowCount() >= 1) 
                {
                    /// Consulta la ultima factura ingreasada por cada usuario
                    $consulta= "SELECT MAX(`factura`.`id_num_factura`) AS num_fac
                    FROM  `factura` WHERE `factura`.`id_usuario` = $user";
                    $num_factura = $conexion->prepare($consulta);
                    $num_factura->execute();
                    foreach ($num_factura as $row) 
                    { $numfac = $row['num_fac']; }
                    /// ---------------------------///

                    for ($i=0; $i < count($numero); $i++)
                    {
                    $insertar_dell = "INSERT INTO 
                    `detalle_factura`(`id_detall_factura`, `id_num_factura`, `id_servicio`, `prec_venta_detall`, `cant_detall`, `sub_total`, `id_usuario`,`id_detall_stock_pro`)
                                                VALUES (NULL, '$numfac', '$id_servicio[$i]', '$total_subcompra[$i]', '$cantidad', '$total_subcompra[$i]', '$user', NULL)";
                    $detalle_factura = $conexion->prepare($insertar_dell);
                    $detalle_factura->execute(); 

                        if($factura->rowCount() >= 1) {

                            /// update de el stock restarle la cantidad comprada

                            $consulta = "UPDATE `servicios` SET `estado`='Entregado'
                            WHERE `id_servicio` = '$id_servicio[$i]'";
                            $actualizacion = $conexion->prepare($consulta);
                            $actualizacion->execute();
                            

                        }


                    }

                    echo 1;
                }

                else {
                    echo 0;
                }

}

$conexion=null;

?>