<?php 
/*
* Este archivo destruye y cierra las sesion de los usuarios
*/
require_once 'verificarSesion.php';

// eliminamos todos las variables de sesion que pueda haber
session_unset(); 

// destruimos la sesion del usuario 
session_destroy(); 

//Redireccionamos al usuario a la pagina de inicio de sesion o Login
header('location:../login.php');

?>