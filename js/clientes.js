//Variables para el módulo de clientes
var c_IdCliente = 0;
//Funciones para el módulo de clientes
function elegirCliente(id) {
    c_IdCliente = id;
}

function cargarDatosCliente() {
    if (c_IdCliente > 0) {
        $.ajax({url: "php/obtenerClienteXML.php", async: false, type: "POST", data: { idCliente: c_IdCliente }, success: function(res) {
            $('resultado', res).each(function(index, element) {
                $("#tbClienteNombre").val($(this).find("nombre").text());
                $("#tbClienteDireccion").val($(this).find("direccion").text());
                $("#tbClienteColonia").val($(this).find("colonia").text());
                $("#tbClienteTelefono1").val($(this).find("telefono1").text());
                $("#tbClienteTelefono2").val($(this).find("telefono2").text());
                $("#tbClienteCorreo").val($(this).find("correo").text());
                $("#tbClienteTienda").val($(this).find("tienda").text());
                $("#selClienteTipo").val($(this).find("tipo").text());
                $("#taClienteNotas").val($(this).find("notas").text());
            });
        }});
    }
}

function limpiarCamposClientes() {
    $("#tbCliente").val("");
    c_IdCliente = 0;
    $("#tbClienteNombre").val("");
    $("#tbClienteDireccion").val("");
    $("#tbClienteColonia").val("");
    $("#tbClienteTelefono1").val("");
    $("#tbClienteTelefono2").val("");
    $("#tbClienteCorreo").val("");
    $("#tbClienteTienda").val("");
    $("#selClienteTipo").val("");
    $("#taClienteNotas").val("");
}

function actualizarCliente() {
    if (c_IdCliente == 0) {
        alert("No ha elegido un cliente.");
        return;
    } else {
        var nombre = $("#tbClienteNombre").val();
        var direccion = $("#tbClienteDireccion").val();
        var colonia = $("#tbClienteColonia").val();
        var telefono1 = $("#tbClienteTelefono1").val();
        var telefono2 = $("#tbClienteTelefono2").val();
        var correo = $("#tbClienteCorreo").val();
        var tipo = $("#selClienteTipo").val();
        var notas = $("#taClienteNotas").val();
        var estado = "ACTIVO";

        $.ajax({url: "php/actualizarCliente.php", async: false, type: "POST", data: { idCliente: c_IdCliente, nombre: nombre, direccion: direccion,
                colonia: colonia, telefono1: telefono1, telefono2: telefono2, correo: correo, tipo: tipo, notas: notas, estado: estado}, success: function(res) {
                    if (res == "OK") {
                        alert("Se ha actualizado el cliente.");
                        limpiarCamposClientes();
                    }
        }});
    }
}