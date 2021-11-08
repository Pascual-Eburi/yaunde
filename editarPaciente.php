<?php 

//Esta funcion muestra el nombre de la pagina actual, ES IMPRESCINDIBLE COPIAR Y PEGAR ESTE TROZO DE CODIGO AL INICIO DE CADA PAGINA FUTURA QUE SE CREE *<<< PAGINAS QUE SE ENCUENTREN DIRECTAMENTE EN LA RAIZ DEL PROYECTO, ES DECIR, QUE NO ESTAN EN NINGUNA CARPETA:ejemplo de archivos que se encuentran en la raiz del proyecto: inicio.php, login.php, crearPaciente.php... >>>>>**, y DEBE IR ANTES DEL HEADER.PHP . Esta funcion será llamada en el header en el titulo (en el title de la pagina)
function paginaActual(){
//recogemos el nombre del archivo actual
 $nombreDelArchivoActual = __FILE__ ;
 $nombrePagina = ucfirst(basename($nombreDelArchivoActual,".php"));
    //imprime el nombre del archivo actual
    return $nombrePagina;
}

?>
<?php 

//id del paciente se recibira por GET
//verificamos que el parametro recibido por GET exista, que no esté vacio y que sea un numero
if(isset($_GET['id_paciente']) && (!empty($_GET['id_paciente']))  && is_numeric($_GET['id_paciente']) == 1){
    $id_paciente = $_GET['id_paciente'];
}else{
    //si no cumple con esas condiciones, redirrecionamos al usuario a la pagina de pacientes
    header('location:pacientes.php');
}

			
?>

<?php include("plantillas/header.php");?>
  
  
<?php 


//traemos los datos del paciente
$sql = "SELECT * FROM pacientes WHERE id = {$id_paciente}";
  $resultado = $conexion->query($sql);
  $datosPaciente = $resultado->fetch_array();	
  
  ?>

<div id="container" class="container containerCrearPaciente">
		<div class="row">
			<div class="col-12 col-md-2"></div>
			<div class="col-12 col-md-8">
				<div id="text">
					<h4>Ficha de <?php   echo $datosPaciente['nombre'].' '.$datosPaciente['apellidos']; ?></h4>
				</div>
				<form class="row formularioCrearPaciente" action="php/actualizarPaciente.php" method="post" id="FormularioActualizarPaciente">
                        <input type="hidden" value="<?php   echo $id_paciente; ?>" name="id_paciente">					
						<div class="col-md-6 form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" placeholder="Introduzca el nombre del paciente" id="nombre" name="nombre" required value="<?php   echo $datosPaciente['nombre']; ?>">
						</div>

						<div class="col-md-6 form-group">
							<label for="apellidos">Apellidos:</label>
							<input type="text" class="form-control" placeholder="Introduzca los apellidos del paciente" id="apellidos" name="apellidos" required value="<?php   echo $datosPaciente['apellidos']; ?>">
						</div>
                        <div class="col-md-6 form-group">
							<label for="telefono">Barrio:</label>
							<input type="text" class="form-control" placeholder="Introduzca el barrio del paciente" id="telefono" name="barrio" required value="<?php   echo $datosPaciente['barrio']; ?>">
						</div>

						<div class="col-md-6 form-group">
							<label for="telefono">Distrito:</label>
							<input type="text" class="form-control" placeholder="Introduzca el distrito del paciente" id="distrito" name="distrito" required value="<?php   echo $datosPaciente['distrito']; ?>">
						</div>
						<div class="col-md-4 form-group">
							<label for="email">Sexo del paciente:</label>
							<select id="sexo" name="sexo" class="custom-select" required>
								<option selected>---Seleccione un sexo---</option>
								<option value="Masculino" <?php if(ucfirst($datosPaciente['sexo']) == 'Masculino') {
				      		echo "selected";
				      	} ?>>Masculino</option>
								<option value="Femenino" <?php if(ucfirst($datosPaciente['sexo']) == 'Femeninio') {
				      		echo "selected";
				      	} ?>>Femenino</option>
							</select>
						</div>
						<div class="col-md-4 form-group">
							<label for="telefono">Telefono:</label>
							<input type="text" class="form-control" placeholder="Introduzca el telefono del paciente" id="telefono" name="telefono" required value="<?php   echo $datosPaciente['telf']; ?>">
						</div>

                        <div class="col-md-4 form-group">
							<label for="telefono">Fecha Nacimiento:</label>
							<input type="date" class="form-control" placeholder="dd/mm/yyyy" id="fechaNacimiento" name="fechaNacimiento" required value="<?php   echo $datosPaciente['fecha_nacimiento']; ?>">
						</div>
						<div class="col-md-6 form-group">
							<label for="tipo_documento">Tipo de documento:</label>
							<select id="tipo_documento" name="tipo_documento" class="custom-select" required>
								<option selected>---Seleccione una opcion---</option>
								<option value="dip" <?php if($datosPaciente['nombre_documento'] == 'dip') {
				      		echo "selected";
				      	} ?>>DIP - Documento de Identidad Personal</option>
								<option value="pasaporte" <?php if($datosPaciente['nombre_documento'] == 'pasaporte') {
				      		echo "selected";
				      	} ?> >Pasaporte</option>
							</select>
						</div>
			
						<div class="col-md-6 form-group">
							<label for="documento">Numero de documento</label>
							<input type="text" class="form-control" placeholder="Numero de documento del paciente" name="documento" id="documento" required value="<?php   echo $datosPaciente['num_documento']; ?>">
							<span id="errores" class="errores"></span>
						</div>
						<div class="col-md-6 form-group">
							<button type="submit"id="ActualizarPaciente" class="btn btn-primary">Actualizar datos</button>
						</div>
						

				
				</form>
			</div>
			<div class="col-12 col-md-2"></div>
		</div>
	</div>

<?php include("plantillas/footer.php"); ?>
<!-- script js que contiene las funcionalidades de la pagina del listado de pacientes  -->
<script src="js/pacientes.js"></script>
<script>
    $(document).ready(function(){
        $('#fechaNacimiento').datepicker({
            uiLibrary: 'bootstrap4',
            locale: 'es-es',
        });
    });

</script>