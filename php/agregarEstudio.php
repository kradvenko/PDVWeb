<?php
    try
    {
        require_once('connection.php');

        $estudio = $_POST["estudio"];

        if (!$estudio) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into estudiosfotograficos (estudio) Values ('" . $estudio . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>