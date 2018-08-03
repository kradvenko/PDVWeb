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
    <script src="js/nuevaventa.js"></script>
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
            <div class="col-2">
                <label class="labelType01">Incluir I.V.A.</label>
            </div>
            <div class="col-1">
                <label class="switch"><input id="cbIva" type="checkbox" onclick="calcularTotal()"><span class="slider round"></span></label>
            </div>
            <div class="col-1">
                <label class="labelType01">Cliente</label>
            </div>
            <div class="col-5">
                <input type="text" id="tbVentaCliente" class="form-control" ></input>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary btn-success" data-toggle='modal' data-target='#modalAgregarCliente'>Dar de alta cliente</button>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                
            </div>
            <div class="col-1">
                
            </div>
            <div class="col-3">
            
            </div>
            <div class="col-3">

            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary btn-success" onclick="realizarVenta()">Realizar venta</button>
            </div>
        </div>
        <div class="row divMargin" id="divVenta">

        </div>
    </div>
    <!--Ventana modal para ver los precios de mayoreo-->
    <div class="modal fade" id="modalVerPreciosMayoreo" tabindex="-1" role="dialog" aria-labelledby="modalVerPreciosMayoreo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ver precios mayoreo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-12" id="divPreciosMayoreo">
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                        
                </div>
            </div>
        </div>
    </div>
    <!--Ventana modal para agregar cliente-->
    <div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="modalAgregarCliente" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            Nombre del cliente
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbNuevoClienteNombre" class="form-control"></input>
                        </div>
                        <div class="col-12">
                            Dirección
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbNuevoClienteDireccion" class="form-control"></input>
                        </div>
                        <div class="col-12">
                            Colonia
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbNuevoClienteColonia" class="form-control"></input>
                        </div>
                        <div class="col-6">
                            Teléfono 1
                        </div>
                        <div class="col-6">
                            Whatsapp
                        </div>
                        <div class="col-6">
                            <input type="text" id="tbNuevoClienteTelefono1" class="form-control"></input>
                        </div>
                        <div class="col-6">
                            <input type="text" id="tbNuevoClienteTelefono2" class="form-control"></input>
                        </div>
                        <div class="col-12">
                            Correo electrónico
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbNuevoClienteCorreo" class="form-control"></input>
                        </div>
                        <div class="col-12">
                            Tienda
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbNuevoClienteTienda" class="form-control"></input>
                        </div>
                        <div class="col-12">
                            Tipo
                        </div>
                        <div class="col-12">
                            <select id="selNuevoClienteTipo" class="form-control">
                                <option value="NORMAL">NORMAL</option>
                                <option value="DISTRIBUIDOR">DISTRIBUIDOR</option>
                            </select>
                        </div>
                        <div class="col-12">
                            Notas
                        </div>
                        <div class="col-12">
                            <textarea id="taNuevoClienteNotas" rows="3" maxlength="200" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="guardarCliente()">Guardar</button>                        
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                        
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $( document ).ready(function() {
        checkSession();
        limpiarCamposNuevaVenta();
        $(function() {     
            $("#tbArticulo").autocomplete({
                source: "php/obtenerArticulosJSON.php",
                minLength: 2,
                select: function(event, ui) {
                    agregarArticuloVenta(ui.item.id, ui.item.value, ui.item.precio, ui.item.preciodistribuidor);
                    this.value = '';
                    return false;
                }
            });
        });
        $(function() {     
            $("#tbVentaCliente").autocomplete({
                source: "php/obtenerClientesJSON.php",
                minLength: 2,
                select: function(event, ui) {
                    elegirCliente(ui.item.id);
                }
            });
        });
    });
    $('#modalAgregarCliente').on('shown.bs.modal', function() {
        $('#tbNuevoClienteNombre').focus();
    });
</script>
</html>