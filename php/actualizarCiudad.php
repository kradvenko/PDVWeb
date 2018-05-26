<?php
    try
    {
        require_once('connection.php');

        $idRegion = $_POST["idRegion"];
        $idPais = $_POST["idPais"];
        $idCiudad = $_POST["idCiudad"];
        $ciudad = $_POST["ciudad"];

        if (!$idRegion || !$idPais || !$idCiudad || !$ciudad) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Update ciudades Set idPais = " . $idPais . ", idregion = " . $idRegion . ", ciudad = '" . $ciudad . "' Where idciudad = " . $idCiudad;

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>