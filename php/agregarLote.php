<?php
    try
    {
        require_once('connection.php');

        $idOrigen = $_POST["idOrigen"];
        $fechaLote = $_POST["fechaLote"];
        $tipoCambio = $_POST["tipoCambio"];
        $fechaIngreso = $_POST["fechaIngreso"];
        $estado = $_POST["estado"];
        $costoLote = $_POST["costoLote"];
        $moneda = $_POST["moneda"];
        $fechaPago = $_POST["fechaPago"];
        $fechaRecibido = $_POST["fechaRecibido"];
        $pagado = $_POST["pagado"];
        $recibido = $_POST["recibido"];
        $costoEnvio = $_POST["costoEnvio"];
        $tipoCambioEnvio = $_POST["tipoCambioEnvio"];
        $costosExtra = (isset($_POST["costosExtra"]) ? $_POST["costosExtra"] : []);

        if (!$idOrigen) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into lotes (idorigen, fechalote, tipocambio, fechaingreso, estado, costolote, moneda, fechapago, fecharecibido, pagado, recibido, costoenvio) Values ($idOrigen, '$fechaLote', $tipoCambio, '$fechaIngreso', '$estado', $costoLote, '$moneda', '$fechaPago', '$fechaRecibido', '$pagado', '$recibido', '$costoEnvio')";

        $con->query($sql);

        $idlote = $con->insert_id;

        for ($i = 0; $i < sizeof($costosExtra); $i++) {
            $sql = "INSERT INTO costosextra
                    (idlote, motivo, monto, tipocambio, moneda)
                    VALUES
                    ($idLote, '" . $costosExtra[$i]["motivo"] . "', " . $costosExtra[$i]["monto"] . ", " . $costosExtra[$i]["tipocambio"] . ", '" . $costosExtra[$i]["moneda"] . "')";
            $con->query($sql);
        }

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>