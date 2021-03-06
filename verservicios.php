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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="icon" href="favicon.ico">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/pdv.js"></script>
    <script src="js/verservicios.js"></script>
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
                Ver Servicio
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-4">
                <label class="labelType01">Buscar servicio (Nombre del cliente o Folio)</label>
            </div>
            <div class="col-6">
                <input type="text" id="tbBuscarServicio" class="form-control"></input>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary btn-success" onclick="limpiarCamposServicio()">Limpiar campos</button>
            </div>
        </div>
        <div class="row divMargin divBackgroundOrange">
            <div class="col-12">
                Datos del servicio
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
                <button type="button" class="btn btn-primary btn-success" data-toggle='modal' data-target='#modalVerCliente' onclick="cargarDatosCliente()">Ver datos del cliente</button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary btn-success" onclick="reimprimir()">Reimprimir</button>
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
                    <div class="col-4 divMargin">
                        <input type="text" id="tbMarca" class="form-control"></input>
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
                        <input type="text" id="tbFechaEntrega" class="form-control"></input>
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
                        <input type="button" class="form-control" id="btnPatron1"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron2"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron3"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron4"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron5"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron6"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron7"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron8"></input>
                    </div>
                    <div class="col-4 divPatronButton">
                        <input type="button" class="form-control" id="btnPatron9"></input>
                    </div>
                </div>
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                <button type="button" class="btn btn-outline-primary" data-toggle='modal' data-target='#modalVerBitacora' onclick="verBitacora()">
                    <i class="fas fa-book-open"></i> Bitácora
                </button>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-outline-primary" data-toggle='modal' data-target='#modalVerRefacciones' onclick="cargarRefacciones()">
                    <i class="fas fa-sim-card"></i> Refacciones
                </button>
            </div>
            <div class="col-2">
                <select id="selEstado" class="form-control btn-outline-success" onchange="actualizarEstadoServicio()">
                    <option value="ACTIVO">ACTIVO</option>
                    <option value="EN ESPERA">EN ESPERA</option>
                    <option value="FINALIZADO">SERVICIO FINALIZADO</option>
                    <option value="ENTREGADO">ENTREGADO</option>
                </select>
                <!--<button type="button" class="btn btn-outline-primary btn-outline-success" onclick="servicioListo()">
                    <i class="fas fa-check"></i> Servicio listo
                </button>-->
            </div>
        </div>
        <div class="row divMargin" id="divVenta">

        </div>
    </div>
    <!--Ventana modal para ver datos del cliente-->
    <div class="modal fade" id="modalVerCliente" tabindex="-1" role="dialog" aria-labelledby="modalVerCliente" aria-hidden="true">
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
                            <input type="text" id="tbClienteNombre" class="form-control"></input>
                        </div>
                        <div class="col-12">
                            Dirección
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbClienteDireccion" class="form-control"></input>
                        </div>
                        <div class="col-12">
                            Colonia
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbClienteColonia" class="form-control"></input>
                        </div>
                        <div class="col-6">
                            Teléfono 1
                        </div>
                        <div class="col-6">
                            Whatsapp
                        </div>
                        <div class="col-6">
                            <input type="text" id="tbClienteTelefono1" class="form-control"></input>
                        </div>
                        <div class="col-6">
                            <input type="text" id="tbClienteTelefono2" class="form-control"></input>
                        </div>
                        <div class="col-12">
                            Correo electrónico
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbClienteCorreo" class="form-control"></input>
                        </div>
                        <div class="col-12">
                            Tienda
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbClienteTienda" class="form-control"></input>
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
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-success" onclick="guardarCliente()">Guardar</button>-->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Ventana modal para ver la bitácora-->
    <div class="modal fade" id="modalVerBitacora" tabindex="-1" role="dialog" aria-labelledby="modalVerBitacora" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bitácora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            Nueva entrada
                        </div>
                        <div class="col-12">
                            <input type="text" id="tbNuevaEntrada" class="form-control" />
                        </div>
                        <div class="col-12">
                            Prioridad
                        </div>
                        <div class="col-12">
                            <select id="selPrioridad" class="form-control">
                                <option value="Normal">Normal</option>
                                <option value="Alta">Alta</option>
                            </select>
                        </div>
                        <div class="col-8">
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-success" onclick="guardarEntrada()">Guardar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="background-color: #000; color: #FFF;">
                            Lista de Entradas
                        </div>
                    </div>
                    <div class="row" id="divBitacoraEntradas">
                        
                    </div>                    
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-success" onclick="guardarCliente()">Guardar</button>-->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Ventana modal para ver las refacciones-->
    <div class="modal fade" id="modalVerRefacciones" tabindex="-1" role="dialog" aria-labelledby="modalVerRefacciones" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Refacciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 divMargin">
                            Agregar nueva refacción
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control textbox-center" id="tbArticulo"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="background-color: #000; color: #FFF;">
                            Lista de Refacciones utilizadas
                        </div>
                    </div>
                    <div class="row" id="divRefaccionesServicio">
                        
                    </div>                    
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-success" onclick="guardarCliente()">Guardar</button>-->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $( document ).ready(function() {
        checkSession();
        limpiarCamposServicio();
        $(function() {     
            $("#tbBuscarServicio").autocomplete({
                source: "php/obtenerServiciosJSON.php",
                minLength: 2,
                select: function(event, ui) {
                    elegirServicio(ui.item.id);
                }
            });
        });
        $(function() {     
            $("#tbArticulo").autocomplete({
                source: "php/obtenerArticulosJSON.php",
                minLength: 2,
                select: function(event, ui) {
                    agregarRefaccion(ui.item.id, ui.item.precio);
                    this.value = '';
                    return false;
                }
            });
        });
    });
    $('#modalAgregarCliente').on('shown.bs.modal', function() {
        $('#tbClienteNombre').focus();
    });
</script>
</html>