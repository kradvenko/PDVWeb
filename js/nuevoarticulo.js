var na_IdCategoriaElegida = 0;
var na_IdMarcaElegida = 0;
var na_PreciosMayoreo = [];
var na_PrecioMayoreo;
var na_IdArticuloElegido = 0;
var na_IdMatrizArticulo = 0;


function limpiarCamposNuevoArticulo() {
    $("#tbCategoria").val("");
    $("#tbCodigo").val("");
    $("#tbNombre").val("");
    $("#taDescripcion").val("");
    $("#tbModelo").val("");
    $("#tbMarca").val("");
    $("#tbColor").val("");
    $("#tbCantidad").val("0");
    $("#tbCantidadMinima").val("0");
    $("#tbPrecioDistribuidor").val("0");
    $("#tbPrecioPublicoMenudeo").val("0");
    $("#tbCostoReal").val("0");
    $("#tbCostoDistribuidor").val("0");
    $("#tbCostoPublicoMenudeo").val("0");
    $("#tbCostoPublicoMayoreoDe").val("");
    $("#tbCostoPublicoMayoreoA").val("");
    $("#tbCostoPublicoMayoreoCosto").val("");
    na_IdCategoriaElegida = 0;
    na_IdMarcaElegida = 0;
    na_PreciosMayoreo = [];
    na_PrecioMayoreo;
    na_IdArticuloElegido = 0;
    na_IdMatrizArticulo = 0;
    mostrarPreciosMayoreo();
}

function elegirCategoria(id) {
    na_IdCategoriaElegida = id;
}

function elegirMarca(id) {
    na_IdMarcaElegida = id;
}

function verificarCamposMatriz() {
    /*
    if (getCookie("tipotienda") == "MATRIZ") {
        
    } else 
    {
        $("#divCostosMayoreo").css("visibility", "hidden");
        $("#divPreciosMayoreo").css("visibility", "hidden");
    }
    */
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

        deleteConfirm: "¿Eliminar el costo de mayoreo?",
 
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
    if (na_IdMatrizArticulo > 0) {
        alert("No es posible modificar un artículo que ha sido dado de alta en la tienda matriz.");
        return;
    }

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
    var precioDistribuidor = $("#tbPrecioDistribuidor").val();
    var estado = "ACTIVO";
    var preciosMayoreo = na_PreciosMayoreo;

    if (idCategoria == 0) {
        alert("No ha elegido una categoría.");
        return;
    }
    if (idMarca == 0) {
        alert("No ha elegido una marca.");
        return;
    }

    if (nombre.length == 0) {
        alert("No ha escrito un nombre del artículo.");
        return;
    }

    if (na_IdArticuloElegido == 0) {
        $.ajax({url: "php/agregarArticulo.php", async: false, type: "POST", data: { idCategoria: idCategoria, codigo: codigo, nombre: nombre, descripcion: descripcion, modelo: modelo, idMarca: idMarca, color: color, cantidad: cantidad, minimo: minimo, costoReal: costoReal, costoDistribuidor: costoDistribuidor, costoPublico: costoPublico, estado: estado, preciosMayoreo: preciosMayoreo, precioDistribuidor: precioDistribuidor }, success: function(res) {
            if (res == "OK") {
                alert("Se ha agregado el artículo.");
                limpiarCamposNuevoArticulo();
                obtenerUltimosArticulos();
            } else {
                
            }
        }});
    } else {
        $.ajax({url: "php/actualizarArticulo.php", async: false, type: "POST", data: { idArticulo: na_IdArticuloElegido, idCategoria: idCategoria, codigo: codigo, nombre: nombre, descripcion: descripcion, modelo: modelo, idMarca: idMarca, color: color, cantidad: cantidad, minimo: minimo, costoReal: costoReal, costoDistribuidor: costoDistribuidor, costoPublico: costoPublico, estado: estado, preciosMayoreo: preciosMayoreo, precioDistribuidor: precioDistribuidor }, success: function(res) {
            if (res == "OK") {
                alert("Se ha actualizado el artículo.");
                limpiarCamposNuevoArticulo();
                obtenerUltimosArticulos();
            } else {
                
            }
        }});
    }
}

function agregarNuevaCategoria() {
    var categoria = $("#tbNuevaCategoria").val();

    if (categoria.length == 0) {
        alert("No ha escrito el nombre de la categoría.");
    }

    $.ajax({url: "php/agregarCategoria.php", async: false, type: "POST", data: { categoria: categoria }, success: function(res) {
        if (res == "OK") {
            $("#tbNuevaCategoria").val("");
            $('#modalAgregarCategoria').modal('hide');
        } else {
            alert(res);
        }
    }});
}

function agregarNuevaMarca() {
    var marca = $("#tbNuevaMarca").val();

    if (marca.length == 0) {
        alert("No ha escrito el nombre de la marca.");
    }

    $.ajax({url: "php/agregarMarca.php", async: false, type: "POST", data: { marca: marca }, success: function(res) {
        if (res == "OK") {
            $("#tbNuevaMarca").val("");
            $('#modalAgregarMarca').modal('hide');
        } else {
            alert(res);
        }
    }});    
}

function elegirArticulo(id, idmatriz) {
    na_IdArticuloElegido = id;
    na_IdMatrizArticulo = idmatriz;

    $.ajax({url: "php/obtenerArticuloXML.php", async: false, type: "POST", data: { idArticulo : id }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            $("#tbCategoria").val($(this).find("categoria").text());
            na_IdCategoriaElegida = $(this).find("idcategoria").text();
            na_IdMatrizArticulo = $(this).find("idmatriz").text();
            $("#tbCodigo").val($(this).find("codigo").text());
            $("#tbNombre").val($(this).find("nombre").text());
            $("#taDescripcion").val($(this).find("descripcion").text());
            $("#tbModelo").val($(this).find("modelo").text());
            na_IdMarcaElegida = $(this).find("idmarca").text();
            $("#tbMarca").val($(this).find("marca").text());
            $("#tbColor").val($(this).find("color").text());
            $("#tbCantidad").val($(this).find("cantidad").text());
            $("#tbCantidadMinima").val($(this).find("minimo").text());
            $("#tbCostoReal").val($(this).find("costoreal").text());
            $("#tbCostoDistribuidor").val($(this).find("costodistribuidor").text());
            $("#tbCostoPublicoMenudeo").val($(this).find("costopublico").text());
            $("#tbPrecioDistribuidor").val($(this).find("preciodistribuidor").text());
        });
    }});

    if (na_IdMatrizArticulo > 0) {
        $("#divArticuloDeMatriz").html('<label class="orangeText3">Artículo de matriz.</label>');
    } else {
        $("#divArticuloDeMatriz").html("");
    }

    if (na_IdMatrizArticulo > 0 && getCookie("tipotienda") == "SUCURSAL") {
        $("#divCostosMayoreo").css("visibility", "visible");
        $("#divPreciosMayoreo").css("visibility", "visible");
        $.ajax({url: "php/obtenerPreciosMayoreoXML.php", async: false, type: "POST", data: { idArticulo : na_IdMatrizArticulo }, success: function(res) {
            na_PreciosMayoreo = [];
            $('cat', res).each(function(index, element) {
                na_PrecioMayoreo =  { id: $(this).find("id").text(), De: $(this).find("de").text(), A: $(this).find("a").text(), Costo: $(this).find("precio").text() };
                na_PreciosMayoreo[na_PreciosMayoreo.length] = na_PrecioMayoreo;
            });
        }});
    } else if (na_IdMatrizArticulo == 0 && getCookie("tipotienda") == "MATRIZ") {
        $.ajax({url: "php/obtenerPreciosMayoreoXML.php", async: false, type: "POST", data: { idArticulo : id }, success: function(res) {
            na_PreciosMayoreo = [];
            $('cat', res).each(function(index, element) {
                na_PrecioMayoreo =  { id: $(this).find("id").text(), De: $(this).find("de").text(), A: $(this).find("a").text(), Costo: $(this).find("precio").text() };
                na_PreciosMayoreo[na_PreciosMayoreo.length] = na_PrecioMayoreo;
            });
        }});
    } else {
        $("#divCostosMayoreo").css("visibility", "hidden");
        $("#divPreciosMayoreo").css("visibility", "hidden");
    }
    mostrarPreciosMayoreo();
}

function obtenerUltimosArticulos() {
    $.ajax({url: "php/obtenerUltimosArticulos.php", async: false, type: "POST", success: function(res) {
        $("#divUltimosArticulos").html(res);
    }});
}