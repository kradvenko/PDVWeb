<?php    
    try
    {
        require_once('connection.php');

        header('Content-type: application/json');

        $term = $_GET["term"];

        $con = new mysqli($hn, $un, $pw, $db);

        $data = array();

        $prefijo = $_COOKIE["prefijo"];

        if (!$prefijo) {
            return;
        }

        $tabla = $prefijo . "articulos";

        $sql = "Select $tabla.*, Concat(lotes.fechalote, ' - ', origeneslote.origen) As Lote
                From $tabla
                Join lotes
                On lotes.idlote = $tabla.idlote
                Join origeneslote
                On origeneslote.idorigenlote = lotes.idorigen
                Where $tabla.nombre Like '%$term%'
                Or $tabla.codigo Like '%$term%'
                Or $tabla.modelo Like '%$term%'
                And $tabla.estado = 'ACTIVO'
                And aprobado = 'SI'";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $ciudad = array("id" => $row["idarticulo"] , "value" => ($row["nombre"] . " - " . $row["modelo"] . " - " . $row["color"] . " - " . $row["notas"] . " - L: " . $row["Lote"]), "precio" => $row["costopublico"], "preciodistribuidor" => $row["preciodistribuidor"]);
            array_push($data, $ciudad);
        }
        
        echo json_encode($data);
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>