e_ArticulosEnvio = [];
e_IdArticuloelegido = 0;

function mostrarCantidadArticulo(id) {
    $('#modalCantidadArticulo').modal('show');
    e_IdArticuloelegido = id;
}

function elegirArticulo() {
    var verificacion = verificarCantidadArticulo();
    if (verificacion == "OK") {
        alert("OK");
    } else {
        alert(verificacion);
    }
}

function verificarCantidadArticulo() {
    var cantidad = $("#tbCantidad").val();
    var idTiendaA = $("#selListaTiendas").val();
    if (isNaN(cantidad)) {
        return "No ha escrito un número válido.";
    } else {
        $.ajax({url: "php/verificarCantidadArticulo.php", async: false, data: {idArticulo: e_IdArticuloelegido, idTiendaA: idTiendaA, cantidad: cantidad }, type: "POST", success: function(res) {
            alert(res);
        }});
    }
}

function limpiarCamposEnvio() {
    $("#tbBuscarArticulo").val("");
    $("#tbCantidad").val("");
}