<?php
    try
    {
        require_once('connection.php');

        $origen = $_POST["origen"];

        if (!$origen) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into origeneslote (origen) Values ('$origen')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>