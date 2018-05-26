<?php
    try
    {
        require_once('connection.php');

        $genero = $_POST["genero"];

        if (!$genero) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into generosfotografia (genero) Values ('" . $genero . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>