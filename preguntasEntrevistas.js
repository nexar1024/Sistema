// Cargar modal de boostrap para agregar nueva pregunta
// Usaremos el "shorter method"
$(function() {
	$("#boton_agregar").click(function() {
		$("#modal_agregar").modal("show");
	});
});


var id_entrevista = $("#id_entrevista").val();

// Mostrar encuestas
function mostrarPreguntas(id_entrevista) {
    // Mostrar encuestas con el método ajax POST
    $.post("ajax_preguntaEntrevista/mostrarPreguntas.php", {
    	id_entrevista : id_entrevista
    }, function(data, status) {
        $("#tabla_preguntas").html(data);
    });
}

// Mostrar encuestas al cargar la página
$(function() {
    mostrarPreguntas(id_entrevista); // Llamando a la función
});

// Agregar nueva pregunta
function agregarPregunta() {
    // Obtener los valores de los inputs
    var id_entrevista 		= $("#id_entrevista").val();
    var titulo      	 	= $("#titulo").val();
    // Agregar encuesta con el método ajax POST
    $.post("ajax_preguntaEntrevista/agregarPregunta.php",
        {
        	id_entrevista 		: id_entrevista,
            titulo      		: titulo,
        },
        function (data, status) {
            // Cerrar el modal
            $("#modal_agregar").modal("hide");
            // Mostrar las encuestas nuevamente
            mostrarPreguntas(id_entrevista);
            // Limpiar campos del modal
            $("#titulo").val("");
        }
    ) ;
}

// Eliminar Pregunta
function eliminarPregunta(id_pregunta) {
    var conf = confirm("Estas seguro de eliminar la Pregunta");
    if (conf == true) {
        // Eliminar pregunta con el método ajax POST
        $.post("ajax_preguntaEntrevista/eliminarPregunta.php", {id_pregunta: id_pregunta}, function (data, status) {
            // Volver a cargar la tabla de encuestas
            mostrarPreguntas(id_entrevista);
        });
    }
}



function obtenerDetallesPregunta(id_pregunta) {
    // Agregar id_pregunta al campo oculto
    $("#hidden_id_pregunta").val(id_pregunta);

    $.post("ajax_preguntaEntrevista/mostrarDetallesPregunta.php", {id_pregunta: id_pregunta}, function (data, status) {
        // PARSE json data
        var pregunta = JSON.parse(data);
        // Asignamos valores del encuesta al modal
        $("#modificar_titulo").val(pregunta.titulo);
    });
    // Abrir modal de modificar
    $("#modal_modificar").modal("show");
}

// Funcion modificarDetallesPregunta del modal modificar pregunta
function modificarDetallesPregunta() {
    // Obtener valores
    var titulo      = $("#modificar_titulo").val();
    var id_pregunta = $("#hidden_id_pregunta").val();

    // Modificar detalles consultando al servidor usando ajax
    $.post("ajax_preguntaEntrevista/modificarDetallesPregunta.php",
        {
            id_pregunta : id_pregunta,
            titulo      : titulo
        },
        function (data, status) {
            // Ocultar el modal utilizando jQuery
            $("#modal_modificar").modal("hide");
            // Volver a cargar la tabla pregunta         
            var id_pregunta = $("#id_pregunta").val();
            mostrarPreguntas(id_entrevista);
        }
    ) ;
}