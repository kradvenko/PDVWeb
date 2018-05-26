<?php
    try
    {
        require_once('connection.php');

        $idSelect = $_POST["idSelect"];
        $idPais = $_POST["idPais"];

        if (!$idSelect || !$idPais) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select regiones.*, tiposregiones.tiporegion, paises.pais " . 
                "From regiones Inner Join tiposregiones " .
                "On tiposregiones.idtiporegion = regiones.idtiporegion " .
                "Inner Join paises " .
                "On paises.idpais = regiones.idpais ".
                "Where regiones.idpais = " . $idPais;

        $result = $con->query($sql);

        echo "<select class='form-control' id='" . $idSelect . "'>";

        while ($row = $result->fetch_array()) {
            echo "<option value='" . $row["idregion"] . "'>" . $row["region"] . "</option>";
        }
        
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>