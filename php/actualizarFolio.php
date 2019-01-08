<?php
    try
    {
        require('connection.php');

        $tipo = $_POST["tipo"];

        if (!$tipo) {
            return;
        }

        $prefijo = $_COOKIE["prefijo"];

        $con = new mysqli($hn, $un, $pw, $db);

        $tabla = $prefijo . "folios";

        $sql = "SELECT *
                FROM $tabla
                WHERE tipo = '$tipo'";

        $result = $con->query($sql);        

        $idFolio = 0;
        $folio = 0;

        while ($row = $result->fetch_array()) {
            $idFolio = $row["idfolio"];
            $folio = $row["folio"];
        }

        $folio = $folio + 1;

        $sql = "UPDATE $tabla
                SET folio = '$folio'
                WHERE idfolio = $idFolio
                ";
        
        $con->query($sql);

        echo "OK";
        
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>