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
$cordobas="C$";
$tipofactura = "Producto";

/////-----------------------------TAZA DOLAR-------------------------------------------////


/////------------------------------------------------------------------------////
$consulta= "SELECT MAX(`proforma`.`fac_proforma`) AS num_profor
            FROM  `proforma`
            WHERE `proforma`.`id_usuario` = '$id_usuario'";
$num_proforma = $conexion->prepare($consulta);
$num_proforma->execute();
    foreach ($num_proforma as $max_profor) 
    {
        $maxprofor = $max_profor['num_profor'];
    }

/////------------------------------------------------------------------------////
$cons_result1 = "SELECT `proforma`.`fac_proforma`,
                        `proforma`.`total_pro`, `proforma`.`condiciones`, 
                        `proforma`.`fecha_pro`, `proforma`.`id_usuario`,
                         concat_ws(' ',`cliente`.`nombre_cliente`,`cliente`.`apellido_cliente`) AS 'nombrecliente'
                    FROM `proforma` 
                        LEFT JOIN `cliente` ON `proforma`.`id_cliente` = `cliente`.`id_cliente`
                        WHERE `proforma`.`fac_proforma` = '$maxprofor'";
$result1 = $conexion->prepare($cons_result1);
$result1->execute(); 
/////------------------------------------------------------------------------////
$consproductos="SELECT `stock_productos`.`nombre_product`, 
                        `stock_productos`.`cod_barra`,
                        `detalle_proforma`.`preventa_pro`,
                        `detalle_proforma`.`contidad_pro`,
                        `detalle_proforma`.`subtota_pro`
                        FROM `stock_productos` 
                            LEFT JOIN `detalle_stock_product` ON `detalle_stock_product`.`id_stock_produc` = `stock_productos`.`id_stock_produc` 
                            LEFT JOIN `detalle_proforma` ON `detalle_proforma`.`id_detall_stock_pro` = `detalle_stock_product`.`id_detall_stock_pro`
                            WHERE `detalle_proforma`.`fac_proforma` = $maxprofor";
                        
$result = $conexion->prepare($consproductos);
$result->execute(); 

/////------------------------------------------------------------------------////

require('plantilla/framework/fpdf/fpdf.php');

$pdf = new FPDF('P','mm','letter');
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 11);

             foreach ($result1 as $row_pro ) {

                $pdf->Image('plantilla/framework/fpdf/logofar.png',137,10,-220);
                
                $pdf->Cell(20,10,'Num Proforma : '. $row_pro['fac_proforma'],0,0,'L',0);
                $pdf->Ln(6);
                $pdf->Cell(20,10,'Nombre Cliente : '. $row_pro['nombrecliente'],0,0,'L',0);
                $pdf->Ln(6);
                $pdf->Cell(20,10,'Fecha : '. $row_pro['fecha_pro'],0,0,'L',0);
                $pdf->Ln(6);
                $pdf->Cell(20,10,'Tota Proforma : '. $row_pro['total_pro'].' C$',0,0,'L',0);
                $cliente_pro = $row_pro['nombrecliente'];
             }


             $pdf->Ln(15);
            $pdf->SetFontSize(10);
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(40,40,40);
            $pdf->SetDrawColor(88,88,88);
            $pdf->Cell(20,10,'IdPro',0,0,'L',1);
            $pdf->Cell(80,10,'Nombre',0,0,'C',1);
            $pdf->Cell(30,10,'Precio',0,0,'C',1);
            $pdf->Cell(30,10,'Cantidad',0,0,'C',1);
            $pdf->Cell(30,10,'SubTotal',0,0,'C',1);

            $pdf->SetFont('Arial', '', 11);
            $pdf->SetDrawColor(61,174,233);
            $pdf->SetLineWidth(1);
            $pdf->Line(10.5,51.5,200,51.5);
            $pdf->SetTextColor(0,0,0);

            $pdf->Ln(1);
            $pdf->SetLineWidth(0.3);
            $pdf->SetFillColor(240,240,240);
            $pdf->SetTextColor(40,40,40);
            $pdf->SetDrawColor(255,255,255);
            $pdf->Ln();
            foreach ($result as $row ) {

                $pdf->Cell(40,10,$row['cod_barra'],1,0,'L',1);
                $pdf->Cell(60,10, $row['nombre_product'],1,0,'L',1);
                $pdf->Cell(30,10,$row['preventa_pro'],1,0,'C',1);
                $pdf->Cell(30,10,$row['contidad_pro'],1,0,'C',1);
                $pdf->Cell(30,10,$row['subtota_pro'],1,0,'C',1);
        
                $pdf->Ln();
         
            }


            
            $pdf->Ln(10);     
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetFontSize(10);
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(40,40,40);
            $pdf->SetDrawColor(88,88,88);
            $pdf->Cell(300,5.5,'Servicios Tecnologico Camoapa',0,0,'C',1);
            $pdf->Ln();
            $pdf->Cell(300,5.5,'Camoapa, Boaco',0,0,'C',1);
            $pdf->Ln();
            $pdf->Cell(300,5.5,'Colegio San Francisco de Asis 75 mts al Este',0,0,'C',1);
            $pdf->Ln();
            $pdf->Cell(300,5.5,'Cel: +505 7726 9722',0,0,'C',1);        
            

            $pdf->Output('Fac_Servitecam_Proforma'.$cliente_pro.'_num_'.$maxprofor.'.pdf','i');
?>



