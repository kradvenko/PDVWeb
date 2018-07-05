e_ArticulosEnvio = [];
e_IdArticuloelegido = 0;

function mostrarCantidadArticulo(id) {
    if (existeEnLista(id)) {
        alert("Ya existe el artículo en la lista de envío.");
        $("#tbBuscarArticulo").val("");
        return;
    }
    $('#modalCantidadArticulo').modal('show');
    e_IdArticuloelegido = id;
}

function existeEnLista(id) {
    for (i = 0; i < e_ArticulosEnvio.length; i++) {
        var articulo = e_ArticulosEnvio[i];
        if (articulo.id == id) {
            return true;
        }
    }
    return false;
}

function elegirArticulo() {
    var cantidad = $("#tbCantidad").val();
    var verificacion = verificarCantidadArticulo(cantidad);
    if (verificacion == "OK") {
        $("#tbBuscarArticulo").val("");
        $("#tbCantidad").val("");
        $('#modalCantidadArticulo').modal('hide');
        $.ajax({url: "php/obtenerArticuloXML.php", async: false, type: "POST", data: { idArticulo : e_IdArticuloelegido }, success: function(res) {
            $('resultado', res).each(function(index, element) {
                var articulo;
                articulo = { id: $(this).find("idarticulo").text(), nombre: $(this).find("nombre").text(), cantidad: cantidad };
                e_ArticulosEnvio[e_ArticulosEnvio.length] = articulo;
                mostrarListaArticulos();
            });
        }});
    } else {
        alert(verificacion);
    }
}

function verificarCantidadArticulo(cantidad) {
    var idTiendaA = $("#selListaTiendas").val();
    var mensaje;
    if (isNaN(cantidad)) {
        return "No ha escrito un número válido.";
    } else {
        $.ajax({url: "php/verificarCantidadArticulo.php", async: false, data: {idArticulo: e_IdArticuloelegido, idTiendaA: idTiendaA, cantidad: cantidad }, type: "POST", success: function(res) {
            mensaje = res;
        }});
    }
    return mensaje;
}

function mostrarListaArticulos() {
    $("#divArticulos").jsGrid({
        width: "100%",
        height: "100%",
 
        inserting: false,
        editing: false,
        sorting: false,
        paging: false,
        deleting: true,

        deleteConfirm: "¿Eliminar el artículo?",
 
        data: e_ArticulosEnvio,

        rowClick: function(args) {
            cambiarCantidad(args.item.id, args.item.cantidad);
        },
 
        fields: [
            { name: "nombre", title: "Nombre", type: "text", width: 50, validate: "required" },
            { name: "cantidad", title: "Cantidad", type: "number", width: 50, validate: "required" },
            { type: "control" }
        ]
    });
}

function cambiarCantidad(id, cantidad) {
    e_IdArticuloelegido = id;
    $('#modalCambiarCantidadArticulo').modal('show');
}

function cambiarCantidadArticulo() {
    var cantidad = $("#tbCantidadCambiar").val();
    var verificacion = verificarCantidadArticulo(cantidad);
    if (verificacion == "OK") {
        $("#tbBuscarArticulo").val("");
        $("#tbCantidadCambiar").val("");
        $('#modalCambiarCantidadArticulo').modal('hide');
        for (i = 0; i < e_ArticulosEnvio.length; i++) {
            if (e_ArticulosEnvio[i].id == e_IdArticuloelegido) {
                e_ArticulosEnvio[i].cantidad = cantidad;
                mostrarListaArticulos();
                return;
            }
        }
    } else {
        alert(verificacion);
    }
}

function agregarEnvio() {
    if (e_ArticulosEnvio.length == 0) {
        alert("No ha agregado ningún artículo al envío.");
    } else {
        var idTiendaA = $("#selListaTiendas").val();
        var notas = $("#taNotas").val();
        var fechaEnvio = obtenerFechaHoraActual();
        $.ajax({url: "php/agregarEnvio.php", async: false, data: {idTiendaA: idTiendaA, estado: "ACTIVO", notas: notas, articulos: e_ArticulosEnvio, fechaEnvio: fechaEnvio }, type: "POST", success: function(res) {
            mensaje = res;
        }});
    }
}

function obtenerUltimosEnvios() {
    $.ajax({url: "php/obtenerUltimosEnvios.php", async: false, type: "POST", success: function(res) {
        $("#divListaEnvios").html(res);
    }});
}

function limpiarCamposEnvio() {
    $("#tbBuscarArticulo").val("");
    $("#tbCantidad").val("");
    $("#taNotas").val("");
    $("#divArticulos").html("");
    e_ArticulosEnvio = [];
    e_IdArticuloelegido = 0;
}