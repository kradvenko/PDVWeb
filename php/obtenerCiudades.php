<?php
    try
    {
        require_once('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select ciudades.*, regiones.region, paises.pais " . 
                "From ciudades " .
                "Inner Join regiones " .
                "On regiones.idregion = ciudades.idregion " .
                "Inner Join paises " .
                "On paises.idpais = ciudades.idpais";

        $result = $con->query($sql);

        echo "<table class='tableLocalidades'>";

        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "  <td>" . $row["pais"] . "</td>";
            echo "  <td>" . $row["region"] . "</td>";
            echo "  <td>" . $row["ciudad"] . "</td>";
            echo "  <td><button type='button' class='btn btn-warning' data-toggle='modal' data-target='#modalModificarCiudad' onclick='seleccionarCiudad(" . $row["idciudad"] . ", " . $row["idregion"] . ", " . $row["idpais"] . ", \"". $row["ciudad"] . "\")'>Modificar</button>";
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