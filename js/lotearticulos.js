var na_IdCategoriaElegida = 0;
var na_IdMarcaElegida = 0;
var na_PreciosMayoreo = [];
var na_PrecioMayoreo;
var na_IdArticuloElegido = 0;
var na_IdMatrizArticulo = 0;
var la_ArticuloLote;
var la_ArticulosLote = [];
var la_CostosExtraLote = [];
var la_Monedas = [
    { Name: "Peso", Id: "Peso" },
    { Name: "Dolar", Id: "Dolar" }
];

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
    $("#taArticuloNotas").val("");
    $("#cbAprobado").prop("checked", false);
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

function agregarNuevoArticuloLote() {
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
    var aprobado = $("#cbAprobado").prop("checked") == true ? "SI" : "NO";
    var notas = $("#taArticuloNotas").val();

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
        $.ajax({url: "php/agregarArticulo.php", async: false, type: "POST", data: { idCategoria: idCategoria, codigo: codigo, nombre: nombre, descripcion: descripcion, modelo: modelo, idMarca: idMarca, color: color, cantidad: cantidad, minimo: minimo, costoReal: costoReal, costoDistribuidor: costoDistribuidor, costoPublico: costoPublico, estado: estado, preciosMayoreo: preciosMayoreo, precioDistribuidor: precioDistribuidor, idLote: l_IdLoteElegido, aprobado: aprobado, notas: notas }, success: function(res) {
            if (res == "OK") {
                alert("Se ha agregado el artículo.");
                limpiarCamposNuevoArticulo();
                obtenerArticulosLote();
                mostrarArticulosLote();
            } else {
                
            }
        }});
    } else {
        $.ajax({url: "php/actualizarArticulo.php", async: false, type: "POST", data: { idArticulo: na_IdArticuloElegido, idCategoria: idCategoria, codigo: codigo, nombre: nombre, descripcion: descripcion, modelo: modelo, idMarca: idMarca, color: color, cantidad: cantidad, minimo: minimo, costoReal: costoReal, costoDistribuidor: costoDistribuidor, costoPublico: costoPublico, estado: estado, preciosMayoreo: preciosMayoreo, precioDistribuidor: precioDistribuidor, idLote: l_IdLoteElegido, aprobado: aprobado, notas: notas }, success: function(res) {
            if (res == "OK") {
                alert("Se ha actualizado el artículo.");
                limpiarCamposNuevoArticulo();
                obtenerArticulosLote();
                mostrarArticulosLote();
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
            $("#taArticuloNotas").val($(this).find("notas").text());
            $(this).find("aprobado").text() == "SI" ? $("#cbAprobado").prop("checked", true) : $("#cbAprobado").prop("checked", false);
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
    $('#modalAgregarArticuloLote').modal('show');
    //mostrarPreciosMayoreo();
}

function obtenerUltimosArticulos() {
    $.ajax({url: "php/obtenerUltimosArticulos.php", async: false, type: "POST", success: function(res) {
        $("#divUltimosArticulos").html(res);
    }});
}

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
    var tipoCambio = $("#tbTipoCambioLote").val();
    var moneda = $("#selMoneda").val();
    var costoLote = $("#tbCostoLote").val();
    var fechaIngreso = obtenerFechaHoraActual("FULL");
    var estado = "ACTIVO";
    var fechaPago = $("#tbFechaPago").val();
    var fechaRecibido = $("#tbFechaRecibido").val();
    var pagado = $("#cbPagado").prop("checked") == true ? "SI" : "NO";
    var recibido = $("#cbRecibido").prop("checked") == true ? "SI" : "NO";
    var costoEnvio = $("#tbCostoEnvio").val();
    var tipoCambioEnvio = $("#tbTipoCambioEnvio").val();
    var monedaEnvio = $("#selMonedaEnvio").val();


    if (l_IdLoteElegido == 0) {
        $.ajax({url: "php/agregarLote.php", async: false, type: "POST", data: { idOrigen: idOrigen, fechaLote: fechaLote, tipoCambio: tipoCambio, moneda: moneda, costoLote: costoLote, fechaIngreso: fechaIngreso, estado: estado, fechaPago: fechaPago, fechaRecibido: fechaRecibido, pagado: pagado, recibido: recibido, costoEnvio: costoEnvio, tipoCambioEnvio: tipoCambioEnvio, monedaEnvio: monedaEnvio, costosExtra: la_CostosExtraLote }, success: function(res) {
            if (res == "OK") {
                alert("Se ha ingresado el lote.");
                limpiarCamposNuevoLote();
                obtenerUltimosLotes();
            } else {
                alert(res);
            }
        }});
    } else {
        $.ajax({url: "php/actualizarLote.php", async: false, type: "POST", data: { idLote: l_IdLoteElegido, idOrigen: idOrigen, fechaLote: fechaLote, tipoCambio: tipoCambio, moneda: moneda, costoLote: costoLote, fechaIngreso: fechaIngreso, estado: estado, fechaPago: fechaPago, fechaRecibido: fechaRecibido, pagado: pagado, recibido: recibido, costoEnvio: costoEnvio, tipoCambioEnvio: tipoCambioEnvio, monedaEnvio: monedaEnvio, costosExtra: la_CostosExtraLote }, success: function(res) {
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
    $("#tbTipoCambio").val("0");
    $("#tbCostoLote").val("0");
    $("#divAgregarArticuloLote").hide();
    $("#divArticulosLote").html("");
    $("#tbPagado").val("");
    $("#tbRecibido").val("");
    $("#cbPagado").prop("checked", false);
    $("#cbRecibido").prop("checked", false);
    $("#tbCostoEnvio").val("0");
    $("#tbTipoCambioEnvio").val("0");
    $("#tbCostoExtraMotivo").val("");
    $("#tbCostoExtra").val("0");
    $("#tbCostoExtraTipoCambio").val("0");
    la_ArticulosLote = [];
    la_CostosExtraLote = [];
    mostrarCostosExtraLote();
    limpiarCostosExtra();
}

function obtenerUltimosLotes() {
    $.ajax({url: "php/obtenerUltimosLotes.php", async: false, type: "POST", success: function(res) {
        $("#divUltimosLotes").html(res);
    }});
}

function elegirLote(idLote) {
    l_IdLoteElegido = idLote;
    $.ajax({url: "php/obtenerLoteXML.php", async: false, type: "POST", data: { idLote : idLote }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            $("#selOrigenLote").val($(this).find("idorigen").text());
            $("#tbFechaLote").val($(this).find("fechalote").text());
            $("#tbTipoCambio").val($(this).find("tipocambio").text());
            $("#tbCostoLote").val($(this).find("costolote").text());
            $("#selMoneda").val($(this).find("moneda").text());
            $("#tbFechaPago").val($(this).find("fechapago").text());
            $("#tbFechaRecibido").val($(this).find("fecharecibido").text());
            $(this).find("pagado").text() == "SI" ? $("#cbPagado").prop("checked", true) : $("#cbPagado").prop("checked", false);
            $(this).find("recibido").text() == "SI" ? $("#cbRecibido").prop("checked", true) : $("#cbRecibido").prop("checked", false);
            $("#tbCostoEnvio").val($(this).find("costoenvio").text());
            $("#tbTipoCambioEnvio").val($(this).find("tipocambioenvio").text());
            $("#selMonedaEnvio").val($(this).find("monedaenvio").text());
            $("#divAgregarArticuloLote").show();
            obtenerArticulosLote();
            mostrarArticulosLote();
        });
    }});
    $.ajax({url: "php/obtenerCostosExtraXML.php", async: false, type: "POST", data: { idLote : idLote }, success: function(res) {
        la_CostosExtraLote = [];
        $('cat', res).each(function(index, element) {
            costoExtra = { id: $(this).find("idcostoextra").text(), motivo: $(this).find("motivo").text(), monto: $(this).find("monto").text(), tipocambio: $(this).find("tipocambio").text(), moneda: $(this).find("moneda").text() }
            la_CostosExtraLote[la_CostosExtraLote.length] = costoExtra;
        });
        mostrarCostosExtraLote();
    }});
}

function obtenerArticulosLote() {
    $.ajax({url: "php/obtenerArticulosLoteXML.php", async: false, type: "POST", data: { idLote: l_IdLoteElegido }, success: function(res) {
        la_ArticulosLote = [];
        $('cat', res).each(function(index, element) {
            la_ArticuloLote =  { id: $(this).find("idarticulo").text(), idMatriz: $(this).find("idmatriz").text(), Nombre: $(this).find("nombre").text(),
            Marca: $(this).find("marca").text(), Color: $(this).find("color").text(), Cantidad: $(this).find("cantidad").text(), Modelo: $(this).find("modelo").text(),
            Codigo: $(this).find("codigo").text() };
            la_ArticulosLote[la_ArticulosLote.length] = la_ArticuloLote;
        });
    }});
}

function mostrarArticulosLote() {
    $("#divArticulosLote").jsGrid({
        width: "100%",
        height: "100%",
 
        inserting: false,
        editing: false,
        sorting: false,
        paging: false,
        deleting: false,

        deleteConfirm: "¿Eliminar el artículo?",
 
        data: la_ArticulosLote,

        rowClick: function(args) {
            elegirArticulo(args.item.id, args.item.idMatriz);
        },
 
        fields: [
            { name: "Codigo", type: "text", width: 50, validate: "required" },
            { name: "Nombre", type: "text", width: 50, validate: "required" },
            { name: "Marca", type: "text", width: 20, validate: "required" },
            { name: "Modelo", type: "text", width: 20, validate: "required" },
            { name: "Color", type: "text", width: 20, validate: "required" },
            { name: "Cantidad", type: "text", width: 20, validate: "required" }
        ]
    });
}


function ponerFechaPagado() {
    if ($("#cbPagado").prop("checked") == true) {
        $("#tbFechaPago").val(obtenerFechaHoraActual("FULL").substring(0, 10));
    } else {
        $("#tbFechaPago").val("");
    }
}

function ponerFechaRecibido() {
    if ($("#cbRecibido").prop("checked") == true) {
        $("#tbFechaRecibido").val(obtenerFechaHoraActual("FULL").substring(0, 10));
    } else {
        $("#tbFechaRecibido").val("");
    }
}

function mostrarCostosExtraLote() {
    $("#divCostosExtra").jsGrid({
        width: "100%",
        height: "100%",
 
        inserting: false,
        editing: true,
        sorting: false,
        paging: false,
        deleting: true,

        deleteConfirm: "¿Eliminar el costo extra?",
 
        data: la_CostosExtraLote,

        rowClick: function(args) {
            //elegirArticulo(args.item.id, args.item.idMatriz);
        },
 
        fields: [
            { name:"motivo", type: "text", title: "Motivo", type: "text", width: 50, validate: "required" },
            { name:"monto", type: "number", title: "Monto", type: "text", width: 10, validate: "required" },
            { name:"tipocambio", type: "number", title: "Tipo de cambio", type: "text", width: 10, validate: "required" },
            { name:"moneda", type: "select", items: la_Monedas, valueField: "Id", textField: "Name", title: "Moneda", width: 10, validate: "required" },
            { type: "control" }
        ]
    });
}

function agregarCostoExtra() {
    var nuevoCostoExtra;
    nuevoCostoExtra = { motivo: $("#tbCostoExtraMotivo").val(), monto: $("#tbCostoExtra").val(), tipocambio: $("#tbCostoExtraTipoCambio").val(), moneda: $("#selCostoExtraMoneda").val() }
    la_CostosExtraLote[la_CostosExtraLote.length] = nuevoCostoExtra;
    mostrarCostosExtraLote();
    limpiarCostosExtra();
}

function limpiarCostosExtra() {
    $("#tbCostoExtraMotivo").val("");
    $("#tbCostoExtra").val("0");
    $("#tbCostoExtraTipoCambio").val("0");
}