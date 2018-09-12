//Variables para el nuevo servicio
var ns_IdCliente = 0;
var ns_Botones = [];
var ns_Pos = 1;
var ns_IdMarcaElegida = 0;
var ns_IdServicioElegido = 0;
//Funciones para el nuevo servicio
function guardarCliente() {
    var nombre = $("#tbNuevoClienteNombre").val();
    var direccion = $("#tbNuevoClienteDireccion").val();
    var colonia = $("#tbNuevoClienteColonia").val();
    var telefono1 = $("#tbNuevoClienteTelefono1").val();
    var telefono2 = $("#tbNuevoClienteTelefono2").val();
    var correo = $("#tbNuevoClienteCorreo").val();
    var tienda = $("#tbNuevoClienteTienda").val();
    var tipo = $("#selNuevoClienteTipo").val();
    var fechaCaptura = obtenerFechaHoraActual();
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
    ns_IdCliente = id;
}

function elegirMarca(id) {
    ns_IdMarcaElegida = id;
}

function limpiarCamposNuevoServicio() {
    $("#tbServicioCliente").val("");
    ns_IdCliente = 0;
    $("#tbESN").val("");
    $("#tbFolio").val("");
    $("#tbMarca").val("");
    $("#tbModelo").val("");
    $("#cbBateria").prop("checked", false);
    $("#cbTapa").prop("checked", false);
    $("#tbOtro").val("");
    $("#taFalla").val("");
    $("#tbFechaEntregaEstimada").val("");
    $("#tbContraseña").val("");
    $("#tbCosto").val("0");
    $("#tbAnticipo").val("0");
    $("#taObservaciones").val("");

    for (i = 1; i <= 9; i++) {
        var boton = { num: i, pos: 0, val: false}
        ns_Botones[i] = boton;
    }
    ns_Pos = 1;
    mostrarBotones();
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

function marcar(numero) {
    var boton = { num: numero, pos: ns_Pos, val: !ns_Botones[numero].val };
    ns_Botones[numero] = boton;
    if (boton.val) {        
        ns_Pos++;
    } else {        
        ns_Pos--;
    }
    mostrarBotones();
}

function mostrarBotones() {
    for (i = 1; i <= 9; i++) {
        if (ns_Botones[i].val) {
            $("#btnPatron" + i).val(ns_Botones[i].pos);
            $("#btnPatron" + i).addClass("buttonChecked");
        } else {
            $("#btnPatron" + i).val("");
            $("#btnPatron" + i).removeClass("buttonChecked");
        }
    }
}

function limpiarPatron() {
    for (i = 1; i <= 9; i++) {
        var boton = { num: i, pos: 0, val: false}
        ns_Botones[i] = boton;
    }
    ns_Pos = 1;
    mostrarBotones();
}

function agregarServicio() {
    if (ns_IdCliente == 0) {
        alert("No ha elegido un cliente para el servicio.");
        return;
    }
    var idCliente = ns_IdCliente;
    var esn = $("#tbESN").val();
    var folio = $("#tbFolio").val();
    var idMarca = ns_IdMarcaElegida;
    var modelo = $("#tbModelo").val();
    var bateria = $("#cbBateria").prop("checked", true) ? "SI" : "NO";
    var tapa = $("#cbTapa").prop("checked", true) ? "SI" : "NO";
    var otro = $("#tbOtro").val();
    var falla = $("#taFalla").val();
    var observaciones = $("#taObservaciones").val();
    var fechaEntregaEstimada = $("#tbFechaEntregaEstimada").val();
    var contraseña = $("#tbContraseña").val();
    var costo = $("#tbCosto").val();
    var anticipo = $("#tbAnticipo").val();
    var fechaIngresado = obtenerFechaHoraActual();
    var patron = ns_Botones;
    var notas = "";
    var estado = "ACTIVO";

    if (ns_IdServicioElegido == 0) {
        $.ajax({url: "php/agregarServicio.php", async: false, type: "POST", data: { idCliente : idCliente, esn: esn, folio: folio,
        idMarca: idMarca, modelo: modelo, bateria: bateria, tapa: tapa, otro: otro, falla: falla, observaciones: observaciones, fechaEntregaEstimada: fechaEntregaEstimada,
        contraseña: contraseña, costo: costo, anticipo: anticipo, fechaIngresado: fechaIngresado, estado: estado, notas: notas, patron: patron }, success: function(res) {
            if (!isNaN(res)) {
                alert("Se ha ingresado el servicio.");
                limpiarCamposNuevoServicio();
                window.open("boletaservicio.php?idServicio=" + res,'_blank');
            } else {
                alert(res);
            }
        }});
    } else {

    }
}