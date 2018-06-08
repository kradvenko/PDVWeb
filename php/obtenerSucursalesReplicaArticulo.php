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

        $sql = "Select contactos.* " .
                "From contactos ".
                "Where idInstitucion = $idInstitucion ";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            echo '<div class="col-12">';            
            echo '<div class="divTarjetaContacto" onclick="elegirContacto(' . $row["idcontacto"] . ')">';
            echo '<div class="divTarjetaContactoHeader">' . $row["nombreContacto"] . '</div>';
            echo '<div class="divTarjetaContactoBody">' . $row["area"] . '</div></div></div>';
        }

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>