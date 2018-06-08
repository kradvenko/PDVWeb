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
    $("#tbCantidadMinima").val("");
    $("#tbCostoReal").val("");
    $("#tbCostoDistribuidor").val("");
    $("#tbCostoPublicoMenudeo").val("");
    $("#tbCostoPublicoMayoreoDe").val("");
    $("#tbCostoPublicoMayoreoA").val("");
    $("#tbCostoPublicoMayoreoCosto").val("");
    na_IdCategoriaElegida = 0;
    na_IdMarcaElegida = 0;
    na_PreciosMayoreo = [];
    na_PrecioMayoreo;
    mostrarPreciosMayoreo();
}

function elegirCategoria(id) {
    na_IdCategoriaElegida = id;
}

function elegirMarca(id) {
    na_IdMarcaElegida = id;
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
    $("#tbCostoPublicoMayoreoDe").val("");
    $("#tbCostoPublicoMayoreoA").val("");
    $("#tbCostoPublicoMayoreoCosto").val("");
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

function agregarArticulo() {
    var idCategoria = na_IdCategoriaElegida;
    var codigo = $("#tbCodigo").val();
    var nombre = $("#tbNombre").val();
    var descripcion = $("#taDescripcion").val();
    var modelo = $("#tbModelo").val();
    var idMarca = na_IdMarcaElegida;
    var color = $("#tbColor").val();
    var cantidad = $("#tbCantidad").val();
    var minimo = $("#tbCantidadMinima").val();
    var costoReal = $("#tbCostoReal").val();
    var costoDistribuidor = $("#tbCostoDistribuidor").val();
    var costoPublico = $("#tbCostoPublicoMenudeo").val();
    var estado = "ACTIVO";
    var preciosMayoreo = na_PreciosMayoreo;

    //TODO validaciones

    $.ajax({url: "php/agregarArticulo.php", async: false, type: "POST", data: { idCategoria: idCategoria, codigo: codigo, nombre: nombre, descripcion: descripcion, modelo: modelo, idMarca: idMarca, color: color, cantidad: cantidad, minimo: minimo, costoReal: costoReal, costoDistribuidor: costoDistribuidor, costoPublico: costoPublico, estado: estado, preciosMayoreo: preciosMayoreo }, success: function(res) {
        if (res == "OK") {
            alert("Se ha agregado el artículo.");
            limpiarCamposNuevoArticulo();
        } else {
            
        }
    }});
}