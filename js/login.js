
/*
* Este script es imprescindible para el funcianammiento de la pagina de login, no eliminar o desvincular de la pagina de login.
>>>> Este script contiene las funcionalides de la pagina de login, desde el carousel de imgenes de fondo de la pagina de login hasta la validadion del formulario de login.
*/
$(function() {
	'use strict';

    //inicializando el carousel de imagenes de fondo de la pantalla de login
    $("#sliderLogin").owlCarousel({
        autoplay:true,
        loop:!0,
        dots:false,
        animateOut:"fadeOut",
        animateIn:"fadeIn",
        responsive:{
            0:{items:1,dots:false},
            600:{items:1,dots:false},
            1e3:{items:1}
    }});

    //esperar que la pagina se termine cargar para mostrar la pantalla inicial de login
    document.getElementById("bodyApp").onload = function() {
        //loginInicial es el elemento que contiene nuestra panatalla inicial del login, que por deffecto está oculto.
        var loginInicial = document.getElementById("loginInicial");
        //vamos a mostrarla al terminar de cargarse la pagina     
        loginInicial.classList.add('visible');
    };




    /**
     * Vamos a implementar una escucha, para que esté pendiente de los clics que hacemos en el body de la pagina de login, nos devolvera el elemento que se ha clickeado, y en funcion del elemento que se ha clickeado, vamos a oculatar o mostrar el formulario de login y la pantalla inicial de la pagina de login.
     */
    $('body').click(function(e) {

        //agaramos el elemento que se ha clickeado
        var elementoClickeado = $(e.target);

        //verificamos si el elemnto clickeado es nodo o hijo del div con clase .row que es quién contiene la caja del formulario de  o que el elemento clickeado es la caja o div que contiene las notificacion que se muestra en pantalla.
        if ( elementoClickeado.parents(".cajaFormularioLogin .row").length == 1 || elementoClickeado.parents(".notificaciones").length == 1) { 
            // El elemento Clickeado esta dentro del div del formulario, por lo que no realizaremos ninguna accion

        } else {

            // el elemento no está del div del formulario, es decir, el elemento no es un nodo del div del formulario, por lo que hay dos probabilidades:
            
            //>> Propabilidad 1: que el elemento clickeado sea el boton para mostrar el formulario de login:
            if(elementoClickeado.is('#mostrarLogin')){
                //si el elemento es el boton para mostrar el formulario de login, entoces, lo mostramos, y ocultamos la pantalla inicial de login
                $('#contenedorLogin').addClass('visible');   
                $('#loginInicial').removeClass('visible');
            }else{
                //Prababilidad 2: el elemento no es el botton para mostrar el formulario de login:
                //por lo que se ha clickeado fuera del formulario de login, por lo que vamos a ocultar el formulario de login y mostramos la pantalla inicial de login
                $('#contenedorLogin').removeClass('visible');   
                $('#loginInicial').addClass('visible');
            }

        }

    });

    // submit el formulario login
    $('#formularioLogin').on('submit', function(event){
        event.preventDefault();
        var formulario = $(this);
        
        $.ajax({//vamos a validar el formulario por ajax, no se recargara la pagina
        url : formulario.attr('action'),//ruta a donde se manda el formulario
        type: formulario.attr('method'),//metodo que se utiliza: post, get
        data: formulario.serialize(),
        dataType:"json",
        beforeSend:function()
        { 
            //cambiamos el texto del boton Login y lo desabilitamos;
            $('#botonLogin').text('Verificando credenciales...');
            $('#botonLogin').attr('disabled', 'disabled');
        },
        success:function(respuesta){
            //vamos a recibimos la respuesta a traves de la variable $notificacion del archivo registrarPaciente
            //guardamos el mensaje a mostrar  en la variable menasaje
            var mensaje = respuesta.mensaje;
            //si el tipo de mensaje de es exitoso mostrarmos un mensaje de exito
            if (respuesta.exitoso == true) {
                $('#botonLogin').text('¡Credenciales correctas!');
                $('#botonLogin').attr('disabled', true);

                //llamamos a la funcion para mostrar mensajes de exitos. que está declarada en el footer.php
                mostrarMensajeExitoso(mensaje);
                //despues de 4 segundos, vamos a redireccionar al usuario a la pagina de inicio, ya que los datos que ha proporcionado son correctos
                window.setTimeout(function() {
                    window.location.replace('inicio.php');
                }, 4000);

            }else{
                //ha habido algun error, por lo que vamos a mostrar un mensaje de error
                $('#botonLogin').text('¡Reintentar...!');
                $('#botonLogin').attr('disabled', false);//habilitamos el boton login

                //llamamos a la funcion que muestra mensajes de error, que esta declarada en el footer
                mostrarMensajeError(mensaje);

            }

        }
        })
    });



});