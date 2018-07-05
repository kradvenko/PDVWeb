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
    <script src="js/envios.js"></script>
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
            require_once('php/funcionesEnvios.php');
        ?>
        <div class="row divMargin divBackgroundOrange">
            <div class="col-12">
                Envíos matriz-tiendas
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-4">
                Elije una tienda a la que se enviará la mercancía
            </div>
            <div class="col-8" id="divListaTiendas">
                <?php 
                    listaTiendas();
                ?>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-4">
                Buscar artículo
            </div>
            <div class="col-8">
               <input type="text" class="form-control" id="tbBuscarArticulo" />
            </div>
        </div>
        <div class="row divMargin" id="divArticulos">

        </div>
    </div>
    <!--Ventana modal para la cantidad de artículos-->
    <div class="modal fade" id="modalCantidadArticulo" tabindex="-1" role="dialog" aria-labelledby="modalCantidadArticulo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cantidad de artículos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            Cantidad de artículos a enviar
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbCantidad" class="form-control"></input>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="elegirArticulo()">Guardar</button>                        
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>                        
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $( document ).ready(function() {
        checkSession();
        $(function() {     
            $("#tbBuscarArticulo").autocomplete({
                source: 
                function(request, response) {
                $.getJSON(
                    "php/obtenerArticulosJSON.php",
                    { term: request.term, idTienda: getIdTienda() },
                    response
                );},
                minLength: 2,
                select: function(event, ui) {
                    mostrarCantidadArticulo(ui.item.id);
                }
            });
        });
        limpiarCamposEnvio();
    });
    $('#modalCantidadArticulo').on('shown.bs.modal', function() {
        $('#tbCantidad').focus();
    });
</script>
</html>