<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$opc_noti = (isset($_POST['opc_noti'])) ? $_POST['opc_noti'] : '';

switch($opc_noti) 
{
	case "num_notif":

		$consulta_num_notif="SELECT COUNT(`id_detall_stock_pro`) AS `num_noti` FROM `detalle_stock_product`";
		$numnotif = $conexion->prepare($consulta_num_notif);
		$numnotif->execute(); 

        $data = $numnotif->fetchAll(PDO::FETCH_ASSOC);
        if ($data == [])
        {
        echo 0;
        }
        else{
        print json_encode($data, JSON_UNESCAPED_UNICODE);   
        }

	break;

	case "lista_notif":
        $consulta_list_notif = "SELECT `detalle_stock_product`.`id_detall_stock_pro`,
                                        `stock_productos`.`nombre_product`,
                                        `detalle_stock_product`.`fech_vencimiento`,
                                        `detalle_stock_product`.`cant_producto`    
        FROM `stock_productos` 
            LEFT JOIN `detalle_stock_product` ON `detalle_stock_product`.`id_stock_produc` = `stock_productos`.`id_stock_produc`";
		$lista_notifi = $conexion->prepare($consulta_list_notif);
		$lista_notifi->execute(); 

        $data2 = $lista_notifi->fetchAll(PDO::FETCH_ASSOC);
        if ($data2 == [])
        {
        echo 0;
        }
        else{
        print json_encode($data2, JSON_UNESCAPED_UNICODE);   
        }
		 
	break;

}


$conexion=null;
?>