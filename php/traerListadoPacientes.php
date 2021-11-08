
<?php 	
/**
 * Este archivo traer el listado de usuarios de la base datos
 * Devolvera los datos en formato json
 */
require_once 'verificarSesion.php';

$sql = "SELECT * FROM pacientes ORDER BY id DESC";
$resultado = $conexion->query($sql);

$listadoPacientes = array('data' => array());

if($resultado->num_rows > 0) { 
//mostraremos una numeracion en la tabla>>>>numeracion: 1, 2, 3....
$numeracion = 0;
 while($fila = $resultado->fetch_array()) {
    //incrementemos la numeracion
    $numeracion = $numeracion + 1;

     //guardamos el id del paciente para futuras operacion: editar, eliminar
 	$id_paciente = $fila[0];
     $nombre = $fila['nombre'].' '.$fila['apellidos'];

 	// botones de opciones que se mostrara en la tabla: editar, eliminar
    //el boton de eliminar( el primero), al hacer click en ello, se abrirá una ventana en la pantalla actual, se trata de un modal, y para ello, debemos pasarle el id del modal que queremos que muestre, en este caso, es el modal con id modalEliminarPaciente que se encuentra en el archivo pacientes.php; basicamente al mostrarse las ventana, se nos preguntara si queremos elimianr la ficha del paciente. y si presionamos el boton <<<si, eliminar>> se ejecutara la funcion eliminarPaciente que se encuentra en el archivo js/pacientes.js. Esta funcion recibirá el id del paciente que queremos eliminar,  para ello, vamos a pasarselo desde este archivo.
	$botones = "<td>
 				<button title='Eliminar ficha de  $nombre' class='btn botonOpciones btn-sm' data-toggle='modal'  data-target='#modalEliminarPaciente' onclick='eliminarPaciente($id_paciente)'> <span class='fa fa-trash'></span>  Eliminar</button> 

 				<a title='Editar ficha de  $nombre' class='btn botonOpciones btn-sm' href='editarPaciente.php?id_paciente=$id_paciente'> <span class='fa fa-edit'></span>  Editar</a> 
 				</td>";

    //organizando la estructura en la que se mostraran los datos en la tabla
    //es importante la se ordene los datos segun la estructura que hemos definido a la tabla que mostrara el listado de pacientes en el archivo pacientes.php
 	$listadoPacientes['data'][] = array(
    $numeracion, //numeracion: 1, 2, 3....
 	 $fila['nombre'].' '.$fila['apellidos'],//nombre y apellidos
 	 ucfirst($fila['nombre_documento']).': '.$fila['num_documento'], //tipo de documento y documento
 	 $fila['telf'],//telefono
    ucfirst($fila['sexo']),//sexo
    
    //9-1, ies auto matricula, pagar seguro fotocopias tasas, titulos

    ucfirst($fila['barrio']).', '.ucfirst($fila['distrito']),//direccion
    $fila['fecha_nacimiento'],//fecha de naciemnto
 	 $botones//botones de opciones: editar o eliminar paciente
    ); 	
 } // /while 

} // if num_rows

$conexion->close();

echo json_encode($listadoPacientes);