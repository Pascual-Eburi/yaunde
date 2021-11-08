<?php 	

require_once 'verificarSesion.php';

//construyendo nuestra variable que mostrará los mensajes al usuario
$notificacion['exitoso'] = array('exitoso' => false, 'mensaje' => array());

//id del paciente a eliminar
$id_paciente =  mysqli_real_escape_string($conexion, $_POST['id_paciente']);

if($id_paciente) { 

 $sql = "DELETE FROM `pacientes` WHERE `pacientes`.`id` = '$id_paciente'";

 if($conexion->query($sql) === TRUE) {
 	$notificacion['exitoso'] = true;//la consulta se ejecuto correctamente
	$notificacion['mensaje'] = "Ficha de paciente eliminada correctamente";//mensaje positivo a mostrar		
 } else {
 	$notificacion['exitoso'] = false;//la consulta no se ejecutó
 	$notificacion['mensaje'] = "Error al eliminar la ficha del paciente";//mensaje a mostrar
 }
 
 $conexion->close();

 //mostramos los mensajes
 echo json_encode($notificacion);
 
} // /if $_POST