<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

date_default_timezone_set('America/Managua');
$fecha_hoy = date("Y-m-d 00:00:00");
$fecha_despues = date("Y-m-d 23:59:59");

/// editar stock
$id_stock_add = (isset($_POST['id_stock_add'])) ? $_POST['id_stock_add'] : ''; 
$cod_barra_add = (isset($_POST['cod_barra_add'])) ? $_POST['cod_barra_add'] : ''; 
$nom_producto_add = (isset($_POST['nom_producto_add'])) ? $_POST['nom_producto_add'] : ''; 
$stock_exi_add = (isset($_POST['stock_exi_add'])) ? $_POST['stock_exi_add'] : ''; 
$new_stock_add = (isset($_POST['new_stock_add'])) ? $_POST['new_stock_add'] : ''; 
$id_precio_add = (isset($_POST['id_precio_add'])) ? $_POST['id_precio_add'] : ''; 
$pre_compra_add = (isset($_POST['pre_compra_add'])) ? $_POST['pre_compra_add'] : ''; 
$porcen_utili_add = (isset($_POST['porcen_utili_add'])) ? $_POST['porcen_utili_add'] : ''; 
$prec_vent_add = (isset($_POST['prec_vent_add'])) ? $_POST['prec_vent_add'] : ''; 
$categori_pro_add = (isset($_POST['categori_pro_add'])) ? $_POST['categori_pro_add'] : ''; 

$id_detalle_stoedit = (isset($_POST['id_detalle_stoedit'])) ? $_POST['id_detalle_stoedit'] : ''; 


// id_stock_add
// cod_barra_add
// nom_producto_add
// presentacion_add
// fecha_venci_edit
// stock_exi_add
// new_stock_add
// id_precio_add
// pre_compra_add
// porcen_utili_add
// prec_vent_add
// categori_pro_add
// laboratorio_add
// id_detalle_stoedit


$opc_stock = (isset($_POST['opc_stock'])) ? $_POST['opc_stock'] : '';

switch($opc_stock) 
{

    case "lista_stock": 
        $stock_productos="SELECT 
                            `materiales`.`id_materiales`,
                            `materiales`.`codigo`,
                            `tipo_material`.`tipo_material`, 
                            `materiales`.`color`,
                            `materiales`.`cantidad`,
                            `unidmedida`.`unidad_medida`,
                            CONCAT(`precio_material`.`prec_compra`,' ',`precio_material`.`moneda`) `prec_compra`,
                            ((`materiales`.`cantidad`)*(`precio_material`.`prec_compra`)) as `sub_total_mate`
                            
                        FROM `materiales` 
                            LEFT JOIN `tipo_material` ON `materiales`.`id_tipomaterial` = `tipo_material`.`id_tipomaterial` 
                            LEFT JOIN `unidmedida` ON `materiales`.`id_unimedidas` = `unidmedida`.`id_unimedidas` 
                            LEFT JOIN `precio_material` ON `precio_material`.`id_materiales` = `materiales`.`id_materiales`
                        WHERE `precio_material`.`id_prec_mate` = (SELECT MAX(`precio_material`.`id_prec_mate`) FROM `precio_material` WHERE  `precio_material`.`id_materiales` = `materiales`.`id_materiales`)
                        ORDER BY `materiales`.`id_materiales` DESC";
        $stockproductos = $conexion->prepare($stock_productos);
        $stockproductos->execute(); 
        
		$data = $stockproductos->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "editar_stock":

                        /// se  hace el update al stock actualizandolo a total stock que existe actualmente
                        $update_dell = "UPDATE `detalle_stock_product` SET `nom_producto`='$nom_producto_add',
                                                                        `cant_producto`='$new_stock_add',
                                                                        `id_categoria_produc`='$categori_pro_add'
                                                                        WHERE `id_detall_stock_pro` = '$id_detalle_stoedit'";
                        $update_stock_dell = $conexion->prepare($update_dell);
                        $update_stock_dell->execute();


                        /// se agrega al detalle de stock
                        if($update_stock_dell->rowCount() >= 1)
                        {
                                /// Sumar el total de el detalle de producto para update el stock 
                                $consulta_sum = "SELECT SUM(`cant_producto`) AS `cant_producto` FROM `detalle_stock_product` WHERE `detalle_stock_product`.`id_stock_produc` = '$id_stock_add'";
                                $consultasum = $conexion->prepare($consulta_sum);
                                $consultasum->execute();

                                $actual_stock = 0;
                                foreach ($consultasum as $row) 
                                {
                                    $actual_stock = $row['cant_producto'];
                                }

                                /// Update a stock contidad de producto
                                $update_stock = "UPDATE `stock_productos` SET  `nombre_product` = '$nom_producto_add',
                                                                                `cant_stock` = '$actual_stock'
                                                                                  WHERE `id_stock_produc`='$id_stock_add'";
                                $updatestock = $conexion->prepare($update_stock);
                                $updatestock->execute();
                                /// Si id precio es igual a NULL se insertara nuevo precio si no no se ejecuta
                                
                                if($updatestock->rowCount() >= 1)
                                {
                                    if ($id_precio_add == "NULL")
                                    {
                                            $insert_precio = "INSERT INTO `cat_precio`(
                                                                            `id_precio`, 
                                                                            `id_stock_produc`, 
                                                                            `prec_compra`, 
                                                                            `porcen_utili`, 
                                                                            `prec_venta`, 
                                                                            `fecha_ingre_prec`, 
                                                                            `id_usuario`) 
                                                                            VALUES (NULL,
                                                                                    '$id_stock_add',
                                                                                    '$pre_compra_add',
                                                                                    '$porcen_utili_add',
                                                                                    '$prec_vent_add',
                                                                                    '$fech_ingre',
                                                                                    '$id_user')";
                                            $insertprecio = $conexion->prepare($insert_precio);
                                            $insertprecio->execute();

                                    } 

                                    /// Identificar la fila de detalle de stock para indentificar la fila de compra a actualizar
                                    $consulta_fecha = "SELECT `fecha_ingres_stock` FROM `detalle_stock_product` WHERE `id_detall_stock_pro` = '$id_detalle_stoedit'";
                                    $consultafecha = $conexion->prepare($consulta_fecha);
                                    $consultafecha->execute();
                                    $feha_entrada_dellstok = 0;
                                    foreach ($consultafecha as $row) 
                                    {
                                        $feha_entrada_dellstok = $row['fecha_ingres_stock'];
                                    }
                                    /// Update a compras
                                    $updatecompras = "UPDATE `detalle_compra_product` SET `nom_producto` = '$nom_producto_add',
                                                                                            `cant_producto` = '$new_stock_add',
                                                                                            `pre_compra_producto` = '$pre_compra_add',
                                                                                            `pre_vent_producto` = '$prec_vent_add',
                                                                                            `id_categoria_produc` = '$categori_pro_add'
                                                                                                WHERE `fecha_compra_stock` = '$feha_entrada_dellstok'";
                                    $update_compras = $conexion->prepare($updatecompras);
                                    $update_compras->execute();
                                                                    
                                        if($update_compras->rowCount() >= 1)
                                        {
                                          echo 1;
                                        } else { echo 0; }

                                }
                        }  

                         else { 
                            echo 0; 
                        }           

    break;

    case "":
    break;
}

$conexion=null;
?>