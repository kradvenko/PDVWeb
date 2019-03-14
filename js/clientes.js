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