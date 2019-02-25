<?php    
    try
    {
        require_once('connection.php');

        header('Content-type: application/json');

        $term = $_GET["term"];

        $con = new mysqli($hn, $un, $pw, $db);

        $data = array();

        $prefijo = $_COOKIE["prefijo"];

        $tabla = $prefijo . "servicios";

        if (!$prefijo) {
            return;
        }

        $sql = "Select " . $prefijo . "servicios.*, clientes.nombre
                From " . $prefijo . "servicios 
                Inner Join clientes
                On clientes.idcliente = " . $prefijo . "servicios.idcliente
                Inner Join marcas
                On marcas.idmarca = $tabla.idmarca
                Where " . $prefijo . "servicios.folio Like '%$term%' Or clientes.nombre Like '%$term%' Or marcas.marca LIKE '%$term%' And " . $prefijo ."servicios.estado = 'ACTIVO'";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $ciudad = array("id" => $row["idservicio"] , "value" => ($row["folio"] . " - " . $row["nombre"] . " - " .$row["modelo"]));
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