<?php
    try
    {
        require('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select envios.*, tiendas.nombre
                From envios
                Inner Join tiendas
                On tiendas.idtienda = envios.idtiendade
                Where envios.estado = 'ACTIVO'";

        $result = $con->query($sql);           

        while ($row = $result->fetch_array()) {
            echo "<span class='ultimoArticulo' onclick='elegirEnvioRecepcion(\"" . $row["idenvio"]. "\", \"" . $row["nombre"] . "\")'>" . $row["nombre"] . " - " . $row["fechaenvio"] . "</span>";
        }
        
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>