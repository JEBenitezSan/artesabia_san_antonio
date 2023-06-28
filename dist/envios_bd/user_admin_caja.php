<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';
$num_factura = (isset($_POST['num_factura'])) ? $_POST['num_factura'] : '';
$tipo_fac = (isset($_POST['tipo_fac'])) ? $_POST['tipo_fac'] : '';
/// caja widgets

$opc_fac_user = (isset($_POST['opc_fac_user'])) ? $_POST['opc_fac_user'] : '';

switch($opc_fac_user)
{
    
    case "entradas_fac_user":

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
              
             WHERE (`usuarios`.`id_usuario` = '$id_usuario')
              GROUP BY `factura`.`id_num_factura`, `cliente`.`id_cliente`";
           $consul_entradas_fac = $conexion->prepare($consulta_entradas_fac);
           $consul_entradas_fac->execute(); 
           
            $data = $consul_entradas_fac -> fetchAll(PDO::FETCH_ASSOC);
            print json_encode($data, JSON_UNESCAPED_UNICODE);


    break;

    case "detalle_fac":

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

}
$conexion=null;
?>