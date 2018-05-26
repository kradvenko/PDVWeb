<?php
    try
    {
        require_once('connection.php');

        $autor = $_POST["autor"];

        if (!$autor) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into autores (autor) Values ('" . $autor . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>