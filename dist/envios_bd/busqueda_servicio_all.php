<?php 
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if(isset($_POST['bus_product']))
{
	$termino = $_POST['bus_product'];
	$consulta="SELECT 
					`servicios`.`id_servicio`, 
					`tipo_servicios`.`tipo_servicio`,
					`servicios`.`observaciones`,
					`servicios`.`fecha_entreda`,
					`servicios`.`precio_inversion`,
					`servicios`.`precio_servicio`,
					`servicios`.`precio_total_venta`,
					`servicios`.`estado`,
					`servicios`.`fecha_ingresado`
					
				FROM `servicios` 
				LEFT JOIN `tipo_servicios` ON `servicios`.`id_tiposervicio` = `tipo_servicios`.`id_tiposervicio` 
				LEFT JOIN `usuarios` ON `servicios`.`id_usuario` = `usuarios`.`id_usuario`

					WHERE  (`servicios`.`id_servicio` LIKE '%".$termino."%' OR
							 `servicios`.`observaciones` LIKE '%".$termino."%')

				    ORDER BY `servicios`.`id_servicio` ASC";

	$consultaBD = $conexion->prepare($consulta);
	$consultaBD->execute();


	if($consultaBD->rowCount() >= 1) 
	{

		foreach ($consultaBD as $fila) 
		{

				echo "<tr id='resul_clon'>
				<!--------------------------------------->
				<td>".$fila['id_servicio']."        
				<input type='hidden' value=".$fila['id_servicio']." 
				class='form-control form-control-sm id_servicio'
				id='id_servicio' name='id_servicio[]'>
				</td>	
				<!--------------------------------------->
				<td style='width : 120px;'>".$fila['tipo_servicio']."</td>
				<!--------------------------------------->
				<td>".$fila['observaciones']."</td>
				<!--------------------------------------->
				<td>".$fila['fecha_entreda']."</td>
				<!--------------------------------------->
				<td>".$fila['precio_inversion']."</td>
				<!--------------------------------------->
				<td>".$fila['precio_servicio']."</td>
				<!--------------------------------------->
				<td style='width : 100px;'><strong> C$ ".$fila['precio_total_venta']."</strong> 

					<input type='hidden' value='' 
					class='form-control form-control-sm total_subcompra'
					id='total_subcompra' name='total_subcompra[]'>

				</td>
				<!--------------------------------------->
				<td style='width : 120px;'>
				<input type='number' value='' 
				class='form-control form-control-sm precio_venta' 
				id='precio_venta' 
				name='precio_venta[]' 
				placeholder='Total'
				onkeyup='multi_validar()' required>
				</td>
				<!--------------------------------------->	
				<td>".$fila['estado']."</td>
				<!--------------------------------------->
				<td>".$fila['fecha_ingresado']."</td>
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
