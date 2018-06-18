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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" />
    <link rel="icon" href="favicon.ico">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/pdv.js"></script>
    <script src="js/lotes.js"></script>
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
        <div class="row divMargin divBackgroundOrange">
            <div class="col-12">
                Control de lotes
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-12">
                <label class="labelType01">Últimos lotes agregados (haga click para seleccionar)</label>
            </div>
            <div class="col-12" id="divUltimosLotes">

            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">

            </div>
            <div class="col-2">

            </div>
            <div class="col-2">

            </div>
            <div class="col-2">

            </div>
            <div class="col-2">
                <button class="btn btn-success" onclick="agregarLote()">Guardar</button>
            </div>
            <div class="col-2">
                <button class="btn btn-success" onclick="limpiarCamposNuevoLote()">Limpiar campos</button>
            </div>
        </div>
        <div class="row divMargin divBackgroundOrange2">
            <div class="col-12">
                Datos del artículo
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Origen</label>
            </div>
            <div class="col-3" id="divOrigenLote">
                
            </div>
            <div class="col-1">
                <button class="btn btn-success" data-toggle='modal' data-target='#modalAgregarOrigenLote'>
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="col-2">
                <label class="labelType01">Fecha de lote</label>
            </div>
            <div class="col-4">
                <input type="text" class="form-control textbox-center" id="tbFechaLote" placeholder="dd/mm/aaaa" maxlength="45"></input>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Tipo cambio</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbTipoCambio" maxlength="10"></input>
            </div>            
            <div class="col-2">
                <label class="labelType01">Costo de lote</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoLote" maxlength="10"></input>
            </div>
            <div class="col-1">
                <label class="labelType01">Moneda</label>
            </div>
            <div class="col-3">
                <select id="selMoneda" class="form-control">
                    <option value="Peso">Peso</option>
                    <option value="Dolar">Dolar</option>
                </select>
            </div>
        </div>
    </div>
    <!--Ventana modal para agregar un nuevo origen de lote-->
    <div class="modal fade" id="modalAgregarOrigenLote" tabindex="-1" role="dialog" aria-labelledby="modalAgregarOrigenLote" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar nuevo origen de lote</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-12">
                            <input type="text" class="form-control" id="tbNuevoOrigenLote"></input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarNuevoOrigenLote()">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $( document ).ready(function() {
        checkSession();
        limpiarCamposNuevoLote();

        $(function() {     
            $("#tbCategoria").autocomplete({
                source: 
                function(request, response) {
                $.getJSON(
                    "php/obtenerCategoriasJSON.php",
                    { term: request.term, idTienda: getIdTienda() }, 
                    response
                );},
                minLength: 2,
                select: function(event, ui) {
                    elegirCategoria(ui.item.id);
                }
            });
        });
        $(function() {     
            $("#tbMarca").autocomplete({
                source: "php/obtenerMarcasJSON.php",
                minLength: 2,
                select: function(event, ui) {
                    elegirMarca(ui.item.id);
                }
            });
        });
        obtenerOrigenesSelect();
        obtenerUltimosLotes();
    });
    $('#modalAgregarOrigenLote').on('shown.bs.modal', function() {
        $('#tbNuevoOrigenLote').focus();
    });
</script>
</html>