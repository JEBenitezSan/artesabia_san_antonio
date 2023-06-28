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

/////------------------------------------------------------------------------////

$consul_max_fab = "SELECT MAX(`fabricacion`.`id_fabricacion`) AS 'num_fabri'
FROM `fabricacion` WHERE `fabricacion`.`id_usuario` = '$id_usuario'";
$consulmaxfab = $conexion->prepare($consul_max_fab);
$consulmaxfab->execute(); 
foreach ($consulmaxfab as $maxnum_fabri) 
{
    $maxfabrinumero = $maxnum_fabri['num_fabri'];
}

/////------------------------------------------------------------------------////
$cons_result1 = "SELECT 
               `id_fabricacion`,
                concat_ws(' ',`cliente`.`nombre_cliente`,`cliente`.`apellido_cliente`) AS nombre_cliente,
                `artesano`.`nombre`, 
                `diseno`.`nombre_diseno`, 
                concat_ws(' ',`precio_elaboracion`.`precio_elaboracion`,`precio_elaboracion`.`moneda`) AS precio_elaboracion,
                `fabricacion`.`total`,
                `fabricacion`.`fecha_inicio_fabrica`,
                `fabricacion`.`fecha_final_fabrica`,
                `fabricacion`.`estado`,
                `usuarios`.`usuario`

                FROM `fabricacion` 
                    LEFT JOIN `cliente` ON `fabricacion`.`id_cliente` = `cliente`.`id_cliente` 
                    LEFT JOIN `artesano` ON `fabricacion`.`id_artesano` = `artesano`.`id_artesano` 
                    LEFT JOIN `diseno` ON `fabricacion`.`id_diseno` = `diseno`.`id_diseno` 
                    LEFT JOIN `precio_elaboracion` ON `fabricacion`.`id_precio_elabora` = `precio_elaboracion`.`id_precio_elabora` 
                    LEFT JOIN `usuarios` ON `artesano`.`id_usuario` = `usuarios`.`id_usuario`
                WHERE  `fabricacion`.`id_fabricacion` = '$maxfabrinumero'";

$result1 = $conexion->prepare($cons_result1);
$result1->execute(); 
/////------------------------------------------------------------------------////
$cons_result2 = "SELECT 
               `id_fabricacion`,
                concat_ws(' ',`cliente`.`nombre_cliente`,`cliente`.`apellido_cliente`) AS nombre_cliente,
                `artesano`.`nombre`, 
                `diseno`.`nombre_diseno`, 
                concat_ws(' ',`precio_elaboracion`.`precio_elaboracion`,`precio_elaboracion`.`moneda`) AS precio_elaboracion,
                concat_ws(' ',`fabricacion`.`total`,`precio_elaboracion`.`moneda`) AS `total`,
                `precio_elaboracion`.`moneda`,
                `fabricacion`.`fecha_inicio_fabrica`,
                `fabricacion`.`fecha_final_fabrica`,
                `fabricacion`.`estado`,
                `usuarios`.`usuario`

                FROM `fabricacion` 
                    LEFT JOIN `cliente` ON `fabricacion`.`id_cliente` = `cliente`.`id_cliente` 
                    LEFT JOIN `artesano` ON `fabricacion`.`id_artesano` = `artesano`.`id_artesano` 
                    LEFT JOIN `diseno` ON `fabricacion`.`id_diseno` = `diseno`.`id_diseno` 
                    LEFT JOIN `precio_elaboracion` ON `fabricacion`.`id_precio_elabora` = `precio_elaboracion`.`id_precio_elabora` 
                    LEFT JOIN `usuarios` ON `artesano`.`id_usuario` = `usuarios`.`id_usuario`
                WHERE  `fabricacion`.`id_fabricacion` = '$maxfabrinumero'";

$result2 = $conexion->prepare($cons_result2);
$result2->execute(); 
/////------------------------------------------------------------------------////
$cons_productos="SELECT 
                    `detalle_fabricacion`.`id_detalle_fabrica`,
                    concat_ws(' ',`detalle_fabricacion`.`cantidad`,`unidmedida`.`unidad_medida`) AS cantida_medida,
                    `detalle_fabricacion`.`precio`,
                    `detalle_fabricacion`.`sub_total`,
                    `materiales`.`codigo`,
                    `tipo_material`.`tipo_material`

                    FROM `detalle_fabricacion` 
                        LEFT JOIN `materiales` ON `detalle_fabricacion`.`id_materiales` = `materiales`.`id_materiales` 
                        LEFT JOIN `tipo_material` ON `materiales`.`id_tipomaterial` = `tipo_material`.`id_tipomaterial` 
                        LEFT JOIN `unidmedida` ON `materiales`.`id_unimedidas` = `unidmedida`.`id_unimedidas`
                    WHERE `detalle_fabricacion`.`id_fabricacion` = '$maxfabrinumero'";
$result = $conexion->prepare($cons_productos);
$result->execute(); 


/////------------------------------------------------------------------------////

$consul_num_cant = "SELECT COUNT(`id_detalle_fabrica`) AS 'NUM_MAT' FROM `detalle_fabricacion` 
                    WHERE `id_fabricacion` = '$maxfabrinumero'";
$consulta_numcat = $conexion->prepare($consul_num_cant);
$consulta_numcat->execute(); 
foreach ($consulta_numcat as $num_produc) 
{
    $num_pro_largo = $num_produc['NUM_MAT'];
}
$largo2 = $num_pro_largo * 9;
$largo =  $largo2 + 220;

require('plantilla/framework/fpdf/fpdf.php');
$pdf = new FPDF('P','mm',array(80, $largo));
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);
			 $pdf->SetFont('Arial','B',9);
             $pdf->Image('plantilla/framework/fpdf/logofar.png',23,4,-380);
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
                $pdf->Cell (4, 5,'No. Fabri:', 0, 0, 'C', 0);				
                $pdf->Cell (15, 5, $row1['id_fabricacion'], 0, 0, 'C', 0);
                
                $pdf->Cell (22, 5,'Fecha: ', 0, 0, 'C', 0);				
                $pdf->Cell (20, 5, $fecha_factura_print , 0, 0, 'C', 0);
            
                $pdf->Ln(6);  
                $pdf->Cell (13, 5,'Cliente:', 0, 0, 'L', 0);				
                $pdf->Write(4,'Cliente: '.$row1['nombre_cliente'],0,1,'C');			
                $pdf->Ln (6);

                $pdf->Cell (16, 5,'Artesano:', 0, 0, 'L', 0);		
                $pdf->Cell (80, 5, $row1['nombre'], 0, 0, 'L', 0);					
                $pdf->Ln (4);

                $pdf->Cell (16, 5,'Diseno:', 0, 0, 'L', 0);		
                $pdf->Cell (80, 5, $row1['nombre_diseno'], 0, 0, 'L', 0);					
                $pdf->Ln (4);
 
                $pdf->Cell (16, 5,'Estado:', 0, 0, 'L', 0);		
                $pdf->Cell (80, 5, $row1['estado'], 0, 0, 'L', 0);					
                $pdf->Ln (4);
      
                $pdf->Cell (25, 5,'Fecha Inicio:', 0, 0, 'L', 0);		
                $pdf->Cell (80, 5, $row1['fecha_inicio_fabrica'], 0, 0, 'L', 0);					
                $pdf->Ln (4);

                $pdf->Cell (25, 5,'Fecha Finaliza:', 0, 0, 'L', 0);		
                $pdf->Cell (80, 5, $row1['fecha_final_fabrica'], 0, 0, 'L', 0);					
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
                $pdf->Cell (15, 5, $row['tipo_material'], 0, 0, 'L', 0);
                $pdf->Ln();	
                
                $pdf->Cell (15, 5, $row['codigo'], 0, 0, 'L', 0);  
                $pdf->Cell (6, 5,'', 0, 0, 'C', 0);
                $pdf->Cell (14, 5, $row['precio'], 0, 0, 'C', 0);			
                $pdf->Cell (14, 5, $row['cantida_medida'], 0, 0, 'C', 0);			
                $pdf->Cell (16, 5, $row['sub_total'], 0, 0, 'C', 0);	
                $pdf->Ln(3);
                $pdf->Cell(60, 3,'-----------------------------------------------------------', 0, 0, 'C', 0);		
                $pdf->Ln (3);

			}
            
            foreach ($result2 as $row2) 
			{
                $pdf->Ln (2);
                $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);
                $pdf->Ln (2);

                $total_sub = $row2['total']; 
                $pre_elab = $row2['precio_elaboracion'];
                $tota_g = intval($total_sub) - intval($pre_elab);

                $pdf->Cell(10, 5, 'Total material:', 0, 0, 'L', 0,);
                $pdf->Cell (40, 5,'', 0, 0, 'L', 0);
                $pdf->Cell (8, 5, $tota_g.' '.$row2['moneda'] , 0, 0, 'L', 0);
                $pdf->Ln (6);
                $pdf->Cell(10, 5, 'Precio Elaboracion:', 0, 0, 'L', 0,);
                $pdf->Cell (40, 5,'', 0, 0, 'L', 0);
                $pdf->Cell (8, 5, $row2['precio_elaboracion'], 0, 0, 'L', 0);
                $pdf->Ln (6);
                $pdf->Cell(10, 5, 'Total Neto:', 0, 0, 'L', 0,);
                $pdf->Cell (40, 5,'', 0, 0, 'L', 0);
                $pdf->Cell (8, 5, $row2['total'], 0, 0, 'L', 0);

                $pdf->Ln (4); 
                $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);

                $pdf->Ln (5);
                $pdf->Cell(2,3,'V-dor:', 0, 0, 'C', 0);
                $pdf->Cell(38,3,$usuario, 0, 0, 'C', 0);

                $pdf->Ln (6);

			}
            
            $pdf->Cell(60,0,'',0,1,'C');
            
            $pdf->Ln(8);
            $pdf->Cell(60, 3,'-------------------------------------------------------------------------', 0, 0, 'C', 0);

$pdf->Output('Fabricacion_'.$cliente.'_num_'.$maxfabrinumero.'.pdf','i');
?>



