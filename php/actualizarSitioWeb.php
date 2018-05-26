<?php
    try
    {
        require_once('connection.php');

        $idSitioWeb = $_POST["idSitioWeb"];
        $sitioWeb = $_POST["sitioWeb"];
        $notasSitioWeb = $_POST["notasSitioWeb"];

        if (!$idSitioWeb || !$sitioWeb) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Update institucionsitiosweb Set sitio = '" . $sitioWeb . "', notas = '" . $notasSitioWeb . "' Where idinstitucionsitioweb = " . $idSitioWeb;

        $con->query($sql);

        echo "OK";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>