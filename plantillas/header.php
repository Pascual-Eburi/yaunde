<?php 
//no incluiremos el archivo que controla las sesiones si la pagina actual es login. Esto se debe a que si la incluimos, creará conflictos y la pagina de login no se mostrará.
$paginaActual = paginaActual();
if($paginaActual !='Login'){
  require_once ('php/verificarSesion.php');
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#3a6ee9" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	
	<link rel="stylesheet" href="librerias/iconos/fontawesome/css/all.css">
	
	<!-- #1976d2<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">	<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">-->	
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="librerias/dataTables/css/datatables.min.css"/>
    <link href="librerias/OwlCarousel2/owl.carousel.min.css" rel="stylesheet" media="screen">
    <!-- CSS Files 
  <link href="librerias/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />-->


  <!-- CUSTOM CSS -->
  <link rel="stylesheet" type="text/css" href="css/estilos.css">
<title>Centro de salud - <?php echo paginaActual(); ?></title>
</head>

<body id="bodyApp">

<?php
//vamos a trabajar con sesiones para controlar el acceso al sistema

//la variable de sesion id_usuario, guardará el id del usurio que ha accedido al sistema, si esta variable no está definida o no existe, vamos a ocultar el menu de navegacion
if(isset($_SESSION['id_usuario'])){ ?>

<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Centro de Salud </a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php"><i class="fas fa-home"></i> Inicio <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-briefcase-medical"></i> Pacientes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="nuevoPaciente.php">Registrar paciente</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="pacientes.php">Listado de pacientes</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-chalkboard-teacher"></i> Consultas</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="#">
		<i class="fas fa-user-injured"></i> Ingresos</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-hospital-user"></i> Personal</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-briefcase-medical"></i> Informes</a>
      </li>
    </ul>

	<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-users-cog"></i> Ajustes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-user-circle"></i> Mi cuenta</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="php/cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a>
      </li>

    </ul>

  </div>
</nav>
<?php } ?>
