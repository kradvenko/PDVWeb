<?php
    try
    {
        require_once('connection.php');

        $prefijo = $_COOKIE["prefijo"];
        $idLote = $_POST["idLote"];

        if (!$idLote) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select " . $prefijo ."articulos.*, categorias.categoria, marcas.marca ". 
                "From " . $prefijo ."articulos " .
                "Inner Join categorias " .
                "On categorias.idcategoria = " . $prefijo . "articulos.idcategoria " .
                "Inner Join marcas " .
                "On marcas.idmarca = " . $prefijo . "articulos.idmarca " .
                "Where " . $prefijo ."articulos.idlote = $idLote";

        $result = $con->query($sql);

        header("Content-Type: text/xml");	
	    echo "<resultado>\n";

        while ($row = $result->fetch_array()) {
            echo "<cat>";
            echo "<idarticulo>" . $row['idarticulo'] . "</idarticulo>\n";
            echo "<idcategoria>" . $row['idcategoria'] . "</idcategoria>\n";
            echo "<idmatriz>" . $row['idmatriz'] . "</idmatriz>\n";
            echo "<categoria>" . $row['categoria'] . "</categoria>\n";
            echo "<codigo>" . $row['codigo'] . "</codigo>\n";
            echo "<nombre>" . $row['nombre'] . "</nombre>\n";
            echo "<descripcion>" . $row['descripcion'] . "</descripcion>\n";
            echo "<modelo>" . $row['modelo'] . "</modelo>\n";
            echo "<idmarca>" . $row['idmarca'] . "</idmarca>\n";
            echo "<marca>" . $row['marca'] . "</marca>\n";
            echo "<color>" . $row['color'] . "</color>\n";
            echo "<cantidad>" . $row['cantidad'] . "</cantidad>\n";
            echo "<minimo>" . $row['minimo'] . "</minimo>\n";
            echo "<costopublico>" . $row['costopublico'] . "</costopublico>\n";
            echo "<costoreal>" . $row['costoreal'] . "</costoreal>\n";
            echo "<costodistribuidor>" . $row['costodistribuidor'] . "</costodistribuidor>\n";
            echo "<estado>" . $row['estado'] . "</estado>\n";
            echo "<preciodistribuidor>" . $row['preciodistribuidor'] . "</preciodistribuidor>\n";
            echo "<idlote>" . $row['idlote'] . "</idlote>\n";
            echo "<aprobado>" . $row['aprobado'] . "</aprobado>\n";
            echo "<notas>" . $row['notas'] . "</notas>\n";
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