<?php
    try
    {
        require_once('connection.php');

        $idTelefono = $_POST["idTelefono"];
        $telefono = $_POST["telefono"];
        $extension = $_POST["extension"];
        $notasTelefono = $_POST["notasTelefono"];

        if (!$idTelefono || !$telefono) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Update instituciontelefonos Set telefono = '" . $telefono . "', extension = '" . $extension . "', notas = '" . $notasTelefono . "' Where idinstituciontelefono = " . $idTelefono;

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>