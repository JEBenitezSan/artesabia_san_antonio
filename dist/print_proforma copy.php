<?php
include_once "conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

require_once 'static/composer/vendor/autoload.php';

date_default_timezone_set('America/Managua');
$fech_ingre = date("YmdHis");

// Realizar la consulta SQL
$usuariomax = (isset($_POST['usuariomax'])) ? $_POST['usuariomax'] : ''; 
$tipo_recorrido_aje = 'facaje';
$Titulo = "Arte_San_Antonio";

$consulta= "SELECT MAX(`proforma`.`fac_proforma`) AS num_profor
            FROM  `proforma`
            WHERE `proforma`.`id_usuario` = '$id_usuario'";
$num_proforma = $conexion->prepare($consulta);
$num_proforma->execute();
    foreach ($num_proforma as $max_profor) 
    {
        $maxprofor = $max_profor['num_profor'];
    }
///Maximo de factura por usuario
    $consul_maxfac="SELECT `proforma`.`fac_proforma`,
                            `proforma`.`total_pro`, 
                            `proforma`.`condiciones`, 
                            `proforma`.`fecha_pro`, 
                            `proforma`.`id_usuario`,
                            concat_ws(' ',`cliente`.`nombre_cliente`,`cliente`.`apellido_cliente`) AS 'nombrecliente'
                        FROM `proforma` 
                            LEFT JOIN `cliente` ON `proforma`.`id_cliente` = `cliente`.`id_cliente`
                            WHERE `proforma`.`fac_proforma` = ?";
    $consulmaxfac = $conexion->prepare($consul_maxfac);
    $consulmaxfac->execute([$maxprofor]);

    $fac_proforma = 0;
    $total_pro = 0;
    $condiciones = 0;
    $fecha_pro = 0;
    $id_usuario = 0;
    $nombrecliente = 0;

    foreach ($consulmaxfac AS $rom) 
    {
        $fac_proforma = $rom['fac_proforma'];
        $total_pro = $rom['total_pro'];
        $condiciones = $rom['condiciones'];
        $fecha_pro = $rom['fecha_pro'];
        $id_usuario = $rom['id_usuario'];
        $nombrecliente = $rom['nombrecliente'];
    }

    $expor_data = $Titulo.'_'.$fac_proforma.'_'.$fech_ingre; 



use Dompdf\Dompdf;
use Dompdf\Options;

// Crear instancia de Dompdf con opciones
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->set('orientation', 'portrait'); // Establecer orientación horizontal
$options->set('size', 'letter'); // Establecer tamaño a carta (letter)
$dompdf = new Dompdf($options);
$dompdf->setPaper('letter', 'portrait');

// Variable HTML donde acumularemos todos los datos
$html = '';


// Consulta SQL
$sql = "SELECT `stock_productos`.`nom_producto`, 
                `stock_productos`.`cod_barra`,
                `detalle_proforma`.`preventa_pro`,
                `detalle_proforma`.`contidad_pro`,
                `detalle_proforma`.`subtota_pro`
                FROM `stock_productos` 
                LEFT JOIN `detalle_proforma` ON `detalle_proforma`.`id_stock_productos` = `stock_productos`.`id_stock_productos`
                    WHERE `detalle_proforma`.`fac_proforma` = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$maxprofor]);
$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agregar encabezado para la tabla
// Agregar encabezado para la tabla
$html .= '<h3 align="center" style="margin: 0; line-height: 1;">ARTESANIA SAN ANTONIO (Proforma)</h3>';
$html .= '<h3 align="center" style="margin: 0; line-height: 1;">CAMOAPA, NICARAGUA</h3>';
$html .= '<h3 align="center" style="margin: 0; line-height: 1;">NUMERO: +505 7891 3606, +505 8942 7297</h3>';

$html .= '<style>
    .watermark {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        opacity: 0.1;
        background: url("http://localhost/arte_san_antonio/dist/plantilla/framework/fpdf/logofar2.png") no-repeat center center;
        background-size: 80%; /* Ajustar el tamaño de la imagen */
    }

</style>';

$html .= '<table style="border-collapse: collapse; width: 100%; margin-top: 30px;" >
            <tr>
                <td style="width: 50%; vertical-align: top;">';

// Información del cliente, número de factura y fecha
$html .= '<h4 style="margin: 1.5; line-height: 1;">Nombre Clinte: '.$nombrecliente.'</h4>';
$html .= '<h4 style="margin: 1.5; line-height: 1;">NumFactura: '.$fac_proforma.'</h4>';
$html .= '<h4 style="margin: 1.5; line-height: 1;">Total: '.$total_pro.'</h4>';
$html .= '<h4 style="margin: 1.5; line-height: 1;">Fecha: '.$fecha_pro.'</h4>';
$html .= '<h4 style="margin: 1.5; line-height: 1;">User: '.$id_usuario.'</h4>';
$html .= '<h4 style="margin: 1.5; line-height: 1;">Condiciones: '.$condiciones.'</h4>';


$html .= '</td>
          <td style="width: 50%; vertical-align: top; text-align: right;">';

// Imagen
$html .= '<img src="http://localhost/arte_san_antonio/dist/plantilla/framework/fpdf/logofar2.png" width="100" height="100"/>';

$html .= '</td>
          </tr>
          </table>';


$html .= '<table style="border-collapse: collapse; text-align: center; width: 100%; margin-top: 10px;">
            <thead style="background-color: #FDCE95;">
                <tr>
                    <th style="border: 1px solid black; font-size: 10pt; padding: 5px;">Producto</th>
                    <th style="border: 1px solid black; font-size: 10pt; padding: 5px;">Cod_Barra</th>
                    <th style="border: 1px solid black; font-size: 10pt; padding: 5px;">Precio_VTA</th>
                    <th style="border: 1px solid black; font-size: 10pt; padding: 5px;">Cantidad</th>
                    <th style="border: 1px solid black; font-size: 10pt; padding: 5px;">Sub_Total</th>
                </tr>
            </thead>
            <tbody>';


$totalPrecios = 0;

// Recorrer los resultados de la consulta y generar el HTML de la tabla
foreach ($datos as $dato) {
    $html .= '<tr>
                <td style="border: 1px solid black; font-size: 10pt;">' . $dato['nom_producto'] . '</td>
                <td style="border: 1px solid black; font-size: 10pt;">' . $dato['cod_barra'] . '</td>
                <td style="border: 1px solid black; font-size: 10pt;">' . $dato['preventa_pro'] . ' $</td>
                <td style="border: 1px solid black; font-size: 10pt;">' . $dato['contidad_pro'] . '</td>
                <td style="border: 1px solid black; font-size: 10pt;">' . $dato['subtota_pro'] . '</td>
              </tr>';

   // Sumar el precio actual al total
   $precioSinEspacios = str_replace(' ', '', $dato['subtota_pro']); // Eliminar espacios en el precio
   $precioNumerico = (float)str_replace(',', '.', $precioSinEspacios); // Convertir precio a número
   $totalPrecios += $precioNumerico;
}

// Agregar fila para mostrar el total de los precios
$html .= '<tr>
           <td colspan="4" style="border: 1px solid black; font-size: 10pt; text-align: right;"><b>Total:</b></td>
           <td style="border: 1px solid black; font-size: 10pt;">' . number_format($totalPrecios, 2) . ' $</td>
         </tr>';

         
$html .= '</tbody></table>';


// Firmas
$html .= '<table style="border-collapse: collapse; width: 100%; margin-top: 100px;">
        <tr>
        <td style="width: 50%; vertical-align: top; text-align: center;">';

$html .= '<h4 style="margin: 0; line-height: 1;"><hr style="width: 50%;"></h4>';
$html .= '<h4 style="margin: 0; line-height: 1;">Recibí Conforme</h4>';

$html .= '</td>
            <td style="width: 50%; vertical-align: top; text-align: center;">';

$html .= '<h4 style="margin: 0; line-height: 1;"><hr style="width: 50%;"></h4>';
$html .= '<h4 style="margin: 0; line-height: 1;">Entregue Conforme</h4>';

$html .= '</td>
          </tr>
          </table>';

// Cargar el HTML al DOMPDF
$dompdf->loadHtml($html);

// Renderizar el PDF
$nombrePDF = 'Proforma_Arte_San_Antonio'.$expor_data.'.pdf';
$dompdf->render();

// Descargar el PDF
$dompdf->stream($nombrePDF, ['Attachment' => false]);

// Cerrar la conexión a la base de datos
$conexion = null;
?>
