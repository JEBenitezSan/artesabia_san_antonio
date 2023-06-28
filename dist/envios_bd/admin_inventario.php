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



$opc_invet = (isset($_POST['opc_invet'])) ? $_POST['opc_invet'] : '';

switch($opc_invet) 
{
    case "":
    break;

    case "lista_invent":
        $invent_productos="SELECT 
                                `stock_productos`.`id_stock_produc`,
                                `stock_productos`.`cod_barra`,
                                `stock_productos`.`nombre_product`,
                                `detalle_stock_product`.`cant_producto`,
                                `cat_precio`.`prec_venta`,
                                (`detalle_stock_product`.`cant_producto`) * (`cat_precio`.`prec_venta`) AS `subtotal_brut`,
                                `cat_precio`.`prec_compra`,
                                (`detalle_stock_product`.`cant_producto`) * (`cat_precio`.`prec_compra`) AS `subtotal_cap`,
                                `proveedor`.`nom_proveedor`, 
                                `categoria_producto`.`categoria`,
                                `cat_precio`.`porcen_utili`,
                                ( (`detalle_stock_product`.`cant_producto`) * (`cat_precio`.`prec_venta`) - 
                                (`detalle_stock_product`.`cant_producto`) * (`cat_precio`.`prec_compra`) ) AS `gran_utili`
        
        FROM `stock_productos` 
            LEFT JOIN `detalle_stock_product` ON `detalle_stock_product`.`id_stock_produc` = `stock_productos`.`id_stock_produc`  
            LEFT JOIN `proveedor` ON `detalle_stock_product`.`id_proveedor` = `proveedor`.`id_proveedor` 
            LEFT JOIN `categoria_producto` ON `detalle_stock_product`.`id_categoria_produc` = `categoria_producto`.`id_categoria_produc` 
            LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_produc`
            
            WHERE `cat_precio`.`id_precio` = (SELECT MAX(`cat_precio`.`id_precio`) FROM `cat_precio` WHERE `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_produc`)
            ORDER BY `stock_productos`.`cod_barra` ASC";
        $inventproductos = $conexion->prepare($invent_productos);
        $inventproductos->execute(); 
        
		$data = $inventproductos->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "":
    break;

    case "":
    break;
}

$conexion=null;
?>