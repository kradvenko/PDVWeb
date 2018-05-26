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
                "From instituciontelefonos " .
                "Where idinstitucion = $idInstitucion";

        $result = $con->query($sql);

        echo "<table class='table-fill'>";
        echo "<thead>";
        echo " <tr>";
        echo "  <th class='text-left'>Teléfono</th>";
        echo "  <th class='text-left'>Extensión</th>";
        echo "  <th class='text-left'>Notas</th>";
        echo "  <th class='text-left'></th>";
        echo " </tr>";
        echo "</thead>";

        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "  <td>" . $row["telefono"] . "</td>";
            echo "  <td>" . $row["extension"] . "</td>";
            echo "  <td>" . $row["notas"] . "</td>";
            echo "  <td><button type='button' class='btn btn-success' onclick='elegirTelefono(" . $row["idinstituciontelefono"] . ", \"" . $row["telefono"] . "\", \"" . $row["extension"] . "\", " . json_encode($row["notas"]) . ")'>Elegir</button>";
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