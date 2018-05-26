//Variables globales para módulo de instituciones
var categorias = []; 
var categoria;
var contactos = [];
var contacto;
var idInstitucion = 0;
var idContacto = 0;
var idSitioWeb = 0;
var idCorreo = 0;
var idTelefono = 0;
var idArea = 0;
var idPendienteInstitucion = 0;
//Funciones para el módulo de instituciones
function obtenerCategoriasInstitucionSelect() {
    $.ajax({url: "php/obtenerCategoriasInstitucionSelect.php", async: false, type: "POST", data: { idSelect: "selectCategoriasInstitucion" }, success: function(res) {
        $('#divListaCategoriasInstitucion').html(res);
    }});
}

function agregarCategoriaInstitucion() {
    var categoria;
    categoria = $("#tbNuevaCategoria").val();
    $.ajax({url: "php/agregarCategoriaInstitucion.php", async: false, type: "POST", data: { categoria: categoria }, success: function(res) {
        if (res == 'OK') {
            $("#tbNuevaCategoria").val('');
            obtenerCategoriasInstitucionSelect();
            alert("Se ha agregado la categoría.");
        } else {
            alert(res);
        }
    }});
}

function agregarCategoria() {
    categoria =  { id: $("#selectCategoriasInstitucion").val(), categoria: $("#selectCategoriasInstitucion").children(":selected").text() };
    categorias[categorias.length] = categoria;
    mostrarCategorias();
}

function mostrarCategorias() {
    $("#divCategoriasInstitucion").html("");
    for (i = 0; i <= categorias.length - 1; i++) {
        categoria = categorias[i];
        $("#divCategoriasInstitucion").html($("#divCategoriasInstitucion").html() + '<span class="tag"><span>' + categoria.categoria + '</span><span href="" onclick="quitarCategoria(' + i + ')" class="closeTag">x</span></span>');
    }
}

function quitarCategoria(index) {
    categorias.splice(index, 1);
    mostrarCategorias();
}

function obtenerPaisesSelectInstitucion() {
    $.ajax({url: "php/obtenerPaisesSelect.php", async: false, type: "POST", data: { idSelect: "selectPaisInstitucion" }, success: function(res) {
        $('#divPaisSelect').html(res);
        $('#selectPaisInstitucion').on("change", obtenerRegionesInstitucionSelect);
    }});
    obtenerRegionesInstitucionSelect();    
}

function obtenerRegionesInstitucionSelect() {
    var idPais;
    idPais = $("#selectPaisInstitucion").val();
    $.ajax({url: "php/obtenerRegionesSelect.php", async: false, type: "POST", data: { idSelect: "selectRegionInstitucion", idPais: idPais }, success: function(res) {
        $('#divRegionSelect').html(res);
        $('#selectRegionInstitucion').on("change", obtenerCiudadesInstitucionSelect);
    }});
    obtenerCiudadesInstitucionSelect();
}

function obtenerCiudadesInstitucionSelect() {
    var idRegion;
    idRegion = $("#selectRegionInstitucion").val();
    $.ajax({url: "php/obtenerCiudadesSelect.php", async: false, type: "POST", data: { idSelect: "selectCiudadInstitucion", idRegion: idRegion }, success: function(res) {
        $('#divCiudadSelect').html(res);
    }});
}

function guardarInstitucion() {
    var nombreInstitucion = '';
    var sectorInstitucion = '';
    var tipoInstitucion = '';
    //var sitioWeb = '';
    //var correoElectronico = '';
    //var telefonos = '';
    //var extension = '';
    var domicilio = '';
    var colonia = '';
    var codigoPostal = '';
    var pais = '';
    var region = '';
    var ciudad = '';

    nombreInstitucion = $("#tbNombreInstitucion").val();
    if (nombreInstitucion.length == 0) {
        alert("No ha intorducido el nombre de la institución.")
        return;
    }
    sectorInstitucion = $("#selectSectorInstitucion").val();
    tipoInstitucion = $("#selectTipoInstitucion").val();
    /*
    sitioWeb = $("#tbSitioWeb").val();
    if (sitioWeb.length == 0) {
        sitioWeb = '';
    }
    correoElectronico = $("#tbCorreoElectronico").val();
    if (correoElectronico.length == 0) {
        correoElectronico = '';
    }
    telefonos = $("#tbTelefonosInstitucion").val();
    if (telefonos.length == 0) {
        telefonos = '';
    }
    extension = $("#tbExtensionInstitucion").val();
    if (extension.length == 0) {
        extension = '';
    }
    */
    domicilio = $("#tbDomicilioInstitucion").val();
    if (domicilio.length == 0) {
        domicilio = '';
    }
    colonia = $("#tbColoniaInstitucion").val();
    if (colonia.length == 0) {
        colonia = '';
    }
    codigoPostal = $("#tbCodigoPostalInstitucion").val();
    if (codigoPostal.length == 0) {
        codigoPostal = '';
    }
    pais = $("#selectPaisInstitucion").val();
    region = $("#selectRegionInstitucion").val();
    ciudad = $("#selectCiudadInstitucion").val();
    
    if (idInstitucion == 0) {
        $.ajax({url: "php/agregarInstitucion.php", async: false, type: "POST", data: { nombreInstitucion: nombreInstitucion,
            sectorInstitucion: sectorInstitucion, tipoInstitucion: tipoInstitucion, domicilio: domicilio, colonia: colonia, codigoPostal: codigoPostal,
            idPais: pais, idRegion: region, idCiudad: ciudad, categorias: categorias }, success: function(res) {
                alert(res);
                limpiarCamposInstitucion();
                obtenerInstituciones();
        }});
    } else {
        $.ajax({url: "php/actualizarInstitucion.php", async: false, type: "POST", data: { idInstitucion: idInstitucion, nombreInstitucion: nombreInstitucion,
            sectorInstitucion: sectorInstitucion, tipoInstitucion: tipoInstitucion, domicilio: domicilio, colonia: colonia, codigoPostal: codigoPostal,
            idPais: pais, idRegion: region, idCiudad: ciudad, categorias: categorias }, success: function(res) {
                alert(res);
                limpiarCamposInstitucion();
                obtenerInstituciones();
        }});
    }
}

function obtenerInstituciones() {
    $.ajax({url: "php/obtenerInstituciones.php", async: false, type: "POST", success: function(res) {
        $('#divListaInstituciones').html(res);
    }});
}

function elegirInstitucion(id) {
    idInstitucion = id;
    $.ajax({url: "php/obtenerInstitucionXML.php", async: false, type: "POST", data: { idInstitucion: idInstitucion }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            $("#tbNombreInstitucion").val($(this).find("nombreInstitucion").text());
            $("#selectSectorInstitucion").val($(this).find("sectorInstitucion").text());
            $("#selectTipoInstitucion").val($(this).find("tipoInstitucion").text());
            //$("#tbSitioWeb").val($(this).find("sitioWeb").text());
            //$("#tbCorreoElectronico").val($(this).find("correoElectronico").text());
            //$("#tbTelefonosInstitucion").val($(this).find("telefonos").text());
            //$("#tbExtensionInstitucion").val($(this).find("extension").text());
            $("#tbDomicilioInstitucion").val($(this).find("domicilio").text());
            $("#tbColoniaInstitucion").val($(this).find("colonia").text());
            $("#tbCodigoPostalInstitucion").val($(this).find("codigoPostal").text());
            $("#selectPaisInstitucion").val($(this).find("idpais").text());
            obtenerRegionesInstitucionSelect();
            $("#selectRegionInstitucion").val($(this).find("idregion").text());
            obtenerCiudadesInstitucionSelect();
            $("#selectCiudadInstitucion").val($(this).find("idciudad").text());
        });
    }});
    $.ajax({url: "php/obtenerCategoriasInstitucionXML.php", async: false, type: "POST", data: { idInstitucion: idInstitucion }, success: function(res) {
        categorias = [];
        $('cat', res).each(function(index, element) {
            categoria =  { id: $(this).find("idcategoria").text(), categoria: $(this).find("categoria").text() };
            categorias[categorias.length] = categoria;            
        });
    }});
    mostrarCategorias();
    mostrarContactos();
    limpiarCamposContacto();
}

function limpiarCamposInstitucion() {
    $("#tbNombreInstitucion").val('');
    //$("#tbSitioWeb").val('');
    //$("#tbCorreoElectronico").val('');
    //$("#tbTelefonosInstitucion").val('');
    //$("#tbExtensionInstitucion").val('');
    //$("#tbExtensionInstitucion").val('');
    $("#tbDomicilioInstitucion").val('');
    $("#tbColoniaInstitucion").val('');
    $("#tbCodigoPostalInstitucion").val('');
    idInstitucion = 0;
    categorias = [];
    mostrarCategorias();
    ocultarContactos();
}

function mostrarContactos() {
    $("#divContactos").css("visibility", "visible");
    $("#divDatosVarios").css("visibility", "visible");
    obtenerContactos();
}

function ocultarContactos() {
    $("#divContactos").css("visibility", "hidden");
    $("#divDatosVarios").css("visibility", "hidden");
}

function guardarContacto() {
    var nombreContacto;
    var cargoContacto;
    var area;
    var telefonos;
    var extension;
    var correoElectronico;
    var notas;

    if (idInstitucion == 0) {
        alert("No ha elegido una institución.");
        return;
    }

    nombreContacto = $("#tbNombreContacto").val();
    if (nombreContacto.length <= 0) {
        alert("No ha ingresado el nombre del contacto.");
        return;
    }
    cargoContacto = $("#tbCargoContacto").val();
    area = $("#tbAreaContacto").val();
    telefonos = $("#tbTelefonosContacto").val();
    extension = $("#tbExtensionContacto").val();
    correoElectronico = $("#tbCorreoElectronicoContacto").val();
    notas = $("#tbNotasContacto").val();

    if (idContacto == 0) {
        $.ajax({url: "php/agregarContacto.php", async: false, type: "POST", data: { idInstitucion: idInstitucion, nombreContacto: nombreContacto, area: area, cargoContacto: cargoContacto, telefonos: telefonos, extension: extension, correoElectronico: correoElectronico, notas: notas }, success: function(res) {
            alert(res);
            obtenerContactos();
            limpiarCamposContacto();
        }});
    } else {
        $.ajax({url: "php/actualizarContacto.php", async: false, type: "POST", data: { idContacto: idContacto, nombreContacto: nombreContacto, area: area, cargoContacto: cargoContacto, telefonos: telefonos, extension: extension, correoElectronico: correoElectronico, notas: notas }, success: function(res) {
            alert(res);
            obtenerContactos();
            limpiarCamposContacto();
        }});
    }
}

function obtenerContactos() {
    $.ajax({url: "php/obtenerContactos.php", async: false, type: "POST", data: { idInstitucion: idInstitucion }, success: function(res) {
        $('#divListaContactos').html(res);
    }});
}

function limpiarCamposContacto() {
    $("#tbNombreContacto").val('');
    $("#tbAreaContacto").val('');
    $("#tbTelefonosContacto").val('');
    $("#tbExtensionContacto").val('');
    $("#tbCorreoElectronicoContacto").val('');
    $("#tbNotasContacto").val('');
    $("#tbCargoContacto").val('');
    idContacto = 0;
}

function elegirContacto(id) {
    idContacto = id;
    $.ajax({url: "php/obtenerContactoXML.php", async: false, type: "POST", data: { idContacto: idContacto }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            $("#tbNombreContacto").val($(this).find("nombreContacto").text());
            $("#tbAreaContacto").val($(this).find("area").text());
            $("#tbCargoContacto").val($(this).find("cargo").text());
            $("#tbTelefonosContacto").val($(this).find("telefonos").text());
            $("#tbExtensionContacto").val($(this).find("extension").text());
            $("#tbCorreoElectronicoContacto").val($(this).find("correoElectronico").text());
            $("#tbNotasContacto").val($(this).find("notas").text());
        });
    }});
}
//Sitios web
function obtenerSitiosWeb() {
    $.ajax({url: "php/obtenerSitiosWeb.php", async: false, type: "POST", data: { idInstitucion: idInstitucion }, success: function(res) {
        $("#divListaSitiosWeb").html(res);
    }});
}

function elegirSitioWeb(idInstitucionSitioWeb, urlSitioWeb, notasSitioWeb) {
    idSitioWeb = idInstitucionSitioWeb;
    $("#tbSitioWeb").val(urlSitioWeb);
    $("#tbNotasSitioWeb").val(notasSitioWeb);
}

function guardarSitioWeb() {
    if (idInstitucion == 0) {
        return;
    }
    var sitioWeb;
    var notasSitioWeb;

    sitioWeb =  $("#tbSitioWeb").val();
    if (sitioWeb.length == 0) {
        alert("No ha escrito la dirección del sitio web.")
        return;
    }
    notasSitioWeb = $("#tbNotasSitioWeb").val();
    if (idSitioWeb == 0) {
        $.ajax({url: "php/agregarSitioWeb.php", async: false, type: "POST", data: { idInstitucion: idInstitucion, sitioWeb: sitioWeb, notasSitioWeb: notasSitioWeb }, success: function(res) {
            if (res == "OK") {
                obtenerSitiosWeb();
            } else {
                alert(res);
            }
        }});
    } else {
        $.ajax({url: "php/actualizarSitioWeb.php", async: false, type: "POST", data: { idSitioWeb: idSitioWeb, sitioWeb: sitioWeb, notasSitioWeb: notasSitioWeb }, success: function(res) {
            if (res == "OK") {
                obtenerSitiosWeb();
            } else {
                alert(res);
            }
        }});
    }
}

function limpiarCamposSitioWeb() {
    idSitioWeb = 0;
    $("#tbSitioWeb").val("");
    $("#tbNotasSitioWeb").val("");

}
//Correos
function obtenerCorreos() {
    $.ajax({url: "php/obtenerCorreos.php", async: false, type: "POST", data: { idInstitucion: idInstitucion }, success: function(res) {
        $("#divListaCorreos").html(res);
    }});
}

function elegirCorreo(idInstitucionCorreo, correo, notasCorreo) {
    idCorreo = idInstitucionCorreo;
    $("#tbCorreoElectronico").val(correo);
    $("#tbNotasCorreoElectronico").val(notasCorreo);
}

function guardarCorreo() {
    if (idInstitucion == 0) {
        return;
    }
    var correo;
    var notasCorreo;

    correo =  $("#tbCorreoElectronico").val();
    if (correo.length == 0) {
        alert("No ha escrito el correo electrónico.")
        return;
    }
    notasCorreo = $("#tbNotasCorreoElectronico").val();
    if (idCorreo == 0) {
        $.ajax({url: "php/agregarCorreo.php", async: false, type: "POST", data: { idInstitucion: idInstitucion, correo: correo, notasCorreo: notasCorreo }, success: function(res) {
            if (res == "OK") {
                obtenerCorreos();
            } else {
                alert(res);
            }
        }});
    } else {
        $.ajax({url: "php/actualizarCorreo.php", async: false, type: "POST", data: { idCorreo: idCorreo, correo: correo, notasCorreo: notasCorreo }, success: function(res) {
            if (res == "OK") {
                obtenerCorreos();
            } else {
                alert(res);
            }
        }});
    }
}

function limpiarCamposCorreo() {
    idCorreo = 0;
    $("#tbCorreoElectronico").val("");
    $("#tbNotasCorreoElectronico").val("");
}
//Telefonos
function obtenerTelefonos() {
    $.ajax({url: "php/obtenerTelefonos.php", async: false, type: "POST", data: { idInstitucion: idInstitucion }, success: function(res) {
        $("#divListaTelefonos").html(res);
    }});
}

function elegirTelefono(idInstitucionTelefono, telefono, extension, notasTelefono) {
    idTelefono = idInstitucionTelefono;
    $("#tbTelefono").val(telefono);
    $("#tbTelefonoExtension").val(extension);
    $("#tbTelefonoNotas").val(notasTelefono);
}

function guardarTelefono() {
    if (idInstitucion == 0) {
        return;
    }
    var telefono;
    var extension;
    var notasTelefono;

    telefono =  $("#tbTelefono").val();
    if (telefono.length == 0) {
        alert("No ha escrito el teléfono.")
        return;
    }
    extension = $("#tbTelefonoExtension").val();
    notasTelefono = $("#tbTelefonoNotas").val();
    if (idTelefono == 0) {
        $.ajax({url: "php/agregarTelefono.php", async: false, type: "POST", data: { idInstitucion: idInstitucion, telefono: telefono, extension: extension, notasTelefono: notasTelefono }, success: function(res) {
            if (res == "OK") {
                obtenerTelefonos();
            } else {
                alert(res);
            }
        }});
    } else {
        $.ajax({url: "php/actualizarTelefono.php", async: false, type: "POST", data: { idTelefono: idTelefono, telefono: telefono, extension: extension, notasTelefono: notasTelefono }, success: function(res) {
            if (res == "OK") {
                obtenerTelefonos();
            } else {
                alert(res);
            }
        }});
    }
}

function limpiarCamposTelefono() {
    idTelefono = 0;
    $("#tbTelefono").val("");
    $("#tbTelefonoExtension").val("");
    $("#tbTelefonoNotas").val("");
}
//Áreas
function obtenerAreas() {
    $.ajax({url: "php/obtenerAreas.php", async: false, type: "POST", data: { idInstitucion: idInstitucion }, success: function(res) {
        $("#divListaAreas").html(res);
    }});
}

function elegirArea(idInstitucionArea, area, notasArea) {
    idArea = idInstitucionArea;
    $("#tbArea").val(area);
    $("#tbAreaNotas").val(notasArea);
}

function guardarArea() {
    if (idInstitucion == 0) {
        return;
    }
    var area;
    var notasArea;

    area =  $("#tbArea").val();
    if (area.length == 0) {
        alert("No ha escrito el área.")
        return;
    }
    notasArea = $("#tbAreaNotas").val();
    if (idArea == 0) {
        $.ajax({url: "php/agregarArea.php", async: false, type: "POST", data: { idInstitucion: idInstitucion, area: area, notasArea: notasArea }, success: function(res) {
            if (res == "OK") {
                obtenerAreas();
            } else {
                alert(res);
            }
        }});
    } else {
        $.ajax({url: "php/actualizarArea.php", async: false, type: "POST", data: { idArea: idArea, area: area, notasArea: notasArea }, success: function(res) {
            if (res == "OK") {
                obtenerAreas();
            } else {
                alert(res);
            }
        }});
    }
}

function limpiarCamposArea() {
    idArea = 0;
    $("#tbArea").val("");
    $("#tbAreaNotas").val("");
}
//Pendientes institución
function obtenerPendientesInstitucion() {
    $.ajax({url: "php/obtenerPendientesInstitucion.php", async: false, type: "POST", data: { idInstitucion: idInstitucion }, success: function(res) {
        $("#divListaPendientesInstitucion").html(res);
    }});
}

function elegirPendienteInstitucion(idInstitucionPendiente, pendiente, estado, fechaInicio, fechaFin, resolucion) {
    idPendienteInstitucion = idInstitucionPendiente;
    $("#tbPendienteInstitucion").val(pendiente);
    $("#tbPendienteInstitucionResolucion").val(resolucion);
    $("#lblPendienteInstitucionEstado").text(estado);
    $("#lblPendienteInstitucionFechaInicio").text(fechaInicio);
    $("#lblPendienteInstitucionFechaFin").text(fechaFin);
}

function guardarPendienteInstitucion(estado) {
    if (idInstitucion == 0) {
        return;
    }
    var pendiente;
    var resolucion;
    var fechaInicio;
    var fechaFin;

    pendiente =  $("#tbPendienteInstitucion").val();
    if (pendiente.length == 0) {
        alert("No ha escrito el pendiente.")
        return;
    }
    resolucion = $("#tbPendienteInstitucionResolucion").val();
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var output = ((''+day).length<2 ? '0' : '') + day + '/' +
    ((''+month).length<2 ? '0' : '') + month + '/' +
    d.getFullYear();

    fechaInicio = output;
    fechaFin = output;

    if (idPendienteInstitucion == 0) {
        $.ajax({url: "php/agregarPendienteInstitucion.php", async: false, type: "POST", data: { idInstitucion: idInstitucion, pendiente: pendiente, estado: estado, resolucion: resolucion, fechaInicio: fechaInicio }, success: function(res) {
            if (res == "OK") {
                obtenerPendientesInstitucion();
            } else {
                alert(res);
            }
        }});
    } else {
        $.ajax({url: "php/actualizarPendienteInstitucion.php", async: false, type: "POST", data: { idPendienteInstitucion: idPendienteInstitucion, pendiente: pendiente, estado: estado, resolucion: resolucion, fechaFin: fechaFin }, success: function(res) {
            if (res == "OK") {
                obtenerPendientesInstitucion();
            } else {
                alert(res);
            }
        }});
    }
}

function limpiarCamposPendienteInstitucion() {
    idPendienteInstitucion = 0;
    $("#tbPendienteInstitucion").val("");
    $("#tbPendienteInstitucionResolucion").val("");
    $("#lblPendienteInstitucionEstado").text("");
    $("#lblPendienteInstitucionFechaInicio").text("");
    $("#lblPendienteInstitucionFechaFin").text("");
}