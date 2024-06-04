<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

// Data de nuevo producto
$user_registro = (isset($_POST['user_registro'])) ? $_POST['user_registro'] : ''; 
$cod_barra = (isset($_POST['cod_barra'])) ? $_POST['cod_barra'] : ''; 
$nom_producto = (isset($_POST['nom_producto'])) ? $_POST['nom_producto'] : ''; 
$cantidad_product = (isset($_POST['cantidad_product'])) ? $_POST['cantidad_product'] : ''; 
$tipo_producto = (isset($_POST['tipo_producto'])) ? $_POST['tipo_producto'] : ''; 
$total = (isset($_POST['total'])) ? $_POST['total'] : ''; 
$porcen_ganancia = (isset($_POST['porcen_ganancia'])) ? $_POST['porcen_ganancia'] : ''; 
$total_neto = (isset($_POST['total_neto'])) ? $_POST['total_neto'] : ''; 
$tipo_moneda = (isset($_POST['tipo_moneda'])) ? $_POST['tipo_moneda'] : ''; 
$estado_product = "Disponible";

/// Data para agregar mas producto a stock existente sin precios
$id_stockadd = (isset($_POST['id_stockadd'])) ? $_POST['id_stockadd'] : ''; 
$cod_barraadd = (isset($_POST['cod_barraadd'])) ? $_POST['cod_barraadd'] : ''; 
$nom_productoadd = (isset($_POST['nom_productoadd'])) ? $_POST['nom_productoadd'] : ''; 
$tipoproducto = (isset($_POST['tipoproducto'])) ? $_POST['tipoproducto'] : ''; 
$stock_exiadd = (isset($_POST['stock_exiadd'])) ? $_POST['stock_exiadd'] : ''; 
$new_stockadd = (isset($_POST['new_stockadd'])) ? $_POST['new_stockadd'] : ''; 
$cant_newproduc = (isset($_POST['cant_newproduc'])) ? $_POST['cant_newproduc'] : ''; 

// Data para agregar mas productos a stock con nuevos precios
$user_registro_add = (isset($_POST['user_registro_add'])) ? $_POST['user_registro_add'] : ''; 
$id_stock_add = (isset($_POST['id_stock_add'])) ? $_POST['id_stock_add'] : ''; 
$cod_barra_add = (isset($_POST['cod_barra_add'])) ? $_POST['cod_barra_add'] : ''; 
$nom_producto_add = (isset($_POST['nom_producto_add'])) ? $_POST['nom_producto_add'] : ''; 
$tipo_producto = (isset($_POST['tipo_producto'])) ? $_POST['tipo_producto'] : ''; 
$stock_exi_add = (isset($_POST['stock_exi_add'])) ? $_POST['stock_exi_add'] : ''; 
$new_stock_add = (isset($_POST['new_stock_add'])) ? $_POST['new_stock_add'] : ''; 
$cant_new_produc = (isset($_POST['cant_new_produc'])) ? $_POST['cant_new_produc'] : ''; 
$pre_compra_add = (isset($_POST['pre_compra_add'])) ? $_POST['pre_compra_add'] : ''; 
$porcen_utili_add = (isset($_POST['porcen_utili_add'])) ? $_POST['porcen_utili_add'] : ''; 
$prec_vent_add = (isset($_POST['prec_vent_add'])) ? $_POST['prec_vent_add'] : ''; 
$moneda = "$";


$opc_invet = (isset($_POST['opc_invet'])) ? $_POST['opc_invet'] : '';

switch($opc_invet) 
{
    case "guardar_newproducto":

        $insert_producto = "INSERT INTO `stock_productos`(`id_stock_productos`, `cod_barra`, `nom_producto`, `cantidad`, `id_tipo_producto`, `estado`, `id_usuario`) 
                                        VALUES (NULL,?,?,?,?,?,?)";
        $insertproducto = $conexion->prepare($insert_producto);
        $insertproducto->execute([$cod_barra, $nom_producto, $cantidad_product, $tipo_producto, $estado_product, $user_registro]);

        if($insertproducto->rowCount() >= 1)
        {   
            $consul_ultimo_pro = "SELECT `id_stock_productos` FROM `stock_productos` ORDER BY `id_stock_productos` DESC LIMIT 1";
            $consul_ultimopro = $conexion->prepare($consul_ultimo_pro);
            $consul_ultimopro->execute(); 

            $id_stock_productos = 0;
            foreach ($consul_ultimopro as $row) 
            {$id_stock_productos = $row['id_stock_productos'];}

            
            $inser_precio= "INSERT INTO `cat_precio`(`id_precio`, `id_stock_produc`, `prec_compra`, `porcen_utili`, `prec_venta`, `moneda`, `fecha_ingre_prec`, `id_usuario`) 
                                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
            $inserprecio = $conexion->prepare($inser_precio);
            $inserprecio->execute([$id_stock_productos, $total, $porcen_ganancia, $total_neto, $tipo_moneda, $fech_ingre, $user_registro]);

            if($inserprecio->rowCount() >= 1)
            { echo 1; } else { echo 0;}
    
     
        } else { echo 0;}


    break;

    case "lista_invent":
        $invent_productos="SELECT 
        `stock_productos`.`id_stock_productos`,
        `stock_productos`.`cod_barra`,
        `stock_productos`.`nom_producto`,
        `tipo_productos`.`tipo_producto`,
        `stock_productos`.`cantidad`,
        `cat_precio`.`prec_venta`,
        CONCAT(((`stock_productos`.`cantidad`)*(`cat_precio`.`prec_venta`)), `cat_precio`.`moneda`)  AS `sub_total`,
        `cat_precio`.`prec_compra`,
        `cat_precio`.`porcen_utili`,
        `stock_productos`.`estado`,
        `usuarios`.`usuario`
        FROM `stock_productos` 
            LEFT JOIN `tipo_productos` ON `stock_productos`.`id_tipo_producto` = `tipo_productos`.`id_tipo_produc` 
            LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_productos` 
            LEFT JOIN `usuarios` ON `cat_precio`.`id_usuario` = `usuarios`.`id_usuario`
            
        WHERE `cat_precio`.`id_precio` = (SELECT MAX(`cat_precio`.`id_precio`) FROM `cat_precio` WHERE `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_productos`)
        ORDER BY `stock_productos`.`cod_barra` ASC";
        $inventproductos = $conexion->prepare($invent_productos);
        $inventproductos->execute(); 
        
		$data = $inventproductos->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "guardar_stock_con_precios":

        $update_stock_producto = "UPDATE `stock_productos` SET `cantidad`= ? WHERE `id_stock_productos` = ?";
        $update_stockproducto = $conexion->prepare($update_stock_producto);
        $update_stockproducto->execute([$cant_new_produc, $id_stock_add]);

        if($update_stockproducto->rowCount() >= 1)
        { 
            $insert_precio = "INSERT INTO `cat_precio`(`id_precio`, `id_stock_produc`, `prec_compra`, `porcen_utili`, `prec_venta`, `moneda`, `fecha_ingre_prec`, `id_usuario`) 
                                                    VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
            $insertprecio = $conexion->prepare($insert_precio);
            $insertprecio->execute([$id_stock_add, $pre_compra_add, $porcen_utili_add, $prec_vent_add, $moneda, $fech_ingre, $user_registro_add]);
            if($insertprecio->rowCount() >= 1)
            {echo 1; } else { echo 0; }

         } else {
            echo 0;
        }

    break;

    case "guardar_stock_sin_precios":
        $update_stockproducto_sin = "UPDATE `stock_productos` SET `cantidad`= ? WHERE `id_stock_productos` = ?";
        $updatestockproducto_sin = $conexion->prepare($update_stockproducto_sin);
        $updatestockproducto_sin->execute([$cant_newproduc, $id_stockadd ]);

        if($updatestockproducto_sin->rowCount() >= 1)
        { echo 1; } else { echo 0;}

    break;
}

$conexion=null;
?>