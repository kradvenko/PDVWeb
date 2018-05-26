<?php
    try
    {
        require_once('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select * From paises";

        $result = $con->query($sql);

        echo "<table class='tableLocalidades'>";

        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "  <td>" . $row["pais"] . "</td>";
            echo "  <td><button type='button' class='btn btn-warning' data-toggle='modal' data-target='#modalModificarPais' onclick='seleccionarPais(" . $row["idpais"] . ", \"". $row["pais"] . "\")'>Modificar</button>";
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