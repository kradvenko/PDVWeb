<?php
    try
    {
        require_once('connection.php');

        $marca = $_POST["marca"];

        if (!$marca) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into marcas (marca, estado) Values ('" . $marca. "', 'ACTIVO')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>