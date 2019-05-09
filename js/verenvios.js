var e_ArticulosEnvio = [];
var e_IdArticuloElegido = 0;
var e_IdEnvioElegido = 0;
var e_ArticulosRecepcion = [];
var e_IdTiendaA = 0;

function mostrarCantidadArticulo(id) {
    if (existeEnLista(id)) {
        alert("Ya existe el artículo en la lista de envío.");
        $("#tbBuscarArticulo").val("");
        return;
    }
    $('#modalCantidadArticulo').modal('show');
    e_IdArticuloElegido = id;
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
        $.ajax({url: "php/obtenerArticuloXML.php", async: false, type: "POST", data: { idArticulo : e_IdArticuloElegido }, success: function(res) {
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
        $.ajax({url: "php/verificarCantidadArticulo.php", async: false, data: {idArticulo: e_IdArticuloElegido, idTiendaA: idTiendaA, cantidad: cantidad }, type: "POST", success: function(res) {
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

        fields: [
            { name: "nombre", title: "Nombre", type: "text", width: 50, validate: "required" },
            { name: "cantidad", title: "Cantidad", type: "number", width: 50, validate: "required" }            
        ]
    });
    $("#divTotalArticulos").html(e_ArticulosEnvio.length);
}

function cambiarCantidad(id, cantidad) {
    e_IdArticuloElegido = id;
    $('#modalCambiarCantidadArticulo').modal('show');
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
    $("#divTotalArticulos").html("");
    e_ArticulosEnvio = [];
    e_IdArticuloElegido = 0;
}
//Recepción de envios
function elegirEnvio(id) {
    e_IdEnvioElegido = id;
    $.ajax({url: "php/obtenerEnvioXML.php", async: false, data: {idEnvio: id }, type: "POST", success: function(res) {
        $('resultado', res).each(function(index, element) {
            $("#selListaTiendas").val($(this).find("idtiendaa").text());
            $("#taNotas").val($(this).find("notas").text());
        });
    }});
    obtenerDetalleEnvio();
}

function obtenerDetalleEnvio() {
    $.ajax({url: "php/obtenerDetalleEnvioXML.php", async: false, data: {idEnvio: e_IdEnvioElegido }, type: "POST", success: function(res) {
        e_ArticulosEnvio = [];
        $('cat', res).each(function(index, element) {
            var articulo;
            articulo = { id: $(this).find("idarticulode").text(), nombre: $(this).find("nombre").text(), cantidad: $(this).find("cantidadenviada").text() };
            e_ArticulosEnvio[e_ArticulosEnvio.length] = articulo;
        });
    }});
    mostrarListaArticulos();
}

function obtenerEnvios() {
    $.ajax({url: "php/obtenerEnviosRevision.php", async: false, type: "POST", success: function(res) {
        $("#divListaEnvios").html(res);
    }});
}

function elegirEnvio(id) {
    e_IdEnvioElegido = id;
    $.ajax({url: "php/obtenerEnvioXML.php", async: false, data: {idEnvio: id }, type: "POST", success: function(res) {
        $('resultado', res).each(function(index, element) {
            $("#selListaTiendas").val($(this).find("idtiendaa").text());
            $("#taNotas").val($(this).find("notas").text());
        });
    }});
    obtenerDetalleEnvio();
}

function elegirEnvioRecepcion(id, nombre, fechaenvio) {
    e_IdEnvioElegido = id;
    $.ajax({url: "php/obtenerEnvioXML.php", async: false, data: {idEnvio: id }, type: "POST", success: function(res) {
        $('resultado', res).each(function(index, element) {
            $("#divDatosEnvio").html(nombre);
            $("#divNotas").html($(this).find("notas").text());
            e_IdTiendaA = $(this).find("idtiendaa").text();
        });
    }});
    $('#divRecibirEnvioControl').show();
    obtenerDetalleEnvioRecepcion();
}

function obtenerDetalleEnvioRecepcion() {
    $.ajax({url: "php/obtenerDetalleEnvioXML.php", async: false, data: {idEnvio: e_IdEnvioElegido }, type: "POST", success: function(res) {
        e_ArticulosRecepcion = [];
        $('cat', res).each(function(index, element) {
            var articulo;            
            articulo = { iddetalleenvio: $(this).find("iddetalleenvio").text(), id: $(this).find("idarticulode").text(), ida: $(this).find("idarticuloa").text(), nombre: $(this).find("nombre").text(), cantidad: $(this).find("cantidadenviada").text(), cantidadrecibida: 0, estado: "ACTIVO" };
            e_ArticulosRecepcion[e_ArticulosRecepcion.length] = articulo;
        });
    }});
    mostrarListaArticulosRecepcion();
}

function mostrarListaArticulosRecepcion() {
    $("#divArticulos").jsGrid({
        width: "100%",
        height: "100%",
 
        inserting: false,
        editing: false,
        sorting: false,
        paging: false,
        deleting: false,       
 
        data: e_ArticulosRecepcion,

        fields: [
            { name: "nombre", title: "Nombre", type: "text", width: 50 },
            { name: "cantidad", title: "Cantidad", type: "number", width: 50 },
            { name: "cantidadrecibida", title: "Cantidad recibida", type: "number", width: 50},
            { name: "estado", title: "Estado", type: "text", width: 50 }
        ]
    });
}

function verDetalleArticulo(id, cantidad) {
    e_IdArticuloElegido = id;
    $('#divCantidadArticulosEnviados').html(cantidad);
    $('#modalVerDetalleArticulo').modal('show');
}

function recibirArticulo() {
    var cantidadRecibida = $("#tbCantidadRecibido").val();
    var estado;
    var cantidad = $('#divCantidadArticulosEnviados').html();
    if (cantidadRecibida.length == 0) {
        alert("No ha escrito la cantidad recibida.");
        return;
    }
    if (isNaN(cantidadRecibida)) {
        alert("No ha escrito una cantidad válida");
        return;
    }
    if (parseInt(cantidadRecibida) > parseInt(cantidad)) {
        alert("Ha escrito una cantidad recibida superior a la cantidad enviada.");
        return;
    }
    if (cantidadRecibida == cantidad) {
        estado = "RECIBIDO";
    } else {
        estado = "RECIBIDO INCOMPLETO";
    }
    for (i = 0; i < e_ArticulosRecepcion.length; i++) {
        if (e_ArticulosRecepcion[i].id == e_IdArticuloElegido) {
            e_ArticulosRecepcion[i].cantidadrecibida = cantidadRecibida;
            e_ArticulosRecepcion[i].estado = estado;
            mostrarListaArticulosRecepcion();
            $("#tbCantidadRecibido").val('');
            $('#modalVerDetalleArticulo').modal('hide');
            return;
        }
    }
}

function limpiarCamposEnvioRecepcion() {
    $("#tbBuscarArticulo").val("");
    $("#tbCantidad").val("");
    $("#taNotas").val("");
    $("#divArticulos").html("");
    $('#divRecibirEnvioControl').hide();
    $("#divDatosEnvio").html("");
    e_ArticulosRecepcion = [];
    e_IdArticuloElegido = 0;
}