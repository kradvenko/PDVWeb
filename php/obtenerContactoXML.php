<?php
    try
    {
        require_once('connection.php');

        $idContacto = $_POST["idContacto"];

        if (!$idContacto) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select contactos.* " .
                "From contactos ".
                "Where idcontacto = $idContacto ";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<idinstitucion>" . $row['idinstitucion'] . "</idinstitucion>\n";
            echo "<nombreContacto>" . $row['nombreContacto'] . "</nombreContacto>\n";
            echo "<area>" . $row['area'] . "</area>\n";
            echo "<cargo>" . $row['cargo'] . "</cargo>\n";
            echo "<telefonos>" . $row['telefonos'] . "</telefonos>\n";
            echo "<extension>" . $row['extension'] . "</extension>\n";
            echo "<correoElectronico>" . $row['correoElectronico'] . "</correoElectronico>\n";
            echo "<notas>" . $row['notas'] . "</notas>\n";            
        }

        echo "</resultado>\n";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>