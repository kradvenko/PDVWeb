<?php
    try
    {
        require_once('connection.php');

        $idEnvio = $_POST["idEnvio"];        

        if (!$idEnvio) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select * 
                From envios 
                Where idenvio = $idEnvio";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<cat>\n";
            echo "<idenvio>". $row["idenvio"] . "</idenvio>\n";
            echo "<idtiendade>". $row["idtiendade"] . "</idtiendade>\n";
            echo "<idtiendaa>". $row["idtiendaa"] . "</idtiendaa>\n";
            echo "<estado>". $row["estado"] . "</estado>\n";
            echo "<notas>". $row["notas"] . "</notas>\n";
            echo "<fechaenvio>". $row["fechaenvio"] . "</fechaenvio>\n";
            echo "<fecharecepcion>". $row["fecharecepcion"] . "</fecharecepcion>\n";
            echo "</cat>\n";
        }

        echo "</resultado>\n";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>