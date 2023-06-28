<?php 
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if(isset($_POST['bus_product']))
{
	$termino = $_POST['bus_product'];
	$consulta="SELECT 
				`stock_productos`.`id_stock_produc`,
				`stock_productos`.`cod_barra`,
				`stock_productos`.`nombre_product`,
				`stock_productos`.`cant_stock`,
				`cat_precio`.`prec_venta`,
				`detalle_stock_product`.`id_detall_stock_pro`,
				`detalle_stock_product`.`cant_producto`
				
				FROM `stock_productos` 
					LEFT JOIN `cat_precio` ON `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_produc` 
					LEFT JOIN `detalle_stock_product` ON `detalle_stock_product`.`id_stock_produc` = `stock_productos`.`id_stock_produc`
				WHERE (`stock_productos`.`cant_stock` <> 0)
						AND (`detalle_stock_product`.`cant_producto` <> 0) 
						AND `cat_precio`.`id_precio` = (SELECT MAX(`cat_precio`.`id_precio`) FROM `cat_precio` WHERE `cat_precio`.`id_stock_produc` = `stock_productos`.`id_stock_produc`) 
						AND (`stock_productos`.`nombre_product` LIKE '%".$termino."%' OR
							`stock_productos`.`cod_barra` LIKE '%".$termino."%' OR
							`detalle_stock_product`.`id_detall_stock_pro` LIKE '%".$termino."%')
				
				GROUP BY `cat_precio`.`id_precio`, `detalle_stock_product`.`id_detall_stock_pro`
				ORDER BY `detalle_stock_product`.`id_detall_stock_pro` ASC";

	$consultaBD = $conexion->prepare($consulta);
	$consultaBD->execute();


	if($consultaBD->rowCount() >= 1) 
	{

		foreach ($consultaBD as $fila) 
		{

			echo "<tr id='resul_clon' class='animated fadeIn'>
			<!--------------------------------------->
			<td>".$fila['id_stock_produc']."        
			<input type='hidden' value=".$fila['id_stock_produc']." 
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
			<td>".$fila['nombre_product']."</td>
			<!--------------------------------------->
			<td style='width : 100px;'>".$fila['cant_stock']."
				<input type='hidden' value=".$fila['cant_stock']." 
				class='form-control form-control-sm cant_stock'
				id='cant_stock' name='cant_stock[]'>
			</td>
			<!--------------------------------------->
			<td>C$ ".$fila['prec_venta']."</td>
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
			<td>".$fila['id_detall_stock_pro']."
			<input type='hidden' value=".$fila['id_detall_stock_pro']." 
			class='form-control form-control-sm id_detall_stock_pro'
			id='id_detall_stock_pro' name='id_detall_stock_pro[]'>
			</td>
			<!--------------------------------------->
			<td>".$fila['cant_producto']."</td>
			<!--------------------------------------->
			<td style='width : 60px;'> 
			<div class='btn-group' role='group'>

			<button type='button' class='btn-sm btn btn-primary agre_produc'>
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

<!-- 
 -->