<?php


//INICIO DE LA CONEXION A LA BASE DE DATOS

$direccion="localhost";
$bd="yaunde";
$usuario="root";
$contrasena="";


$conexion = mysqli_connect($direccion,$usuario,$contrasena,$bd);

if(mysqli_connect_errno()){
	
	echo "Error al conectar con la BD";
	exit();
	
}

mysqli_set_charset($conexion, "utf8");

?>