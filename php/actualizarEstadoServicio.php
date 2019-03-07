<?php
    try
    {
        require('connection.php');

        $idServicio = $_POST["idServicio"];
        $estado = $_POST["estado"];

        if (!$idServicio) {
            return;
        }

        $prefijo = $_COOKIE["prefijo"];

        $con = new mysqli($hn, $un, $pw, $db);

        $tabla = $prefijo . "servicios";

        $sql = "UPDATE $tabla
                SET estado = '$estado'
                WHERE idservicio = $idServicio";

        $con->query($sql);
        
        echo $sql;
        
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>