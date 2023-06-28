<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$cliente_prof = (isset($_POST['cliente_prof'])) ? $_POST['cliente_prof'] : '';
$total_profor = (isset($_POST['total_profor'])) ? $_POST['total_profor'] : ''; 
$condiciones_profor = (isset($_POST['condiciones_profor'])) ? $_POST['condiciones_profor'] : '';

$user = (isset($_POST['user'])) ? $_POST['user'] : '';

$estado = "Generado";

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

        $insertar= "INSERT INTO `proforma`(`fac_proforma`, `id_cliente`, `total_pro`, `condiciones`, `fecha_pro`, `id_usuario`, `estado_profor`) 
                                      VALUES (NULL,'$cliente_prof','$total_profor','$condiciones_profor','$fech_ingre','$user','$estado')";
        $factura = $conexion->prepare($insertar);
        $factura->execute(); 

            if($factura->rowCount() >= 1) 
                {
                    /// Consulta la ultima proforma ingreasada por cada usuario
                    $consulta= "SELECT MAX(`proforma`.`fac_proforma`) AS num_profor
                    FROM  `proforma` WHERE `proforma`.`id_usuario` = '$user' AND  `proforma`.`estado_profor` = '$estado'";
                    $num_proforma = $conexion->prepare($consulta);
                    $num_proforma->execute();
                    foreach ($num_proforma as $row) 
                    { $numpro = $row['num_profor']; }
                    /// ---------------------------///

                    for ($i=0; $i < count($numero); $i++)
                    {
                    $insertar_dell = " INSERT INTO `detalle_proforma`(`id_detalle_profor`, `fac_proforma`, `preventa_pro`, `contidad_pro`, `subtota_pro`, `id_usuario`, `id_stock_producto`, `id_detall_stock_pro`) 
                                 VALUES (NULL,'$numpro','$prec_venta[$i]','$cant_compra[$i]','$total_subcompra[$i]','$user','$id_stock_produc[$i]','$id_detall_stock_pro[$i]')";
                    $detalle_factura = $conexion->prepare($insertar_dell);
                    $detalle_factura->execute(); 
                    }

                    echo 1;
                }

                else {
                    echo 0;
                }

    }

$conexion=null;

?>