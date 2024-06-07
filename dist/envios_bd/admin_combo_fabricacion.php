<?php
include_once "../conexion/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Managua');
$fech_ingre = date("Y-m-d H:i:s");

/// Data para agregar artesano
$nom_artesano = (isset($_POST['nom_artesano'])) ? $_POST['nom_artesano'] : ''; 
$apell_artesano = (isset($_POST['apell_artesano'])) ? $_POST['apell_artesano'] : ''; 
$cedu_artesano = (isset($_POST['cedu_artesano'])) ? $_POST['cedu_artesano'] : ''; 
$num_artesano = (isset($_POST['num_artesano'])) ? $_POST['num_artesano'] : ''; 
$sexo_artesano = (isset($_POST['sexo_artesano'])) ? $_POST['sexo_artesano'] : ''; 
$user_artesano = (isset($_POST['user_artesano'])) ? $_POST['user_artesano'] : '';

// Data de modelo
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$descrip_modelo = (isset($_POST['descrip_modelo'])) ? $_POST['descrip_modelo'] : '';
$user_modelo = (isset($_POST['user_modelo'])) ? $_POST['user_modelo'] : '';

// Data de diseño
$diseno = (isset($_POST['diseno'])) ? $_POST['diseno'] : '';
$descrip_diseno = (isset($_POST['descrip_diseno'])) ? $_POST['descrip_diseno'] : '';
$user_diseno = (isset($_POST['user_diseno'])) ? $_POST['user_diseno'] : '';

// Data de agregar precio de elaboracion
$precio_elabo = (isset($_POST['precio_elabo'])) ? $_POST['precio_elabo'] : '';
$tipo_moneda = (isset($_POST['tipo_moneda'])) ? $_POST['tipo_moneda'] : '';
$descrip_precio = (isset($_POST['descrip_precio'])) ? $_POST['descrip_precio'] : '';
$user_pre_costo = (isset($_POST['user_pre_costo'])) ? $_POST['user_pre_costo'] : '';


$opc_combo = (isset($_POST['opc_combo'])) ? $_POST['opc_combo'] : '';

switch($opc_combo) 
{
    case "add_artesano": 

        $insert_artesano = "INSERT INTO `artesano`(`id_artesano`, `nombre`, `apellido`, `cedula`, `numero_cel`, `sexo`, `id_usuario`) 
                                        VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $insertartesano = $conexion->prepare($insert_artesano);
        $insertartesano->execute([$nom_artesano, $apell_artesano,$cedu_artesano, $num_artesano, $sexo_artesano, $user_artesano]);

        if($insertartesano->rowCount() >= 1)
        { echo 1; } else { echo 0;}

    break;

    case "add_modelo":

        $insert_modelo = "INSERT INTO `modelo`(`id_modelo`, `nombre_modelo`, `descripcion_modelo`, `id_usuario`) 
                                        VALUES (NULL, ?, ?, ?)";
        $insertmodelo = $conexion->prepare($insert_modelo);
        $insertmodelo->execute([$modelo, $descrip_modelo, $user_modelo]);

        if($insertmodelo->rowCount() >= 1)
        { echo 1; } else { echo 0;}

    break;

    case "add_diseno":

        $insert_diseno = "INSERT INTO `diseno`(`id_diseno`, `nombre_diseno`, `desc_diseno`, `id_usuario`) 
                                        VALUES (NULL, ?, ?, ?)";
                                        
        $insertdiseno = $conexion->prepare($insert_diseno);
        $insertdiseno->execute([$diseno, $descrip_diseno, $user_diseno]);

        if($insertdiseno->rowCount() >= 1)
        { echo 1; } else { echo 0;}


    break;

    case "add_precio_elabora":

        $insert_precio_elabo = "INSERT INTO `precio_elaboracion`(`id_precio_elabora`, `precio_elaboracion`, `moneda`, `descripcion_elab`, `id_usuario`) 
                                                            VALUES (NULL, ?, ?, ?, ?)";           
        $insert_precioelabo = $conexion->prepare($insert_precio_elabo);
        $insert_precioelabo->execute([$precio_elabo, $tipo_moneda, $descrip_precio, $user_pre_costo]);

        if($insert_precioelabo->rowCount() >= 1)
        { echo 1; } else { echo 0;}


    break;


}
$conexion=null;
?>