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

<!-- Incluyendo el header de la pagina  -->
<?php include("plantillas/header.php"); ?>

<!-- CONTENDIO DE LA PAGINA -->
<section class="listadoPacientes">
<div class="container mt-3">
		<div class="row">
			<div class="col-12 col-md-9">
				<h2>Lista de pacientes</h2>
  				<p>Aquí puede consultar la lista de pacientes registrados en el sistema</p>
			</div>
	
			<div class="col-12" id="tabla">	
				<table id="tablaPacientes" class="table table-bordered table-striped" style="width:100%">	
					<thead>
						<tr>
                              <!-- Es importante construir la tabla con el mismo orden en la que hemos estructurados los datos que se mostraran en ella en el archivo traerListadoPacientes.php en la carpeta php -->		
							<th>#</th><!--Numeracion -->
							<th>Nombre</th><!-- nombre completo -->
							<th>Documento</th><!-- documento -->
							<th>Telf.</th><!--Telefono  -->
							<th>Sexo </th><!-- sexo -->
							<th> Direccion</th><!-- dirreccion -->
							<th>Fecha N. </th><!-- Fecha nacimiento -->
							<th>Opciones</th><!--  -->			
						</tr>
					</thead>
                    <tbody>
                        <!-- Con js mostraremos el listado de pacientes, desde el archivo pacientes.j, que se encuentra en la carpeta js -->
                    </tbody>
				</table>	
			</div>
		</div>
	</div>
</section>

<!-- Modal: Esta ventana aparecerá al hacer click en el boton para eliminar a un paciente -->
<div class="modal fade modal-eliminar" id="modalEliminarPaciente" tabindex="-1" role="dialog" aria-labelledby="modalEliminarPacienteCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <img src="imagenes/alert.png">
            <h4>¡ Vas a eliminar la ficha de este paciente !</h4>
                <p>¿ Estás seguro que quieres eliminarla ?. Al eliminarla,<span>será borrada del sistema y no podrás recuperarla.</span>
            </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">No, cancelar</button>
        <button type="button" class="btn btn-white" id="botonEliminar">Sí, eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- FIN CONTENDIO DE LA PAGINA -->
<!-- Incluyendo el footer de la pagina  -->
<?php include('plantillas/footer.php'); ?>
<!-- script js que contiene las funcionalidades de la pagina del listado de pacientes  -->
<script src="js/pacientes.js"></script>