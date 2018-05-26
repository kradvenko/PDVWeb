<?php
    try
    {
        require_once('connection.php');

        $idPendienteInstitucion = $_POST["idPendienteInstitucion"];
        $pendiente = $_POST["pendiente"];
        $estado = $_POST["estado"];
        $resolucion = $_POST["resolucion"];
        $fechaFin = $_POST["fechaFin"];

        if (!$idPendienteInstitucion || !$pendiente) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        if ($estado == 'ACTIVO') {
            $sql = "Update institucionpendientes Set pendiente = '$pendiente', resolucion = '$resolucion' Where idinstitucionpendiente = $idPendienteInstitucion ";
        } else if ($estado == 'FINALIZADO') {
            $sql = "Update institucionpendientes Set pendiente = '$pendiente', estado = '$estado', fechaFin = '$fechaFin',  resolucion = '$resolucion' Where idinstitucionpendiente = $idPendienteInstitucion ";
        }

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>