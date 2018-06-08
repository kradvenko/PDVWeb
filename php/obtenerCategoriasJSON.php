<?php    
    try
    {
        require_once('connection.php');

        header('Content-type: application/json');

        $term = $_GET["term"];
        $idTienda = $_GET["idTienda"];

        $con = new mysqli($hn, $un, $pw, $db);

        $data = array();

        $prefijo = $_COOKIE["prefijo"];

        if (!$prefijo) {
            return;
        }
        
        $sql = "Select * 
                From categorias 
                Where categorias.categoria Like '%$term%' And estado = 'ACTIVO' And idtienda = $idTienda";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $item = array("id" => $row["idcategoria"] , "value" => $row["categoria"]);
            array_push($data, $item);
        }
        
        echo json_encode($data);
        mysqli_close($con);
    }
    catch (Throwable $t)
    {
        echo $t;
    }
?>