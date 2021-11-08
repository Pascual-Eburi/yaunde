<?php

 //este archivo contiene la conexion a la base datos y verifica el usuario que ha iniciado sesion       
include("verificarSesion.php");

//notificacion: se encargara de mostrar los mensajes de error o exito de la operacion, si se registra al usuario o surge algun problema
$notificacion['exito'] = array(
	'exitoso' => false, //false=> el mensaje es de error, true=> el mensaje es de exito
	'mensaje' => array()// aquí irá el mensaje que vamos a mostrar
);

if (isset($_POST)){
	
	//limipiar los datos que reciben del formulario, para evitar injecciones sql
	$nombre =  mysqli_real_escape_string($conexion, $_POST['nombre']);
	$apellidos =  mysqli_real_escape_string($conexion, $_POST["apellidos"]);
	$tipo_documento = mysqli_real_escape_string($conexion, $_POST['tipo_documento']);
	$num_identificacion=  mysqli_real_escape_string($conexion, $_POST['documento']);
	$telefono =  mysqli_real_escape_string($conexion, $_POST['telefono']);	
	$sexo =  mysqli_real_escape_string($conexion, $_POST['sexo']);

	//validar que todos los datos no estan vacios
	if(empty($nombre) || empty($apellidos) || empty($apellidos) || empty($tipo_documento) || empty($num_identificacion) || empty($telefono) || empty($sexo)){
		// mandamos un mensaje de error
		$notificacion['exito'] = false;// mensaje de error
		$notificacion['mensaje'] = "No puedes dejar campos vacíos";// el mensaje que mostraremos al usuario
	}else{
		
		//vamos a asegurarnos primero de que el documento no esta resitrado en la bd
		$verificarDocumento = "SELECT num_documento FROM pacientes WHERE num_documento = '".$num_identificacion."'";
		$resultado = $conexion->query($verificarDocumento);

		if($resultado->num_rows > 0) {//si el resultado es mayor que 0, es que el documento y pertenece a un usuario
			$notificacion['exitoso'] = false;//
			$notificacion['mensaje'] = "El documento  $num_identificacion ya pertenece a un usuario";//el mensaje que mostraremos al usuario
								 
		 }else{
			//el documento no existe, luego procedemos con la insercion
			$consulta = "INSERT INTO pacientes (nombre, apellidos, nombre_documento, num_documento, telf, sexo) VALUES ('$nombre', '$apellidos', '$tipo_documento', '$num_identificacion', '$telefono', '$sexo')";

			if($conexion->query($consulta) === TRUE) {
					
				$notificacion['exitoso'] = true;//mensaje exitoso, se ha registrado al paciente
				$notificacion['mensaje'] = "El paciente $nombre  $apellidos se ha registrado correctamente";//el mensaje que vamos a mostrar en pantalla	

			} else {

				$notificacion['exitoso'] = false;//mensaje de error, no se ha podido registrarle
				$notificacion['mensaje'] = "No se ha podido al paciente $nombre  $apellidos";//el mensaje que mostraremos al usuario
			}

		}


	}

	//imprimimos nuestra variable que contiene los mensajes y si si el mensaje es exitoso o no
	echo json_encode($notificacion);
	
	
}else{
	header("location: menu.php"); 
	// "NO SE HA ENVIADO NADA";
}

//ceramos la coneccion a la base de datos
$conexion->close();



?>