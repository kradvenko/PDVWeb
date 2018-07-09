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
            echo "<cat>";
            echo "<idtetalleenvio>". $row["idtetalleenvio"] . "</idtetalleenvio>";
            echo "<idenvio>". $row["idenvio"] . "</idenvio>";
            echo "<idarticulode>". $row["idarticulode"] . "</idarticulode>";
            echo "<idarticuloa>". $row["idarticuloa"] . "</idarticuloa>";
            echo "<cantidadenviada>". $row["cantidadenviada"] . "</cantidadenviada>";
            echo "<cantidadrecibida>". $row["cantidadrecibida"] . "</cantidadrecibida>";
            echo "<estado>". $row["estado"] . "</estado>";
            echo "<nombre>". $row["nombre"] . "</nombre>";
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