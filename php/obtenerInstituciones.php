<?php
    try
    {
        require_once('connection.php');

        $con = new mysqli($hn, $un, $pw, $db);

        $sql = "Select instituciones.*, paises.pais From instituciones ". 
                "Inner Join paises " .
                "On paises.idpais = instituciones.idpais";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            echo '<div class="col-12">';            
            echo '<div class="divTarjetaInstitucion" onclick="elegirInstitucion(' . $row["idinstitucion"] . ')">';
            echo '<div class="divTarjetaInstitucionHeader">' . $row["nombreInstitucion"] . '</div>';
            echo '<div class="divTarjetaInstitucionBody">' . $row["pais"] . '</div></div></div>';
        }

        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>