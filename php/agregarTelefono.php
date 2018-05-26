<?php
    try
    {
        require_once('connection.php');

        $idInstitucion = $_POST["idInstitucion"];
        $telefono = $_POST["telefono"];
        $extension = $_POST["extension"];
        $notasTelefono = $_POST["notasTelefono"];

        if (!$idInstitucion || !$telefono) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into instituciontelefonos (idinstitucion, telefono, extension, notas) Values (" . $idInstitucion . ", '" . $telefono . "', '" . $extension . "', '" . $notasTelefono . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>