//Variables para el nuevo servicio
var ns_IdCliente = 0;
//Funciones para el nuevo servicio
function guardarCliente() {
    var nombre = $("#tbNuevoClienteNombre").val();
    var direccion = $("#tbNuevoClienteDireccion").val();
    var colonia = $("#tbNuevoClienteColonia").val();
    var telefono1 = $("#tbNuevoClienteTelefono1").val();
    var telefono2 = $("#tbNuevoClienteTelefono2").val();
    var correo = $("#tbNuevoClienteCorreo").val();
    var tienda = $("#tbNuevoClienteTienda").val();
    var tipo = $("#selNuevoClienteTipo").val();
    var fechaCaptura = obtenerFechaHoraActual();
    var estado = 'ACTIVO';
    var notas = $("#taNuevoClienteNotas").val();

    if (nombre.length == 0) {
        alert("No ha escrito el nombre del cliente.")
        return;
    }

    $.ajax({url: "php/agregarCliente.php", async: false, type: "POST", data: { nombre: nombre, direccion: direccion, colonia: colonia, telefono1: telefono1, telefono2: telefono2, correo: correo, tienda: tienda, tipo: tipo, fechaCaptura: fechaCaptura, estado: estado, notas: notas }, success: function(res) {
        if (res == "OK") {
            alert("Se ha ingresado el cliente.");
            $('#modalAgregarCliente').modal('hide');
        } else {
            alert(res);
        }
    }});
}

function elegirCliente(id) {
    ns_IdCliente = id;
}