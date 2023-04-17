// Cargar modal de boostrap para agregar nuevo usuario
// Usaremos el "shorter method"
$(function() { 
	$("#boton_agregar").click(function() {
		$("#modal_agregar").modal("show");
	});
});

// Mostrar usuarios
function mostrarUsuario() {
    // Mostrar usaurios con el método ajax POST
    $.post("ajax_usuario/mostrarUsuario.php", {}, function(data, status) {
        $("#tabla_usuarios").html(data);
    });
}

// Mostrar Usuarios al cargar la página
$(function() {
    mostrarUsuario(); // Llamando a la función
});

// Agregar nuevo usuario
function agregarUsuario() {
    // Obtener los valores de los inputs
    var id_usuario  = $("#hidden_id_usuario").val();
    var nombres     = $("#nombres").val();
    var apellidos   = $("#apellidos").val();
    var email       = $("#email").val();
    var clave       = $("#clave").val();
    // Agregar usuario con el método ajax POST
    $.post("ajax_usuario/agregarUsuario.php",
        {
            nombres     : nombres,
            apellidos   : apellidos,
            email       : email,
            clave       : clave,
            id_usuario  : id_usuario
        },
        function (data, status) {
            // Cerrar el modal
            $("#modal_agregar").modal("hide");
            // Mostrar los usuarios nuevamente
            mostrarUsuario();
            // Limpiar campos del modal
            $("#nombres").val("");
            $("#apelldios").val("");
            $("#email").val("");
            $("#clave").val("");
        }
    ) ;
}

// Eliminar usuario
function eliminarUsuario(id_usuario) {
    var conf = confirm("Estas seguro de eliminar el Usuario");
    if (conf == true) {
        // Eliminar usuario con el método ajax POST
        $.post("ajax_usuario/eliminarUsuario.php", {id_usuario: id_usuario}, function (data, status) {
            // Volver a cargar la tabla de usuarios
            mostrarUsuario();
        });
    }
}

function obtenerDetallesUsuario(id_usuario) {
    // Agregar id_usuario al campo oculto
    $("#hidden_id_usuario").val(id_usuario);

    $.post("ajax_usuario/mostrarDetallesUsuario.php", {id_usuario: id_usuario}, function (data, status) {
        // PARSE json data
        var usuario = JSON.parse(data);
        // Asignamos valores de los usuarios al modal
        $("#modificar_nombres").val(usuario.nombres);
        $("#modificar_apellidos").val(usuario.apellidos);
        $("#modificar_email").val(usuario.email);
        $("#modificar_clave").val(usuario.clave);
    });
    // Abrir modal de modificar
    $("#modal_modificar").modal("show");
}

// Funcion modificarDetallesUsuario del modal modificar producto
function modificarDetallesUsuario() {
    // Obtener valores
    var nombres      = $("#modificar_nombres").val();
    var id_usuario   = $("#hidden_id_usuario").val();
    var apellidos    = $("#modificar_apellidos").val();
    var email        = $("#modificar_email").val();
    var clave        = $("#modificar_clave").val();

    // Modificar detalles consultando al servidor usando ajax
    $.post("ajax_usuario/modificarDetallesUsuario.php",
        {
            id_usuario : id_usuario,
            nombres    : nombres,
            apellidos  : apellidos,
            email      : email,
            clave      : clave
        },
        function (data, status) {
            // Ocultar el modal utilizando jQuery
            $("#modal_modificar").modal("hide");
            // Volver a cargar la tabla productos
            mostrarUsuario();
        }
    ) ;
}