<!DOCTYPE html>

<html>
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/pdv.css" />
    <link rel="icon" href="favicon.ico">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/pdv.js"></script>
    <script src="js/corte.js"></script>
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

        <div class="row divMargin divBackgroundOrange divCenter">
            <div class="col-12">
                Corte por fecha
            </div>
        </div>
        <div class="row divMargin divCenter">            
            <div class="col-2">
                Fecha de corte
            </div>
            <div class="col-2">
                Día
            </div>
            <div class="col-2">
                Mes
            </div>
            <div class="col-2">
                Año
            </div>
            <div class="col-4">
                
            </div>
            <div class="col-2">
                
            </div>
            <div class="col-2">
                <select id="selDia" class="form-control">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
            </div>
            <div class="col-2">
                <select id="selMes" class="form-control">
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            <div class="col-2">
                <input type="text" id="tbAño" class="form-control" />
            </div>
            <div class="col-4">
                <input type="button" class="btn btn-success" value="Generar corte" onclick="generarCorte()" />
            </div>
        </div>
        <div class="row divMargin">
            <div class="col-2">
                Total en efectivo
            </div>
            <div class="col-1" id="divTotalEfectivo">
                $ 0
            </div>
            <div class="col-2">
                <!--Total tarjeta-->
            </div>
            <div class="col-1" id="divTotalTarjeta">
               <!-- $ 0-->
            </div>
        </div>
        <div class="row divMargin divBackgroundVentas divCenter">
            <div class="col-12">
                Ventas
            </div>
        </div>
        <div class="row divMargin" id="divCorteVentas">
            
        </div>
        <div class="row divMargin divBackgroundServicios divCenter">
            <div class="col-12">
                Servicios
            </div>
        </div>
        <div class="row divMargin" id="divCorteServicios">
            
        </div>
    </div>
</body>
<script>
    $( document ).ready(function() {
        checkSession();
        limpiarCamposCorte();
    });    
</script>
</html>