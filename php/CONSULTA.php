<?php

require("conexion.php");
if($_POST){
	
$buscar=$_POST['busqueda']; 
	
$consulta = "SELECT * FROM pacientes WHERE nombre = '$buscar'";
$resultado = $conexion->query($consulta);

//evaluar si la consulta ha encotrado datos:
/* 
en caso de que no se haya elaborado la condicion entonces
tenemos que expresar todo lo que queremos
Los portales, son como de diferentes dimensiones, son extrategias que
nos renderizan el dom real
todo eso que estamos haciendo y si abrimos el index.js importa app

*/
if ($resultado->num_rows > 0) {
while($filas = $resultado->fetch_array()){
	
	echo "<table><tr><td>";	
	echo $filas[0]."</td><td>";
     echo $filas[1]. "</td><td>";
	echo $filas[2]."</td><td>";
	echo $filas[3]."</td><td>";
	echo $filas[4]. "</td><td> ";
	echo $filas[5]. " </td><td>";
	echo $filas[6]. " </td></tr></table>";
	echo "<br>";
		
	
}
	
}else{
	echo 'No hay datos que mostrar para la búsqueda '.$buscar;
}
}


?>