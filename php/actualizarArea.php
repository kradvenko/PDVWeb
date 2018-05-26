<?php
    try
    {
        require_once('connection.php');

        $idArea = $_POST["idArea"];
        $area = $_POST["area"];
        $notasArea = $_POST["notasArea"];

        if (!$idArea || !$area) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Update institucionareas Set area = '" . $area . "', notas = '" . $notasArea . "' Where idinstitucionarea = " . $idArea;

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>