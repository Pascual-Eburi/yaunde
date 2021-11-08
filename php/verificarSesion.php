<?php 

/*
Este script php verifica que todo aquel que acceda al sistema se identifique primero,
verificará que existe la variable de sesion id_ usuario, si esta no existe, mandara al usuario a la pagina de login.
        <<<< --------------------------------------------------------------------
            INCLUIR ESTE ARCHIVO AL INICIO DE TODOS LOS ARCHIVOS QUE TENDRAN ACCESO A LA BASE DATOS 
        -------------------------------------------------------------------->>>>
*/

//iniciamos la sesion
session_start();

//incluiremos la conexion a la base de datos para poder incluir este archivo en todos los scripts que hagan peticiones o se comuniquen con la base de datos.
require_once 'conexion.php';

// verificamos si está definida la variable de sesion id_usuario, esta variable se creara automaticamente cuando el usuario haya iniciado sesion.
if(!$_SESSION['id_usuario']) {
	//si el usuario no esta logeado, vamos a mandarle a la pagina de login, no tendrá acceso al sistema.
	header('location../login.php');	
} 



?>