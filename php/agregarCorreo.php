<?php
    try
    {
        require_once('connection.php');

        $idInstitucion = $_POST["idInstitucion"];
        $correo = $_POST["correo"];
        $notasCorreo = $_POST["notasCorreo"];

        if (!$idInstitucion || !$correo) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into institucioncorreos (idinstitucion, correo, notas) Values (" . $idInstitucion . ", '" . $correo . "', '" . $notasCorreo . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>