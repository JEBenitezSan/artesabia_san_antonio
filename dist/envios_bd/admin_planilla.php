<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fecha_ingre = date("Y-m-d H:i:s");

/// Listar planillas
$fecha_pla = (isset($_POST['fecha_pla'])) ? $_POST['fecha_pla'] : '';
$vendedor_pla = (isset($_POST['vendedor_pla'])) ? $_POST['vendedor_pla'] : '';
$flecha_pla_limite = date("Y-m-d H:i:s",strtotime($fecha_pla."+ 1 days"));

/// Id de planilla a borrar 
$id_planilla = (isset($_POST['id_planilla'])) ? $_POST['id_planilla'] : '';

/// Dos de lista de planilla de edicion
$fecha_edit_1 = (isset($_POST['fecha_edit_1'])) ? $_POST['fecha_edit_1'] : ''; 
$fecha_edit_2 = (isset($_POST['fecha_edit_2'])) ? $_POST['fecha_edit_2'] : ''; 
$vendedor_pla = (isset($_POST['vendedor_pla'])) ? $_POST['vendedor_pla'] : ''; 

/// Editar datos de salario y comiciones pagos
$id_planil = (isset($_POST['id_planil'])) ? $_POST['id_planil'] : '';
$id_por_comi = (isset($_POST['id_por_comi'])) ? $_POST['id_por_comi'] : '';
$id_salario = (isset($_POST['id_salario'])) ? $_POST['id_salario'] : '';
$comision = (isset($_POST['comision'])) ? $_POST['comision'] : '';
$total_neto = (isset($_POST['total_neto'])) ? $_POST['total_neto'] : '';
$fech_ran_1 = (isset($_POST['fech_ran_1'])) ? $_POST['fech_ran_1'] : '';
$fech_ran_2 = (isset($_POST['fech_ran_2'])) ? $_POST['fech_ran_2'] : '';
$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';



$opc_planilla = (isset($_POST['opc_planilla'])) ? $_POST['opc_planilla'] : '';


switch($opc_planilla) 
{
	case "lista_planilla":
        
        $consul_listapla="SELECT `planilla_pago`.`id_plani_pago`, 
                            `usuarios`.`usuario`, 
                            CONCAT(`admin_user`.`nombres_user`,' ',`admin_user`.`apelldos_user`) `nombre_apellido_emple`,
                            `admin_user`.`cedula_user`,
                            `planilla_pago`.`id_por_comi`, 
                            `planilla_pago`.`id_salario`, 
                            `salario`.`salario_neto`, 
                            `planilla_pago`.`comision`, 
                            `planilla_pago`.`total_neto`, 
                            `planilla_pago`.`fecha_realizada`, 
                            `planilla_pago`.`fech_ran_1`, 
                            `planilla_pago`.`fech_ran_2`,
                            (SELECT `usuarios`.`usuario` FROM `usuarios` WHERE `usuarios`.`id_usuario` = `planilla_pago`.`id_usuario`) as 'user'
                           
                            FROM `planilla_pago` 
                            LEFT JOIN `usuarios` ON `planilla_pago`.`id_usuario_v` = `usuarios`.`id_usuario` 
                            LEFT JOIN `admin_user` ON `admin_user`.`id_usuario` = `usuarios`.`id_usuario` 
                            LEFT JOIN `salario` ON `planilla_pago`.`id_salario` = `salario`.`id_salario`
                            WHERE (`planilla_pago`.`fecha_realizada` >= '$fecha_pla')
                                AND (`planilla_pago`.`fecha_realizada` <= '$flecha_pla_limite') 
                                AND (`planilla_pago`.`id_usuario_v` = '$vendedor_pla')";
        $consul_listapla = $conexion->prepare($consul_listapla);
        $consul_listapla->execute(); 
        
		$data = $consul_listapla->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

	break;

	case "lis_planilla_libre":
        $consul_listapla="SELECT `planilla_pago`.`id_plani_pago`, 
                            `usuarios`.`usuario`, 
                            CONCAT(`admin_user`.`nombres_user`,' ',`admin_user`.`apelldos_user`) `nombre_apellido_emple`,
                            `admin_user`.`cedula_user`,
                            `planilla_pago`.`id_por_comi`, 
                            `planilla_pago`.`id_salario`, 
                            `salario`.`salario_neto`, 
                            `planilla_pago`.`comision`, 
                            `planilla_pago`.`total_neto`, 
                            `planilla_pago`.`fecha_realizada`, 
                            `planilla_pago`.`fech_ran_1`, 
                            `planilla_pago`.`fech_ran_2`,
                            (SELECT `usuarios`.`usuario` FROM `usuarios` WHERE `usuarios`.`id_usuario` = `planilla_pago`.`id_usuario`) as 'user'
                           
                            FROM `planilla_pago` 
                            LEFT JOIN `usuarios` ON `planilla_pago`.`id_usuario_v` = `usuarios`.`id_usuario` 
                            LEFT JOIN `admin_user` ON `admin_user`.`id_usuario` = `usuarios`.`id_usuario` 
                            LEFT JOIN `salario` ON `planilla_pago`.`id_salario` = `salario`.`id_salario`";
        $consul_listapla = $conexion->prepare($consul_listapla);
        $consul_listapla->execute(); 
        
		$data = $consul_listapla->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

		 
	break;

    case "dele_planilla":
        $borrar_planilla="DELETE FROM `planilla_pago` WHERE `id_plani_pago` = '$id_planilla'";
        $borrarplanilla = $conexion->prepare($borrar_planilla);
        $borrarplanilla->execute();

        if($borrarplanilla->rowCount() >= 1)
        {
          echo 1;
        } 
        else { 
            echo 0; 
        } 
        
    break;

    case "list_editar":

                $repor_venta_vende="SELECT 
                `factura`.`id_num_factura`, 
                `factura`.`total_descuent`,
                `factura`.`id_cant_porcendes`,
                `factura`.`total_fac_neto`,
                SUM( (`cat_precio`.`prec_compra`) * (`detalle_factura`.`cant_detall`) ) AS 'capital_vendedor',
                `factura`.`id_caja`,
                `factura`.`confirma_caja`,
                `cliente`.`nombre_cliente`, 
                `usuarios`.`usuario`,
                `factura`.`fecha_factura`

                FROM `factura` 
                LEFT JOIN `cliente` ON `factura`.`id_cliente` = `cliente`.`id_cliente` 
                LEFT JOIN `usuarios` ON `factura`.`id_usuario` = `usuarios`.`id_usuario` 
                LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_num_factura` = `factura`.`id_num_factura` 
                LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `detalle_factura`.`id_stock_produc`
                
                WHERE `cat_precio`.`id_precio` = (SELECT MAX(`cat_precio`.`id_precio`) FROM `cat_precio` WHERE `cat_precio`.`id_stock_produc` =  `detalle_factura`.`id_stock_produc`) AND
                        (`factura`.`fecha_factura` >= '$fecha_edit_1') AND 
                        (`factura`.`fecha_factura` <= '$fecha_edit_2') AND
                        (`usuarios`.`usuario` = '$vendedor_pla')
                    
                    GROUP BY `factura`.`fecha_factura`
                    ORDER BY `factura`.`fecha_factura` DESC";
                $reporte_venta_vendedor = $conexion->prepare($repor_venta_vende);
                $reporte_venta_vendedor->execute(); 
                
                $data = $reporte_venta_vendedor->fetchAll(PDO::FETCH_ASSOC);
                print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "editar_planilla":

        
        $consul_salario_id = "SELECT `id_salario` FROM `salario` WHERE `salario_neto` = '$id_salario'";
        $consulsalarioid = $conexion->prepare($consul_salario_id);
        $consulsalarioid->execute(); 
  
        foreach ($consulsalarioid as $row) 
        {
        $idsalario = $row['id_salario'];
        }

        $update_planilla = "UPDATE `planilla_pago` SET `id_por_comi`='$id_por_comi',
                                                        `id_salario`='$idsalario',
                                                        `comision`='$comision',
                                                        `total_neto`='$total_neto',
                                                        `fech_ran_1`='$fech_ran_1',
                                                        `fech_ran_2`='$fech_ran_2',
                                                        `id_usuario`='$id_usuario',
                                                        `fecha_edit`='$fecha_ingre'
                                                        WHERE `id_plani_pago` = '$id_planil'";
        $updateplanilla = $conexion->prepare($update_planilla);
        $updateplanilla->execute(); 
        if($updateplanilla->rowCount() >= 1) 
        {
              echo 1;
        }
        else {
              echo 0;
        }
        
    break;

}


$conexion=null;
?>