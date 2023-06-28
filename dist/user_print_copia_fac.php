<?php

/////-----------------------------Nume de factura-------------------------------------------////
$max_factura_numero = (isset($_POST['num_fac'])) ? $_POST['num_fac'] : '';
$tipo_factura = (isset($_POST['tipo_fac'])) ? $_POST['tipo_fac'] : '';
/////---------------------------------------------------------------------------------------////

session_start();
if(!isset($_SESSION['s_usuario']))
{
    header("Location: ../index.html");
}

$usuario = $_SESSION["s_usuario"];
$tipouser = $_SESSION["s_tipo_user"];

include_once "conexion/conexion_user.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();


date_default_timezone_set('America/Managua');
$fecha_factura_print = date("Y-m-d H:i:s"); 
$cordobas="C$";

// ---------------------------->
$con_sul_user = "SELECT 
                    `factura`.`id_num_factura`,
                    `usuarios`.`usuario`
                    FROM `factura` 
                        LEFT JOIN `usuarios` ON `factura`.`id_usuario` = `usuarios`.`id_usuario`
                        WHERE `factura`.`id_num_factura` = '$max_factura_numero '";
$consuluser = $conexion->prepare($con_sul_user);
$consuluser->execute(); 
foreach ($consuluser as $max_num) 
{
    $user_venta = $max_num['usuario'];
}

/////------------------------------------------------------------------------////
$cons_result1 = "SELECT `factura`.`id_num_factura`,`factura`.`fecha_factura`,  concat_ws(' ',`cliente`.`nombre_cliente`,`cliente`.`apellido_cliente`) AS nombre_cliente, `factura`.`id_usuario`
                    FROM `factura` 
                        LEFT JOIN `cliente` ON `factura`.`id_cliente` = `cliente`.`id_cliente`
                        WHERE `factura`.`id_num_factura` = '$max_factura_numero'";
$result1 = $conexion->prepare($cons_result1);
$result1->execute(); 
/////--------------------------Validacion----------------------------------------------////
switch($tipo_factura) 
{
    case "Producto":
            $cons_productos="SELECT
                            `stock_productos`.`nombre_product`, 
                            `stock_productos`.`cod_barra`,
                            `detalle_factura`.`prec_venta_detall`,
                            `detalle_factura`.`cant_detall`,
                            `detalle_factura`.`sub_total`
                            FROM `stock_productos` 
                                LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_stock_produc` = `stock_productos`.`id_stock_produc`
                                WHERE `detalle_factura`.`id_num_factura` = '$max_factura_numero'";
            $result = $conexion->prepare($cons_productos);
            $result->execute(); 

    break;

    case "Servicio":
            $produc_servicio ="SELECT
                                    `servicios`.`observaciones` AS `nombre_product`,
                                    `servicios`.`id_servicio` AS `cod_barra`,
                                    `detalle_factura`.`prec_venta_detall`,
                                    `detalle_factura`.`cant_detall`,
                                    `detalle_factura`.`sub_total`

                                    FROM `detalle_factura` 
                                        LEFT JOIN `servicios` ON `detalle_factura`.`id_servicio` = `servicios`.`id_servicio`
                                        WHERE `detalle_factura`.`id_num_factura` = '$max_factura_numero'";
                                    
            $result = $conexion->prepare($produc_servicio);
            $result->execute();     
    break;
}



/////------------------------------------------------------------------------////
$cons_totales="SELECT 
                    `id_num_factura`,
                    `total_factura`,
                    `fecha_factura`,
                    `total_fac_neto`,
                    `efectivo`,
                    `total_descuent`,
                    `vuelto_fac`,
                    condiciones_fac
                    FROM `factura`
                        WHERE `id_num_factura` = '$max_factura_numero'";
$result2 = $conexion->prepare($cons_totales);
$result2->execute(); 
/////------------------------------------------------------------------------////

$consul_num_cant = "SELECT COUNT(`stock_productos`.`nombre_product`) AS `num_productos`
                    FROM `stock_productos` 
                    LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_stock_produc` = `stock_productos`.`id_stock_produc`
                    WHERE `detalle_factura`.`id_num_factura` = '$max_factura_numero'";
$consulta_numcat = $conexion->prepare($consul_num_cant);
$consulta_numcat->execute(); 
foreach ($consulta_numcat as $num_produc) 
{
    $num_pro_largo = $num_produc['num_productos'];
}
$largo2 = $num_pro_largo * 10;
$largo =  $largo2 + 180;

require('plantilla/framework/fpdf/fpdf.php');
$pdf = new FPDF('P','mm',array(80, $largo));
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);
			 $pdf->SetFont('Arial','B',9);
             $pdf->Image('plantilla/framework/fpdf/logofar.png',5,6,-200);
             $pdf->Ln(16);
             $pdf->SetFont('Arial','B',9);
             $pdf->Cell(60,4,'',0,1,'C');            
             $pdf->Cell(60,4,'Sercivios Tecnologico Camoapa',0,1,'C');
             $pdf->Cell(60,4,'Camoapa, Boaco',0,1,'C');
             $pdf->Cell(60,4,'Colegio San Franciscop de Asis 75 mts al Este',0,1,'C');
             $pdf->Cell(60,4,'Cel: +505 7726 9722',0,1,'C');        
             $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);
             $pdf->Ln(5);
             $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);
     
     
             foreach ($result1 as $row1) 
			{
			$pdf->Ln (2);
            $pdf->Cell (4, 5,'No. Fact:', 0, 0, 'C', 0);				
            $pdf->Cell (15, 5, $row1['id_num_factura'], 0, 0, 'C', 0);
            
            $pdf->Cell (22, 5,'Fecha: ', 0, 0, 'C', 0);				
            $pdf->Cell (20, 5, $row1['fecha_factura'], 0, 0, 'C', 0);
        
            $pdf->Ln(4);  

            $pdf->Cell (4, 5,'Cliente:', 0, 0, 'C', 0);	
             $pdf->Ln(5);		
            $pdf->Cell (60, 5, $row1['nombre_cliente'], 0, 0, 'C', 0);					
		    $pdf->Ln (4);
		    $cliente =  $row1['nombre_cliente'];
			}
            $pdf->Ln(2);
            $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);
            $pdf->Ln (2);
            $pdf->Cell (10, 5,'Product', 0, 0, 'C', 0);
            $pdf->Cell (11, 5,'', 0, 0, 'C', 0);
			$pdf->Cell (14, 5,'Cant', 0, 0, 'C', 0);
			$pdf->Cell (14, 5,'Valor', 0, 0, 'C', 0);
			$pdf->Cell (16, 5,'Stotal', 0, 0, 'C', 0);            
			$pdf->Ln (4);
            $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);
            $pdf->Ln (3);

            foreach ($result as $row) 
			{			
           
            $pdf->Write(5, $row['nombre_product'], 0, 0,'L', 0);
            $pdf->Ln(4);	
            $pdf->Cell (15, 5, $row['cod_barra'], 0, 0, 'L', 0);  
            $pdf->Ln(4);	
            $pdf->Cell (21, 5,'-------------------', 0, 0, 'L', 0);
			$pdf->Cell (14, 5, $row['prec_venta_detall'], 0, 0, 'C', 0);			
			$pdf->Cell (14, 5, $row['cant_detall'], 0, 0, 'C', 0);			
            $pdf->Cell (16, 5, $row['sub_total'], 0, 0, 'C', 0);			
            $pdf->Ln (6);

			}
            
            foreach ($result2 as $row2) 
			{

            $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);
            $pdf->Ln (2);

            $pdf->Cell(10, 5, 'Total Neto:', 0, 0, 'C', 0,);
            $pdf->Cell (30, 5,'', 0, 0, 'L', 0);
            $pdf->Cell (8, 5, $cordobas, 0, 0, 'L', 0);
            $pdf->Cell (8, 5, $row2['total_fac_neto'], 0, 0, 'L', 0);
           
            $pdf->Ln (4); 
            $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);
            
            $pdf->Ln (3);
            $pdf->Cell(22, 5, '', 0, 0, 'L', 0,);
            $pdf->Cell(18, 5, 'Sub Total:', 0, 0, 'L', 0,);
            $pdf->Cell (8, 5, $cordobas, 0, 0, 'L', 0);
            $pdf->Cell (8, 5, $row2['total_factura'], 0, 0, 'L', 0);
            $pdf->Ln (4); 

            $pdf->Cell(22, 5, '', 0, 0, 'L', 0,);
            $pdf->Cell(18, 5, 'Descuento:', 0, 0, 'L', 0,);
            $pdf->Cell (8, 5, $cordobas, 0, 0, 'L', 0);
            $pdf->Cell (8, 5, $row2['total_descuent'], 0, 0, 'L', 0); 
            $pdf->Ln (4); 

            $pdf->Cell(22, 5, '', 0, 0, 'L', 0,);
            $pdf->Cell(18, 5, 'Total Neto:', 0, 0, 'L', 0,);
            $pdf->Cell (8, 5, $cordobas, 0, 0, 'L', 0);
            $pdf->Cell (8, 5, $row2['total_fac_neto'], 0, 0, 'L', 0);
            $pdf->Ln (4); 

            $pdf->Cell(22, 5, '', 0, 0, 'L', 0,);
            $pdf->Cell(18, 5, 'Efectivo', 0, 0, 'L', 0,);
            $pdf->Cell (8, 5, $cordobas, 0, 0, 'L', 0);
            $pdf->Cell (8, 5, $row2['efectivo'], 0, 0, 'L', 0);
            $pdf->Ln (4); 

            $pdf->Cell(22, 5, '', 0, 0, 'L', 0,);
            $pdf->Cell(18, 5, 'Vuelto:', 0, 0, 'L', 0,);
            $pdf->Cell (8, 5, $cordobas, 0, 0, 'L', 0);
            $pdf->Cell (8, 5, $row2['vuelto_fac'], 0, 0, 'L', 0);
            $pdf->Ln (4);
            $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);

            $pdf->Ln (4);
            $pdf->Cell(15, 3,'IDReferencial', 0, 0, 'C', 0);
            $pdf->Cell(20, 3, $row2['id_num_factura'], 0, 0, 'C', 0);
            $pdf->Cell(20,3,$fecha_factura_print, 0, 0, 'C', 0);

            $pdf->Ln (5);
            $pdf->Cell(2,3,'Usuario:', 0, 0, 'C', 0);
            $pdf->Cell(35,3,$usuario, 0, 0, 'C', 0); 
            $pdf->Cell(2,3,'V-dor:', 0, 0, 'C', 0);
            $pdf->Cell(32,3,$user_venta, 0, 0, 'C', 0); 

            $pdf->Ln (5);
            $pdf->Cell(2,3,'Cambio: ', 0, 0, 'C', 0);
            $pdf->Cell(27,3,'36.70', 0, 0, 'C', 0);

            $pdf->Ln (6);
            $pdf->Write(5,'Condiciones: '.$row2['condiciones_fac'],0,1,'C');
            $pdf->Ln (4);
			}
            
            $pdf->Ln(7);     
            $pdf->Cell(60,0,'Muchas Gracias por su compra....!',0,1,'C');
            
            $pdf->Ln(6);
            $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);

$pdf->Output('Fac_farmacia_'.$cliente.'_num_'.$max_factura_numero.'.pdf','i');
?>




