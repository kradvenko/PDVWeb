<?php
    try
    {
        require_once('connection.php');

        $soporteRigido = $_POST["soporteRigido"];

        if (!$soporteRigido) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into soportesRigidos (soporterigido) Values ('" . $soporteRigido . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>