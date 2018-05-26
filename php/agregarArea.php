<?php
    try
    {
        require_once('connection.php');

        $idInstitucion = $_POST["idInstitucion"];
        $area = $_POST["area"];
        $notasArea = $_POST["notasArea"];

        if (!$idInstitucion || !$area) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into institucionareas (idinstitucion, area, notas) Values (" . $idInstitucion . ", '" . $area . "', '" . $notasArea . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>