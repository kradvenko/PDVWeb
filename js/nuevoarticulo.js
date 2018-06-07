var na_IdCategoriaElegida = 0;
var na_IdMarcaElegida = 0;
var na_PreciosMayoreo = [];
var na_PrecioMayoreo;


function limpiarCamposNuevoArticulo() {
    $("#tbCategoria").val("");
    $("#tbCodigo").val("");
    $("#tbNombre").val("");
    $("#taDescripcion").val("");
    $("#tbModelo").val("");
    $("#tbMarca").val("");
    $("#tbColor").val("");
    $("#tbCantidad").val("");
}

function elegirCategoria(id) {
    na_IdCategoriaElegida = id;
}

function elegirMarca(id) {
    na_IdMarcaElegida = 0;
}

function agregarPrecioMayoreo() {
    var precioDe = $("#tbCostoPublicoMayoreoDe").val();
    var precioA = $("#tbCostoPublicoMayoreoA").val();
    var costoMayoreo = $("#tbCostoPublicoMayoreoCosto").val();

    if (precioDe.length == 0 || isNaN(precioDe)) {
        alert("No ha escrito un número válido para el precio de.");
        return;
    }
    if (precioA.length == 0 || isNaN(precioA)) {
        alert("No ha escrito un número válido para el precio a.");
        return;
    }
    if (costoMayoreo.length == 0 || isNaN(costoMayoreo)) {
        alert("No ha escrito un número válido para el costo.");
        return;
    }
    na_PrecioMayoreo = { id: 0, De: precioDe, A: precioA, Costo: costoMayoreo};
    na_PreciosMayoreo[na_PreciosMayoreo.length] = na_PrecioMayoreo;
    mostrarPreciosMayoreo();
}

function mostrarPreciosMayoreo() {
    $("#divPreciosMayoreo").jsGrid({
        width: "100%",
        height: "200px",
 
        inserting: true,
        editing: true,
        sorting: true,
        paging: true,
 
        data: na_PreciosMayoreo,
 
        fields: [
            { name: "De", type: "text", width: 50, validate: "required" },
            { name: "A", type: "text", width: 50, validate: "required" },
            { name: "Costo", type: "text", width: 200, validate: "required" },
            { type: "control" }
        ]
    });
}