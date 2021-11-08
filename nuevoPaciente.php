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

<?php include("plantillas/header.php"); ?>
	
	<div id="container" class="container containerCrearPaciente">
		<div class="row">
			<div class="col-12 col-md-2"></div>
			<div class="col-12 col-md-8">
				<div id="text">
					<h4>Nuevo Paciente</h4>
				</div>
				<form class="row formularioCrearPaciente" action="php/registrarPaciente.php" method="post" id="FormularioRegistrarPaciente">					
						<div class="col-md-6 form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" placeholder="Introduzca el nombre del paciente" id="nombre" name="nombre" required>
						</div>

						<div class="col-md-6 form-group">
							<label for="apellidos">Apellidos:</label>
							<input type="text" class="form-control" placeholder="Introduzca los apellidos del paciente" id="apellidos" name="apellidos" required>
						</div>
						<div class="col-md-6 form-group">
							<label for="email">Sexo del paciente:</label>
							<select id="sexo" name="sexo" class="custom-select" required>
								<option selected>---Seleccione un sexo---</option>
								<option value="Masculino">Masculino</option>
								<option value="Femenino">Femenino</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
							<label for="telefono">Telefono:</label>
							<input type="text" class="form-control" placeholder="Introduzca el telefono del paciente" id="telefono" name="telefono" required>
						</div>
						<div class="col-md-6 form-group">
							<label for="tipo_documento">Tipo de documento:</label>
							<select id="tipo_documento" name="tipo_documento" class="custom-select" required>
								<option selected>---Seleccione una opcion---</option>
								<option value="dip">DIP - Documento de Identidad Personal</option>
								<option value="pasaporte">Pasaporte</option>
							</select>
						</div>
			
						<div class="col-md-6 form-group">
							<label for="documento">Numero de documento</label>
							<input type="text" class="form-control" placeholder="Numero de documento del paciente" name="documento" id="documento" required>
							<span id="errores" class="errores"></span>
						</div>
						<div class="col-md-6 form-group">
							<button type="submit"id="registrarPaciente" class="btn btn-primary">Registrar paciente</button>
						</div>
						

				
				</form>
			</div>
			<div class="col-12 col-md-2"></div>
		</div>
	</div>


<?php include('plantillas/footer.php'); ?>

<script>
		$(document).ready(function(){
			//$('.toast').toast('hide');
			
    		//verificar en tiempo real si el valor introducido en el campo de documento es correcto o cumple con el formato

			//verificar en tiempo real al seleccionar un tipo de documento que el valor existente(si lo hay) en el input documento cumple con el formato --SOLO NUMEROS---
			/*============================================================================
				1. Pragramamos un envento que esté atento a las elecciones que hacemos al elegir un tipo de documento, dip o pasaporte, para validar si el valor que haya en el imput documento cumple con el formato o patrón establecido
					>> Para DIP: solo numeros
					>> Para PASAPORTE: solo numeros y letras, es decir, la combinacion de letras y numeros (no aceptara solo numeros o solo letras)
			=======================================================================*/
			$('#tipo_documento').change(function(){
				
				//guardamos el tipo de documento seleccionado
				var tipoDeDocumento = $(this).val();

				//guardamos el valor que haya en el input documento y eliminamos todos los espacios vacios
				var documento = $('#documento').val().trim() ;

				//valida que el input no este vacio y el tipo de documento seleccionado es DIP
				if(documento !== "" && tipoDeDocumento ==="dip"){
					//vamos a validar que solo el input acepte numeros si el tipo de documento elegido es DIP

					//patron para detectar numeros
					var patron = /^\d+$/;

					//verificamos si el valor recibido como ducumento contiene solo numeros
					if(!(patron.test(documento))){ 
						//console.log(documento + "No cumple con el formato");
						$('#errores').text(documento + " No cumple con el formato, el Dip solo puede contener números.");
						$('#documento').parent().addClass('has-error');
						$('#registrarPaciente').attr("disabled", true);
					}else{
						$('#errores').text(" ");
						$('#documento').parent().removeClass('has-error');
						$('#registrarPaciente').attr("disabled", false);

						//4. vamos a verificar que el dip introducido no pertenece todavia a un paciente
						$.ajax({
							url:'php/verificarDocumento.php',
							method:"POST",
							data:{documento:documento},
							success:function(numeroDocumentosEncontrados){

								if(numeroDocumentosEncontrados != '0'){
									//si la funcion devuelve un numero distinto de 0 es que el documento ya existe en la base de datos:

									//1: Seleccionamos el elemento span con id errores, y mostramos un mensaje de que el documento introducido no cumple con el formato
									$('#errores').text("El DIP "+ documento + " ya pertenece a un paciente.");

									//2: Seleccionamos el input con id documento, que es donde hemos introducido el valor y transcendemos hasta su elemento padre, que es div, para agregarle una clase "has-error: (español: tiene-error) para poder agregar un color rojo al titulo del input y un borde rojo al propio input, y así resaltar el error."
									$('#documento').parent().addClass('has-error');

									//3. Ya que el documento ya está registrado en la bd, desabilitamos el botton submit para que no se pueda validar el formulario.
									$('#registrarPaciente').attr("disabled", true);
								}else{
									//no se ha encotrado el documento en la base de datos, por lo que ningun paciente lo tiene

									$('#errores').text(" ");
									$('#documento').parent().removeClass('has-error');
									$('#registrarPaciente').attr("disabled", false);
								}
							}
						});
					}
				}//fin validacion Dip

				
				/*===================================================
					VAMOS A VALIDAR EL PASAPORTE << solo numeros y letras >>>
					-- por lo que si se introduce solo numeros, no sera valido 
					--si se introduce solo letras, no será valido
				========================================================*/
				if(documento !== "" && tipoDeDocumento ==="pasaporte"){
					//vamos a validar que solo el input acepte solo numeros y letras si el tipo de documento elegido es pasaporte

					//patron para detectar alfanumericos
					var patronPasaporte = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/;

					//verificamos si el valor recibido como ducumento contiene solo caracteres y numeros
					if(!(patronPasaporte.test(documento))){ 
						$('#errores').text(documento + " No es valido, el Pasaporte debe contener numeros y letras.");
						$('#documento').parent().addClass('has-error');
						$('#registrarPaciente').attr("disabled", true);
					}else{
						$('#errores').text(" ");
						$('#documento').parent().removeClass('has-error');
						$('#registrarPaciente').attr("disabled", false);
												
						//4. vamos a verificar que el dip introducido no pertenece todavia a un paciente
						$.ajax({
							url:'php/verificarDocumento.php',
							method:"POST",
							data:{documento:documento},
							success:function(numeroDocumentosEncontrados){
								//console.log(numeroDocumentosEncontrados);
								if(numeroDocumentosEncontrados != '0'){
									//si la funcion devuelve un numero distinto de 0 es que el documento ya existe en la base de datos:

									//1: Seleccionamos el elemento span con id errores, y mostramos un mensaje de que el documento introducido no cumple con el formato
									$('#errores').text("El Pasaporte "+ documento + " ya pertenece a un paciente.");

									//2: Seleccionamos el input con id documento, que es donde hemos introducido el valor y transcendemos hasta su elemento padre, que es div, para agregarle una clase "has-error: (español: tiene-error) para poder agregar un color rojo al titulo del input y un borde rojo al propio input, y así resaltar el error."
									$('#documento').parent().addClass('has-error');

									//3. Ya que el documento ya está registrado en la bd, desabilitamos el botton submit para que no se pueda validar el formulario.
									$('#registrarPaciente').attr("disabled", true);
								}else{
									//no se ha encotrado el documento en la base de datos, por lo que ningun paciente lo tiene
									$('#errores').text(" ");
									$('#documento').parent().removeClass('has-error');
									$('#registrarPaciente').attr("disabled", false);
								}
							}
						});
					}
				}//fin validacion pasaporte


			});//fin validaciones al seleccionar tipo de documento


			/*============================================================================
				2. Programos una funcion que esté atento cada vez que introducimos valores el input documento así podremos validar en tiempo real si este valor cumple con el formato establecido:
					>> Para DIP: solo numeros
					>> Para PASAPORTE: solo numeros y letras, es decir, la combinacion de letras y numeros (no aceptara solo numeros o solo letras)
			============================================================== */
			$('#documento').keyup(function(){
				//Transformamos en mayusculas todas las letras introducidas en el input documento
				$('#documento').val($(this).val().toUpperCase()) ;
				//guardamos el tipo de documento seleccionado y eliminamos todos los espacios vacios
				var tipoDeDocumento = $('#tipo_documento').val().trim();

				//guardamos el valor que haya en el input documento 
				var documento = $(this).val();
				//console.log(documento);

				//valida que el input no este vacio y el tipo de documento seleccionado es DIP
				if(documento !== "" && tipoDeDocumento ==="dip"){
					//vamos a validar que solo el input acepte numeros si el tipo de documento elegido es DIP

					//patron para detectar solo numeros
					var patron = /^\d+$/;

					//verificamos si el valor recibido como ducumento contiene solo numeros
					if(!(patron.test(documento))){ 
						//si el documento no cumple:

						//1: Seleccionamos el elemento span con id errores, y mostramos un mensaje de que el documento introducido no cumple con el formato
						$('#errores').text(documento + " No cumple con el formato, el Dip solo puede contener números.");

						//2: Seleccionamos el input con id documento, que es donde hemos introducido el valor y transcendemos hasta su elemento padre, que es div, para agregarle una clase "has-error: (español: tiene-error) para poder agregar un color rojo al titulo del input y un borde rojo al propio input, y así resaltar el error."
						$('#documento').parent().addClass('has-error');

						//3. Ya que el documento no cumpla con el formato, desabilitamos el botton submit para que no se pueda validar el formulario.
						$('#registrarPaciente').attr("disabled", true);
					}else{
						//si el documento cumple con el formato o patron:

						//1. Seleccionamos el elemento span con id errores, borramos cualquier texto que contenga
						$('#errores').text(" ");
						
						//2. Seleccionamos el input con id documento, que es donde hemos introducido el valor y transcendemos hasta su elemento padre, que es div, para quitarle la clase "has-error: (español: tiene-error) si lo tuviese."
						$('#documento').parent().removeClass('has-error');
						
						//3. Ya que el documento cumpla con el formato, habilitamos el boton submit para que se pueda validar el formulario.
						$('#registrarPaciente').attr("disabled", false);

						//4. vamos a verificar que el dip introducido no pertenece todavia a un paciente
						$.ajax({
							url:'php/verificarDocumento.php',
							method:"POST",
							data:{documento:documento},
							success:function(numeroDocumentosEncontrados){
								if(numeroDocumentosEncontrados != '0'){
									//si la funcion devuelve un numero distinto de 0 es que el documento ya existe en la base de datos:

									//1: Seleccionamos el elemento span con id errores, y mostramos un mensaje de que el documento introducido no cumple con el formato
									$('#errores').text("El DIP "+ documento + " ya pertenece a un paciente.");

									//2: Seleccionamos el input con id documento, que es donde hemos introducido el valor y transcendemos hasta su elemento padre, que es div, para agregarle una clase "has-error: (español: tiene-error) para poder agregar un color rojo al titulo del input y un borde rojo al propio input, y así resaltar el error."
									$('#documento').parent().addClass('has-error');

									//3. Ya que el documento ya está registrado en la bd, desabilitamos el botton submit para que no se pueda validar el formulario.
									$('#registrarPaciente').attr("disabled", true);
								}else{
									//no se ha encotrado el documento en la base de datos, por lo que ningun paciente lo tiene
									$('#errores').text(" ");
									$('#documento').parent().removeClass('has-error');
									$('#registrarPaciente').attr("disabled", false);
								}
							}
						});
					}
				}

				/*===================================================
					VAMOS A VALIDAR EL PASAPORTE << solo numeros y letras >>>
					-- por lo que si se introduce solo numeros, no sera valido 
					--si se introduce solo letras, no será valido
				========================================================*/
				if(documento !== "" && tipoDeDocumento ==="pasaporte"){
					//vamos a validar que solo el input acepte solo numeros y letras si el tipo de documento elegido es pasaporte

					//patron para detectar alfanumericos
					var patronPasaporte = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/;

					//verificamos si el valor recibido como ducumento contiene solo caracteres y numeros
					if(!(patronPasaporte.test(documento))){ 
						//si el documento no cumple:

						//1: Seleccionamos el elemento span con id errores, y mostramos un mensaje de que el documento introducido no cumple con el formato
						$('#errores').text(documento + " No es valido, el Pasaporte debe contener numeros y letras.");
						
						//2: Seleccionamos el input con id documento, que es donde hemos introducido el valor y transcendemos hasta su elemento padre, que es div, para agregarle una clase "has-error: (español: tiene-error) para poder agregar un color rojo al titulo del input y un borde rojo al propio input, y así resaltar el error."
						$('#documento').parent().addClass('has-error');
						
						//3. Ya que el documento no cumple con el formato, desabilitamos el botton submit para que no se pueda validar el formulario.
						$('#registrarPaciente').attr("disabled", true);

					}else{
						//si el documento cumple con el formato o patron:

						//1. Seleccionamos el elemento span con id errores, borramos cualquier texto que contenga
						$('#errores').text("");
						
						//2. Seleccionamos el input con id documento, que es donde hemos introducido el valor y transcendemos hasta su elemento padre, que es div, para quitarle la clase "has-error: (español: tiene-error) si lo tuviese."
						$('#documento').parent().removeClass('has-error');

						//3. Ya que el documento cumpla con el formato, habilitamos el boton submit para que se pueda validar el formulario.
						$('#registrarPaciente').attr("disabled", false);


						//4. vamos a verificar que el dip introducido no pertenece todavia a un paciente
						$.ajax({
							url:'php/verificarDocumento.php',
							method:"POST",
							data:{documento:documento},
							success:function(numeroDocumentosEncontrados){
								//console.log(numeroDocumentosEncontrados);
								if(numeroDocumentosEncontrados != '0'){
									//si la funcion devuelve un numero distinto de 0 es que el documento ya existe en la base de datos:

									//1: Seleccionamos el elemento span con id errores, y mostramos un mensaje de que el documento introducido no cumple con el formato
									$('#errores').text("El Pasaporte "+ documento + " ya pertenece a un paciente.");

									//2: Seleccionamos el input con id documento, que es donde hemos introducido el valor y transcendemos hasta su elemento padre, que es div, para agregarle una clase "has-error: (español: tiene-error) para poder agregar un color rojo al titulo del input y un borde rojo al propio input, y así resaltar el error."
									$('#documento').parent().addClass('has-error');

									//3. Ya que el documento ya está registrado en la bd, desabilitamos el botton submit para que no se pueda validar el formulario.
									$('#registrarPaciente').attr("disabled", true);

								}else{
									//no se ha encotrado el documento en la base de datos, por lo que ningun paciente lo tiene
									$('#errores').text(" ");
									$('#documento').parent().removeClass('has-error');
									$('#registrarPaciente').attr("disabled", false);
								}
							}
						});
					}
				}//fin validacion pasaporte

				

				//si el input documento esta vacio, no mostramos ningun error y habilitamos el boton submit
				if(documento === ""){
					$('#errores').text(" ");
					$('#documento').parent().removeClass('has-error');
					$('#registrarPaciente').attr("disabled", false);
				}


			});//fin validacion al escribir en el input documento


			/************************************************************* 
				VALIDANDO EL FORMULARIO Y REGISTRANDO EL NUEVO PACIENTE
				El formulario se enviara por ajax a traves del metodo post sin que la pagina recargue.
			****************************************************************/
			$('#FormularioRegistrarPaciente').on('submit', function(event){
				event.preventDefault();

				var formulario = $(this);
				$.ajax({
				url:formulario.attr('action'),
				method: formulario.attr('method'),
				data: formulario.serialize(),
				dataType:"json",
				beforeSend:function()
				{
					$('#registrarPaciente').attr('disabled', 'disabled');
					$('#registrarPaciente').text('Registrando....');

				},
				success:function(notificacion){
					//console.log(notificacion);
					if(notificacion.exitoso == true) {
						$('#registrarPaciente').attr('disabled', false);
						$('#registrarPaciente').text('Registrar paciente');
						
						$("#FormularioRegistrarPaciente")[0].reset();
						$('.toast').toast('show');
						$('#mensajesNotificacion .toast').addClass('toast-succes');
						$('.toast-body').text(notificacion.mensaje);

							$(".toast-succes").delay(500).show(10, function() {
								$(this).delay(6000).hide(10, function() {
									$(this).remove();
								});
							}); // /.notificacion
					}else{

						$('#registrarPaciente').attr('disabled', 'disabled');
						$('#registrarPaciente').text('Reintentar otra ves');
						//Imprimiendo el mensaje en pantalla
						$('.toast').toast('show');
						$('#mensajesNotificacion .toast').addClass('toast-danger');
						$('.toast-body').text(notificacion.mensaje);

							$(".toast-danger").delay(500).show(10, function() {
								$(this).delay(6000).hide(10, function() {
									$(this).remove();
								});
							}); // /notificacion
					}

				}, 
				error: function(){
					console.log("Ha ocurrido algun error");
				}
				});
			});

		});
	
	</script>