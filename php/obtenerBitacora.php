<?php
    try
    {
        require_once('connection.php');

        $idServicio = $_POST["idServicio"];

        $prefijo = $_COOKIE["prefijo"];
        $tablaBitacora = $prefijo . "bitacora";

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select $tablaBitacora.*, usuarios.nombre
                From $tablaBitacora
                Inner Join usuarios
                On $tablaBitacora.idusuario = usuarios.idusuario
                Where $tablaBitacora.idservicio = $idServicio";

        $result = $con->query($sql);

        $type = "Odd";

        while ($row = $result->fetch_array()) {
            echo '<div class="col-6 divBitacoraEntrada' . $type . '">';
            echo $row["fecha"];
            echo '</div>';
            
            echo '<div class="col-4 divBitacoraEntrada' . $type . '">';
            echo $row["nombre"];
            echo '</div>';
            
            echo '<div class="col-2 divBitacoraEntrada' . $row["prioridad"] . '">';
            echo $row["prioridad"];
            echo '</div>';

            echo '<div class="col-12 divBitacoraEntradaText' . $type . '">';
            echo $row["entrada"];
            echo '</div>';

            if ($type == "Odd") {
                $type = "Even";
            } else if ($type == "Even") {
                $type = "Odd";
            }
        }

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>