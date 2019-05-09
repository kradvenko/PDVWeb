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
    <script src="js/verenvios.js"></script>
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
                Revisión de envíos
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-12" id="divListaEnvios">

            </div>
        </div>
        <div class="row divMargin">
            <div class="col-12 divPageShortInfo" id="divDatosEnvio">
                
            </div>
        </div>        
        <div class="row divMargin" id="divArticulos">

        </div>
    </div>
    <!--Ventana modal para ver los detalles del artículo-->
    <div class="modal fade" id="modalVerDetalleArticulo" tabindex="-1" role="dialog" aria-labelledby="modalVerDetalleArticulo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle del artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            Cantidad de artículos enviados
                        </div>
                        <div class="col-12" id="divCantidadArticulosEnviados">
                            
                        </div>
                        <div class="col-12">
                            Cantidad de artículos recibidos
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbCantidadRecibido" class="form-control" value="0"></input>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="recibirArticulo()">Guardar</button>                        
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
        obtenerEnvios();
        $('#divRecibirEnvioControl').hide();
    });
    $('#modalVerDetalleArticulo').on('shown.bs.modal', function() {
        $('#tbCantidadRecibido').focus();
    });
</script>
</html>