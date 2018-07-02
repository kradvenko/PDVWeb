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

        $sql = "Select * 
                From " . $prefijo . "articulos 
                Where " . $prefijo . "articulos.nombre Like '%$term%' And estado = 'ACTIVO' And aprobado = 'SI'";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $ciudad = array("id" => $row["idarticulo"] , "value" => ($row["nombre"] . " - " . $row["notas"]), "precio" => $row["costopublico"], "preciodistribuidor" => $row["preciodistribuidor"]);
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