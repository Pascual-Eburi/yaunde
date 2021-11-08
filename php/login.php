
<?php

include 'conexion.php';

//inicializamos la variable que nos mostrara los mensajes
$notificacion['exitoso'] = array(
	'exitoso' => false, 
	'mensaje' => array()
);
/*
Aquí chequeamos que la peticion al servidor se haya hecho por post 
y que exista la variable $_SERVER['HTTP_REFERER'], para previnir que se ingrese la url de este archivo en la barra del navegador y que se tenga acceso a ello.
*/
 

if($_POST) {		

	$email =  mysqli_real_escape_string($conexion, $_POST['correo']); 
	$codigo = mysqli_real_escape_string($conexion, $_POST["codigo"]);

    if(empty($email) && empty($codigo)){
        $notificacion['exitoso'] = false;
        $notificacion['mensaje'] = "El email y la contraseña están vacíos, tienes que introducir un email y una contraseña.";

    }else if(empty($email) || empty($codigo)) {
		if($email == "") {
            $notificacion['exitoso'] = false;
            $notificacion['mensaje'] = "El email está vacío, Por favor, introduzca un email.";
		} 

		if($codigo == "") {
            $notificacion['exitoso'] = false;
            $notificacion['mensaje'] = "La contraseña está vacía, tienes que introducir una contraseña";
		}

	} else {
		$sql = "SELECT email FROM personal WHERE email = '$email'";
		$resultado = $conexion->query($sql);

		if($resultado->num_rows == 1) {
			$codigo = md5($codigo);
			// exists
			$consulta = "SELECT * FROM personal WHERE email = '$email' AND codigo = '$codigo'";
			$resultadoConsulta = $conexion->query($consulta);

			if($resultadoConsulta->num_rows == 1) {
				$columna = $resultadoConsulta->fetch_assoc();
				$id_personal = $columna['id'];
                $usuario = strtoupper($columna['nombre'].' '.$columna['apellidos']);
				//inicializamos la sesion
				session_start();
				// set session
				$_SESSION['id_usuario'] = $id_personal;

                $notificacion['exitoso'] = true;
                $notificacion['mensaje'] = "Datos correctos; $usuario, tienes concedido acceso al sistema";
				//header('location: http://localhost/stock_system/dashboard.php');	
			} else{
                $notificacion['exitoso'] = false;
                $notificacion['mensaje'] = "Combinación incorrecta de Email y Contraseña";

			} // /else
		} else {		
            $notificacion['exitoso'] = false;
            $notificacion['mensaje'] = "El email: $email es incorrecto, vuelve a intentarlo.";	
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
 



echo json_encode($notificacion);
$conexion->close();

?>
