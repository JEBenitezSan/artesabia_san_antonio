<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$conf_pass_admin = (isset($_POST['conf_pass_admin'])) ? $_POST['conf_pass_admin'] : '';

$pass_admin_val = sha1($conf_pass_admin); 

$PERMISO = 'Admin';
$estado_ad = 'Activo';

date_default_timezone_set('America/Managua');
$fecha_ingre_g = date("Y-m-d H:i:s");

$opc_valiadmin = (isset($_POST['opc_valiadmin'])) ? $_POST['opc_valiadmin'] : '';

switch($opc_valiadmin) 
{
	case "validar_admin":

		$consulta_valadmin="SELECT `usuario`, `password`, `tipo_user`, `estado` FROM `usuarios`
         WHERE `password` = '$pass_admin_val' AND `tipo_user` = '$PERMISO'";
		$val_admin = $conexion->prepare($consulta_valadmin);
		$val_admin->execute(); 

        $password = 0;
        $tipo_user = 0;
        $estado = 0;
        $usuario = 0;
        foreach ($val_admin as $row) 
        {
            $password = $row['password'];
            $tipo_user = $row['tipo_user'];
            $estado = $row['estado'];
            $usuario = $row['usuario'];
        }

        if($password >= $pass_admin_val && $estado = $estado_ad && $tipo_user = $PERMISO) 
        {
           $data = $usuario;
           print json_encode($data, JSON_UNESCAPED_UNICODE);
        } 
        else {
            $data = 0;
            print json_encode($data, JSON_UNESCAPED_UNICODE);
        }

	break;

	case "delete_proveedor":
		 
	break;

}


$conexion=null;
?>