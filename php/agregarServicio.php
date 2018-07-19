<?php
    try
    {
        require_once('connection.php');

        $idCliente = $_POST["idCliente"];
        $esn = $_POST["esn"];
        $folio = $_POST["folio"];
        $idMarca = $_POST["idMarca"];
        $modelo = $_POST["modelo"];
        $bateria = $_POST["bateria"];
        $tapa = $_POST["tapa"];
        $otro = $_POST["otro"];
        $falla = $_POST["falla"];
        $observaciones = $_POST["observaciones"];
        $fechaEntregaEstimada = $_POST["fechaEntregaEstimada"];
        $contraseña = $_POST["contraseña"];
        $costo = $_POST["costo"];
        $anticipo = $_POST["anticipo"];
        $fechaIngresado = $_POST["fechaIngresado"];
        $estado = $_POST["estado"];
        $notas = $_POST["notas"];
        $patron = (isset($_POST["patron"]) ? $_POST["patron"] : []);

        $prefijo = $_COOKIE["prefijo"];
        $idTienda = $_COOKIE["idtienda"];

        if (!$prefijo) {
            return;
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "INSERT INTO $prefijo" . "servicios
                (idcliente, esn, folio, idmarca, modelo, bateria, tapa, otro, falla, observaciones, fechaentregaestimada, contraseña, costo,
                anticipo, fechaingresado, fechaentregado, estado, notas, patron)
                VALUES
                ($idCliente, '$esn', '$folio', $idMarca, '$modelo', '$bateria', '$tapa', '$otro', '$falla', '$observaciones', '$fechaEntregaEstimada',
                '$contraseña', $costo, $anticipo, '$fechaIngresado', '', '$estado', '$notas', '" . json_encode($patron) . "')
                ";
        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>