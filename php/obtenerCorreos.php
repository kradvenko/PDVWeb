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
                "From institucioncorreos " .
                "Where idinstitucion = $idInstitucion";

        $result = $con->query($sql);

        echo "<table class='table-fill'>";
        echo "<thead>";
        echo " <tr>";
        echo "  <th class='text-left'>Correo</th>";
        echo "  <th class='text-left'>Notas</th>";
        echo "  <th class='text-left'></th>";
        echo " </tr>";
        echo "</thead>";

        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "  <td><a target='_blank'>" . $row["correo"] . "</a></td>";
            echo "  <td>" . $row["notas"] . "</td>";
            echo "  <td><button type='button' class='btn btn-success' onclick='elegirCorreo(" . $row["idinstitucioncorreo"] . ", \"" . $row["correo"] . "\", " . json_encode($row["notas"]) . ")'>Elegir</button>";
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