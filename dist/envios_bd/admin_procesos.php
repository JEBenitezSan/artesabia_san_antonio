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

// Data agregar nuevo producto, de encargo
$estado_product = "Personalizado";
$nombre_diseno = (isset($_POST['nombre_diseno'])) ? $_POST['nombre_diseno'] : '';
$total = (isset($_POST['total'])) ? $_POST['total'] : '';
$porcen_ganancia = (isset($_POST['porcen_ganancia'])) ? $_POST['porcen_ganancia'] : '';
$total_neto = (isset($_POST['total_neto'])) ? $_POST['total_neto'] : '';
$tipo_producto = (isset($_POST['tipo_producto'])) ? $_POST['tipo_producto'] : '';
$cod_barra_gene = (isset($_POST['cod_barra_gene'])) ? $_POST['cod_barra_gene'] : '';
$user_regsitro_proceso = (isset($_POST['user_regsitro_proceso'])) ? $_POST['user_regsitro_proceso'] : '';
$cantidad_product = 1;
$tipo_moneda = "$";
$estado_fabricacion = "Finalizado";
$id_fabricacion = (isset($_POST['id_fabricacion'])) ? $_POST['id_fabricacion'] : '';

$opc_procesos = (isset($_POST['opc_procesos'])) ? $_POST['opc_procesos'] : '';

switch($opc_procesos) 
{
    case "agregar_pro_encargo":
        
        $insert_producto = "INSERT INTO `stock_productos`(`id_stock_productos`, `cod_barra`, `nom_producto`, `cantidad`, `id_tipo_producto`, `estado`, `id_usuario`) 
                                        VALUES (NULL,?,?,?,?,?,?)";
        $insertproducto = $conexion->prepare($insert_producto);
        $insertproducto->execute([$cod_barra_gene, $nombre_diseno, $cantidad_product, $tipo_producto, $estado_product, $user_regsitro_proceso]);

        if($insertproducto->rowCount() >= 1)
        {   
            $consul_ultimo_pro = "SELECT `id_stock_productos` FROM `stock_productos` WHERE `id_usuario` = '$user_regsitro_proceso' ORDER BY `id_stock_productos` DESC LIMIT 1";
            $consul_ultimopro = $conexion->prepare($consul_ultimo_pro);
            $consul_ultimopro->execute(); 

            $id_stock_productos = 0;
            foreach ($consul_ultimopro as $row) 
            {$id_stock_productos = $row['id_stock_productos'];}

            
            $inser_precio= "INSERT INTO `cat_precio`(`id_precio`, `id_stock_produc`, `prec_compra`, `porcen_utili`, `prec_venta`, `moneda`, `fecha_ingre_prec`, `id_usuario`) 
                                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
            $inserprecio = $conexion->prepare($inser_precio);
            $inserprecio->execute([$id_stock_productos, $total, $porcen_ganancia, $total_neto, $tipo_moneda, $fech_ingre, $user_regsitro_proceso]);

            $update_fabrica= "UPDATE `fabricacion` SET `estado`= ? WHERE `id_fabricacion` = ?";
            $updatefabrica = $conexion->prepare($update_fabrica);
            $updatefabrica->execute([$estado_fabricacion, $id_fabricacion]);

            if($updatefabrica->rowCount() >= 1)
            { echo 1; } else { echo 0;}
    
     
        } else { echo 0;}

    break;

    case "lista_procesos":
        $lista_procesos = "SELECT 
                            `fabricacion`.`id_fabricacion`,
                            CONCAT(`cliente`.`nombre_cliente`,' ',`cliente`.`apellido_cliente`) AS `cliente`,
                            CONCAT(`artesano`.`nombre`,' ',`artesano`.`apellido`) AS `artesano`,
                            `fabricacion`.`fecha_inicio_fabrica`,
                            `fabricacion`.`estado`,
                            `fabricacion`.`fecha_final_fabrica`,
                            TIMESTAMPDIFF(DAY, DATE(NOW()), `fabricacion`.`fecha_final_fabrica`)  AS `total_dias`,
                            `diseno`.`nombre_diseno`, 
                            `modelo`.`nombre_modelo`,
                            `fabricacion`.`total`
                            
                            FROM `fabricacion` 
                                LEFT JOIN `diseno` ON `fabricacion`.`id_diseno` = `diseno`.`id_diseno` 
                                LEFT JOIN `artesano` ON `fabricacion`.`id_artesano` = `artesano`.`id_artesano` 
                                LEFT JOIN `cliente` ON `fabricacion`.`id_cliente` = `cliente`.`id_cliente`
                                LEFT JOIN `modelo` ON `fabricacion`.`id_modelo` = `modelo`.`id_modelo` ORDER BY `fabricacion`.`fecha_inicio_fabrica` DESC";
        $listaprocesos = $conexion->prepare($lista_procesos);
        $listaprocesos->execute(); 
        
		$data = $listaprocesos->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "":
    break;

    case "":
    break;
}

$conexion=null;
?>