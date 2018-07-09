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
            echo "<cat>";
            echo "<idenvio>". $row["idenvio"] . "</idenvio>";
            echo "<idtiendade>". $row["idtiendade"] . "</idtiendade>";
            echo "<idtiendaa>". $row["idtiendaa"] . "</idtiendaa>";
            echo "<estado>". $row["estado"] . "</estado>";
            echo "<notas>". $row["notas"] . "</notas>";
            echo "<fechaenvio>". $row["fechaenvio"] . "</fechaenvio>";
            echo "<fecharecepcion>". $row["fecharecepcion"] . "</fecharecepcion>";
            echo "</cat>";
        }

        echo "</resultado>\n";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>