<?php
    try
    {
        require('connection.php');

        $tipo = $_POST["tipo"];

        if (!$tipo) {
            return;
        }

        $prefijo = $_COOKIE["prefijo"];

        $con = new mysqli($hn, $un, $pw, $db);

        $tabla = $prefijo . "folios";

        $sql = "SELECT *
                FROM $tabla
                WHERE tipo = '$tipo'";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<respuesta>OK</respuesta>\n";
            echo "<prefijo>" . $row['prefijo'] . "</prefijo>\n";
            echo "<folio>" . $row['folio'] . "</folio>\n";
        }
        
        echo "</resultado>\n";
        
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        header("Content-Type: text/xml");	
	    echo "<resultado>\n";
        echo "<respuesta>" . $t . "</respuesta>\n";
        echo "</resultado>\n";
    }
?>