<!DOCTYPE html>

<html>
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.structure.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jsgrid.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jsgrid-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="css/pdv.css" />
    <link rel="stylesheet" type="text/css" href="css/slider.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" />
    <link rel="icon" href="favicon.ico">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/pdv.js"></script>
    <script src="js/clientes.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jsgrid.min.js"></script>

    <title>Punto de Venta</title>
</head>
<body>
    <div class="container">
        <div class="row divBackgroundBlack">
            <div class="divLogo">

            </div>
        </div>        
        <?php
            require_once('php/menu.php');
            echo menu();
        ?> 
        <div class="row divMargin">
            <div class="col-1">
                <label class="labelType01">Cliente</label>
            </div>
            <div class="col-5">
                <input type="text" id="tbCliente" class="form-control" />
            </div>
            <div class="col-3">
                
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-12">
                Nombre del cliente
            </div>
            <div class="col-12">
                <input type="text" id="tbClienteNombre" class="form-control" />
            </div>
            <div class="col-12">
                Dirección
            </div>
            <div class="col-12">
                <input type="text" id="tbClienteDireccion" class="form-control" />
            </div>
            <div class="col-12">
                Colonia
            </div>
            <div class="col-12">
                <input type="text" id="tbClienteColonia" class="form-control" />
            </div>
            <div class="col-6">
                Teléfono 1
            </div>
            <div class="col-6">
                Whatsapp
            </div>
            <div class="col-6">
                <input type="text" id="tbClienteTelefono1" class="form-control" />
            </div>
            <div class="col-6">
                <input type="text" id="tbClienteTelefono2" class="form-control" />
            </div>
            <div class="col-12">
                Correo electrónico
            </div>
            <div class="col-12">
                <input type="text" id="tbClienteCorreo" class="form-control" />
            </div>
            <div class="col-12">
                Tienda
            </div>
            <div class="col-12">
                <input type="text" id="tbClienteTienda" class="form-control" />
            </div>
            <div class="col-12">
                Tipo
            </div>
            <div class="col-12">
                <select id="selClienteTipo" class="form-control">
                    <option value="NORMAL">NORMAL</option>
                    <option value="DISTRIBUIDOR">DISTRIBUIDOR</option>
                </select>
            </div>
            <div class="col-12">
                Notas
            </div>
            <div class="col-12">
                <textarea id="taClienteNotas" rows="3" maxlength="200" class="form-control"></textarea>
            </div>
        </div>
    </div>    
</body>
<script>
    $( document ).ready(function() {
        checkSession();
        limpiarCamposClientes();

        $(function() {     
            $("#tbServicioCliente").autocomplete({
                source: "php/obtenerClientesJSON.php",
                minLength: 2,
                select: function(event, ui) {
                    elegirCliente(ui.item.id);
                    cargarDatosCliente();
                    this.value = '';
                    return false;
                }
            });
        });
    });    
</script>
</html>