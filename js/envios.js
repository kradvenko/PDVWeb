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
    var verificacion = verificarCantidadArticulo();
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

function verificarCantidadArticulo() {
    var cantidad = $("#tbCantidad").val();
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
            //elegirArticulo(args.item.id, args.item.idMatriz);
        },
 
        fields: [
            { name: "nombre", title: "Nombre", type: "text", width: 50, validate: "required" },
            { name: "cantidad", title: "Cantidad", type: "number", width: 50, validate: "required" },
            { type: "control" }
        ]
    });
}

function limpiarCamposEnvio() {
    $("#tbBuscarArticulo").val("");
    $("#tbCantidad").val("");
}