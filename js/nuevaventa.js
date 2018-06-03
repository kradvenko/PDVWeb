var nv_articulos = [];
var nv_articulo;
var nv_descuentoPorcentaje = 0;
var nv_descuentoCantidad = 0;
var nv_subTotal = 0;
var nv_total = 0;


//Articulos
function agregarArticuloVenta(id, nombre, precio) {
    nv_articulo = { id : id, nombre : nombre, precio : precio, cantidad : '1',  descuentoporcentaje : '0', descuentocantidad : '0', subtotal: precio, total : precio };
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
        div = div + '<div class="col-3"><label class="labelType01">Precio</label></div>';
        div = div + '<div class="col-3"><label class="labelType01">Descuento Porcentaje</label></div>';
        div = div + '<div class="col-3"><label class="labelType01">Descuento Cantidad</label></div>';
        div = div + '<div class="col-3">' + '<input id="tbCantidad_' + i + '" type="text" class="form-control textbox-center" onchange="cambiarCantidad(' + i + ')" value="' + nv_articulo.cantidad + '"</input></div>';
        div = div + '<div class="col-3">$ ' + nv_articulo.precio + '</div>';
        div = div + '<div class="col-3">' + '<input id="tbDescuentoPorcentaje_' + i + '" type="text" class="form-control textbox-center" onchange="cambiarDescuentoPorcentaje(' + i + ')" value="' + nv_articulo.descuentoporcentaje + '"</input></div>';
        div = div + '<div class="col-3">' + '<input id="tbDescuentoCantidad_' + i + '" type="text" class="form-control textbox-center" onchange="cambiarDescuentoCantidad(' + i + ')" value="' + nv_articulo.descuentocantidad + '"</input></div>';
        div = div + '<div class="col-3">' + '<button type="button" class="btn btn-primary btn-danger" onclick="borrarArticulo(' + i + ')">Borrar</button></div>';
        div = div + '<div class="col-12 divBackgroundBlue3 divMargin">SubTotal: $ ' + nv_articulo.subtotal + '</div>';
        div = div + '<div class="col-12 divBackgroundBlue3 divMargin">Total: $ ' + nv_articulo.total + '</div>';
        //Total
        $("#divVenta").html($("#divVenta").html() + div);
    }
}

function calcularCostoArticulo(index) {
    nv_articulo = nv_articulos[index];
    nv_articulo.total = nv_articulo.cantidad * nv_articulo.precio;
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
    nv_total = total;
    $("#lblTotal").text("$ " + total);
}

function realizarVenta() {
    var fecha = obtenerFechaHoraActual();
    var subTotal = nv_subTotal;
    var descuentoPorcentaje = nv_descuentoPorcentaje;
    var descuentoCantidad = nv_descuentoCantidad;
    var total = nv_total;
    var estado = 'ACTIVO';
    var tipo = 'EFECTIVO';
    var cambio = 0;
    var articulos = nv_articulos;

    if (nv_articulos.length == 0) {
        alert("No existen artículos en la venta.");
        return;
    }

    $.ajax({url: "php/agregarEstudio.php", async: false, type: "POST", data: { estudio : estudio }, success: function(res) {
        if (res == 'OK') {
            $("#tbNuevoEstudio").val('');
            $('#modalAgregarEstudio').modal('hide');
        } else {
            alert(res);
        }
    }});
}