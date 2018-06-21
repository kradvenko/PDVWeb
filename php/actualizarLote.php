<?php
    try
    {
        require_once('connection.php');

        $idLote = $_POST["idLote"];
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

        if (!$idOrigen) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Update lotes 
                Set idorigen = $idOrigen, fechalote = '$fechaLote', tipocambio = '$tipoCambio',
                estado = '$estado', costolote = '$costoLote', moneda = '$moneda', fechapago = '$fechaPago',
                fecharecibido = '$fechaRecibido', pagado = '$pagado', recibido = '$recibido'
                Where idlote = $idLote";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>