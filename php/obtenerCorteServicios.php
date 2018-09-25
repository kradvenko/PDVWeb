<?php
    try
    {
        require_once('connection.php');

        $fecha = $_POST["fecha"];

        $prefijo = $_COOKIE["prefijo"];
        $tablaServicios = $prefijo . "servicios";

        $con = new mysqli($hn, $un, $pw, $db);

        $totalEfectivo = 0;

        $sql = "Select $tablaServicios.*, clientes.nombre As nombre
                From $tablaServicios
                Inner Join clientes
                On $tablaServicios.idcliente = clientes.idcliente
                Where fechaingresado Like '$fecha'";

        $result = $con->query($sql);

        echo "<div class='col-1 divHeaderListaServicios'>";
        echo "Servicio";
        echo "</div>";
        echo "<div class='col-1 divHeaderListaServicios'>";
        echo "Cliente";
        echo "</div>";
        echo "<div class='col-3 divHeaderListaServicios'>";
        echo "Fecha";
        echo "</div>";
        echo "<div class='col-3 divHeaderListaServicios'>";
        echo "Equipo";
        echo "</div>";
        echo "<div class='col-1 divHeaderListaServicios'>";
        echo "Anticipo";
        echo "</div>";
        echo "<div class='col-1 divHeaderListaServicios'>";
        //echo "Total";
        echo "</div>";
        echo "<div class='col-2 divHeaderListaServicios'>";
        //echo "Tipo";
        echo "</div>";

        while ($row = $result->fetch_array()) {
            echo "<div class='col-1'>";
            echo $row["idservicio"];
            echo "</div>";
            echo "<div class='col-3'>";
            echo $row["nombre"];
            echo "</div>";
            echo "<div class='col-3'>";
            echo $row["fechaingresado"];
            echo "</div>";
            echo "<div class='col-1'>";
            echo $row["modelo"];
            echo "</div>";
            echo "<div class='col-1'>";
            echo "$ " . $row["anticipo"];
            echo "</div>";
            echo "<div class='col-2'>";
            //echo $row["tipo"];
            echo "</div>";
            echo "<div class='col-1'>";
            echo "</div>";

            echo "<div class='col-12 divMargin'>";
            echo "</div>";
            /*
            if ($row["tipo"] == "EFECTIVO") {
                $totalEfectivo = $totalEfectivo + $row["total"];
            } else if ($row["tipo"] == "TARJETA") {
                $totalTarjeta = $totalTarjeta + $row["total"];
            }
            */
            $totalEfectivo = $totalEfectivo + $row["anticipo"];
        }
        $totalVentas = $totalEfectivo;
        echo "<div class='col-12 divHeaderListaServicios'>";
        echo "</div>";
        echo "<div class='col-3 divTotales'>";
        echo "Total en anticipos de servicios";
        echo "</div>";
        echo "<div class='col-1'";
        echo "<label id='lblServicioEfectivo'>";
        echo $totalEfectivo;
        echo "</label>";
        echo "</div>";
        echo "<div class='col-3 divTotales'>";
        //echo "Total de ventas tarjeta";
        echo "</div>";
        echo "<div class='col-1'";
        echo "<label id='lblServicioTarjeta'>";
        //echo $totalTarjeta;
        echo "</label>";
        echo "</div>";
        echo "<div class='col-3 divTotales'>";
        //echo "Total de ventas";
        echo "</div>";
        echo "<div class='col-1'";
        echo "<label id='lblServicioTarjeta'>";
        //echo $totalVentas;
        echo "</label>";
        echo "</div>";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>