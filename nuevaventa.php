<!DOCTYPE html>

<html>
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.structure.min.css" />
    <link rel="stylesheet" type="text/css" href="css/pdv.css" />
    <link rel="icon" href="favicon.ico">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/pdv.js"></script>
    <script src="js/nuevaventa.js"></script>
    <script src="js/jquery-ui.min.js"></script>

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
        <div class="row divMargin divBackgroundOrange">
            <div class="col-12">
                Nueva Venta
            </div>
        </div>
        <div class="row divMargin divBackgroundOrange2">
            <div class="col-12">
                Búsqueda de artículo
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Buscar artículo</label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control textbox-center" id="tbArticulo"></input>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-3">
                <label class="labelType01">Descuento Porcentaje</label>
            </div>
            <div class="col-3">
                <label class="labelType01">Descuento Cantidad</label>
            </div>
            <div class="col-3">
                <label class="labelType01">SubTotal</label>
            </div>
            <div class="col-3">
                <label class="labelType01">Total</label>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-3">
                <input type="text" id="tbDescuentoPorcentajeVenta" class="form-control textbox-center" value="0" onchange="cambiarDescuentoPorcentajeVenta()"></input>
            </div>
            <div class="col-3">
                <input type="text" id="tbDescuentoCantidadVenta" class="form-control textbox-center" value="0" onchange="cambiarDescuentoCantidadVenta()"></input>
            </div>
            <div class="col-3">
                <label class="labelType02" id="lblSubTotal">-</label>
            </div>
            <div class="col-3">
                <label class="labelType02" id="lblTotal">-</label>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-3">
                <input type="checkbox" id="cbIva" onclick="calcularTotal()"><label for="cbIva" class="labelType01">Incluir I.V.A.</label>
            </div>
            <div class="col-3">
            
            </div>
            <div class="col-3">
            
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary btn-success">Realizar venta</button>
            </div>
        </div>
        <div class="row divMargin" id="divVenta">

        </div>
    </div>
</body>
<script>
    $( document ).ready(function() {
        checkSession();
        $(function() {     
            $("#tbArticulo").autocomplete({
                source: "php/obtenerArticulosJSON.php",
                minLength: 2,
                select: function(event, ui) {
                    agregarArticuloVenta(ui.item.id, ui.item.value, ui.item.precio);
                    this.value = '';
                    return false;
                }
            });
        });
    });    
</script>
</html>