<?php
    try
    {
        require_once('connection.php');

        $idArticulo = $_POST["idArticulo"];

        if (!$idArticulo) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $prefijo = $_COOKIE["prefijo"];

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select * 
                From " . $prefijo . "preciosmayoreo                 
                Where " . $prefijo . "preciosmayoreo.idarticulo = $idArticulo";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<cat>";
            echo "<id>" . $row['idarticulo'] . "</id>\n";
            echo "<precio>" . $row['precio'] . "</precio>\n";
            echo "<de>" . $row['de'] . "</de>\n";
            echo "<a>" . $row['a'] . "</a>\n";
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