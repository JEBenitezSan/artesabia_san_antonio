<?php
session_start();
if(!isset($_SESSION['s_usuario']))
{
    header("Location: ../index.html");
}
else
{
    if($_SESSION["s_tipo_user"]!="Admin")
    {
        header("Location: fac_busqueda_user.html");
    }
}

$usuario = $_SESSION["s_usuario"];
$tipouser = $_SESSION["s_tipo_user"];
$id_usuario = $_SESSION["s_id_usuario"];

include_once "conexion/conexion_user.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();


date_default_timezone_set('America/Managua');
$fecha_factura_print = date("Y-m-d H:i:s"); 
$cordobas="$";
$tipofactura = "Producto";

/////-----------------------------TAZA DOLAR-------------------------------------------////


/////------------------------------------------------------------------------////
$consul_max_fac = "SELECT MAX(`factura`.`id_num_factura`) AS numfacx
                    FROM  `factura`
                    WHERE  (`factura`.`id_usuario` = '$id_usuario') AND (`factura`.`tipo_factura` = '$tipofactura')";
$consul_maxfac = $conexion->prepare($consul_max_fac);
$consul_maxfac->execute(); 
foreach ($consul_maxfac as $max_num) 
{
    $max_factura_numero = $max_num['numfacx'];
}

/////------------------------------------------------------------------------////
$cons_result1 = "SELECT `factura`.`id_num_factura`,`factura`.`fecha_factura`,  concat_ws(' ',`cliente`.`nombre_cliente`,`cliente`.`apellido_cliente`) AS nombre_cliente, `factura`.`id_usuario`
                    FROM `factura` 
                        LEFT JOIN `cliente` ON `factura`.`id_cliente` = `cliente`.`id_cliente`
                        WHERE `factura`.`id_num_factura` = '$max_factura_numero'";
$result1 = $conexion->prepare($cons_result1);
$result1->execute(); 
/////------------------------------------------------------------------------////
$cons_productos="SELECT
                    `stock_productos`.`nom_producto`, 
                    `stock_productos`.`cod_barra`,
                    `detalle_factura`.`prec_venta_detall`,
                    `detalle_factura`.`cant_detall`,
                    `detalle_factura`.`sub_total`
                    FROM `stock_productos` 
                        LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_stock_productos` = `stock_productos`.`id_stock_productos`
                        WHERE `detalle_factura`.`id_num_factura` = '$max_factura_numero'";
$result = $conexion->prepare($cons_productos);
$result->execute(); 

/////------------------------------------------------------------------------////
$cons_totales="SELECT 
                    `id_num_factura`,
                    `total_factura`,
                    `fecha_factura`,
                    `total_fac_neto`,
                    `efectivo`,
                    `total_descuent`,
                    `vuelto_fac`,
                    `condiciones_fac`
                    FROM `factura`
                        WHERE `id_num_factura` = '$max_factura_numero'";
$result2 = $conexion->prepare($cons_totales);
$result2->execute(); 
/////------------------------------------------------------------------------////

$consul_num_cant = "SELECT COUNT(`stock_productos`.`nom_producto`) AS `num_productos`
                    FROM `stock_productos` 
                    LEFT JOIN `detalle_factura` ON `detalle_factura`.`id_stock_productos` = `stock_productos`.`id_stock_productos`
                    WHERE `detalle_factura`.`id_num_factura` = '$max_factura_numero'";
$consulta_numcat = $conexion->prepare($consul_num_cant);
$consulta_numcat->execute(); 
foreach ($consulta_numcat as $num_produc) 
{
    $num_pro_largo = $num_produc['num_productos'];
}
$largo2 = $num_pro_largo * 9;
$largo =  $largo2 + 220;

require('plantilla/framework/fpdf/fpdf.php');
$pdf = new FPDF('P','mm',array(80, $largo));
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);
			 $pdf->SetFont('Arial','B',9);
             $pdf->Image('plantilla/framework/fpdf/logofar.png',23,3,-350);
             $pdf->Ln(26);
             $pdf->SetFont('Arial','B',9);
             $pdf->Cell(60,4,'',0,1,'C');            
             $pdf->Cell(60,4,'Artesania San Antonio',0,1,'C');
             $pdf->Cell(60,4,'Camoapa, Boaco, Nicaragua',0,1,'C');
             $pdf->Cell(60,4,'Iglesia San Francisco de Asis 1 1/2 C al N',0,1,'C');
             $pdf->Cell(60,4,'Cel: +505 7891 3606  +505 8942 7297',0,1,'C');        
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
			$pdf->Cell (14, 5,'Valor', 0, 0, 'C', 0);
			$pdf->Cell (14, 5,'Cant', 0, 0, 'C', 0);
			$pdf->Cell (16, 5,'Stotal', 0, 0, 'C', 0);            
			$pdf->Ln (4);
            $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);
            $pdf->Ln (3);

            foreach ($result as $row) 
			{		
            $pdf->Cell (15, 5, $row['nom_producto'], 0, 0, 'C', 0);
            $pdf->Ln();	

            $pdf->Cell (15, 5, $row['cod_barra'], 0, 0, 'C', 0);  
            $pdf->Cell (6, 5,'', 0, 0, 'C', 0);
			$pdf->Cell (14, 5, $row['prec_venta_detall']." ".$cordobas, 0, 0, 'C', 0);			
			$pdf->Cell (14, 5, $row['cant_detall'], 0, 0, 'C', 0);			
            $pdf->Cell (16, 5, $row['sub_total']." ".$cordobas, 0, 0, 'C', 0);		
            $pdf->Ln (2);
            $pdf->Cell(60, 5,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -', 0, 0, 'C', 0);
            $pdf->Ln ();

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
            $pdf->Cell(2,3,'V-dor:', 0, 0, 'C', 0);
            $pdf->Cell(38,3,$usuario, 0, 0, 'C', 0);

            // $pdf->Ln (5);
            // $pdf->Cell(2,3,'Cambio: ', 0, 0, 'C', 0);
            // $pdf->Cell(27,3,'37', 0, 0, 'C', 0);

            $pdf->Ln (6);

            $pdf->Write(5,'Condiciones: '.$row2['condiciones_fac'],0,1,'C');

			}
            
            $pdf->Ln(10);     
            $pdf->Cell(60,0,'Muchas Gracias por su compra....!',0,1,'C');
            
            $pdf->Ln(8);
            $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);

$pdf->Output('Arte_San_Antonio_'.$cliente.'_num_'.$max_factura_numero.'.pdf','i');
?>



