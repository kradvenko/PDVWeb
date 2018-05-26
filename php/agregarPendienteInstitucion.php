<?php
    try
    {
        require_once('connection.php');

        $idInstitucion = $_POST["idInstitucion"];
        $pendiente = $_POST["pendiente"];
        $estado = $_POST["estado"];
        $resolucion = $_POST["resolucion"];
        $fechaInicio = $_POST["fechaInicio"];

        if (!$idInstitucion || !$pendiente) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into institucionpendientes (idinstitucion, pendiente, estado, fechaInicio, fechaFin, resolucion) Values (" . $idInstitucion . ", '" . $pendiente . "', '" . $estado . "', '" . $fechaInicio . "', '', '" . $resolucion . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>