var l_IdLoteElegido = 0;

function obtenerOrigenesSelect() {
    $.ajax({url: "php/obtenerOrigenesSelect.php", async: false, type: "POST", data: { idSelect: "selOrigenLote" }, success: function(res) {
        $("#divOrigenLote").html(res);
    }});
}

function agregarNuevoOrigenLote() {
    var origen = $("#tbNuevoOrigenLote").val();
    if (origen.length == 0) {
        alert("No ha escrito un origen de lote.");
        return;
    }
    $.ajax({url: "php/agregarOrigenLote.php", async: false, type: "POST", data: { origen: origen }, success: function(res) {
        if (res == "OK") {
            $("#tbNuevoOrigenLote").val("");
            $('#modalAgregarOrigenLote').modal('hide');
            obtenerOrigenesSelect();
        } else {
            alert(res);
        }
    }});
}

function agregarLote() {
    var idOrigen = $("#selOrigenLote").val();
    var fechaLote = $("#tbFechaLote").val();
    var tipoCambio = $("#tbTipoCambio").val();
    var moneda = $("#selMoneda").val();
    var costoLote = $("#tbCostoLote").val();
    var fechaIngreso = obtenerFechaHoraActual("FULL");
    var estado = "ACTIVO";

    if (l_IdLoteElegido == 0) {
        $.ajax({url: "php/agregarLote.php", async: false, type: "POST", data: { idOrigen: idOrigen, fechaLote: fechaLote, tipoCambio: tipoCambio, moneda: moneda, costoLote: costoLote, fechaIngreso: fechaIngreso, estado: estado }, success: function(res) {
            if (res == "OK") {
                alert("Se ha ingresado el lote.");
                limpiarCamposNuevoLote();
                obtenerUltimosLotes();
            } else {
                alert(res);
            }
        }});
    } else {
        $.ajax({url: "php/actualizarLote.php", async: false, type: "POST", data: { idLote: l_IdLoteElegido, idOrigen: idOrigen, fechaLote: fechaLote, tipoCambio: tipoCambio, moneda: moneda, costoLote: costoLote, fechaIngreso: fechaIngreso, estado: estado }, success: function(res) {
            if (res == "OK") {
                alert("Se ha actualizado el lote.");
                limpiarCamposNuevoLote();
                obtenerUltimosLotes();
            } else {
                alert(res);
            }
        }});
    }
}

function limpiarCamposNuevoLote() {
    l_IdLoteElegido = 0;
    $("#tbFechaLote").val("");
    $("#tbTipoCambio").val("");
    $("#tbCostoLote").val("");
}

function obtenerUltimosLotes() {
    $.ajax({url: "php/obtenerUltimosLotes.php", async: false, type: "POST", success: function(res) {
        $("#divUltimosLotes").html(res);
    }});
}

function elegirLote(idlote, idOrigen, fechalote, tipocambio, costolote, moneda, origen) {
    l_IdLoteElegido = idlote;
    $("#selOrigenLote").val(idOrigen);
    $("#tbFechaLote").val(fechalote);
    $("#tbTipoCambio").val(tipocambio);
    $("#tbCostoLote").val(costolote);
    $("#selMoneda").val(moneda);
}