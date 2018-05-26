<?php
    try
    {
        require_once('connection.php');

        $tema = $_POST["tema"];

        if (!$tema) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into temas (tema) Values ('" . $tema . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>