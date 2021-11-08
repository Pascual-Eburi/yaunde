  <!-- En este div se mostraran todos los mensajes y notificaiones-->
<div class="notificaciones" id="mensajesNotificacion">
	<div class="toast" data-autohide="false">
		<div class="toast-body">
  			<!-- Aqui se inscrustará el mensaje a mostrar. -->
		</div>
	</div>
</div>

<!-- LIBRERIAS UTILIZADAS . -->
<!-- jQuery. -->
<script src="js/jquery-3.5.1.js"></script>
<!-- popper: Da soporte al core de bootstrap -->
<script src="librerias/bootstrap/js/popper.min.js"></script>
<!-- bootstrap js: Para funcionalides como modales, etc.. -->
<script src="librerias/bootstrap/js/bootstrap.min.js"></script>
<!-- pdfmaker: Para exportar datos de tablas en pdf -->
 <script type="text/javascript" src="librerias/dataTables/js/pdfmake.min.js"></script>
<!-- vfs_fonts: Da soporte de fuentes a las datablas de datos -->
 <script type="text/javascript" src="librerias/dataTables/js/vfs_fonts.js"></script>
<!-- tabla de tados<<dataTables>>: Para mostrar datos en tablas -->
 <script type="text/javascript" src="librerias/dataTables/js/datatables.min.js"></script>
<!-- Chart JS: para graficos -->
<script src="librerias/charts/chartjs.min.js"></script>

<!-- Charts: implementacion de los graficos! -->
  <script src="librerias/charts/charts.js"></script>
  <script>
    $(document).ready(function() {
      // Inicializando los graficos
      demo.initDashboardPageCharts();

    });
  </script>
 
 <script>
	 function mostrarMensajeExitoso(mensaje){
		$('.toast').toast('show');
            $('#mensajesNotificacion .toast').addClass('toast-succes');
            $('.toast-body').text(mensaje);

			window.setTimeout(function() {
    			$('.toast').toast('hide');
			}, 6000);
	 }

	 function mostrarMensajeError(mensaje){
		$('.toast').toast('show');
            $('#mensajesNotificacion .toast').addClass('toast-danger');
            $('.toast-body').text(mensaje);
			window.setTimeout(function() {
    			$('.toast').toast('hide');
			}, 6000);

			/*$(".toast-danger").delay(500).show(10, function() {
				$(this).delay(6000).hide(10, function() {
					$(this).remove();
				});
			}); // /.notificacion */
	 }

 </script>
</body>
</html>	
