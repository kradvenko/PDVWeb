<?php
    try
    {
        require('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select envios.*, M.nombre As Matriz, S.nombre As Sucursal
                From envios
                Inner Join tiendas M
                On M.idtienda = envios.idtiendade
                Inner Join tiendas S
                On S.idtienda = envios.idtiendaa
                Order By envios.idenvio Desc
                Limit 10";

        $result = $con->query($sql);           

        while ($row = $result->fetch_array()) {
            echo "<span class='ultimoArticulo' onclick='elegirEnvio(\"" . $row["idenvio"] . "\")'>" . $row["Matriz"] . " - " . $row["Sucursal"] . " - " . $row["fechaenvio"] . "</span>";
        }
        
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>