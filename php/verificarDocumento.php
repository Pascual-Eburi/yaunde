<?php  
// este codigo verifica si un documento (DIP, PASAPORTE) ya existe en la base datos. 


//contiene el archivo de coneccion y ademos verifica que el usuario haya iniciado sesion
include("verificarSesion.php");

//verificando documento
if(isset($_POST["documento"])){
    //limpiamos el valor recibido por post, para evitar ingecciones sql
 $documento = mysqli_real_escape_string($conexion, $_POST["documento"]);
 //consulta
 $consulta = "SELECT num_documento FROM pacientes WHERE num_documento = '".$documento."'";
 $resultado = mysqli_query($conexion, $consulta);
 //
 echo mysqli_num_rows($resultado);
 //devolvemos el número de documentos encotrados, si el numero es mayor que 0, es que el documento ya existe en la base datos;
}

//ceramos la coneccion a la base de datos
$conexion->close();





?>