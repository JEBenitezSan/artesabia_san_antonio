<?php 
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();


if(isset($_POST['valorBusqueda']))
{
	$termino = $_POST['valorBusqueda'];
	
	$consulta="SELECT 
					`materiales`.`id_materiales`,
					`materiales`.`codigo`,
					`materiales`.`id_tipomaterial`,
					`tipo_material`.`tipo_material`, 
					`materiales`.`color`,
					`precio_material`.`prec_compra`,
					`materiales`.`cantidad`,
					`materiales`.`id_unimedidas`,
					`unidmedida`.`unidad_medida`,
					`precio_material`.`moneda`
        
                        FROM `materiales` 
                            LEFT JOIN `tipo_material` ON `materiales`.`id_tipomaterial` = `tipo_material`.`id_tipomaterial` 
                            LEFT JOIN `unidmedida` ON `materiales`.`id_unimedidas` = `unidmedida`.`id_unimedidas` 
                            LEFT JOIN `precio_material` ON `precio_material`.`id_materiales` = `materiales`.`id_materiales`
                        WHERE `precio_material`.`id_prec_mate` = (SELECT MAX(`precio_material`.`id_prec_mate`) FROM `precio_material` WHERE  `precio_material`.`id_materiales` = `materiales`.`id_materiales`)
					AND	(`materiales`.`cantidad` <> 0)

					AND (`materiales`.`id_materiales` = $termino OR  `materiales`.`codigo` = $termino)
                    ORDER BY `materiales`.`id_materiales` DESC";

	$consultaBD = $conexion->prepare($consulta);
	$consultaBD->execute();


	if($consultaBD->rowCount() >= 1) 
	{
		
		foreach ($consultaBD as $fila) 
		{

				echo "<tr id='resul_clon' class='animated fadeIn'>
						<!--------------------------------------->
						<td>".$fila['id_materiales']."
						<input type='hidden' value=".$fila['id_materiales']." 
						class='form-control form-control-sm id_materiales'
						id='id_materiales' name='id_materiales[]'>
						</td>

						<td>".$fila['codigo']."</td>
						<td>".$fila['id_tipomaterial']."</td>
						<td>".$fila['tipo_material']."</td>
						<td>".$fila['color']."</td>

						<td>".$fila['prec_compra']." ".$fila['moneda']."</td>

						<td>".$fila['cantidad']."
						<input type='hidden' value=".$fila['cantidad']." 
						class='form-control form-control-sm cantidad'
						id='cantidad' name='cantidad[]'>
						</td>

						<input type='hidden' value=".$fila['prec_compra']." 
						class='form-control form-control-sm prec_venta'
						id='prec_venta'
						name='prec_venta[]'
						onkeyup='multi_validar()'>

						<td style='width : 120px;'>
						<input type='number' value='' class='form-control form-control-sm cant_material' 
						id='cant_material'name='cant_material[]' placeholder='Cantidad'
						onkeyup='multi_validar()' required>
						</td>
						
						<td style='width : 120px;'>
						<input type='number' value='' class='form-control form-control-sm total_material' 
						id='total_material'name='total_material[]' placeholder='Total Material'
						onkeyup='multi_validar()' required readonly>
						</td>

						
						<td>".$fila['id_unimedidas']."</td>
						<td>".$fila['unidad_medida']."</td>
						<!--------------------------------------->
						<td style='width : 60px;'> 
							<div class='btn-group' role='group'>

								<button type='button' class='btn-sm btn btn-warning btn_oscuro agre_material'>
								<i class='fa fa-plus-circle' aria-hidden='true'></i>
								</button>

								<button type='button' class='btn-sm btn btn-danger borrar_material' style='display: none;'>
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
