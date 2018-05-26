<?php
    try
    {
        require_once('connection.php');

        $idInstitucion = $_POST["idInstitucion"];
        $sitioWeb = $_POST["sitioWeb"];
        $notasSitioWeb = $_POST["notasSitioWeb"];

        if (!$idInstitucion || !$sitioWeb) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Insert Into institucionsitiosweb (idinstitucion, sitio, notas) Values (" . $idInstitucion . ", '" . $sitioWeb . "', '" . $notasSitioWeb . "')";

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>