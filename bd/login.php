<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = sha1($password); 

$consulta = "SELECT 
`id_usuario`,
`usuario`,
`password`,
`tipo_user`,
`estado`,
`foto_perfil`

FROM usuarios
WHERE usuario='$usuario' AND password='$pass' AND estado = 'Activo'";

$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

   $user_val = $data[0]["usuario"];
   $pass_val = $data[0]["password"];

    if ( $user_val == $usuario &&  $pass_val == $pass) {

        $_SESSION["s_usuario"] = $usuario;
        $_SESSION["s_tipo_user"] = $data[0]["tipo_user"];
        $_SESSION["s_id_usuario"] = $data[0]["id_usuario"];
        $_SESSION["s_foto_perfil"] = $data[0]["foto_perfil"];
 
    }

    else{
        $_SESSION["s_usuario"] = null;
        $data=null;
        echo 1;
    }
  
}   
 else{
    $_SESSION["s_usuario"] = null;
    $data=null;
    echo 1;
}

$conexion=null;

?>

