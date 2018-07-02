<?php

    function listaTiendas() {
        try
        {
            require('connection.php');

            $con = new mysqli($hn, $un, $pw, $db);

            $sql = "Select *
                    From tiendas
                    Where tipo = 'SUCURSAL'";

            $result = $con->query($sql);

            echo "<select class='form-control' id='selListaTiendas'>";
    
            while ($row = $result->fetch_array()) {
                echo "<option value='" . $row["idtienda"] . "'>" . $row["nombre"] . "</option>";            
            }
            
            echo "</select>";

            mysqli_close($con);
        }
        catch (Throwable $t)
        {
            echo $t;
        }
    }

?>