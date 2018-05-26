<?php
    try
    {
        require_once('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select regiones.*, tiposregiones.tiporegion, paises.pais " . 
                "From regiones Inner Join tiposregiones " .
                "On tiposregiones.idtiporegion = regiones.idtiporegion " .
                "Inner Join paises " .
                "On paises.idpais = regiones.idpais";

        $result = $con->query($sql);

        echo "<table class='tableLocalidades'>";

        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "  <td>" . $row["pais"] . "</td>";
            echo "  <td>" . $row["tiporegion"] . "</td>";
            echo "  <td>" . $row["region"] . "</td>";
            echo "  <td><button type='button' class='btn btn-warning' data-toggle='modal' data-target='#modalModificarRegion' onclick='seleccionarRegion(" . $row["idregion"] . ", " . $row["idpais"] . ", " . $row["idtiporegion"] . ", \"". $row["region"] . "\")'>Modificar</button>";
            echo "</tr>";
        }

        echo "</table>";

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>