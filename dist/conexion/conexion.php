<?php
session_start();
if(!isset($_SESSION['s_usuario']))
{
    header("Location: ../index.php");
}

$usuario = $_SESSION["s_usuario"];
$tipouser = $_SESSION["s_tipo_user"];
$id_usuario = $_SESSION["s_id_usuario"];

class Conexion{
     public static function Conectar(){
        define('servidor','localhost');
        define('nombre_bd','artesan_bd');
        define('usuario','root');
        define('password','');          
         $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
         
         try{
            $conexion = new PDO("mysql:host=".servidor.";dbname=".nombre_bd, usuario, password, $opciones);             
            return $conexion; 
         }catch (Exception $e){
             die("El error de Conexión es :".$e->getMessage());
         }         
     }
     
 }
?>