<?php
include("funciones.php");
$servername = "localhost";
$database = "cpv";
$user = "root";
$password ="";/*"jfobYGFebLjyuVij5tbNK3RWUWeg19wh0g8LiP2U+n8=";*/
$clave = $password;/*foo($password);*/
$conexion = new  mysqli($servername,$user,$clave,$database);
if($conexion->connect_errno){
	die("Conexi&oacute;n Fallida".$conexion->connect_error);
}else{
  $conexion->query("SET NAMES 'utf8'");
}
?>