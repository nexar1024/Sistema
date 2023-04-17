// Cargar modal de boostrap para agregar nueva entrevista
// Usaremos el "shorter method"
$(function() { 
	$("#boton_agregar_entrevista").click(function() {
		$("#modal_agregar_entrevista").modal("show");
	});
});

// Mostrar entrevista
function mostrarEntrevista() {
    // Mostrar entrevista con el método ajax POST
    $.post("ajax_entrevista/mostrarEntrevista.php", {}, function(data, status) {
        $("#tabla_entrevista").html(data);
    });
}

// Mostrar entrevista al cargar la página
$(function() {
    mostrarEntrevista(); // Llamando a la función
});

// Agregar nueva entrevista
function agregarEntrevista() {
    // Obtener los valores de los inputs
    var id_usuario  = $("#hidden_id_usuario").val();
    var tituloE      = $("#tituloE").val();
    var objetivo    = $("#objetivo").val();
    var nombre_entrevistado = $("#nombre_entrevistado").val();
    var fecha_final = $("#fecha_final").val();
    // Agregar entrevista con el método ajax POST
    $.post("ajax_entrevista/agregarEntrevista.php",
        {
            tituloE      : tituloE,
            objetivo : objetivo,
            nombre_entrevistado : nombre_entrevistado,
            fecha_final : fecha_final,
            id_usuario  : id_usuario
        },
        function (data, status) {
            // Cerrar el modal
            $("#modal_agregar_entrevista").modal("hide");
            // Mostrar las entrevistas nuevamente
            mostrarEntrevista();
            // Limpiar campos del modal
            $("#tituloE").val("");
            $("#objetivo").val("");
            $("#nombre_entrevistado").val("");
            $("#fecha_final").val("");
        }
    ) ;
}

// Eliminar entrevista
function eliminarEntrevista(id_entrevista) {
    var conf = confirm("¿Estas seguro de eliminar la Entrevista?");
    if (conf == true) {
        // Eliminar entrevista con el método ajax POST
        $.post("ajax_entrevista/eliminarEntrevista.php", {id_entrevista: id_entrevista}, function (data, status) {
            // Volver a cargar la tabla de entrevistas
            mostrarEntrevista();
        });
    }
}

// Publicar entrevista
function publicarEntrevista(id_entrevista) {
    var conf = confirm("¿Estas seguro de publicar la Entrevista?");
    if (conf == true) {
        // Publicar entrevista con el método ajax POST
        $.post("ajax_entrevista/publicarEntrevista.php", {id_entrevista: id_entrevista}, function (data, status) {
            // Volver a cargar la tabla de entrevistas
            mostrarEntrevista();
        });
    }
}

// Finalizar entrevista
function finalizarEntrevista(id_entrevista) {
    var conf = confirm("¿Estas seguro de finalizar la Entrevista?");
    if (conf == true) {
        // Publicar entrevista con el método ajax POST
        $.post("ajax_entrevista/finalizarEntrevista.php", {id_entrevista: id_entrevista}, function (data, status) {
            // Volver a cargar la tabla de entrevistas
            mostrarEntrevista();
        });
    }
}

function obtenerDetallesEntrevista(id_entrevista) {
    // Agregar id_entrevista al campo oculto
    $("#hidden_id_entrevista").val(id_entrevista);

    $.post("ajax_entrevista/mostrarDetallesEntrevista.php", {id_entrevista: id_entrevista}, function (data, status) {
        // PARSE json data
        var entrevista = JSON.parse(data);
        // Asignamos valores de la entrevista al modal
        $("#modificar_tituloE").val(entrevista.tituloE);
        $("#modificar_objetivo").val(entrevista.objetivo);
        $("#modificar_nombre_entrevistado").val(entrevista.nombre_entrevistado);
        $("#modificar_fecha_final").val(entrevista.fecha_final);
    });
    // Abrir modal de modificar
    $("#modal_modificar_entrevista").modal("show");
}

// Funcion modificarDetallesentrevista del modal modificar producto
function modificarDetallesEntrevista() {
    // Obtener valores
    var tituloE      = $("#modificar_tituloE").val();
    var id_entrevista = $("#hidden_id_entrevista").val();
    var objetivo = $("#modificar_objetivo").val();
    var nombre_entrevistado = $("#modificar_nombre_entrevistado").val();
    var fecha_final = $("#modificar_fecha_final").val();

    // Modificar detalles consultando al servidor usando ajax
    $.post("ajax_entrevista/modificarDetallesEntrevista.php",
        {
            id_entrevista : id_entrevista,
            tituloE      : tituloE,
            objetivo : objetivo,
            nombre_entrevistado : nombre_entrevistado,
            fecha_final : fecha_final
        },
        function (data, status) {
            // Ocultar el modal utilizando jQuery
            $("#modal_modificar_entrevista").modal("hide");
            // Volver a cargar la tabla productos
            mostrarEntrevista();
        }
    ) ;
}

