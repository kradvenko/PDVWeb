<?php
    try
    {
        require_once('connection.php');

        $idServicio = $_POST["idServicio"];
        $entrada = $_POST["entrada"];
        $prioridad = $_POST["prioridad"];
        $fecha = $_POST["fecha"];

        $idUsuario = $_COOKIE["idusuario"];
        $prefijo = $_COOKIE["prefijo"];

        $tablaBitacora = $prefijo . "bitacora";

        if (!$idServicio) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into $tablaBitacora (idusuario, idservicio, entrada, fecha, prioridad) Values ($idUsuario, $idServicio, '$entrada', '$fecha', '$prioridad')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>