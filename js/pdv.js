﻿pdv_IdTienda = 0;

//Funciones misceláneas
function getCookie(cookie) {
	//Separar el arreglo de cookies
	var cookies = document.cookie.split(/;\s*/);
	//Expresión regular para buscar el nombre de la cookie en el arreglo
	var pattern = new RegExp("\\b" + cookie + "=(.*)");
	//Ciclo para buscar en el arreglo
	for (var i = 0; i < cookies.length; i++) {
		var match = cookies[i].match(pattern);
		if (match) {
			return decodeURIComponent(match[1]);
		}
	}
	return null;
}

function userLogin() {
    var u;
    var p;

    u = $("#tbUsuario").val();
    p = $("#tbPassword").val();

    if (u.length == 0) {
        alert("No ha introducido el nombre de usuario.");
        return;
    }
    if (p.length == 0) {
        alert("No ha introducido la contraseña.")
        return;
    }

    $.ajax({url: "php/userLoginXML.php", async: false, type: "POST", data: { u: u, p: p }, success: function(res) {
        $('resultado', res).each(function(index, element) {
            if ($(this).find("respuesta").text() == "OK") {
                document.cookie = "idusuario=" + $(this).find("idusuario").text() + "; Path=/;";
                document.cookie = "usuario=" + $(this).find("usuario").text() + "; Path=/;";
                document.cookie = "tipo=" + $(this).find("tipo").text() + "; Path=/;";
                document.cookie = "nombre=" + $(this).find("nombre").text() + "; Path=/;";
                document.cookie = "idtienda=" + $(this).find("idtienda").text() + "; Path=/;";
                document.cookie = "tienda=" + $(this).find("tienda").text() + "; Path=/;";
                document.cookie = "prefijo=" + $(this).find("prefijo").text() + "; Path=/;";
                document.cookie = "tipotienda=" + $(this).find("tipotienda").text() + "; Path=/;";
                document.location = "menu.php";
            } else {
                alert("Usuario o contraseña incorrectos.");
            }
        });
    }});
}

function checkSession() {
    if (!getCookie("idusuario")) {
        document.location = "index.php";
    }
}

function getIdTienda() {
    return getCookie("idtienda");
}

function cerrarSesion() {
    document.cookie = "idusuario=; Path=/; Expires= Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = "usuario=; Path=/; Expires= Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = "tipo=; Path=/; Expires= Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = "nombre=; Path=/; Expires= Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = "idtienda=; Path=/; Expires= Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = "tienda=; Path=/; Expires= Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = "prefijo=; Path=/; Expires= Thu, 01 Jan 1970 00:00:01 GMT;";
    document.cookie = "tipotienda=; Path=/; Expires= Thu, 01 Jan 1970 00:00:01 GMT;";
    document.location = "index.php";
}

function obtenerFechaHoraActual() {
    var currentdate = new Date();
    return (currentdate.getDate() < 10 ? "0" + currentdate.getDate() : currentdate.getDate()) + "/"
                + ((currentdate.getMonth() + 1) < 10 ? ("0" + (currentdate.getMonth() + 1)) : (currentdate.getMonth() + 1)) + "/" 
                + currentdate.getFullYear() + " @ "  
                + (currentdate.getHours() < 10 ? ("0" + currentdate.getHours()) : currentdate.getHours()) + ":"  
                + (currentdate.getMinutes() < 10 ? ("0" + currentdate.getMinutes()) : currentdate.getMinutes()) + ":"  
                + (currentdate.getSeconds() < 10 ? ("0" + currentdate.getSeconds()) : currentdate.getSeconds());
}

function obtenerFechaHoraActual(tipo) {
    var currentdate = new Date();
    switch (tipo) {
        case 'FULL': return (currentdate.getDate() < 10 ? "0" + currentdate.getDate() : currentdate.getDate()) + "/"
                + ((currentdate.getMonth() + 1) < 10 ? ("0" + (currentdate.getMonth() + 1)) : (currentdate.getMonth() + 1)) + "/" 
                + currentdate.getFullYear() + " @ "  
                + (currentdate.getHours() < 10 ? ("0" + currentdate.getHours()) : currentdate.getHours()) + ":"  
                + (currentdate.getMinutes() < 10 ? ("0" + currentdate.getMinutes()) : currentdate.getMinutes()) + ":"  
                + (currentdate.getSeconds() < 10 ? ("0" + currentdate.getSeconds()) : currentdate.getSeconds());
                break;
        case 'DAY': return (currentdate.getDate() < 10 ? "0" + currentdate.getDate() : currentdate.getDate());
                break;
        case 'MONTH': return (currentdate.getMonth() + 1) < 10 ? ("0" + (currentdate.getMonth() + 1)) : (currentdate.getMonth() + 1);
                break;
        case 'YEAR': return currentdate.getFullYear();
                break;

    }    
}