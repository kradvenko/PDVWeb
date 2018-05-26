<?php
    try
    {
        require_once('connection.php');

        $idInstitucion = $_POST["idInstitucion"];

        if (!$idInstitucion) {
            echo "Error. Faltan variables.";
            exit(1);
        }

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select * " .
                "From institucionpendientes " .
                "Where idinstitucion = $idInstitucion";

        $result = $con->query($sql);

        echo "<table class='table-fill'>";
        echo "<thead>";
        echo " <tr>";
        echo "  <th class='text-left'>Pendiente</th>";
        echo "  <th class='text-left'>Estado</th>";
        echo "  <th class='text-left'></th>";
        echo " </tr>";
        echo "</thead>";

        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "  <td>" . $row["pendiente"] . "</td>";
            echo "  <td>" . $row["estado"] . "</td>";
            echo "  <td><button type='button' class='btn btn-success' onclick='elegirPendienteInstitucion(" . $row["idinstitucionpendiente"] . ", " . json_encode($row["pendiente"]) . ", \"" . $row["estado"] . "\", \"" . $row["fechaInicio"] . "\", \"" . $row["fechaFin"] . "\", " . json_encode($row["resolucion"]) . ")'>Elegir</button>";
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