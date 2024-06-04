<?php 
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if(isset($_POST['bus_product']))
{
	$termino = $_POST['bus_product'];
	
	$consulta="SELECT `stock_productos`.`id_stock_productos`,
					`stock_productos`.`cod_barra`,
					`stock_productos`.`nom_producto`,
					`stock_productos`.`cantidad`,
					`cat_precio`.`prec_venta`,
					`cat_precio`.`moneda`

					FROM `stock_productos` 
						LEFT JOIN `tipo_productos` ON `stock_productos`.`id_tipo_producto` = `tipo_productos`.`id_tipo_produc` 
						LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_productos` 
						LEFT JOIN `usuarios` ON `cat_precio`.`id_usuario` = `usuarios`.`id_usuario`
						
					WHERE `cat_precio`.`id_precio` = (SELECT MAX(`cat_precio`.`id_precio`) FROM `cat_precio` WHERE `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_productos`)
					AND  (`stock_productos`.`cantidad` <> 0)
					AND (`stock_productos`.`cod_barra` = $termino OR `stock_productos`.`id_stock_productos` = $termino)";

	$consultaBD = $conexion->prepare($consulta);
	$consultaBD->execute();


	if($consultaBD->rowCount() >= 1) 
	{

		foreach ($consultaBD as $fila) 
		{

				echo "<tr id='resul_clon' class='animated fadeIn'>
				<!--------------------------------------->
				<td>".$fila['id_stock_productos']."        
				<input type='hidden' value=".$fila['id_stock_productos']." 
				class='form-control form-control-sm id_stock_produc'
				id='id_stock_produc' name='id_stock_produc[]'>
				</td>	
				<!--------------------------------------->
				<td style='width : 120px;'>".$fila['cod_barra']."
				<input type='hidden' value=".$fila['cod_barra']." 
				class='form-control form-control-sm cod_barra'
				id='cod_barra' name='cod_barra[]'>
				</td>
				<!--------------------------------------->
				<td>".$fila['nom_producto']."</td>
				<!--------------------------------------->
				<td>".$fila['cantidad']."
				<input type='hidden' value=".$fila['cantidad']." 
				class='form-control form-control-sm cant_stock'
				id='cant_stock' name='cant_stock[]'>
				</td>
				<!--------------------------------------->
				<td>".$fila['prec_venta']." ".$fila['moneda']."</td>
				<!--------------------------------------->
				<td style='width : 120px;'>
				<input type='number' value='' class='form-control form-control-sm prec_venta'
				id='prec_venta' name='prec_venta[]' onkeyup='multi_validar()' placeholder='Nuevo Precio'>
				</td>
				<!--------------------------------------->
				<td style='width : 120px;'>
				<input type='number' value='' 
				class='form-control form-control-sm cant_compra' 
				id='cant_compra' 
				name='cant_compra[]' 
				placeholder='Cantidad'
				onkeyup='multi_validar()' required>
				</td>
				<!--------------------------------------->
				<td style='width : 100px;'>
				<input type='number' value='' 
				class='form-control form-control-sm total_subcompra' 
				id='total_subcompra' 
				name='total_subcompra[]' 
				placeholder='Total' readonly>
				</td>
				<!--------------------------------------->	
				
				<td style='width : 60px;'> 
				<div class='btn-group' role='group'>

				<button type='button' class='btn-sm btn btn-warning btn_claro agre_produc'>
				<i class='fa fa-plus-circle' aria-hidden='true'></i>
				</button>

				<button type='button' class='btn-sm btn btn-danger borrar_producto' style='display: none;'>
				<i class='fa fa-trash' aria-hidden='true'></i>
				</button>

				</div>
				</td>
				</tr>
				";
		}

	}

}
?>
