<?php
    try
    {
        require_once('connection.php');

        $idCorreo = $_POST["idCorreo"];
        $correo = $_POST["correo"];
        $notasCorreo = $_POST["notasCorreo"];

        if (!$idCorreo || !$correo) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Update institucioncorreos Set correo = '" . $correo . "', notas = '" . $notasCorreo . "' Where idinstitucioncorreo = " . $idCorreo;

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>