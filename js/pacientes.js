
var tablaPacientes;

$(document).ready(function () {

    //inicializamos la tabla de datos para mostrar la lista de pacientes
    /*
        inicializamos la libreria dataTable
        1. para ello es necesario pasar el id de la tabla donde queremos cargar la tabla de datos, en este caso el id es tablaPacientes
        2: por ajax, pasaremos la url o ruta de donde vamos obtener los datos que vamos a mostrar en la tabla, que en este caso la ruta sera: php/traerListadoPacientes.php;
    */

     //iniciar la tabla de datos en la tabla con id tablaPacientes.
    tablaPacientes = $("#tablaPacientes").DataTable({
    "responsive": true,
    "autoWidth": false,
    "ajax":{
      "url":"./php/traerListadoPacientes.php",
      'type': "post",
    'order': []
    },
    /*
     VAMOS A MOSTRAR EN ESPAÑOL
      */
          "oLanguage": {
      "sProcessing":     "Procesando...",
        "sLengthMenu": 'Mostrar <select class="custom-select">'+
            '<option value="10">10</option>'+
            '<option value="20">20</option>'+
            '<option value="30">30</option>'+
            '<option value="40">40</option>'+
            '<option value="50">50</option>'+
            '<option value="-1">Todos</option>'+
            '</select> registros',    
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Por favor espere - cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "<i class='fas fa-chevron-right'></i>",
            "sPrevious": "<i class='fas fa-chevron-left'></i>"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
     }
      /*drawCallback:function(){
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded")}*/

    });

    /************************************************************* 
        VALIDANDO EL FORMULARIO DE ACTUALIZACION DE USUARIOS
        El formulario se enviara por ajax a traves del metodo post sin que la pagina recargue.
    ****************************************************************/
    $('#FormularioActualizarPaciente').on('submit', function(event){
        event.preventDefault();

        var formulario = $(this);
        $.ajax({
        url:formulario.attr('action'),
        method: formulario.attr('method'),
        data: formulario.serialize(),
        dataType:"json",
        beforeSend:function()
        {
            $('#ActualizarPaciente').attr('disabled', 'disabled');
            $('#ActualizarPaciente').text('Actualizando ficha....');

        },
        success:function(respuesta){
            
            //vamos a recibimos la respuesta a traves de la variable $notificacion del archivo actualizarPaciente
            //guardamos el mensaje a mostrar  en la variable menasaje
            var mensaje = respuesta.mensaje;
            //si el tipo de mensaje de es exitoso mostrarmos un mensaje de exito
            if(respuesta.exitoso == true) {
                $('#ActualizarPaciente').attr('disabled', false);
                $('#ActualizarPaciente').text('Actualizar ficha');
            
                //llamamos a la funcion para mostrar mensajes de exitos. que está declarada en el footer.php
                mostrarMensajeExitoso(mensaje);
                
                //despues de 4 segundos, vamos a redireccionar al usuario a la pagina de inicio, ya que los datos que ha proporcionado son correctos
                window.setTimeout(function() {
                    window.location.replace('pacientes.php');
                }, 3000);
            }else{

                $('#ActualizarPaciente').attr('disabled', 'disabled');
                $('#ActualizarPaciente').text('Reintentar otra ves');
                //Imprimiendo el mensaje en pantalla
                //llamamos a la funcion que muestra mensajes de error, que esta declarada en el footer
                mostrarMensajeError(mensaje);
            }

        }, 
        error: function(){
            console.log("Ha ocurrido algun error");
        }
        });
    });

});


/**
 * ESTA FUNCION ELIMINAA AL USUARIO DE LA BASE DE DATOS
 */

function eliminarPaciente(id_paciente){
    if(id_paciente){

        $("#botonEliminar").unbind('click').bind('click', function(event) {
           // console.log(id_paciente);
            event.preventDefault();
            $.ajax({
                url: 'php/eliminarPaciente.php',//ruta archivo k eliminara en la bd
                type: 'post',//metodo por el que se mandan los datos
                data: {id_paciente : id_paciente},//mandamos el id del paciente
                dataType: 'json',
                beforeSend:function(){
                    $('#botonEliminar').text('Eliminando ficha...');
                    $('#botonEliminar').attr('disabled', 'disabled');
                },
                success:function(respuesta) {
                    //console.log(respuesta);
                    //vamos a recibimos la respuesta a traves de la variable $notificacion del archivo eliminarPaciente
                    //guardamos el mensaje a mostrar  en la variable menasaje
                    var mensaje = respuesta.mensaje;
                    //si el tipo de mensaje de es exitoso mostrarmos un mensaje de exito

                    if(respuesta.exitoso == true) { 

                    $('#botonEliminar').attr('disabled', true);
                    //ocultamos la venta en la que se nos preguntaba si queremos eliminar esta ficha
                    $('#modalEliminarPaciente').modal('hide');
                      
                    //refrezcamos la tabla de pacientes para que se muestren los cambios 
                    tablaPacientes.ajax.reload(null, false);
                        //llamamos a la funcion para mostrar mensajes de exitos. que está declarada en el footer.php
                        console.log(mensaje);
                        mostrarMensajeExitoso(mensaje);

                    } else {

                            $('#botonEliminar').attr('disabled', false);//habilitamos el boton para eliminar
                            mostrarMensajeError(mensaje);//mostramos mensaje de error

                    } // /else
                } // /respuesta
            }); // /fin funcion ajax para eliminar la ficha

        }); // /click boton eliminar
    }else{
        console.log('Refresca la pagina, es necesario un Id');
    }
}