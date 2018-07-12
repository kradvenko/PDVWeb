<?php
    try
    {
        require_once('connection.php');

        $idEnvio = $_POST["idEnvio"];

        $prefijo = $_COOKIE["prefijo"];        

        if (!$idEnvio) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select detalleenvio.*, DE.nombre
                From detalleenvio
                Inner Join " . $prefijo . "articulos DE
                On DE.idarticulo = detalleenvio.idarticulode
                Where idenvio = $idEnvio";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<cat>\n";
            echo "<iddetalleenvio>". $row["iddetalleenvio"] . "</iddetalleenvio>\n";
            echo "<idenvio>". $row["idenvio"] . "</idenvio>\n";
            echo "<idarticulode>". $row["idarticulode"] . "</idarticulode>\n";
            echo "<idarticuloa>". $row["idarticuloa"] . "</idarticuloa>\n";
            echo "<cantidadenviada>". $row["cantidadenviada"] . "</cantidadenviada>\n";
            echo "<cantidadrecibida>". $row["cantidadrecibida"] . "</cantidadrecibida>\n";
            echo "<estado>". $row["estado"] . "</estado>\n";
            echo "<nombre>". $row["nombre"] . "</nombre>\n";
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