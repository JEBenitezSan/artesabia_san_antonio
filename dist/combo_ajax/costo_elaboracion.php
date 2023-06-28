<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$costo_elabora = (isset($_POST['costo_elabora'])) ? $_POST['costo_elabora'] : '';

$Consulta = "SELECT `id_precio_elabora`,`precio_elaboracion` FROM `precio_elaboracion` WHERE `id_precio_elabora` = '$costo_elabora'";
$categoria_producto = $conexion->prepare($Consulta);
$categoria_producto->execute(); 
$conexion=null;


$data = $categoria_producto->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

?>
