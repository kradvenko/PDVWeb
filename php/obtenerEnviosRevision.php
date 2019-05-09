<?php
    try
    {
        require('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $idTienda = $_COOKIE["idtienda"];

        $sql = "Select envios.*, tiendas.nombre, T.nombre AS TiendaA
                From envios
                Inner Join tiendas
                On tiendas.idtienda = envios.idtiendade
                Inner Join tiendas T
                On T.idtienda = envios.idtiendaa
                Where envios.estado LIKE 'RECIBIDO%' And envios.idtiendade = $idTienda";

        $result = $con->query($sql);           

        while ($row = $result->fetch_array()) {
            echo "<span class='ultimoArticulo' onclick='elegirEnvioRecepcion(\"" . $row["idenvio"]. "\", \"" . $row["nombre"] . "\")'>De " . $row["nombre"] . " a " . $row["TiendaA"] . " - " . $row["fechaenvio"] . "</span>";
        }
        
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>