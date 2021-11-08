<?php 
    //Este trozo de codigo pertenece unica y exclusivamente a esta pagina (Login), no incluir en otra pagina. Se encarga de verificar si se ha iniciado sesion, en caso de que sí, redireccionara al usuario a la pagina de inicio del sistema.
    session_start();
    if(isset($_SESSION['id_usuario'])) {
        header('location: inicio.php');	
    }
?>


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
<!---->

<section>
    <!-- Carousel o Slider de imagenes de fondo  -->
    <div class="owl-carousel carousel-login carousel-style-one" id="sliderLogin">
        <div class="carousel-item active bg-image" style="background-image:url(imagenes/login-2.jpg)"></div>
        <div class="carousel-item active bg-image" style="background-image:url(imagenes/login-1.jpg)"></div>
        <div class="carousel-item active bg-image" style="background-image:url(imagenes/login-3.jpg)"></div>
        <div class="carousel-item active bg-image" style="background-image:url(imagenes/login-5.jpg)"></div>

        <div class="carousel-item active bg-image" style="background-image:url(imagenes/login.jpg)"></div>
        <div class="carousel-item active bg-image" style="background-image:url(imagenes/login-4.jpg)"></div>
        <div class="carousel-item active bg-image" style="background-image:url(imagenes/login-6.jpg)"></div>
    </div>
    <!-- Pantalla inicial de login, se mostrará al terminar de cargar la pagina -->
    <div class="d-lg-flex loginInicial" id="loginInicial"> 
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-10 col-md-7 col-lg-4 col-sm-9 bodyLoginInicial align-items-center justify-content-center">
                    <img src="imagenes/avatarUsuario.png">
                    <h3>Inicio de Sesion</h3>
                    <p class="mb-4">Inicie sesion para acceder al sistema del Centro de salud.</p>
                    <button type="button" class="" id="mostrarLogin"> 
                            <i class="fa fa-key" aria-hidden="true"></i>
                        Iniciar Sesion
                    </button>
                </div>
            </div>
        </div>
    </div>

     <!-- contenedor que contiene el formulario de login, por defecto esta oculto  -->
    <div class="d-lg-flex contenedorLogin" id="contenedorLogin"> 
        <div class="cajaImagen order-1 order-md-1"></div>   
        <div class="cajaFormularioLogin order-2 order-md-2">
            <div class="container">
                <div class="row align-items-center justify-content-center ">
                    <div class="col-md-11 col-lg-7 col-sm-9 col-11 bodyFormulario">                    
                        <form action="php/login.php" method="post" id="formularioLogin">
                            <div class="input-group form-group first">
                                <label for="correo">Email</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="iconoEmail">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="email" class="" placeholder="Introduzca su correo" id="correo" name="correo" autocomplete="off">
                            </div>
                            <div class="input-group form-group last mb-3">
                                <label for="codigo">Contraseña</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="iconoCodigo">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="password" class="" placeholder="Introduzca tu contraseña" id="codigo" name="codigo" autocomplete="off">
                            </div>

                            <button type="submit" class=" " id="botonLogin"> 
                                <i class="fa fa-angle-up" aria-hidden="true"></i>
                            Acceder al sistema
                            </button>
                            <div class="d-flex mt-5 align-items-center justify-content-center">
                                <span class="text-center">
                                    <a href="#" class="forgot-pass">He olivadado mi contraseña</a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Incluyendo el footer de la pagina  -->
<?php include('plantillas/footer.php'); ?>
<!-- Este script controla el carousel de imagenes de fondo de esta pagina, solo se incluye en esta pagina porque es la unica que se va a utilizar -->
<script src="librerias/OwlCarousel2/owl.carousel.min.js"></script>

<!-- Este script controla las funciones de esta pagina  -->
<script src="js/login.js"></script>