<?php
    try
    {
        require_once('connection.php');

        $soporteFlexible = $_POST["soporteFlexible"];

        if (!$soporteFlexible) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into soportesflexibles (soporte) Values ('" . $soporteFlexible . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>