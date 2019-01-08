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
    <script src="js/nuevoservicio.js"></script>
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
                Nuevo Servicio
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-1">
                <label class="labelType01">Cliente</label>
            </div>
            <div class="col-5">
                <input type="text" id="tbServicioCliente" class="form-control" ></input>
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
            <div class="col-5">
            
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary btn-success" onclick="agregarServicio()">Guardar servicio</button>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary btn-success" onclick="limpiarCamposNuevoServicio()">Limpiar campos</button>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-8">
                <div class="row">
                    <div class="col-2">
                        <label class="labelType01">ESN-Imei</label>                
                    </div>
                    <div class="col-4 divMargin">
                        <input type="text" id="tbESN" class="form-control"></input>
                    </div>
                    <div class="col-2">
                        <label class="labelType01">Folio</label>                
                    </div>
                    <div class="col-4">
                        <input type="text" id="tbFolio" class="form-control"></input>
                    </div>                
                    <div class="col-2">
                        <label class="labelType01">Marca</label>                
                    </div>
                    <div class="col-3 divMargin">
                        <input type="text" id="tbMarca" class="form-control"></input>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-success" data-toggle='modal' data-target='#modalAgregarMarca'>
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="col-2">
                        <label class="labelType01">Modelo</label>                
                    </div>
                    <div class="col-4">
                        <input type="text" id="tbModelo" class="form-control"></input>
                    </div>
                    <div class="col-2">
                        <label class="labelType01">Accesorios</label>                
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="cbBateria"> Batería
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="cbTapa"> Tapa
                    </div>
                    <div class="col-2">
                        <label class="labelType01">Otro</label>                
                    </div>
                    <div class="col-4 divMargin">
                        <input type="text" id="tbOtro" class="form-control"></input>
                    </div>
                    <div class="col-2">
                        <label class="labelType01">Falla</label>                
                    </div>
                    <div class="col-4 divMargin">
                        <textarea id="taFalla" class="form-control"></textarea>
                    </div>
                    <div class="col-2">
                        <label class="labelType01">Observaciones</label>                
                    </div>
                    <div class="col-4">
                        <textarea id="taObservaciones" class="form-control"></textarea>
                    </div>
                    <div class="col-2">
                        <label class="labelType01">F. Entrega</label>                
                    </div>
                    <div class="col-4 divMargin">
                        <input type="text" id="tbFechaEntregaEstimada" class="form-control"></input>
                    </div>
                    <div class="col-2">
                        <label class="labelType01">Contraseña</label>                
                    </div>
                    <div class="col-4">
                        <input type="text" id="tbContraseña" class="form-control"></input>
                    </div>
                    <div class="col-2">
                        <label class="labelType01">Costo</label>                
                    </div>
                    <div class="col-4">
                        <input type="text" id="tbCosto" class="form-control"></input>
                    </div>
                    <div class="col-2">
                        <label class="labelType01">Anticipo</label>                
                    </div>
                    <div class="col-4">
                        <input type="text" id="tbAnticipo" class="form-control"></input>
                    </div>
                </div>
            </div>
            <div class="col-4 divPatron">
                <div class="row">
                    <div class="col-12 divPatronHeader">
                        <label class="labelType01">Patrón</label>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron1" onclick="marcar(1)"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron2" onclick="marcar(2)"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron3" onclick="marcar(3)"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron4" onclick="marcar(4)"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron5" onclick="marcar(5)"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron6" onclick="marcar(6)"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron7" onclick="marcar(7)"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron8" onclick="marcar(8)"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron9" onclick="marcar(9)"></input>
                    </div>
                    <div class="col-12 divPatronButton">
                        <input type="button" class="form-control" value="Limpiar" onclick="limpiarPatron()"></input>
                    </div>
                </div>
            </div>
        </div>
        <div class="row divMargin" id="divVenta">

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
                            <input type="text" class="form-control" id="tbNuevaMarca" />
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
        limpiarCamposNuevoServicio();
        obtenerFolioActual();
        $(function() {     
            $("#tbServicioCliente").autocomplete({
                source: "php/obtenerClientesJSON.php",
                minLength: 2,
                select: function(event, ui) {
                    elegirCliente(ui.item.id);
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
    });
    $('#modalAgregarCliente').on('shown.bs.modal', function() {
        $('#tbNuevoClienteNombre').focus();
    });
    $('#modalAgregarMarca').on('shown.bs.modal', function() {
        $('#tbNuevaMarca').focus();
    });
</script>
</html>