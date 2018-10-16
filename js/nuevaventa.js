var nv_articulos = [];
var nv_articulo;
var nv_descuentoPorcentaje = 0;
var nv_descuentoCantidad = 0;
var nv_subTotal = 0;
var nv_total = 0;
var nv_PreciosMayoreo = [];
var nv_PrecioMayoreo;
var nv_iva = 0;
var nv_IdCliente = 0;


//Articulos
function agregarArticuloVenta(id, nombre, precio, preciodistribuidor) {
    if (preciodistribuidor == null) {
        preciodistribuidor = 0;
    }
    nv_articulo = { id : id, nombre : nombre, precio : precio, preciomayoreo: 0, usarMayoreo: false, cantidad : '1',  descuentoporcentaje : '0', descuentocantidad : '0', subtotal: precio, total : precio, preciodistribuidor: preciodistribuidor };
    nv_articulos[nv_articulos.length] = nv_articulo;
    mostrarVenta();
    calcularTotal();
}

function mostrarVenta() {
    $("#divVenta").html("");
    for (i = 0; i <= nv_articulos.length - 1; i++) {
        nv_articulo = nv_articulos[i];
        var div;
        //Nombre
        div = '<div class="col-12 divBackgroundBlue2 divMargin">' + nv_articulo.nombre + '</div>';
        //Cantidad Precio Descuento P Descuento C
        div = div + '<div class="col-3"><label class="labelType01">Cantidad</label></div>';
        div = div + '<div class="col-1"><label class="labelType01">Precio</label></div>';
        div = div + '<div class="col-2"><label class="labelType01">Usar precio mayoreo</label></div>';
        div = div + '<div class="col-2"><label class="labelType01">Precio mayoreo</label></div>';
        div = div + '<div class="col-2"><label class="labelType01">Descuento Porcentaje</label></div>';
        div = div + '<div class="col-2"><label class="labelType01">Descuento Cantidad</label></div>';

        //div = div + '<div class="col-3"><label class="labelType01"></label></div>';
        //div = div + '<div class="col-1"><label class="labelType01"></label></div>';
        
        //div = div + '<div class="col-3"><button class="btn btn-success" data-toggle="modal" data-target="#modalVerPreciosMayoreo" onclick="verPreciosMayoreo(' + nv_articulo.id + ')"><i class="fas fa-search"></i></button></div>';
        //div = div + '<div class="col-3"></div>';
        //div = div + '<div class="col-2"></div>';
        //div = div + '<div class="col-2"></div>';

        div = div + '<div class="col-3">' + '<input id="tbCantidad_' + i + '" type="text" class="form-control textbox-center" onchange="cambiarCantidad(' + i + ')" value="' + nv_articulo.cantidad + '"</input></div>';
        div = div + '<div class="col-1">$ ' + nv_articulo.precio + '</div>';
        if (nv_articulo.usarMayoreo) {
            div = div + '<div class="col-2"><label class="switch"><input checked type="checkbox" id="cbMayoreo_' + i + '" onchange="checarMayoreo(' + i + '); calcularCostoArticulo(' + i + '); mostrarVenta();"><span class="slider round"></span></label></input></div>';
        } else {
            div = div + '<div class="col-2"><label class="switch"><input type="checkbox" id="cbMayoreo_' + i + '" onchange="checarMayoreo(' + i + '); calcularCostoArticulo(' + i + '); mostrarVenta();"><span class="slider round"></span></label></input></div>';
        }
        div = div + '<div class="col-2">$ ' + nv_articulo.preciomayoreo + '</div>';        
        div = div + '<div class="col-2">' + '<input id="tbDescuentoPorcentaje_' + i + '" type="text" class="form-control textbox-center" onchange="cambiarDescuentoPorcentaje(' + i + ')" value="' + nv_articulo.descuentoporcentaje + '"</input></div>';
        div = div + '<div class="col-2">' + '<input id="tbDescuentoCantidad_' + i + '" type="text" class="form-control textbox-center" onchange="cambiarDescuentoCantidad(' + i + ')" value="' + nv_articulo.descuentocantidad + '"</input></div>';

        div = div + '<div class="col-8">' + '<button type="button" class="btn btn-primary btn-danger" onclick="borrarArticulo(' + i + ')">Borrar</button></div>';

        div = div + '<div class="col-2 divBackgroundBlue3 divMargin">SubTotal: $ ' + nv_articulo.subtotal + '</div>';
        div = div + '<div class="col-2 divBackgroundBlue3 divMargin">Total: $ ' + nv_articulo.total + '</div>';
        //Total
        $("#divVenta").html($("#divVenta").html() + div);
    }
}

function calcularCostoArticulo(index) {
    nv_articulo = nv_articulos[index];
    if (nv_articulo.usarMayoreo) {
        nv_articulo.total = nv_articulo.cantidad * nv_articulo.preciomayoreo;
    } else {
        nv_articulo.total = nv_articulo.cantidad * nv_articulo.precio;
    }
    nv_articulo.subtotal = nv_articulo.total;
    nv_articulo.total = nv_articulo.total - (nv_articulo.total * (nv_articulo.descuentoporcentaje/100));
    nv_articulo.total = nv_articulo.total - nv_articulo.descuentocantidad;
    calcularTotal();
}
function cambiarCantidad(index) {
    if (isNaN($("#tbCantidad_" + index).val())) {
        alert("No ha escrito un número válido.");
        $("#tbCantidad_" + index).val("1");
        return;
    }
    nv_articulo = nv_articulos[index];
    nv_articulo.cantidad = $("#tbCantidad_" + index).val();
    checarMayoreo(index);
    calcularCostoArticulo(index);
    mostrarVenta();
}

function cambiarDescuentoPorcentaje(index) {
    if (isNaN($("#tbDescuentoPorcentaje_" + index).val())) {
        alert("No ha escrito un número válido.");
        $("#tbDescuentoPorcentaje_" + index).val("0");
        return;
    }
    nv_articulo = nv_articulos[index];
    nv_articulo.descuentoporcentaje = $("#tbDescuentoPorcentaje_" + index).val();
    calcularCostoArticulo(index);
    mostrarVenta();
}

function cambiarDescuentoCantidad(index) {
    if (isNaN($("#tbDescuentoCantidad_" + index).val())) {
        alert("No ha escrito un número válido.");
        $("#tbDescuentoCantidad_" + index).val("0");
        return;
    }
    nv_articulo = nv_articulos[index];
    nv_articulo.descuentocantidad = $("#tbDescuentoCantidad_" + index).val();
    calcularCostoArticulo(index);
    mostrarVenta();
}

function borrarArticulo(index) {
    nv_articulos.splice(index, 1);
    mostrarVenta();
    calcularTotal();
}

function cambiarDescuentoPorcentajeVenta() {
    if (isNaN($("#tbDescuentoPorcentajeVenta").val())) {
        alert("No ha escrito un número válido.");
        $("#tbDescuentoPorcentajeVenta").val("0")
    }
    calcularTotal();
}

function cambiarDescuentoCantidadVenta() {
    if (isNaN($("#tbDescuentoCantidadVenta").val())) {
        alert("No ha escrito un número válido.");
        $("#tbDescuentoCantidadVenta").val("0")
    }
    calcularTotal();
}

function calcularTotal() {
    var total = 0;
    var descuentoPorcentaje = $("#tbDescuentoPorcentajeVenta").val();
    var descuentoCantidad = $("#tbDescuentoCantidadVenta").val();
    nv_descuentoPorcentaje = descuentoPorcentaje;
    nv_descuentoCantidad = descuentoCantidad;
    for (i = 0; i <= nv_articulos.length - 1; i++) {
        nv_articulo = nv_articulos[i];
        total = Number(total) + Number(nv_articulo.total);
    }
    $("#lblSubTotal").text("$ " + total);
    nv_subTotal = total;
    total = total - (total * (descuentoPorcentaje/100));
    total = total - descuentoCantidad;
    if ($("#cbIva").is(":checked")) {
        nv_iva = (total * 1.16) - total;
        total = total * 1.16;
        nv_iva = parseFloat(nv_iva).toFixed(2);         
        total = parseFloat(total).toFixed(2);        
    } else {
        nv_iva = 0;
    }
    nv_total = total;
    $("#lblTotal").text("$ " + total);
}

function realizarVenta() {
    var fecha = obtenerFechaHoraActual("FULL");
    var subTotal = nv_subTotal;
    var descuentoPorcentaje = nv_descuentoPorcentaje;
    var descuentoCantidad = nv_descuentoCantidad;
    var total = nv_total;
    var estado = 'ACTIVO';
    var articulos = nv_articulos;
    var iva = nv_iva;
    var idCliente = nv_IdCliente;

    if (nv_articulos.length == 0) {
        alert("No existen artículos en la venta.");
        return;
    }

    $.ajax({url: "php/agregarVenta.php", async: false, type: "POST", data: { fecha : fecha, subtotal: subTotal, descuentoPorcentaje: descuentoPorcentaje, descuentoCantidad: descuentoCantidad, total: total, estado: estado, articulos: articulos, iva: iva, idCliente: idCliente }, success: function(res) {
        if (!isNaN(res)) {
            alert("Se ha realizado la venta.");
            limpiarCamposNuevaVenta();
            window.open("ticketventa.php?idVenta=" + res,'_blank');
        } else {
            alert(res);
        }
    }});
}

function checarMayoreo(index) {
    if ($("#cbMayoreo_" + index).is(":checked")) {
        var cantidad;
        var idArticulo;
        var precioMayoreo = 0;

        cantidad = $("#tbCantidad_" + index).val();
        idArticulo = nv_articulos[index].id;
        /*
        $.ajax({url: "php/obtenerPrecioMayoreo.php", async: false, type: "POST", data: { idArticulo : idArticulo, cantidad: cantidad }, success: function(res) {
            precioMayoreo = res;
        }});
        */
       precioMayoreo = nv_articulos[index].preciodistribuidor;

        if (isNaN(precioMayoreo)) {
            nv_articulos[index].preciomayoreo = 0;
            nv_articulos[index].usarMayoreo = false;
        } else {
            if (precioMayoreo > 0) {
                nv_articulos[index].preciomayoreo = precioMayoreo;
                nv_articulos[index].usarMayoreo = true;
            } else {
                nv_articulos[index].usarMayoreo = false;
            }
        }
    } else {
        nv_articulos[index].preciomayoreo = 0;
        nv_articulos[index].usarMayoreo = false;
    }
}

function verPreciosMayoreo(id) {
    $("#divPreciosMayoreo").html("");
    $.ajax({url: "php/obtenerPreciosMayoreoXML.php", async: false, type: "POST", data: { idArticulo : id }, success: function(res) {
        nv_PreciosMayoreo = [];
        $('cat', res).each(function(index, element) {
            nv_PrecioMayoreo =  { id: $(this).find("id").text(), De: $(this).find("de").text(), A: $(this).find("a").text(), Costo: $(this).find("precio").text() };
            nv_PreciosMayoreo[nv_PreciosMayoreo.length] = nv_PrecioMayoreo;
        });
    }});
    mostrarPreciosMayoreo();
}

function mostrarPreciosMayoreo() {
    $("#divPreciosMayoreo").jsGrid({
        width: "100%",
        height: "200px",
 
        inserting: false,
        editing: false,
        sorting: false,
        paging: false,
 
        data: nv_PreciosMayoreo,
 
        fields: [
            { name: "De", type: "text", width: 50, validate: "required" },
            { name: "A", type: "text", width: 50, validate: "required" },
            { name: "Costo", type: "text", width: 200, validate: "required" },
        ]
    });
}

function limpiarCamposNuevaVenta() {
    $("#cbIva").prop("checked", false);
    $("#divVenta").html("");
    $("#tbDescuentoPorcentajeVenta").val("0");
    $("#tbDescuentoCantidadVenta").val("0");
    $("#lblSubTotal").text("-");
    $("#lblTotal").text("-");
    $("#tbVentaCliente").val("");
    nv_IdCliente = 0;
}

function guardarCliente() {
    var nombre = $("#tbNuevoClienteNombre").val();
    var direccion = $("#tbNuevoClienteDireccion").val();
    var colonia = $("#tbNuevoClienteColonia").val();
    var telefono1 = $("#tbNuevoClienteTelefono1").val();
    var telefono2 = $("#tbNuevoClienteTelefono2").val();
    var correo = $("#tbNuevoClienteCorreo").val();
    var tienda = $("#tbNuevoClienteTienda").val();
    var tipo = $("#selNuevoClienteTipo").val();
    var fechaCaptura = obtenerFechaHoraActual("FULL");
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
    nv_IdCliente = id;
}

function limpiarCamposCliente() {
    $("#tbNuevoClienteNombre").val("");
    $("#tbNuevoClienteDireccion").val("");
    $("#tbNuevoClienteColonia").val("");
    $("#tbNuevoClienteTelefono1").val("");
    $("#tbNuevoClienteTelefono2").val("");
    $("#tbNuevoClienteCorreo").val("");
    $("#tbNuevoClienteTienda").val("");
    $("#selNuevoClienteTipo").val("");
    $("#taNuevoClienteNotas").val("");
}