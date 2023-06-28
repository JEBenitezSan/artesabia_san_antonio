<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

$user = (isset($_POST['user'])) ? $_POST['user'] : '';
$cliente_fac = (isset($_POST['cliente_fac'])) ? $_POST['cliente_fac'] : '';
$com_artesano = (isset($_POST['com_artesano'])) ? $_POST['com_artesano'] : '';
$com_modelo = (isset($_POST['com_modelo'])) ? $_POST['com_modelo'] : '';
$com_diseno = (isset($_POST['com_diseno'])) ? $_POST['com_diseno'] : '';
$com_costoelabora = (isset($_POST['com_costoelabora'])) ? $_POST['com_costoelabora'] : '';
$fecha_finaliza = (isset($_POST['fecha_finaliza'])) ? $_POST['fecha_finaliza'] : '';
$total_elaboracion = (isset($_POST['total_elaboracion'])) ? $_POST['total_elaboracion'] : '';
$pre_elab = (isset($_POST['pre_elab'])) ? $_POST['pre_elab'] : '';
$estado = "Fabricacion";
/// datos array
$id_materiales = (isset($_POST['id_materiales'])) ? $_POST['id_materiales'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$prec_venta = (isset($_POST['prec_venta'])) ? $_POST['prec_venta'] : '';
$cant_material = (isset($_POST['cant_material'])) ? $_POST['cant_material'] : '';
$total_material = (isset($_POST['total_material'])) ? $_POST['total_material'] : '';


$numero = (isset($_POST['id_materiales'])) ? $_POST['id_materiales'] : '';  



        $insertar= "INSERT INTO `fabricacion`(`id_fabricacion`, `id_cliente`, `id_artesano`, `id_diseno`, `id_precio_elabora`, `total`, `fecha_inicio_fabrica`, `fecha_final_fabrica`, `estado`, `id_usuario`,`id_modelo`) 
                                        VALUES (NULL,'$cliente_fac','$com_artesano','$com_diseno','$com_costoelabora','$pre_elab','$fech_ingre ','$fecha_finaliza','$estado','$user','$com_modelo')";
        $factura = $conexion->prepare($insertar);
        $factura->execute(); 

            if($factura->rowCount() >= 1) 
                {
                    /// Consulta la ultima factura ingreasada por cada usuario
                    $consulta= "SELECT MAX(`fabricacion`.`id_fabricacion`) AS num_fabri
                    FROM `fabricacion` WHERE `fabricacion`.`id_usuario` = $user";
                    $num_fabric = $conexion->prepare($consulta);
                    $num_fabric->execute();
                    foreach ($num_fabric as $row) 
                    { $numfabri = $row['num_fabri']; }
                    /// ---------------------------///

                    for ($i=0; $i < count($numero); $i++)
                    {
                        $insertar_dell = "INSERT INTO `detalle_fabricacion`(`id_detalle_fabrica`, `id_fabricacion`, `id_materiales`, `cantidad`, `precio`, `sub_total`, `id_usuario`)
                                                                       VALUES (NULL,'$numfabri','$id_materiales[$i]','$cant_material[$i]','$prec_venta[$i]','$total_material[$i]','$user')";
                        
                        
                        $fabrica_detalle = $conexion->prepare($insertar_dell);
                        $fabrica_detalle->execute(); 

                        if($fabrica_detalle->rowCount() >= 1) 
                        {

                            /// update de el stock restarle la cantidad comprada

                            $consulta= "SELECT `id_materiales`,`cantidad` FROM `materiales` WHERE `id_materiales` = $id_materiales[$i]";
                            $stock_productos = $conexion->prepare($consulta);
                            $stock_productos->execute();
                
                            foreach ($stock_productos as $row) 
                            {
                            $stock_actual = $row['cantidad'];
                            }

                            $total_stock = $stock_actual - $cant_material[$i];

                            $consulta = "UPDATE `materiales` SET `cantidad`= '$total_stock' WHERE `id_materiales` = '$id_materiales[$i]'";
                            $actualizacion = $conexion->prepare($consulta);
                            $actualizacion->execute();



                        }


                    }

                    echo 1;
                }

                else {
                    echo 0;
                }

$conexion=null;

?>