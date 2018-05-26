<?php
    try
    {
        require_once('connection.php');

        $idInstitucion = $_POST["idInstitucion"];

        if (!$idInstitucion) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select instituciones.*, paises.pais From instituciones ". 
                "Inner Join paises " .
                "On paises.idpais = instituciones.idpais " .
                "Where instituciones.idinstitucion = $idInstitucion";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<nombreInstitucion>" . $row['nombreInstitucion'] . "</nombreInstitucion>\n";
            echo "<sectorInstitucion>" . $row['sectorInstitucion'] . "</sectorInstitucion>\n";
            echo "<tipoInstitucion>" . $row['tipoInstitucion'] . "</tipoInstitucion>\n";
            echo "<sitioWeb>" . $row['sitioWeb'] . "</sitioWeb>\n";
            echo "<correoElectronico>" . $row['correoElectronico'] . "</correoElectronico>\n";
            echo "<telefonos>" . $row['telefonos'] . "</telefonos>\n";
            echo "<extension>" . $row['extension'] . "</extension>\n";
            echo "<domicilio>" . $row['domicilio'] . "</domicilio>\n";
            echo "<colonia>" . $row['colonia'] . "</colonia>\n";
            echo "<codigoPostal>" . $row['codigoPostal'] . "</codigoPostal>\n";
            echo "<idpais>" . $row['idpais'] . "</idpais>\n";
            echo "<idregion>" . $row['idregion'] . "</idregion>\n";
            echo "<idciudad>" . $row['idciudad'] . "</idciudad>\n";
        }

        echo "</resultado>\n";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>