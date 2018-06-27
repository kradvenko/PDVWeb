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
                From clientes 
                Where clientes.nombre Like '%$term%' And estado = 'ACTIVO'";

        $result = $con->query($sql);

        while ($row = $result->fetch_array()) {
            $item = array("id" => $row["idcliente"] , "value" => $row["nombre"]);
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