<?php
    try
    {
        require_once('connection.php');

        $idPais = $_POST["idPais"];
        $idTipoRegion = $_POST["idTipoRegion"];
        $region = $_POST["region"];

        if (!$idPais || !$idTipoRegion || !$region) {
            echo "Error. Faltan variables.";
            exit(1);
        }


        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into regiones (idTipoRegion, idPais, region) Values (" . $idTipoRegion . ", " . $idPais . ", '" . $region . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>