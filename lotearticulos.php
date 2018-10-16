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
    <script src="js/lotearticulos.js"></script>
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
                Control de lotes y artículos
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
                Datos del lote
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
                <label class="labelType01">Fecha pago</label>
            </div>
            <div class="col-3">
                <input type="text" class="form-control textbox-center" id="tbFechaPago" maxlength="10"></input>
            </div>
            <div class="col-1">
                <label class="switch"><input id="cbPagado" type="checkbox" onclick="ponerFechaPagado()"><span class="slider round"></span></label></input>
            </div>
            <div class="col-2">
                <label class="labelType01">Fecha recibido</label>
            </div>
            <div class="col-3">
                <input type="text" class="form-control textbox-center" id="tbFechaRecibido" maxlength="10"></input>
            </div>
            <div class="col-1">
                <label class="switch"><input id="cbRecibido" type="checkbox" onclick="ponerFechaRecibido()"><span class="slider round"></span></label></input>
            </div>
        </div>
        <div class="row divMargin divBackgroundOrange2">
            <div class="col-12">
                Costos del lote
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-1">
                <label class="labelType01">Costo de lote</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoLote" maxlength="10" value="0"></input>
            </div>
            <div class="col-2">
                <label class="labelType01">Tipo cambio</label>
            </div>
            <div class="col-1">
                <input type="text" class="form-control textbox-center" id="tbTipoCambioLote" maxlength="10" value="0"></input>
            </div>
            <div class="col-1">
                <label class="labelType01">Moneda</label>
            </div>
            <div class="col-2">
                <select id="selMoneda" class="form-control">
                    <option value="Peso">Peso</option>
                    <option value="Dolar">Dolar</option>
                </select>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-1">
                <label class="labelType01">Costo de envío</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoEnvio" maxlength="10" value="0"></input>
            </div>
            <div class="col-2">
                <label class="labelType01">Tipo cambio</label>
            </div>
            <div class="col-1">
                <input type="text" class="form-control textbox-center" id="tbTipoCambioEnvio" maxlength="10" value="0"></input>
            </div>
            <div class="col-1">
                <label class="labelType01">Moneda</label>
            </div>
            <div class="col-2">
                <select id="selMonedaEnvio" class="form-control">
                    <option value="Peso">Peso</option>
                    <option value="Dolar">Dolar</option>
                </select>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-12">
                <label class="labelType01">Costos Extras</label>
            </div>
            <div class="col-2">
                <label class="labelType01">Motivo del costo</label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control textbox-center" id="tbCostoExtraMotivo" maxlength="100" value=""></input>
            </div>            
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <label class="labelType01">Monto</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control textbox-center" id="tbCostoExtra" maxlength="10" value="0"></input>
            </div>
            <div class="col-2">
                <label class="labelType01">Tipo cambio</label>
            </div>
            <div class="col-1">
                <input type="text" class="form-control textbox-center" id="tbCostoExtraTipoCambio" maxlength="10" value="0"></input>
            </div>
            <div class="col-1">
                <label class="labelType01">Moneda</label>
            </div>
            <div class="col-2">
                <select id="selCostoExtraMoneda" class="form-control">
                    <option value="Peso">Peso</option>
                    <option value="Dolar">Dolar</option>
                </select>
            </div>
            <div class="col-1">
                <button class="btn btn-success" onclick="agregarCostoExtra()">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-12" id="divCostosExtra">

            </div>
        </div>
        <div class="row divMargin divBackgroundOrange2">
            <div class="col-12">
                Artículos del lote
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
                
            </div>
            <div class="col-2" id="divAgregarArticuloLote">
                <button class="btn btn-success" data-toggle='modal' data-target='#modalAgregarArticuloLote'>
                    Agregar artículo
                </button>
            </div>
        </div>
        <div class="row divMargin" id="divArticulosLote">

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
    <!--Ventana modal para agregar un nuevo artículo al lote-->
    <div class="modal fade" id="modalAgregarArticuloLote" tabindex="-1" role="dialog" aria-labelledby="modalAgregarArticuloLote" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar artículo al lote</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row divMargin divBackgroundOrange">
                        <div class="col-12">
                            Nuevo artículo
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
                            <input type="text" class="form-control textbox-center" id="tbPrecioDistribuidor" maxlength="10"></input>
                        </div>
                        <div class="col-2">
                            <label class="labelType01">Precio público menudeo</label>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control textbox-center" id="tbCostoPublicoMenudeo" maxlength="10"></input>
                        </div> 
                    </div>
                    <div class="row divMargin divBackgroundOrange2">
                        <div class="col-12">
                            Costos
                        </div>
                    </div>
                    <div class="row divMargin">
                        <div class="col-2">
                            <label class="labelType01">Costo proveedor</label>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control textbox-center" id="tbCostoDistribuidor" maxlength="10"></input>
                        </div>
                        <div class="col-2">
                            <label class="labelType01">Costo real</label>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control textbox-center" id="tbCostoReal" maxlength="10"></input>
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
                    <div class="row divMargin divBackgroundOrange2">
                        <div class="col-12">
                            Costos
                        </div>
                    </div>
                    <div class="row divMargin">
                        <div class="col-2">
                            <label class="labelType01">Recibido</label>
                        </div>
                        <div class="col-1">
                            <label class="switch"><input id="cbAprobado" type="checkbox" onclick=""><span class="slider round"></span></label></input>
                        </div>
                        <div class="col-2">
                            <label class="labelType01">Notas</label>
                        </div>
                        <div>
                            <textarea class="form-control" id="taArticuloNotas"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiarCamposNuevoArticulo()">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarNuevoArticuloLote()">Guardar cambios</button>
                </div>
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
        limpiarCamposNuevoLote();
        $("#divAgregarArticuloLote").hide();

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
        mostrarCostosExtraLote();
    });
    $('#modalAgregarOrigenLote').on('shown.bs.modal', function() {
        $('#tbNuevoOrigenLote').focus();
    });
    $('#modalAgregarCategoria').on('shown.bs.modal', function() {
        $('#tbNuevaCategoria').focus();
    });
    $('#modalAgregarMarca').on('shown.bs.modal', function() {
        $('#tbNuevaMarca').focus();
    });
</script>
</html>