<?php
    try
    {
        require_once('connection.php');

        $idArticulo = $_POST["idArticulo"];
        $cantidad = $_POST["cantidad"];

        $precio = "No existe precio de mayoreo.";

        if (!$idArticulo) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select *
                From mat_preciosmayoreo
                Where idarticulo = $idArticulo And (de <= $cantidad And a >= $cantidad)";

        $result = $con->query($sql);
        
        while ($row = $result->fetch_array()) {
            $precio =  $row["precio"];
        }       

        echo $precio;
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>