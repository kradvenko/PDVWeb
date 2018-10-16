<?php
    try
    {
        require_once('connection.php');

        $fecha = $_POST["fecha"];
        $subtotal = $_POST["subtotal"];
        $descuentoPorcentaje = $_POST["descuentoPorcentaje"];
        $descuentoCantidad = $_POST["descuentoCantidad"];
        $total = $_POST["total"];
        $estado = "ACTIVO";
        $iva = $_POST["iva"];
        $articulos = (isset($_POST["articulos"]) ? $_POST["articulos"] : []);
        $idCliente = $_POST["idCliente"];

        $prefijo = $_COOKIE["prefijo"];
        $tipoTienda = $_COOKIE["tipotienda"];
        $idTienda = $_COOKIE["idtienda"];

        if (!$prefijo) {
            return;
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "INSERT INTO " . $prefijo . "ventas
                (fecha, subtotal, descuentoporcentaje, descuentocantidad, total, estado, iva, idcliente)
                VALUES
                ('$fecha', $subtotal, $descuentoPorcentaje, $descuentoCantidad, $total, '$estado', $iva, $idCliente)";
        
        $con->query($sql);

        $idVenta = $con->insert_id;

        for ($i = 0; $i < sizeof($articulos); $i++) {
            $item = $articulos[$i];
            $sql = "INSERT INTO " . $prefijo . "detalleventa
                    (idventa, idarticulo, cantidad, descuentoporcentaje, descuentocantidad, preciomenudeo, preciomayoreo, tipoprecio, subtotal, total)
                    VALUES 
                    (" . $idVenta . ", " . $item["id"] . ", " . $item["cantidad"] . ", " . $item["descuentoporcentaje"] . ", " . $item["descuentocantidad"] . ",
                    " . $item["precio"] . ", " . $item["preciodistribuidor"] . " , '" . ($item["usarMayoreo"] == "true" ? "mayoreo" : "menudeo") . "',
                    " . $item["subtotal"] . ", " . $item["total"] . ")";

            $con->query($sql);
        }

        for ($i = 0; $i < sizeof($articulos); $i++) {
            $item = $articulos[$i];
            $sql = "UPDATE " . $prefijo . "articulos
                    SET cantidad = cantidad - " . $item["cantidad"] . "
                    WHERE idarticulo = " . $item["id"];

            $con->query($sql);
        }

        //echo "OK";
        echo $idVenta;

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>