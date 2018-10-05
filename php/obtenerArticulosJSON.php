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

        $sql = "Select * 
                From $tabla
                Where $tabla.nombre Like '%$term%'
                Or $tabla.codigo Like '%$term%'
                Or $tabla.modelo Like '%$term%'
                And estado = 'ACTIVO'
                And aprobado = 'SI'";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $ciudad = array("id" => $row["idarticulo"] , "value" => ($row["nombre"] . " - " . $row["modelo"] . " - " . $row["color"] . " - " . $row["notas"]), "precio" => $row["costopublico"], "preciodistribuidor" => $row["preciodistribuidor"]);
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