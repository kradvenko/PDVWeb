<?php
    try
    {
        require_once('connection.php');

        $nombre = $_POST["nombre"];
        $institucion = $_POST["institucion"];
        $descripcion = $_POST["descripcion"];
        $numeroFotografias = $_POST["numeroFotografias"];

        if (!$nombre) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into albumes (idinstitucion, album, descripcion, numerofotografias) Values (" . $institucion . ", '$nombre', '$descripcion', '$numeroFotografias' )";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>