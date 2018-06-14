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
    <script src="js/nuevoarticulo.js"></script>
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
                Nuevo artículo
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
                <button class="btn btn-success" onclick="agregarArticulo()">Guardar</button>
            </div>
            <div class="col-2">
                <button class="btn btn-success" onclick="limpiarCamposNuevoArticulo()">Limpiar campos</button>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-12">
                <label class="labelType01">Últimos artículos agregados (haga click para seleccionar)</label>
            </div>
            <div class="col-12" id="divUltimosArticulos">

            </div>
        </div>
        <div class="row divMargin divBackgroundOrange2">
            <div class="col-12">
                Datos del artículo
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Categoría</label>
            </div>
            <div class="col-3">
                <input type="text" class="form-control textbox-center" id="tbCategoria"></input>
            </div>
            <div class="col-1">
                <button class="btn btn-success" data-toggle='modal' data-target='#modalAgregarCategoria'>
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="col-2">
                <label class="labelType01">Código</label>
            </div>
            <div class="col-4">
                <input type="text" class="form-control textbox-center" id="tbCodigo" maxlength="60"></input>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Nombre</label>
            </div>
            <div class="col-4">
                <input type="text" class="form-control textbox-center" id="tbNombre" maxlength="45"></input>
            </div>
            <div class="col-2">
                <label class="labelType01">Descripción</label>
            </div>
            <div class="col-4">
                <textarea rows="3" class="form-control" id="taDescripcion" maxlength="100"></textarea>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Modelo</label>
            </div>
            <div class="col-4">
                <input type="text" class="form-control textbox-center" id="tbModelo" max="45"></input>
            </div>
            <div class="col-2">
                <label class="labelType01">Marca</label>
            </div>
            <div class="col-3">
                <input type="text" class="form-control textbox-center" id="tbMarca"></input>
            </div>
            <div class="col-1">
                <button class="btn btn-success" data-toggle='modal' data-target='#modalAgregarMarca'>
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Color</label>
            </div>
            <div class="col-4">
                <input type="text" class="form-control textbox-center" id="tbColor" maxlength="45"></input>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Cantidad</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCantidad" maxlength="5"></input>
            </div>
            <div class="col-2">
                <label class="labelType01">Cantidad Mínima</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCantidadMinima" maxlength="5"></input>
            </div>
            <div class="col-4" id="divArticuloDeMatriz" class="divOrangeText3">
                
            </div>
        </div>
        <!--
        <div class="row divMargin divBackgroundOrange2">
            <div class="col-12">
                Matriz y sucursales
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                
            </div>
        </div>
        -->
        <div class="row divMargin divBackgroundOrange2">
            <div class="col-12">
                Precios
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Precio distribuidor</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbPrecioDistribuidor" maxlength="5"></input>
            </div>
            <div class="col-2">
                <label class="labelType01">Precio público menudeo</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoPublicoMenudeo" maxlength="5"></input>
            </div> 
        </div>
        <div class="row divMargin divBackgroundOrange2">
            <div class="col-12">
                Costos
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Costo distribuidor</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoDistribuidor" maxlength="5"></input>
            </div>
            <div class="col-2">
                <label class="labelType01">Costo real</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoReal" maxlength="5"></input>
            </div>
            <!--            
            <div class="col-2">
                <label class="labelType01">Costo público menudeo</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoPublicoMenudeo" maxlength="5"></input>
            </div> 
        -->
        </div>
        <div class="row divMargin" id="divCostosMayoreo">
            <div class="col-2">
                <label class="labelType01">Costos público mayoreo</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoPublicoMayoreoDe" maxlength="5" placeholder="De"></input>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoPublicoMayoreoA" maxlength="5" placeholder="A"></input>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoPublicoMayoreoCosto" maxlength="5" placeholder="Costo"></input>
            </div>
            <div class="col-2">
                <button class="btn btn-success" onclick="agregarPrecioMayoreo()">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-12" id="divPreciosMayoreo">

            </div>
        </div>
    </div>
    <!--Ventana modal para agregar un nueva categoría-->
    <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="modalAgregarCategoria" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar nueva categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-12">
                            <input type="text" class="form-control" id="tbNuevaCategoria"></input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarNuevaCategoria()">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
    <!--Ventana modal para agregar un nueva marca-->
    <div class="modal fade" id="modalAgregarMarca" tabindex="-1" role="dialog" aria-labelledby="modalAgregarMarca" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar nueva marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-12">
                            <input type="text" class="form-control" id="tbNuevaMarca"></input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarNuevaMarca()">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $( document ).ready(function() {
        checkSession();
        limpiarCamposNuevoArticulo();

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
        verificarCamposMatriz();
        obtenerUltimosArticulos();
    });
    $('#modalAgregarCategoria').on('shown.bs.modal', function() {
        $('#tbNuevaCategoria').focus();
    });
    $('#modalAgregarMarca').on('shown.bs.modal', function() {
        $('#tbNuevaMarca').focus();
    });
</script>
</html>