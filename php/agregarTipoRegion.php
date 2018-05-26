<?php
    try
    {
        require_once('connection.php');

        $tipoRegion = $_POST["tipoRegion"];

        if (!$tipoRegion) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into tiposregiones (tiporegion) Values ('" . $tipoRegion . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>