<?php 
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$user  = $_POST['user'];
$cod_barra  = $_POST['cod_barra']; 
$nom_producto  = $_POST['nom_producto']; 
$cant_product  = $_POST['cant_product'];

$pre_compra  = $_POST['pre_compra']; 
$porcen_utili  = $_POST['porcen_utili'];
$precio_vta  = $_POST['precio_vta']; 

$fecha_vence  = $_POST['fecha_vence']; 
$presentacion  = $_POST['presentacion']; 
$prescrip  = $_POST['prescrip']; 
$laboratorio  = $_POST['laboratorio']; 
$proveedor_produc  = $_POST['proveedor_produc'];
$categori_pro  = $_POST['categori_pro'];
$estado = "Disponible";

date_default_timezone_set('America/Managua');
$fech_ingre=date("Y-m-d H:i:s");

$insertar= "INSERT INTO `stock_productos`(
                        `id_stock_produc`, 
                        `cod_barra`, 
                        `nombre_product`, 
                        `cant_stock`, 
                        `prescripcion`, 
                        `id_usuario`)
                   VALUES ( NULL,
                           '$cod_barra',
                           '$nom_producto',
                           '$cant_product',
                           '$prescrip',
                           '$user')";

$inser_produc = $conexion->prepare($insertar);
$inser_produc->execute(); 

if($inser_produc->rowCount() >= 1)
{
    $consulta= "SELECT `id_stock_produc`,`cod_barra` FROM `stock_productos` 
    WHERE `cod_barra` = '$cod_barra' AND `id_usuario` = '$user'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

    $id_stock_consul = 0;
    foreach ($resultado as $row) 
    {
    $id_stock_consul = $row['id_stock_produc'];
    }
    
    $insertar= "INSERT INTO `detalle_stock_product`(
                        `id_detall_stock_pro`, 
                        `id_stock_produc`, 
                        `nom_producto`, 
                        `cant_producto`,
                        `fech_vencimiento`, 
                        `presentacion`, 
                        `id_laboratorio`, 
                        `id_proveedor`, 
                        `fecha_ingres_stock`, 
                        `estado_produc`,
                        `id_categoria_produc`) 

                  VALUES (NULL,
                          '$id_stock_consul',
                          '$nom_producto',
                          '$cant_product',
                          '$fecha_vence',
                          '$presentacion',
                          '$laboratorio',
                          '$proveedor_produc',
                          '$fech_ingre',
                          '$estado',
                          '$categori_pro')";
    $detall_stock = $conexion->prepare($insertar);
    $detall_stock->execute(); 

    if($detall_stock->rowCount() >= 1)
    { 
        $inserprecio ="INSERT INTO `cat_precio`(
            `id_precio`, 
            `id_stock_produc`, 
            `prec_compra`, 
            `porcen_utili`, 
            `prec_venta`, 
            `fecha_ingre_prec`, 
            `id_usuario`) 

             VALUES (NULL,
             '$id_stock_consul',
             '$pre_compra',
             '$porcen_utili',
             '$precio_vta',
             '$fech_ingre',
             '$user')";
        $inser_precio = $conexion->prepare($inserprecio);
        $inser_precio->execute();

        if($inser_precio->rowCount() >= 1)
        { echo 1; }
        else { echo 0;}

    } 
    else { echo 0;}

} 
else { 
    echo 0; 
}



$conexion=null;

?>    
