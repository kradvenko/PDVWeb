//Variables para el módulo de ver servicio
var vs_IdServicioElegido = 0;
var vs_IdMarcaElegida = 0;
var vs_IdClienteElegido = 0;
var vs_Botones = [];
var vs_EstadoServicio = '';

//Funciones para el módulo de ver servicio
function elegirServicio(id) {
    vs_IdServicioElegido = id;
    cargarDatosServicio();
}

function cargarDatosServicio() {
    if (vs_IdServicioElegido > 0) {
        $.ajax({url: "php/obtenerServicioXML.php", async: false, type: "POST", data: { idServicio: vs_IdServicioElegido }, success: function(res) {
            $('resultado', res).each(function(index, element) {
                vs_IdClienteElegido = $(this).find("idcliente").text(); 
                $("#tbServicioCliente").val($(this).find("cliente").text());
                $("#tbESN").val($(this).find("esn").text());
                $("#tbFolio").val($(this).find("folio").text());
                vs_IdMarcaElegida = $(this).find("idmarca").text();
                $("#tbMarca").val($(this).find("marca").text());
                $("#tbModelo").val($(this).find("modelo").text());
                if ($(this).find("bateria").text() == "SI") {
                    $("#cbBateria").prop("checked", true);
                }
                if ($(this).find("tapa").text() == "SI") {
                    $("#cbTapa").prop("checked", true);
                }
                $("#tbOtro").val($(this).find("otro").text());
                $("#taFalla").val($(this).find("falla").text());
                $("#taObservaciones").val($(this).find("observaciones").text());
                $("#tbFechaEntrega").val($(this).find("fechaentregaestimada").text());
                $("#tbContraseña").val($(this).find("contraseña").text());
                $("#tbCosto").val($(this).find("costo").text());
                $("#tbAnticipo").val($(this).find("anticipo").text());
                vs_Botones = JSON.parse($(this).find("patron").text());
                vs_EstadoServicio = $(this).find("estado").text();
            });
        }});
        mostrarBotones();
    }
}

function limpiarCamposServicio() {
    $("#tbServicioCliente").val("");
    $("#tbBuscarServicio").val("");
    vs_IdClienteElegido = 0;
    $("#tbESN").val("");
    $("#tbFolio").val("");
    $("#tbMarca").val("");
    $("#tbModelo").val("");
    $("#cbBateria").prop("checked", false);
    $("#cbTapa").prop("checked", false);
    $("#tbOtro").val("");
    $("#taFalla").val("");
    $("#tbFechaEntrega").val("");
    $("#tbContraseña").val("");
    $("#tbCosto").val("0");
    $("#tbAnticipo").val("0");
    $("#taObservaciones").val("");

    for (i = 1; i <= 9; i++) {
        var boton = { num: i, pos: 0, val: false}
        vs_Botones[i] = boton;
    }
    vs_Pos = 1;
    mostrarBotones();
}

function mostrarBotones() {
    for (i = 1; i <= 9; i++) {
        if (vs_Botones[i].val) {
            $("#btnPatron" + i).val(vs_Botones[i].pos);
        } else {
            $("#btnPatron" + i).val("");
        }
    }
}

function limpiarPatron() {
    for (i = 1; i <= 9; i++) {
        var boton = { num: i, pos: 0, val: false}
        vs_Botones[i] = boton;
    }
    ns_Pos = 1;
    mostrarBotones();
}

function cargarDatosCliente() {
    if (vs_IdClienteElegido > 0) {
        $.ajax({url: "php/obtenerClienteXML.php", async: false, type: "POST", data: { idCliente: vs_IdClienteElegido }, success: function(res) {
            $('resultado', res).each(function(index, element) {
                $("#tbClienteNombre").val($(this).find("nombre").text());
                $("#tbClienteDireccion").val($(this).find("direccion").text());
                $("#tbClienteColonia").val($(this).find("colonia").text());
                $("#tbClienteTelefono1").val($(this).find("telefono1").text());
                $("#tbClienteTelefono2").val($(this).find("telefono2").text());
                $("#tbClienteCorreo").val($(this).find("correo").text());
                $("#tbClienteTienda").val($(this).find("tienda").text());
                $("#selClienteTipo").val($(this).find("tipo").text());
                $("#taClienteNotas").val($(this).find("notas").text());
            });
        }});
    }
}

function servicioListo() {
    if (vs_EstadoServicio != 'ACTIVO') {
        alert("El servicio ya ha sido finalizado.");
    }
}

function verBitacora() {
    if (vs_IdServicioElegido > 0) {
        $.ajax({url: "php/obtenerBitacora.php", async: false, type: "POST", data: { idServicio: vs_IdServicioElegido }, success: function(res) {
            $("#divBitacoraEntradas").html(res);
        }});
    }
}

function guardarEntrada() {
    var entrada = $("#tbNuevaEntrada").val();
    var prioridad = $("#selPrioridad").val();
    var fecha = obtenerFechaHoraActual("FULL");

    $.ajax({url: "php/guardarBitacora.php", async: false, type: "POST", data: { idServicio: vs_IdServicioElegido, entrada: entrada, prioridad: prioridad, fecha: fecha }, success: function(res) {
        if (res == "OK") {
            $("#tbNuevaEntrada").val('');
        } else {
            alert(res);
        }
    }});

    $.ajax({url: "php/obtenerBitacora.php", async: false, type: "POST", data: { idServicio: vs_IdServicioElegido }, success: function(res) {
        $("#divBitacoraEntradas").html(res);
    }});
}