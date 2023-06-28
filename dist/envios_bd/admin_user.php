<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

date_default_timezone_set('America/Managua');
$fecha_hoy = date("Y-m-d 00:00:00");
$fecha_despues = date("Y-m-d 23:59:59");

/// Nuevo usuario
$nombre_user = (isset($_POST['nombre_user'])) ? $_POST['nombre_user'] : ''; 
$apellido_user = (isset($_POST['apellido_user'])) ? $_POST['apellido_user'] : ''; 
$cedula_user = (isset($_POST['cedula_user'])) ? $_POST['cedula_user'] : ''; 
$sexo_user = (isset($_POST['sexo_user'])) ? $_POST['sexo_user'] : ''; 
$direc_user = (isset($_POST['direc_user'])) ? $_POST['direc_user'] : ''; 
$correo_user = (isset($_POST['correo_user'])) ? $_POST['correo_user'] : '';  
$user = (isset($_POST['user'])) ? $_POST['user'] : ''; 
$tipo_user = (isset($_POST['tipo_user'])) ? $_POST['tipo_user'] : ''; 
$cantraseña = (isset($_POST['cantraseña'])) ? $_POST['cantraseña'] : ''; 

$foto_perfil = (isset($_FILES['foto_perfil'])) ? $_FILES['foto_perfil'] : ''; 

$repiter_con = (isset($_POST['repiter_con'])) ? $_POST['repiter_con'] : ''; 
$user_registro = (isset($_POST['user_registro'])) ? $_POST['user_registro'] : ''; 

$estado = "Activo";
$pass =  sha1($cantraseña);

/// editar usuarios
$id_usuarioedi = (isset($_POST['id_usuarioedi'])) ? $_POST['id_usuarioedi'] : ''; 
$user_sesion = (isset($_POST['user_sesion'])) ? $_POST['user_sesion'] : ''; 
$tipo_user_edit = (isset($_POST['tipo_user_edit'])) ? $_POST['tipo_user_edit'] : ''; 
$estado_user = (isset($_POST['estado_user'])) ? $_POST['estado_user'] : ''; 

/// reset pass
$id_usuario_reset = (isset($_POST['id_usuario_reset'])) ? $_POST['id_usuario_reset'] : ''; 
$repiter_con_reset = (isset($_POST['repiter_con_reset'])) ? $_POST['repiter_con_reset'] : ''; 
$new_pass_reset =  sha1($repiter_con_reset);


$opc_user = (isset($_POST['opc_user'])) ? $_POST['opc_user'] : '';

switch($opc_user) 
{
    case "add_user":

            $foto_encrip = md5($foto_perfil["tmp_name"]).".jpg";
            $ruta = "../foto_perfil/".$foto_encrip;
            move_uploaded_file($foto_perfil["tmp_name"],$ruta);
            
            $insertar= "INSERT INTO `usuarios`(`id_usuario`, `usuario`, `password`, `tipo_user`, `estado`, `foto_perfil`) 
            VALUES (null, '$user', '$pass', '$tipo_user', '$estado', '$foto_encrip')";
            $resultado = $conexion->prepare($insertar);
            $resultado->execute();

            if($resultado->rowCount() >= 1)
            {
                $Consulta = "SELECT MAX(`usuarios`.`id_usuario`) AS max_user FROM  `usuarios`";
                $Inresultado = $conexion->prepare($Consulta);
                $Inresultado->execute(); 
                $result = $Inresultado->fetch();
            
                $insertar= "INSERT INTO `admin_user` (`id_admin_usuario`, `id_usuario`, `nombres_user`, `apelldos_user`, `cedula_user`, `sexo_user`, `correo_user`, `direccion_user`, `nom_ingreuser`) VALUES
                (null, '$result[0]', '$nombre_user', '$apellido_user', '$cedula_user', '$sexo_user', '$correo_user', '$direc_user', '$user_registro')";
                $resultado = $conexion->prepare($insertar);
                $resultado->execute();

                if($resultado->rowCount() >= 1)
                {
                    echo 1;
                } else { echo 0;}
                
            }


    break;

    case "lista_user":
        $consul_caja="SELECT 
        `usuarios`.`id_usuario`,
        `usuarios`.`usuario`,
        `usuarios`.`password`,
        CONCAT(`admin_user`.`nombres_user`,' ',`admin_user`.`apelldos_user`) `nombre_apellido`,
        `admin_user`.`correo_user`,
        `usuarios`.`tipo_user`,
        `usuarios`.`estado`,
        `usuarios`.`foto_perfil`
        
        FROM `usuarios` 
            LEFT JOIN `admin_user` ON `admin_user`.`id_usuario` = `usuarios`.`id_usuario`;";
        $caja_lis = $conexion->prepare($consul_caja);
        $caja_lis->execute(); 
        
		$data = $caja_lis->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);

    break;

    case "editar_user":

        $update_user="UPDATE `usuarios` SET `usuario`='$user_sesion',
                                            `tipo_user`='$tipo_user_edit',
                                            `estado`='$estado_user'
                                             WHERE `id_usuario`='$id_usuarioedi'";
        $updateuser = $conexion->prepare($update_user);
        $updateuser->execute(); 
        if($updateuser->rowCount() >= 1)
        {
            echo 1;
        } else { echo 0;}

    break;

    case "reset_pass":
        $update_resetpass="UPDATE `usuarios` SET `password`='$new_pass_reset'
                                    WHERE `id_usuario`='$id_usuario_reset'";
        $updateresetpass = $conexion->prepare($update_resetpass);
        $updateresetpass->execute(); 
        if($updateresetpass->rowCount() >= 1)
        {
            echo 1;
        } else { echo 0;}

    break;
}

$conexion=null;
?>