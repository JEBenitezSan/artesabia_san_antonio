<?php 
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Datos de materiales
$user = (isset($_POST['user'])) ? $_POST['user'] : '';

$cod_material = (isset($_POST['cod_material'])) ? $_POST['cod_material'] : '';
$tipo_material = (isset($_POST['tipo_material'])) ? $_POST['tipo_material'] : '';
$color_material = (isset($_POST['color_material'])) ? $_POST['color_material'] : '';
$cant_product = (isset($_POST['cant_product'])) ? $_POST['cant_product'] : '';
$cat_unidad = (isset($_POST['cat_unidad'])) ? $_POST['cat_unidad'] : '';
$cat_precio = (isset($_POST['cat_precio'])) ? $_POST['cat_precio'] : '';
$tipo_moneda = (isset($_POST['tipo_moneda'])) ? $_POST['tipo_moneda'] : '';

//Compras
$fac_num_compra = (isset($_POST['fac_num_compra'])) ? $_POST['fac_num_compra'] : ''; 
$fac_monto_compra = (isset($_POST['fac_monto_compra'])) ? $_POST['fac_monto_compra'] : ''; 
$fac_fech_compra = (isset($_POST['fac_fech_compra'])) ? $_POST['fac_fech_compra'] : ''; 
$proveedor_produc = (isset($_POST['proveedor_produc'])) ? $_POST['proveedor_produc'] : '';

/// Update a los productos de las compras
$id_material = (isset($_POST['id_material'])) ? $_POST['id_material'] : '';
$codmaterial = (isset($_POST['codmaterial'])) ? $_POST['codmaterial'] : '';
$tipomaterial = (isset($_POST['tipomaterial'])) ? $_POST['tipomaterial'] : '';
$id_tipo_material = (isset($_POST['id_tipo_material'])) ? $_POST['id_tipo_material'] : '';
$stock_exi_add = (isset($_POST['stock_exi_add'])) ? $_POST['stock_exi_add'] : '';
$new_stock_add = (isset($_POST['new_stock_add'])) ? $_POST['new_stock_add'] : '';
$new_total_stock_add = (isset($_POST['new_total_stock_add'])) ? $_POST['new_total_stock_add'] : '';
$id_precio_add = (isset($_POST['id_precio_add'])) ? $_POST['id_precio_add'] : '';
$pre_compra_add = (isset($_POST['pre_compra_add'])) ? $_POST['pre_compra_add'] : '';
$nuevo_precio = (isset($_POST['nuevo_precio'])) ? $_POST['nuevo_precio'] : '';
$colormaterial = (isset($_POST['colormaterial'])) ? $_POST['colormaterial'] : '';
$unidamedida = (isset($_POST['unidamedida'])) ? $_POST['unidamedida'] : ''; 

/// validar si hay nuevo precio
$id_precio_add = (isset($_POST['id_precio_add'])) ? $_POST['id_precio_add'] : ''; 


$busqueda_compra_pro = (isset($_POST['busqueda_compra_pro'])) ? $_POST['busqueda_compra_pro'] : '';

date_default_timezone_set('America/Managua');
$fech_ingre=date("Y-m-d H:i:s");

        $mone = "SELECT `moneda` FROM `precio_material` LIMIT 1";
        $moned = $conexion->prepare($mone);
        $moned->execute();
        $moneda = 0;
        foreach ($moned as $row) 
        {
        $moneda = $row['moneda'];
        }
        

function insertar_compra($new_total_stock_add,$id_maxcompra,$codmaterial,$id_tipo_material,$colormaterial,$pre_compra_add,$new_stock_add,$id_unidmedida,$user,$fech_ingre,$conexion) {
        $insertar_dellcompra = "INSERT INTO `detalle_compra_product`
        (`id_compra_detalle`,
        `id_compra`,
        `codigo`, 
        `id_tipomaterial`,
        `color`, 
        `precio_material`,
        `cantidad`,
        `id_unimedidas`,
        `id_usuario`,
        `fecha_ingre`) 
        VALUES ( NULL,
                '$id_maxcompra',
                '$codmaterial',
                '$id_tipo_material',
                '$colormaterial',
                '$pre_compra_add',
                '$new_stock_add',
                '$id_unidmedida',
                '$user',
                '$fech_ingre')";

                $fac_compra_n = $conexion->prepare($insertar_dellcompra);
                $fac_compra_n->execute();
                if($fac_compra_n->rowCount() >= 1)
                { 

                /// se  hace el update al stock materiales actualizandolo a total stock que existe actualmente
                $update_material = "UPDATE `materiales` SET `cantidad` = '$new_total_stock_add' WHERE `materiales`.`codigo` = '$codmaterial'";
                $updatematerial = $conexion->prepare($update_material);
                $updatematerial->execute();

                if($updatematerial->rowCount() >= 1)
                {
                        echo 1;
                } 
                else 
                        {
                         echo 0;
                        }
                }
                else 
                        {
                        echo 0;
                        }
}

$opc_compra = (isset($_POST['opc_compra'])) ? $_POST['opc_compra'] : '';

switch($opc_compra) 
{
	case "add_compra":

                $consulta_Compra= "SELECT `id_compras`,`id_proveedor` 
                                FROM `compras` 
                                WHERE `id_usuario` = '$user' 
                                ORDER BY `id_compras` DESC 
                                LIMIT 1";
                $resul_Compra = $conexion->prepare($consulta_Compra);
                $resul_Compra->execute();
                $consul_id_proveedor = 0;
                $id_max_compra = 0;
                foreach ($resul_Compra as $row) 
                {
                $id_maxcompra = $row['id_compras'];
                }

            $insertar= "INSERT INTO `materiales`(`id_materiales`, `codigo`, `id_tipomaterial`, `color`, `cantidad`, `id_unimedidas`, `id_usuario`) 
                                             VALUES (NULL,'$cod_material','$tipo_material','$color_material','$cant_product','$cat_unidad','$user')";
            $inser_produc = $conexion->prepare($insertar);
            $inser_produc->execute(); 

            if($inser_produc->rowCount() >= 1)
            {
                
                $consul_materia= "SELECT `id_materiales` FROM `materiales`
                                  WHERE (`codigo` = $cod_material) AND (`id_usuario` = $user)";
                $consulmateria = $conexion->prepare($consul_materia);
                $consulmateria->execute(); 
                $id_materiales = 0;
                foreach ($consulmateria as $row) 
                {
                        $id_materiales = $row['id_materiales'];
                }

                $inser_precio= "INSERT INTO `precio_material`(`id_prec_mate`, `id_materiales`, `prec_compra`, `moneda`, `fechaing_prec`) 
                          VALUES (NULL,'$id_materiales','$cat_precio','$tipo_moneda','$fech_ingre')";
                $inserprecio = $conexion->prepare($inser_precio);
                $inserprecio->execute(); 
                if($inserprecio->rowCount() >= 1)
                {
                        $insertar_dellcompra = "INSERT INTO `detalle_compra_product`
                                                (`id_compra_detalle`,
                                                `id_compra`,
                                                `codigo`, 
                                                `id_tipomaterial`,
                                                `color`, 
                                                `precio_material`,
                                                `cantidad`,
                                                `id_unimedidas`,
                                                `id_usuario`,
                                                `fecha_ingre`) 
                                VALUES ( NULL,
                                '$id_maxcompra',
                                '$cod_material',
                                '$tipo_material',
                                '$color_material',
                                '$cat_precio',
                                '$cant_product',
                                '$cat_unidad',
                                '$user',
                                '$fech_ingre')";
                
                        $fac_compra_n = $conexion->prepare($insertar_dellcompra);
                        $fac_compra_n->execute();
                        if($fac_compra_n->rowCount() >= 1)
                             {
                               echo 1;
                             }else {
                                 echo 0;
                                }
                }   
                else {  echo 0; }
              
            }  
            else {  echo 0; }

	break;

	case "add_lista_compra":

                $consulta= "SELECT 
                `materiales`.`id_materiales`,
                `tipo_material`.`tipo_material`,
                `materiales`.`codigo`, 
                `materiales`.`color`,
                `materiales`.`cantidad`,
                `unidmedida`.`unidad_medida`, 
                `precio_material`.`id_prec_mate`,
                `precio_material`.`prec_compra`,
                `precio_material`.`moneda`
                
                FROM `materiales` 
                        LEFT JOIN `unidmedida` ON `materiales`.`id_unimedidas` = `unidmedida`.`id_unimedidas` 
                        LEFT JOIN `tipo_material` ON `materiales`.`id_tipomaterial` = `tipo_material`.`id_tipomaterial` 
                        LEFT JOIN `precio_material` ON `precio_material`.`id_materiales` = `materiales`.`id_materiales`
                
                    WHERE `materiales`.`codigo` = '$busqueda_compra_pro'
                    ORDER BY `precio_material`.`id_prec_mate` DESC LIMIT 1";

                $lista_stock = $conexion->prepare($consulta);
                $lista_stock->execute();

                $data = $lista_stock->fetchAll(PDO::FETCH_ASSOC);
                if ($data == [])
                {
                echo 0;
                }
                else{
                print json_encode($data, JSON_UNESCAPED_UNICODE);   
                }
		 
	break;

        case "fac_compra":
                $insertar= "INSERT INTO `compras`(`id_compras`, `num_fac_compra`, `id_proveedor`, `fecha_compra`, `total_compra`, `fecha_igreso_user`, `id_usuario`) 
                                            VALUES (NULL,'$fac_num_compra','$proveedor_produc','$fac_fech_compra','$fac_monto_compra','$fech_ingre','$user')";
                $fac_compra_n = $conexion->prepare($insertar);
                $fac_compra_n->execute();

                if($fac_compra_n->rowCount() >= 1)
                { 
                  echo 1; 
                }
                else 
                {
                  echo 0;
                }
        break;

        case "update_add_material":

                if ($id_precio_add === "Nuevo")
                {
                        /// Consulto detalles de ultima compra ingresada o bien la que acavan de ingresa

                        $consulta_Compra= "SELECT `id_compras`,`id_proveedor` 
                                        FROM `compras` 
                                        WHERE `id_usuario` = '$user' 
                                        ORDER BY `id_compras` DESC 
                                        LIMIT 1";
                        $resul_Compra = $conexion->prepare($consulta_Compra);
                        $resul_Compra->execute();
                        $consul_id_proveedor = 0;
                        $id_max_compra = 0;
                        foreach ($resul_Compra as $row) 
                        {
                        $id_maxcompra = $row['id_compras'];
                        }

                        $uni_medida= "SELECT `id_unimedidas` FROM `unidmedida` WHERE `unidad_medida`= '$unidamedida'";
                        $unimedida = $conexion->prepare($uni_medida);
                        $unimedida->execute();

                        $id_unidmedida = 0;
                        foreach ($unimedida as $row) 
                        {
                        $id_unidmedida = $row['id_unimedidas'];
                        }

                        
                        $inserprecio= "INSERT INTO `precio_material`(`id_prec_mate`, `id_materiales`, `prec_compra`, `moneda`, `fechaing_prec`) 
                                                               VALUES (NULL,'$id_material','$nuevo_precio','$moneda','$fech_ingre')";
                        $insprecio = $conexion->prepare($inserprecio);
                        $insprecio->execute();

                        if($insprecio->rowCount() >= 1)
                        {
                                insertar_compra($new_total_stock_add,$id_maxcompra,$codmaterial,$id_tipo_material,$colormaterial,$pre_compra_add,$new_stock_add,$id_unidmedida,$user,$fech_ingre,$conexion);
                        } 
                        else {
                                echo 0;
                        }
                } 
                
                else {

                        /// Consulto detalles de ultima compra ingresada o bien la que acavan de ingresa

                        $consulta_Compra= "SELECT `id_compras`,`id_proveedor` 
                                                FROM `compras` 
                                                WHERE `id_usuario` = '$user' 
                                                ORDER BY `id_compras` DESC 
                                                LIMIT 1";
                        $resul_Compra = $conexion->prepare($consulta_Compra);
                        $resul_Compra->execute();
                        $consul_id_proveedor = 0;
                        $id_max_compra = 0;
                        foreach ($resul_Compra as $row) 
                        {
                        $id_maxcompra = $row['id_compras'];
                        }

                        $uni_medida= "SELECT `id_unimedidas` FROM `unidmedida` WHERE `unidad_medida`= '$unidamedida'";
                        $unimedida = $conexion->prepare($uni_medida);
                        $unimedida->execute();

                        $id_unidmedida = 0;
                        foreach ($unimedida as $row) 
                        {
                        $id_unidmedida = $row['id_unimedidas'];
                        }

                        /// inserta datos al detalle de compras de materiales los que van cargado a la compra
                        insertar_compra($new_total_stock_add,$id_maxcompra,$codmaterial,$id_tipo_material,$colormaterial,$pre_compra_add,$new_stock_add,$id_unidmedida,$user,$fech_ingre,$conexion);

                        /// Si se inserta se realiza el update a la cantidad de material


                }
                        
          

               
        break;

}

$conexion=null;

?>    
